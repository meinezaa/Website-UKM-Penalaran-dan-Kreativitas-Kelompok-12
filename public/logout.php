<?php
// 1. Panggil Session yang sedang berjalan
session_start();

// 2. Hapus semua data di dalam Session
$_SESSION = [];
session_unset();
session_destroy();

// 3. Hapus Cookies "Remember Me" (Jika sebelumnya ada)
// Caranya adalah dengan memundurkan waktu expired Cookie ke masa lalu (minus 1 jam)
setcookie('id_user', '', time() - 3600, '/');
setcookie('email', '', time() - 3600, '/');

// 4. Tendang kembali user ke halaman Login
header("Location: login.php");
exit();
?>