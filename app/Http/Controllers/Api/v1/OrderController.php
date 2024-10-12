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

    // Create a new order
    public function store(Request $request)
    {
        // Validate the incoming request
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
            'status' => 'required|string|max:255'
        ]);

        // Start a database transaction
        DB::beginTransaction();

        try {
            // Create a new order
            $order = Order::create([
                'user_id' => auth()->user()->id,
                'client_id' => $request->client_id,
                'total_price' => $request->total_price,
                'total_weight' => $request->total_weight,
                'status' => $request->status,
            ]);

            // Add products to the order
            foreach ($request->products as $product) {
                // Fetch the product model
                $productModel = Product::find($product['product_id']);
                // Calculate total items sold
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
