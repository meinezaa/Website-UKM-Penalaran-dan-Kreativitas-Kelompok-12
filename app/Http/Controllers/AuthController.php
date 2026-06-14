<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Routing\Controller as BaseController; 
// 1. WAJIB DIIMPORT: Panggil facade Cookie bawaan Laravel
use Illuminate\Support\Facades\Cookie;

class AuthController extends BaseController
{
    // 1. MENAMPILKAN HALAMAN LOGIN
    public function showLogin()
    {
        // Kondisi A: Jika session login utama masih aktif, langsung arahkan ke beranda
        if (session('id_user')) {
            return $this->redirectByRole(session('role'));
        }
        
        // Kondisi B: JIKA COOKIE 'remember_user_id' TERDETEKSI (Fitur Remember Me Kerja)
        if (Cookie::has('remember_user_id')) {
            $userId = Cookie::get('remember_user_id'); // Ambil ID User dari Cookie browser
            $user = User::find($userId);

            if ($user) {
                // Buat ulang Session otomatis menggunakan sisa data dari Cookie
                session([
                    'id_user'      => $user->id_user,
                    'role'         => $user->role,
                    'nama_lengkap' => $user->nama_lengkap
                ]);

                return $this->redirectByRole($user->role);
            }
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

        $user = User::where('email', $request->email)->first();

        // Pencocokan string polos langsung menggunakan === (Sesuai database-mu)
        if ($user && $request->password === $user->password) {
            
            // Set Session Login Utama
            $request->session()->put('id_user', $user->id_user);
            $request->session()->put('role', $user->role);
            $request->session()->put('nama_lengkap', $user->nama_lengkap);
            $request->session()->regenerate();

            // =========================================================================
            // TAMBAHAN FITUR: PROSES PEMBUATAN COOKIE REMEMBER ME
            // =========================================================================
            if ($request->has('remember')) {
                // Membuat cookie bernama 'remember_user_id' untuk menyimpan ID user.
                // Angka 1440 artinya cookie akan aktif selama 24 Jam penuh di browser.
                Cookie::queue('remember_user_id', $user->id_user, 1440);
            }

            return $this->redirectByRole($user->role);
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
            $user = User::create([
                'nama_lengkap' => $request->nama_lengkap,
                'email' => $request->email,
                'password' => $request->password, 
                'role' => 'user', 
            ]);

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
        // Hapus data session login
        $request->session()->forget(['id_user', 'role', 'nama_lengkap']);
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // =========================================================================
        // TAMBAHAN FITUR: Hancurkan cookie remember me saat logout klik
        // =========================================================================
        Cookie::queue(Cookie::forget('remember_user_id'));

        return redirect('/')->with('success', 'Anda berhasil keluar sistem!');
    }

    // Fungsi pembantu (Helper) untuk mempersingkat pengalihan halaman berdasarkan role
    private function redirectByRole($role)
    {
        if ($role === 'admin') {
            return redirect()->route('admin.dashboard');
        }
        return redirect('/');
    }
}