<?php 
session_start(); 

include 'koneksi.php'; 

function getDataKegiatan($koneksi, $kategori, $fallbackNama) {
    $kategori = mysqli_real_escape_string($koneksi, $kategori);
    $query = mysqli_query($koneksi, "SELECT id_kegiatan, nama_kegiatan FROM kegiatan WHERE kategori = '$kategori' ORDER BY id_kegiatan DESC LIMIT 1");
    $result = mysqli_fetch_assoc($query);
    
    if (!$result) {
        return ['id_kegiatan' => '0', 'nama_kegiatan' => $fallbackNama];
    }
    return $result;
}

$sd = getDataKegiatan($koneksi, 'sd', 'Program Sekolah Dasar');
$slb = getDataKegiatan($koneksi, 'slb', 'Program Sekolah Luar Biasa');
$yayasan = getDataKegiatan($koneksi, 'yayasan', 'Program Yayasan & Komunitas');
?>

<!doctype html>
<html lang="id">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Relawan - UPN Mengajar</title>

    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Instrument+Serif:ital@0;1&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
      rel="stylesheet"
    />

    <link rel="stylesheet" href="../dist/output.css" />
  </head>

  <body class="bg-gray-50 font-poppins">
    <header class="fixed top-0 left-0 w-full z-50 transition-all duration-300">
<div class="flex items-center justify-between px-6 py-0.5 text-white">

<div class="flex items-center">
<a href="beranda.php" class="overflow-hidden">
<img src="./foto/logo.jpeg" 
alt="Logo UPN Mengajar" 
class="w-16 scale-125">
</a>
</div>

<div class="flex items-center gap-12">

<nav>
<ul class="flex gap-12 font-poppins font-semibold">

<li>
<a href="beranda.php"
class="relative after:absolute after:left-0 after:-bottom-1 after:h-[1.5px] after:w-0 after:bg-white after:transition-all after:duration-300 hover:after:w-full">
Home
</a>
</li>

<li class="relative group">

<a href="tentang.html"
class="flex items-center gap-1 relative 
after:absolute after:left-0 after:-bottom-1 after:h-[1.5px] after:w-0 
after:bg-white after:transition-all after:duration-300 hover:after:w-full">

Tentang

<svg xmlns="http://www.w3.org/2000/svg"
class="w-4 h-4 transition-transform duration-200 group-hover:rotate-180"
fill="none"
viewBox="0 0 24 24"
stroke="currentColor">

<path stroke-linecap="round"
stroke-linejoin="round"
stroke-width="2"
d="M19 9l-7 7-7-7"/>

</svg>

</a>

<ul class="absolute left-0 mt-3 w-max bg-white text-gray-600 text-sm shadow-md
opacity-0 invisible -translate-y-2
group-hover:opacity-100 group-hover:visible group-hover:translate-y-0
transition-all duration-300 ease-out">

<li>
<a href="ukm.html" class="block px-5 py-2 hover:bg-gray-100">
UKM Penalaran dan Kreativitas
</a>
</li>

<li>
<a href="upnmengajar.html" class="block px-5 py-2 hover:bg-gray-100">
Program Kerja UPN Mengajar
</a>
</li>

<li>
<a href="struktur.html" class="block px-5 py-2 hover:bg-gray-100">
Tim UPN Mengajar
</a>
</li>

</ul>

</li>

<li>
<a href="kegiatan.html"
class="relative after:absolute after:left-0 after:-bottom-1 after:h-[1.5px] after:w-0 after:bg-white after:transition-all after:duration-300 hover:after:w-full">
Kegiatan
</a>
</li>

<li>
<a href="relawan.php"
class="relative after:absolute after:right-0 after:-bottom-1 after:h-[1.5px] after:w-full after:bg-white">
Relawan
</a>
</li>

<?php if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin') : ?>
<li>
    <a href="dashboard_admin.php" 
       class="relative after:absolute after:left-0 after:-bottom-1 after:h-[1.5px] after:w-0 after:bg-white after:transition-all after:duration-300 hover:after:w-full">
       Dashboard Admin
    </a>
</li>
<?php endif; ?>

</ul>
</nav>

<div class="relative group">
  <?php if (isset($_SESSION['id_user'])) : ?>
    <a href="logout.php" class="hover:text-red-400 transition-all duration-300">
      <svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
      </svg>
    </a>
    <div class="absolute -bottom-12 left-1/2 -translate-x-1/2 
                bg-black/80 backdrop-blur-sm text-white text-[11px] px-4 py-2 
                opacity-0 group-hover:opacity-100 transition-all duration-300 
                whitespace-nowrap rounded-lg shadow-2xl border border-white/10">
      Keluar
    </div>

  <?php else : ?>
    <a href="login.php" class="hover:text-gray-300 transition-all duration-300">
      <svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A9 9 0 1118.879 17.804M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
      </svg>
    </a>
    <div class="absolute -bottom-12 left-1/2 -translate-x-1/2 
                bg-black/80 backdrop-blur-sm text-white text-[11px] px-4 py-2 
                opacity-0 group-hover:opacity-100 transition-all duration-300 
                whitespace-nowrap rounded-lg shadow-2xl border border-white/10">
      Masuk / Daftar
    </div>
  <?php endif; ?>
</div>

</div>
</div>
</header>

<main class="pt-32 bg-gray-50">

    {{-- HERO --}}
    <section class="bg-gradient-to-br from-white via-red-50 to-red-100">
        <div class="max-w-7xl mx-auto px-6 py-20">

            <div class="grid lg:grid-cols-2 gap-12 items-center">

                <div>
                    <span class="px-5 py-2 bg-red-100 text-[#8B1E1E] rounded-full text-sm font-semibold">
                        DOKUMENTASI KEGIATAN
                    </span>

                    <h1 class="mt-6 text-5xl font-bold text-[#8B1E1E] leading-tight">
                        Dokumentasi Relawan
                        <br>
                        UPN Mengajar
                    </h1>

                    <p class="mt-6 text-gray-600 text-lg leading-relaxed">
                        Momen-momen inspiratif yang tercipta dari semangat
                        berbagi ilmu dan kepedulian sosial di berbagai sekolah
                        dan komunitas.
                    </p>

                    <a href="/kegiatan"
                       class="inline-flex items-center mt-8 bg-[#8B1E1E] text-white px-8 py-4 rounded-full font-semibold hover:bg-red-900">
                        Lihat Kegiatan Aktif
                    </a>
                </div>

                <div>
                    <img src="{{ asset('foto/dokumentasi-banner.jpg') }}"
                         class="rounded-3xl shadow-xl w-full">
                </div>

            </div>

        </div>
    </section>

    {{-- STATISTIK --}}
    <section class="bg-white shadow-sm">
        <div class="max-w-7xl mx-auto px-6 py-10">

            <div class="grid md:grid-cols-4 gap-8 text-center">

                <div>
                    <h2 class="text-5xl font-bold text-[#8B1E1E]">
                        {{ $kegiatan->count() }}+
                    </h2>
                    <p class="mt-2 text-gray-600">
                        Kegiatan Terlaksana
                    </p>
                </div>

                <div>
                    <h2 class="text-5xl font-bold text-[#8B1E1E]">
                        300+
                    </h2>
                    <p class="mt-2 text-gray-600">
                        Relawan Bergabung
                    </p>
                </div>

                <div>
                    <h2 class="text-5xl font-bold text-[#8B1E1E]">
                        1500+
                    </h2>
                    <p class="mt-2 text-gray-600">
                        Peserta Didik
                    </p>
                </div>

                <div>
                    <h2 class="text-5xl font-bold text-[#8B1E1E]">
                        10+
                    </h2>
                    <p class="mt-2 text-gray-600">
                        Mitra Sekolah
                    </p>
                </div>

            </div>

        </div>
    </section>

    {{-- DOKUMENTASI --}}
    <section class="max-w-7xl mx-auto px-6 py-20">

        <h2 class="text-4xl font-bold text-[#8B1E1E] mb-12">
            Dokumentasi Kegiatan
        </h2>

        <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-8">

            @foreach($kegiatan as $item)

                @foreach($item->dokumentasi as $foto)

                    <div class="bg-white rounded-2xl overflow-hidden shadow hover:shadow-xl transition">

                        <img src="{{ asset('storage/'.$foto->foto) }}"
                             class="w-full h-56 object-cover">

                        <div class="p-5">

                            <h3 class="font-bold text-lg">
                                {{ $item->nama_kegiatan }}
                            </h3>

                            <p class="text-gray-500 text-sm mt-1">
                                {{ $item->lokasi }}
                            </p>

                            <p class="text-gray-400 text-sm mt-2">
                                {{ \Carbon\Carbon::parse($item->tanggal_pelaksanaan)->format('d F Y') }}
                            </p>

                        </div>

                    </div>

                @endforeach

            @endforeach

        </div>

    </section>

</main>

    <footer class="w-full bg-[#8B1E1E] text-white pt-16">
      <div
        class="max-w-7xl mx-auto px-6 md:px-20 grid md:grid-cols-3 gap-10 pb-10"
      >
        <div class="md:border-r md:border-red-300 md:pr-10">
          <div class="w-24 h-24 overflow-hidden mb-5">
            <img
              src="foto/logo.jpeg"
              alt="Logo UPN Mengajar"
              class="w-full h-full object-cover scale-150"
            />
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
          <p class="text-xs text-gray-200 mb-4">
            Pesan akan dikirim ke email UPN Mengajar
          </p>

          <form
            action="mailto:upnmengajar.jt@gmail.com"
            method="post"
            enctype="text/plain"
            class="space-y-3"
          >
            <input
              type="text"
              name="nama"
              placeholder="Nama"
              class="w-full px-3 py-2 rounded text-black text-sm"
            />
            <input
              type="email"
              name="email"
              placeholder="Email"
              class="w-full px-3 py-2 rounded text-black text-sm"
            />
            <textarea
              name="pesan"
              placeholder="Pesan"
              rows="3"
              class="w-full px-3 py-2 rounded text-black text-sm"
            ></textarea>

            <div class="text-left">
              <button
                type="submit"
                class="bg-white text-[#8B1E1E] px-5 py-2 rounded text-sm font-semibold hover:bg-gray-200 transition"
              >
                Kirim
              </button>
            </div>
          </form>
        </div>

        <div class="md:pl-10">
          <h4 class="font-semibold mb-4 text-lg">Contact Us</h4>
          <div class="space-y-3 text-sm">
            <div class="flex items-center gap-2">
              <img
                src="./foto/Untitled design (17).png"
                alt="Email"
                class="w-5 h-6"
              />
              <a href="mailto:upnmengajar.jt@gmail.com" class="hover:underline">
                upnmengajar.jt@gmail.com
              </a>
            </div>

            <div class="flex items-center gap-2">
              <img src="foto/instagram.png" alt="Instagram" class="w-5 h-6" />
              <a
                href="https://instagram.com/upnmengajar.jt"
                class="hover:underline"
              >
                @upnmengajar.jt
              </a>
            </div>

            <div class="flex items-center gap-2">
              <img src="foto/whatsapp.png" alt="WhatsApp" class="w-5 h-6" />
              <a href="https://wa.me/6289699808453" class="hover:underline">
                089699808453 (Nabila)
              </a>
            </div>
          </div>

          <div class="mt-8 text-sm text-gray-200 leading-relaxed">
            <p class="font-semibold mb-1">Sekretariat Kami Berada di:</p>
            <p>
              Universitas Pembangunan Nasional "Veteran" Jawa Timur Jl. Raya
              Rungkut Madya, Gunung Anyar, Surabaya, Jawa Timur
            </p>
          </div>
        </div>
      </div>

      <div
        class="bg-[#6e1515] px-6 md:px-20 py-4 flex flex-col md:flex-row justify-between text-sm text-gray-200"
      >
        <p>
          © 2026 UPN Mengajar — UKM Penalaran & Kreativitas UPN "Veteran" Jawa
          Timur
        </p>
        <p>
          Website by
          <span class="font-semibold">
            Vina • Naila • Inez Sistem Informasi UPNVJT 2024
          </span>
        </p>
      </div>
    </footer>

    <script>
      const header = document.querySelector("header");

      window.addEventListener("scroll", function () {
        if (window.scrollY > 50) {
          header.classList.add(
            "bg-red-900",
            "shadow-lg",
            "transition-all",
            "duration-300",
          );
        } else {
          header.classList.remove("bg-red-900", "shadow-lg");
        }
      });
    </script>
  </body>
</html>