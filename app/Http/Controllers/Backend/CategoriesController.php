<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;


class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function ajax(Request $request)
    {
        if ($request->hasFile('file')) {
            try {
                $image = $request->file('file');

                // Generate a unique name for the image
                $imageName = time() . '.webp'; // Save as webp

                // Convert image to webp format
                $img = Image::make($image)->encode('webp', 90); // 90 is the quality

                // Define path to store the image
                $path = 'categories-images/' . $imageName;

                // Save the converted image to storage
                Storage::disk('public')->put($path, $img);

                // Return success response with the relative path
                return response()->json(['success' => $path]);

            } catch (\Exception $e) {
                // Log the exception for debugging
                \Log::error('Image upload failed: ' . $e->getMessage());

                // Return error response
                return response()->json(['error' => 'Failed to upload image.'], 500);
            }
        } else {
            // Return error response if no file is uploaded
            return response()->json(['error' => 'No file uploaded'], 400);
        }
    }

    public function index(Request $request)
    {
        $search = $request->input('search');

        $categories = Category::query()
            ->when($search, function ($query, $search) {
                return $query->where('name', 'like', "%{$search}%");
            })
            ->latest()
            ->paginate(10);

        return view('admin.categories.index', compact('categories', 'search'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required'
        ]);

        $data = $request->all();

        if ($request->has('image_name')) {
            $data['photo'] = $request->input('image_name');
        }

        Category::create($data);
        return redirect()->route('categories.index')->with(['message' => 'Successfully added!']);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $category = Category::findOrFail($id);

        return view('admin.categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required'
        ]);
        $category = Category::findOrFail($id);
        $data = $request->all();

        if ($request->has('image_name')) {
            $data['photo'] = $request->input('image_name');
        }
        $category->update($data);

        return redirect()->route('categories.index')->with(['message' => 'Successfully updated!']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        // Kategoriyani topish
        $category = Category::find($id);

        // Agar kategoriya topilmasa, xatolik xabarini ko'rsatish
        if (!$category) {
            return redirect()->back()->with(['error' => 'Category not found!']);
        }

        // Kategoriya bilan bog'liq mahsulotlarni tekshirish
        if ($category->products()->count() > 0) {
            // Agar kategoriya mahsulotlarga ega bo'lsa, xatolik xabarini ko'rsatish
            return redirect()->back()->with(['error' => 'Ushbu turkumda tegishli mahsulotlar mavjud. Iltimos, avval mahsulotlarni o\'chirib tashlang!']);
        }

        // Agar bog'liq mahsulotlar bo'lmasa, kategoriyani o'chirish
        $category->delete();

        // O'chirilgandan keyin foydalanuvchini qayta yo'naltirish va muvaffaqiyat xabarini ko'rsatish
        return redirect()->back()->with(['message' => 'Category successfully deleted!']);
    }

}
