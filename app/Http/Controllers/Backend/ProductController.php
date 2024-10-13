<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\OrderProduct;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $category_id = $request->input('category_id'); // Get the selected category

        // Fetch categories to display in the dropdown
        $categories = Category::all();

        // Query products and apply filters
        $products = Product::query()
            ->when($search, function ($query, $search) {
                return $query->where('product_name', 'like', "%{$search}%")
                    ->orWhere('phone', 'like', "%{$search}%");
            })
            ->when($category_id, function ($query, $category_id) {
                // Filter products by the selected category
                return $query->where('category_id', $category_id);
            })
            ->latest()
            ->paginate(10);

        return view('admin.product.index', compact('products', 'categories', 'search', 'category_id'));
    }
    public function create()
    {
        $categories = Category::query()->get();
        return view('admin.product.create', compact('categories'));
    }


    public function store(Request $request)
    {
        // Preprocess the input to replace commas with dots for numeric fields
        $input = $request->all();
        $input['price_per_ton'] = str_replace(',', '.', $input['price_per_ton']);
        $input['length_per_ton'] = str_replace(',', '.', $input['length_per_ton']);
        $input['price_per_meter'] = str_replace(',', '.', $input['price_per_meter']);
        $input['price_per_item'] = str_replace(',', '.', $input['price_per_item']);
        $input['price_per_package'] = str_replace(',', '.', $input['price_per_package']);
        $input['items_per_package'] = str_replace(',', '.', $input['items_per_package']);
        $input['package_weight'] = str_replace(',', '.', $input['package_weight']);
        $input['package_length'] = str_replace(',', '.', $input['package_length']);
        $input['weight_per_item'] = str_replace(',', '.', $input['weight_per_item']);

        // Validate the data
        $validatedData = $request->validate([
            'product_name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'country' => 'required|string|max:255',
            'thickness' => 'required|numeric',
            'length' => 'required|numeric',
            'metal_type' => 'required|string|max:50',
            'price_per_ton' => 'required|numeric',
            'length_per_ton' => 'required|numeric',
            'price_per_meter' => 'required|numeric',
            'price_per_item' => 'required|numeric',
            'price_per_package' => 'required|numeric',
            'items_per_package' => 'required|numeric', // Poshka ichidagi donalar soni
            'package_weight' => 'required|numeric',
            'package_length' => 'required|numeric',
            'weight_per_meter' => 'required|numeric',
            'weight_per_item' => 'required|numeric',
        ]);

        // Umumiy donalar sonini hisoblash
        $total_units = $validatedData['items_per_package']; // Faqat bitta poshka qo'shilsa
        if (isset($input['packages_count'])) {
            $total_units *= $input['packages_count']; // Faqat poshkalar soni bo'yicha ko'paytirish
        } else {
            $total_units = $validatedData['items_per_package']; // Poshkalar kiritilmagan bo'lsa, alohida bo'ladi
        }

        // Yangi mahsulot ma'lumotlariga total_units ni qo'shamiz
        $validatedData['total_units'] = $total_units;

        // Store the product in the database
        Product::create($validatedData);

        return redirect()->route('product.index')->with('message', 'Product created successfully!');
    }

    public function show($id)
    {
        // Fetch all categories
        $categories = Category::query()->get();

        // Fetch the product by ID
        $product = Product::find($id);
        if (!$product) {
            return redirect()->route('product.index')->with('error', 'Product not found!');
        }

        // Fetch sales details for the specific product
        $salesDetails = OrderProduct::with(['order.user', 'order.client'])
            ->where('product_id', $id)
            ->get()
            ->map(function ($orderProduct) {
                // Check if the order exists
                $order = $orderProduct->order;

                return [
                    'order_id' => $order ? $order->id : null, // Include order ID
                    'sold_to_id' => $order ? optional($order->client)->id : null, // Client ID
                    'sold_to' => $order ? optional($order->client)->name : 'N/A', // Client name, default to 'N/A'
                    'sold_to_phone' => $order ? optional($order->client)->phone : 'N/A', // Client phone, default to 'N/A'
                    'sold_by_id' => $order ? optional($order->user)->id : null,   // Seller ID
                    'sold_by' => $order ? optional($order->user)->name : 'N/A',   // Seller name, default to 'N/A'
                    'sold_by_phone' => $order ? optional($order->user)->email : 'N/A', // Seller phone, default to 'N/A'
                    'times_sold' => $orderProduct->times_sold,
                    'quantity_pochka' => $orderProduct->quantity_pochka,
                    'quantity_dona' => $orderProduct->quantity_dona,
                    'total_quantity' => $orderProduct->quantity_pochka + $orderProduct->quantity_dona, // Total quantity sold
                ];
            });

        // Pass the product and sales details to the view
        return view('admin.product.show', compact('product', 'categories', 'salesDetails'));
    }


// View product details (with stock and pricing)


    // Add packages to stock
//    public function addPackage(Request $request, $id)
//    {
//        $product = Product::findOrFail($id);
//
//        // items_per_package is updated directly with user input
//        $product->items_per_package = $request->input('items_per_package');
//
//        // total_units is updated with user input, no automatic calculation
//        $product->total_units = $request->input('total_units');
//
//        // Other fields are updated as usual
//        $product->total_packages += $request->input('total_packages');
//        $product->total_weight += $request->input('total_weight');
//
//        $product->save();
//
//        return redirect()->route('product.index')->with('message', 'Mahsulot qoldiqlar qoshildi');
//    }




    public function edit($id)
    {
        $categories = Category::query()->get();
        $product = Product::find($id);
        if (!$product) {
            return redirect()->route('product.index')->with('error', 'Product not found!');
        }
        return view('admin.product.edit', compact('product','categories'));
    }


    public function update(Request $request, $id)
    {
        $product = Product::find($id);
        if (!$product) {
            return redirect()->route('product.index')->with('error', 'Product not found!');
        }

        // Preprocess numeric inputs to replace commas with dots
        $input = $request->all();
        $input['price_per_ton'] = str_replace(',', '.', $input['price_per_ton']);
        $input['length_per_ton'] = str_replace(',', '.', $input['length_per_ton']);
        $input['price_per_meter'] = str_replace(',', '.', $input['price_per_meter']);
        $input['price_per_item'] = str_replace(',', '.', $input['price_per_item']);
        $input['price_per_package'] = str_replace(',', '.', $input['price_per_package']);
        $input['items_per_package'] = str_replace(',', '.', $input['items_per_package']);
        $input['package_weight'] = str_replace(',', '.', $input['package_weight']);
        $input['package_length'] = str_replace(',', '.', $input['package_length']);
        $input['weight_per_item'] = str_replace(',', '.', $input['weight_per_item']);

        // Validate the data
        $validatedData = $request->validate([
            'product_name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'country' => 'required|string|max:255',
            'thickness' => 'required|numeric',
            'length' => 'required|numeric',
            'metal_type' => 'required|string|max:50',
            'price_per_ton' => 'required|numeric',
            'length_per_ton' => 'required|numeric',
            'price_per_meter' => 'required|numeric',
            'price_per_item' => 'required|numeric',
            'price_per_package' => 'required|numeric',
            'items_per_package' => 'required|numeric',
            'package_weight' => 'required|numeric',
            'package_length' => 'required|numeric',
            'weight_per_meter' => 'required|numeric',
            'weight_per_item' => 'required|numeric',

        ]);

        // Update the product in the database
        $product->update($validatedData);

        return redirect()->route('product.index')->with('message', 'Product updated successfully!');
    }    // Delete an existing product from the database
    public function destroy($id)
    {
        $product = Product::find($id);
        if (!$product) {
            return redirect()->route('product.index')->with('error', 'Product not found!');
        }

        $product->delete();
        return redirect()->route('product.index')->with('message', 'Product deleted successfully!');
    }

    // Add individual items (outside packages) to stock
    public function addItem(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        // Add individual items and update total weight
        $itemsToAdd = $request->input('items_count');
        $product->items_in_package += $itemsToAdd;
        $product->total_weight += $itemsToAdd * $product->weight_per_meter;

        $product->save();

        return response()->json(['message' => 'Items added', 'product' => $product]);
    }

    // Edit product prices dynamically
    public function updatePrice(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $product->price_per_ton = $request->input('price_per_ton', $product->price_per_ton);
        $product->price_per_meter = $request->input('price_per_meter', $product->price_per_meter);
        $product->price_per_item = $request->input('price_per_item', $product->price_per_item);
        $product->price_per_package = $request->input('price_per_package', $product->price_per_package);

        $product->save();

        return response()->json(['message' => 'Price updated', 'product' => $product]);
    }
}
