<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\Category;

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


    // Store a new product
    public function store(Request $request)
    {

        $product = Product::create($request->all());

        return response()->json(['message' => 'Product created successfully', 'product' => $product]);
    }

    // View product details (with stock and pricing)
    public function show($id)
    {
        $product = Product::findOrFail($id);
        return view('product.show', compact('product'));
    }

    // Add packages to stock
    public function addPackage(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        // Add the number of packages and recalculate total weight
        $product->total_packages += $request->input('package_count');
        $product->total_weight += $request->input('package_count') * $product->package_weight;

        $product->save();

        return response()->json(['message' => 'Packages added', 'product' => $product]);
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
