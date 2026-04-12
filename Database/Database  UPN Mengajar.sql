CREATE DATABASE  IF NOT EXISTS `upnmengajar` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */;
USE `upnmengajar`;
-- MySQL dump 10.13  Distrib 8.0.41, for Win64 (x86_64)
--
-- Host: localhost    Database: upnmengajar
-- ------------------------------------------------------
-- Server version	5.5.5-10.4.32-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `divisi_kegiatan`
--

DROP TABLE IF EXISTS `divisi_kegiatan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `divisi_kegiatan` (
  `id_divisi_kegiatan` int(11) NOT NULL AUTO_INCREMENT,
  `id_kegiatan` int(11) NOT NULL,
  `nama_divisi` enum('Sekretaris','Bendahara','Acara','Humas','Perkap','Pendamping','PDD','Sponsorship') NOT NULL,
  `kuota` int(11) DEFAULT 0,
  `jobdesc` text DEFAULT NULL,
  PRIMARY KEY (`id_divisi_kegiatan`),
  KEY `id_kegiatan` (`id_kegiatan`),
  CONSTRAINT `divisi_kegiatan_ibfk_1` FOREIGN KEY (`id_kegiatan`) REFERENCES `kegiatan` (`id_kegiatan`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `divisi_kegiatan`
--

LOCK TABLES `divisi_kegiatan` WRITE;
/*!40000 ALTER TABLE `divisi_kegiatan` DISABLE KEYS */;
INSERT INTO `divisi_kegiatan` VALUES (4,2,'Sekretaris',1,'Bertugas mengelola administrasi internal seperti pendataan absensi relawan'),(5,2,'Bendahara',1,'Bertugas penyusunan laporan kegiatan, sekaligus mengatur sirkulasi keuangan mulai dari pencatatan pengeluaran hingga pembuatan laporan finansial akhir program.'),(6,2,'Acara',5,'Relawan di divisi ini bertanggung jawab menyusun rangkaian agenda atau rundown kegiatan dari awal hingga akhir, serta menyiapkan materi hiburan edukatif seperti games dan ice breaking untuk memastikan suasana belajar tetap menyenangkan dan interaktif bagi siswa.'),(7,2,'Humas',2,'Bertindak sebagai penghubung utama antara panitia dengan pihak eksternal, divisi ini menangani segala urusan perizinan dengan pihak sekolah atau yayasan, mengurus administrasi surat-menyurat, serta menyambut tamu undangan saat hari pelaksanaan.'),(8,2,'Perkap',4,'Relawan perkap bertanggung jawab dalam penyediaan seluruh fasilitas teknis dan alat peraga yang dibutuhkan, mulai dari transportasi peralatan hingga memastikan semua perlengkapan tersedia di lokasi dengan aman dan lengkap.'),(9,2,'Pendamping',6,'Fokus utama divisi ini adalah memberikan pendampingan langsung kepada adik-adik siswa di dalam kelas, membantu mereka memahami materi pelajaran yang sulit, serta menjaga kondisi kelas agar tetap kondusif dan nyaman selama kegiatan berlangsung.'),(10,2,'PDD',4,'Divisi ini memiliki tugas penting untuk mengabadikan setiap momen berharga melalui foto dan video, mengelola konten publikasi di media sosial, serta menata dekorasi di lokasi kegiatan agar suasana belajar menjadi lebih ceria dan menarik.'),(11,2,'Sponsorship',3,'Divisi ini berperan strategis dalam mencari dukungan pendanaan dari mitra eksternal atau perusahaan melalui penyusunan proposal kerjasama yang profesional guna mendukung kebutuhan anggaran kegiatan pengabdian.');
/*!40000 ALTER TABLE `divisi_kegiatan` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `kegiatan`
--

DROP TABLE IF EXISTS `kegiatan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `kegiatan` (
  `id_kegiatan` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL,
  `nama_kegiatan` varchar(150) NOT NULL,
  `foto_kegiatan` varchar(255) DEFAULT NULL,
  `tanggal_pelaksanaan` date NOT NULL,
  `jam_kegiatan` varchar(50) NOT NULL,
  `batas_registrasi` date NOT NULL,
  `lokasi` varchar(100) NOT NULL,
  `alamat_lengkap` text NOT NULL,
  `kategori` enum('sd','slb','yayasan') NOT NULL,
  `deskripsi_detail` text NOT NULL,
  `status_kegiatan` enum('aktif','selesai') DEFAULT 'aktif',
  `detail_aktivitas` text DEFAULT NULL,
  PRIMARY KEY (`id_kegiatan`),
  KEY `id_user` (`id_user`),
  CONSTRAINT `kegiatan_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `kegiatan`
--

LOCK TABLES `kegiatan` WRITE;
/*!40000 ALTER TABLE `kegiatan` DISABLE KEYS */;
INSERT INTO `kegiatan` VALUES (2,1,'Relawan SDN Medokan Sawah 1','20260412071336_foto5.JPG','2026-04-30','08.00-11.00','2026-04-07','SDN Medokan Sawah 1','Jl. Medokan Sawah No. 27, Kel. Medokan Sawah, Kec. Rungkut, Kota Surabaya, Jawa Timur 60295','sd','\"UPN Mengajar di SD Medokan Ayu 1 merupakan program pengabdian masyarakat unggulan dari UKM Penalaran & Kreativitas UPN \'Veteran\' Jawa Timur. Program ini hadir sebagai wadah bagi mahasiswa untuk terjun langsung membantu meningkatkan kualitas literasi dan numerasi siswa sekolah dasar. Dengan mengusung metode \'Fun Learning\', relawan tidak hanya mengajar secara formal, tetapi juga berperan sebagai kakak asuh yang memberikan motivasi dan inspirasi. Mari bergabung untuk menciptakan suasana belajar yang ceria, interaktif, dan berkesan bagi adik-adik di Medokan Ayu!\"','aktif','Assist Teaching: Membantu guru kelas dalam menyampaikan materi pelajaran di kelas (fokus pada Literasi dan Numerasi).\r\n\r\nCreative Ice Breaking: Menyusun dan memimpin sesi permainan edukatif di sela-sela jam pelajaran untuk meningkatkan semangat siswa.\r\n\r\nMentoring Session: Melakukan pendampingan intensif bagi siswa yang membutuhkan bantuan belajar tambahan secara personal.\r\n\r\nEducational Media: Membuat alat peraga atau media pembelajaran kreatif sederhana dari bahan yang ada.\r\n\r\nCharacter Building: Menanamkan nilai-nilai budi pekerti dan motivasi sekolah melalui cerita inspiratif.');
/*!40000 ALTER TABLE `kegiatan` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pendaftaran_relawan`
--

DROP TABLE IF EXISTS `pendaftaran_relawan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `pendaftaran_relawan` (
  `id_pendaftaran` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL,
  `id_kegiatan` int(11) NOT NULL,
  `no_hp` varchar(20) NOT NULL,
  `umur` int(11) NOT NULL,
  `jenis_kelamin` enum('Laki-laki','Perempuan') NOT NULL,
  `asal_prodi` varchar(100) NOT NULL,
  `pilihan_divisi_1` enum('Acara','Humas','Perlengkapan','Konsumsi','PDD','Pengajar') NOT NULL,
  `pilihan_divisi_2` enum('Acara','Humas','Perlengkapan','Konsumsi','PDD') NOT NULL,
  `portofolio` varchar(255) NOT NULL,
  `pengalaman_keahlian` text NOT NULL,
  `metode_pembayaran` enum('BCA','BNI','MANDIRI') DEFAULT NULL,
  `bukti_pembayaran` varchar(255) NOT NULL,
  `status_seleksi` enum('pending','diterima','ditolak') DEFAULT 'pending',
  PRIMARY KEY (`id_pendaftaran`),
  KEY `id_user` (`id_user`),
  KEY `id_kegiatan` (`id_kegiatan`),
  CONSTRAINT `pendaftaran_relawan_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`),
  CONSTRAINT `pendaftaran_relawan_ibfk_2` FOREIGN KEY (`id_kegiatan`) REFERENCES `kegiatan` (`id_kegiatan`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pendaftaran_relawan`
--

LOCK TABLES `pendaftaran_relawan` WRITE;
/*!40000 ALTER TABLE `pendaftaran_relawan` DISABLE KEYS */;
/*!40000 ALTER TABLE `pendaftaran_relawan` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id_user` int(11) NOT NULL AUTO_INCREMENT,
  `nama_lengkap` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `role` enum('admin','user') NOT NULL,
  PRIMARY KEY (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Admin1','admin1@upnmengajar.com','admin123','admin');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2026-04-12 18:41:12
