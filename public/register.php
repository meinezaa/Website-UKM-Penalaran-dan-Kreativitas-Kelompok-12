<?php
session_start();
include 'koneksi.php'; // Memanggil jembatan database

// Jika user sudah login, arahkan pergi (tidak boleh daftar lagi)
if (isset($_SESSION['id_user'])) {
    header("Location: beranda.php");
    exit();
}

$pesan_error = "";
$pesan_sukses = "";

// Jika tombol "Daftar" ditekan
if (isset($_POST['register'])) {
    $nama = mysqli_real_escape_string($koneksi, $_POST['nama']);
    $email = mysqli_real_escape_string($koneksi, $_POST['email']);
    $password = mysqli_real_escape_string($koneksi, $_POST['password']);

    // 1. Cek dulu, apakah email ini sudah pernah dipakai mendaftar?
    $cek_email = mysqli_query($koneksi, "SELECT * FROM users WHERE email = '$email'");
    
    if (mysqli_num_rows($cek_email) > 0) {
        // Kalau email sudah ada di database, tolak!
        $pesan_error = "Email sudah terdaftar! Silakan gunakan email lain atau langsung Login.";
    } else {
        // 2. Jika email aman, Acak/Sembunyikan Password demi keamanan (SANGAT PENTING)
        $password_hash = password_hash($password, PASSWORD_DEFAULT);
        
        // 3. Masukkan data ke tabel users. 
        // (Perhatikan: kita otomatis mengisi kolom 'role' dengan 'user')
        $query_insert = "INSERT INTO users (nama_lengkap, email, password, role) 
                         VALUES ('$nama', '$email', '$password_hash', 'user')";
        
        if (mysqli_query($koneksi, $query_insert)) {
            $pesan_sukses = "Akun berhasil dibuat! Silakan klik tombol Login di bawah.";
        } else {
            $pesan_error = "Terjadi kesalahan saat menyimpan data ke database.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Akun - UPN Mengajar</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen p-4">

    <div class="bg-white p-8 rounded-xl shadow-lg w-full max-w-md border-t-4 border-[#8B0000]">
        
        <div class="text-center mb-8">
            <h2 class="text-3xl font-extrabold text-[#8B0000] mb-2">Buat Akun</h2>
            <p class="text-gray-500 text-sm">Bergabunglah menjadi relawan UPN Mengajar</p>
        </div>

        <?php if ($pesan_error != ""): ?>
            <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6 rounded" role="alert">
                <p class="text-sm font-semibold"><?php echo $pesan_error; ?></p>
            </div>
        <?php endif; ?>

        <?php if ($pesan_sukses != ""): ?>
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded" role="alert">
                <p class="text-sm font-semibold"><?php echo $pesan_sukses; ?></p>
            </div>
        <?php endif; ?>

        <form action="" method="POST">
            
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="nama">Nama Lengkap</label>
                <input type="text" name="nama" id="nama" required 
                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#8B0000] focus:border-transparent transition" 
                       placeholder="Masukkan nama asli Anda">
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="email">Alamat Email</label>
                <input type="email" name="email" id="email" required 
                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#8B0000] focus:border-transparent transition" 
                       placeholder="contoh@gmail.com">
            </div>

            <div class="mb-6">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="password">Kata Sandi</label>
                <input type="password" name="password" id="password" required minlength="6"
                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#8B0000] focus:border-transparent transition" 
                       placeholder="Minimal 6 karakter">
            </div>

            <button type="submit" name="register" 
                    class="w-full bg-[#8B0000] text-white font-bold py-3 px-4 rounded-lg hover:bg-red-900 transition duration-300 shadow-md mb-4">
                Daftar Sekarang
            </button>
        </form>

        <p class="text-center text-sm text-gray-600 mt-4">
            Sudah punya akun? <br>
            <a href="login.php" class="text-[#8B0000] hover:underline font-bold">Masuk di sini</a>
        </p>

    </div>

</body>
</html>