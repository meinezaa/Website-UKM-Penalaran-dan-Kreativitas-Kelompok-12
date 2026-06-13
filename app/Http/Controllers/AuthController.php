<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Routing\Controller as BaseController; 

class AuthController extends BaseController
{
    // 1. MENAMPILKAN HALAMAN LOGIN
    public function showLogin()
    {
        // Jika session manual id_user terdeteksi ada, arahkan langsung ke beranda
        if (session('id_user')) {
            if (session('role') === 'admin') {
                return redirect()->route('admin.dashboard');
            }
            return redirect('/');
        }
        
        return view('auth.login'); 
    }

    // 2. PROSES AKSI LOGIN (POST)
    public function login(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ], [
            'email.required' => 'Email wajib diisi!',
            'email.email' => 'Format email tidak valid!',
            'password.required' => 'Kata sandi wajib diisi!',
        ]);

        // Cari user murni lewat model
        $user = User::where('email', $request->email)->first();

        // Pencocokan string angka polos langsung (tanpa fungsi Hash bawaan)
       if ($user && $request->password === $user->password){

        
            
            // Kunci status login ke dalam data session web
            $request->session()->put('id_user', $user->id_user);
            $request->session()->put('role', $user->role);
            $request->session()->put('nama_lengkap', $user->nama_lengkap);
            
            $request->session()->regenerate();

            if ($user->role === 'admin') {
                return redirect()->route('admin.dashboard');
            }
            return redirect('/');
        }

        return back()->withErrors([
            'login_error' => 'Email tidak terdaftar atau kata sandi salah!',
        ])->withInput($request->only('email'));
    }

    // 3. MENAMPILKAN HALAMAN REGISTER
    public function showRegister()
    {
        if (session('id_user')) {
            return redirect('/');
        }
        return view('auth.register'); 
    }

    // 4. PROSES AKSI REGISTER (POST)
    public function register(Request $request)
    {
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
            // Menyimpan password angka polos murni (tanpa Hash::make)
            $user = User::create([
                'nama_lengkap' => $request->nama_lengkap,
                'email' => $request->email,
                'password' => $request->password, 
                'role' => 'user', 
            ]);

            // Otomatis inject session login langsung setelah mendaftar
            $request->session()->put('id_user', $user->id_user);
            $request->session()->put('role', $user->role);
            $request->session()->put('nama_lengkap', $user->nama_lengkap);
            
            $request->session()->regenerate();

            return redirect('/')->with('success', 'Akun berhasil dibuat dan otomatis masuk!');
            
        } catch (\Exception $e) {
            return back()->withErrors(['register_error' => 'Terjadi kesalahan sistem.'])->withInput();
        }
    }

    // 5. PROSES AKSI LOGOUT
    public function logout(Request $request)
    {
        // Bersihkan seluruh data session manual pemicu login
        $request->session()->forget(['id_user', 'role', 'nama_lengkap']);
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('success', 'Anda berhasil keluar sistem!');
    }
}