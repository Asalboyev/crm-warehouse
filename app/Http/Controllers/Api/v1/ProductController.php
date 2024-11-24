<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Turnover;
use App\Models\OrderProduct;

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
            ->with('photos')
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
        // Retrieve categories
        $categories = Category::all();

        // Retrieve product by ID
        $product = Product::find($id);
        if (!$product) {
            return response()->json(['error' => 'Mahsulot topilmadi!'], 404);
        }

        // Retrieve sales details related to the product
        $salesDetails = OrderProduct::with(['order.user', 'order.client'])
            ->where('product_id', $id)
            ->get()
            ->map(function ($orderProduct) {
                $order = $orderProduct->order;

                return [
                    'order_id' => $order ? $order->id : null,
                    'sold_to_id' => $order ? optional($order->client)->id : null,
                    'sold_to' => $order ? optional($order->client)->name : 'Ma\'lumot yo\'q',
                    'sold_to_phone' => $order ? optional($order->client)->phone : 'Ma\'lumot yo\'q',
                    'sold_by_id' => $order ? optional($order->user)->id : null,
                    'sold_by' => $order ? optional($order->user)->name : 'Ma\'lumot yo\'q',
                    'sold_by_phone' => $order ? optional($order->user)->email : 'Ma\'lumot yo\'q',
                    'times_sold' => $orderProduct->times_sold,
                    'quantity_pack' => $orderProduct->quantity_pack,
                    'quantity_piece' => $orderProduct->quantity_piece,
                    'total_quantity' => $orderProduct->quantity_pack + $orderProduct->quantity_piece,
                    'total_weight' => $orderProduct->total_weight,
                    'total_price' => $orderProduct->total_price,
                    'price_per_ton' => $orderProduct->price_per_ton,
                    'price_per_unit' => $orderProduct->price_per_unit,
                ];
            });

        // Retrieve turnover details related to the product
        $turnoverDetails = Turnover::where('product_id', $id)
            ->with('user')
            ->get()
            ->map(function ($turnover) {
                return [
                    'type' => $turnover->type,
                    'date' => $turnover->created_at->format('Y-m-d'),
                    'quantity_pack' => $turnover->quantity_pack,
                    'quantity_piece' => $turnover->quantity_piece,
                    'total_weight' => $turnover->total_weight,
                    'user_name' => $turnover->user->name ?? 'Ma\'lumot yo\'q',
                ];
            });

        // Return response as JSON with product, categories, sales details, and turnover details
        return response()->json([
            'product' => $product,
            'categories' => $categories,
            'sales_details' => $salesDetails,
            'turnover_details' => $turnoverDetails,
        ]);
    }

    public function getSklad($id)
    {

        try {
            // Find the product by ID
            $product = Product::find($id);

            // If product not found, return a 404 response
            if (!$product) {
                return response()->json(['message' => 'Product not found'], 404);
            }

            // Return the stock details (sklad) of the product
            return response()->json([
                'product_id' => $product->id,
                'name' => $product->name,
                'available_stock_pochka' => $product->items_per_package, // Stock for pochka
                'available_stock_dona' => $product->total_units, // Stock for individual units (dona)
                'bron_package' => $product->bron_package, // Reserved pochka
                'bron_one_pc' => $product->bron_one_pc, // Reserved individual units
                'price_per_package' => $product->price_per_package,
                'price_per_item' => $product->price_per_item,
                'price_per_ton' => $product->price_per_ton,
            ], 200);
        } catch (\Exception $e) {
            // Log the error and return a 500 response
            \Log::error('Failed to retrieve product stock: ' . $e->getMessage());
            return response()->json(['message' => 'Failed to retrieve product stock: ' . $e->getMessage()], 500);
        }
    }

    // Add packages to stock
//    public function addPackage(Request $request, $id)
//    {
//        $product = Product::findOrFail($id);
//
//        // Add the number of packages and recalculate total weight
//        $product->items_per_package += $request->input('items_per_package');
//        $product->total_units += $request->input('total_units');
//        $product->total_packages += $request->input('total_packages');
//        $product->total_weight += $request->input('total_weight');
////        $product->total_weight += $request->input('package_count') * $product->package_weight;
//
//        $product->save();
//
//        return response()->json(['message' => 'Packages added', 'product' => $product]);
//    }
    public function addPackage(Request $request, $id)
    {
        // Validate incoming request for adding packages and units
        $validated = $request->validate([
            'total_packages' => 'nullable|integer|min:0', // Allow adding packages
            'total_units' => 'nullable|integer|min:0', // Allow adding individual units
        ]);

        // Find the product by ID
        $product = Product::findOrFail($id);

        // Add the new values to the existing package and unit counts
        $newItemsPerPackage = $validated['total_packages'] ?? 0;
        $newTotalUnits = $validated['total_units'] ?? 0;

        // Update the product's total packages and units
        $product->total_packages += $newItemsPerPackage;
        $product->total_units += $newTotalUnits;

        // Calculate the new total weight:
        // Total weight = (total number of packages * weight per package) + (total individual units * weight per unit)
        $newTotalWeight = ($product->total_packages * $product->package_weight)
            + ($product->total_units * $product->weight_per_item);

        // Update total_weight for the product
        $product->total_weight = $newTotalWeight;

        // Save the updated product information
        $product->save();

        // Log turnover for 'kirim' (incoming stock) type if there are additions
        Turnover::create([
            'product_id' => $product->id,
            'user_id' => auth()->id(),
            'type' => 'kirim', // Type 'kirim' for added stock
            'quantity_pack' => $newItemsPerPackage, // Quantity of packages added
            'quantity_piece' => $newTotalUnits, // Quantity of individual units added
            'total_weight' => $newTotalWeight, // Weight for added stock only
        ]);

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
    public function addPhotos(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        // Validate that up to 15 images are uploaded
        $request->validate([
            'photos' => 'required|array|max:15', // Maximum 15 images
            'photos.*' => 'image|mimes:jpeg,png,jpg,webp|max:2048', // Validate each image (max size: 2MB)
        ]);

        $uploadedPhotos = [];

        if ($request->hasFile('photos')) {
            foreach ($request->file('photos') as $photo) {
                $path = $photo->store('product-photos', 'public'); // Save each photo to 'storage/app/public/product-photos'

                // Save photo path to the database
                $productPhoto = $product->photos()->create([
                    'photo_path' => $path,
                ]);

                $uploadedPhotos[] = $productPhoto; // Add the photo model to the response array
            }
        }

        return response()->json([
            'message' => 'Photos uploaded successfully',
            'uploaded_photos' => $uploadedPhotos,
            'product' => $product->load('photos'), // Load the product with its photos
        ]);
    }
    public function deletePhoto($photoId)
    {
        $photo = ProductPhoto::findOrFail($photoId);

        // Delete the file from storage
        Storage::disk('public')->delete($photo->photo_path);

        // Delete the record from the database
        $photo->delete();

        return response()->json([
            'message' => 'Photo deleted successfully',
        ]);
    }


}
