<?php
session_start();
require_once 'koneksi.php';

// Jika sudah login, lempar ke dashboard yang sesuai
if (isset($_SESSION['id_user'])) {
    if ($_SESSION['role'] == 'admin') {
        header("Location: dashboard_admin.php");
    } else {
        header("Location: formulir.php");
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
                header("Location: formulir.php");
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
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - UPN Mengajar</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center h-screen">
    <div class="bg-white p-8 rounded-xl shadow-lg w-full max-w-md border-t-4 border-[#8B0000]">
        <div class="text-center mb-8">
            <h2 class="text-3xl font-extrabold text-[#8B0000] mb-2">UPN Mengajar</h2>
            <p class="text-gray-500 text-sm">Silakan masuk ke akun Anda</p>
        </div>

        <?php if ($error_pesan != ""): ?>
            <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6 rounded" role="alert">
                <p class="text-sm font-semibold"><?php echo $error_pesan; ?></p>
            </div>
        <?php endif; ?>

        <form action="" method="POST">
            <div class="mb-5">
                <label class="block text-gray-700 text-sm font-bold mb-2">Alamat Email</label>
                <input type="email" name="email" required 
                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#8B0000]" 
                       placeholder="contoh@gmail.com">
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2">Kata Sandi</label>
                <input type="password" name="password" required 
                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#8B0000]" 
                       placeholder="Masukkan password Anda">
            </div>

            <div class="mb-6 flex items-center">
                <input type="checkbox" name="remember" id="remember" class="w-4 h-4 text-[#8B0000]">
                <label for="remember" class="ml-2 text-sm font-medium text-gray-700">Ingat Saya</label>
            </div>

            <button type="submit" name="login" 
                    class="w-full bg-[#8B0000] text-white font-bold py-3 px-4 rounded-lg hover:bg-red-900 transition duration-300 shadow-md">
                Masuk
            </button>
        </form>

        <p class="text-center text-sm text-gray-600 mt-8">
            Belum punya akun? <br>
            <a href="register.php" class="text-[#8B0000] hover:underline font-bold">Daftar sekarang di sini</a>
        </p>
    </div>
</body>
</html>