<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Book;
use App\Models\Loan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
class LoanController extends Controller
{
    public function index()
    {
        // Mengambil semua data loans dengan relasi yang diperlukan
        $user = Auth::user();
        if($user->level === "admin"){
            $loans = Loan::with('user', 'book')->latest()->get();
            return view('loans.index', compact('loans'));
        } else{
            $loans = Loan::with("user", "book")->where("user_id", $user->id)->latest()->get();
            return view('loans.user', compact('loans'));
        }
        // Mengembalikan view loans.index dengan data loans
    }
    public function destroy(Loan $loan)
    {
        $loan->delete();

        return back()->with('success', 'Data peminjaman berhasil dihapus!');
    }
    public function destroyUser(Loan $loan)
    {
        if($loan->status === "proses"){
            $loan->update([
                "status" => "dibatalkan"
            ]);
            return back()->with('success', 'Peminjaman dibatalkan!');
        }
        $loan->delete();

        return back()->with('success', 'Data peminjaman berhasil dihapus!');
    }
    public function accRequest(Loan $loan)
    {
        $loan->update([
            "status" => "disetujui",
            "updated_at" => Carbon::now()
        ]);
        return back()->with("success", "Aksi berhasil!");
    }
    public function rejectRequest(Loan $loan)
    {
        $loan->update([
            "status" => "ditolak",
            "updated_at" => Carbon::now()
        ]);
        return back()->with("success", "Aksi berhasil!");
    }
    public function returned(Loan $loan)
    {
        $book = Book::findOrFail($loan->book_id);
        $loanBook = Loan::where('book_id', $book->id)->whereIn('status', ['disetujui', 'proses'])->count();
        if($loanBook == $book->stock){
            $book->update([
                "status" => "available"
            ]);
        }

        $updatedAt = Carbon::parse($loan->updated_at);
        $returnDate = Carbon::now();
        if ($returnDate->diffInDays($updatedAt) <= 14) {
            $loan->update([
                "status" => "dikembalikan",
                "return_date" => $returnDate
            ]);
            return back()->with("success", "Berhasil mengembalikan buku!");
        } else {
            $loan->update([
                "status" => "terlambat",
                "return_date" => $returnDate
            ]);
            return back()->with("warning", "Buku dikembalikan terlambat!");
        }
    }

    public function exportToPDF(Request $request)
    {
        $request->validate([
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
        ]);

        $loans = Loan::with(['user', 'book'])
            ->whereBetween('created_at', [$request->start_date, $request->end_date])
            ->get();

        $pdf = Pdf::loadView('loans.pdf', compact('loans', "request"));

        return $pdf->download('Peminjaman_' . $request->start_date . '_sampai_' . $request->end_date . '.pdf');
    }
}

