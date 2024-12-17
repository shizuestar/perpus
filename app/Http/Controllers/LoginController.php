<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function index()
    {
        return view("auth.login");
    }
    public function register()
    {
        return view("auth.signin");
    }
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'telp' => 'required|string|max:255',
            'password' => 'required|string|min:8',
        ]);

        $user = User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'telp' => $validatedData['telp'],
            'password' => Hash::make($validatedData['password']),
            "level" => "user"
        ]);

        return redirect()->route('login')->with('success', 'Registrasi Berhasil. Silahkan login.');
    }
    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:4',
        ]);

        $user = \App\Models\User::where('email', $request->email)->first();

        $credentials = $request->only('email', 'password');
        $remember = $request->has('remember');

        if ($user) {
            if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
                $request->session()->regenerate();
                return redirect()->intended(route('dashboard'));
            }

            return back()->withErrors([
                'password' => 'The password is incorrect.',
            ])->onlyInput('email');
        }

        return back()->withErrors([
            'email' => 'The email does not match our records.',
        ])->onlyInput('email');
    }
    public function logout(Request $request)
    {
        Auth::guard("web")->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return to_route("login");
    }
}
