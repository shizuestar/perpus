<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\PersonalCollection;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    // public function index(): View
    // {
    //     $profile = Auth::user();

    //     $daysSinceLastUpdate = Carbon::parse($profile->updated_at)->diffInDays(Carbon::now());
    //     $canChangePassword = $daysSinceLastUpdate >= 3;
    //     $daysRemaining = ceil(3 - $daysSinceLastUpdate);

    //     // Ambil koleksi buku pengguna
    //     $collections = PersonalCollection::with('book')
    //         ->where('user_id', $profile->id)
    //         ->get();

    //     return view("users.profile", compact('profile', 'canChangePassword', 'daysRemaining', "collections"));
    // }
    public function index(): View
    {
        $profile = Auth::user();

        $daysSinceLastUpdate = Carbon::parse($profile->updated_at)->diffInDays(Carbon::now());
        $canChangePassword = $daysSinceLastUpdate >= 3;
        $daysRemaining = ceil(3 - $daysSinceLastUpdate);

        // Ambil semua buku yang ada di koleksi pengguna
        $books = $profile->personalCollections()
            ->with('book.category') // Eager load buku dan kategori
            ->get()
            ->map(function ($collection) {
                return $collection->book; // Ambil buku dari koleksi
            });

        return view("users.profile", compact('profile', 'canChangePassword', 'daysRemaining', "books"));
    }


    public function updatePassword(Request $request)
    {
        // Validasi input
        $request->validate([
            'old_password' => 'required|string',
            'new_password' => 'required|string|min:4|confirmed',
        ]);

        $user = Auth::user();

        // Cek apakah password lama benar
        if (!Hash::check($request->old_password, $user->password)) {
            return back()->withErrors(['old_password' => 'The current password is incorrect.']);
        }

        Auth::user()->update([
            'password' => Hash::make($request->new_password),
            'updated_at' => now(),
        ]);

        return back()->with('success', 'Password updated successfully.');
    }
}
