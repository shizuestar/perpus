<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::all();
        return view("users.index", compact("users"));
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
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users,username',
            'password' => 'required|string|min:6',
            'email' => 'required|string|email|max:255|unique:users,email',
            'address' => 'required|string',
            'level' => 'required|in:admin,user',
        ]);

        // Simpan data ke database
        $user = User::create([
            'name' => $validatedData['name'],
            'username' => $validatedData['username'],
            'password' => Hash::make($validatedData['password']), // Hashing password
            'email' => $validatedData['email'],
            'address' => $validatedData['address'],
            'level' => $validatedData['level'],
        ]);

        // Redirect atau respon sesuai kebutuhan
        return redirect()->route('users.index')->with('success', 'User berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // Validasi input
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'nullable|string|max:255|unique:users,username,' . $id,
            'password' => 'nullable|string|min:4', // Password optional untuk update
            'email' => 'required|email|max:255|unique:users,email,' . $id,
            'address' => 'nullable|string',
            'level' => 'required|in:admin,user',
        ]);

        // Temukan user berdasarkan ID
        $user = User::findOrFail($id);

        // Update field
        $user->name = $validated['name'];
        $user->username = $validated['username'];
        $user->email = $validated['email'];
        $user->address = $validated['address'];
        $user->level = $validated['level'];

        // Jika password diisi, update password
        if (!empty($validated['password'])) {
            $user->password = bcrypt($validated['password']);
        }

        // Simpan perubahan
        $user->save();

        // Redirect atau response
        return redirect()->route('users.index')->with('success', 'Berhasil update data user!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        // Temukan user berdasarkan ID
        $user = User::findOrFail($id);

        // Hapus user
        $user->delete();

        // Redirect atau response
        return redirect()->route('users.index')->with('success', 'Berhasil delete data user!');
    }

}
