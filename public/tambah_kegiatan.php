<?php
session_start();
require_once 'koneksi.php';

// Satpam Halaman
if (!isset($_SESSION['id_user']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit();
}

if (isset($_POST['simpan'])) {
    $id_admin = $_SESSION['id_user'];
    $nama     = mysqli_real_escape_string($koneksi, $_POST['nama_kegiatan']);
    $tgl      = $_POST['tanggal_pelaksanaan'];
    $lokasi   = mysqli_real_escape_string($koneksi, $_POST['lokasi']);
    $status   = $_POST['status_kegiatan'];

    $query = "INSERT INTO kegiatan (id_user, nama_kegiatan, tanggal_pelaksanaan, lokasi, status_kegiatan) 
              VALUES ('$id_admin', '$nama', '$tgl', '$lokasi', '$status')";
    
    if(mysqli_query($koneksi, $query)) {
        echo "<script>alert('Kegiatan berhasil ditambahkan!'); window.location='dashboard_admin.php';</script>";
    } else {
        echo "Error: " . mysqli_error($koneksi);
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Kegiatan - Admin Panel</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <style> body { font-family: 'Poppins', sans-serif; } </style>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen p-6">

    <div class="max-w-xl w-full bg-white rounded-2xl shadow-xl overflow-hidden">
        <div class="bg-red-700 p-6 text-white text-center">
            <h2 class="text-2xl font-bold">Tambah Kegiatan Baru</h2>
            <p class="text-red-100 text-sm">Isi formulir di bawah untuk menambah master data</p>
        </div>

        <form action="" method="POST" class="p-8 space-y-5">
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Nama Kegiatan</label>
                <input type="text" name="nama_kegiatan" required placeholder="Contoh: Mengajar di Desa A"
                       class="w-full border border-gray-300 px-4 py-2.5 rounded-lg focus:ring-2 focus:ring-red-500 focus:outline-none transition">
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Tanggal Pelaksanaan</label>
                    <input type="date" name="tanggal_pelaksanaan" required 
                           class="w-full border border-gray-300 px-4 py-2.5 rounded-lg focus:ring-2 focus:ring-red-500 focus:outline-none transition">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Status</label>
                    <select name="status_kegiatan" class="w-full border border-gray-300 px-4 py-2.5 rounded-lg focus:ring-2 focus:ring-red-500 focus:outline-none transition">
                        <option value="aktif">Aktif</option>
                        <option value="selesai">Selesai</option>
                    </select>
                </div>
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Lokasi Kegiatan</label>
                <input type="text" name="lokasi" required placeholder="Gedung atau Nama Desa"
                       class="w-full border border-gray-300 px-4 py-2.5 rounded-lg focus:ring-2 focus:ring-red-500 focus:outline-none transition">
            </div>

            <div class="flex gap-4 pt-4 border-t border-gray-100">
                <button type="submit" name="simpan" 
                        class="flex-1 bg-red-700 text-white font-bold py-3 rounded-lg hover:bg-red-800 shadow-lg transition-all">
                    Simpan Data
                </button>
                <a href="dashboard_admin.php" 
                   class="flex-1 bg-gray-200 text-gray-700 font-bold py-3 rounded-lg text-center hover:bg-gray-300 transition-all">
                    Batal
                </a>
            </div>
        </form>
    </div>

</body>
</html>