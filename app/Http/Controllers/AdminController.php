<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('admin.index', compact('users'));
    }

    public function banUser(Request $request, $userId)
    {
        $user = User::find($userId);
        if ($user) {
            $user->is_banned = true; // Atur status banned pengguna
            $user->save();
            return redirect()->back()->with('success', 'Pengguna berhasil diblokir.');
        }
        return redirect()->back()->with('error', 'Pengguna tidak ditemukan.');
    }
}
