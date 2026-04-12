<?php
include "koneksi.php"; 

// 1. Ambil data kegiatan terbaru (Asumsi kategori di form disave sebagai 'Yayasan' atau 'sd')
$query_kegiatan = mysqli_query($koneksi, "SELECT * FROM kegiatan WHERE kategori IN ('Yayasan', 'yayasan') ORDER BY id_kegiatan DESC LIMIT 1");

if (!$query_kegiatan) {
    die("Query Error (Kegiatan): " . mysqli_error($koneksi));
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

    <main class="max-w-7xl mx-auto px-6 py-12 mt-32">
      
      <div class="grid grid-cols-1 lg:grid-cols-[2fr_1fr] gap-8 items-start">
        
        <div class="space-y-6">
          
          <div class="bg-white rounded-[20px] overflow-hidden shadow-sm border border-gray-100 aspect-video md:h-[450px]">
            <?php 
                $foto = $data['foto_kegiatan'] ?? 'sd.jpg'; 
            ?>
            <img src="./foto/<?php echo htmlspecialchars($foto); ?>" alt="Kegiatan SD" class="w-full h-full object-cover" />
          </div>

          <div class="bg-white rounded-[20px] border border-gray-100 shadow-sm p-6 md:p-8">
            <h3 class="text-xl font-bold text-gray-900 mb-4">Deskripsi</h3>
            <p class="text-gray-600 leading-relaxed text-sm md:text-base whitespace-pre-line">
              <?php 
                // Cek nama kolom deskripsi (bisa 'deskripsi_lengkap' atau 'deskripsi' sesuai databasemu)
                echo htmlspecialchars($data['deskripsi_detail'] ?? ($data['deskripsi'] ?? 'Belum ada deskripsi yang ditambahkan.')); 
              ?>
            </p>
          </div>

          <div class="bg-white rounded-[20px] border border-gray-100 shadow-sm p-6 md:p-8">
            <h3 class="text-xl font-bold text-gray-900 mb-4">Detail Aktivitas</h3>
            <ul class="space-y-3 text-gray-600 text-sm md:text-base">
              <?php
                // Memecah teks area dari database menjadi list HTML per baris
                $aktivitas_raw = $data['detail_aktivitas'] ?? '';
                $aktivitas_list = array_filter(array_map('trim', explode("\n", $aktivitas_raw)));

                if (empty($aktivitas_list)) {
                    echo "<li>Belum ada detail aktivitas.</li>";
                } else {
                    foreach ($aktivitas_list as $act) {
                        echo '<li class="flex items-start gap-3"><span class="text-gray-400 mt-1">•</span> <span>' . htmlspecialchars($act) . '</span></li>';
                    }
                }
              ?>
            </ul>
          </div>

          <div class="space-y-4">
              <h3 class="text-xl font-bold text-gray-900 mt-8 mb-2">Kebutuhan Relawan</h3>
              
              <?php
              if ($id_kegiatan > 0) {
                  // 2. Ambil data divisi berdasarkan id_kegiatan
                  // Asumsi nama tabel: divisi_kegiatan
                  // Asumsi kolom: nama_divisi, kuota, job_description
                  $query_divisi = mysqli_query($koneksi, "SELECT * FROM divisi_kegiatan WHERE id_kegiatan = '$id_kegiatan'");
                  
                  if ($query_divisi && mysqli_num_rows($query_divisi) > 0) {
                      while ($divisi = mysqli_fetch_assoc($query_divisi)) {
                          // Hanya tampilkan jika kuota lebih dari 0
                          if (isset($divisi['kuota']) && $divisi['kuota'] > 0) {
                              ?>
                              <div class="bg-white rounded-[20px] border border-gray-100 shadow-sm p-6">
                                <h4 class="font-bold text-lg text-gray-900"><?php echo htmlspecialchars($divisi['nama_divisi']); ?></h4>
                                
                                <?php if (!empty($divisi['jobdesc'])): ?>
                                    <p class="text-sm text-gray-600 mt-2 mb-3 leading-relaxed">
                                        <?php echo nl2br(htmlspecialchars($divisi['jobdesc'])); ?>
                                    </p>
                                <?php endif; ?>

                                <div class="flex flex-wrap gap-6 mt-3 text-sm text-gray-500 font-medium">
                                  <span class="flex items-center gap-2 bg-red-50 text-red-600 px-3 py-1 rounded-md">
                                      👤 Kuota: <?php echo htmlspecialchars($divisi['kuota']); ?> orang
                                  </span>
                                </div>
                              </div>
                              <?php
                          }
                      }
                  } else {
                      echo '<p class="text-sm text-gray-500 bg-white p-6 rounded-[20px] border border-gray-100 shadow-sm">Belum ada data kebutuhan divisi yang ditambahkan oleh admin.</p>';
                  }
              }
              ?>
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