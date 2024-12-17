<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\OrderProduct;
use App\Models\Turnover;
use Illuminate\Support\Facades\DB;


class ProductController extends Controller
{


//    public function index(Request $request)
//    {
//        $search = $request->input('search');
//        $category_id = $request->input('category_id');
//
//        // Fetch categories to display in the dropdown
//        $categories = Category::all();
//
//        // Query products and apply filters directly
//        $productsQuery = DB::table('products')
//            ->select('*') // Select all fields
//            ->when($search, function ($query, $search) {
//                return $query->where('product_name', 'like', "%{$search}%")
//                    ->orWhere('phone', 'like', "%{$search}%");
//            })
//            ->when($category_id, function ($query, $category_id) {
//                return $query->where('category_id', $category_id);
//            })
//            ->orderByDesc('created_at');
//
//        // Fetch the products
//        $products = $productsQuery->paginate(10)->appends(['search' => $search, 'category_id' => $category_id]);
//
//        // Format price_per_ton to always show 2 decimal places, without converting it into a string
//        $products->getCollection()->transform(function ($product) {
//            $product->price_per_ton = round($product->price_per_ton, 2); // Round to 2 decimals but keep numeric type
//            return $product;
//        });
////return $products;
//        return view('admin.product.index', compact('products', 'categories', 'search', 'category_id'));
//    }

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
            ->paginate(10)
            ->appends(['search' => $search, 'category_id' => $category_id]); // Retain search and filters in pagination

        return view('admin.product.index', compact('products', 'categories', 'search', 'category_id'));
    }
    public function create()
    {
        $categories = Category::query()->get();
        return view('admin.product.create', compact('categories'));
    }

//    public function store(Request $request)
//    {
//        // Preprocess the input to replace commas with dots for numeric fields
//        $input = $request->all();
//        $fieldsToConvert = [
//            'price_per_ton', 'length_per_ton', 'price_per_meter',
//            'price_per_item', 'price_per_package', 'total_packages',
//            'package_weight', 'package_length', 'weight_per_item', 'weight_per_meter'
//        ];
//
//        foreach ($fieldsToConvert as $field) {
//            if (isset($input[$field])) {
//                $input[$field] = str_replace(',', '.', $input[$field]);
//            }
//        }
//
//        // Validate the data
//        $validatedData = $request->validate([
//            'product_name' => 'required|string|max:255',
//            'category_id' => 'required|exists:categories,id',
//            'country' => 'required|string|max:255',
//            'thickness' => 'required|numeric',
//            'length' => 'required|numeric',
//            'metal_type' => 'required|string|max:50',
//            'price_per_ton' => 'required|numeric',
//            'length_per_ton' => 'required|numeric',
//            'price_per_meter' => 'required|numeric',
//            'price_per_item' => 'required|numeric',
//            'price_per_package' => 'required|numeric',
//            'total_packages' => 'required|numeric',
//            'package_weight' => 'required|numeric',
//            'package_length' => 'required|numeric',
//            'weight_per_meter' => 'required|numeric',
//        ]);
//
//        // Set items_per_package to 0 if it's not provided in the request
//        $validatedData['items_per_package'] = $input['items_per_package'] ?? 0;
//
//        // Calculate the weight per item in tons if items_per_package is provided and greater than zero
//        if ($validatedData['items_per_package'] > 0 && $validatedData['package_weight'] > 0) {
//            $validatedData['weight_per_item'] = number_format($validatedData['package_weight'] / $validatedData['items_per_package'], 6, '.', '');
//        } else {
//            $validatedData['weight_per_item'] = '0.000000'; // Set to zero with fixed precision if items_per_package or package_weight is zero or missing
//        }
//
//        // Calculate the total units (total items across all packages)
//        $total_units = $validatedData['total_packages'];
//
//        if (!empty($input['packages_count'])) {
//            // If package count is provided, calculate total units
//            $total_units *= $input['packages_count'];
//        }
//
//        // Add total units to validated data
//        $validatedData['total_units'] = $total_units;
//
//        // Store the product in the database
//        Product::create($validatedData);
//
//        // Redirect back with success message
//        return redirect()->route('product.index')->with('message', 'Product created successfully!');
//    }


//    public function store(Request $request)
//    {
//        // Preprocess the input to replace commas with dots for numeric fields
//        $input = $request->all();
//        dd($input);
//        $fieldsToConvert = [
//            'price_per_ton', 'length_per_ton', 'price_per_meter',
//            'price_per_item', 'price_per_package', 'package_weight',
//            'package_length', 'weight_per_meter'
//        ];
//
//        foreach ($fieldsToConvert as $field) {
//            if (isset($input[$field])) {
//                $input[$field] = str_replace(',', '.', $input[$field]);
//            }
//        }
//
//        // Validate the data
//        $validatedData = $request->validate([
//            'product_name' => 'required|string|max:255',
//            'category_id' => 'required|exists:categories,id',
//            'country' => 'required|string|max:255',
//            'thickness' => 'required|numeric',
//            'length' => 'required|numeric',
//            'metal_type' => 'required|string|max:50',
//            'price_per_ton' => 'required|numeric',
//            'length_per_ton' => 'required|numeric',
//            'price_per_meter' => 'required|numeric',
//            'price_per_item' => 'required|numeric',
//            'price_per_package' => 'required|numeric',
//            'items_per_package' => 'required|integer',
//            'package_weight' => 'required|numeric',
//            'package_length' => 'required|numeric',
//            'weight_per_meter' => 'required|numeric',
//        ]);
//
//        // Calculate the weight per item if items_per_package and package_weight are provided
//        if ($validatedData['package_weight'] > 0 && $validatedData['items_per_package'] > 0) {
//            $validatedData['weight_per_item'] = bcdiv($validatedData['package_weight'], $validatedData['items_per_package'], 6); // Calculate with 6 decimal places
//        } else {
//            $validatedData['weight_per_item'] = 0; // Set to zero if items_per_package or package_weight is zero or missing
//        }
//
//        // Calculate total units based on total packages if provided
//        if (!empty($input['total_packages'])) {
//            $validatedData['total_units'] = $validatedData['items_per_package'] * $input['total_packages'];
//        } else {
//            $validatedData['total_units'] = $validatedData['items_per_package']; // Default to items per package if no total packages are specified
//        }
//
//        // Store the product in the database
//        Product::create($validatedData);
//
//        // Redirect back with success message
//        return redirect()->route('product.index')->with('message', 'Product created successfully!');
//    }


    // public function store(Request $request)
    // {
    //     // Preprocess the input to replace commas with dots for numeric fields
    //     $input = $request->all();
    //     $fieldsToConvert = [
    //         'price_per_ton', 'length_per_ton', 'price_per_meter',
    //         'price_per_item', 'price_per_package', 'package_weight',
    //         'package_length', 'weight_per_meter'
    //     ];

    //     foreach ($fieldsToConvert as $field) {
    //         if (isset($input[$field])) {
    //             $input[$field] = str_replace(',', '.', $input[$field]);
    //         }
    //     }

    //     // Validate the data
    //     $validatedData = $request->validate([
    //         'product_name' => 'required|string|max:255',
    //         'category_id' => 'required|exists:categories,id',
    //         'country' => 'required|string|max:255',
    //         'thickness' => 'required|numeric',
    //         'length' => 'required|numeric',
    //         'metal_type' => 'required|string|max:50',
    //         'price_per_ton' => 'required|numeric',
    //         'length_per_ton' => 'required|numeric',
    //         'price_per_meter' => 'required|numeric',
    //         'price_per_item' => 'required|numeric',
    //         'price_per_package' => 'required|numeric',
    //         'items_per_package' => 'required|integer',
    //         'package_weight' => 'required|numeric',
    //         'package_length' => 'required|numeric',
    //         'weight_per_meter' => 'required|numeric',
    //     ]);

    //     // Calculate the weight per item in tons
    //     if ($validatedData['package_weight'] > 0 && $validatedData['items_per_package'] > 0) {
    //         $validatedData['weight_per_item'] = $validatedData['package_weight'] / $validatedData['items_per_package'];
    //     } else {
    //         $validatedData['weight_per_item'] = 0;
    //     }

    //     // Format weight_per_item to six decimal places
    //     $validatedData['weight_per_item'] = number_format($validatedData['weight_per_item'], 6, '.', '');

    //     // Set default values for total_units and total_packages
    //     $validatedData['total_units'] = 0;
    //     $validatedData['total_packages'] = 5; // Set total_packages to 5 by default

    //     // Store the product in the database
    //     Product::create($validatedData);

    //     // Redirect back with success message
    //     return redirect()->route('product.index')->with('message', 'Product created successfully!');
    // }
    public function store(Request $request)
{
    // Preprocess the input to replace commas with dots for numeric fields
    $input = $request->all();
    $fieldsToConvert = [
        'price_per_ton', 'length_per_ton', 'price_per_meter',
        'price_per_item', 'price_per_package', 'package_weight',
        'package_length', 'weight_per_meter'
    ];

    foreach ($fieldsToConvert as $field) {
        if (isset($input[$field])) {
            $input[$field] = str_replace(',', '.', $input[$field]);
        }
    }

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
        'items_per_package' => 'required|integer',
        'package_weight' => 'required|numeric',
        'package_length' => 'required|numeric',
        'weight_per_meter' => 'required|numeric',
    ]);

    // Calculate the weight per item in tons (NO FORMATTING)
    if ($validatedData['package_weight'] > 0 && $validatedData['items_per_package'] > 0) {
        $validatedData['weight_per_item'] = $validatedData['package_weight'] / $validatedData['items_per_package'];
    } else {
        $validatedData['weight_per_item'] = 0;
    }

    // Calculate weight per meter
    if ($validatedData['weight_per_item'] > 0 && $validatedData['length'] > 0) {
        $validatedData['weight_per_meter'] = $validatedData['weight_per_item'] / $validatedData['length'];
    } else {
        $validatedData['weight_per_meter'] = 0;
    }

    // Set default values for total_units and total_packages
    $validatedData['total_units'] = 0;
    $validatedData['total_packages'] = 5; // Set total_packages to 5 by default

    // Store the product in the database
    Product::create($validatedData);

    // Redirect back with success message
    return redirect()->route('product.index')->with('message', 'Product created successfully!');
}





//    public function show($id)
//    {
//        // Fetch all categories
//        $categories = Category::query()->get();
//
//        // Fetch the product by ID
//        $product = Product::find($id);
//        if (!$product) {
//            return redirect()->route('product.index')->with('error', 'Product not found!');
//        }
//
//        // Fetch sales details for the specific product
//        $salesDetails = OrderProduct::with(['order.user', 'order.client'])
//            ->where('product_id', $id)
//            ->get()
//            ->map(function ($orderProduct) {
//                // Check if the order exists
//                $order = $orderProduct->order;
//
//                return [
//                    'order_id' => $order ? $order->id : null, // Include order ID
//                    'sold_to_id' => $order ? optional($order->client)->id : null, // Client ID
//                    'sold_to' => $order ? optional($order->client)->name : 'N/A', // Client name, default to 'N/A'
//                    'sold_to_phone' => $order ? optional($order->client)->phone : 'N/A', // Client phone, default to 'N/A'
//                    'sold_by_id' => $order ? optional($order->user)->id : null,   // Seller ID
//                    'sold_by' => $order ? optional($order->user)->name : 'N/A',   // Seller name, default to 'N/A'
//                    'sold_by_phone' => $order ? optional($order->user)->email : 'N/A', // Seller phone, default to 'N/A'
//                    'times_sold' => $orderProduct->times_sold,
//                    'quantity_pochka' => $orderProduct->quantity_pochka,
//                    'quantity_dona' => $orderProduct->quantity_dona,
//                    'total_quantity' => $orderProduct->quantity_pochka + $orderProduct->quantity_dona, // Total quantity sold
//                ];
//            });
//
//        // Pass the product and sales details to the view
//        return view('admin.product.show', compact('product', 'categories', 'salesDetails'));
//    }

    public function show($id)
    {
        // Kategoriyalarni olish
        $categories = Category::query()->get();

        // Mahsulotni ID orqali olish
        $product = Product::find($id);
        if (!$product) {
            return redirect()->route('product.index')->with('error', 'Mahsulot topilmadi!');
        }

        // Mahsulotning savdo tafsilotlarini olish
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

        // Mahsulotning aylanma tafsilotlarini olish
        $turnoverDetails = Turnover::where('product_id', $id)->with('user')->get()->map(function ($turnover) {
            return [
                'type' => $turnover->type,
                'date' => $turnover->created_at->format('Y-m-d'),
                'quantity_pack' => $turnover->quantity_pack,
                'quantity_piece' => $turnover->quantity_piece,
                'total_weight' => $turnover->total_weight,
                'user_name' => $turnover->user->name ?? 'Ma\'lumot yo\'q',
            ];
        });

        // Mahsulot va savdo tafsilotlarini ko'rinishga uzatish
        return view('admin.product.show', compact('product', 'categories', 'salesDetails', 'turnoverDetails'));
    }


// View product details (with stock and pricing)


    // Add packages to stock
//    public function addPackage(Request $request, $id)
//    {
//        $product = Product::findOrFail($id);
//
//        // Update stock information
//        $product->items_per_package += $request->input('items_per_package');
//        $product->total_units += $request->input('total_units');
//        $product->total_packages += $request->input('total_packages');
//        $product->total_weight += $request->input('total_weight');
//        $product->save();
//
//        // Log turnover for 'kirim' (incoming) type
//        Turnover::create([
//            'product_id' => $product->id,
//            'user_id' => auth()->id(),
//            'type' => 'kirim', // 'kirim' for incoming stock
//            'quantity_pack' => $request->input('items_per_package'),
//            'quantity_piece' => $request->input('total_units'),
//            'total_weight' => $request->input('total_weight'),
//        ]);
//        return redirect()->route('product.index')->with('message', 'Mahsulot qoldiqlar qoshildi');
//    }
//    public function addPackage(Request $request, $id)
//    {
//        // Validate incoming request
//        $validated = $request->validate([
//            'items_per_package' => 'required|integer|min:0', // Allow zero if no packages are added
//            'total_units' => 'required|integer|min:0', // Allow zero if no units are added
//            'total_packages' => 'required|integer|min:0', // Allow zero if no packages are added
//            'total_weight' => 'required|numeric|min:0', // Allow zero if no weight is added
//        ]);
//
//        // Find the product
//        $product = Product::findOrFail($id);
//
//        // Update stock information directly by adding the new quantities
//        $product->items_per_package += $validated['items_per_package'];
//        $product->total_units += $validated['total_units'];
//        $product->total_packages += $validated['total_packages'];
//        $product->total_weight += $validated['total_weight'];
//        $product->save();
//
//        // Log turnover for 'kirim' (incoming) type
//        Turnover::create([
//            'product_id' => $product->id,
//            'user_id' => auth()->id(),
//            'type' => 'kirim', // 'kirim' for incoming stock
//            'quantity_pack' => $validated['items_per_package'], // Quantity of packages added
//            'quantity_piece' => $validated['total_units'], // Quantity of individual units added
//            'total_weight' => $validated['total_weight'], // Total weight added
//        ]);
//
//        return redirect()->route('product.index')->with('message', 'Mahsulot qoldiqlar qoshildi');
//    }

//    public function addPackage(Request $request, $id)
//    {
//        // Validate incoming request for adding packages and units
//        $validated = $request->validate([
//            'add_packages' => 'nullable|integer|min:0', // Allow adding packages
//            'add_units' => 'nullable|integer|min:0', // Allow adding individual units
//        ]);
//
//        // Find the product
//        $product = Product::findOrFail($id);
//
//        // Update stock information by adding new quantities if provided
//        if (isset($validated['add_packages'])) {
//            $product->total_packages += $validated['add_packages'];
//        }
//
//        if (isset($validated['add_units'])) {
//            $product->total_units += $validated['add_units'];
//        }
//
//        $product->save();
//
//        // Log turnover for 'kirim' (incoming) type if there are additions
//        Turnover::create([
//            'product_id' => $product->id,
//            'user_id' => auth()->id(),
//            'type' => 'kirim', // 'kirim' for incoming stock
//            'quantity_pack' => $validated['add_packages'] ?? 0, // Quantity of packages added
//            'quantity_piece' => $validated['add_units'] ?? 0, // Quantity of individual units added
////            'total_weight' => $product->total_weight, // Total weight remains the same
//        ]);
//
//        return redirect()->route('product.index')->with('message', 'Mahsulot qoldiqlar qo\'shildi');
//    }

//    public function addPackage(Request $request, $id)
//    {
//        // Validate incoming request for adding packages and units
//        $validated = $request->validate([
//            'total_packages' => 'nullable|integer|min:0', // Allow adding packages
//            'total_units' => 'nullable|integer|min:0', // Allow adding individual units
//        ]);
//
//        // Find the product by ID
//        $product = Product::findOrFail($id);
//
//        // Add the new values to the existing package and unit counts
//        $newItemsPerPackage = $validated['total_packages'] ?? 0;
//        $newTotalUnits = $validated['total_units'] ?? 0;
//
//        // Update the product's items_per_package and total_units
//        $product->total_packages += $newItemsPerPackage;
//        $product->total_units += $newTotalUnits;
//
//        // Calculate the new total weight:
//        // Total weight = (total number of packages * weight per package) + (total individual units * weight per unit)
//        $product->total_weight = ($product->total_packages * $product->package_weight)
//            + ($product->total_units * $product->weight_per_meter);
//
//        // Save the updated product information
//        $product->save();
//
//        // Log turnover for 'kirim' (incoming stock) type if there are additions
//        Turnover::create([
//            'product_id' => $product->id,
//            'user_id' => auth()->id(),
//            'type' => 'kirim', // Type 'kirim' for added stock
//            'quantity_pack' => $newItemsPerPackage, // Quantity of packages added
//            'quantity_piece' => $newTotalUnits, // Quantity of individual units added
//            'total_weight' => ($newItemsPerPackage * $product->package_weight)
//                + ($newTotalUnits * $product->weight_per_meter), // Weight for added stock only
//        ]);
//
//        // Redirect back to the product index page with a success message
//        return redirect()->route('product.index')->with('message', 'Mahsulot qoldiqlar qo\'shildi');
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

        // Redirect back to the product index page with a success message
        return redirect()->route('product.index')->with('message', 'Mahsulot qoldiqlar qo\'shildi');
    }


//    public function addPackage(Request $request, $id)
//    {
//        // Validate incoming request for adding packages and units
//        $validated = $request->validate([
//            'total_packages' => 'nullable|integer|min:0', // Allow setting packages
//            'total_units' => 'nullable|integer|min:0', // Allow setting individual units
//        ]);
//
//        // Find the product by ID
//        $product = Product::findOrFail($id);
//
//        // Set the new values for total packages and units
//        $product->total_packages = $validated['total_packages'] ?? $product->total_packages;
//        $product->total_units = $validated['total_units'] ?? $product->total_units;
//
//        // Calculate the new total weight:
//        $newTotalWeight = ($product->total_packages * $product->package_weight)
//            + ($product->total_units * $product->weight_per_item);
//
//        // Update total_weight for the product
//        $product->total_weight = $newTotalWeight;
//
//        // Save the updated product information
//        $product->save();
//
//        // Log turnover for 'kirim' (incoming stock) type
//        Turnover::create([
//            'product_id' => $product->id,
//            'user_id' => auth()->id(),
//            'type' => 'kirim', // Type 'kirim' for added stock
//            'quantity_pack' => $product->total_packages, // Total quantity of packages
//            'quantity_piece' => $product->total_units, // Total quantity of individual units
//            'total_weight' => $newTotalWeight, // New total weight
//        ]);
//
//        // Redirect back to the product index page with a success message
//        return redirect()->route('product.index')->with('message', 'Mahsulot qoldiqlar qo\'shildi');
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

        // Bog'liq order_products yozuvlarini o'chirish
        OrderProduct::where('product_id', $id)->delete();

        // Mahsulotni o'chirish
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
