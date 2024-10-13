<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Customer;
use Carbon\Carbon;
use App\Models\Product;
use App\Models\OrderProduct;
use App\Models\Order;
use Illuminate\Support\Facades\DB;

class MainController extends Controller
{

    public function getCustomerStats()
    {
        $totalCustomers = Customer::count();
        $dailyCustomers = Customer::whereDate('created_at', today())->count();
        $weeklyCustomers = Customer::whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()])->count();
        $monthlyCustomers = Customer::whereMonth('created_at', now()->month)->count();
        $yearlyCustomers = Customer::whereYear('created_at', now()->year)->count();

        // Misol uchun sotuvlarni olamiz
        $averageDailySales = 2420; // Statik qiymat, yoki DBdan olishingiz mumkin
        $percentageChange = 2.6; // Dinamik ravishda hisoblanishi mumkin

        // Blade faylga o'zgaruvchilarni yuboramiz
        return view('admin.dashboard', compact('totalCustomers', 'dailyCustomers', 'weeklyCustomers', 'monthlyCustomers', 'yearlyCustomers', 'averageDailySales', 'percentageChange'));
    }

//    public function showDashboard()
//    {
//        // Fetch total products sold per product
//        $productsSold = OrderProduct::select('product_id', DB::raw('SUM(times_sold) as times_sold'))
//            ->groupBy('product_id')
//            ->get();
//
//        // Fetch total products sold by each seller
//        $sellerStats = Order::select('user_id', DB::raw('SUM(order_products.quantity_pochka + order_products.quantity_dona) as products_sold'))
//            ->join('order_products', 'orders.id', '=', 'order_products.order_id')
//            ->groupBy('user_id')
//            ->with('user')
//            ->get();
//
//        // Fetch total products sold by each seller for each product
//        $sellerProductStats = OrderProduct::select('order_products.product_id', 'orders.user_id', DB::raw('SUM(order_products.quantity_pochka + order_products.quantity_dona) as total_sold'))
//            ->join('orders', 'order_products.order_id', '=', 'orders.id')
//            ->groupBy('order_products.product_id', 'orders.user_id')
//            ->with(['product', 'order.user'])
//            ->get();
//
//        // Return the view with statistics data
//
//        return view('admin.dashboard', [
//            'productsSold' => $productsSold,
//            'sellerStats' => $sellerStats,
//            'sellerProductStats' => $sellerProductStats,
//        ]);
//    }







}
