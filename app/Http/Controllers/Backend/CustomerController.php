<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        $customers = Customer::query()
            ->when($search, function ($query, $search) {
                return $query->where('name', 'like', "%{$search}%")
                    ->orWhere('phone', 'like', "%{$search}%");
            })
            ->latest()
            ->paginate(10);

        return view('admin.customers.index', compact('customers', 'search'));
    }



    public function store(Request $request)
    {
        // Foydalanuvchi ma'lumotlarini tasdiqlash
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

        // Foydalanuvchi ma'lumotlarini ko'rsatish
        return redirect()->route('customers.index')->with(['message' => 'Successfully added!']);
    }

    public function edit(string $id)
    {
        $customer = Customer::findOrFail($id);

        return view('admin.customers.edit',compact('customer'));
    }

    public function update(Request $request, $id)
    {
        // Foydalanuvchi ma'lumotlarini tasdiqlash
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20|unique:customers,phone,' . $id, // Joriy mijozning telefon raqamini hisobga olmaslik
            'company' => 'required|string|max:100',
            'status' => 'nullable|in:0,1', // Statusni validatsiya qilish (0 yoki 1)
        ]);

        // Agar status tanlanmasa, 0 bo'lishini ta'minlash
        $status = $request->input('status', 0);

        // Foydalanuvchini yangilash
        $customer = Customer::findOrFail($id);
        $customer->update([
            'name' => $validatedData['name'],
            'company' => $validatedData['company'],
            'phone' => $validatedData['phone'],
            'status' => $status, // Statusni yangilash
        ]);

        // Foydalanuvchi ma'lumotlarini ko'rsatish
        return redirect()->route('customers.index')->with(['message' => 'Successfully updated!']);
    }

    public function destroy($id)
    {
        // Foydalanuvchini topish va o'chirish
        $customer = Customer::findOrFail($id);
        $customer->delete();

        // Foydalanuvchi ma'lumotlarini ko'rsatish
        return redirect()->route('customers.index')->with(['message' => 'Successfully deleted!']);
    }




}
