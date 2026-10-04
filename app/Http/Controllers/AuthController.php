<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash; // <- Tambahkan ini!
use Illuminate\Support\Facades\Auth;


class AuthController extends Controller
{
    public function proseslogin(Request $request)
    {
        $request->validate([
            'nis' => 'required|string',
            'password' => 'required|string',
        ]);

        $input = $request->input('nis'); // bisa NIS siswa atau username guru/admin
        $password = $request->input('password');

        // Cari USER dulu berdasarkan username = $input
        $user = \App\Models\User::where('username', $input)->first();

        if ($user) {
            // User ditemukan di tabel user (berarti guru/admin)
            if (Auth::attempt(['username' => $input, 'password' => $password])) {
            // Login berhasil
                return $this->redirectByRole($user->role);
            } else {
                return back()->withErrors(['password' => 'Password salah']);
            }
        } else {
            // Tidak ketemu di USER, cek siswa berdasarkan nis (Nomor Induk Siswa)
            $siswaUser = \App\Models\Siswa::where('nis', $input)->first();

            if ($siswaUser) {
                // Ambil user_id siswa
                $userId = $siswaUser->user_id;
                $user = \App\Models\User::find($userId);

                if ($user && Auth::attempt(['username' => $user->username, 'password' => $password])) {
                // Login berhasil
                    return $this->redirectByRole($user->role);
                } else {
                    return back()->withErrors(['password' => 'Password salah']);
                }
            } else {
                return back()->withErrors(['login' => 'NIS/Username tidak ditemukan']);
            }
        }
    }

    protected function redirectByRole($role)
    {
        switch ($role) {
            case 'Admin':
                return redirect()->route('admin');
            case 'Guru':
                return redirect()->route('guru');
            case 'Siswa':
                return redirect()->route('dashboard');
            default:
                Auth::logout();
                return redirect()->route('login')->withErrors('Role tidak valid');
        }
    }

    public function proseslogout()
    {
        Auth::logout();
        return redirect()->route('login')->with('success', 'Anda berhasil logout.');
    }
}
