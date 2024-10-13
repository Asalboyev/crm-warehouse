<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    // List all orders
    public function index()
    {
        $orders = Order::with(['user', 'client', 'orderProducts.product'])->get();
        return response()->json($orders, 200);
    }

    public function store(Request $request)
    {
        // Validate the incoming request
        $validated = $request->validate([
            'client_id' => 'required|exists:customers,id',
            'products' => 'required|array',
            'total_price' => 'required|numeric',
            'total_weight' => 'required|numeric',
            'status' => 'required|integer', // Assuming status is an integer
            'zayafka' => 'required|boolean', // Assuming zayafka is a boolean
            'car_number' => 'nullable|string', // Car number is optional
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
                'status' => $request->status,
                'zayafka' => $request->zayafka,
                'car_number' => $request->car_number,
            ]);

            // Process each product in the request
            foreach ($request->products as $product) {
                $productModel = Product::find($product['product_id']);
                if (!$productModel) {
                    return response()->json(['message' => 'Product not found'], 404);
                }

                // Handle stock deduction based on order type
                if ($request->zayafka == 0) { // Actual order
                    // Check stock availability
                    if ($product['quantity_pochka'] > 0) {
                        if ($productModel->items_per_package < $product['quantity_pochka']) {
                            return response()->json(['message' => 'Insufficient stock for product ID ' . $product['product_id'] . ' in packages'], 400);
                        }
                    }

                    if ($product['quantity_dona'] > 0) {
                        if ($productModel->total_units < $product['quantity_dona']) {
                            return response()->json(['message' => 'Insufficient stock for product ID ' . $product['product_id'] . ' in units'], 400);
                        }
                    }

                    // Deduct stock for actual orders
                    if ($product['quantity_pochka'] > 0) {
                        $productModel->items_per_package -= $product['quantity_pochka'];
                    }

                    if ($product['quantity_dona'] > 0) {
                        $productModel->total_units -= $product['quantity_dona'];
                    }
                } else { // Zayafka
                    // Deduct stock even if it goes negative
                    if ($product['quantity_pochka'] > 0) {
                        $productModel->items_per_package -= $product['quantity_pochka'];
                    }

                    if ($product['quantity_dona'] > 0) {
                        $productModel->total_units -= $product['quantity_dona'];
                    }
                }

                // Update the product's times sold
                $totalSold = $product['quantity_pochka'] + $product['quantity_dona']; // Sum of packages and units
                $timesSold = OrderProduct::where('product_id', $product['product_id'])->sum('quantity_pochka') + OrderProduct::where('product_id', $product['product_id'])->sum('quantity_dona') + $totalSold;

                // Save the updated product
                $productModel->save();

                // Calculate total weight and price
                $totalWeight = ($product['quantity_pochka'] * $productModel->package_weight) + ($product['quantity_dona'] * $productModel->weight_per_item);
                $totalPrice = ($product['quantity_pochka'] * $productModel->price_per_package) + ($product['quantity_dona'] * $productModel->price_per_item);

                // Store the order product details with the correct `times_sold` increment
                OrderProduct::create([
                    'order_id' => $order->id,
                    'product_id' => $product['product_id'],
                    'quantity_pochka' => $product['quantity_pochka'],
                    'quantity_dona' => $product['quantity_dona'],
                    'price_per_ton' => $productModel->price_per_ton,
                    'price_per_unit' => $productModel->price_per_item,
                    'total_weight' => $totalWeight,
                    'total_price' => $totalPrice,
                    'times_sold' => $timesSold,
                    'sold_by_user_id' => auth()->user()->id, // The seller ID
                ]);
            }

            // Commit the transaction
            DB::commit();

            // Return the created order with relationships
            return response()->json($order->load('user', 'client', 'orderProducts.product'), 201);
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

    // Update an existing order
    public function update(Request $request, Order $order)
    {
        $validated = $request->validate([
            'client_id' => 'required|exists:customers,id',
            'products' => 'required|array',
            'products.*.product_id' => 'required|exists:products,id',
            'products.*.quantity_pochka' => 'required|integer|min:0', // Packages
            'products.*.quantity_dona' => 'required|integer|min:0', // Individual items
            'products.*.price_per_item' => 'required|numeric|min:0',
            'products.*.total_weight' => 'required|numeric|min:0',
            'products.*.total_price' => 'required|numeric|min:0',
            'total_price' => 'required|numeric|min:0',
            'total_weight' => 'required|numeric|min:0',
        ]);

        // Start a database transaction
        DB::beginTransaction();

        try {
            // Update the order
            $order->update([
                'client_id' => $request->client_id,
                'total_price' => $request->total_price,
                'total_weight' => $request->total_weight,
            ]);

            // Restore old product quantities
            foreach ($order->orderProducts as $oldProduct) {
                $productModel = Product::find($oldProduct->product_id);
                $oldTotalItems = ($oldProduct->quantity_pochka * $productModel->items_per_package) + $oldProduct->quantity_dona;
                $productModel->quantity += $oldTotalItems;
                $productModel->save();
            }

            // Remove old products
            $order->orderProducts()->delete();

            // Add new order products
            foreach ($request->products as $product) {
                $productModel = Product::find($product['product_id']);
                $totalItemsSold = ($product['quantity_pochka'] * $productModel->items_per_package) + $product['quantity_dona'];

                // Check remaining stock
                if ($productModel->quantity < $totalItemsSold) {
                    return response()->json(['message' => 'Insufficient stock for product ID: ' . $product['product_id']], 400);
                }

                // Update product quantity
                $productModel->quantity -= $totalItemsSold;
                $productModel->save();

                // Create order product entry
                OrderProduct::create([
                    'order_id' => $order->id,
                    'product_id' => $product['product_id'],
                    'quantity_pochka' => $product['quantity_pochka'],
                    'quantity_dona' => $product['quantity_dona'],
                    'price_per_item' => $product['price_per_item'],
                    'total_weight' => $product['total_weight'],
                    'total_price' => $product['total_price'],
                ]);
            }

            // Commit the transaction
            DB::commit();

            return response()->json($order->load('user', 'client', 'orderProducts.product'), 200);
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
