<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    /**
     * Menampilkan Halaman Form Login
     */
    public function showLogin()
    {
        // Jika sudah login, lempar langsung sesuai rolenya (Satpam Login)
        if (Auth::check()) {
            return Auth::user()->role === 'admin' 
                ? redirect()->route('admin.dashboard') 
                : redirect()->url('/');
        }

        return view('auth.login');
    }

    /**
     * Memproses Pengisian Kredensial Pengguna
     */
    public function prosesLogin(Request $request)
    {
        // 1. Validasi Input Form
        $kredensial = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        // Mengambil opsi input 'ingat saya'
        $remember = $request->has('remember');

        /**
         * 2. OPSI A: Jika database Anda menggunakan enkripsi standar Laravel Hash (Direkomendasikan)
         * Anda tinggal menggunakan baris kode di bawah ini:
         * * if (Auth::attempt($kredensial, $remember)) {
         * $request->session()->regenerate();
         * return Auth::user()->role === 'admin' 
         * ? redirect()->route('admin.dashboard') 
         * : redirect()->url('/');
         * }
         */

        // 3. OPSI B: Jika database lama Anda masih menyimpan password berupa Plain Text (Tanpa Enkripsi)
        $user = DB::table('users')->where('email', $kredensial['email'])->first();

        if ($user && $user->password === $kredensial['password']) {
            // Membuka sistem login login via ID secara manual ke Laravel Auth Guard
            Auth::loginUsingId($user->id_user, $remember);
            $request->session()->regenerate();

            // Melempar halaman sesuai peran hak akses (Role-Based Redirect)
            return $user->role === 'admin' 
                ? redirect()->route('admin.dashboard') 
                : redirect()->url('/');
        }

        // Kembali dengan pesan kegagalan jika data tidak valid
        return back()->withErrors([
            'email' => 'Kredensial yang Anda masukkan salah atau belum terdaftar.',
        ])->onlyInput('email');
    }

    /**
     * Menampilkan Halaman Form Registrasi / Pendaftaran
     */
    public function showRegister()
    {
        // Satpam Halaman: Jika sudah login tidak boleh mendaftar lagi
        if (Auth::check()) {
            return Auth::user()->role === 'admin' 
                ? redirect()->route('admin.dashboard') 
                : redirect()->url('/');
        }

        return view('auth.register');
    }

    /**
     * Memproses Penyimpanan Data Pendaftaran User/Relawan Baru
     */
    public function prosesRegister(Request $request)
    {
        // 1. Jalankan Fitur Validasi Laravel (Otomatis mengecek kecocokan password & keunikan email)
        $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'email'        => 'required|string|email|max:255|unique:users,email',
            'password'     => 'required|string|min:6|confirmed', // 'confirmed' otomatis memeriksa input 'password_confirmation'
        ], [
            'email.unique'       => 'Email sudah digunakan!',
            'password.confirmed' => 'Konfirmasi password tidak cocok!',
            'password.min'       => 'Password minimal harus berjumlah 6 karakter.'
        ]);

        // 2. Eksekusi Query Insert menggunakan Query Builder Laravel
        // Catatan: Jika aplikasi Anda login menggunakan Plain Text (tanpa Hash), simpan langsung $request->password.
        // Namun, jika sudah beralih menggunakan keamanan Hash, ubah nilainya menjadi: Hash::make($request->password)
        DB::table('users')->insert([
            'nama_lengkap' => $request->nama_lengkap,
            'email'        => $request->email,
            'password'     => $request->password, // Disarankan diganti: bcrypt($request->password) demi keamanan EAS
            'role'         => 'user',
        ]);

        // 3. Kembalikan ke halaman pendaftaran disertai pesan kilat sukses
        return redirect()->route('register')->with('sukses', 'Akun berhasil dibuat! Silakan login.');
    }
}