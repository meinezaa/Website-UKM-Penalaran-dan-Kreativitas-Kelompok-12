<!doctype html>
<html lang="id">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Website UKM Penalaran</title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Instrument+Serif:ital@0;1&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    
    <!-- Tailwind / Custom CSS -->
 <link rel="stylesheet" href="{{ asset('dist/output.css') }}">
  </head>
  
<body>
  <header class="fixed top-0 left-0 w-full z-50 transition-all duration-300">
<div class="flex items-center justify-between px-6 py-0.5 text-white">

<!-- Logo -->
<div class="flex items-center">
<a href="/" class="overflow-hidden">
<img src="{{ asset('foto/logo.jpeg') }}" 
alt="Logo UPN Mengajar" 
class="w-16 scale-125">
</a>
</div>

<!-- Right Side -->
<div class="flex items-center gap-12">

<!-- Navigation -->
<nav>
<ul class="flex gap-12 font-poppins font-semibold">

<!-- HOME ACTIVE -->
<li>
 <!-- ACTIVE PAGE -->
<a href="/"
class="relative after:absolute after:right-0 after:-bottom-1 after:h-[1.5px] after:w-full after:bg-white">
Home
</a>
</li>

<!-- Tentang -->
<li class="relative group">

<a href="tentang.php"
class="flex items-center gap-1 relative 
after:absolute after:left-0 after:-bsottom-1 after:h-[1.5px] after:w-0 
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

<!-- Dropdown -->
<ul class="absolute left-0 mt-3 w-max bg-white text-gray-600 text-sm shadow-md
opacity-0 invisible -translate-y-2
group-hover:opacity-100 group-hover:visible group-hover:translate-y-0
transition-all duration-300 ease-out">

<li>
<a href="{{ url('/ukm') }}" class="block px-5 py-2 hover:bg-gray-100">
UKM Penalaran dan Kreativitas
</a>
</li>

<li>
<a href="/upnmengajar" class="block px-5 py-2 hover:bg-gray-100">
Program Kerja UPN Mengajar
</a>
</li>

<li>
<a href="{{ url('/tim') }}" class="block px-5 py-2 hover:bg-gray-100">
Tim UPN Mengajar
</a>
</li>

</ul>

</li>

<!-- Kegiatan -->
<li>
<a href="{{ url('/kegiatan') }}"
class="relative after:absolute after:left-0 after:-bottom-1 after:h-[1.5px] after:w-0 after:bg-white after:transition-all after:duration-300 hover:after:w-full">
Kegiatan
</a>
</li>

<!-- Relawan -->
<li>
<a href="{{ url('/formulir') }}"
class="relative after:absolute after:left-0 after:-bottom-1 after:h-[1.5px] after:w-0 after:bg-white after:transition-all after:duration-300 hover:after:w-full">
Relawan
</a>
</li>

@if(session('role') === 'admin')
<li>
    <a href="#" class="relative after:absolute after:left-0 after:-bottom-1 after:h-[1.5px] after:w-0 after:bg-white after:transition-all after:duration-300 hover:after:w-full">
       Dashboard Admin
    </a>
</li>
@endif

</ul>
</nav>

<!-- Login Icon + Tooltip -->
<div class="relative group">
  @if (session('id_user'))
    <!-- JIKA SUDAH LOGIN (TAMPILKAN TOMBOL KELUAR) -->
    <a href="#" class="hover:text-red-400 transition-all duration-300">
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

  @else
    <!-- JIKA BELUM LOGIN (TAMPILKAN TOMBOL MASUK / DAFTAR) -->
    <a href="{{ url('/login') }}" class="hover:text-gray-300 transition-all duration-300">
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
  @endif
</div>

</div>
</div>
</header>

<section class="pt-32 pb-20 bg-gray-50 min-h-screen">

    <div class="max-w-7xl mx-auto px-6 md:px-20">

        <!-- JUDUL -->
        <div class="text-center mb-16">

            <h1 class="text-5xl font-bold text-[#8B1E1E]">
                Kegiatan Relawan
            </h1>

            <p class="mt-4 text-gray-600 text-lg">
                Program yang sedang membuka pendaftaran relawan
            </p>

        </div>

        @if($kegiatan->count() > 0)

            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">

                @foreach($kegiatan as $item)

                <div class="bg-white rounded-3xl shadow-lg overflow-hidden hover:shadow-2xl transition duration-300">

                    <!-- FOTO -->
                    <div class="h-56 overflow-hidden bg-gray-200">

                        @if($item->foto_kegiatan)

                            <img
                                src="{{ asset('foto/' . $item->foto_kegiatan) }}"
                                alt="{{ $item->nama_kegiatan }}"
                                class="w-full h-full object-cover">

                        @else

                            <div class="w-full h-full flex items-center justify-center text-gray-400">
                                Tidak ada foto
                            </div>

                        @endif

                    </div>

                    <!-- KONTEN -->
                    <div class="p-6">

                        <span class="bg-red-100 text-red-700 text-sm px-3 py-1 rounded-full">

                            {{ strtoupper($item->kategori) }}

                        </span>

                        <h2 class="text-2xl font-bold mt-4 text-gray-800">

                            {{ $item->nama_kegiatan }}

                        </h2>

                        <p class="mt-3 text-gray-600">
                            📍 {{ $item->lokasi }}
                        </p>

                        <p class="mt-2 text-gray-500">
                            📅 {{ $item->tanggal_pelaksanaan }}
                        </p>

                        <div class="mt-6">

                            <a
                                href="{{ route('kegiatan.detail', $item->id_kegiatan) }}"
                                class="inline-block bg-[#8B1E1E] text-white px-5 py-3 rounded-xl hover:bg-[#6e1515] transition">

                                Lihat Detail

                            </a>

                        </div>

                    </div>

                </div>

                @endforeach

            </div>

        @else

            <div class="bg-white rounded-3xl shadow p-10 text-center">

                <h3 class="text-2xl font-semibold text-gray-700">
                    Belum ada kegiatan yang tersedia
                </h3>

            </div>

        @endif

    </div>

</section>



<footer class="bg-[#8B1E1E] text-white pt-16">

  <div class="max-w-7xl mx-auto px-6 md:px-20 grid md:grid-cols-3 gap-10 pb-10">

    <!-- KIRI : LOGO + MENU -->
    <div class="md:border-r md:border-red-300 md:pr-10">

      <!-- logo kecil tapi zoom -->
      <div class="w-24 h-24 overflow-hidden mb-5">
        <img src="{{ asset('foto/logo.jpeg') }}" class="w-full h-full object-cover scale-150">
      </div>

      <h4 class="font-semibold mb-3 text-lg">Menu</h4>
      <ul class="space-y-2 text-sm">
        <li><a href="#" class="hover:underline">Home</a></li>
        <li><a href="#" class="hover:underline">Tentang</a></li>
        <li><a href="#" class="hover:underline">Kegiatan</a></li>
        <li><a href="#" class="hover:underline">Relawan</a></li>
      </ul>

    </div>

    <!-- TENGAH : SEND MESSAGE -->
    <div class="text-center md:border-r md:border-red-300 md:px-10">

      <h4 class="font-semibold mb-2 text-lg">Send Message</h4>

      <!-- info pesan -->
      <p class="text-xs text-gray-200 mb-4">
        Pesan akan dikirim ke email UPN Mengajar
      </p>

      <form action="mailto:upnmengajar.jt@gmail.com" method="post" enctype="text/plain" class="space-y-3">

        <input 
        type="text"
        name="nama"
        placeholder="Nama"
        class="w-full px-3 py-2 rounded text-black text-sm">

        <input 
        type="email"
        name="email"
        placeholder="Email"
        class="w-full px-3 py-2 rounded text-black text-sm">

        <textarea
        name="pesan"
        placeholder="Pesan"
        rows="3"
        class="w-full px-3 py-2 rounded text-black text-sm"></textarea>

        <!-- tombol kiri -->
        <div class="text-left">
          <button 
          type="submit"
          class="bg-white text-[#8B1E1E] px-5 py-2 rounded text-sm font-semibold hover:bg-gray-200 transition">
          Kirim
          </button>
        </div>

      </form>

    </div>

    <!-- KANAN : KONTAK -->
    <div class="md:pl-10">

      <h4 class="font-semibold mb-4 text-lg">Contact Us</h4>

      <div class="space-y-3 text-sm">

        <div class="flex items-center gap-2">
          <img src="{{ asset('foto/email.png') }}" class="w-5 h-6">
          <a href="mailto:upnmengajar.jt@gmail.com" class="hover:underline">
            upnmengajar.jt@gmail.com
          </a>
        </div>

        <div class="flex items-center gap-2">
          <img src="foto/instagram.png" class="w-5 h-6">
          <a href="https://instagram.com/upnmengajar.jt" class="hover:underline">
            @upnmengajar.jt
          </a>
        </div>

        <div class="flex items-center gap-2">
          <img src="foto/whatsapp.png" class="w-5 h-6">
          <a href="https://wa.me/6289699808453" class="hover:underline">
            089699808453 (Nabila)
          </a>
        </div>

      </div>

      <!-- alamat sekre -->
      <div class="mt-8 text-sm text-gray-200 leading-relaxed">
        <p class="font-semibold mb-1">Sekretariat Kami Berada di:</p>
        <p>
          Universitas Pembangunan Nasional "Veteran" Jawa Timur
          Jl. Raya Rungkut Madya, Gunung Anyar, Surabaya, Jawa Timur
        </p>
      </div>

    </div>

  </div>

  <!-- CREDIT -->
  <div class="bg-[#6e1515] px-6 md:px-20 py-4 flex flex-col md:flex-row justify-between text-sm text-gray-200">

    <p>
      © 2026 UPN Mengajar — UKM Penalaran & Kreativitas UPN "Veteran" Jawa Timur
    </p>

    <p>
      Website by <span class="font-semibold">Vina • Naila • Inez Sistem informasi UPNVJT 2024</span>
    </p>

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

