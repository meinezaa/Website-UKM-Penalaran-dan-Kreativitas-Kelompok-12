-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3307
-- Generation Time: Jun 15, 2026 at 01:00 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `upnmengajar`
--

-- --------------------------------------------------------

--
-- Table structure for table `bph`
--

CREATE TABLE `bph` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL,
  `major_year` varchar(255) NOT NULL,
  `photo` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `bph`
--

INSERT INTO `bph` (`id`, `name`, `role`, `major_year`, `photo`, `created_at`, `updated_at`) VALUES
(1, 'Mayla Zaskia K', 'Ketua Umum', 'Ekonomi Pembangunan \'24', 'ketuaumum.png', '2026-06-12 03:14:06', '2026-06-12 03:14:06'),
(2, 'Yanis Nabila J', 'Sekretaris', 'Ekonomi Pembangunan \'24', 'sekjen.png', '2026-06-12 03:14:06', '2026-06-12 03:14:06'),
(3, 'Putra Batara S W', 'Sekretaris', 'Hukum \'24', 'sekre1.png', '2026-06-12 03:14:06', '2026-06-12 03:14:06'),
(4, 'Hikmah Maulida', 'Sekretaris', 'Manajemen \'24', 'sekre2.png', '2026-06-12 03:14:06', '2026-06-12 03:14:06'),
(5, 'Dhanesia Vega Susila', 'Bendahara', 'Manajemen \'24', 'bendahara1.png', '2026-06-12 03:14:06', '2026-06-12 03:14:06'),
(6, 'Syalsabilla Noer R', 'Bendahara', 'Administrasi Publik \'24', 'bendahara2.png', '2026-06-12 03:14:06', '2026-06-12 03:14:06');

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `divisions`
--

CREATE TABLE `divisions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `icon` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `divisions`
--

INSERT INTO `divisions` (`id`, `name`, `description`, `icon`, `created_at`, `updated_at`) VALUES
(1, 'Badan Bau', 'Nakhoda utama (Ketua, Sekretaris, Bendahara) pemegang kebijakan tertinggi, manajemen administrasi, anggaran belanja, serta stabilitas internal organisasi.', '👑', '2026-06-12 03:17:48', '2026-06-13 02:49:54'),
(2, 'Penelitian & Pengembangan', 'Berfokus pada peningkatan iklim ilmiah kampus, memfasilitasi riset mahasiswa, serta pengembangan kompetensi penalaran melalui kompetisi seperti PKM dan KTI.', '🔍', '2026-06-12 03:17:48', '2026-06-12 03:17:48'),
(3, 'Kajian & Strategis', 'Garda terdepan dalam menganalisis isu-isu krusial, menyusun kajian akademis yang solutif, serta mengawal arah kebijakan organisasi secara kritis strategis.', '📊', '2026-06-12 03:17:48', '2026-06-12 03:17:48'),
(4, 'Pengabdian Masyarakat', 'Pilar implementasi Tridarma Perguruan Tinggi yang bergerak nyata dalam pemberdayaan sosial, pengajaran, serta pengabdian aplikatif untuk masyarakat.', '🌱', '2026-06-12 03:17:48', '2026-06-12 03:17:48'),
(5, 'Hubungan Masyarakat', 'Jembatan komunikasi utama organisasi yang bertugas membangun relasi eksternal, kolaborasi strategis, serta mengelola citra publik UKM.', '📢', '2026-06-12 03:17:48', '2026-06-12 03:17:48'),
(6, 'Media Kreatif & Informasi', 'Dapur produksi visual dan konten digital yang mengemas informasi organisasi secara estetik, interaktif, dan informatif melalui berbagai platform media.', '🎨', '2026-06-12 03:17:48', '2026-06-12 03:17:48');

-- --------------------------------------------------------

--
-- Table structure for table `divisi_kegiatan`
--

CREATE TABLE `divisi_kegiatan` (
  `id_divisi_kegiatan` bigint(20) UNSIGNED NOT NULL,
  `id_kegiatan` bigint(20) UNSIGNED NOT NULL,
  `nama_divisi` enum('Sekretaris','Bendahara','Acara','Humas','Perkap','Pendamping','PDD','Sponsorship') NOT NULL,
  `kuota` int(11) NOT NULL DEFAULT 0,
  `jobdesc` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `divisi_kegiatan`
--

INSERT INTO `divisi_kegiatan` (`id_divisi_kegiatan`, `id_kegiatan`, `nama_divisi`, `kuota`, `jobdesc`, `created_at`, `updated_at`) VALUES
(19, 17, 'Sekretaris', 1, '-', '2026-06-14 12:21:15', '2026-06-14 12:21:15'),
(20, 17, 'Bendahara', 1, '-', '2026-06-14 12:21:15', '2026-06-14 12:21:15'),
(21, 17, 'Acara', 1, '-', '2026-06-14 12:21:15', '2026-06-14 12:21:15'),
(22, 17, 'Humas', 1, '0', '2026-06-14 12:21:15', '2026-06-14 12:21:15'),
(23, 17, 'Perkap', 1, '-', '2026-06-14 12:21:15', '2026-06-14 12:21:15'),
(24, 17, 'Pendamping', 1, '-', '2026-06-14 12:21:15', '2026-06-14 12:21:15'),
(25, 17, 'PDD', 1, '-', '2026-06-14 12:21:15', '2026-06-14 12:21:15'),
(26, 17, 'Sponsorship', 1, '-', '2026-06-14 12:21:15', '2026-06-14 12:21:15');

-- --------------------------------------------------------

--
-- Table structure for table `dokumentasi_kegiatan`
--

CREATE TABLE `dokumentasi_kegiatan` (
  `id_dokumentasi` bigint(20) UNSIGNED NOT NULL,
  `id_kegiatan` bigint(20) UNSIGNED NOT NULL,
  `judul_foto` varchar(150) DEFAULT NULL,
  `foto` text NOT NULL,
  `deskripsi` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `kegiatan`
--

CREATE TABLE `kegiatan` (
  `id_kegiatan` bigint(20) UNSIGNED NOT NULL,
  `id_user` bigint(20) UNSIGNED NOT NULL,
  `foto_kegiatan` varchar(255) DEFAULT NULL,
  `nama_kegiatan` varchar(255) NOT NULL,
  `kategori` varchar(255) NOT NULL,
  `pendaftaran_dibuka` date DEFAULT NULL,
  `tanggal_pelaksanaan` date DEFAULT NULL,
  `divisi_dibutuhkan` text DEFAULT NULL,
  `jam_kegiatan` varchar(255) DEFAULT NULL,
  `batas_registrasi` date DEFAULT NULL,
  `pengumuman_seleksi` date DEFAULT NULL,
  `lokasi` varchar(255) DEFAULT NULL,
  `alamat_lengkap` text DEFAULT NULL,
  `detail_aktivitas` text DEFAULT NULL,
  `deskripsi_detail` text DEFAULT NULL,
  `status_kegiatan` varchar(255) NOT NULL DEFAULT 'aktif',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kegiatan`
--

INSERT INTO `kegiatan` (`id_kegiatan`, `id_user`, `foto_kegiatan`, `nama_kegiatan`, `kategori`, `pendaftaran_dibuka`, `tanggal_pelaksanaan`, `divisi_dibutuhkan`, `jam_kegiatan`, `batas_registrasi`, `pengumuman_seleksi`, `lokasi`, `alamat_lengkap`, `detail_aktivitas`, `deskripsi_detail`, `status_kegiatan`, `created_at`, `updated_at`) VALUES
(17, 1, '1781464875_Volunteer programs in beautiful Bolivia with Love Volunteers!.jpeg', 'Belajar Bersama di SDN Medokan Sawah 1', 'sd', '2026-06-19', '2026-06-30', NULL, '09.00 - 15.00 WIB', '2026-06-23', '2026-06-14', 'SDN Medokan Sawah 1', 'jl raya', '-', '-', 'aktif', '2026-06-14 12:21:15', '2026-06-14 13:40:44');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '2026_06_04_211458_create_kegiatan_table', 1),
(4, '2026_06_04_211551_create_pendaftaran_relawan_table', 1),
(5, '2026_06_04_211608_create_divisi_kegiatan_table', 1),
(6, '2026_06_12_090058_create_divisions_table', 1),
(7, '2026_06_12_090207_create_programs_table', 1),
(8, '2026_06_12_095834_create_bph_table', 1),
(9, '2026_06_12_095850_create_visions_missions_table', 1),
(10, '2026_06_12_095947_create_settings_table', 1),
(11, '2026_06_12_120844_create_teams_table', 1),
(12, '2026_06_12_155528_create_mitra_table', 1),
(13, '2026_06_13_105607_create_dokumentasi_kegiatan_table', 2),
(14, '2026_06_14_072316_change_foto_column_to_text_in_dokumentasi_kegiatan_table', 3);

-- --------------------------------------------------------

--
-- Table structure for table `mitra`
--

CREATE TABLE `mitra` (
  `id_mitra` int(11) NOT NULL,
  `nama_penanggung_jawab` varchar(255) DEFAULT NULL,
  `email_instansi` varchar(255) DEFAULT NULL,
  `no_hp` varchar(20) DEFAULT NULL,
  `jenis_kemitraan` varchar(100) DEFAULT NULL,
  `pesan_kolaborasi` text DEFAULT NULL,
  `nama_instansi` varchar(255) DEFAULT NULL,
  `status_mitra` varchar(255) NOT NULL DEFAULT 'DISETUJUI',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `mitra`
--

INSERT INTO `mitra` (`id_mitra`, `nama_penanggung_jawab`, `email_instansi`, `no_hp`, `jenis_kemitraan`, `pesan_kolaborasi`, `nama_instansi`, `status_mitra`, `created_at`, `updated_at`) VALUES
(1, 'Budi Santoso', 'budi@solusitekno.com', '08123456789', 'Sponsorship', 'Ingin bekerja sama dalam pendanaan program pengajar.', 'PT Solusi Teknologi Nusantara', 'DISETUJUI', '2026-06-13 07:46:10', '2026-06-14 05:54:52'),
(2, 'Siti Aminah', 'siti@mengajar.id', '08987654321', 'Media Partner', 'Siap membantu publikasi dokumentasi ke media massa.', 'Lembaga Edukasi Mengajar ID', 'DISETUJUI', '2026-06-13 07:46:10', '2026-06-13 07:46:10'),
(3, 'Rian Hidayat', 'rian@pemudamengabdi.org', '08567891234', 'Penyedia Relawan', 'Mengajukan kolaborasi distribusi relawan mengajar.', 'Komunitas Pemuda Mengabdi', 'DITOLAK', '2026-06-13 07:46:10', '2026-06-13 07:46:10');

-- --------------------------------------------------------

--
-- Table structure for table `pendaftaran_relawan`
--

CREATE TABLE `pendaftaran_relawan` (
  `id_pendaftaran` bigint(20) UNSIGNED NOT NULL,
  `id_user` bigint(20) UNSIGNED NOT NULL,
  `id_kegiatan` bigint(20) UNSIGNED NOT NULL,
  `no_hp` varchar(255) NOT NULL,
  `umur` int(11) NOT NULL,
  `jenis_kelamin` varchar(255) NOT NULL,
  `asal_prodi` varchar(255) NOT NULL,
  `pilihan_divisi_1` varchar(255) NOT NULL,
  `pilihan_divisi_2` varchar(255) DEFAULT NULL,
  `portofolio` varchar(255) DEFAULT NULL,
  `pengalaman_keahlian` text DEFAULT NULL,
  `metode_pembayaran` enum('Transfer BCA','BNI') NOT NULL,
  `bukti_pembayaran` varchar(255) NOT NULL,
  `status_seleksi` varchar(255) NOT NULL DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pendaftaran_relawan`
--

INSERT INTO `pendaftaran_relawan` (`id_pendaftaran`, `id_user`, `id_kegiatan`, `no_hp`, `umur`, `jenis_kelamin`, `asal_prodi`, `pilihan_divisi_1`, `pilihan_divisi_2`, `portofolio`, `pengalaman_keahlian`, `metode_pembayaran`, `bukti_pembayaran`, `status_seleksi`, `created_at`, `updated_at`) VALUES
(2, 1, 3, '089876543210', 21, 'Laki-laki', 'Informatika', 'Divisi Perlengkapan', 'Divisi Pemateri', 'link_portofolio_2.pdf', 'Pengalaman divisi perlengkapan di acara ospek fakultas.', '', 'tidak_ada.png', 'Proses', '2026-06-13 07:00:16', '2026-06-13 07:00:16'),
(5, 1, 5, '087766554433', 22, 'Perempuan', 'Akuntansi', 'Divisi Dana Usaha', 'Divisi Humas', 'link_portofolio_5.pdf', 'Pernah menjadi koordinator danus di beberapa event kampus.', '', 'tidak_ada.png', 'DITERIMA', '2026-06-13 07:00:16', '2026-06-13 11:29:52'),
(6, 3, 1, '081234567890', 21, 'Laki-laki', 'Informatika', 'Pengajar', 'Dokumentasi', NULL, NULL, 'Transfer BCA', 'bukti_bca_fauzi.png', 'Proses', NULL, NULL),
(7, 4, 1, '085712345678', 20, 'Perempuan', 'Sistem Informasi', 'Kurikulum', 'Logistik', NULL, NULL, 'BNI', 'bukti_bni_siti.png', 'Proses', NULL, NULL),
(8, 5, 1, '089987654321', 22, 'Laki-laki', 'Ilmu Komunikasi', 'Humas', 'Pengajar', NULL, NULL, 'Transfer BCA', 'bukti_bca_budi.png', 'Proses', NULL, NULL),
(9, 6, 1, '082133445566', 19, 'Perempuan', 'Akuntansi', 'Logistik', 'Acara', NULL, NULL, 'BNI', 'bukti_bni_ayu.png', 'Proses', NULL, NULL),
(10, 7, 1, '083811223344', 21, 'Laki-laki', 'Teknik Kimia', 'Pengajar', 'Dokumentasi', NULL, NULL, 'Transfer BCA', 'bukti_bca_diki.png', 'Proses', NULL, NULL),
(11, 3, 1, '081234567890', 21, 'Laki-laki', 'Informatika', 'Pengajar', 'Dokumentasi', NULL, NULL, 'Transfer BCA', 'bukti_bca_fauzi.png', 'Proses', NULL, NULL),
(12, 4, 1, '085712345678', 20, 'Perempuan', 'Sistem Informasi', 'Kurikulum', 'Logistik', NULL, NULL, 'BNI', 'bukti_bni_siti.png', 'Proses', NULL, NULL),
(13, 5, 1, '089987654321', 22, 'Laki-laki', 'Ilmu Komunikasi', 'Humas', 'Pengajar', NULL, NULL, 'Transfer BCA', 'bukti_bca_budi.png', 'Proses', NULL, NULL),
(14, 6, 1, '082133445566', 19, 'Perempuan', 'Akuntansi', 'Logistik', 'Acara', NULL, NULL, 'BNI', 'bukti_bni_ayu.png', 'Proses', NULL, NULL),
(15, 7, 1, '083811223344', 21, 'Laki-laki', 'Teknik Kimia', 'Pengajar', 'Dokumentasi', NULL, NULL, 'Transfer BCA', 'bukti_bca_diki.png', 'Proses', NULL, NULL),
(16, 8, 11, '0838475', 20, 'Laki-laki', 'jsbid', 'Umum', 'Umum', 'iohvg', 'klnslndd', 'Transfer BCA', 'bukti_relawan_11_1781462711.png', 'DITERIMA', '2026-06-14 11:45:11', '2026-06-14 11:45:34'),
(17, 8, 16, '08374', 21, 'Laki-laki', 'aknsjd', 'Umum', 'Umum', 'jsnbhd', ',ms', 'BNI', 'bukti_relawan_16_1781463216.jpeg', 'Proses', '2026-06-14 11:53:36', '2026-06-14 11:53:36'),
(18, 8, 17, '1', 1, 'Perempuan', 'aknsjd', 'Umum', 'Umum', '1', '1', 'BNI', 'bukti_relawan_17_1781464932.png', 'Proses', '2026-06-14 12:22:12', '2026-06-14 12:22:12'),
(19, 8, 17, '0', 0, 'Perempuan', '0', 'Umum', 'Umum', '0', '0', 'Transfer BCA', 'bukti_relawan_17_1781465304.png', 'Proses', '2026-06-14 12:28:24', '2026-06-14 12:28:24'),
(20, 8, 17, '899', 19, 'Perempuan', '1', 'Umum', 'Umum', '9', '9', 'BNI', 'bukti_relawan_17_1781465566.png', 'DITERIMA', '2026-06-14 12:32:46', '2026-06-14 13:37:42');

-- --------------------------------------------------------

--
-- Table structure for table `programs`
--

CREATE TABLE `programs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `division_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `programs`
--

INSERT INTO `programs` (`id`, `division_id`, `name`, `created_at`, `updated_at`) VALUES
(1, 1, 'Supervisi & Pengambil Keputusan', '2026-06-12 03:18:12', '2026-06-12 03:18:12'),
(2, 1, 'Manajemen Arsip & Birokrasi', '2026-06-12 03:18:12', '2026-06-12 03:18:12'),
(3, 2, 'Workshop PKM & Karya Tulis Ilmiah', '2026-06-12 03:18:12', '2026-06-12 03:18:12'),
(4, 2, 'Inkubasi Prestasi Mahasiswa', '2026-06-12 03:18:12', '2026-06-12 03:18:12'),
(5, 3, 'Diskusi Publik & Kajian Isu', '2026-06-12 03:18:12', '2026-06-12 03:18:12'),
(6, 3, 'Penyusunan Policy Brief Akademis', '2026-06-12 03:18:12', '2026-06-12 03:18:12'),
(7, 4, 'UPN Mengajar (Desa Binaan)', '2026-06-12 03:18:12', '2026-06-12 03:18:12'),
(8, 4, 'Aksi Sosial & Bakti Masyarakat', '2026-06-12 03:18:12', '2026-06-12 03:18:12'),
(9, 5, 'Studi Banding Antar Kampus', '2026-06-12 03:18:12', '2026-06-12 03:18:12'),
(10, 5, 'Media Partner & Jejaring Alumni', '2026-06-12 03:18:12', '2026-06-12 03:18:12'),
(11, 6, 'Desain Feed & Pengelolaan Sosmed', '2026-06-12 03:18:12', '2026-06-12 03:18:12'),
(12, 6, 'Dokumentasi & Video Kreatif', '2026-06-12 03:18:12', '2026-06-12 03:18:12');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `key` varchar(255) NOT NULL,
  `value` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `key`, `value`, `created_at`, `updated_at`) VALUES
(1, 'whatsapp', 'https://wa.me/6289699808453', '2026-06-13 06:57:00', '2026-06-13 06:57:00'),
(2, 'email', 'upnmengajar.jt@gmail.com', '2026-06-13 06:57:00', '2026-06-13 06:57:00'),
(3, 'instagram', 'https://instagram.com/upnmengajar.jt', '2026-06-13 06:57:00', '2026-06-13 06:57:00'),
(4, 'linkedin', 'https://linkedin.com/in/username', '2026-06-13 06:57:00', '2026-06-13 06:57:00'),
(5, 'tiktok', 'https://tiktok.com/@username', '2026-06-13 06:57:00', '2026-06-13 06:57:00');

-- --------------------------------------------------------

--
-- Table structure for table `teams`
--

CREATE TABLE `teams` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(255) NOT NULL,
  `jabatan` varchar(255) NOT NULL,
  `kategori` varchar(255) NOT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `instagram` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `linkedin` varchar(255) DEFAULT NULL,
  `urutan` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `teams`
--

INSERT INTO `teams` (`id`, `nama`, `jabatan`, `kategori`, `foto`, `instagram`, `email`, `linkedin`, `urutan`, `created_at`, `updated_at`) VALUES
(2, 'Raihan Putra Pradana', 'Ketua Bidang', 'bph', '1781470188_Ketua Bidang_Raihan Putra Pradana.jpeg', '@raihan', 'raihan@upnmengajar', 'https://www.linkedin.com/in/vinadwimaulita', 1, '2026-06-14 13:49:48', '2026-06-14 13:49:48'),
(9, 'Andre Luhut Jairus', 'Wakit Ketua Bidang', 'bph', '1781470355_Wakil Ketua Bidang_Andre Luhut Jairus.jpg', '@andr', 'andre@upnmengajar', 'https://www.linkedin.com/in/vinadwimaulita', 2, '2026-06-14 13:52:35', '2026-06-14 14:56:56'),
(10, 'Nabila Devi Salma', '.Sekretaris Bidang', 'bph', '1781474505_6a2f24c9b50ca.jpg', '@nabila', 'nabila@upnmengajar', 'https://www.linkedin.com/in/vinadwimaulita', 3, '2026-06-14 15:01:45', '2026-06-14 15:01:45'),
(11, 'Nayla Sabrina', 'Staff Ahli Nalar Peduli', 'staf_ahli', '1781474660_6a2f2564c2238.jpg', '@nayla', 'nayla@upnmengajar', 'https://www.linkedin.com/in/vinadwimaulita', 4, '2026-06-14 15:04:20', '2026-06-14 15:04:20'),
(12, 'Muhammad Alvin Dhafi Nashihin', 'Bina Desa', 'staf_ahli', '1781474709_6a2f25953c3cb.jpg', '@alvin', 'alvin@upnmengajar', 'https://www.linkedin.com/in/vinadwimaulita', 5, '2026-06-14 15:05:09', '2026-06-14 15:05:09'),
(13, 'Fitri Aulia Taulani', 'Medsos Diksos', 'staf_ahli', '1781474999_6a2f26b74e8f6.jpg', 'Fitri', 'Fitri@gamil.com', 'https://www.linkedin.com/in/vinadwimaulita', 6, '2026-06-14 15:09:59', '2026-06-14 15:09:59'),
(14, 'Mengajar Mrgaretha Deana S.', 'Staff Ahli UPN Mengajar', 'staf_ahli', '1781475144_6a2f274890f81.jpg', '@margaret', 'Margaret@gmail.com', 'https://www.linkedin.com/in/vinadwimaulita', 7, '2026-06-14 15:12:24', '2026-06-14 15:12:35');

-- --------------------------------------------------------

--
-- Table structure for table `upnmengajar_settings`
--

CREATE TABLE `upnmengajar_settings` (
  `id_setting` int(11) NOT NULL,
  `sub_judul` varchar(255) DEFAULT 'Program Kerja Bidang SOSIAL & PENDIDIKAN',
  `judul_hero` text DEFAULT NULL,
  `deskripsi_hero` text DEFAULT NULL,
  `sdgs_text` text DEFAULT NULL,
  `metodologi_text` text DEFAULT NULL,
  `quotes` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `upnmengajar_settings`
--

INSERT INTO `upnmengajar_settings` (`id_setting`, `sub_judul`, `judul_hero`, `deskripsi_hero`, `sdgs_text`, `metodologi_text`, `quotes`, `created_at`, `updated_at`) VALUES
(1, 'Program Kerja Bidang SOSIAL & PENDIDIKAN', 'Mencerdaskan Bangsa Melalui Aksi Nyata.', 'Pendekatan interaktif untuk menutup celah pendidikan pasca-pandemi. Kami menghadirkan pengalaman belajar bermakna bagi seluruh lapisan masyarakat.', 'Output utama kami adalah memastikan teknik pembelajaran yang diajarkan dapat diterapkan secara mandiri oleh peserta di lingkungan mereka secara berkelanjutan.', 'Menyusun modul adaptif pasca-pandemi yang berfokus pada pendekatan kreatif, emosional, dan motorik agar anak-anak memperoleh pengalaman belajar bermakna.', '\"Bukan hanya sekadar mengajar materi sekolah, tetapi kami membekali mereka dengan kreativitas untuk masa depan yang lebih cerah.\"', '2026-06-13 11:28:06', '2026-06-13 11:28:06');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id_user` bigint(20) UNSIGNED NOT NULL,
  `nama_lengkap` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','user') NOT NULL DEFAULT 'user',
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id_user`, `nama_lengkap`, `email`, `password`, `role`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Vina Dwi', 'vina@gmail.com', 'vina123', 'admin', NULL, '2026-06-13 07:14:18', '2026-06-13 07:14:18'),
(2, 'Inez', 'inez@gmail.com', '$2y$12$clZ8BszW8Gidb800Wl3Tku3qlyHGe5jC9I3L6a7a0rYgGbe17M30.', 'user', NULL, '2026-06-13 07:14:18', '2026-06-13 07:14:18'),
(3, 'Achmad Fauzi', 'fauzi.achmad@gmail.com', '$2y$12$sNI0l2x6PTZkTSU4a4OnUOjzWIthFK2oB.6mIZocAskW1oeqgLybq', 'user', NULL, NULL, NULL),
(4, 'Siti Aminah', 'siti.aminah@yahoo.com', '$2y$12$SgGP350pQrFQqg08t9DmtepGH.3.bKB9hZ9zFuiVt7yVumOoh2Nw6', 'user', NULL, NULL, NULL),
(5, 'Budi Santoso', 'budi.santoso@student.upn.ac.id', '$2y$12$coqeZaNVZpFqRu5pDEJdDuT9ihT14nJwQ0rrJojwSTf5NSGC.TQvK', 'user', NULL, NULL, NULL),
(6, 'Roro Ayu Lestari', 'roro.ayu@gmail.com', '$2y$12$kv3Tj1WOw4xYEeglYFzoQOLUGfCWVHNWCqgpJLkPHMuJl16iJeRTi', 'user', NULL, NULL, NULL),
(7, 'Diki Hermawan', 'diki.hermawan@gmail.com', '$2y$12$ODjCr2xsTNZ31rjxav1H4.5fUb.vi8Ra4.wOqS0nyMjpkFV3RM6cW', 'user', NULL, NULL, NULL),
(8, 'Amanda Marisa', 'amanda@gmail.com', '12345678', 'user', NULL, NULL, NULL),
(9, 'inez', '24082010074@student.upnjatim.ac.id', '12345678', 'user', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `visions_missions`
--

CREATE TABLE `visions_missions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `type` enum('visi','misi') NOT NULL,
  `content` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `visions_missions`
--

INSERT INTO `visions_missions` (`id`, `type`, `content`, `created_at`, `updated_at`) VALUES
(1, 'visi', 'Terwujudnya lingkungan kampus yang lebih akademis, selaras dengan nilai-nilai Tridarma Perguruan Tinggi.', '2026-06-12 03:14:33', '2026-06-12 03:14:33'),
(2, 'misi', 'Mengajak mahasiswa sebagai roda penggerak dalam mewujudkan Kampus Pelopor Peradaban.', '2026-06-12 03:14:33', '2026-06-12 03:14:33'),
(3, 'misi', 'Menghasilkan kader-kader yang kompetitif, inovatif, dan kreatif serta memiliki daya saing yang tinggi di bidang keilmuan, penelitian, dan pengabdian masyarakat.', '2026-06-12 03:14:33', '2026-06-12 03:14:33'),
(4, 'misi', 'Berusaha menjadikan lingkungan kampus yang aman dan memiliki jiwa pengabdian pada masyarakat', '2026-06-12 03:14:33', '2026-06-12 03:14:33');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bph`
--
ALTER TABLE `bph`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_expiration_index` (`expiration`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_locks_expiration_index` (`expiration`);

--
-- Indexes for table `divisions`
--
ALTER TABLE `divisions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `divisi_kegiatan`
--
ALTER TABLE `divisi_kegiatan`
  ADD PRIMARY KEY (`id_divisi_kegiatan`),
  ADD KEY `divisi_kegiatan_id_kegiatan_foreign` (`id_kegiatan`);

--
-- Indexes for table `dokumentasi_kegiatan`
--
ALTER TABLE `dokumentasi_kegiatan`
  ADD PRIMARY KEY (`id_dokumentasi`),
  ADD KEY `dokumentasi_kegiatan_id_kegiatan_foreign` (`id_kegiatan`);

--
-- Indexes for table `kegiatan`
--
ALTER TABLE `kegiatan`
  ADD PRIMARY KEY (`id_kegiatan`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mitra`
--
ALTER TABLE `mitra`
  ADD PRIMARY KEY (`id_mitra`);

--
-- Indexes for table `pendaftaran_relawan`
--
ALTER TABLE `pendaftaran_relawan`
  ADD PRIMARY KEY (`id_pendaftaran`);

--
-- Indexes for table `programs`
--
ALTER TABLE `programs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `programs_division_id_foreign` (`division_id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `settings_key_unique` (`key`);

--
-- Indexes for table `teams`
--
ALTER TABLE `teams`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `upnmengajar_settings`
--
ALTER TABLE `upnmengajar_settings`
  ADD PRIMARY KEY (`id_setting`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `visions_missions`
--
ALTER TABLE `visions_missions`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bph`
--
ALTER TABLE `bph`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `divisions`
--
ALTER TABLE `divisions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `divisi_kegiatan`
--
ALTER TABLE `divisi_kegiatan`
  MODIFY `id_divisi_kegiatan` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `dokumentasi_kegiatan`
--
ALTER TABLE `dokumentasi_kegiatan`
  MODIFY `id_dokumentasi` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `kegiatan`
--
ALTER TABLE `kegiatan`
  MODIFY `id_kegiatan` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `mitra`
--
ALTER TABLE `mitra`
  MODIFY `id_mitra` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `pendaftaran_relawan`
--
ALTER TABLE `pendaftaran_relawan`
  MODIFY `id_pendaftaran` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `programs`
--
ALTER TABLE `programs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `teams`
--
ALTER TABLE `teams`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `upnmengajar_settings`
--
ALTER TABLE `upnmengajar_settings`
  MODIFY `id_setting` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id_user` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `visions_missions`
--
ALTER TABLE `visions_missions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `divisi_kegiatan`
--
ALTER TABLE `divisi_kegiatan`
  ADD CONSTRAINT `divisi_kegiatan_id_kegiatan_foreign` FOREIGN KEY (`id_kegiatan`) REFERENCES `kegiatan` (`id_kegiatan`) ON DELETE CASCADE;

--
-- Constraints for table `dokumentasi_kegiatan`
--
ALTER TABLE `dokumentasi_kegiatan`
  ADD CONSTRAINT `dokumentasi_kegiatan_id_kegiatan_foreign` FOREIGN KEY (`id_kegiatan`) REFERENCES `kegiatan` (`id_kegiatan`) ON DELETE CASCADE;

--
-- Constraints for table `programs`
--
ALTER TABLE `programs`
  ADD CONSTRAINT `programs_division_id_foreign` FOREIGN KEY (`division_id`) REFERENCES `divisions` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
