<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        $customers = Category::query()
            ->when($search, function ($query, $search) {
                return $query->where('name', 'like', "%{$search}%")
                    ->orWhere('created_at', 'like', "%{$search}%");
            })
            ->latest()
            ->paginate(10);

        return response()->json($customers);
    }
    public function show($id)
    {
        $customer = Category::findOrFail($id);
        return response()->json($customer);
    }
}
