<!doctype html>
<html lang="id">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Website UKM Penalaran</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Instrument+Serif:ital@0;1&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    
    <link rel="stylesheet" href="{{ asset('css/output.css') }}">
  </head>
  
<body>
  <header class="fixed top-0 left-0 w-full z-50 transition-all duration-300">
<div class="flex items-center justify-between px-6 py-0.5 text-white">

<div class="flex items-center">
<a href="{{ url('/') }}" class="overflow-hidden">
<img src="{{ asset('foto/logo.jpeg') }}" 
alt="Logo UPN Mengajar" 
class="w-16 scale-125">
</a>
</div>

<div class="flex items-center gap-12">

<nav>
<ul class="flex gap-12 font-poppins font-semibold">

<li>
<a href="{{ url('/') }}"
class="relative after:absolute after:right-0 after:-bottom-1 after:h-[1.5px] after:w-full after:bg-white">
Home
</a>
</li>

<li class="relative group">

<a href="{{ route('tentang.ukm') }}"
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
<a href="{{ route('tentang.ukm') }}" class="block px-5 py-2 hover:bg-gray-100">
UKM Penalaran dan Kreativitas
</a>
</li>

<li>
<a href="{{ route('tentang.upnmengajar') }}" class="block px-5 py-2 hover:bg-gray-100">
Program Kerja UPN Mengajar
</a>
</li>

<li>
<a href="{{ route('tentang.markdown.struktur') }}" class="block px-5 py-2 hover:bg-gray-100">
Tim UPN Mengajar
</a>
</li>

</ul>

</li>

<li>
<a href="{{ route('kegiatan') }}"
class="relative after:absolute after:left-0 after:-bottom-1 after:h-[1.5px] after:w-0 after:bg-white after:transition-all after:duration-300 hover:after:w-full">
Kegiatan
</a>
</li>

<li>
<a href="{{ route('relawan') }}"
class="relative after:absolute after:left-0 after:-bottom-1 after:h-[1.5px] after:w-0 after:bg-white after:transition-all after:duration-300 hover:after:w-full">
Relawan
</a>
</li>

@auth
    @if(auth()->user()->role === 'admin')
    <li>
        <a href="{{ route('admin.dashboard') }}" 
           class="relative after:absolute after:left-0 after:-bottom-1 after:h-[1.5px] after:w-0 after:bg-white after:transition-all after:duration-300 hover:after:w-full">
           Dashboard Admin
        </a>
    </li>
    @endif
@endauth

</ul>
</nav>

<div class="relative group">
  @auth
    <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="hover:text-red-400 transition-all duration-300">
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
    
    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
        @csrf
    </form>

  @else
    <a href="{{ route('login') }}" class="hover:text-gray-300 transition-all duration-300">
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
  @endauth
</div>

</div>
</div>
</header>

<section class="relative h-[530px] w-full">

  <img src="{{ asset('foto/slide1.jpg') }}"
       class="absolute inset-0 w-full h-full object-cover">

  <div class="absolute inset-0 bg-gradient-to-br from-red-800/80 via-red-600/50 to-white/60"></div>

  <div class="absolute top-28 left-6 md:left-16 lg:left-24 max-w-4xl text-white space-y-6 z-10">

    <h1 class="font-poppins font-bold text-3xl md:text-5xl leading-[1.6]">
      Menginspirasi Pendidikan,<br>
      Membangun Harapan Bagi<br> 
      Generasi Masa Depan.
    </h1>

    <p class="font-poppins italic text-base md:text-xl">
      Presented By UKM Penalaran dan Kreativitas UPNVJT
    </p>

    <div class="mt-6 flex gap-6">

      <a href="{{ route('register') }}"
      class="bg-red-700 hover:bg-red-800 text-white font-semibold px-6 py-2 md:px-10 md:py-3 rounded-full">
      Jadi Mitra Kami
      </a>

      <a href="{{ route('tentang.ukm') }}"
      class="border-2 border-white text-white font-semibold px-10 py-3 rounded-full hover:bg-white hover:text-red-700">
      Tentang Program
      </a>

    </div>

  </div>


 <div class="absolute right-24 top-[64%] -translate-y-1/2 z-20">
  <button onclick="openVideo()" 
  class="bg-white w-20 h-20 rounded-full flex items-center justify-center shadow-lg hover:scale-110 transition">

    <svg xmlns="http://www.w3.org/2000/svg"
      class="w-14 h-14 pr-2 text-red-600 ml-1"
      fill="currentColor"
      viewBox="0 0 24 24">
      <path d="M8 5v14l11-7z"/>
    </svg>

  </button>
</div>
</section>

<div id="videoModal"
class="fixed inset-0 bg-black/70 flex items-center justify-center opacity-0 pointer-events-none transition-opacity duration-300 z-50">

  <div id="videoBox"
  class="relative w-[800px] max-w-[90%] scale-90 transition-all duration-300">

    <button onclick="closeVideo()"
    class="absolute -top-10 right-0 text-white text-3xl">
      ✕
    </button>

    <iframe
      id="videoFrame"
      class="w-full h-[450px] rounded-lg"
      src="https://www.youtube.com/embed/bxPMBFV0df8"
      frameborder="0"
      allowfullscreen>
    </iframe>

  </div>

</div>

<section class="relative -mt-20 z-20 px-6 md:px-8 lg:px-20">
  
  <div class="bg-white rounded-2xl shadow-xl grid grid-cols-2 md:grid-cols-4 overflow-hidden">

<div class="flex items-center gap-4 py-4 px-6 border-r border-gray-200">

  <div class="w-12 h-12 flex items-center justify-center bg-red-100 rounded-full">
    <img src="{{ asset('foto/icon-relawan.png') }}" class="w-100 h-100">
  </div>

  <div>
    <h3 class="text-2xl md:text-3xl font-bold text-red-700 font-poppins counter" data-target="150">0</h3>
    <p class="text-gray-600 font-poppins text-sm">Relawan</p>
  </div>

</div>

<div class="flex items-center gap-4 py-4 px-6 border-r border-gray-200">

<div class="w-12 h-12 pt-2 flex items-center justify-center bg-red-100 rounded-full">
<img src="{{ asset('foto/icon-mitra.png') }}" class="w-1000 h-10000">
</div>

<div>
<h3 class="text-2xl md:text-3xl font-bold text-red-700 font-poppins counter" data-target="10">0</h3>
<p class="text-gray-600 font-poppins text-sm">Sekolah Mitra</p>
</div>

</div>

<div class="flex items-center gap-4 py-4 px-6 border-r border-gray-200">

<div class="w-12 h-12 flex items-center justify-center bg-red-100 rounded-full">
<img src="{{ asset('foto/icon-siswa.png') }}" class="w-1000 h-10000">
</div>

<div>
<h3 class="text-2xl md:text-3xl font-bold text-red-700 font-poppins counter" data-target="500">0</h3>
<p class="text-gray-600 font-poppins text-sm">Siswa Terlibat</p>
</div>

</div>

<div class="text-center py-4 px-6 bg-red-700 text-white leading-tight">
  <h3 class="text-3xl md:text-4xl font-bold font-poppins counter" data-target="5">0</h3>
  <p class="mt-1 font-poppins">Tahun Program</p>
  <a href="{{ route('register') }}" class="block mt-1 underline">Jadi Relawan →</a>
</div>

  </div>

</section>

<section class="py-20 pt-20 bg-white text-center px-6 md:px-8 lg:px-20">

<h2 class="text-3xl md:text-4xl font-bold text-red-700 font-poppins italic">
  <span id="typing"></span><span class="cursor"></span>
</h2>

  <p class="mt-3 text-gray-700 text-lg font-poppins">
    Bersama UPN Mengajar
  </p>

</section>

<section class="bg-white py-40 px-6 md:px-16 relative overflow-hidden min-h-[750px]">

<div class="absolute top-4 left-0 flex gap-16 animate-slideLeft">

<img src="{{ asset('foto/kegiatan1.jpg') }}" class="aspect-[3/4] h-96 object-cover">
<img src="{{ asset('foto/kegiatan2.jpg') }}" class="aspect-[3/4] h-96 object-cover">
<img src="{{ asset('foto/kegiatan3.jpg') }}" class="aspect-[3/4] h-96 object-cover">
<img src="{{ asset('foto/kegiatan4.jpg') }}" class="aspect-[3/4] h-96 object-cover">
<img src="{{ asset('foto/kegiatan5.jpg') }}" class="aspect-[3/4] h-96 object-cover">

<img src="{{ asset('foto/kegiatan1.jpg') }}" class="aspect-[3/4] h-96 object-cover">
<img src="{{ asset('foto/kegiatan2.jpg') }}" class="aspect-[3/4] h-96 object-cover">
<img src="{{ asset('foto/kegiatan3.jpg') }}" class="aspect-[3/4] h-96 object-cover">
<img src="{{ asset('foto/kegiatan4.jpg') }}" class="aspect-[3/4] h-96 object-cover">
<img src="{{ asset('foto/kegiatan5.jpg') }}" class="aspect-[3/4] h-96 object-cover">

</div>

<div class="absolute top-[460px] left-0 flex gap-16 animate-slideRight">

<img src="{{ asset('foto/kegiatan6.jpg') }}" class="aspect-[3/4] h-96 object-cover flex-shrink-0">
<img src="{{ asset('foto/kegiatan7.jpg') }}" class="aspect-[3/4] h-96 object-cover flex-shrink-0">
<img src="{{ asset('foto/kegiatan8.jpg') }}" class="aspect-[3/4] h-96 object-cover flex-shrink-0">
<img src="{{ asset('foto/kegiatan9.jpg') }}" class="aspect-[3/4] h-96 object-cover flex-shrink-0">

<img src="{{ asset('foto/kegiatan6.jpg') }}" class="aspect-[3/4] h-96 object-cover flex-shrink-0">
<img src="{{ asset('foto/kegiatan7.jpg') }}" class="aspect-[3/4] h-96 object-cover flex-shrink-0">
<img src="{{ asset('foto/kegiatan8.jpg') }}" class="aspect-[3/4] h-96 object-cover flex-shrink-0">
<img src="{{ asset('foto/kegiatan9.jpg') }}" class="aspect-[3/4] h-96 object-cover flex-shrink-0">

</div>


<div class="max-w-7xl mx-auto grid md:grid-cols-3 items-center relative z-10">

<div class="md:col-span-2 relative">

<div class="absolute left-0 top-0 h-full w-[88%] backdrop-blur-xl bg-white/40"></div>

<div class="relative p-12 max-w-2xl">

<div class="flex items-center gap-4 mb-8">
<span class="text-3xl font-semibold text-red-700">About</span>
<div class="h-[3px] w-20 bg-red-700"></div>
<span class="text-3xl font-semibold text-red-700">UPN Mengajar</span>
</div>

<p class="text-black mb-6 leading-relaxed text-xl">
UPN Mengajar merupakan program pengabdian masyarakat di bidang pendidikan
yang diselenggarakan oleh Bidang Pendidikan Sosial UKM Penalaran dan
Kreativitas UPN Veteran Jawa Timur.
</p>

<p class="text-black mb-6 leading-relaxed text-xl">
Program ini mendukung tujuan pembangunan berkelanjutan khususnya
<i>SDGs 4 yaitu Quality Education</i> dengan menghadirkan
kegiatan pembelajaran yang interaktif serta berbasis praktik bagi siswa.
</p>

<p class="text-black leading-relaxed text-xl">
Melalui kegiatan ini mahasiswa dapat berkontribusi kepada masyarakat
sekaligus mengembangkan kemampuan komunikasi, kepemimpinan,
serta pengalaman mengajar secara langsung.
</p>

</div>

</div>

</div>

</section>

<section class="py-16 px-6 md:px-16">

<div class="flex items-start gap-16">

<div class="relative w-1/3">

<div class="text-red-200 text-[140px] leading-none font-serif opacity-40">
❝
</div>

<div class="absolute top-20 left-8">
<p class="font-semibold text-lg text-gray-800">Dari Kak Raihan Putra,</p>
<p class="text-sm text-gray-500">Ketua Bidang Pendidikan dan Sosial 2026</p>
</div>

</div>


<div class="bg-red-800 text-white p-10 shadow-2xl max-w-3xl flex gap-8">

<img 
src="{{ asset('foto/ketua.png') }}"
class="pt-2 w-40 h-52 object-cover object-top shadow-md"
/>

<div>

<p class="leading-relaxed">
Setiap pertemuan yang kamu hadiri, setiap anak yang kamu dampingi, adalah langkah kecil menuju perubahan besar. 
Perubahan besar selalu dimulai dari langkah sederhana. Seperti yang dikatakan oleh Malala Yousafzai,
<i>“One child, one teacher, one book, and one pen can change the world.”</i>
</p>

<p class="mt-4">
So, this is your time. Step forward, take the challenge, and be part of 
<b>UPN Mengajar</b>. Let’s create impact, inspire minds, and build a better future.
</p>

</div>

</div>

</div>

</section>


<section class="relative pt-16 pb-20 overflow-hidden">
  <div class="absolute inset-0 w-screen h-full left-0 top-0">
    <video autoplay muted loop playsinline
           class="w-full h-full object-cover filter grayscale z-0">
      <source src="{{ asset('video/background.mp4') }}" type="video/mp4">
      Your browser does not support the video tag.
    </video>
    <div class="absolute inset-0 bg-black/60 z-0"></div>
  </div>

  <div class="relative max-w-5xl mx-auto px-1 z-10">
    <h2 class="text-3xl font-bold mb-2 text-white text-center">
      Riwayat Kegiatan UPN Mengajar
    </h2>
    <p class="text-sm text-white/80 mb-10 text-center">
      Documentation kegiatan mahasiswa yang berkontribusi bagi pendidikan di berbagai sekolah
    </p>

    <div class="flex flex-col md:flex-row h-auto md:h-[420px] gap-6 md:gap-x-4">
      <div class="group relative flex-1 transition-all duration-500 hover:flex-[3] cursor-pointer rounded-2xl overflow-hidden h-64 md:h-auto">
        <img src="{{ asset('foto/foto1.jpg') }}" class="absolute w-full h-full object-cover rounded-2xl">
        <div class="absolute inset-0 bg-black/30 rounded-2xl"></div> <div class="absolute bottom-4 left-4 right-4 text-left text-white transition-all">
          <h3 class="text-lg font-semibold">UPN Mengajar Jilid XI</h3>
          <p class="text-sm">Pengabdian mahasiswa di sekolah dasar.</p>
          <span class="text-sm font-semibold">Baca Selengkapnya →</span>
        </div>
      </div>

      <div class="group relative flex-1 transition-all duration-500 hover:flex-[3] cursor-pointer rounded-2xl overflow-hidden h-64 md:h-auto">
        <img src="{{ asset('foto/foto2.jpg') }}" class="absolute w-full h-full object-cover rounded-2xl">
        <div class="absolute inset-0 bg-black/30 rounded-2xl"></div>
        <div class="absolute bottom-4 left-4 right-4 text-left text-white transition-all">
          <h3 class="text-lg font-semibold">Workshop Literasi</h3>
          <p class="text-sm">Pelatihan literasi digital bagi pelajar.</p>
          <span class="text-sm font-semibold">Baca Selengkapnya →</span>
        </div>
      </div>

      <div class="group relative flex-1 transition-all duration-500 hover:flex-[3] cursor-pointer rounded-2xl overflow-hidden h-64 md:h-auto">
        <img src="{{ asset('foto/foto3.jpg') }}" class="absolute w-full h-full object-cover rounded-2xl">
        <div class="absolute inset-0 bg-black/30 rounded-2xl"></div>
        <div class="absolute bottom-4 left-4 right-4 text-left text-white transition-all">
          <h3 class="text-lg font-semibold">Seminar Pendidikan</h3>
          <p class="text-sm">Diskusi inovasi pendidikan bersama mahasiswa.</p>
          <span class="text-sm font-semibold">Baca Selengkapnya →</span>
        </div>
      </div>

      <div class="group relative flex-1 transition-all duration-500 hover:flex-[3] cursor-pointer rounded-2xl overflow-hidden h-64 md:h-auto">
        <img src="{{ asset('foto/foto4.jpg') }}" class="absolute w-full h-full object-cover rounded-2xl">
        <div class="absolute inset-0 bg-black/30 rounded-2xl"></div>
        <div class="absolute bottom-4 left-4 right-4 text-left text-white transition-all">
          <h3 class="text-lg font-semibold">Kelas Inspirasi</h3>
          <p class="text-sm">Mahasiswa berbagi pengalaman belajar.</p>
          <span class="text-sm font-semibold">Baca Selengkapnya →</span>
        </div>
      </div>

      <div class="group relative flex-1 transition-all duration-500 hover:flex-[3] cursor-pointer rounded-2xl overflow-hidden h-64 md:h-auto">
        <img src="{{ asset('foto/foto5.jpg') }}" class="absolute w-full h-full object-cover rounded-2xl">
        <div class="absolute inset-0 bg-black/30 rounded-2xl"></div>
        <div class="absolute bottom-4 left-4 right-4 text-left text-white transition-all">
          <h3 class="text-lg font-semibold">Pelatihan Guru</h3>
          <p class="text-sm">Pengembangan metode mengajar kreatif.</p>
          <span class="text-sm font-semibold">Baca Selengkapnya →</span>
        </div>
      </div>
    </div>
  </div>
</section>

<section class="bg-white py-24 px-6 md:px-20 relative min-h-[900px]">

  <div class="text-center mb-20">
    <h2 class="text-4xl md:text-5xl font-semibold">
      What They Said About <span class="italic">UPN Mengajar</span>
    </h2>
  </div>

  <div class="relative max-w-6xl mx-auto">

    <div class="absolute left-10 top-0 rotate-[-6deg] bg-[#ffb2b2] shadow-xl p-6 w-64">
      <p class="text-sm">
        "Di sela matkul yang padat justru kegiatan upnm ini menjadi heal akuu dan jadi kegiatan yang 
        paling aku tunggu tunggu untuk berkontribusi lebih lagi bagi generasi yang lebih muda.
        Pengalaman ini bukan cuma soal mengajar, tapi suatu kehangatan, dan kebersamaan, 
        dan rasa berarti saat ketemu adik adik."
      </p>
      <p class="mt-3 text-xs font-semibold">— Kak Fitalia</p>
    </div>

    <div class="absolute right-10 top-20 rotate-[6deg] bg-lime-200 shadow-lg p-5 w-56">
      <p class="text-sm">
        "Anak-anaknya sangat antusias belajar.
        Rasanya semua usaha terbayar!"
      </p>
      <p class="text-xs mt-2 font-semibold">— Relawan</p>
    </div>

    <div class="absolute left-1/3 ml-10 top-80 rotate-[3deg] bg-[#ffecbd] shadow-xl p-6 w-64">
      <p class="text-sm">
        "setiap pertemuan selalu ada cerita baru, momen lucu, dan hal-hal kecil lain yang ternyata 
        bisa bikin aku belajar banyak hal. di sini aku engga cuma belajar cara mengajar, 
        tapi juga belajar sabar, komunikasi, teamwork, dan makna berbagi yang sesungguhnya."
      </p>
      <p class="mt-3 text-xs font-semibold">— Kak Fitria</p>
    </div>

<div class="absolute left-[500px] top-10 rotate-[-7deg] w-60">
  <img src="{{ asset('foto/note1.jpg') }}"
  class="shadow-xl hover:scale-125 transition duration-300">
</div>

    <div class="absolute left-0 top-80 bottom-2 rotate-[-10deg] shadow-xl w-60">
  <img src="{{ asset('foto/note2.jpg') }}" 
  class="shadow-xl hover:scale-125 transition duration-300">
</div>

<div class="absolute right-0 top-[270px] rotate-[7deg] shadow-xl w-64">
  <img src="{{ asset('foto/note3.jpg') }}"
  class="shadow-xl hover:scale-125 transition duration-300">
</div>
  </div>

</section>

<footer class="bg-[#8B1E1E] text-white pt-16">

  <div class="max-w-7xl mx-auto px-6 md:px-20 grid md:grid-cols-3 gap-10 pb-10">

    <div class="md:border-r md:border-red-300 md:pr-10">

      <div class="w-24 h-24 overflow-hidden mb-5">
        <img src="{{ asset('foto/logo.jpeg') }}" class="w-full h-full object-cover scale-150">
      </div>

      <h4 class="font-semibold mb-3 text-lg">Menu</h4>
      <ul class="space-y-2 text-sm">
        <li><a href="{{ url('/') }}" class="hover:underline">Home</a></li>
        <li><a href="{{ route('tentang.ukm') }}" class="hover:underline">Tentang</a></li>
        <li><a href="{{ route('kegiatan') }}" class="hover:underline">Kegiatan</a></li>
        <li><a href="{{ route('relawan') }}" class="hover:underline">Relawan</a></li>
      </ul>

    </div>

    <div class="text-center md:border-r md:border-red-300 md:px-10">

      <h4 class="font-semibold mb-2 text-lg">Send Message</h4>

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

        <div class="text-left">
          <button 
          type="submit"
          class="bg-white text-[#8B1E1E] px-5 py-2 rounded text-sm font-semibold hover:bg-gray-200 transition">
          Kirim
          </button>
        </div>

      </form>

    </div>

    <div class="md:pl-10">

      <h4 class="font-semibold mb-4 text-lg">Contact Us</h4>

      <div class="space-y-3 text-sm">

        <div class="flex items-center gap-2">
          <img src="{{ asset('foto/Untitled design (17).png') }}" class="w-5 h-6">
          <a href="mailto:upnmengajar.jt@gmail.com" class="hover:underline">
             upnmengajar.jt@gmail.com
          </a>
        </div>

        <div class="flex items-center gap-2">
          <img src="{{ asset('foto/instagram.png') }}" class="w-5 h-6">
          <a href="https://instagram.com/upnmengajar.jt" class="hover:underline">
             @upnmengajar.jt
          </a>
        </div>

        <div class="flex items-center gap-2">
          <img src="{{ asset('foto/whatsapp.png') }}" class="w-5 h-6">
          <a href="https://wa.me/6289699808453" class="hover:underline">
             089699808453 (Nabila)
          </a>
        </div>

      </div>

      <div class="mt-8 text-sm text-gray-200 leading-relaxed">
        <p class="font-semibold mb-1">Sekretariat Kami Berada di:</p>
        <p>
          Universitas Pembangunan Nasional "Veteran" Jawa Timur
          Jl. Raya Rungkut Madya, Gunung Anyar, Surabaya, Jawa Timur
        </p>
      </div>

    </div>

  </div>

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

<script>
const counters = document.querySelectorAll('.counter');

counters.forEach(counter => {
  counter.innerText = '0';

  const updateCounter = () => {
    const target = +counter.getAttribute('data-target');
    const current = +counter.innerText;

    const increment = target / 100;

    if(current < target){
      counter.innerText = Math.ceil(current + increment);
      setTimeout(updateCounter, 20);
    } else {
      counter.innerText = target + "+";
    }
  };

  updateCounter();
});
</script>

<script>
function openVideo() {
  const modal = document.getElementById("videoModal");
  const box = document.getElementById("videoBox");

  modal.classList.remove("opacity-0","pointer-events-none");
  box.classList.remove("translate-y-10");

  document.getElementById("videoFrame").src =
  "https://www.youtube.com/embed/bxPMBFV0df8";
}

function closeVideo() {
  const modal = document.getElementById("videoModal");
  const box = document.getElementById("videoBox");

  modal.classList.add("opacity-0","pointer-events-none");
  box.classList.add("translate-y-10");

  document.getElementById("videoFrame").src = "";
}
</script>

<script>
const images = [
"foto/kegiatan2.jpg",
"foto/kegiatan3.jpg",
"foto/kegiatan4.jpg"
];

let index = 0;
const slider = document.getElementById("sliderImage");

setInterval(() => {
  if(slider) {
    index = (index + 1) % images.length;
    slider.src = images[index];
  }
}, 3000);
</script>

<script>
function openCard(card){
  document.querySelectorAll('.activity-card').forEach(c=>{
    c.classList.remove('col-span-2','md:col-span-4')
    c.querySelector('.desc').classList.add('hidden')
  })

  card.classList.add('col-span-2','md:col-span-4')
  card.querySelector('.desc').classList.remove('hidden')
}
</script>

<script>
const text = "Bersatu, Berjuang, Mencerdaskan Bangsa";
const typingElement = document.getElementById("typing");

let i = 0;

function typeWriter(){
  if(i < text.length){
    typingElement.innerHTML += text.charAt(i);

    let delay = Math.random() * 120 + 80;

    if(text.charAt(i) === ","){
      delay = 400;
    }

    i++;
    setTimeout(typeWriter, delay);
  }
}

const observer = new IntersectionObserver(entries=>{
  entries.forEach(entry=>{
    if(entry.isIntersecting){
      typeWriter();
      observer.disconnect();
    }
  });
});

observer.observe(typingElement);
</script>

  </body>
</html>