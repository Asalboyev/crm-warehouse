<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        // Fetch categories to display in the dropdown (if you have categories)

        // Query orders and apply filters
        $orders = Order::with(['client', 'user']) // Include related client and user data
        ->when($search, function ($query, $search) {
            // Apply search filter to Order, Client, and User
            return $query->where('name', 'like', "%{$search}%")
                ->orWhere('phone', 'like', "%{$search}%")
                ->orWhereHas('client', function ($query) use ($search) {
                    $query->where('name', 'like', "%{$search}%")
                        ->orWhere('email', 'like', "%{$search}%");
                })
                ->orWhereHas('user', function ($query) use ($search) {
                    $query->where('name', 'like', "%{$search}%")
                        ->orWhere('email', 'like', "%{$search}%");
                });
        })
            ->latest()
            ->paginate(10)
            ->appends(['search' => $search]); // Retain search and filters in pagination

        return view('admin.orders.index', compact('orders', 'search'));
    }


}
