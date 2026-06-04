<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AuthController extends Controller
{
    public function showLogin() {
        return view('login');
    }

    public function login(Request $request) {
        $user = DB::table('users')->where('email', $request->email)->first();
        
        if ($user && $request->password === $user->password) {
            session(['id_user' => $user->id_user]);
            session(['nama_lengkap' => $user->nama_lengkap]);
            session(['role' => $user->role]);
            
            if ($user->role === 'admin') {
                return redirect('/admin/dashboard');
            }
            return redirect('/beranda');
        }
        
        return back()->with('error', 'Email atau password salah!');
    }

    public function showRegister() {
        return view('register');
    }

    public function register(Request $request) {
        $exists = DB::table('users')->where('email', $request->email)->exists();
        
        if ($exists) {
            return back()->with('error', 'Email sudah digunakan!');
        }
        
        if ($request->password !== $request->konfirmasi_password) {
            return back()->with('error', 'Konfirmasi password tidak cocok!');
        }

        DB::table('users')->insert([
            'nama_lengkap' => $request->nama_lengkap,
            'email' => $request->email,
            'password' => $request->password, // Gunakan Hash::make() untuk production
            'role' => 'user',
        ]);

        return redirect('/login')->with('success', 'Akun berhasil dibuat! Silakan login.');
    }

    public function logout() {
        session()->flush();
        return redirect('/beranda');
    }
}