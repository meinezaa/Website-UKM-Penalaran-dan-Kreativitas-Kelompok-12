<?php
$conn = mysqli_connect("127.0.0.1", "root", "password", "upnmengajar", 3306);

if (!$conn) {
    die("ERROR: " . mysqli_connect_error());
}

echo "KONEKSI BERHASIL!";