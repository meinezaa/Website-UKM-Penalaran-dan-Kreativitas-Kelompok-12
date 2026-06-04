<?php
// 1. Panggil Session yang sedang berjalan
session_start();

// 2. Hapus semua data di dalam Session
$_SESSION = [];
session_unset();
session_destroy();

// 3. Hapus Cookies "Remember Me"
setcookie('id_user', '', time() - 3600, '/');
setcookie('email', '', time() - 3600, '/');

// 4. Arahkan kembali ke halaman Beranda
header("Location: beranda.php");
exit();
?>