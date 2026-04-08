<?php
session_start();
include 'koneksi.php';

// 1. KEAMANAN: Pastikan yang mengakses file ini HANYA orang yang sudah login
if (!isset($_SESSION['id_user'])) {
    header("Location: login.php");
    exit();
}

// 2. JIKA TOMBOL KIRIM DITEKAN
if (isset($_POST['daftar_relawan'])) {
    
    // Ambil ID User dari Session (kartu identitas saat dia login)
    $id_user = $_SESSION['id_user'];
    
    // Ambil data teks dari form (gunakan real_escape_string untuk mencegah hacker/SQL Injection)
    $asal_prodi = mysqli_real_escape_string($koneksi, $_POST['asal_prodi']);
    $pilihan_divisi = mysqli_real_escape_string($koneksi, $_POST['pilihan_divisi']);
    $alasan = mysqli_real_escape_string($koneksi, $_POST['alasan']);
    
    // Cek apakah kotak persetujuan dicentang (Jika dicentang nilainya 1, jika tidak 0)
    $persetujuan = isset($_POST['persetujuan']) ? 1 : 0;

    // 3. LOGIKA UPLOAD BUKTI PEMBAYARAN
    $nama_file_asli = $_FILES['bukti_pembayaran']['name'];
    $ukuran_file    = $_FILES['bukti_pembayaran']['size'];
    $error_file     = $_FILES['bukti_pembayaran']['error'];
    $tmp_name       = $_FILES['bukti_pembayaran']['tmp_name'];

    // Cek apakah user benar-benar mengunggah file
    if ($error_file === 4) {
        echo "<script>alert('Pilih foto bukti pembayaran terlebih dahulu!'); window.history.back();</script>";
        exit();
    }

    // Pastikan yang diunggah hanya gambar (jpg, jpeg, png)
    $ekstensi_valid = ['jpg', 'jpeg', 'png'];
    $ekstensi_file  = explode('.', $nama_file_asli);
    $ekstensi_file  = strtolower(end($ekstensi_file));

    if (!in_array($ekstensi_file, $ekstensi_valid)) {
        echo "<script>alert('Yang Anda unggah bukan gambar! Hanya boleh JPG/PNG.'); window.history.back();</script>";
        exit();
    }

    // Pastikan ukuran file tidak terlalu besar (Maksimal 2 MB = 2.000.000 byte)
    if ($ukuran_file > 2000000) {
        echo "<script>alert('Ukuran foto terlalu besar! Maksimal 2 MB.'); window.history.back();</script>";
        exit();
    }

    // UBAH NAMA FILE: Agar tidak bentrok jika ada 2 orang upload file bernama "struk.jpg"
    // Kita tambahkan angka acak dari waktu saat ini di depan nama filenya
    $nama_file_baru = time() . '_' . $nama_file_asli;
    
    // Tentukan alamat folder tujuan
    $folder_tujuan = 'uploads/' . $nama_file_baru;

    // PINDAHKAN FILE dari tempat sementara ke folder 'uploads/'
    if (move_uploaded_file($tmp_name, $folder_tujuan)) {
        
        // 4. JIKA FOTO BERHASIL PINDAH, MASUKKAN DATA KE DATABASE
        $query_insert = "INSERT INTO pendaftaran_relawan 
                        (id_user, asal_prodi, pilihan_divisi_1, alasan, bukti_pembayaran, persetujuan) 
                        VALUES 
                        ('$id_user', '$asal_prodi', '$pilihan_divisi', '$alasan', '$nama_file_baru', '$persetujuan')";
        
        if (mysqli_query($koneksi, $query_insert)) {
            // Jika berhasil masuk database, arahkan ke halaman Sukses/Status
            header("Location: status_pendaftaran.php");
            exit();
        } else {
            echo "Error Database: " . mysqli_error($koneksi);
        }

    } else {
        echo "<script>alert('Gagal mengunggah foto. Pastikan folder uploads/ sudah ada!'); window.history.back();</script>";
    }
} else {
    // Jika ada orang iseng mencoba buka file ini tanpa menekan tombol form
    header("Location: form_pendaftaran.php");
    exit();
}
?>