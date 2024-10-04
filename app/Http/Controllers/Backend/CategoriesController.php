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

                // Generate full URL for the image
                $fullUrl = url('storage/' . $path);

                // Return success response with the image URL
                return response()->json(['success' => $fullUrl]);
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
        dd($request->all());

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

        return view('admin.categories.edit',compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
