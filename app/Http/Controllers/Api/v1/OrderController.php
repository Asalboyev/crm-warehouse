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
use App\Models\Turnover;

class OrderController extends Controller
{

    public function status(Request $request)
    {
        $query = Status::query();

        // Foydalanuvchi roli asosida statuslarni filtrlash
        if (auth()->check()) {
            $user = auth()->user(); // Autentifikatsiyalangan foydalanuvchini olish

            if ($user->role === 'guard') {
                // Guard foydalanuvchilari faqat 2, 3, va 4 id li statuslarni ko'radi
                $query->whereIn('id', [2, 3, 4]);
            } else {
                // Boshqa foydalanuvchilar uchun `id = 1` dan tashqari hamma statuslar
                $query->where('id', '!=', 1);
            }
        } else {
            // Autentifikatsiyalanmagan foydalanuvchilar uchun `id = 1` dan tashqari hamma statuslar
            $query->where('id', '!=', 1);
        }

        // Search funksiyasi
        if ($request->has('search') && !empty($request->search)) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        // Ma'lumotlarni olish
        $statuses = $query->get();

        // Javob qaytarish
        return response()->json([
            'success' => true,
            'data' => $statuses,
        ]);
    }

//    public function index(Request $request)
//    {
//        // Base query for retrieving orders
//        $query = Order::with(['user', 'client', 'orderProducts.product']); // Eager-load relationships except statuses
//
//        // Check for status filter
//        if ($request->has('status')) {
//            $statusName = strtolower($request->get('status'));
//
//            // Retrieve status by name or ID
//            $status = Status::where('name', $statusName)->orWhere('id', $statusName)->first();
//
//            if ($status) {
//                // Filter orders by status
//                $query->whereHas('statuses', function ($q) use ($status) {
//                    $q->where('status_id', $status->id);
//                });
//            }
//        } else {
//            $query->where('id', '!=', 1);
//        }
//
//        // Additional filters
//        if ($request->has('user_name')) {
//            $query->whereHas('user', function ($q) use ($request) {
//                $q->where('name', 'like', '%' . $request->user_name . '%');
//            });
//        }
//
//        if ($request->has('client_name')) {
//            $query->whereHas('client', function ($q) use ($request) {
//                $q->where('name', 'like', '%' . $request->client_name . '%');
//            });
//        }
//
//        if ($request->has('order_id')) {
//            $query->where('id', $request->order_id);
//        }
//
//        if ($request->has('car_number')) {
//            $query->whereHas('client', function ($q) use ($request) {
//                $q->where('car_number', 'like', '%' . $request->car_number . '%');
//            });
//        }
//
//        if ($request->has('order_date')) {
//            $query->whereDate('created_at', $request->order_date);
//        }
//
//        // Retrieve the orders
//        $orders = $query->get();
//
//        // Transform each order to include the user, client, orderProducts, and single status ID
//        $orders = $orders->map(function ($order) {
//            return [
//                'id' => $order->id,
//                'user_id' => $order->user_id,
//                'client_id' => $order->client_id,
//                'total_price' => $order->total_price,
//                'total_weight' => $order->total_weight,
//                'car_number' => $order->client->car_number ?? null,
//                'photos' => $order->photos,
//                'status' => optional($order->statuses->first())->id, // Get the first status ID only
//                'created_at' => $order->created_at,
//                'updated_at' => $order->updated_at,
//                'user' => $order->user, // Include user details
//                'client' => $order->client, // Include client details
//                'order_products' => $order->orderProducts->map(function ($orderProduct) {
//                    return [
//                        'id' => $orderProduct->id,
//                        'order_id' => $orderProduct->order_id,
//                        'product_id' => $orderProduct->product_id,
//                        'quantity_pack' => $orderProduct->quantity_pack,
//                        'quantity_piece' => $orderProduct->quantity_piece,
//                        'price_per_ton' => $orderProduct->price_per_ton,
//                        'price_per_unit' => $orderProduct->price_per_unit,
//                        'total_price' => $orderProduct->total_price,
//                        'total_weight' => $orderProduct->total_weight,
//                        'times_sold' => $orderProduct->times_sold,
//                        'is_returned' => $orderProduct->is_returned,
//                        'sold_by_user_id' => $orderProduct->sold_by_user_id,
//                        'created_at' => $orderProduct->created_at,
//                        'updated_at' => $orderProduct->updated_at,
//                        'product' => [
//                            'id' => $orderProduct->product->id,
//                            'product_name' => $orderProduct->product->product_name,
//                            'category_id' => $orderProduct->product->category_id,
//                            'country' => $orderProduct->product->country,
//                            'thickness' => $orderProduct->product->thickness,
//                            'length' => $orderProduct->product->length,
//                            'metal_type' => $orderProduct->product->metal_type,
//                            'price_per_ton' => $orderProduct->product->price_per_ton,
//                            'length_per_ton' => $orderProduct->product->length_per_ton,
//                            'price_per_meter' => $orderProduct->product->price_per_meter,
//                            'price_per_item' => $orderProduct->product->price_per_item,
//                            'price_per_package' => $orderProduct->product->price_per_package,
//                            'total_packages' => $orderProduct->product->total_packages,
//                            'package_weight' => $orderProduct->product->package_weight,
//                            'package_length' => $orderProduct->product->package_length,
//                            'weight_per_item' => $orderProduct->product->weight_per_item,
//                            'weight_per_meter' => $orderProduct->product->weight_per_meter,
//                            'total_units' => $orderProduct->product->total_units,
//                            'bron_package' => $orderProduct->product->bron_package,
//                            'bron_one_pc' => $orderProduct->product->bron_one_pc,
//                            'grains_package' => $orderProduct->product->grains_package,
//                            'total_packages' => $orderProduct->product->total_packages,
//                            'items_in_package' => $orderProduct->product->items_in_package,
//                            'total_weight' => $orderProduct->product->total_weight,
//                            'created_at' => $orderProduct->product->created_at,
//                            'updated_at' => $orderProduct->product->updated_at,
//                        ],
//                    ];
//                }),
//            ];
//        });
//
//        return response()->json($orders, 200);
//    }


    public function index(Request $request)
    {
        // Base query
        $query = Order::with(['user', 'client', 'orderProducts.product', 'statuses']);

        // Check if a status filter is applied
        if ($request->has('status')) {
            $statusValue = $request->get('status');

            // If status is specifically set to "1", include only orders with status_id = 1
            if ($statusValue === '1') {
                $query->whereHas('statuses', function ($q) {
                    $q->where('status_id', 1);
                });
            } elseif ($statusValue === '' || $statusValue === '0') {
                // If status is empty (e.g., ?status=) or "0", exclude orders with status_id = 1
                $query->whereHas('statuses', function ($q) {
                    $q->where('status_id', '!=', 1);
                });
            } else {
                // For other status values, check if the status exists and filter by it
                $status = Status::where('name', strtolower($statusValue))
                    ->orWhere('id', $statusValue)
                    ->first();

                if ($status) {
                    $query->whereHas('statuses', function ($q) use ($status) {
                        $q->where('status_id', $status->id);
                    });
                }
            }
        } else {
            // If no status parameter is present, exclude orders with status_id = 1
            $query->whereHas('statuses', function ($q) {
                $q->where('status_id', '!=', 1);
            });
        }

        // Fetch the orders
        $orders = $query->get();

        // Format the orders
        $result = $orders->map(function ($order) {
            return [
                'id' => $order->id,
                'user_id' => $order->user_id,
                'client_id' => $order->client_id,
                'total_price' => $order->total_price,
                'total_weight' => $order->total_weight,
                'car_number' => $order->car_number ?? null,
                'photos' => $order->photos,
                'status' => $order->statuses()->pluck('statuses.id')->first(),
                'created_at' => $order->created_at,
                'updated_at' => $order->updated_at,
                'user' => $order->user,
                'client' => $order->client,
                'order_products' => $order->orderProducts->map(function ($orderProduct) {
                    return [
                        'id' => $orderProduct->id,
                        'order_id' => $orderProduct->order_id,
                        'product_id' => $orderProduct->product_id,
                        'quantity_pack' => $orderProduct->quantity_pack,
                        'quantity_piece' => $orderProduct->quantity_piece,
                        'price_per_ton' => $orderProduct->price_per_ton,
                        'price_per_unit' => $orderProduct->price_per_unit,
                        'total_price' => $orderProduct->total_price,
                        'total_weight' => $orderProduct->total_weight,
                        'product' => [
                            'id' => $orderProduct->product->id,
                            'product_name' => $orderProduct->product->product_name,
                        ],
                    ];
                }),
            ];
        });

        return response()->json($result, 200);
    }





//    public function store(Request $request)
//    {
//        // Validate the incoming request
//        $validated = $request->validate([
//            'client_id' => 'required|exists:customers,id',
//            'products' => 'required|array',
//            'status' => 'required|integer',
//        ]);
//
//        DB::beginTransaction();
//
//        try {
//            $calculatedTotalPrice = 0;
//            $calculatedTotalWeight = 0;
//
//            // Create a new order
//            $order = Order::create([
//                'user_id' => auth()->user()->id,
//                'client_id' => $request->client_id,
//                'total_price' => 0,
//                'total_weight' => 0,
//                'order_status' => $request->status,
//                'car_number' => $request->car_number,
//            ]);
//
//            // Group products to sum quantities of the same product
//            $groupedProducts = [];
//
//            foreach ($request->products as $product) {
//                $productId = $product['product_id'];
//
//                if (!isset($groupedProducts[$productId])) {
//                    $groupedProducts[$productId] = [
//                        'quantity_pack' => 0,
//                        'quantity_piece' => 0
//                    ];
//                }
//
//                $groupedProducts[$productId]['quantity_pack'] += $product['quantity_pack'];
//                $groupedProducts[$productId]['quantity_piece'] += $product['quantity_piece'];
//            }
//
//            foreach ($groupedProducts as $productId => $quantities) {
//                $productModel = Product::find($productId);
//                if (!$productModel) {
//                    return response()->json(['message' => 'Product not found'], 404);
//                }
//
//                $quantityPack = $quantities['quantity_pack'];
//                $quantityPiece = $quantities['quantity_piece'];
//
//                // Calculate weight and price for the current order item
//                $weightForPack = $quantityPack * $productModel->package_weight;
//                $weightForPiece = $quantityPiece * $productModel->weight_per_item;
//                $totalWeight = $weightForPack + $weightForPiece;
//
//                $priceForPack = $quantityPack * $productModel->price_per_package;
//                $priceForPiece = $quantityPiece * $productModel->price_per_item;
//                $totalPrice = $priceForPack + $priceForPiece;
//
//                if ($request->status == 2) { // Regular order (status 2)
//                    // Check if requested quantity exceeds available stock
//                    if ($productModel->total_packages < $quantityPack) {
//                        return response()->json(['message' => 'Insufficient stock for product ID ' . $productId . ' in packages'], 400);
//                    }
//
//                    if ($productModel->total_units < $quantityPiece) {
//                        return response()->json(['message' => 'Insufficient stock for product ID ' . $productId . ' in units'], 400);
//                    }
//
//                    // Decrease stock for regular orders
//                    $productModel->total_packages -= $quantityPack;
//                    $productModel->total_units -= $quantityPiece;
//                }
//
//                if ($request->status == 1) { // Reservation (bron)
//                    $remainingPackages = $productModel->total_packages - $quantityPack;
//                    $remainingUnits = $productModel->total_units - $quantityPiece;
//
//                    // If not enough packages are available, update bron values
//                    if ($remainingPackages < 0) {
//                        $productModel->bron_package += abs($remainingPackages);
//                        $productModel->total_packages = -abs($remainingPackages); // Set negative value
//                    } else {
//                        $productModel->total_packages = $remainingPackages;
//                    }
//
//                    // If not enough units are available, update bron values
//                    if ($remainingUnits < 0) {
//                        $productModel->bron_one_pc += abs($remainingUnits);
//                        $productModel->total_units = -abs($remainingUnits); // Set negative value
//                    } else {
//                        $productModel->total_units = $remainingUnits;
//                    }
//
//                    // Add the entire reserved quantity to bron fields
//                    $productModel->bron_package += $quantityPack;
//                    $productModel->bron_one_pc += $quantityPiece;
//                }
//
//                $productModel->save();
//
//                $calculatedTotalWeight += $totalWeight;
//                $calculatedTotalPrice += $totalPrice;
//
//                // Store order product details
//                OrderProduct::create([
//                    'order_id' => $order->id,
//                    'product_id' => $productId,
//                    'quantity_pack' => $quantityPack,
//                    'quantity_piece' => $quantityPiece,
//                    'price_per_ton' => $productModel->price_per_ton,
//                    'price_per_unit' => $productModel->price_per_item,
//                    'total_weight' => $totalWeight,
//                    'total_price' => $totalPrice,
//                    'sold_by_user_id' => auth()->user()->id,
//                ]);
//
//                // Record turnover for the sold product
//                Turnover::create([
//                    'product_id' => $productId,
//                    'type' => 'chiqim',
//                    'quantity_pack' => $quantityPack,
//                    'quantity_piece' => $quantityPiece,
//                    'total_weight' => $totalWeight,
//                    'user_id' => auth()->user()->id,
//                    'total_price' => $totalPrice,
//                ]);
//            }
//
//            // Update order status and total values
//            $order->statuses()->sync([$request->status]);
//
//            $order->total_price = $calculatedTotalPrice;
//            $order->total_weight = $calculatedTotalWeight;
//            $order->save();
//
//            DB::commit();
//
//            // Send Notification about the new order creation
//            Notification::send(auth()->user(), new OrderCreatedNotification($order));
//
//            // Load order with related data for response
//            $orderWithDetails = $order->load('user', 'client', 'orderProducts.product', 'statuses');
//            $orderWithDetails->turnover = $calculatedTotalPrice;
//
//            return response()->json($orderWithDetails, 201);
//        } catch (\Exception $e) {
//            DB::rollBack();
//            \Log::error('Order creation failed: ' . $e->getMessage());
//            return response()->json(['message' => 'Order creation failed: ' . $e->getMessage()], 500);
//        }
//    }

        public function store(Request $request)
        {
            // Validate the incoming request
            $validated = $request->validate([
                'client_id' => 'required|exists:customers,id',
                'products' => 'required|array',
                'status' => 'required|integer',
            ]);

            DB::beginTransaction();

            try {
                $calculatedTotalPrice = 0;
                $calculatedTotalWeight = 0;

                // Create a new order
                $order = Order::create([
                    'user_id' => auth()->user()->id,
                    'client_id' => $request->client_id,
                    'total_price' => 0,
                    'total_weight' => 0,
                    'order_status' => $request->status,
                    'car_number' => $request->car_number,
                ]);

                // Group products to sum quantities of the same product
                $groupedProducts = [];

                foreach ($request->products as $product) {
                    $productId = $product['product_id'];

                    if (!isset($groupedProducts[$productId])) {
                        $groupedProducts[$productId] = [
                            'quantity_pack' => 0,
                            'quantity_piece' => 0
                        ];
                    }

                    $groupedProducts[$productId]['quantity_pack'] += $product['quantity_pack'];
                    $groupedProducts[$productId]['quantity_piece'] += $product['quantity_piece'];
                }

                foreach ($groupedProducts as $productId => $quantities) {
                    $productModel = Product::find($productId);
                    if (!$productModel) {
                        return response()->json(['message' => 'Product not found'], 404);
                    }

                    $quantityPack = $quantities['quantity_pack'];
                    $quantityPiece = $quantities['quantity_piece'];

                    // Calculate weight and price for the current order item
                    $weightForPack = $quantityPack * $productModel->package_weight;
                    $weightForPiece = $quantityPiece * $productModel->weight_per_item;
                    $totalWeight = $weightForPack + $weightForPiece;

                    $priceForPack = $quantityPack * $productModel->price_per_package;
                    $priceForPiece = $quantityPiece * $productModel->price_per_item;
                    $totalPrice = $priceForPack + $priceForPiece;

                    if ($request->status == 2) { // Regular order (status 2)
                        // Check if requested quantity exceeds available stock
                        if ($productModel->total_packages < $quantityPack) {
                            return response()->json(['message' => 'Insufficient stock for product ID ' . $productId . ' in packages'], 400);
                        }

                        if ($productModel->total_units < $quantityPiece) {
                            return response()->json(['message' => 'Insufficient stock for product ID ' . $productId . ' in units'], 400);
                        }

                        // Decrease stock for regular orders
                        $productModel->total_packages -= $quantityPack;
                        $productModel->total_units -= $quantityPiece;
                    }

                    if ($request->status == 1) { // Reservation (bron)
                        $remainingPackages = $productModel->total_packages - $quantityPack;
                        $remainingUnits = $productModel->total_units - $quantityPiece;

                        // If not enough packages are available, update bron values
                        if ($remainingPackages < 0) {
                            $productModel->bron_package += abs($remainingPackages);
                            $productModel->total_packages = -abs($remainingPackages); // Set negative value
                        } else {
                            $productModel->total_packages = $remainingPackages;
                        }

                        // If not enough units are available, update bron values
                        if ($remainingUnits < 0) {
                            $productModel->bron_one_pc += abs($remainingUnits);
                            $productModel->total_units = -abs($remainingUnits); // Set negative value
                        } else {
                            $productModel->total_units = $remainingUnits;
                        }

                        // Add the entire reserved quantity to bron fields
                        $productModel->bron_package += $quantityPack;
                        $productModel->bron_one_pc += $quantityPiece;
                    }

                    $productModel->save();

                    $calculatedTotalWeight += $totalWeight;
                    $calculatedTotalPrice += $totalPrice;

                    // Store order product details
                    OrderProduct::create([
                        'order_id' => $order->id,
                        'product_id' => $productId,
                        'quantity_pack' => $quantityPack,
                        'quantity_piece' => $quantityPiece,
                        'price_per_ton' => $productModel->price_per_ton,
                        'price_per_unit' => $productModel->price_per_item,
                        'total_weight' => $totalWeight,
                        'total_price' => $totalPrice,
                        'sold_by_user_id' => auth()->user()->id,
                    ]);

                    // Record turnover for the sold product
                    Turnover::create([
                        'product_id' => $productId,
                        'type' => 'chiqim',
                        'quantity_pack' => $quantityPack,
                        'quantity_piece' => $quantityPiece,
                        'total_weight' => $totalWeight,
                        'user_id' => auth()->user()->id,
                        'total_price' => $totalPrice,
                    ]);
                }

                // Update order status and total values
                $order->statuses()->sync([$request->status]);

                $order->total_price = $calculatedTotalPrice;
                $order->total_weight = $calculatedTotalWeight;
                $order->save();

                DB::commit();

                // Send Notification to all users about the new order creation
                $users = User::all(); // Get all users or you can filter specific users
                foreach ($users as $user) {
                    Notification::create([
                        'order_id' => $order->id,
                        'user_id' => $user->id,
                        'previous_status_name' => 'Yangi  Zakaz qabul qilindi',
                        'new_status_name' => 'Yangi  Zakaz qabul qilindi',
                        'is_read' => false,
                    ]);
                }

                // Load order with related data for response
                $orderWithDetails = $order->load('user', 'client', 'orderProducts.product', 'statuses');
                $orderWithDetails->turnover = $calculatedTotalPrice;

                return response()->json($orderWithDetails, 201);
            } catch (\Exception $e) {
                DB::rollBack();
                \Log::error('Order creation failed: ' . $e->getMessage());
                return response()->json(['message' => 'Order creation failed: ' . $e->getMessage()], 500);
            }
        }



// View order details
    public function show(Order $order)
    {
        // Load the necessary relationships
        $order->load('user', 'client', 'orderProducts.product');

        // Retrieve the first status ID or return null if no status is linked
        $status = $order->statuses()->pluck('statuses.id')->first();

        // Append the status as a single value to the order object
        $order->status = $status;

        // Remove the original `statuses` relationship from the output
        unset($order->statuses);

        return response()->json($order, 200);
    }



//    public function update(Request $request, $orderId)
//    {
//        // Validate the incoming request
//        $validated = $request->validate([
//            'client_id' => 'required|exists:customers,id',
//            'products' => 'required|array',
//            // Other validation rules as needed
//        ]);
//
//        // Start a database transaction
//        DB::beginTransaction();
//
//        try {
//            // Fetch the existing order
//            $order = Order::findOrFail($orderId);
//
//            // Update the order details
//            $order->update([
//                'client_id' => $request->client_id,
//                'total_price' => $request->total_price,
//                'total_weight' => $request->total_weight,
//                'order_status' => $request->order_status,
//                'car_number' => $request->car_number,
//            ]);
//
//            // Initialize an array to group products by product_id
//            $groupedProducts = [];
//
//            // Loop through each product and sum quantities by product_id
//            foreach ($request->products as $product) {
//                $productId = $product['product_id'];
//
//                if (!isset($groupedProducts[$productId])) {
//                    $groupedProducts[$productId] = [
//                        'quantity_pack' => 0,
//                        'quantity_piece' => 0
//                    ];
//                }
//
//                // Sum the quantities for the same product in the current request
//                $groupedProducts[$productId]['quantity_pack'] += $product['quantity_pack'];
//                $groupedProducts[$productId]['quantity_piece'] += $product['quantity_piece'];
//            }
//
//            // Process each grouped product and update stock
//            foreach ($groupedProducts as $productId => $quantities) {
//                $productModel = Product::find($productId);
//                if (!$productModel) {
//                    return response()->json(['message' => 'Product not found'], 404);
//                }
//
//                $quantityPochka = $quantities['quantity_pack'];
//                $quantityDona = $quantities['quantity_piece'];
//
//                // Handle stock deduction based on order type
//                if ($request->zayafka == 0) { // Actual order
//                    if ($quantityPochka > 0 && $productModel->total_packages < $quantityPochka) {
//                        return response()->json(['message' => 'Mahsulot identifikatori uchun zaxira yetarli emas ' . $productId . ' pochkalar'], 400);
//                    }
//
//                    if ($quantityDona > 0 && $productModel->total_units < $quantityDona) {
//                        return response()->json(['message' => 'Mahsulot identifikatori uchun zaxira yetarli emas' . $productId . ' dona'], 400);
//                    }
//
//                    // Deduct stock for actual orders
//                    $productModel->total_packages -= $quantityPochka;
//                    $productModel->total_units -= $quantityDona;
//                } else {
//                    // Zayafka: Deduct stock even if it goes negative
//                    $productModel->total_packages -= $quantityPochka;
//                    $productModel->total_units -= $quantityDona;
//                }
//
//                // Save the updated product stock
//                $productModel->save();
//
//                // Calculate total weight and price for the current request
//                $totalWeight = ($quantityPochka * $productModel->package_weight) + ($quantityDona * $productModel->weight_per_item);
//                $totalPrice = ($quantityPochka * $productModel->price_per_package) + ($quantityDona * $productModel->price_per_item);
//
//                // Update the existing order product or create a new one
//                $orderProduct = OrderProduct::updateOrCreate(
//                    [
//                        'order_id' => $order->id,
//                        'product_id' => $productId,
//                    ],
//                    [
//                        'quantity_pack' => $quantityPochka,
//                        'quantity_piece' => $quantityDona,
//                        'price_per_ton' => $productModel->price_per_ton,
//                        'price_per_unit' => $productModel->price_per_item,
//                        'total_weight' => $totalWeight,
//                        'total_price' => $totalPrice,
//                        'sold_by_user_id' => auth()->user()->id, // The seller ID
//                    ]
//                );
//            }
//
//            // Save statuses
//            $order->statuses()->sync($request->status); // Assuming status IDs are sent as an array
//
//            // Commit the transaction
//            DB::commit();
//
//            // Return the updated order with relationships
//            return response()->json($order->load('user', 'client', 'orderProducts.product', 'statuses'), 200);
//        } catch (\Exception $e) {
//            // Rollback the transaction if something failed
//            DB::rollBack();
//            \Log::error('Order update failed: ' . $e->getMessage());
//            return response()->json(['message' => 'Order update failed: ' . $e->getMessage()], 500);
//        }
//    }

    public function update(Request $request, $orderId)
    {
        // Validate the incoming request
        $validated = $request->validate([
            'client_id' => 'required|exists:customers,id',
            'products' => 'required|array',
            'status' => 'required|integer',
        ]);

        DB::beginTransaction();

        try {
            $calculatedTotalPrice = 0;
            $calculatedTotalWeight = 0;

            // Find the existing order
            $order = Order::find($orderId);
            if (!$order) {
                return response()->json(['message' => 'Order not found'], 404);
            }

            // Restore the original product quantities before update
            foreach ($order->orderProducts as $orderProduct) {
                $product = Product::find($orderProduct->product_id);
                if ($product) {
                    // Restore the quantities based on the original order
                    $product->total_packages += $orderProduct->quantity_pack;
                    $product->total_units += $orderProduct->quantity_piece;

                    if ($order->order_status == 1) { // If it was a reservation
                        $product->bron_package -= $orderProduct->quantity_pack;
                        $product->bron_one_pc -= $orderProduct->quantity_piece;
                    }

                    $product->save();
                }
            }

            // Remove existing order products to replace them with new data
            $order->orderProducts()->delete();

            // Update order details
            $order->update([
                'client_id' => $request->client_id,
                'car_number' => $request->car_number,
                'order_status' => $request->status,
            ]);

            // Group products to sum quantities of the same product
            $groupedProducts = [];

            foreach ($request->products as $product) {
                $productId = $product['product_id'];

                if (!isset($groupedProducts[$productId])) {
                    $groupedProducts[$productId] = [
                        'quantity_pack' => 0,
                        'quantity_piece' => 0
                    ];
                }

                $groupedProducts[$productId]['quantity_pack'] += $product['quantity_pack'];
                $groupedProducts[$productId]['quantity_piece'] += $product['quantity_piece'];
            }

            foreach ($groupedProducts as $productId => $quantities) {
                $productModel = Product::find($productId);
                if (!$productModel) {
                    return response()->json(['message' => 'Product not found'], 404);
                }

                $quantityPack = $quantities['quantity_pack'];
                $quantityPiece = $quantities['quantity_piece'];

                // Calculate weight and price for the current order item
                $weightForPack = $quantityPack * $productModel->package_weight;
                $weightForPiece = $quantityPiece * $productModel->weight_per_item;
                $totalWeight = $weightForPack + $weightForPiece;

                $priceForPack = $quantityPack * $productModel->price_per_package;
                $priceForPiece = $quantityPiece * $productModel->price_per_item;
                $totalPrice = $priceForPack + $priceForPiece;

                if ($request->status == 2) { // Regular order (status 2)
                    // Check if requested quantity exceeds available stock
                    if ($productModel->total_packages < $quantityPack) {
                        return response()->json(['message' => 'Insufficient stock for product ID ' . $productId . ' in packages'], 400);
                    }

                    if ($productModel->total_units < $quantityPiece) {
                        return response()->json(['message' => 'Insufficient stock for product ID ' . $productId . ' in units'], 400);
                    }

                    // Decrease stock for regular orders
                    $productModel->total_packages -= $quantityPack;
                    $productModel->total_units -= $quantityPiece;
                }

                if ($request->status == 1) { // Reservation (bron)
                    $remainingPackages = $productModel->total_packages - $quantityPack;
                    $remainingUnits = $productModel->total_units - $quantityPiece;

                    if ($remainingPackages < 0) {
                        $productModel->bron_package += abs($remainingPackages);
                        $productModel->total_packages = -abs($remainingPackages); // Set negative value
                    } else {
                        $productModel->total_packages = $remainingPackages;
                    }

                    if ($remainingUnits < 0) {
                        $productModel->bron_one_pc += abs($remainingUnits);
                        $productModel->total_units = -abs($remainingUnits); // Set negative value
                    } else {
                        $productModel->total_units = $remainingUnits;
                    }

                    $productModel->bron_package += $quantityPack;
                    $productModel->bron_one_pc += $quantityPiece;
                }

                $productModel->save();

                $calculatedTotalWeight += $totalWeight;
                $calculatedTotalPrice += $totalPrice;

                // Store updated order product details
                OrderProduct::create([
                    'order_id' => $order->id,
                    'product_id' => $productId,
                    'quantity_pack' => $quantityPack,
                    'quantity_piece' => $quantityPiece,
                    'price_per_ton' => $productModel->price_per_ton,
                    'price_per_unit' => $productModel->price_per_item,
                    'total_weight' => $totalWeight,
                    'total_price' => $totalPrice,
                    'sold_by_user_id' => auth()->user()->id,
                ]);
            }

            // Update order status and total values
            $order->statuses()->sync([$request->status]);

            $order->total_price = $calculatedTotalPrice;
            $order->total_weight = $calculatedTotalWeight;
            $order->save();

            DB::commit();

            // Load order with related data for response
            $orderWithDetails = $order->load('user', 'client', 'orderProducts.product', 'statuses');
            $orderWithDetails->turnover = $calculatedTotalPrice;

            return response()->json($orderWithDetails, 200);
        } catch (\Exception $e) {
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
                    'previous_status_name' => "Status o'zgardi ".$previousStatusName,
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
                $oldTotalItems = ($oldProduct->quantity_pochka * $productModel->total_packages) + $oldProduct->quantity_dona;
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
