<?php
session_start();
require_once 'koneksi.php';

// Satpam Halaman - Pastikan Admin sudah login
if (!isset($_SESSION['id_user']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit();
}

if (isset($_POST['simpan'])) {
    $id_admin = $_SESSION['id_user'];
    
    // 1. Data Dasar & Lokasi
    $nama             = mysqli_real_escape_string($koneksi, $_POST['nama_kegiatan']);
    $kategori         = $_POST['kategori'];
    $status           = $_POST['status_kegiatan'];
    $tgl              = $_POST['tanggal_pelaksanaan'];
    $jam              = mysqli_real_escape_string($koneksi, $_POST['jam_kegiatan']);
    $batas_reg        = $_POST['batas_registrasi'];
    $lokasi           = mysqli_real_escape_string($koneksi, $_POST['lokasi']);
    $alamat_lengkap   = mysqli_real_escape_string($koneksi, $_POST['alamat_lengkap']);
    
    // 2. Deskripsi
    $detail_aktivitas = mysqli_real_escape_string($koneksi, $_POST['detail_aktivitas']);
    $deskripsi        = mysqli_real_escape_string($koneksi, $_POST['deskripsi_detail']);

    // 3. PROSES UPLOAD FOTO
    $foto_name = $_FILES['foto_kegiatan']['name'];
    $foto_tmp  = $_FILES['foto_kegiatan']['tmp_name'];
    $folder    = "foto/";

    if ($foto_name != "") {
        $foto_baru = date('YmdHis') . "_" . str_replace(' ', '_', $foto_name);
        // Cek apakah folder foto ada, jika tidak buat otomatis
        if (!is_dir($folder)) {
            mkdir($folder, 0777, true);
        }
        move_uploaded_file($foto_tmp, $folder . $foto_baru);
    } else {
        $foto_baru = "default.jpg"; 
    }

    // 4. MULAI TRANSAKSI SQL
    mysqli_begin_transaction($koneksi);

    try {
        // QUERY 1: Simpan ke tabel kegiatan (Sesuaikan urutan kolom dengan ERD)
        $query_kegiatan = "INSERT INTO kegiatan (
            id_user, nama_kegiatan, foto_kegiatan, tanggal_pelaksanaan, jam_kegiatan, 
            batas_registrasi, lokasi, alamat_lengkap, kategori, deskripsi_detail, 
            status_kegiatan, detail_aktivitas
        ) VALUES (
            '$id_admin', '$nama', '$foto_baru', '$tgl', '$jam', 
            '$batas_reg', '$lokasi', '$alamat_lengkap', '$kategori', '$deskripsi', 
            '$status', '$detail_aktivitas'
        )";

        if (!mysqli_query($koneksi, $query_kegiatan)) {
            throw new Exception("Gagal simpan kegiatan: " . mysqli_error($koneksi));
        }

        // Ambil ID kegiatan yang baru saja di-insert
        $id_kegiatan_baru = mysqli_insert_id($koneksi);

        // 5. QUERY 2: Simpan ke tabel divisi_kegiatan (Sesuaikan ENUM di Database)
        // Kunci: Nama di sebelah kanan harus SAMA PERSIS dengan ENUM di database kamu.
        $divisi_list = [
            'sekretaris' => 'Sekretaris', 
            'bendahara'  => 'Bendahara', 
            'acara'      => 'Acara', 
            'humas'      => 'Humas', 
            'perkap'     => 'Perkap', 
            'pendamping' => 'Pendamping', // Sesuaikan jika di ENUM database hanya 'Pendamping'
            'pdd'        => 'PDD', 
            'sponsorship'=> 'Sponsorship'
        ];

        foreach ($divisi_list as $key => $label) {
            $kuota   = !empty($_POST['kuota_' . $key]) ? (int)$_POST['kuota_' . $key] : 0;
            $jobdesc = mysqli_real_escape_string($koneksi, $_POST['jobdesc_' . $key]);

            if ($kuota > 0) {
                $query_divisi = "INSERT INTO divisi_kegiatan (id_kegiatan, nama_divisi, kuota, jobdesc) 
                                 VALUES ('$id_kegiatan_baru', '$label', '$kuota', '$jobdesc')";
                
                if (!mysqli_query($koneksi, $query_divisi)) {
                    throw new Exception("Gagal simpan divisi $label: " . mysqli_error($koneksi));
                }
            }
        }

        mysqli_commit($koneksi);
        echo "<script>alert('Kegiatan berhasil ditambahkan!'); window.location='dashboard_admin.php';</script>";

    } catch (Exception $e) {
        mysqli_rollback($koneksi);
        echo "<div style='color:red; background:#fff; p-4; border:1px solid red;'>";
        echo "<strong>Terjadi Kesalahan:</strong> " . $e->getMessage();
        echo "<br><a href='tambah_kegiatan.php'>Kembali ke Form</a>";
        echo "</div>";
        exit();
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
<body class="bg-gray-100 p-6">

    <div class="max-w-4xl w-full mx-auto bg-white rounded-2xl shadow-xl overflow-hidden my-10">
        <div class="bg-red-700 p-6 text-white text-center">
            <h2 class="text-2xl font-bold">Tambah Kegiatan Baru</h2>
            <p class="text-red-100 text-sm">Input data detail kegiatan dan kebutuhan relawan</p>
        </div>

        <form action="" method="POST" enctype="multipart/form-data" class="p-8 space-y-8">
            
            <div>
                <h3 class="text-lg font-bold text-red-700 border-b-2 border-red-100 mb-4">1. Informasi Dasar</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="md:col-span-2">
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Nama Kegiatan</label>
                        <input type="text" name="nama_kegiatan" required placeholder="Contoh: Relawan SDN Medokan Sawah 1"
                               class="w-full border border-gray-300 px-4 py-2.5 rounded-lg focus:ring-2 focus:ring-red-500 outline-none">
                    </div>
                    <div class="md:col-span-2">
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Foto Utama Kegiatan</label>
                        <input type="file" name="foto_kegiatan" accept="image/*" required
                               class="w-full border border-gray-300 px-4 py-2 rounded-lg bg-gray-50">
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Kategori Program</label>
                        <select name="kategori" required class="w-full border border-gray-300 px-4 py-2.5 rounded-lg focus:ring-2 focus:ring-red-500 bg-white">
                            <option value="sd">Sekolah Dasar</option>
                            <option value="slb">Sekolah Luar Biasa</option>
                            <option value="yayasan">Yayasan / Panti</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Status</label>
                        <select name="status_kegiatan" class="w-full border border-gray-300 px-4 py-2.5 rounded-lg focus:ring-2 focus:ring-red-500 bg-white">
                            <option value="aktif">Aktif</option>
                            <option value="selesai">Selesai</option>
                        </select>
                    </div>
                </div>
            </div>

            <div>
                <h3 class="text-lg font-bold text-red-700 border-b-2 border-red-100 mb-4">2. Waktu & Lokasi</h3>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-4">
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Tanggal Pelaksanaan</label>
                        <input type="date" name="tanggal_pelaksanaan" required class="w-full border border-gray-300 px-4 py-2.5 rounded-lg">
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Jam Kegiatan</label>
                        <input type="text" name="jam_kegiatan" required placeholder="08.00 - 11.00" class="w-full border border-gray-300 px-4 py-2.5 rounded-lg">
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Batas Registrasi</label>
                        <input type="date" name="batas_registrasi" required class="w-full border border-gray-300 px-4 py-2.5 rounded-lg">
                    </div>
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Nama Lokasi</label>
                    <input type="text" name="lokasi" required placeholder="Contoh: SDN Medokan Sawah 1" class="w-full border border-gray-300 px-4 py-2.5 rounded-lg">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Alamat Lengkap</label>
                    <textarea name="alamat_lengkap" rows="2" required placeholder="Jl. Raya Medokan Sawah..." class="w-full border border-gray-300 px-4 py-2.5 rounded-lg"></textarea>
                </div>
            </div>

            <div>
                <h3 class="text-lg font-bold text-red-700 border-b-2 border-red-100 mb-4">3. Deskripsi & Aktivitas</h3>
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Detail Aktivitas</label>
                        <textarea name="detail_aktivitas" rows="3" required placeholder="Poin-poin aktivitas..." class="w-full border border-gray-300 px-4 py-2.5 rounded-lg"></textarea>
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Deskripsi Lengkap</label>
                        <textarea name="deskripsi_detail" rows="4" required placeholder="Latar belakang kegiatan..." class="w-full border border-gray-300 px-4 py-2.5 rounded-lg"></textarea>
                    </div>
                </div>
            </div>

            <div>
                <h3 class="text-lg font-bold text-red-700 border-b-2 border-red-100 mb-4">4. Kebutuhan Per Divisi</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <?php 
                    $divisis = [
                        'sekretaris' => 'Sekretaris', 'bendahara' => 'Bendahara', 
                        'acara' => 'Acara', 'humas' => 'Humas', 
                        'perkap' => 'Perkap', 'pendamping' => 'Pendamping', 
                        'pdd' => 'PDD', 'sponsorship' => 'Sponsorship'
                    ];
                    foreach($divisis as $key => $label): 
                    ?>
                    <div class="p-4 bg-gray-50 border border-gray-200 rounded-xl">
                        <label class="block text-md font-bold text-gray-800 mb-3 border-b pb-1"><?= $label ?></label>
                        <div class="space-y-3">
                            <div>
                                <label class="block text-xs font-semibold text-gray-600 uppercase">Kuota Orang</label>
                                <input type="number" name="kuota_<?= $key ?>" value="0" min="0" class="w-full border border-gray-300 px-3 py-1.5 rounded-lg">
                            </div>
                            <div>
                                <label class="block text-xs font-semibold text-gray-600 uppercase">Job Description</label>
                                <textarea name="jobdesc_<?= $key ?>" rows="2" placeholder="Tugas divisi..." class="w-full border border-gray-300 px-3 py-1.5 rounded-lg text-sm"></textarea>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <div class="flex gap-4 pt-6 border-t border-gray-100">
                <button type="submit" name="simpan" class="flex-1 bg-red-700 text-white font-bold py-4 rounded-xl hover:bg-red-800 shadow-lg transition-all transform hover:-translate-y-1">Simpan Kegiatan</button>
                <a href="dashboard_admin.php" class="flex-1 bg-gray-200 text-gray-700 font-bold py-4 rounded-xl text-center hover:bg-gray-300 transition-all">Batal</a>
            </div>
        </form>
    </div>

</body>
</html>