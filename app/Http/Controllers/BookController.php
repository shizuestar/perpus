<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\BookCategory;
use Illuminate\Http\Request;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $books = Book::all();
        $categories = BookCategory::all();
        return view('books.index', compact('books', "categories"));
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
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'excerpt' => 'required|string|max:255',
            'publisher' => 'required|string|max:255',
            'yearPublished' => 'required|date',
            'synopsis' => 'required|string',
            'stock' => 'required',
            'category_id' => 'required|exists:book_categories,id',
            "image" => "required|mimes:jpg,png,jpeg"
        ]);

        $image = $request->file("image");
        $image->storeAs('book/images', $image->hashName(), 'public');

        $validated['image'] = $image->hashName();
        $validated['ori_image'] = $image->getClientOriginalName();
        $validated["status"] = "available";
        Book::create($validated);

        return redirect()->route('books.index')->with('success', 'Berhasil menambahkan data buku!');
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
        //
    }
    
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $slug)
    {
        $book = Book::where('slug', $slug)->firstOrFail();

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'publisher' => 'required|string|max:255',
            'excerpt' => 'required|string|max:255',
            'yearPublished' => 'required|date',
            'synopsis' => 'required|string',
            'stock' => 'required',
            'category_id' => 'required|exists:book_categories,id',
        ]);

        $book->update($validated);

        return redirect()->route('books.index')->with('success', 'Berhasil update data buku!.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $slug)
    {
        $book = Book::where('slug', $slug)->firstOrFail();
        $book->delete();

        return redirect()->route('books.index')->with('success', 'Berhasil menghapus data buku!.');
    }

}
