<?php
include "koneksi.php"; 

// 1. Cek apakah ada ID di URL
if (isset($_GET['id'])) {
    $id = mysqli_real_escape_string($koneksi, $_GET['id']);
    $query = mysqli_query($koneksi, "SELECT * FROM kegiatan WHERE id_kegiatan = '$id'");
} else {
    // 2. KALAU TIDAK ADA ID, ambil data yang PALING BARU ditambahkan (Solusi buat kamu)
    $query = mysqli_query($koneksi, "SELECT * FROM kegiatan ORDER BY id_kegiatan DESC LIMIT 1");
}

$data = mysqli_fetch_assoc($query);

// Pengecekan jika tabel masih benar-benar kosong
if (!$data) {
    die("Database kamu masih kosong. Silahkan tambah kegiatan dulu di admin.");
}
?>

<!doctype html>
<html lang="id">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Detail Relawan - <?php echo $data['nama_kegiatan']; ?></title>

    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Instrument+Serif:ital@0;1&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet" />
    
    <link rel="stylesheet" href="../dist/output.css" />

    <style>
        body { font-family: 'Poppins', sans-serif; }
    </style>
  </head>

  <body class="bg-[#f5f5f7] font-poppins text-gray-800">
   <header class="fixed top-0 left-0 w-full z-50 bg-[#8B1E1E] shadow-md">
  <div class="flex items-center justify-between px-6 py-2 text-white">
    <div class="flex items-center">
      <a href="beranda.html" class="overflow-hidden">
        <img src="./foto/logo.jpeg" alt="Logo UPN Mengajar" class="w-16 scale-125" />
      </a>
    </div>
    <div class="flex items-center gap-12">
      <nav>
        <ul class="flex gap-12 font-poppins font-semibold">
          <li><a href="beranda.html" class="hover:text-gray-200 transition-colors">Home</a></li>
          <li><a href="tentang.html" class="hover:text-gray-200 transition-colors">Tentang</a></li>
          <li><a href="kegiatan.html" class="hover:text-gray-200 transition-colors">Kegiatan</a></li>
          <li>
            <a href="relawan.php" class="relative after:absolute after:left-0 after:-bottom-1 after:h-[1.5px] after:w-full after:bg-white">
              Relawan
            </a>
          </li>
        </ul>
      </nav>
    </div>
  </div>
</header>

    <main class="pb-16 mx-auto" style="padding-top: 150px; max-width: 1400px; padding-left: 40px; padding-right: 40px;">
      
      <section class="grid grid-cols-1 lg:grid-cols-[2fr_1fr] gap-6 items-stretch mb-10">
        <div class="h-full">
          <div class="bg-white rounded-[24px] border border-gray-200 overflow-hidden shadow-sm h-full">
            <img src="./foto/sd.jpg" alt="Relawan" class="w-full h-full object-cover" />
          </div>
        </div>

        <aside class="lg:sticky lg:top-24 self-start h-fit">
          <div class="bg-white rounded-[24px] border border-gray-200 shadow-sm p-6 flex flex-col h-full">
            <div class="mb-4">
              <span class="inline-block text-xs font-medium text-white px-4 py-1.5 rounded-xl bg-gradient-to-r from-orange-500 to-purple-600 mb-4">Event</span>
              <h2 class="text-[24px] md:text-[30px] font-bold leading-snug text-gray-900"><?php echo $data['nama_kegiatan']; ?></h2>
            </div>

            <div class="flex flex-wrap gap-2 mb-5">
              <span class="text-xs px-3 py-1 rounded-full border border-red-200 text-red-500 bg-red-50 font-semibold uppercase"><?php echo $data['kategori']; ?></span>
              <span class="text-xs px-3 py-1 rounded-full border border-red-200 text-red-500 bg-red-50 font-semibold uppercase"><?php echo $data['status_kegiatan']; ?></span>
            </div>

            <div class="rounded-2xl border border-gray-200 overflow-hidden flex-1 flex flex-col">
              <div class="p-5 space-y-6 flex-1">
                <div class="flex gap-3">
                  <div class="text-red-500 text-xl">📅</div>
                  <div>
                    <p class="text-gray-500 text-sm mb-1">Jadwal Event</p>
                    <p class="text-gray-900 font-medium"><?php echo date('d F Y', strtotime($data['tanggal_pelaksanaan'])); ?></p>
                    <p class="text-gray-900"><?php echo $data['jam_kegiatan']; ?></p>
                  </div>
                </div>
                <div class="flex gap-3">
                  <div class="text-red-500 text-xl">📍</div>
                  <div>
                    <p class="text-gray-500 text-sm mb-1">Lokasi</p>
                    <p class="text-gray-900 leading-8 font-medium"><?php echo $data['lokasi']; ?></p>
                    <p class="text-gray-900 leading-snug text-sm"><?php echo $data['alamat_lengkap']; ?></p>
                  </div>
                </div>
              </div>
              <div class="bg-gray-100 px-5 py-4 text-sm text-gray-800 border-t border-gray-200">
                <span class="font-medium">Batas Registrasi:</span> <?php echo date('d M Y', strtotime($data['batas_registrasi'])); ?>
              </div>
            </div>

            <a href="formulir.php?id=<?php echo $data['id_kegiatan']; ?>" 
            class="block w-full text-center bg-[#EB1D2D] text-white font-semibold py-3.5 rounded-xl transition mt-5 active:bg-red-800 shadow-md hover:bg-red-700">
            Daftar Sekarang
            </a>
          </div>
        </aside>
      </section>

      <section class="mt-6 lg:mt-8 grid grid-cols-1 lg:grid-cols-[3fr_1fr] gap-6">
        <div class="space-y-6">
          <div class="bg-white rounded-2xl border border-gray-200 p-6 md:p-7">
            <h3 class="text-2xl font-semibold text-gray-900 mb-5">Deskripsi</h3>
            <div class="space-y-5 text-gray-700 leading-8">
              <p><?php echo nl2br($data['deskripsi_detail']); ?></p>
            </div>
          </div>

          <div class="bg-white rounded-2xl border border-gray-200 p-6 md:p-7">
            <h3 class="text-2xl font-semibold text-gray-900 mb-5">Detail Aktivitas</h3>
            <div class="text-gray-700 leading-8">
                <?php echo nl2br($data['detail_aktivitas']); ?>
            </div>
          </div>

          <div class="grid grid-cols-1 gap-6 mt-4">
            <?php 
            $divisi_list = ['sekretaris' => 'Sekretaris','bendahara' => 'Bendahara','acara' => 'Acara','humas' => 'Humas','perkap' => 'Perkap','pendamping' => 'Pendamping Kelompok','pdd' => 'PDD','sponsorship' => 'Sponsorship'];
            foreach ($divisi_list as $key => $label) {
                if ($data['kuota_' . $key] > 0) {
            ?>
                <div class="bg-white rounded-2xl border border-gray-200 px-5 py-5 shadow-sm">
                  <h4 class="font-semibold text-lg text-gray-900">Divisi <?php echo $label; ?></h4>
                  <p class="text-sm text-gray-600 mt-1"><?php echo $data['jobdesc_' . $key]; ?></p>
                  <div class="flex flex-wrap gap-4 mt-3 text-sm text-gray-600">
                    <span class="bg-red-50 text-red-600 px-2 py-1 rounded font-medium">👤 Relawan dibutuhkan: <?php echo $data['kuota_' . $key]; ?> orang</span>
                    <span class="bg-gray-50 px-2 py-1 rounded font-medium">🕒 Sesuai Rundown</span>
                  </div>
                </div>
            <?php } } ?>
          </div>
        </div>
      </section>
    </main>

    <footer class="bg-[#8B1E1E] text-white pt-16">
      <div class="max-w-7xl mx-auto px-6 md:px-20 grid md:grid-cols-3 gap-10 pb-10">
        <div class="md:border-r md:border-red-300 md:pr-10">
          <div class="w-24 h-24 overflow-hidden mb-5">
            <img src="foto/logo.jpeg" class="w-full h-full object-cover scale-150" />
          </div>
          <h4 class="font-semibold mb-3 text-lg">Menu</h4>
          <ul class="space-y-2 text-sm">
            <li><a href="#" class="hover:underline">Home</a></li>
            <li><a href="#" class="hover:underline">Tentang</a></li>
            <li><a href="#" class="hover:underline">Kegiatan</a></li>
            <li><a href="#" class="hover:underline">Relawan</a></li>
          </ul>
        </div>

        <div class="text-center md:border-r md:border-red-300 md:px-10">
          <h4 class="font-semibold mb-2 text-lg">Send Message</h4>
          <form action="mailto:upnmengajar.jt@gmail.com" method="post" enctype="text/plain" class="space-y-3">
            <input type="text" name="nama" placeholder="Nama" class="w-full px-3 py-2 rounded text-black text-sm" />
            <input type="email" name="email" placeholder="Email" class="w-full px-3 py-2 rounded text-black text-sm" />
            <textarea name="pesan" placeholder="Pesan" rows="3" class="w-full px-3 py-2 rounded text-black text-sm"></textarea>
            <div class="text-left">
              <button type="submit" class="bg-white text-[#8B1E1E] px-5 py-2 rounded text-sm font-semibold hover:bg-gray-200 transition">Kirim</button>
            </div>
          </form>
        </div>

        <div class="md:pl-10">
          <h4 class="font-semibold mb-4 text-lg">Contact Us</h4>
          <div class="space-y-3 text-sm">
            <div class="flex items-center gap-2">
              <img src="./foto/Untitled design (17).png" class="w-5 h-6" />
              <a href="mailto:upnmengajar.jt@gmail.com" class="hover:underline">upnmengajar.jt@gmail.com</a>
            </div>
            <div class="flex items-center gap-2">
              <img src="foto/instagram.png" class="w-5 h-6" />
              <a href="https://instagram.com/upnmengajar.jt" class="hover:underline">@upnmengajar.jt</a>
            </div>
            <div class="flex items-center gap-2">
              <img src="foto/whatsapp.png" class="w-5 h-6" />
              <a href="https://wa.me/6289699808453" class="hover:underline">089699808453 (Nabila)</a>
            </div>
          </div>
        </div>
      </div>

      <div class="bg-[#6e1515] px-6 md:px-20 py-4 flex flex-col md:flex-row justify-between text-sm text-gray-200">
        <p>© 2026 UPN Mengajar — UKM Penalaran & Kreativitas UPN "Veteran" Jawa Timur</p>
        <p>Website by <span class="font-semibold">Vina • Naila • Inez Sistem informasi UPNVJT 2024</span></p>
      </div>
    </footer>

    <script>
      const header = document.querySelector("header");
      window.addEventListener("scroll", function () {
        if (window.scrollY > 50) {
          header.classList.add("bg-red-900", "shadow-lg", "transition-all", "duration-300");
        } else {
          header.classList.remove("bg-red-900", "shadow-lg");
        }
      });
    </script>
  </body>
</html>