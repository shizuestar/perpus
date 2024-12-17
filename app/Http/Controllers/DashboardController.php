<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Book;
use App\Models\Loan;
use App\Models\User;
use App\Models\BookReview;
use App\Models\BookCategory;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index() : View 
    {
        $user = Auth::user();
        if($user->level === "admin"){
            $users = User::all()->count();
            $books = Book::all()->count();
            $categories = BookCategory::all()->count();
            $reviews = BookReview::all()->count();
            $statuses = ['proses', 'disetujui', 'dikembalikan', 'terlambat'];
            $loansD = Loan::whereIn('status', $statuses)->whereDate('created_at', Carbon::today())->count();
            $loansM = Loan::whereIn('status', $statuses)->whereYear('created_at', Carbon::now()->year)->whereMonth('created_at', Carbon::now()->month)->count();
            $loansY = Loan::whereIn('status', $statuses)->whereYear('created_at', Carbon::now()->year)->count();
            return view("dashboard.admin", compact("users", "books", "categories", "reviews", "loansD", "loansM", "loansY"));
        } else{
            $loans = $user->loans()->count();
            $favourites = $user->personalCollections()->count();
            $comments = $user->bookReviews()->count();

            $loansP = $user->loans()->where('status', "proses")->count();
            $loansA = $user->loans()->where('status', "disetujui")->count();
            $loansR = $user->loans()->where('status', "dikembalikan")->count();
            $loansRL = $user->loans()->where('status', "terlambat   ")->count();
            return view("dashboard.index", compact("loans", "comments", "favourites", "loansP", "loansA", "loansR", "loansRL"));
        }
    }
}
