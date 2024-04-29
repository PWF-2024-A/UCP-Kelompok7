<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Menampilkan daftar semua kategori.
     */
    public function index()
    {
        $categories = Category::all(); // Mengambil semua kategori
        return view('categories.index', compact('categories')); // Mengarahkan ke view categories.index
    }

    /**
     * Menampilkan formulir untuk membuat kategori baru.
     */
    public function create()
    {
        return view('categories.create');
    }

    /**
     * Menyimpan kategori baru ke database.
     */
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'title' => 'required|max:255',
        ]);

        // Membuat kategori baru
        Category::create([
            'title' => ucfirst($request->title),
        ]);

        return redirect()->route('category.index')->with('success', 'Category created successfully!');
    }

    /**
     * Menampilkan formulir untuk mengedit kategori.
     */
    public function edit(Category $category)
    {
        return view('categories.edit', compact('category'));
    }

    /**
     * Memperbarui kategori yang ada.
     */
    public function update(Request $request, Category $category)
    {
        // Validasi input
        $request->validate([
            'title' => 'required|max:255',
        ]);

        // Memperbarui kategori
        $category->update([
            'title' => ucfirst($request->title),
        ]);

        return redirect()->route('category.index')->with('success', 'Category updated successfully!');
    }

    /**
     * Menghapus kategori.
     */
    public function destroy(Category $category)
    {
        // Hapus kategori
        $category->delete();

        return redirect()->route('category.index')->with('success', 'Category deleted successfully!');
    }
}

