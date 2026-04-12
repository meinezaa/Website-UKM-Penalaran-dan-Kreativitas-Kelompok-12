<?php
session_start();
require_once 'koneksi.php';

// SATPAM HALAMAN
if (!isset($_SESSION['id_user']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit();
}

// LOGIKA HAPUS RELAWAN (Berdasarkan ID User)
if (isset($_GET['hapus'])) {
    $id_hapus = mysqli_real_escape_string($koneksi, $_GET['hapus']);
    if ($id_hapus != $_SESSION['id_user']) {
        mysqli_query($koneksi, "DELETE FROM users WHERE id_user = '$id_hapus'");
        header("Location: data_relawan.php?pesan=terhapus");
    }
    exit();
}

// AMBIL PARAMETER SEARCH & FILTER
$search = isset($_GET['search']) ? mysqli_real_escape_string($koneksi, $_GET['search']) : '';
$filter_divisi = isset($_GET['divisi']) ? mysqli_real_escape_string($koneksi, $_GET['divisi']) : 'semua';

// BANGUN QUERY UTAMA
// Kita fokus ke pendaftaran_relawan agar data yang sudah daftar pasti muncul
$sql = "SELECT p.*, u.nama_lengkap, u.email 
        FROM pendaftaran_relawan p
        JOIN users u ON p.id_user = u.id_user 
        WHERE 1=1";

if (!empty($search)) {
    $sql .= " AND (u.nama_lengkap LIKE '%$search%' OR p.asal_prodi LIKE '%$search%')";
}

if ($filter_divisi !== 'semua') {
    $sql .= " AND (p.pilihan_divisi_1 = '$filter_divisi')";
}

$sql .= " ORDER BY p.id_pendaftaran DESC";
$query_relawan = mysqli_query($koneksi, $sql);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Relawan - UPN Mengajar</title>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@700;800&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" rel="stylesheet"/>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        "primary": "#bb0016",
                        "surface": "#f8fafc",
                    },
                    fontFamily: { headline: ["Manrope"], body: ["Inter"] }
                }
            }
        }
    </script>
</head>
<body class="bg-surface text-gray-900 flex font-body">

<aside class="h-screen w-72 fixed left-0 top-0 z-50 p-6 flex flex-col bg-white border-r">
    <div class="mb-10 px-4">
        <span class="font-headline font-extrabold text-primary text-2xl tracking-tighter uppercase">UPN Mengajar</span>
    </div>

    <nav class="flex-1 space-y-2">
        <a href="dashboard_admin.php" class="flex items-center gap-3 px-4 py-3 rounded-xl text-gray-500 hover:bg-gray-50 transition-all">
            <span class="material-symbols-outlined">dashboard</span> <span class="text-sm font-medium">Dashboard</span>
        </a>
        <a href="data_relawan.php" class="flex items-center gap-3 px-4 py-3 bg-red-50 text-primary rounded-xl transition-all font-bold">
            <span class="material-symbols-outlined">group</span> <span class="text-sm">Data Relawan</span>
        </a>
        <a href="data_kegiatan.php" class="flex items-center gap-3 px-4 py-3 text-gray-500 hover:bg-gray-50 rounded-xl transition-all font-medium">
            <span class="material-symbols-outlined">assignment</span> <span class="text-sm">Kelola Kegiatan</span>
        </a>
    </nav>

    <div class="pt-6 border-t">
        <a href="logout.php" class="flex items-center gap-3 px-4 py-3 rounded-xl text-red-600 hover:bg-red-50 transition-all font-medium">
            <span class="material-symbols-outlined">logout</span> <span class="text-sm">Logout</span>
        </a>
    </div>
</aside>

<main class="flex-1 ml-72 p-10 min-h-screen">
    <header class="flex justify-between items-center mb-10">
        <div>
            <h1 class="font-headline font-extrabold text-3xl text-gray-900">Manajemen Relawan</h1>
            <p class="text-sm text-gray-400 mt-1">Kelola dan tinjau seluruh pendaftar relawan</p>
        </div>
        <a href="export_excel.php" class="bg-green-600 text-white px-5 py-2.5 rounded-xl text-sm font-bold flex items-center gap-2 hover:bg-green-700 transition-all">
            <span class="material-symbols-outlined text-sm">download</span> Ekspor Excel
        </a>
    </header>

    <section class="bg-white p-6 rounded-3xl border border-gray-100 shadow-sm mb-10">
        <form action="" method="GET" class="flex flex-col md:flex-row gap-4 items-end">
            <div class="flex-1 space-y-2 w-full">
                <label class="text-[10px] font-bold text-gray-400 uppercase tracking-widest px-1">Pencarian Relawan</label>
                <input type="text" name="search" placeholder="Cari nama atau program studi..." value="<?= htmlspecialchars($search) ?>" 
                       class="w-full px-4 py-3 bg-gray-50 border-none rounded-2xl focus:ring-2 focus:ring-primary/20 text-sm">
            </div>
            <div class="w-full md:w-64 space-y-2">
                <label class="text-[10px] font-bold text-gray-400 uppercase tracking-widest px-1">Divisi Utama</label>
                <select name="divisi" class="w-full py-3 bg-gray-50 border-none rounded-2xl focus:ring-2 focus:ring-primary/20 text-sm cursor-pointer">
                    <option value="semua">Semua Divisi</option>
                    <option value="Acara" <?= $filter_divisi == 'Acara' ? 'selected' : '' ?>>Divisi Acara</option>
                    <option value="Humas" <?= $filter_divisi == 'Humas' ? 'selected' : '' ?>>Divisi Humas</option>
                    <option value="Perlengkapan" <?= $filter_divisi == 'Perlengkapan' ? 'selected' : '' ?>>Divisi Perlengkapan</option>
                    <option value="Konsumsi" <?= $filter_divisi == 'Konsumsi' ? 'selected' : '' ?>>Divisi Konsumsi</option>
                    <option value="PDD" <?= $filter_divisi == 'PDD' ? 'selected' : '' ?>>Divisi PDD</option>
                    <option value="Pengajar" <?= $filter_divisi == 'Pengajar' ? 'selected' : '' ?>>Divisi Pengajar</option>
                </select>
            </div>
            <button type="submit" class="bg-gray-900 text-white px-8 py-3 rounded-2xl font-bold text-sm hover:bg-black transition-all">
                Terapkan Filter
            </button>
        </form>
    </section>

    <div class="space-y-6">
        <div class="grid grid-cols-12 px-8 text-[11px] font-bold text-gray-400 uppercase tracking-widest">
            <div class="col-span-4">Calon Relawan</div>
            <div class="col-span-3">Program Studi</div>
            <div class="col-span-2">Divisi Utama</div>
            <div class="col-span-2">Status Seleksi</div>
            <div class="col-span-1 text-right">Aksi</div>
        </div>

        <div class="space-y-3">
            <?php if (mysqli_num_rows($query_relawan) > 0): ?>
                <?php while($row = mysqli_fetch_assoc($query_relawan)): ?>
                <div class="grid grid-cols-12 items-center bg-white p-6 px-8 rounded-3xl border border-gray-100 shadow-sm hover:shadow-md transition-all group">
                    <div class="col-span-4 flex items-center gap-4">
                        <div class="w-12 h-12 rounded-full bg-red-100 flex items-center justify-center text-primary font-bold shadow-sm">
                            <?= strtoupper(substr($row['nama_lengkap'], 0, 1)); ?>
                        </div>
                        <div>
                            <p class="font-bold text-gray-800 group-hover:text-primary transition-colors"><?= htmlspecialchars($row['nama_lengkap']); ?></p>
                            <p class="text-[11px] text-gray-400 font-medium"><?= htmlspecialchars($row['email']); ?></p>
                        </div>
                    </div>

                    <div class="col-span-3">
                        <p class="text-sm font-semibold text-gray-600"><?= htmlspecialchars($row['asal_prodi']); ?></p>
                    </div>

                    <div class="col-span-2">
                        <span class="px-3 py-1 bg-gray-100 text-gray-600 rounded-lg text-[10px] font-bold uppercase tracking-tight">
                            <?= htmlspecialchars($row['pilihan_divisi_1']); ?>
                        </span>
                    </div>

                    <div class="col-span-2">
                        <?php 
                            $status = strtoupper($row['status_seleksi']);
                            $color = "bg-yellow-50 text-yellow-600 border-yellow-100";
                            if($status == 'DITERIMA') $color = "bg-green-50 text-green-600 border-green-100";
                            if($status == 'DITOLAK') $color = "bg-red-50 text-red-600 border-red-100";
                        ?>
                        <span class="px-3 py-1 <?= $color ?> rounded-lg text-[10px] font-bold border">
                            <?= $status ?>
                        </span>
                    </div>

                    <div class="col-span-1 flex justify-end gap-2">
                        <a href="detail_relawan.php?id=<?= $row['id_pendaftaran']; ?>" class="w-10 h-10 flex items-center justify-center text-gray-400 hover:text-blue-600 hover:bg-blue-50 rounded-full transition-all">
                            <span class="material-symbols-outlined text-xl">visibility</span>
                        </a>
                        <a href="data_relawan.php?hapus=<?= $row['id_user']; ?>" onclick="return confirm('Hapus relawan ini?')" class="w-10 h-10 flex items-center justify-center text-gray-300 hover:text-red-600 hover:bg-red-50 rounded-full transition-all">
                            <span class="material-symbols-outlined text-xl">delete</span>
                        </a>
                    </div>
                </div>
                <?php endwhile; ?>
            <?php else: ?>
                <div class="bg-white p-20 rounded-3xl border border-dashed border-gray-200 text-center">
                    <span class="material-symbols-outlined text-5xl text-gray-200 mb-4">person_search</span>
                    <p class="text-gray-400 font-bold text-xs uppercase tracking-widest">Tidak ada relawan yang ditemukan</p>
                </div>
            <?php endif; ?>
        </div>
    </div>
</main>

</body>
</html>