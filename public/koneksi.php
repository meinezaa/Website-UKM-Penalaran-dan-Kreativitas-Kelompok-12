<?php
$host = "localhost";
$user = "root";
$password = "";
$database = "upnmengajar";

// Membuat koneksi ke database
$koneksi = mysqli_connect($host, $user, $password, $database);

// Mengecek apakah koneksi berhasil atau gagal
if (!$koneksi) {
    die("Koneksi ke database gagal: " . mysqli_connect_error());
}
?>