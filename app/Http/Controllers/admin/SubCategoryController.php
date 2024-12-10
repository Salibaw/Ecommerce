<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;

class SubCategoryController extends Controller
{
    // Tampilkan daftar subkategori
    public function index(Request $request)
    {
        $keyword = $request->get('keyword');

        // Pencarian jika ada keyword
        $subCategories = SubCategory::with('category')
            ->when($keyword, function ($query, $keyword) {
                return $query->where('name', 'like', '%' . $keyword . '%')
                    ->orWhere('slug', 'like', '%' . $keyword . '%');
            })
            ->paginate(10); // Menampilkan 10 item per halaman

        return view('admin.sub_category.list', compact('subCategories'));
    }


    // Tampilkan halaman create
    public function create()
    {
        $categories = Category::all(); // Mengambil semua kategori
        return view('admin.sub_category.create', compact('categories'));
    }

    // Simpan data subkategori
    public function store(Request $request)
    {
        $request->validate([
            'category' => 'required|exists:categories,id',
            'name' => 'required|string|max:255',
            'slug' => 'required|string|unique:sub_categories,slug|max:255',
            'status' => 'required|boolean',
        ]);

        SubCategory::create([
            'category_id' => $request->category,
            'name' => $request->name,
            'slug' => $request->slug,
            'status' => $request->status,
        ]);

        return redirect()->route('subcategories.index')->with('success', 'SubCategory created successfully!');
    }

    // Tampilkan halaman edit
    public function edit(SubCategory $subCategory)
    {
        $categories = Category::all(); // Mengambil semua kategori
        return view('admin.sub_category.edit', compact('subCategory', 'categories'));
    }

    // Update data subkategori
    public function update(Request $request, SubCategory $subCategory)
    {
        $request->validate([
            'category' => 'required|exists:categories,id',
            'name' => 'required|string|max:255',
            'slug' => 'required|string|unique:sub_categories,slug,' . $subCategory->id,
            'status' => 'required|boolean',
        ]);

        $subCategory->update([
            'category_id' => $request->category,
            'name' => $request->name,
            'slug' => $request->slug,
            'status' => $request->status,
        ]);

        return redirect()->route('subcategories.index')->with('success', 'SubCategory updated successfully!');
    }

    // Hapus data subkategori
    public function destroy(SubCategory $subCategory)
    {
        $subCategory->delete();
        return redirect()->route('subcategories.index')->with('success', 'SubCategory deleted successfully!');
    }
}
