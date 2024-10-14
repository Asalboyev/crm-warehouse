<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\Product;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\DB;
use App\Models\Status;
use App\Models\OrderImage;
use App\Models\User;
use App\Models\Notification;

class OrderController extends Controller
{
    // List all orders
    public function index(Request $request)
    {
        // Buyurtmalarni olish uchun asosiy so'rov
        $query = Order::with(['user', 'client', 'orderProducts.product']);

        // Statusni tekshirish
        if ($request->has('status')) {
            // Statusni olish va kichik/katta harfga moslash
            $statusName = strtolower($request->get('status'));

            // Statusni ID yoki nom orqali olish
            $status = Status::where('name', $statusName)->orWhere('id', $statusName)->first();

            if ($status) {
                // Agar status topilsa, ushbu statusga mos buyurtmalarni olish
                $query->whereHas('statuses', function ($q) use ($status) {
                    $q->where('status_id', $status->id);
                });
            }
        } else {
            // Status berilmagan bo'lsa, ID 1 bo'lmagan barcha buyurtmalarni chiqaramiz
            $query->where('id', '!=', 1);
        }

        // Qo'shimcha filtrlar
        if ($request->has('user_name')) {
            $query->whereHas('user', function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->user_name . '%');
            });
        }

        if ($request->has('client_name')) {
            $query->whereHas('client', function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->client_name . '%');
            });
        }

        if ($request->has('order_id')) {
            $query->where('id', $request->order_id);
        }

        // Avtomobil raqamiga ko'ra qidirish
        if ($request->has('car_number')) {
            $query->whereHas('client', function ($q) use ($request) {
                $q->where('car_number', 'like', '%' . $request->car_number . '%');
            });
        }

        if ($request->has('order_date')) {
            $query->whereDate('created_at', $request->order_date);
        }

        // Natijalarni olish
        $orders = $query->get();

        return response()->json($orders, 200);
    }

    public function status(Request $request)
    {
        // Check if the request has 'status' parameter, for example 'new' or a specific status ID
        if ($request->has('status')) {
            $statusName = $request->get('status');

            // Check if the provided status is an ID or a name
            $status = Status::where('name', $statusName)->orWhere('id', $statusName)->first();

            if (!$status) {
                return response()->json(['message' => 'Status not found'], 404);
            }

            // Fetch orders associated with this status
            $orders = Order::whereHas('statuses', function ($query) use ($status) {
                $query->where('status_id', $status->id);
            })->get();

            return response()->json([
                'status' => $status,
                'orders' => $orders,
            ]);
        }

        // If no specific status is requested, return all statuses except the one with ID 1
        $statuses = Status::where('id', '!=', 1)->with('orders')->get();

        return response()->json($statuses);
    }


    public function store(Request $request)
    {
        // Validate the incoming request
        $validated = $request->validate([
            'client_id' => 'required|exists:customers,id',
            'products' => 'required|array',

           // Har bir fotosurat uchun 10MB
        ]);

        // Start a database transaction
        DB::beginTransaction();

        try {
            // Create a new order
            $order = Order::create([
                'user_id' => auth()->user()->id, // Seller ID
                'client_id' => $request->client_id,
                'total_price' => $request->total_price,
                'total_weight' => $request->total_weight,
                'order_status' => $request->order_status,
                'car_number' => $request->car_number,
            ]);

            // Initialize an array to group products by product_id
            $groupedProducts = [];

            // Loop through each product and sum quantities by product_id
            foreach ($request->products as $product) {
                $productId = $product['product_id'];

                if (!isset($groupedProducts[$productId])) {
                    $groupedProducts[$productId] = [
                        'quantity_pack' => 0,
                        'quantity_piece' => 0
                    ];
                }

                // Sum the quantities for the same product in the current request
                $groupedProducts[$productId]['quantity_pack'] += $product['quantity_pack'];
                $groupedProducts[$productId]['quantity_piece'] += $product['quantity_piece'];
            }

            // Process each grouped product
            foreach ($groupedProducts as $productId => $quantities) {
                $productModel = Product::find($productId);
                if (!$productModel) {
                    return response()->json(['message' => 'Product not found'], 404);
                }

                $quantityPochka = $quantities['quantity_pack'];
                $quantityDona = $quantities['quantity_piece'];

                // Handle stock deduction based on order type
                if ($request->zayafka == 0) { // Actual order
                    if ($quantityPochka > 0 && $productModel->items_per_package < $quantityPochka) {
                        return response()->json(['message' => 'Insufficient stock for product ID ' . $productId . ' in packages'], 400);
                    }

                    if ($quantityDona > 0 && $productModel->total_units < $quantityDona) {
                        return response()->json(['message' => 'Insufficient stock for product ID ' . $productId . ' in units'], 400);
                    }

                    // Deduct stock for actual orders
                    $productModel->items_per_package -= $quantityPochka;
                    $productModel->total_units -= $quantityDona;
                } else {
                    // Zayafka: Deduct stock even if it goes negative
                    $productModel->items_per_package -= $quantityPochka;
                    $productModel->total_units -= $quantityDona;
                }

                // Save the updated product stock
                $productModel->save();

                // Calculate total weight and price for the current request
                $totalWeight = ($quantityPochka * $productModel->package_weight) + ($quantityDona * $productModel->weight_per_item);
                $totalPrice = ($quantityPochka * $productModel->price_per_package) + ($quantityDona * $productModel->price_per_item);

                // Store the order product details
                OrderProduct::create([
                    'order_id' => $order->id,
                    'product_id' => $productId,
                    'quantity_pack' => $quantityPochka,
                    'quantity_piece' => $quantityDona,
                    'price_per_ton' => $productModel->price_per_ton,
                    'price_per_unit' => $productModel->price_per_item,
                    'total_weight' => $totalWeight,
                    'total_price' => $totalPrice,
                    'sold_by_user_id' => auth()->user()->id, // The seller ID
                ]);
            }

            // Save statuses
            $order->statuses()->sync($request->status); // Assuming status IDs are sent as an array

            // Handle photo uploads (only if photos are provided)

            // Commit the transaction
            DB::commit();

            // Return the created order with relationships
            return response()->json($order->load('user', 'client', 'orderProducts.product', 'statuses'), 201);
        } catch (\Exception $e) {
            // Rollback the transaction if something failed
            DB::rollBack();
            \Log::error('Order creation failed: ' . $e->getMessage());
            return response()->json(['message' => 'Order creation failed: ' . $e->getMessage()], 500);
        }
    }

    // View order details
    public function show(Order $order)
    {
        return response()->json($order->load('user', 'client', 'orderProducts.product'), 200);
    }
    public function update(Request $request, $orderId)
    {
        // Validate the incoming request
        $validated = $request->validate([
            'client_id' => 'required|exists:customers,id',
            'products' => 'required|array',
            // Other validation rules as needed
        ]);

        // Start a database transaction
        DB::beginTransaction();

        try {
            // Fetch the existing order
            $order = Order::findOrFail($orderId);

            // Update the order details
            $order->update([
                'client_id' => $request->client_id,
                'total_price' => $request->total_price,
                'total_weight' => $request->total_weight,
                'order_status' => $request->order_status,
                'car_number' => $request->car_number,
            ]);

            // Initialize an array to group products by product_id
            $groupedProducts = [];

            // Loop through each product and sum quantities by product_id
            foreach ($request->products as $product) {
                $productId = $product['product_id'];

                if (!isset($groupedProducts[$productId])) {
                    $groupedProducts[$productId] = [
                        'quantity_pack' => 0,
                        'quantity_piece' => 0
                    ];
                }

                // Sum the quantities for the same product in the current request
                $groupedProducts[$productId]['quantity_pack'] += $product['quantity_pack'];
                $groupedProducts[$productId]['quantity_piece'] += $product['quantity_piece'];
            }

            // Process each grouped product and update stock
            foreach ($groupedProducts as $productId => $quantities) {
                $productModel = Product::find($productId);
                if (!$productModel) {
                    return response()->json(['message' => 'Product not found'], 404);
                }

                $quantityPochka = $quantities['quantity_pack'];
                $quantityDona = $quantities['quantity_piece'];

                // Handle stock deduction based on order type
                if ($request->zayafka == 0) { // Actual order
                    if ($quantityPochka > 0 && $productModel->items_per_package < $quantityPochka) {
                        return response()->json(['message' => 'Insufficient stock for product ID ' . $productId . ' in packages'], 400);
                    }

                    if ($quantityDona > 0 && $productModel->total_units < $quantityDona) {
                        return response()->json(['message' => 'Insufficient stock for product ID ' . $productId . ' in units'], 400);
                    }

                    // Deduct stock for actual orders
                    $productModel->items_per_package -= $quantityPochka;
                    $productModel->total_units -= $quantityDona;
                } else {
                    // Zayafka: Deduct stock even if it goes negative
                    $productModel->items_per_package -= $quantityPochka;
                    $productModel->total_units -= $quantityDona;
                }

                // Save the updated product stock
                $productModel->save();

                // Calculate total weight and price for the current request
                $totalWeight = ($quantityPochka * $productModel->package_weight) + ($quantityDona * $productModel->weight_per_item);
                $totalPrice = ($quantityPochka * $productModel->price_per_package) + ($quantityDona * $productModel->price_per_item);

                // Update the existing order product or create a new one
                $orderProduct = OrderProduct::updateOrCreate(
                    [
                        'order_id' => $order->id,
                        'product_id' => $productId,
                    ],
                    [
                        'quantity_pack' => $quantityPochka,
                        'quantity_piece' => $quantityDona,
                        'price_per_ton' => $productModel->price_per_ton,
                        'price_per_unit' => $productModel->price_per_item,
                        'total_weight' => $totalWeight,
                        'total_price' => $totalPrice,
                        'sold_by_user_id' => auth()->user()->id, // The seller ID
                    ]
                );
            }

            // Save statuses
            $order->statuses()->sync($request->status); // Assuming status IDs are sent as an array

            // Commit the transaction
            DB::commit();

            // Return the updated order with relationships
            return response()->json($order->load('user', 'client', 'orderProducts.product', 'statuses'), 200);
        } catch (\Exception $e) {
            // Rollback the transaction if something failed
            DB::rollBack();
            \Log::error('Order update failed: ' . $e->getMessage());
            return response()->json(['message' => 'Order update failed: ' . $e->getMessage()], 500);
        }
    }

    // Update an existing order
    public function update_status(Request $request, $id)
    {
        // Validate the incoming request
        $validated = $request->validate([
            'order_status' => 'required|integer',
        ]);

        // Start a database transaction
        DB::beginTransaction();

        try {
            // Find the order by ID
            $order = Order::findOrFail($id);

            // Get the previous status name (fetch it from the order's current status)
            $previousStatus = $order->statuses()->latest()->first(); // Get the most recent status

            // Check if previous status exists and get its name
            $previousStatusName = $previousStatus && $previousStatus->statuses ? $previousStatus->statuses->id : 'Unknown'; // Handle the case where status is null

            // Remove the existing status for the order
            DB::table('order_status')->where('order_id', $order->id)->delete();

            // Insert new status in 'order_statuses' table
            DB::table('order_status')->insert([
                'order_id' => $order->id,
                'status_id' => $validated['order_status'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            // Get the new status name
            $newStatus = Status::findOrFail($validated['order_status']);
            $newStatusName = $newStatus->name;

            // Create notifications for all users (assuming you want to notify all users)
            $users = User::all(); // Fetch all users, or adjust based on your needs
            foreach ($users as $user) {
                Notification::create([
                    'order_id' => $order->id,
                    'user_id' => $user->id,
                    'previous_status_name' => $previousStatusName,
                    'new_status_name' => $newStatusName,
                    'is_read' => false,
                ]);
            }

            // Handle photo uploads if photos are provided
            if ($request->hasFile('photos')) {
                $photos = $request->file('photos');
                if (count($photos) > 15) {
                    return response()->json(['message' => 'Cannot upload more than 15 images.'], 400);
                }

                // Delete existing photos
                $order->orderImages()->delete();

                foreach ($photos as $photo) {
                    if ($photo->getSize() > 10485760) { // 10 MB in bytes
                        return response()->json(['message' => 'File size exceeds the 10MB limit'], 400);
                    }

                    // Convert image to webp format and save it
                    $webpImage = \Intervention\Image\Facades\Image::make($photo)->encode('webp', 90); // Quality 90
                    $webpPath = 'orders/images/' . uniqid() . '.webp';
                    $webpImage->save(public_path($webpPath)); // Save to public path

                    // Save the photo path in the OrderImage table
                    OrderImage::create([
                        'order_id' => $order->id,
                        'image_path' => $webpPath
                    ]);
                }
            }

            // Commit the transaction
            DB::commit();

            // Return the updated order with relationships
            return response()->json($order->load('user', 'client', 'orderImages'), 200);
        } catch (\Exception $e) {
            // Rollback the transaction if something failed
            DB::rollBack();
            \Log::error('Order update failed: ' . $e->getMessage());
            return response()->json(['message' => 'Order update failed: ' . $e->getMessage()], 500);
        }
    }

    // Delete an order
    public function destroy(Order $order)
    {
        // Start a database transaction
        DB::beginTransaction();

        try {
            // Restore product quantities
            foreach ($order->orderProducts as $oldProduct) {
                $productModel = Product::find($oldProduct->product_id);
                $oldTotalItems = ($oldProduct->quantity_pochka * $productModel->items_per_package) + $oldProduct->quantity_dona;
                $productModel->quantity += $oldTotalItems;
                $productModel->save();
            }

            // Delete the order
            $order->delete();

            // Commit the transaction
            DB::commit();

            return response()->json(['message' => 'Order deleted successfully'], 200);
        } catch (\Exception $e) {
            // Rollback the transaction if something failed
            DB::rollBack();
            \Log::error('Order deletion failed: ' . $e->getMessage());
            return response()->json(['message' => 'Order deletion failed: ' . $e->getMessage()], 500);
        }
    }
}
