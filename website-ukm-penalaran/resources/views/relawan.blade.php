<!doctype html>
<html lang="id">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Relawan - UPN Mengajar</title>

    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Instrument+Serif:ital@0;1&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet" />

    <!-- Menggunakan Vite asset loader bawaan Laravel -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
  </head>

  <body class="bg-gray-50 font-poppins">
    <!-- HEADER / NAVBAR -->
    <header class="fixed top-0 left-0 w-full z-50 transition-all duration-300">
      <div class="flex items-center justify-between px-6 py-0.5 text-white">
        <div class="flex items-center">
          <a href="/beranda" class="overflow-hidden">
            <img src="{{ asset('foto/logo.jpeg') }}" alt="Logo UPN Mengajar" class="w-16 scale-125">
          </a>
        </div>

        <div class="flex items-center gap-12">
          <nav>
            <ul class="flex gap-12 font-poppins font-semibold">
              <li>
                <a href="/beranda" class="relative after:absolute after:left-0 after:-bottom-1 after:h-[1.5px] after:w-0 after:bg-white after:transition-all after:duration-300 hover:after:w-full">Home</a>
              </li>

              <li class="relative group">
                <a href="/tentang" class="flex items-center gap-1 relative after:absolute after:left-0 after:-bottom-1 after:h-[1.5px] after:w-0 after:bg-white after:transition-all after:duration-300 hover:after:w-full">
                  Tentang
                  <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 transition-transform duration-200 group-hover:rotate-180" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                  </svg>
                </a>

                <ul class="absolute left-0 mt-3 w-max bg-white text-gray-600 text-sm shadow-md opacity-0 invisible -translate-y-2 group-hover:opacity-100 group-hover:visible group-hover:translate-y-0 transition-all duration-300 ease-out">
                  <li><a href="/ukm" class="block px-5 py-2 hover:bg-gray-100">UKM Penalaran dan Kreativitas</a></li>
                  <li><a href="/upnmengajar" class="block px-5 py-2 hover:bg-gray-100">Program Kerja UPN Mengajar</a></li>
                  <li><a href="/struktur" class="block px-5 py-2 hover:bg-gray-100">Tim UPN Mengajar</a></li>
                </ul>
              </li>

              <li>
                <a href="/kegiatan" class="relative after:absolute after:left-0 after:-bottom-1 after:h-[1.5px] after:w-0 after:bg-white after:transition-all after:duration-300 hover:after:w-full">Kegiatan</a>
              </li>

              <li>
                <a href="{{ route('relawan.index') }}" class="relative after:absolute after:right-0 after:-bottom-1 after:h-[1.5px] after:w-full after:bg-white">Relawan</a>
              </li>

              @auth
                @if(auth()->user()->role === 'admin')
                  <li>
                    <a href="/dashboard-admin" class="relative after:absolute after:left-0 after:-bottom-1 after:h-[1.5px] after:w-0 after:bg-white after:transition-all after:duration-300 hover:after:w-full">Dashboard Admin</a>
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
              <form id="logout-form" action="/logout" method="POST" class="hidden">
                @csrf
              </form>
              <div class="absolute -bottom-12 left-1/2 -translate-x-1/2 bg-black/80 backdrop-blur-sm text-white text-[11px] px-4 py-2 opacity-0 group-hover:opacity-100 transition-all duration-300 whitespace-nowrap rounded-lg shadow-2xl border border-white/10">
                Keluar
              </div>
            @endauth

            @guest
              <a href="/login" class="hover:text-gray-300 transition-all duration-300">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A9 9 0 1118.879 17.804M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                </svg>
              </a>
              <div class="absolute -bottom-12 left-1/2 -translate-x-1/2 bg-black/80 backdrop-blur-sm text-white text-[11px] px-4 py-2 opacity-0 group-hover:opacity-100 transition-all duration-300 whitespace-nowrap rounded-lg shadow-2xl border border-white/10">
                Masuk / Daftar
              </div>
            @endguest
          </div>
        </div>
      </div>
    </header>

    <!-- MAIN CONTENT -->
    <main class="pt-[140px] md:pt-[160px]">
      <section class="relative overflow-hidden bg-gradient-to-br from-white via-[#fff4f4] to-[#ffe1e1]">
        <div class="absolute inset-0 -z-10">
          <div class="absolute top-[-100px] left-[-80px] w-[320px] h-[320px] bg-red-200/40 rounded-full blur-3xl"></div>
          <div class="absolute top-[40px] right-[-100px] w-[380px] h-[380px] bg-rose-200/30 rounded-full blur-3xl"></div>
          <div class="absolute bottom-[-120px] left-[25%] w-[420px] h-[420px] bg-orange-100/30 rounded-full blur-3xl"></div>
        </div>

        <div class="absolute inset-0 -z-10 opacity-[0.05]">
          <div class="w-full h-full bg-[radial-gradient(#8B1E1E_1px,transparent_1px)] [background-size:26px_26px]"></div>
        </div>

        <!-- Bagian Alert Notifikasi / Pesan Error dari Controller -->
        @if(session('error'))
          <div class="max-w-7xl mx-auto mt-4 px-6">
            <div class="max-w-4xl px-4 py-3 bg-red-100 border border-red-400 text-red-700 rounded-lg relative shadow-sm flex items-center gap-2" role="alert">
              <span class="font-medium">⚠️ {{ session('error') }}</span>
            </div>
          </div>
        @endif

        <!-- Jumbotron Title -->
        <section class="px-6 md:px-20 pb-10 pt-6 bg-transparent">
          <div class="max-w-4xl">
            <span class="inline-block px-5 py-2 rounded-full bg-red-100 text-[#8B1E1E] text-sm font-semibold shadow-sm">
              Program Relawan
            </span>
            <h1 class="mt-4 text-4xl md:text-6xl font-bold text-[#8B1E1E] leading-tight">
              Pilih Program Mengajar yang Paling Cocok Untukmu
            </h1>
            <p class="mt-5 text-gray-700 text-sm md:text-xl leading-relaxed max-w-3xl">
              Bergabunglah sebagai relawan UPN Mengajar dan ambil peran dalam menciptakan pengalaman belajar yang bermakna bagi anak-anak di berbagai lingkungan pendidikan.
            </p>
          </div>
        </section>

        <!-- List Program Cards -->
        <section class="px-6 md:px-20 pb-20 bg-transparent">
          <div class="grid gap-10">
            
            <!-- 1. PROGRAM SEKOLAH DASAR (SD) -->
            <div class="bg-white/90 backdrop-blur-md rounded-2xl shadow-md hover:shadow-xl transition duration-300 p-6 md:p-10 grid md:grid-cols-2 gap-10 items-stretch">
              <div class="w-full h-72 md:h-[420px] overflow-hidden rounded-2xl">
                <img src="{{ asset('foto/sd.jpg') }}" alt="Program Sekolah Dasar" class="w-full h-full object-cover hover:scale-105 transition duration-500" />
              </div>
              <div class="flex flex-col justify-between max-w-2xl pt-1">
                <div class="space-y-6">
                  <h2 class="text-3xl font-bold text-[#8B1E1E]">Sekolah Dasar</h2>
                  
                  <!-- Status Ketersediaan Kegiatan -->
                  @if($sd->id_kegiatan !== '0')
                    <span class="inline-block text-xs bg-green-100 text-green-800 px-3 py-1 rounded-full font-semibold">
                      🟢 Pendaftaran Dibuka: {{ $sd->nama_kegiatan }}
                    </span>
                  @else
                    <span class="inline-block text-xs bg-amber-100 text-amber-700 px-3 py-1 rounded-full font-semibold">
                      🟡 Pendaftaran Belum Tersedia
                    </span>
                  @endif

                  <p class="text-gray-600 leading-relaxed text-sm md:text-base text-justify">
                    Program Sekolah Dasar dalam UPN Mengajar mengajak relawan untuk berkontribusi langsung dalam meningkatkan kualitas pendidikan dasar di Indonesia. Fokus utama kegiatan ini adalah penguatan literasi dan numerasi siswa melalui pendekatan belajar yang menyenangkan.
                  </p>
                  <div class="flex flex-col md:flex-row md:gap-20 gap-6 text-sm mt-2">
                    <ul class="text-gray-600 space-y-2 flex-1">
                      <li class="flex items-start gap-2 italic"><span class="text-red-700">•</span> Mengajar membaca & menulis</li>
                      <li class="flex items-start gap-2 italic"><span class="text-red-700">•</span> Matematika dasar</li>
                      <li class="flex items-start gap-2 italic"><span class="text-red-700">•</span> Kegiatan kreatif</li>
                    </ul>
                    <div class="text-gray-700 space-y-2 flex-1 border-l-0 md:border-l md:pl-8 border-gray-100">
                      <p><span class="text-red-700 font-bold uppercase text-[10px] tracking-widest block">Metode</span><span class="text-gray-600">Interaktif</span></p>
                      <p><span class="text-red-700 font-bold uppercase text-[10px] tracking-widest block mt-3">Durasi</span><span class="text-gray-600">4 Jam</span></p>
                      <p><span class="text-red-700 font-bold uppercase text-[10px] tracking-widest block mt-3">Kebutuhan</span><span class="text-gray-600">3–5 Relawan</span></p>
                    </div>
                  </div>
                </div>
                
                <!-- Tombol Kondisional -->
                <div class="pt-6">
                  @if($sd->id_kegiatan !== '0')
                    <a href="/relawan-sd?id={{ $sd->id_kegiatan }}" class="inline-block bg-[#8B1E1E] text-white px-10 py-3 rounded-full hover:bg-red-900 transition-all shadow-md hover:shadow-lg active:scale-95 font-bold text-center">
                      Pilih Program
                    </a>
                  @else
                    <button disabled class="inline-block bg-gray-200 text-gray-400 px-10 py-3 rounded-full font-bold text-center cursor-not-allowed shadow-none border border-gray-300">
                      Belum Tersedia
                    </button>
                  @endif
                </div>
              </div>
            </div>

            <!-- 2. PROGRAM SEKOLAH LUAR BIASA (SLB) -->
            <div class="bg-white/90 backdrop-blur-md rounded-2xl shadow-md hover:shadow-xl transition duration-300 p-6 md:p-10 grid md:grid-cols-2 gap-10 items-stretch">
              <div class="w-full h-72 md:h-[420px] overflow-hidden rounded-2xl">
                <img src="{{ asset('foto/slb.jpg') }}" alt="Program Sekolah Luar Biasa" class="w-full h-full object-cover hover:scale-105 transition duration-500" />
              </div>
              <div class="flex flex-col justify-between max-w-2xl pt-1">
                <div class="space-y-6">
                  <h2 class="text-3xl font-bold text-[#8B1E1E]">Sekolah Luar Biasa</h2>
                  
                  <!-- Status Ketersediaan Kegiatan -->
                  @if($slb->id_kegiatan !== '0')
                    <span class="inline-block text-xs bg-green-100 text-green-800 px-3 py-1 rounded-full font-semibold">
                      🟢 Pendaftaran Dibuka: {{ $slb->nama_kegiatan }}
                    </span>
                  @else
                    <span class="inline-block text-xs bg-amber-100 text-amber-700 px-3 py-1 rounded-full font-semibold">
                      🟡 Pendaftaran Belum Tersedia
                    </span>
                  @endif

                  <p class="text-gray-600 leading-relaxed text-sm md:text-base text-justify">
                    Program ini berfokus pada pendampingan siswa berkebutuhan khusus dengan pendekatan inklusif, empatik, dan adaptif untuk memastikan setiap anak mendapatkan hak pendidikan yang setara.
                  </p>
                  <div class="flex flex-col md:flex-row md:gap-20 gap-6 text-sm mt-2">
                    <ul class="text-gray-600 space-y-2 flex-1">
                      <li class="flex items-start gap-2 italic"><span class="text-red-700">•</span> Pendampingan khusus</li>
                      <li class="flex items-start gap-2 italic"><span class="text-red-700">•</span> Metode adaptif</li>
                      <li class="flex items-start gap-2 italic"><span class="text-red-700">•</span> Komunikasi & empati</li>
                    </ul>
                    <div class="text-gray-700 space-y-2 flex-1 border-l-0 md:border-l md:pl-8 border-gray-100">
                      <p><span class="text-red-700 font-bold uppercase text-[10px] tracking-widest block">Metode</span><span class="text-gray-600">Inklusif & Adaptif</span></p>
                      <p><span class="text-red-700 font-bold uppercase text-[10px] tracking-widest block mt-3">Durasi</span><span class="text-gray-600">4 Jam</span></p>
                      <p><span class="text-red-700 font-bold uppercase text-[10px] tracking-widest block mt-3">Kebutuhan</span><span class="text-gray-600">2–3 Relawan</span></p>
                    </div>
                  </div>
                </div>
                
                <!-- Tombol Kondisional -->
                <div class="pt-6">
                  @if($slb->id_kegiatan !== '0')
                    <a href="/relawan-slb?id={{ $slb->id_kegiatan }}" class="inline-block bg-[#8B1E1E] text-white px-10 py-3 rounded-full hover:bg-red-900 transition-all shadow-md hover:shadow-lg active:scale-95 font-bold text-center">
                      Pilih Program
                    </a>
                  @else
                    <button disabled class="inline-block bg-gray-200 text-gray-400 px-10 py-3 rounded-full font-bold text-center cursor-not-allowed shadow-none border border-gray-300">
                      Belum Tersedia
                    </button>
                  @endif
                </div>
              </div>
            </div>

            <!-- 3. PROGRAM YAYASAN & KOMUNITAS -->
            <div class="bg-white/90 backdrop-blur-md rounded-2xl shadow-md hover:shadow-xl transition duration-300 p-6 md:p-10 grid md:grid-cols-2 gap-10 items-stretch">
              <div class="w-full h-72 md:h-[420px] overflow-hidden rounded-2xl">
                <img src="{{ asset('foto/yayasan.jpg') }}" alt="Program Yayasan dan Komunitas" class="w-full h-full object-cover hover:scale-105 transition duration-500" />
              </div>
              <div class="flex flex-col justify-between max-w-2xl pt-1">
                <div class="space-y-6">
                  <h2 class="text-3xl font-bold text-[#8B1E1E]">Yayasan & Komunitas</h2>
                  
                  <!-- Status Ketersediaan Kegiatan -->
                  @if($yayasan->id_kegiatan !== '0')
                    <span class="inline-block text-xs bg-green-100 text-green-800 px-3 py-1 rounded-full font-semibold">
                      🟢 Pendaftaran Dibuka: {{ $yayasan->nama_kegiatan }}
                    </span>
                  @else
                    <span class="inline-block text-xs bg-amber-100 text-amber-700 px-3 py-1 rounded-full font-semibold">
                      🟡 Pendaftaran Belum Tersedia
                    </span>
                  @endif

                  <p class="text-gray-600 leading-relaxed text-sm md:text-base text-justify">
                    Program ini memberikan pengalaman mengajar dalam lingkungan komunitas dengan pendekatan santai namun tetap bermakna.
                  </p>
                  <div class="flex flex-col md:flex-row md:gap-20 gap-6 text-sm mt-2">
                    <ul class="text-gray-600 space-y-2 flex-1">
                      <li class="flex items-start gap-2 italic"><span class="text-red-700">•</span> Edukasi informal</li>
                      <li class="flex items-start gap-2 italic"><span class="text-red-700">•</span> Aktivitas kreatif</li>
                      <li class="flex items-start gap-2 italic"><span class="text-red-700">•</span> Motivasi anak</li>
                    </ul>
                    <div class="text-gray-700 space-y-2 flex-1 border-l-0 md:border-l md:pl-8 border-gray-100">
                      <p><span class="text-red-700 font-bold uppercase text-[10px] tracking-widest block">Metode</span><span class="text-gray-600">Santai & Bermakna</span></p>
                      <p><span class="text-red-700 font-bold uppercase text-[10px] tracking-widest block mt-3">Durasi</span><span class="text-gray-600">4 Jam</span></p>
                      <p><span class="text-red-700 font-bold uppercase text-[10px] tracking-widest block mt-3">Kebutuhan</span><span class="text-gray-600">3–4 Relawan</span></p>
                    </div>
                  </div>
                </div>
                
                <!-- Tombol Kondisional -->
                <div class="pt-6">
                  @if($yayasan->id_kegiatan !== '0')
                    <a href="/relawan-yayasan?id={{ $yayasan->id_kegiatan }}" class="inline-block bg-[#8B1E1E] text-white px-10 py-3 rounded-full hover:bg-red-900 transition-all shadow-md hover:shadow-lg active:scale-95 font-bold text-center">
                      Pilih Program
                    </a>
                  @else
                    <button disabled class="inline-block bg-gray-200 text-gray-400 px-10 py-3 rounded-full font-bold text-center cursor-not-allowed shadow-none border border-gray-300">
                      Belum Tersedia
                    </button>
                  @endif
                </div>
              </div>
            </div>

          </div>
        </section>
      </section>
    </main>

    <!-- FOOTER -->
    <footer class="w-full bg-[#8B1E1E] text-white pt-16">
      <div class="max-w-7xl mx-auto px-6 md:px-20 grid md:grid-cols-3 gap-10 pb-10">
        <div class="md:border-r md:border-red-300 md:pr-10">
          <div class="w-24 h-24 overflow-hidden mb-5">
            <img src="{{ asset('foto/logo.jpeg') }}" alt="Logo UPN Mengajar" class="w-full h-full object-cover scale-150" />
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
          <p class="text-xs text-gray-200 mb-4">Pesan akan dikirim ke email UPN Mengajar</p>
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
              <img src="{{ asset('foto/Untitled design (17).png') }}" alt="Email" class="w-5 h-6" />
              <a href="mailto:upnmengajar.jt@gmail.com" class="hover:underline">upnmengajar.jt@gmail.com</a>
            </div>
            <div class="flex items-center gap-2">
              <img src="{{ asset('foto/instagram.png') }}" alt="Instagram" class="w-5 h-6" />
              <a href="https://instagram.com/upnmengajar.jt" class="hover:underline">@upnmengajar.jt</a>
            </div>
            <div class="flex items-center gap-2">
              <img src="{{ asset('foto/whatsapp.png') }}" alt="WhatsApp" class="w-5 h-6" />
              <a href="https://wa.me/6289699808453" class="hover:underline">089699808453 (Nabila)</a>
            </div>
          </div>
          <div class="mt-8 text-sm text-gray-200 leading-relaxed">
            <p class="font-semibold mb-1">Sekretariat Kami Berada di:</p>
            <p>Universitas Pembangunan Nasional "Veteran" Jawa Timur Jl. Raya Rungkut Madya, Gunung Anyar, Surabaya, Jawa Timur</p>
          </div>
        </div>
      </div>

      <div class="bg-[#6e1515] px-6 md:px-20 py-4 flex flex-col md:flex-row justify-between text-sm text-gray-200">
        <p>© 2026 UPN Mengajar — UKM Penalaran & Kreativitas UPN "Veteran" Jawa Timur</p>
        <p>Website by <span class="font-semibold">Vina • Naila • Inez Sistem Informasi UPNVJT 2024</span></p>
      </div>
    </footer>

    <!-- NAVBAR SCRIPTS -->
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