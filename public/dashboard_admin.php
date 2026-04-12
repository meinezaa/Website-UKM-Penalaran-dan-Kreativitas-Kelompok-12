<?php
session_start();
require_once 'koneksi.php';

// SATPAM HALAMAN
if (!isset($_SESSION['id_user']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit();
}

// LOGIKA HAPUS KEGIATAN (CRUD KEGIATAN)
if (isset($_GET['hapus_kegiatan'])) {
    $id_hapus = $_GET['hapus_kegiatan'];
    mysqli_query($koneksi, "DELETE FROM kegiatan WHERE id_kegiatan = '$id_hapus'");
    header("Location: dashboard_admin.php"); // Refresh halaman
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Panel - UPN Mengajar</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
  <style> body { font-family: 'Poppins', sans-serif; } </style>
</head>
<body class="bg-gray-50 text-gray-800 flex h-screen overflow-hidden">

  <aside class="w-64 bg-gray-900 text-white flex flex-col">
    <div class="h-16 flex items-center justify-center border-b border-gray-800">
      <h1 class="text-xl font-bold text-red-500">Admin Panel</h1>
    </div>
    
    <nav class="flex-1 px-4 py-6 space-y-2 overflow-y-auto">
      <a href="data_relawan.php" class="flex items-center gap-3 bg-red-600 text-white px-4 py-3 rounded-lg transition-colors">
        Dashboard & Data
      </a>
    </nav>

    <div class="p-4 border-t border-gray-800">
      <a href="logout.php" class="flex items-center gap-3 text-gray-400 hover:text-red-400 transition-colors">
        Logout
      </a>
    </div>
  </aside>

  <main class="flex-1 flex flex-col overflow-hidden">
    
    <header class="h-16 bg-white shadow-sm flex items-center justify-between px-8 z-10">
      <h2 class="text-xl font-semibold text-gray-800">Panel Kendali Admin</h2>
      <div class="flex items-center gap-4">
        <span class="text-sm text-gray-600">Halo, <b>Admin</b></span>
        <div class="w-10 h-10 rounded-full bg-red-100 flex items-center justify-center text-red-600 font-bold border border-red-200 uppercase">A</div>
      </div>
    </header>

    <div class="flex-1 overflow-y-auto p-8 space-y-8">
      
      <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="p-6 border-b border-gray-100 flex justify-between items-center bg-gray-50">
          <div>
            <h3 class="font-bold text-lg text-gray-800">Master Data Kegiatan</h3>
            <p class="text-xs text-gray-500">Kelola daftar kegiatan utama UPN Mengajar</p>
          </div>
          <a href="tambah_kegiatan.php" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg text-sm font-semibold transition-all shadow-sm">
            + Tambah Kegiatan
          </a>
        </div>
        <div class="overflow-x-auto">
          <table class="w-full text-left border-collapse text-sm">
            <thead>
              <tr class="bg-gray-100 text-gray-600 border-b">
                <th class="px-6 py-3 font-semibold">No</th>
                <th class="px-6 py-3 font-semibold">Nama Kegiatan</th>
                <th class="px-6 py-3 font-semibold">Lokasi</th>
                <th class="px-6 py-3 font-semibold">Status</th>
                <th class="px-6 py-3 font-semibold text-center">Aksi</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $q_kegiatan = mysqli_query($koneksi, "SELECT * FROM kegiatan ORDER BY id_kegiatan DESC");
              $no_k = 1;
              while($rk = mysqli_fetch_assoc($q_kegiatan)){
                $st_color = ($rk['status_kegiatan'] == 'aktif') ? 'text-green-600 bg-green-50' : 'text-gray-500 bg-gray-50';
              ?>
              <tr class="border-b hover:bg-gray-50 transition-colors">
                <td class="px-6 py-4"><?= $no_k++; ?></td>
                <td class="px-6 py-4 font-medium"><?= htmlspecialchars($rk['nama_kegiatan']); ?></td>
                <td class="px-6 py-4"><?= htmlspecialchars($rk['lokasi']); ?></td>
                <td class="px-6 py-4">
                  <span class="px-2 py-1 rounded text-[10px] font-bold uppercase <?= $st_color ?>"><?= $rk['status_kegiatan']; ?></span>
                </td>
                <td class="px-6 py-4 text-center">
                  <a href="edit_kegiatan.php?id=<?= $rk['id_kegiatan']; ?>" class="text-blue-600 hover:underline mr-3">Edit</a>
                  <a href="data_relawan.php?hapus_kegiatan=<?= $rk['id_kegiatan']; ?>" onclick="return confirm('Hapus kegiatan ini?')" class="text-red-600 hover:underline">Hapus</a>
                </td>
              </tr>
              <?php } ?>
            </tbody>
          </table>
        </div>
      </div>

      <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="p-6 border-b border-gray-100 flex flex-col sm:flex-row justify-between items-center gap-4">
          <h3 class="font-semibold text-lg text-gray-800">Daftar Semua Pendaftar</h3>
          <div class="flex gap-2">
            <input type="text" placeholder="Cari nama..." class="px-4 py-2 border rounded-lg text-sm focus:outline-none focus:border-red-500">
            <button class="bg-gray-800 text-white px-4 py-2 rounded-lg text-sm hover:bg-gray-900 transition-colors">Cari</button>
          </div>
        </div>

        <div class="overflow-x-auto">
          <table class="w-full text-left border-collapse">
            <thead>
              <tr class="bg-gray-50 text-gray-600 text-sm border-b border-gray-100">
                <th class="px-6 py-4 font-medium">No</th>
                <th class="px-6 py-4 font-medium">Nama Lengkap</th>
                <th class="px-6 py-4 font-medium">Program Studi</th>
                <th class="px-6 py-4 font-medium">Divisi</th>
                <th class="px-6 py-4 font-medium">Status</th>
                <th class="px-6 py-4 font-medium text-center">Aksi Verifikasi</th>
              </tr>
            </thead>
            <tbody class="text-sm text-gray-700">
              <?php
              $query = mysqli_query($koneksi, "SELECT p.id_pendaftaran AS id, u.nama_lengkap, p.asal_prodi, p.pilihan_divisi_1 AS pilihan_divisi, p.status_seleksi AS status FROM pendaftaran_relawan p JOIN users u ON p.id_user = u.id_user ORDER BY p.id_pendaftaran DESC");
              $no = 1;
              if(mysqli_num_rows($query) > 0) {
                  while($row = mysqli_fetch_assoc($query)) {
                      $status_cek = strtolower($row['status']);
                      if($status_cek == 'diterima') {
                        $badge = 'bg-green-100 text-green-700';
                      } elseif($status_cek == 'ditolak') {
                        $badge = 'bg-red-100 text-red-700';
                      } else {
                        $badge = 'bg-yellow-100 text-yellow-700';
                      }
              ?>
              <tr class="border-b border-gray-50 hover:bg-gray-50 transition-colors">
                <td class="px-6 py-4"><?= $no++; ?></td>
                <td class="px-6 py-4 font-medium text-gray-900"><?= htmlspecialchars($row['nama_lengkap']); ?></td>
                <td class="px-6 py-4"><?= htmlspecialchars($row['asal_prodi']); ?></td>
                <td class="px-6 py-4 font-semibold text-gray-600"><?= htmlspecialchars($row['pilihan_divisi']); ?></td>
                <td class="px-6 py-4">
                    <span class="<?= $badge; ?> px-3 py-1 rounded-full text-xs font-semibold">
                        <?= htmlspecialchars($row['status']); ?>
                    </span>
                </td>
                <td class="px-6 py-4 text-center">
                    <div class="flex justify-center gap-2">
                        <a href="proses_terima.php?id=<?= $row['id']; ?>" class="bg-green-500 hover:bg-green-600 text-white px-3 py-1.5 rounded text-xs font-medium transition-colors">Terima</a>
                        <a href="proses_tolak.php?id=<?= $row['id']; ?>" class="bg-red-500 hover:bg-red-600 text-white px-3 py-1.5 rounded text-xs font-medium transition-colors">Tolak</a>
                    </div>
                </td>
              </tr>
              <?php 
                  }
              } else {
                  echo "<tr><td colspan='6' class='px-6 py-8 text-center text-gray-500'>Belum ada data pendaftar.</td></tr>";
              }
              ?>
            </tbody>
          </table>
        </div>
      </div>

    </div>
  </main>

</body>
</html>