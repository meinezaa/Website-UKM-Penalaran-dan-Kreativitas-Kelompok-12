<?php
session_start();
include 'koneksi.php';

// Pastikan user sudah login
if (!isset($_SESSION['id_user'])) {
    header("Location: login.php");
    exit();
}

if (isset($_POST['daftar_relawan'])) {
    $id_user = $_SESSION['id_user'];
    
    // Tangkap data dari form
    $no_hp     = mysqli_real_escape_string($koneksi, $_POST['no_hp']);
    $umur      = mysqli_real_escape_string($koneksi, $_POST['umur']);
    $jk        = mysqli_real_escape_string($koneksi, $_POST['jenis_kelamin']);
    $prodi     = mysqli_real_escape_string($koneksi, $_POST['asal_prodi']);
    $divisi1   = mysqli_real_escape_string($koneksi, $_POST['pilihan_divisi_1']);
    $divisi2   = mysqli_real_escape_string($koneksi, $_POST['pilihan_divisi_2']);
    $porto     = mysqli_real_escape_string($koneksi, $_POST['portofolio']);
    $deskripsi = mysqli_real_escape_string($koneksi, $_POST['deskripsi']);
    $metode    = mysqli_real_escape_string($koneksi, $_POST['metode_pembayaran']);

    // ID Kegiatan yang kita tuju
    $id_kegiatan = 1; 

    // VALIDASI: Cek apakah id_kegiatan benar-benar ada di tabel kegiatan?
    $cek_kegiatan = mysqli_query($koneksi, "SELECT id_kegiatan FROM kegiatan WHERE id_kegiatan = '$id_kegiatan'");
    if (mysqli_num_rows($cek_kegiatan) == 0) {
        die("Error: Data di tabel 'kegiatan' masih kosong! Masukkan minimal satu data kegiatan dengan ID $id_kegiatan di phpMyAdmin terlebih dahulu.");
    }

    // Proses Upload Bukti Pembayaran
    $target_dir = "uploads/";
    if (!is_dir($target_dir)) {
        mkdir($target_dir, 0777, true);
    }
    
    $file_extension = pathinfo($_FILES['bukti_pembayaran']['name'], PATHINFO_EXTENSION);
    $file_name = "BUKTI_" . time() . "_" . $id_user . "." . $file_extension;
    $target_file = $target_dir . $file_name;

    if (move_uploaded_file($_FILES['bukti_pembayaran']['tmp_name'], $target_file)) {
        
        // Query Insert (Sesuaikan nama kolom dengan tabel pendaftaran_relawan kamu)
        $sql = "INSERT INTO pendaftaran_relawan 
                (id_user, id_kegiatan, no_hp, umur, jenis_kelamin, asal_prodi, pilihan_divisi_1, pilihan_divisi_2, portofolio, pengalaman_keahlian, metode_pembayaran, bukti_pembayaran) 
                VALUES 
                ('$id_user', '$id_kegiatan', '$no_hp', '$umur', '$jk', '$prodi', '$divisi1', '$divisi2', '$porto', '$deskripsi', '$metode', '$file_name')";

        if (mysqli_query($koneksi, $sql)) {
            echo "<script>alert('Pendaftaran Berhasil!'); window.location.href='status_pendaftaran.php';</script>";
        } else {
            // Jika gagal karena Foreign Key atau lainnya, akan tampil di sini
            echo "Gagal menyimpan ke database: " . mysqli_error($koneksi);
        }
    } else {
        echo "<script>alert('Gagal mengunggah file bukti pembayaran!'); window.history.back();</script>";
    }
} else {
    header("Location: formulir.php");
}
?>