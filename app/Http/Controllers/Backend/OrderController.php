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

        $orders = Order::with(['client', 'user', 'statuses'])
            ->when($search, function ($query, $search) {
                $query->where(function ($subQuery) use ($search) {
                    $subQuery->orWhereHas('client', function ($query) use ($search) {
                        $query->where('name', 'like', "%{$search}%")
                            ->orWhere('phone', 'like', "%{$search}%");
                    })->orWhereHas('user', function ($query) use ($search) {
                        $query->where('name', 'like', "%{$search}%");
                    });
                });
            })
            ->latest()
            ->paginate(10)
            ->appends(['search' => $search]);

        return view('admin.orders.index', compact('orders', 'search'));
    }
    public function show($id)
    {
        // Buyurtma va unga tegishli barcha ma'lumotlarni olish, shu jumladan OrderProductlar
        $order = Order::with(['client', 'user', 'statuses', 'orderProducts.product'])->findOrFail($id);

        return
            view('admin.orders.show', compact('order'));
    }





}
