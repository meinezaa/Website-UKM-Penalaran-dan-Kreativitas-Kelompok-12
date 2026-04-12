<?php
session_start();
require_once 'koneksi.php';

// Jika sudah login, lempar ke dashboard yang sesuai
if (isset($_SESSION['id_user'])) {
    if ($_SESSION['role'] == 'admin') {
        header("Location: dashboard_admin.php");
    } else {
        header("Location: dashboard_user.php");
    }
    exit();
}

$error = '';

if (isset($_POST['login'])) {
    $email = mysqli_real_escape_string($koneksi, $_POST['email']);
    $password = $_POST['password'];

    $query = mysqli_query($koneksi, "SELECT * FROM users WHERE email = '$email'");
    $data = mysqli_fetch_assoc($query);

    if ($data) {
        // PERHATIKAN: Ini menggunakan cek teks asli sesuai request sebelumnya
        if ($password === $data['password']) {
            $_SESSION['id_user'] = $data['id_user'];
            $_SESSION['nama_lengkap'] = $data['nama_lengkap'];
            $_SESSION['role'] = $data['role'];

            if (isset($_POST['remember'])) {
                setcookie('user_login', $email, time() + (86400 * 30), "/");
            }

            if ($data['role'] == 'admin') {
                header("Location: dashboard_admin.php");
            } else {
                header("Location: dashboard_user.php");
            }
            exit();
        } else {
            $error = "Kata sandi salah!";
        }
    } else {
        $error = "Email tidak terdaftar!";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Masuk - UPN Mengajar</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;600;700;800&family=Inter:wght@400;500;600&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        "primary": "#bb0016",
                        "surface": "#fcfcfc",
                        "on-surface": "#1a1c1c",
                        "on-surface-variant": "#6b7280",
                    },
                    fontFamily: { headline: ["Manrope"], body: ["Inter"] }
                }
            }
        }
    </script>
    <style>
        .material-symbols-outlined { font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24; }
        .custom-shadow { box-shadow: 0 25px 50px -12px rgba(187, 0, 22, 0.1); }
        .input-focus:focus { border-color: #bb0016; background-color: white; box-shadow: 0 0 0 4px rgba(187, 0, 22, 0.05); }
    </style>
</head>
<body class="bg-surface font-body text-on-surface min-h-screen flex items-center justify-center p-4 md:p-8">

    <a href="index.php" class="fixed top-6 left-6 z-50 hidden md:flex items-center gap-2 px-5 py-2.5 bg-white border border-gray-100 rounded-full text-xs font-bold text-gray-500 hover:text-primary transition-all shadow-sm group">
        <span class="material-symbols-outlined text-lg group-hover:-translate-x-1 transition-transform">arrow_back</span>
        BERANDA
    </a>

    <main class="w-full max-w-5xl">
        <div class="grid grid-cols-1 lg:grid-cols-12 bg-white rounded-[2rem] md:rounded-[3rem] overflow-hidden custom-shadow border border-gray-50">
            
            <div class="hidden lg:flex lg:col-span-5 flex-col justify-end p-12 relative overflow-hidden bg-gray-900">
                <img src="foto/foto3.jpg" 
                     class="absolute inset-0 w-full h-full object-cover opacity-60 scale-105" alt="Login Visual">
                <div class="absolute inset-0 bg-gradient-to-t from-primary/90 via-primary/20 to-transparent z-10"></div>

                <div class="relative z-20">
                    <div class="w-12 h-1 bg-white mb-6 rounded-full"></div>
                    <h2 class="font-headline text-4xl font-extrabold text-white leading-[1.1] mb-4">
                        Selamat <br/>Datang <span class="text-red-200">Kembali.</span>
                    </h2>
                    <p class="text-white/80 text-sm leading-relaxed max-w-xs italic">
                        "Ilmu adalah investasi terbaik untuk masa depan."
                    </p>
                </div>
            </div>

            <div class="lg:col-span-7 p-8 md:p-16 flex flex-col justify-center">
                <div class="mb-10 text-center lg:text-left">
                    <h1 class="font-headline text-3xl font-black text-on-surface tracking-tight mb-2">Login Relawan</h1>
                    <p class="text-on-surface-variant text-sm">Masuk untuk mengelola kegiatan Anda.</p>
                </div>

                <?php if ($error): ?>
                    <div class="mb-8 flex items-center gap-3 p-4 rounded-2xl text-xs font-bold bg-red-50 text-red-700 border border-red-100">
                        <span class="material-symbols-outlined text-lg">error</span>
                        <?= $error; ?>
                    </div>
                <?php endif; ?>

                <form action="" method="POST" class="space-y-5">
                    <div class="space-y-2">
                        <label class="text-[10px] font-black uppercase tracking-widest text-gray-400 ml-1">Alamat Email</label>
                        <div class="relative group">
                            <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-gray-400 text-lg group-focus-within:text-primary transition-colors">mail</span>
                            <input type="email" name="email" required 
                                value="<?= isset($_COOKIE['user_login']) ? $_COOKIE['user_login'] : ''; ?>"
                                class="w-full pl-12 pr-5 py-4 bg-gray-50 border border-gray-100 rounded-2xl text-sm outline-none transition-all input-focus" 
                                placeholder="nama@email.com">
                        </div>
                    </div>

                    <div class="space-y-2">
                        <div class="flex justify-between items-center px-1">
                            <label class="text-[10px] font-black uppercase tracking-widest text-gray-400">Kata Sandi</label>
                            <a href="#" class="text-[10px] font-bold text-primary hover:underline underline-offset-4">LUPA PASSWORD?</a>
                        </div>
                        <div class="relative group">
                            <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-gray-400 text-lg group-focus-within:text-primary transition-colors">key</span>
                            <input type="password" name="password" required
                                class="w-full pl-12 pr-5 py-4 bg-gray-50 border border-gray-100 rounded-2xl text-sm outline-none transition-all input-focus" 
                                placeholder="••••••••">
                        </div>
                    </div>

                    <div class="flex items-center px-1">
                        <label class="flex items-center gap-3 cursor-pointer group">
                            <input type="checkbox" name="remember" class="w-4 h-4 rounded border-gray-300 text-primary focus:ring-primary/20 transition-all">
                            <span class="text-xs font-semibold text-gray-500 group-hover:text-primary transition-colors">Ingat akun saya</span>
                        </label>
                    </div>

                    <button type="submit" name="login" class="w-full bg-primary hover:bg-red-700 text-white font-headline font-bold py-4 rounded-2xl shadow-lg shadow-red-100 hover:shadow-red-200 active:scale-[0.99] transition-all flex items-center justify-center gap-2 mt-2 text-xs uppercase tracking-[0.2em]">
                        MASUK SEKARANG
                        <span class="material-symbols-outlined text-sm">login</span>
                    </button>
                </form>

                <div class="mt-10 pt-8 border-t border-gray-50 text-center">
                    <p class="text-xs text-on-surface-variant font-medium">
                        Belum memiliki akun? <a href="register.php" class="text-primary font-bold hover:underline underline-offset-4">Daftar Akun</a>
                    </p>
                </div>
            </div>
        </div>
        
        <div class="text-center mt-10">
            <p class="text-[9px] uppercase tracking-[0.4em] font-black text-gray-300">
                UKM Penalaran & Kreativitas • UPN "Veteran" Jawa Timur
            </p>
        </div>
    </main>

</body>
</html>