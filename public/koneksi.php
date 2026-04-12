<?php
$host     = "localhost"; 
$user     = "root";         
$password = "password";            
$db       = "upnmengajar";

$koneksi = mysqli_connect($host, $user, $password, $db);
// Mengecek apakah koneksi berhasil atau gagal
if (!$koneksi) {
    die("Koneksi database gagal: " . mysqli_connect_error());
}
?>