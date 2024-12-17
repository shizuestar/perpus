<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Loan;
use App\Models\BookReview;
use App\Models\PersonalCollection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class libraryController extends Controller
{
    public function index()
    {
        $books = Book::latest()->paginate(8);
        return view("library.index", compact("books"));
    }

    public function showBook(Book $book)
    {
        // Rating
        $reviews = $book->bookReviews()->with('user')->latest()->get();
        $averageRating = $book->bookReviews()->avg('rating');

        // Koleksi
        $user = Auth::user();
        $checkCollection = collect();
        if ($user) {
            $checkCollection = PersonalCollection::checkCollection($user, $book);
        }

        // Relate book
        $relatedBooks = Book::where('id', '!=', $book->id)
        ->where(function ($query) use ($book) {
            $query->where('author', $book->author)
                ->orWhere('publisher', $book->publisher)
                ->orWhere('category_id', $book->category_id);
        })->take(6)->get();

        // data lain
        $bookLoanded = $book->loans()->count();
        $bookFaved = $book->personalCollections()->count();
        $bookStock = $book->stock - $book->loans()->whereIn('status', ['proses', 'disetujui'])->count();

        return view('library.book-detail', compact('book','bookStock','bookLoanded', 'bookFaved',"relatedBooks", 'reviews', 'checkCollection', 'averageRating'));
    }

    public function requestLoan(Request $request, Book $book)
    {
        if(Auth::guest()){
            return redirect()->route("login")->with("warning", "Silahkan login terlebih dahulu!");
        }
        $user = Auth::user();

        if (Loan::checkRequestUser($user, $book)) {
            return redirect()->back()->with("warning", "Hanya bisa meminjam buku sekali!");
        }

        if($book->loans()->count() < $book->stock && $book->status === "available"){
            Loan::create([
                'user_id' => Auth::id(),
                'book_id' => $book->id,
                'status' => 'proses',
            ]);

            $bookBorrowed = $book->loans()->whereIn('status', ["proses", "disetujui"])->count();
            if($bookBorrowed == $book->stock){
                $book->update([
                    "status" => "borrowed"
                ]);
            }

            return redirect()->back()->with('success', 'Peminjaman berhasil!. Silahkan cek peminjaman page untuk mengetahui status peminjaman.');
            // return redirect()->back()->with('success', 'Loan request submitted successfully! Please check your dashboard to track the status of your loan.');
        } else{
            return redirect()->back()->with("error", "Stok buku sedang habis dipinjam!");
            // return redirect()->back()->with("error", "The book was borrowed!");
        }
    }

    public function addToCollection(Request $request)
    {
        $request->validate([
            'book_id' => 'required|exists:books,id',
        ]);

        $user = Auth::user();
        $exists = $user->personalCollections()->where('book_id', $request->book_id)->exists();

        if ($exists) {
            return redirect()->back()->with('error', 'Buku sudah ada didalam koleksimu!');
        }

        $user->personalCollections()->create([
            'book_id' => $request->book_id,
        ]);

        return redirect()->back()->with('success', 'Berhasil menambahkan buku ke koleksi!');
    }
    public function deleteToCollection(Request $request)
    {
        $request->validate([
            'book_id' => 'required|exists:books,id',
        ]);

        PersonalCollection::where('book_id', $request->book_id)->where('user_id', Auth::user()->id)->delete();

        return redirect()->back()->with('success', 'Berhasil menghapus buku dari koleksi!');
    }

    public function sendReview(Request $request, Book $book)
    {
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'review' => 'required|string|max:1000',
        ]);

        BookReview::create([
            'user_id' => Auth::id(),
            'book_id' => $book->id,
            'rating' => $request->rating,
            'review' => $request->review,
        ]);

        return redirect()->back()->with('success', 'Review berhasil. Terimakasih atas reviewnya!');
    }
    public function search(Request $request)
    {
        $query = $request->input('search');
        $books = Book::where('title', 'like', '%' . $query . '%')
                    ->orWhere('excerpt', 'like', '%' . $query . '%')
                    ->orWhere('author', 'like', '%' . $query . '%')
                    ->with('category')
                    ->paginate(100);

        // Pastikan query mengembalikan jumlah data yang sesuai
        return view('library._book_list', compact('books'));
    }
}
