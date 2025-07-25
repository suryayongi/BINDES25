<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Menampilkan halaman manajemen user.
     */
    public function index()
    {
        // Ambil semua user kecuali user dengan role 'admin'
        $users = User::where('role', '!=', 'admin')->latest()->get();
        return view('admin.users.index', ['users' => $users]);
    }

    /**
     * Mengupdate role user.
     */
    public function updateRole(Request $request, User $user)
    {
        // Validasi input
        $request->validate(['role' => 'required|in:pembeli,penjual']);
        
        // Update role
        $user->update(['role' => $request->role]);

        return redirect()->route('admin.users.index')->with('success', 'Role user berhasil diperbarui.');
    }
}
