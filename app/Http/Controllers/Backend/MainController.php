<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Customer;
use Carbon\Carbon;

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



}
