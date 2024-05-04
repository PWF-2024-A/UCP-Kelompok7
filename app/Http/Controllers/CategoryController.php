<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {

        $categories = Category::where('user_id', auth()->user()->id)
            ->get();
        return view('category.index', compact('categories'));
    }

    public function create()
    {
        return view('category.create');
    }

    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'title' => 'required|max:255',
        ]);

        // Membuat kategori baru dengan menambahkan user_id dari pengguna yang sedang login
        Category::create([
            'title' => ucfirst($request->title),
            'user_id' => auth()->user()->id,
        ]);

        // Redirect ke halaman index kategori dengan pesan sukses
        return redirect()->route('category.index')->with('success', 'Category created successfully!');
    }

    public function edit(Category $category)
    {
        return view('category.edit', compact('category'));
    }

    public function update(Request $request, Category $category)
    {
        $request->validate([
            'title' => 'required|max:255',
        ]);

        $category->update([
            'title' => ucfirst($request->title),
        ]);

        return redirect()->route('category.index')->with('success', 'Category updated successfully!');
    }

    public function destroy(Category $category)
    {
        if (auth()->user()->id == $category->user_id) {
            $category->delete();
            return redirect()->route('category.index')->with('success', 'Category deleted successfully!');
        } else {
            return redirect()->route('category.index')->with('danger', 'You are not authorized to delete this category!');
        }
    }
}
