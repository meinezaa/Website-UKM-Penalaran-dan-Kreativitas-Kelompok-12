<?php
session_start();
require_once 'koneksi.php'; // Menggunakan require_once agar lebih aman

// 1. CEK COOKIE (REMEMBER ME)
if (!isset($_SESSION['id_user']) && isset($_COOKIE['id_user']) && isset($_COOKIE['user_key'])) {
    $cookie_id = $_COOKIE['id_user'];
    $cookie_key = $_COOKIE['user_key'];

    $ambil_data = mysqli_query($koneksi, "SELECT * FROM users WHERE id_user = '$cookie_id'");
    if ($ambil_data && mysqli_num_rows($ambil_data) === 1) {
        $data_cookie = mysqli_fetch_assoc($ambil_data);
        if ($cookie_key === hash('sha256', $data_cookie['email'])) {
            $_SESSION['id_user'] = $data_cookie['id_user'];
            $_SESSION['role'] = $data_cookie['role'];
            $_SESSION['nama_lengkap'] = $data_cookie['nama_lengkap'];
        }
    }
}

// 2. CEK SESSION (JIKA SUDAH LOGIN, LEMPAR KE DASHBOARD)
if (isset($_SESSION['id_user'])) {
    if ($_SESSION['role'] == 'admin') {
        header("Location: dashboard_admin.php");
    } else {
        $id_user_login = $_SESSION['id_user'];
        $cek_riwayat = mysqli_query($koneksi, "SELECT * FROM pendaftaran_relawan WHERE id_user = '$id_user_login'");
        if ($cek_riwayat && mysqli_num_rows($cek_riwayat) > 0) {
            header("Location: status_pendaftaran.php");
        } else {
            header("Location: formulir.php");
        }
    }
    exit();
}

$error_pesan = "";

// 3. LOGIKA LOGIN
if (isset($_POST['login'])) {
    $email = mysqli_real_escape_string($koneksi, $_POST['email']);
    $password = $_POST['password'];

    $query = "SELECT * FROM users WHERE email = '$email'";
    $cek_email = mysqli_query($koneksi, $query);

    if (!$cek_email) {
        die("Query Error: " . mysqli_error($koneksi));
    }

    if (mysqli_num_rows($cek_email) === 1) {
        $data_user = mysqli_fetch_assoc($cek_email);
        
        // Verifikasi Password
        if (password_verify($password, $data_user['password']) || $password == $data_user['password']) {
            
            // Set Session
            $_SESSION['id_user'] = $data_user['id_user'];
            $_SESSION['role'] = $data_user['role'];
            $_SESSION['nama_lengkap'] = $data_user['nama_lengkap'];

            // Set Cookie jika diingat
            if (isset($_POST['remember'])) {
                setcookie('id_user', $data_user['id_user'], time() + (86400 * 30), "/");
                setcookie('user_key', hash('sha256', $data_user['email']), time() + (86400 * 30), "/");
            }

            // Redirect sesuai role
            if ($data_user['role'] == 'admin') {
                header("Location: dashboard_admin.php");
            } else {
                $id_user_login = $data_user['id_user'];
                $cek_riwayat = mysqli_query($koneksi, "SELECT * FROM pendaftaran_relawan WHERE id_user = '$id_user_login'");
                if ($cek_riwayat && mysqli_num_rows($cek_riwayat) > 0) {
                    header("Location: status_pendaftaran.php");
                } else {
                    header("Location: formulir.php");
                }
            }
            exit();

        } else {
            $error_pesan = "Password yang Anda masukkan salah!";
        }
    } else {
        $error_pesan = "Email belum terdaftar!";
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