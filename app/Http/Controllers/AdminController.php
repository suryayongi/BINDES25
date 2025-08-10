<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Product; // <-- TAMBAHKAN INI
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('admin.users.index', compact('users'));
    }

    public function products()
    {
        // HAPUS KODE LAMA: $products = DB::table('products')->get();

        // GUNAKAN KODE ELOQUENT YANG BENAR INI
        if (auth()->user()->role === 'admin') {
            $products = Product::with('user')->latest()->get();
        } else {
            $products = auth()->user()->products()->latest()->get();
        }

        return view('admin.products.index', compact('products'));
    }

    public function updateUserRole(Request $request, User $user)
    {
        $request->validate(['role' => 'required|in:admin,penjual,pembeli']);
        $user->update(['role' => $request->role]);
        return back()->with('success', 'Role user berhasil diupdate.');
    }
}