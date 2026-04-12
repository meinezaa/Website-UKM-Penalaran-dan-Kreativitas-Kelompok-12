<?php
include "koneksi.php"; 

// 1. Cek apakah ada ID di URL
if (isset($_GET['id'])) {
    $id = mysqli_real_escape_string($koneksi, $_GET['id']);
    $query = mysqli_query($koneksi, "SELECT * FROM kegiatan WHERE id_kegiatan = '$id' AND kategori = 'slb'");
} else {
    // 2. Kalau tidak ada ID, ambil data SLB terbaru
    $query = mysqli_query($koneksi, "SELECT * FROM kegiatan WHERE kategori = 'slb' ORDER BY id_kegiatan DESC LIMIT 1");
}

$data = mysqli_fetch_assoc($query_kegiatan);

// Jika tabel kosong, siapkan array kosong agar tidak error
if (!$data) {
    $data = []; 
    $id_kegiatan = 0;
} else {
    $id_kegiatan = $data['id_kegiatan'];
}
?>

<!doctype html>
<html lang="id">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Detail Relawan - <?php echo htmlspecialchars($data['nama_kegiatan'] ?? 'Belum Ada Kegiatan'); ?></title>

    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet" />
    
   <link rel="stylesheet" href="../dist/output.css?v=<?php echo time(); ?>">
    
    <style>
        body { font-family: 'Poppins', sans-serif; background-color: #f8f9fa; }
    </style>
  </head>

  <body class="text-gray-800">
    <header class="fixed top-0 left-0 w-full z-50 bg-[#8B1E1E] shadow-md">
      <div class="flex items-center justify-between px-6 py-2 text-white">
        <div class="flex items-center">
          <a href="beranda.html" class="overflow-hidden">
            <img
              src="./foto/logo.jpeg"
              alt="Logo UPN Mengajar"
              class="w-16 scale-125"
            />
          </a>
        </div>

        <div class="flex items-center gap-12">
          <nav>
            <ul class="flex gap-12 font-poppins font-semibold">
              <li>
                <a
                  href="beranda.html"
                  class="relative after:absolute after:right-0 after:-bottom-1 after:h-[1.5px] after:w-full after:bg-white"
                >
                  Home
                </a>
              </li>
              <li class="relative group">
                <a
                  href="tentang.html"
                  class="flex items-center gap-1 relative after:absolute after:left-0 after:-bottom-1 after:h-[1.5px] after:w-0 after:bg-white after:transition-all after:duration-300 hover:after:w-full"
                >
                  Tentang
                  <svg
                    xmlns="http://www.w3.org/2000/svg"
                    class="w-4 h-4 transition-transform duration-200 group-hover:rotate-180"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor"
                  >
                    <path
                      stroke-linecap="round"
                      stroke-linejoin="round"
                      stroke-width="2"
                      d="M19 9l-7 7-7-7"
                    />
                  </svg>
                </a>
                <ul
                  class="absolute left-0 mt-3 w-max bg-white text-gray-600 text-sm shadow-md opacity-0 invisible -translate-y-2 group-hover:opacity-100 group-hover:visible group-hover:translate-y-0 transition-all duration-300 ease-out"
                >
                  <li>
                    <a
                      href="ukm.html"
                      class="block px-5 py-2 hover:bg-gray-100"
                    >
                      UKM Penalaran dan Kreativitas
                    </a>
                  </li>
                  <li>
                    <a
                      href="upnmengajar.html"
                      class="block px-5 py-2 hover:bg-gray-100"
                    >
                      Program Kerja UPN Mengajar
                    </a>
                  </li>
                  <li>
                    <a
                      href="struktur.html"
                      class="block px-5 py-2 hover:bg-gray-100"
                    >
                      Tim UPN Mengajar
                    </a>
                  </li>
                </ul>
              </li>
              <li>
                <a
                  href="kegiatan.html"
                  class="relative after:absolute after:left-0 after:-bottom-1 after:h-[1.5px] after:w-0 after:bg-white after:transition-all after:duration-300 hover:after:w-full"
                >
                  Kegiatan
                </a>
              </li>
              <li>
                <a
                  href="relawan.php"
                  class="relative after:absolute after:left-0 after:-bottom-1 after:h-[1.5px] after:w-0 after:bg-white after:transition-all after:duration-300 hover:after:w-full"
                >
                  Relawan
                </a>
              </li>
            </ul>
          </nav>

          <div class="relative group">
            <a href="#" class="hover:text-gray-300">
              <svg
                xmlns="http://www.w3.org/2000/svg"
                class="w-7 h-7"
                fill="none"
                viewBox="0 0 24 24"
                stroke="currentColor"
              >
                <path
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  stroke-width="2"
                  d="M5.121 17.804A9 9 0 1118.879 17.804M15 11a3 3 0 11-6 0 3 3 0 016 0z"
                />
              </svg>
            </a>
            <div
              class="absolute -bottom-10 left-1/2 -translate-x-1/2 bg-black/50 text-white text-xs px-3 py-2 opacity-0 group-hover:opacity-100 transition duration-200 whitespace-nowrap"
            >
              Log In
            </div>
          </div>
        </div>
      </div>
    </header>

    <main
      class="pb-16 mx-auto"
      style="
        padding-top: 150px;
        max-width: 1400px;
        padding-left: 40px;
        padding-right: 40px;
      "
    >
      <section
        class="grid grid-cols-1 lg:grid-cols-[2fr_1fr] gap-6 items-stretch mb-10"
      >
        <div class="h-full">
          <div
            class="bg-white rounded-[24px] border border-gray-200 overflow-hidden shadow-sm h-full"
          >
            <img
              src="./foto/slb.jpg"
              alt="Relawan SLB"
              class="w-full h-full object-cover"
            />
          </div>

        </div>

        <aside class="lg:sticky lg:top-28 h-fit">
          <div class="bg-white rounded-[24px] border border-gray-100 shadow-md p-6 md:p-8 flex flex-col">
            
            <div class="mb-5">
              <span class="inline-block text-xs font-semibold text-white px-3 py-1.5 rounded-lg bg-gradient-to-r from-purple-500 to-purple-400 mb-4">
                Event
              </span>
              <h2 class="text-2xl md:text-3xl font-bold leading-tight text-gray-900 mb-4">
                <?php echo htmlspecialchars($data['nama_kegiatan'] ?? 'Judul Kegiatan Belum Diinput'); ?>
              </h2>
            </div>

            <div class="rounded-2xl border border-gray-100 overflow-hidden flex-1 flex flex-col mb-6">
              <div class="p-5 space-y-6">
                <div class="flex gap-4">
                  <div class="text-blue-400 text-xl mt-1">📅</div>
                  <div>
                    <p class="text-gray-400 text-xs uppercase tracking-wider font-semibold mb-1">Jadwal Event</p>
                    <p class="text-gray-900 font-semibold text-sm">
                      <?php echo htmlspecialchars($data['tanggal_pelaksanaan'] ?? 'Tanggal belum diset'); ?>
                    </p>
                    <p class="text-gray-900 text-sm mt-0.5">
                      <?php echo htmlspecialchars($data['jam_kegiatan'] ?? 'Jam belum diset'); ?> WIB
                    </p>
                  </div>
                </div>
                
                <div class="flex gap-4">
                  <div class="text-red-400 text-xl mt-1">📍</div>
                  <div>
                    <p class="text-gray-400 text-xs uppercase tracking-wider font-semibold mb-1">Lokasi</p>
                    <p class="text-gray-900 font-semibold text-sm">
                      <?php echo htmlspecialchars($data['lokasi'] ?? 'Nama lokasi belum diset'); ?>
                    </p>
                    <p class="text-gray-600 text-sm mt-1 leading-relaxed">
                      <?php echo htmlspecialchars($data['alamat_lengkap'] ?? 'Alamat lengkap belum diset'); ?>
                    </p>
                  </div>
                </div>
              </div>

              <div class="bg-gray-50 px-5 py-4 text-xs text-gray-600 border-t border-gray-100">
                <span class="font-semibold text-gray-800">Batas Registrasi:</span> 
                <?php echo htmlspecialchars($data['batas_registrasi'] ?? '-'); ?>
              </div>
            </div>

            <a href="daftar.html" class="block w-full text-center bg-[#EB1D2D] hover:bg-red-700 text-white font-semibold py-3.5 rounded-xl transition shadow-sm">
              Daftar Sekarang
            </a>
          </div>
        </aside>

      </div>
    </main>
  </body>
</html>