<?php
session_start();
require_once 'koneksi.php';

// SATPAM HALAMAN - Memastikan hanya admin yang bisa masuk
if (!isset($_SESSION['id_user']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit();
}

// LOGIKA HAPUS RELAWAN
if (isset($_GET['hapus'])) {
    $id_hapus = mysqli_real_escape_string($koneksi, $_GET['hapus']);
    if ($id_hapus != $_SESSION['id_user']) {
        mysqli_query($koneksi, "DELETE FROM users WHERE id_user = '$id_hapus' AND role = 'user'");
        header("Location: data_relawan.php?pesan=terhapus");
    }
    exit();
}

// AMBIL PARAMETER SEARCH & FILTER
$search = isset($_GET['search']) ? mysqli_real_escape_string($koneksi, $_GET['search']) : '';
$filter_divisi = isset($_GET['divisi']) ? mysqli_real_escape_string($koneksi, $_GET['divisi']) : 'semua';

// BANGUN QUERY DINAMIS
$where_clause = "WHERE u.role = 'user'";

// Jika ada pencarian kata kunci (Nama, Email, atau Prodi)
if (!empty($search)) {
    $where_clause .= " AND (u.nama_lengkap LIKE '%$search%' OR u.email LIKE '%$search%' OR p.asal_prodi LIKE '%$search%')";
}

// Jika filter divisi dipilih, sistem akan mencari di Pilihan 1 ATAU Pilihan 2
if ($filter_divisi !== 'semua') {
    $where_clause .= " AND (p.pilihan_divisi_1 = '$filter_divisi' OR p.pilihan_divisi_2 = '$filter_divisi')";
}

// QUERY FINAL sesuai struktur database kamu
$query_relawan = mysqli_query($koneksi, "
    SELECT u.*, p.pilihan_divisi_1, p.pilihan_divisi_2, p.asal_prodi, p.no_hp
    FROM users u 
    LEFT JOIN pendaftaran_relawan p ON u.id_user = p.id_user 
    $where_clause 
    ORDER BY u.nama_lengkap ASC
");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Relawan - UPN Mengajar</title>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;600;700;800&family=Inter:wght@400;500;600&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: { "primary": "#bb0016", "surface": "#f9f9f9" },
                    fontFamily: { headline: ["Manrope"], body: ["Inter"] }
                }
            }
        }
    </script>
    <style>
        .material-symbols-outlined { font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24; }
    </style>
</head>
<body class="bg-surface text-on-surface flex">

<aside class="h-screen w-72 fixed left-0 top-0 bottom-0 z-50 p-6 flex flex-col bg-white border-r shadow-sm">
    <div class="mb-10 px-4">
        <span class="font-headline font-extrabold text-primary text-2xl tracking-tighter italic">UPN Mengajar</span>
    </div>

    <nav class="flex-1 space-y-2">
        <a href="dashboard_admin.php" class="flex items-center gap-3 px-4 py-3 rounded-lg text-sm text-gray-600 hover:bg-gray-100 transition-all">
            <span class="material-symbols-outlined text-[20px]">dashboard</span> Dashboard
        </a>
        <a href="data_relawan.php" class="flex items-center gap-3 px-4 py-3 rounded-lg text-sm bg-primary text-white shadow-md shadow-red-200">
            <span class="material-symbols-outlined text-[20px]">group</span> Data Relawan
        </a>
        <a href="data_kegiatan.php" class="flex items-center gap-3 px-4 py-3 rounded-lg text-sm text-gray-600 hover:bg-gray-100">
            <span class="material-symbols-outlined text-[20px]">assignment</span> Kegiatan
        </a>
    </nav>
</aside>

<main class="flex-1 ml-72 min-h-screen p-8">
    <header class="flex justify-between items-center mb-8">
        <div>
            <h1 class="text-3xl font-headline font-black text-on-surface">Data Relawan</h1>
            <p class="text-gray-400 text-sm">Kelola dan pantau pendaftar relawan</p>
        </div>

        <a href="export_excel.php?search=<?= $search ?>&divisi=<?= $filter_divisi ?>" 
           class="bg-green-600 hover:bg-green-700 text-white px-6 py-2.5 rounded-xl text-sm font-bold flex items-center gap-2 shadow-md transition-all">
            <span class="material-symbols-outlined text-lg">download</span> Unduh Excel
        </a>
    </header>

    <div class="bg-white p-6 rounded-3xl shadow-sm border border-gray-100 mb-8">
        <form action="" method="GET" class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div class="md:col-span-2 relative">
                <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-gray-400">search</span>
                <input type="text" name="search" placeholder="Cari Nama, Email, atau Program Studi..." value="<?= htmlspecialchars($search) ?>" 
                       class="w-full pl-12 pr-4 py-3 bg-gray-50 border-none rounded-2xl focus:ring-2 focus:ring-primary/20 text-sm">
            </div>
            
            <div class="flex gap-2">
                <select name="divisi" class="flex-1 bg-gray-50 border-none rounded-2xl text-sm focus:ring-primary/20 cursor-pointer">
                    <option value="semua">Semua Divisi</option>
                    <option value="Acara" <?= $filter_divisi == 'Acara' ? 'selected' : '' ?>>Divisi Acara</option>
                    <option value="Humas" <?= $filter_divisi == 'Humas' ? 'selected' : '' ?>>Divisi Humas</option>
                    <option value="Pengajar" <?= $filter_divisi == 'Pengajar' ? 'selected' : '' ?>>Divisi Pengajar</option>
                </select>
                <button type="submit" class="bg-primary hover:bg-red-700 text-white px-8 rounded-2xl font-bold text-sm transition-all">Filter</button>
            </div>
        </form>
    </div>

    <div class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden">
        <table class="w-full text-left">
            <thead class="bg-gray-50/50 border-b">
                <tr class="text-[10px] font-black uppercase tracking-[0.2em] text-gray-400">
                    <th class="px-8 py-5">Informasi Relawan</th>
                    <th class="px-8 py-5 text-center">Prodi</th>
                    <th class="px-8 py-5 text-center">Pilihan Divisi</th>
                    <th class="px-8 py-5 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-50">
                <?php if (mysqli_num_rows($query_relawan) > 0): ?>
                    <?php while($row = mysqli_fetch_assoc($query_relawan)): ?>
                    <tr class="hover:bg-gray-50/40 transition-all group">
                        <td class="px-8 py-5">
                            <div class="flex items-center gap-4">
                                <div class="w-10 h-10 rounded-full bg-red-50 text-primary flex items-center justify-center font-bold border border-red-100 shadow-sm">
                                    <?= strtoupper(substr($row['nama_lengkap'] ?? 'U', 0, 1)); ?>
                                </div>
                                <div>
                                    <p class="font-bold text-sm text-gray-800"><?= htmlspecialchars($row['nama_lengkap']); ?></p>
                                    <p class="text-[11px] text-gray-400"><?= htmlspecialchars($row['email']); ?></p>
                                </div>
                            </div>
                        </td>
                        <td class="px-8 py-5 text-center text-xs font-semibold text-gray-500">
                            <?= htmlspecialchars($row['asal_prodi'] ?? '-'); ?>
                        </td>
                        <td class="px-8 py-5">
                            <div class="flex flex-col items-center gap-1">
                                <span class="px-2.5 py-0.5 rounded-md bg-red-50 text-primary text-[9px] font-black border border-red-100 uppercase">
                                    P1: <?= htmlspecialchars($row['pilihan_divisi_1'] ?? 'Berminat'); ?>
                                </span>
                                <?php if(!empty($row['pilihan_divisi_2'])): ?>
                                <span class="px-2.5 py-0.5 rounded-md bg-gray-50 text-gray-400 text-[9px] font-bold border border-gray-100 uppercase">
                                    P2: <?= htmlspecialchars($row['pilihan_divisi_2']); ?>
                                </span>
                                <?php endif; ?>
                            </div>
                        </td>
                        <td class="px-8 py-5 text-center">
                            <div class="flex justify-center gap-2">
                                <a href="detail_relawan.php?id=<?= $row['id_user']; ?>" class="p-2 bg-gray-50 text-gray-400 hover:bg-primary hover:text-white rounded-xl transition-all shadow-sm">
                                    <span class="material-symbols-outlined text-[18px]">visibility</span>
                                </a>
                                <a href="data_relawan.php?hapus=<?= $row['id_user']; ?>" onclick="return confirm('Hapus data relawan ini?')" class="p-2 text-gray-200 hover:text-red-600 transition-all">
                                    <span class="material-symbols-outlined text-[18px]">delete</span>
                                </a>
                            </div>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="4" class="px-8 py-24 text-center">
                            <div class="flex flex-col items-center opacity-20">
                                <span class="material-symbols-outlined text-6xl">person_search</span>
                                <p class="mt-2 font-bold">Data relawan tidak ditemukan.</p>
                            </div>
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</main>

</body>
</html>