<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use App\Models\BookCategory;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class BookCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = BookCategory::all(); // Ambil semua kategori
        return view('books.categories', compact('categories')); // Kirim ke view
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:book_categories,name',
        ]);

        BookCategory::create([
            'name' => $validated['name'],
            'slug' => Str::slug($validated['name']),
        ]);

        return redirect()->route('book-categories.index')->with('success', 'Berhasil menambah kategori buku!');
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
    public function edit(BookCategory $bookCategory)
    {
        return view('book.categories.edit', compact('bookCategory'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, BookCategory $bookCategory)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:book_categories,name,' . $bookCategory->id,
        ]);

        $bookCategory->update([
            'name' => $validated['name'],
            'slug' => Str::slug($validated['name']),
        ]);

        return redirect()->route('book-categories.index')->with('success', 'Berhasil update data kategori buku!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(BookCategory $bookCategory)
    {
        $bookCategory->delete();
        return redirect()->route('book-categories.index')->with('success', 'Berhasil menghapus kategori buku!');
    }

}
