<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\User;

class CustomersController extends Controller
{
    public function apiIndex(Request $request)
    {
        $search = $request->input('search');

        $customers = Customer::query()
            ->when($search, function ($query, $search) {
                return $query->where('name', 'like', "%{$search}%")
                    ->orWhere('phone', 'like', "%{$search}%");
            })
            ->latest()
            ->paginate(10);

        return response()->json($customers);
    }



    public function me()
    {
        $user = auth()->user();

        if (!$user) {
            return response()->json(['error' => 'User not authenticated'], 401);
        }

        return response()->json($user);
    }




    public function apiShow($id)
    {
        $customer = Customer::findOrFail($id);
        return response()->json($customer);
    }

    public function apiStore(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20|unique:customers,phone', // Telefon raqamini yagona qilish
            'company' => 'required|string|max:100',
        ]);

        // Agar status tanlanmasa, 0 qiymatini tayinlash
        $status = $request->input('status', 0);

        // Foydalanuvchini yaratish
        $customer = Customer::create([
            'name' => $validatedData['name'],
            'company' => $validatedData['company'],
            'phone' => $validatedData['phone'],
            'status' => $status, // Statusni saqlash
        ]);

        return response()->json($customer, 201); // 201 Created
    }

    public function apiUpdate(Request $request, $id)
    {
        // Foydalanuvchi ma'lumotlarini tasdiqlash
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20|unique:customers,phone,' . $id, // Telefonni yagona qilish
            'company' => 'required|string|max:100',
            'status' => 'nullable|in:0,1', // Statusni validatsiya qilish (0 yoki 1)
        ]);

        // Agar status tanlanmasa, 0 bo'lishini ta'minlash
        $status = $request->input('status', 0);

        // Foydalanuvchini yangilash
        $customer = Customer::findOrFail($id);
        $customer->update([
            'name' => $validatedData['name'],
            'phone' => $validatedData['phone'],
            'company' => $validatedData['company'],
            'status' => $status, // Statusni yangilash
        ]);

        // Yangilangan foydalanuvchini JSON formatida qaytarish
        return response()->json([
            'message' => 'Successfully updated!',
            'customer' => $customer,
        ]);
    }

    public function apiDestroy($id)
    {
        $customer = Customer::findOrFail($id);
        $customer->delete();

        return response()->json(['message' => 'Successfully deleted!']);
    }

}
