<?php
$host = "localhost";
$user = "root";
<<<<<<< HEAD
$password = "password";
=======
$password = "meineza";
>>>>>>> 336f0b1 (menambahkan fitur ekspor dan menyambungkan data dengan database)
$database = "upnmengajar";

// Membuat koneksi ke database
$koneksi = mysqli_connect($host, $user, $password, $database);

// Mengecek apakah koneksi berhasil atau gagal
if (!$koneksi) {
    die("Koneksi ke database gagal: " . mysqli_connect_error());
}
?>