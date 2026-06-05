<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
// Menggunakan Routing Controller bawaan inti Laravel 11 agar tidak error
use Illuminate\Routing\Controller as BaseController; 

class AuthController extends BaseController
{
    // 1. MENAMPILKAN HALAMAN LOGIN
    public function showLogin()
    {
        if (Auth::check()) {
            if (Auth::user()->role === 'admin') {
                return redirect()->route('admin.dashboard');
            }
            return redirect('/beranda');
        }
        return view('auth.login');
    }

    // 2. PROSES AKSI LOGIN (POST) - VERSI PASSWORD ANGKA BIAYA (TANPA BCRYPT)
    public function login(Request $request)
    {
        // Tetap lakukan validasi input form seperti biasa
        $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ], [
            'email.required' => 'Email wajib diisi!',
            'email.email' => 'Format email tidak valid!',
            'password.required' => 'Kata sandi wajib diisi!',
        ]);

        $remember = $request->has('remember');

        // 1. CARI USER DI DATABASE BERDASARKAN EMAIL NYA
        $user = \App\Models\User::where('email', $request->email)->first();

        // 2. COCOKKAN PASSWORD TULISAN/ANGKA BIASA SECARA LANGSUNG (==)
        if ($user && $user->password == $request->password) {
            
            // 3. LOGIN-KAN USER SECARA MANUAL KE SISTEM LARAVEL
            Auth::login($user, $remember);
            
            $request->session()->regenerate();

            // Cek hak akses / role
            if (Auth::user()->role === 'admin') {
                return redirect()->route('admin.dashboard');
            }
            return redirect('/beranda');
        }

        // 4. JIKA PASSWORD SALAH ATAU USER TIDAK DITEMUKAN
        return back()->withErrors([
            'login_error' => 'Email tidak terdaftar atau kata sandi salah!',
        ])->withInput($request->only('email'));
    }
    // 3. MENAMPILKAN HALAMAN REGISTER
    public function showRegister()
    {
        if (Auth::check()) {
            return redirect()->route('admin.dashboard');
        }
        return view('auth.register');
    }

    // 4. PROSES AKSI REGISTER (POST)
    public function register(Request $request)
    {
        // Validasi data input form dengan standar keamanan Laravel
        $request->validate([
            'nama_lengkap' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8'],
            'konfirmasi_password' => ['required', 'same:password'],
        ], [
            'nama_lengkap.required' => 'Nama lengkap wajib diisi!',
            'email.required' => 'Email wajib diisi!',
            'email.email' => 'Format email tidak valid!',
            'email.unique' => 'Email sudah digunakan!',
            'password.required' => 'Password wajib diisi!',
            'password.min' => 'Password minimal harus 8 karakter!',
            'konfirmasi_password.required' => 'Konfirmasi password wajib diisi!',
            'konfirmasi_password.same' => 'Konfirmasi password tidak cocok!',
        ]);

        try {
            // Memasukkan data ke table users menggunakan model User
            User::create([
                'nama_lengkap' => $request->nama_lengkap,
                'email' => $request->email,
                'password' => Hash::make($request->password), // Password otomatis di-hash demi keamanan
                'role' => 'user', // Default role otomatis sebagai user biasa
            ]);

            // Jika sukses kirim flash message success
            return redirect()->route('login')->with('success', 'Akun berhasil dibuat! Silakan login.');
            
        } catch (\Exception $e) {
            return back()->withErrors(['register_error' => 'Terjadi kesalahan sistem.'])->withInput();
        }
    }
}