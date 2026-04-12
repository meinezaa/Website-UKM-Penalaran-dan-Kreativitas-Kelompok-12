<?php
session_start();
require_once 'koneksi.php';

// SATPAM HALAMAN
if (!isset($_SESSION['id_user']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit();
}

// LOGIKA HAPUS KEGIATAN
if (isset($_GET['hapus_kegiatan'])) {
    $id_hapus = mysqli_real_escape_string($koneksi, $_GET['hapus_kegiatan']);
    mysqli_query($koneksi, "DELETE FROM kegiatan WHERE id_kegiatan = '$id_hapus'");
    header("Location: dashboard_admin.php?pesan=terhapus"); 
    exit();
}

// 1. AMBIL STATISTIK DINAMIS
$res_relawan = mysqli_query($koneksi, "SELECT COUNT(*) as total FROM users WHERE role = 'user'");
$count_relawan = mysqli_fetch_assoc($res_relawan)['total'] ?? 0;

$res_program = mysqli_query($koneksi, "SELECT COUNT(*) as total FROM kegiatan WHERE status_kegiatan = 'aktif'");
$count_program = mysqli_fetch_assoc($res_program)['total'] ?? 0;

$res_baru = mysqli_query($koneksi, "SELECT COUNT(*) as total FROM pendaftaran_relawan WHERE LOWER(status_seleksi) = 'pending'");
$count_baru = mysqli_fetch_assoc($res_baru)['total'] ?? 0;
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - UPN Mengajar</title>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;600;700;800&family=Inter:wght@400;500;600&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        "primary": "#bb0016",
                        "primary-container": "#e32128",
                        "surface": "#f9f9f9",
                        "on-surface": "#1a1c1c",
                        "surface-container-low": "#f3f3f3",
                        "surface-container-lowest": "#ffffff",
                    },
                    fontFamily: { headline: ["Manrope"], body: ["Inter"] }
                }
            }
        }
    </script>
    <style>
        .material-symbols-outlined { font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24; }
        body { font-family: 'Inter', sans-serif; min-height: 100vh; }
    </style>
</head>
<body class="bg-surface text-on-surface flex">

<aside class="h-screen w-72 fixed left-0 top-0 bottom-0 z-50 p-6 flex flex-col bg-surface-container-lowest border-r shadow-[20px_0_40px_rgba(0,0,0,0.02)]">
    <div class="mb-10 px-4">
        <span class="font-headline font-extrabold text-primary text-2xl tracking-tighter uppercase">UPN Mengajar</span>
    </div>

    <div class="flex items-center gap-4 px-4 py-6 mb-6 rounded-xl bg-surface-container-low">
        <div class="w-12 h-12 rounded-full bg-red-50 text-primary flex items-center justify-center font-bold">
            <span class="material-symbols-outlined">person</span>
        </div>
        <div>
            <p class="font-body font-semibold text-on-surface text-sm leading-none"><?= $_SESSION['nama_lengkap'] ?? 'Admin'; ?></p>
            <p class="text-[10px] text-gray-400 uppercase tracking-wider mt-1">Super Admin</p>
        </div>
    </div>

    <nav class="flex-1 space-y-2">
        <a href="dashboard_admin.php" class="flex items-center gap-3 px-4 py-3 rounded-lg font-body font-medium text-sm transition-all bg-primary text-white shadow-md shadow-red-200">
            <span class="material-symbols-outlined text-[20px]">dashboard</span> Dashboard
        </a>
        <a href="data_relawan.php" class="flex items-center gap-3 px-4 py-3 rounded-lg font-body font-medium text-sm text-gray-600 hover:bg-surface-container-low transition-all">
            <span class="material-symbols-outlined text-[20px]">group</span> Data Relawan
        </a>
        <a href="data_kegiatan.php" class="flex items-center gap-3 px-4 py-3 rounded-lg font-body font-medium text-sm text-gray-600 hover:bg-surface-container-low transition-all">
            <span class="material-symbols-outlined text-[20px]">assignment</span> Kegiatan
        </a>
    </nav>

    <div class="pt-6 border-t border-surface-container">
        <a href="logout.php" onclick="return confirm('Apakah Anda yakin ingin keluar?')" class="flex items-center gap-3 px-4 py-3 rounded-lg font-body font-medium text-sm text-red-600 hover:bg-red-50 transition-all group">
            <span class="material-symbols-outlined text-[20px] group-hover:rotate-12 transition-transform">logout</span> Logout
        </a>
    </div>
</aside>

<main class="flex-1 ml-72 min-h-screen pb-20">
    <header class="w-full sticky top-0 z-40 bg-white/80 backdrop-blur-md flex justify-between items-center px-8 py-4 border-b">
        <h1 class="font-headline font-bold text-2xl text-primary">Dashboard</h1>
        <div class="flex items-center gap-4">
            <div class="w-10 h-10 rounded-full border-2 border-primary-container p-0.5">
                <img src="https://ui-avatars.com/api/?name=<?= $_SESSION['nama_lengkap']; ?>&background=random" class="w-full h-full rounded-full" alt="profile">
            </div>
        </div>
    </header>

    <div class="p-8 space-y-10">
        <section class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="p-8 rounded-2xl bg-gradient-to-br from-primary to-red-800 text-white shadow-xl shadow-red-100">
                <span class="material-symbols-outlined text-4xl mb-4 opacity-70">group</span>
                <h3 class="text-5xl font-headline font-black"><?= $count_relawan; ?></h3>
                <p class="text-xs font-bold uppercase tracking-widest opacity-80 mt-2">Total Relawan</p>
            </div>
            <div class="p-8 rounded-2xl bg-white border border-gray-100 shadow-sm">
                <div class="w-12 h-12 rounded-lg bg-red-50 flex items-center justify-center mb-4 text-primary">
                    <span class="material-symbols-outlined">school</span>
                </div>
                <h3 class="text-5xl font-headline font-black text-on-surface"><?= $count_program; ?></h3>
                <p class="text-gray-400 text-xs font-bold uppercase tracking-widest mt-2">Program Aktif</p>
            </div>
            <div class="p-8 rounded-2xl bg-gray-50 border border-gray-100">
                <div class="w-12 h-12 rounded-lg bg-white flex items-center justify-center mb-4 text-orange-500 shadow-sm">
                    <span class="material-symbols-outlined">person_add</span>
                </div>
                <h3 class="text-5xl font-headline font-black text-on-surface"><?= $count_baru; ?></h3>
                <p class="text-gray-400 text-xs font-bold uppercase tracking-widest mt-2">Antrian Baru</p>
            </div>
        </section>

        <section class="space-y-4">
            <div class="flex justify-between items-end">
                <h3 class="text-xl font-headline font-extrabold text-on-background">Daftar Kegiatan</h3>
                <a href="tambah_kegiatan.php" class="bg-primary text-white px-4 py-2 rounded-xl text-xs font-bold flex items-center gap-2 hover:bg-red-700 transition-all shadow-md shadow-red-100">
                    <span class="material-symbols-outlined text-sm">add</span> Tambah
                </a>
            </div>
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                <table class="w-full text-left">
                    <thead class="bg-gray-50 border-b">
                        <tr class="text-[10px] font-bold uppercase tracking-widest text-gray-500">
                            <th class="px-6 py-4">Nama Program</th>
                            <th class="px-6 py-4">Lokasi</th>
                            <th class="px-6 py-4 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100 text-sm font-body">
                        <?php
                        // Filter: Hanya yang statusnya 'aktif' yang muncul di dashboard
                        $q_kegiatan = mysqli_query($koneksi, "SELECT * FROM kegiatan WHERE status_kegiatan = 'aktif' ORDER BY id_kegiatan DESC LIMIT 5");
                        while($rk = mysqli_fetch_assoc($q_kegiatan)):
                        ?>
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="px-6 py-4 font-bold"><?= htmlspecialchars($rk['nama_kegiatan']); ?></td>
                            <td class="px-6 py-4 text-gray-500"><?= htmlspecialchars($rk['lokasi']); ?></td>
                            <td class="px-6 py-4 text-center">
                                <div class="flex justify-center gap-2">
                                    <a href="edit_kegiatan.php?id=<?= $rk['id_kegiatan']; ?>" class="text-blue-500 hover:bg-blue-50 p-1.5 rounded-lg" title="Edit"><span class="material-symbols-outlined text-lg">edit</span></a>
                                    
                                    <a href="proses_arsip.php?id=<?= $rk['id_kegiatan']; ?>" onclick="return confirm('Arsipkan kegiatan ini? (Akan hilang dari beranda)')" class="text-orange-500 hover:bg-orange-50 p-1.5 rounded-lg" title="Arsipkan">
                                        <span class="material-symbols-outlined text-lg">inventory_2</span>
                                    </a>

                                    <a href="dashboard_admin.php?hapus_kegiatan=<?= $rk['id_kegiatan']; ?>" onclick="return confirm('Hapus permanen?')" class="text-red-400 hover:text-red-600 p-1.5 rounded-lg" title="Hapus"><span class="material-symbols-outlined text-lg">delete</span></a>
                                </div>
                            </td>
                        </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </section>

        <section class="space-y-4">
            <h3 class="text-xl font-headline font-extrabold text-on-background">Antrian Pendaftar Baru</h3>
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                <table class="w-full text-left">
                    <thead class="bg-gray-50 border-b">
                        <tr class="text-[10px] font-bold uppercase tracking-widest text-gray-500">
                            <th class="px-6 py-4">Calon Relawan</th>
                            <th class="px-6 py-4">Program Studi</th>
                            <th class="px-6 py-4">Status</th>
                            <th class="px-6 py-4 text-right">Tindakan</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100 text-sm">
                        <?php
                        $q_pendaftar = mysqli_query($koneksi, "SELECT p.id_pendaftaran, u.nama_lengkap, p.asal_prodi, p.status_seleksi 
                                                               FROM pendaftaran_relawan p 
                                                               JOIN users u ON p.id_user = u.id_user 
                                                               WHERE LOWER(p.status_seleksi) = 'pending' 
                                                               ORDER BY p.id_pendaftaran DESC");
                        
                        if(mysqli_num_rows($q_pendaftar) > 0):
                            while($rp = mysqli_fetch_assoc($q_pendaftar)):
                        ?>
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 flex items-center gap-3">
                                <div class="w-8 h-8 rounded-full bg-red-50 text-primary flex items-center justify-center text-xs font-bold border border-red-100">
                                    <?= strtoupper(substr($rp['nama_lengkap'], 0, 1)); ?>
                                </div>
                                <span class="font-bold"><?= htmlspecialchars($rp['nama_lengkap']); ?></span>
                            </td>
                            <td class="px-6 py-4 text-gray-500"><?= htmlspecialchars($rp['asal_prodi']); ?></td>
                            <td class="px-6 py-4">
                                <span class="bg-yellow-50 text-yellow-600 border border-yellow-100 px-2 py-1 rounded text-[9px] font-black uppercase">
                                    <?= $rp['status_seleksi']; ?>
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex justify-end gap-3">
                                    <a href="detail_relawan.php?id=<?= $rp['id_pendaftaran']; ?>" class="text-blue-600 hover:bg-blue-50 p-1.5 rounded-full transition-all" title="Lihat Detail">
                                        <span class="material-symbols-outlined text-2xl">visibility</span>
                                    </a>

                                    <a href="proses_terima.php?id=<?= $rp['id_pendaftaran']; ?>" class="text-green-600 hover:bg-green-50 p-1.5 rounded-full transition-all" title="Terima">
                                        <span class="material-symbols-outlined text-2xl">check_circle</span>
                                    </a>
                                </div>
                            </td>
                        </tr>
                        <?php endwhile; else: ?>
                        <tr>
                            <td colspan="4" class="px-6 py-12 text-center text-gray-400 font-bold uppercase text-[10px] tracking-widest">
                                Tidak ada antrian pendaftar saat ini
                            </td>
                        </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </section>
    </div>