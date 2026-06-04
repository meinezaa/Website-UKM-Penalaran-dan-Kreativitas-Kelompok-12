<?php
session_start();
require_once 'koneksi.php';

// Satpam Halaman
if (!isset($_SESSION['id_user']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit();
}

// Ambil ID dari URL
if (!isset($_GET['id'])) {
    header("Location: dashboard_admin.php");
    exit();
}

$id = $_GET['id'];
$result = mysqli_query($koneksi, "SELECT * FROM kegiatan WHERE id_kegiatan = '$id'");
$data = mysqli_fetch_assoc($result);

// Jika ID tidak ditemukan di database
if (!$data) {
    echo "<script>alert('Data tidak ditemukan!'); window.location='dashboard_admin.php';</script>";
    exit();
}

// Logika Update
if (isset($_POST['update'])) {
    $nama   = mysqli_real_escape_string($koneksi, $_POST['nama_kegiatan']);
    $tgl    = $_POST['tanggal_pelaksanaan'];
    $lokasi = mysqli_real_escape_string($koneksi, $_POST['lokasi']);
    $status = $_POST['status_kegiatan'];

    $query_update = "UPDATE kegiatan SET 
                    nama_kegiatan = '$nama', 
                    tanggal_pelaksanaan = '$tgl', 
                    lokasi = '$lokasi', 
                    status_kegiatan = '$status' 
                    WHERE id_kegiatan = '$id'";

    if(mysqli_query($koneksi, $query_update)) {
        echo "<script>alert('Data berhasil diperbarui!'); window.location='dashboard_admin.php';</script>";
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
    <title>Edit Kegiatan - Admin Panel</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <style> body { font-family: 'Poppins', sans-serif; } </style>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen p-6">

    <div class="max-w-xl w-full bg-white rounded-2xl shadow-xl overflow-hidden border-t-4 border-blue-600">
        <div class="p-6 text-center">
            <h2 class="text-2xl font-bold text-gray-800">Edit Data Kegiatan</h2>
            <p class="text-gray-500 text-sm">Silakan ubah data yang diperlukan</p>
        </div>

        <form action="" method="POST" class="p-8 space-y-5">
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Nama Kegiatan</label>
                <input type="text" name="nama_kegiatan" required 
                       value="<?= htmlspecialchars($data['nama_kegiatan']); ?>"
                       class="w-full border border-gray-300 px-4 py-2.5 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none transition">
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Tanggal Pelaksanaan</label>
                    <input type="date" name="tanggal_pelaksanaan" required 
                           value="<?= $data['tanggal_pelaksanaan']; ?>"
                           class="w-full border border-gray-300 px-4 py-2.5 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none transition">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Status</label>
                    <select name="status_kegiatan" class="w-full border border-gray-300 px-4 py-2.5 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none transition">
                        <option value="aktif" <?= ($data['status_kegiatan'] == 'aktif') ? 'selected' : ''; ?>>Aktif</option>
                        <option value="selesai" <?= ($data['status_kegiatan'] == 'selesai') ? 'selected' : ''; ?>>Selesai</option>
                    </select>
                </div>
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Lokasi Kegiatan</label>
                <input type="text" name="lokasi" required 
                       value="<?= htmlspecialchars($data['lokasi']); ?>"
                       class="w-full border border-gray-300 px-4 py-2.5 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none transition">
            </div>

            <div class="flex gap-4 pt-4 border-t border-gray-100">
                <button type="submit" name="update" 
                        class="flex-1 bg-blue-600 text-white font-bold py-3 rounded-lg hover:bg-blue-700 shadow-lg transition-all">
                    Simpan Perubahan
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