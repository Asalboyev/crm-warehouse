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
            'phone' => 'required|string|max:20|unique:customers,phone', // Make phone unique
            'company' => 'required|string|max:100',
        ]);

        // Foydalanuvchini yaratish
        $customer = Customer::create([
            'name' => $validatedData['name'],
            'company' => $validatedData['company'],
            'phone' => $validatedData['phone'],
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
            'phone' => 'required|string|max:20|unique:customers,phone,' . $id, // Ignore current customer's phone
            'company' => 'required|string|max:100',
        ]);

        // Foydalanuvchini yangilash
        $customer = Customer::findOrFail($id);
        $customer->update([
            'name' => $validatedData['name'],
            'company' => $validatedData['company'],
            'phone' => $validatedData['phone'],
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
