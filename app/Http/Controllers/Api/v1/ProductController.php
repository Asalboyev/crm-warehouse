<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\Category;

class ProductController extends Controller
{
    // Fetch products with search and category filters
    public function index(Request $request)
    {
        $search = $request->input('search');
        $category_id = $request->input('category_id'); // Get the selected category

        // Fetch categories to display in the dropdown
        $categories = Category::all();

        // Query products and apply filters
        $products = Product::query()
            ->when($search, function ($query, $search) {
                return $query->where('product_name', 'like', "%{$search}%");
            })
            ->when($category_id, function ($query, $category_id) {
                // Filter products by the selected category
                return $query->where('category_id', $category_id);
            })
            ->latest()
            ->paginate(10);

        return response()->json(compact('products', 'categories', 'search', 'category_id'));
    }

    // View product details (with stock and pricing)
    public function show($id)
    {
        $product = Product::findOrFail($id);
        return response()->json(compact('product'));
    }

    // Add packages to stock
    public function addPackage(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        // Add the number of packages and recalculate total weight
        $product->items_per_package += $request->input('items_per_package');
        $product->total_units += $request->input('total_units');
        $product->total_packages += $request->input('total_packages');
        $product->total_weight += $request->input('total_weight');
//        $product->total_weight += $request->input('package_count') * $product->package_weight;

        $product->save();

        return response()->json(['message' => 'Packages added', 'product' => $product]);
    }

    // Update product prices
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