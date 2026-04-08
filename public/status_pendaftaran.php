<?php
session_start();
include 'koneksi.php';

// 1. KEAMANAN: Wajib Login
if (!isset($_SESSION['id_user'])) {
    header("Location: login.php");
    exit();
}

$id_user = $_SESSION['id_user'];

// 2. AMBIL DATA PENDAFTARAN: Gabungkan tabel pendaftaran dengan tabel user
$query = "SELECT pendaftaran_relawan.*, users.nama_lengkap 
          FROM pendaftaran_relawan 
          JOIN users ON pendaftaran_relawan.id_user = users.id_user 
          WHERE pendaftaran_relawan.id_user = '$id_user'";

$result = mysqli_query($koneksi, $query);
$data = mysqli_fetch_assoc($result);

// 3. PROTEKSI: Jika ternyata user ini BELUM mendaftar, lempar balik ke form
if (!$data) {
    header("Location: form_pendaftaran.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Status Pendaftaran - UPN Mengajar</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 min-h-screen">

    <div class="max-w-4xl mx-auto py-12 px-4">
        <div class="bg-white rounded-t-2xl shadow-sm p-8 border-b border-gray-100 text-center">
            <div class="inline-flex items-center justify-center w-16 h-16 bg-green-100 text-green-600 rounded-full mb-4">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                </svg>
            </div>
            <h1 class="text-2xl font-bold text-gray-800">Pendaftaran Berhasil Terkirim!</h1>
            <p class="text-gray-500 mt-2">Halo, <?php echo $data['nama_lengkap']; ?>. Tim kami akan segera meninjau berkas Anda.</p>
        </div>

        <div class="bg-white shadow-sm p-8 grid grid-cols-1 md:grid-cols-2 gap-8">
            <div>
                <h2 class="text-sm font-semibold text-gray-400 uppercase tracking-wider mb-4">Detail Pendaftaran</h2>
                <div class="space-y-4">
                    <div>
                        <p class="text-xs text-gray-500">Asal Program Studi</p>
                        <p class="font-medium text-gray-800"><?php echo $data['asal_prodi']; ?></p>
                    </div>
                    <div>
                        <p class="text-xs text-gray-500">Pilihan Divisi</p>
                        <p class="font-medium text-[#8B0000]"><?php echo $data['pilihan_divisi_1']; ?></p>
                    </div>
                    <div>
                        <p class="text-xs text-gray-500">Alasan Bergabung</p>
                        <p class="text-sm text-gray-600 italic">"<?php echo $data['alasan']; ?>"</p>
                    </div>
                </div>
            </div>

            <div>
                <h2 class="text-sm font-semibold text-gray-400 uppercase tracking-wider mb-4">Bukti Pembayaran</h2>
                <div class="border-2 border-dashed border-gray-200 rounded-lg p-2">
                    <img src="uploads/<?php echo $data['bukti_pembayaran']; ?>" 
                         alt="Bukti Transfer" 
                         class="rounded-lg w-full h-48 object-cover shadow-sm">
                </div>
            </div>
        </div>

        <div class="bg-gray-100 rounded-b-2xl p-6 flex flex-col md:flex-row items-center justify-between gap-4">
            <div class="flex items-center gap-3">
                <span class="px-3 py-1 bg-yellow-100 text-yellow-700 text-xs font-bold rounded-full uppercase">
                    Status: Menunggu Verifikasi
                </span>
            </div>
            <div class="flex gap-4">
                <a href="logout.php" class="text-sm font-semibold text-gray-600 hover:text-[#8B0000] transition">Keluar</a>
                <button onclick="window.print()" class="bg-[#8B0000] text-white px-6 py-2 rounded-lg text-sm font-bold hover:bg-red-900 shadow-md transition">
                    Cetak Bukti
                </button>
            </div>
        </div>
    </div>

</body>
</html>