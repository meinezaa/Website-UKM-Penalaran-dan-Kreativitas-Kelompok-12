<?php
session_start();
<<<<<<< HEAD
include 'koneksi.php';

// 1. KEAMANAN: Wajib Login
=======
require_once 'koneksi.php';

>>>>>>> 8bcdb12b7636cec022ab4e8d96f0b7b0d0186066
if (!isset($_SESSION['id_user'])) {
    header("Location: login.php");
    exit();
}

$id_user = $_SESSION['id_user'];

<<<<<<< HEAD
// 2. AMBIL DATA PENDAFTARAN: Gabungkan tabel pendaftaran dengan tabel user
$query = "SELECT pendaftaran_relawan.*, users.nama_lengkap 
          FROM pendaftaran_relawan 
          JOIN users ON pendaftaran_relawan.id_user = users.id_user 
          WHERE pendaftaran_relawan.id_user = '$id_user'";
=======
// Query mengambil data pendaftaran terakhir milik user yang login
$query = "SELECT p.*, u.nama_lengkap, k.nama_kegiatan 
          FROM pendaftaran_relawan p
          LEFT JOIN users u ON p.id_user = u.id_user
          LEFT JOIN kegiatan k ON p.id_kegiatan = k.id_kegiatan
          WHERE p.id_user = '$id_user' 
          ORDER BY p.id_pendaftaran DESC LIMIT 1";
>>>>>>> 8bcdb12b7636cec022ab4e8d96f0b7b0d0186066

$result = mysqli_query($koneksi, $query);
$data = mysqli_fetch_assoc($result);

<<<<<<< HEAD
// 3. PROTEKSI: Jika ternyata user ini BELUM mendaftar, lempar balik ke form
if (!$data) {
    header("Location: form_pendaftaran.php");
    exit();
}
?>

=======
if (!$data) {
    echo "<script>alert('Data pendaftaran tidak ditemukan.'); window.location.href='formulir.php';</script>";
    exit();
}

$nama_lengkap = isset($data['nama_lengkap']) ? $data['nama_lengkap'] : 'Calon Anggota';
$nama_depan = explode(' ', trim($nama_lengkap))[0];
$status = strtolower($data['status_seleksi']); // Mengambil status (pending/diterima/ditolak)
?>
>>>>>>> 8bcdb12b7636cec022ab4e8d96f0b7b0d0186066
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
<<<<<<< HEAD
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

=======
    <title>Status Pendaftaran | UPN Mengajar</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; background-color: #ffffff; }
        .gradient-text { background: linear-gradient(90deg, #bb0016, #ff4d4d); -webkit-background-clip: text; -webkit-text-fill-color: transparent; }
    </style>
</head>
<body class="min-h-screen flex items-center justify-center p-6">
    <div class="max-w-md w-full text-center">
        <div class="mb-8">
            <div class="w-20 h-20 bg-red-50 rounded-full flex items-center justify-center mx-auto">
                <svg class="w-10 h-10 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path>
                </svg>
            </div>
        </div>

        <h1 class="text-3xl font-extrabold text-gray-900 mb-4">Terima Kasih, <br><span class="gradient-text"><?php echo htmlspecialchars($nama_depan); ?>!</span></h1>
        
        <p class="text-gray-500 text-sm leading-relaxed mb-6 px-4">
            Pendaftaranmu untuk <span class="font-bold text-gray-800"><?php echo isset($data['nama_kegiatan']) ? htmlspecialchars($data['nama_kegiatan']) : 'UPN Mengajar'; ?></span> telah berhasil kami terima.
        </p>

        <div class="mb-10">
            <?php if($status == 'pending'): ?>
                <span class="px-4 py-2 rounded-full bg-yellow-50 text-yellow-600 text-[10px] font-black uppercase tracking-widest border border-yellow-100">
                    Status: Menunggu Verifikasi
                </span>
            <?php elseif($status == 'diterima'): ?>
                <span class="px-4 py-2 rounded-full bg-green-50 text-green-600 text-[10px] font-black uppercase tracking-widest border border-green-100">
                    Status: Selamat! Kamu Diterima
                </span>
            <?php else: ?>
                <span class="px-4 py-2 rounded-full bg-red-50 text-red-600 text-[10px] font-black uppercase tracking-widest border border-red-100">
                    Status: Mohon Maaf, Belum Lolos
                </span>
            <?php endif; ?>
        </div>

        <div class="bg-gray-50 rounded-[2.5rem] p-8 border border-gray-100 mb-8 shadow-sm">
            <h3 class="text-gray-800 font-bold mb-3 text-lg">Gabung Grup Koordinasi</h3>
            <p class="text-[11px] text-gray-400 leading-relaxed mb-6 italic">
                "Wajib bagi seluruh calon anggota untuk bergabung ke grup koordinasi WhatsApp untuk informasi alur seleksi selanjutnya."
            </p>
            
            <a href="https://chat.whatsapp.com/GANTI_DENGAN_LINK_GRUP_KAMU" target="_blank" class="flex items-center justify-center gap-3 w-full py-4 bg-green-500 hover:bg-green-600 text-white rounded-2xl font-bold text-xs uppercase tracking-widest transition-all shadow-lg shadow-green-100 active:scale-95">
                Masuk Grup WhatsApp
            </a>
        </div>

        <div>
            <a href="beranda.html" class="inline-block text-[10px] font-bold text-gray-400 hover:text-red-600 uppercase tracking-[0.2em] transition-all">Kembali ke Beranda</a>
        </div>
    </div>
>>>>>>> 8bcdb12b7636cec022ab4e8d96f0b7b0d0186066
</body>
</html>