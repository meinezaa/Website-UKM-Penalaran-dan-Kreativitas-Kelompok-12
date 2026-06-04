<?php
// =======================
// KONFIGURASI DATABASE
// =======================

$host     = "localhost";
$user     = "root";
$password = "";
$db       = "upnmengajar";
$port = 3307; // Sesuaikan dengan yang ada di XAMPP kamu tadi

// =======================
// KONEKSI
// =======================

$koneksi = mysqli_connect($host, $user, $password, $db, $port);

// =======================
// CEK KONEKSI
// =======================

if (!$koneksi) {
    die("Koneksi database gagal: " . mysqli_connect_error());
}

// optional (biar aman encoding karakter)
mysqli_set_charset($koneksi, "utf8mb4");
?>