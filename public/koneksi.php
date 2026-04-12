<?php
// Konfigurasi Database
$host       = "localhost"; // Server database (biasanya localhost untuk XAMPP)
$user       = "root";      // Username default XAMPP
$password   = "password";          // Password default XAMPP (kosongkan saja)
$database   = "upnmengajar"; // Nama database kamu sesuai di phpMyAdmin

// Membuat koneksi ke database
$koneksi = mysqli_connect($host, $user, $password, $database);

// Mengecek apakah koneksi berhasil atau gagal
if (!$koneksi) {
    die("Koneksi ke database gagal: " . mysqli_connect_error());
}
?>