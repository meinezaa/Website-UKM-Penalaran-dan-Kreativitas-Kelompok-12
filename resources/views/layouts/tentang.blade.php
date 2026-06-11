<!doctype html>
<html lang="id">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Website UKM Penalaran</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Instrument+Serif:ital@0;1&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    
    <link rel="stylesheet" href="{{ asset('dist/output.css') }}">
  </head>
  
<body>
  <header class="fixed top-0 left-0 w-full z-50 transition-all duration-300">
    <div class="flex items-center justify-between px-6 py-0.5 text-white">

      <div class="flex items-center">
        <a href="/" class="overflow-hidden">
          <img src="{{ asset('foto/logo.jpeg') }}" alt="Logo UPN Mengajar" class="w-16 scale-125">
        </a>
      </div>

      <div class="flex items-center gap-12">

        <nav>
          <ul class="flex gap-12 font-poppins font-semibold">

            <li>
              <a href="{{ url('/') }}"
                class="relative {{ request()->is('/') ? 'after:w-full' : 'after:w-0' }} after:absolute after:left-0 after:-bottom-1 after:h-[1.5px] after:bg-white after:transition-all after:duration-300 hover:after:w-full">
                Home
              </a>
            </li>

            <li class="relative group">
              <a href="#"
                class="flex items-center gap-1 relative after:absolute after:left-0 after:-bottom-1 after:h-[1.5px] after:w-0 after:bg-white after:transition-all after:duration-300 hover:after:w-full">
                Tentang
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 transition-transform duration-200 group-hover:rotate-180" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                </svg>
              </a>

              <ul class="absolute left-0 mt-3 w-max bg-white text-gray-600 text-sm shadow-md opacity-0 invisible -translate-y-2 group-hover:opacity-100 group-hover:visible group-hover:translate-y-0 transition-all duration-300 ease-out">
                <li>
    <a href="{{ url('/tentang') }}"
       class="block px-5 py-2 hover:bg-gray-100">
        UKM Penalaran dan Kreativitas
    </a>
</li>
                <li>
                  <a href="{{ url('/upnmengajar') }}" class="block px-5 py-2 hover:bg-gray-100">
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

            <li>
              <a href="{{ url('/kegiatan') }}"
                class="relative {{ request()->is('kegiatan*') ? 'after:w-full' : 'after:w-0' }} after:absolute after:left-0 after:-bottom-1 after:h-[1.5px] after:bg-white after:transition-all after:duration-300 hover:after:w-full">
                Kegiatan
              </a>
            </li>

            <li>
              <li>
  <a href="{{ url('/relawan') }}"
    class="relative {{ request()->is('relawan*') ? 'after:w-full' : 'after:w-0' }}">
    Relawan
  </a>
</li>
            </li>

            @if(session('role') === 'admin')
            <li>
              <a href="{{ route('admin.dashboard') }}" class="relative after:absolute after:left-0 after:-bottom-1 after:h-[1.5px] after:w-0 after:bg-white after:transition-all after:duration-300 hover:after:w-full">
                Dashboard Admin
              </a>
            </li>
            @endif

          </ul>
        </nav>

        <div class="relative group">
          @if (session('id_user'))
            <a href="#" class="hover:text-red-400 transition-all duration-300">
              <svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
              </svg>
            </a>
            <div class="absolute -bottom-12 left-1/2 -translate-x-1/2 bg-black/80 backdrop-blur-sm text-white text-[11px] px-4 py-2 opacity-0 group-hover:opacity-100 transition-all duration-300 whitespace-nowrap rounded-lg shadow-2xl border border-white/10">
              Keluar
            </div>
          @else
            <a href="{{ url('/login') }}" class="hover:text-gray-300 transition-all duration-300">
              <svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A9 9 0 1118.879 17.804M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
              </svg>
            </a>
            <div class="absolute -bottom-12 left-1/2 -translate-x-1/2 bg-black/80 backdrop-blur-sm text-white text-[11px] px-4 py-2 opacity-0 group-hover:opacity-100 transition-all duration-300 whitespace-nowrap rounded-lg shadow-2xl border border-white/10">
              Masuk / Daftar
            </div>
          @endif
        </div>

      </div>
    </div>
  </header>

  <section class="pt-40 pb-24 bg-gradient-to-r from-red-900 to-red-700 text-white">
    <div class="max-w-7xl mx-auto px-6">
      <h1 class="text-5xl md:text-6xl font-bold mb-6">
        Tentang UPN Mengajar
      </h1>
      <p class="text-lg md:text-xl max-w-3xl leading-relaxed">
        Program pengabdian masyarakat yang diselenggarakan oleh
        UKM Penalaran dan Kreativitas UPN Veteran Jawa Timur
        untuk mendukung peningkatan kualitas pendidikan melalui
        keterlibatan aktif mahasiswa sebagai relawan pengajar.
      </p>
    </div>
  </section>

  <section class="py-24 bg-white">
    <div class="max-w-7xl mx-auto px-6">
      <div class="grid md:grid-cols-2 gap-16 items-center">
        <div>
          <img src="{{ asset('foto/kegiatan1.jpg') }}" alt="UPN Mengajar" class="rounded-3xl shadow-xl w-full">
        </div>
        <div>
          <h2 class="text-4xl font-bold text-red-800 mb-6">
            Apa Itu UPN Mengajar?
          </h2>
          <p class="text-gray-700 leading-relaxed mb-5">
            UPN Mengajar merupakan program pengabdian masyarakat
            di bidang pendidikan yang dijalankan oleh UKM
            Penalaran dan Kreativitas Universitas Pembangunan
            Nasional "Veteran" Jawa Timur.
          </p>
          <p class="text-gray-700 leading-relaxed mb-5">
            Program ini bertujuan untuk meningkatkan kualitas
            pendidikan melalui kegiatan pembelajaran yang
            interaktif, kreatif, dan menyenangkan bagi siswa.
          </p>
          <p class="text-gray-700 leading-relaxed">
            Mahasiswa berperan sebagai relawan yang membantu
            proses belajar mengajar sekaligus mengembangkan
            kemampuan kepemimpinan, komunikasi, dan pengabdian
            kepada masyarakat.
          </p>
        </div>
      </div>
    </div>
  </section>

  <section class="py-24 bg-gray-50">
    <div class="max-w-7xl mx-auto px-6">
      <h2 class="text-4xl font-bold text-center text-red-800 mb-16">
        Visi dan Misi
      </h2>
      <div class="grid md:grid-cols-2 gap-10">
        <div class="bg-white p-10 rounded-3xl shadow-lg">
          <h3 class="text-2xl font-bold text-red-700 mb-5">Visi</h3>
          <p class="text-gray-700 leading-relaxed">
            Menjadi program pengabdian pendidikan yang mampu
            memberikan kontribusi nyata dalam meningkatkan
            kualitas pendidikan serta membentuk mahasiswa yang
            peduli terhadap masyarakat.
          </p>
        </div>
        <div class="bg-white p-10 rounded-3xl shadow-lg">
          <h3 class="text-2xl font-bold text-red-700 mb-5">Misi</h3>
          <ul class="space-y-3 text-gray-700">
            <li>• Menyelenggarakan kegiatan pendidikan yang bermanfaat.</li>
            <li>• Meningkatkan kepedulian sosial mahasiswa.</li>
            <li>• Mengembangkan kemampuan komunikasi dan kepemimpinan relawan.</li>
            <li>• Mendukung tercapainya SDGs bidang pendidikan.</li>
          </ul>
        </div>
      </div>
    </div>
  </section>

  <section class="py-24 bg-white">
    <div class="max-w-7xl mx-auto px-6">
      <h2 class="text-4xl font-bold text-center text-red-800 mb-16">
        Tujuan Program
      </h2>
      <div class="grid md:grid-cols-3 gap-8">
        <div class="bg-red-50 p-8 rounded-3xl">
          <h3 class="font-bold text-xl text-red-700 mb-4">Pendidikan</h3>
          <p class="text-gray-700">
            Membantu meningkatkan kualitas pembelajaran di sekolah dan lembaga pendidikan mitra.
          </p>
        </div>
        <div class="bg-red-50 p-8 rounded-3xl">
          <h3 class="font-bold text-xl text-red-700 mb-4">Pengembangan Mahasiswa</h3>
          <p class="text-gray-700">
            Menjadi wadah pengembangan soft skill, kepemimpinan, dan komunikasi mahasiswa.
          </p>
        </div>
        <div class="bg-red-50 p-8 rounded-3xl">
          <h3 class="font-bold text-xl text-red-700 mb-4">Pengabdian Masyarakat</h3>
          <p class="text-gray-700">
            Memberikan kontribusi nyata bagi masyarakat melalui kegiatan pendidikan berkelanjutan.
          </p>
        </div>
      </div>
    </div>
  </section>

  <section class="py-24 bg-red-800 text-white">
    <div class="max-w-7xl mx-auto px-6">
      <h2 class="text-4xl font-bold text-center mb-16">
        Dampak UPN Mengajar
      </h2>
      <div class="grid md:grid-cols-4 gap-8 text-center">
        <div>
          <h3 class="text-5xl font-bold mb-3">150+</h3>
          <p>Relawan</p>
        </div>
        <div>
          <h3 class="text-5xl font-bold mb-3">10+</h3>
          <p>Sekolah Mitra</p>
        </div>
        <div>
          <h3 class="text-5xl font-bold mb-3">500+</h3>
          <p>Siswa Terlibat</p>
        </div>
        <div>
          <h3 class="text-5xl font-bold mb-3">5+</h3>
          <p>Tahun Program</p>
        </div>
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
          <li><a href="{{ url('/tentang') }}" class="hover:underline">Tentang</a></li>
          <li><a href="{{ url('/kegiatan') }}" class="hover:underline">Kegiatan</a></li>
          <li><a href="{{ url('/relawan') }}" class="hover:underline">Relawan</a></li>
        </ul>
      </div>

      <div class="text-center md:border-r md:border-red-300 md:px-10">
        <h4 class="font-semibold mb-2 text-lg">Send Message</h4>
        <p class="text-xs text-gray-200 mb-4">
          Pesan akan dikirim ke email UPN Mengajar
        </p>
        <form action="mailto:upnmengajar.jt@gmail.com" method="post" enctype="text/plain" class="space-y-3">
          <input type="text" name="nama" placeholder="Nama" class="w-full px-3 py-2 rounded text-black text-sm">
          <input type="email" name="email" placeholder="Email" class="w-full px-3 py-2 rounded text-black text-sm">
          <textarea name="pesan" placeholder="Pesan" rows="3" class="w-full px-3 py-2 rounded text-black text-sm"></textarea>
          <div class="text-left">
            <button type="submit" class="bg-white text-[#8B1E1E] px-5 py-2 rounded text-sm font-semibold hover:bg-gray-200 transition">
              Kirim
            </button>
          </div>
        </form>
      </div>

      <div class="md:pl-10">
        <h4 class="font-semibold mb-4 text-lg">Contact Us</h4>
        <div class="space-y-3 text-sm">
          <div class="flex items-center gap-2">
            <img src="{{ asset('foto/email.png') }}" class="w-5 h-6">
            <a href="mailto:upnmengajar.jt@gmail.com" class="hover:underline">upnmengajar.jt@gmail.com</a>
          </div>
          <div class="flex items-center gap-2">
            <img src="{{ asset('foto/instagram.png') }}" class="w-5 h-6">
            <a href="https://instagram.com/upnmengajar.jt" class="hover:underline">@upnmengajar.jt</a>
          </div>
          <div class="flex items-center gap-2">
            <img src="{{ asset('foto/whatsapp.png') }}" class="w-5 h-6">
            <a href="https://wa.me/6289699808453" class="hover:underline">089699808453 (Nabila)</a>
          </div>
        </div>

        <div class="mt-8 text-sm text-gray-200 leading-relaxed">
          <p class="font-semibold mb-1">Sekretariat Kami Berada di:</p>
          <p>
            Universitas Pembangunan Nasional "Veteran" Jawa Timur<br>
            Jl. Raya Rungkut Madya, Gunung Anyar, Surabaya, Jawa Timur
          </p>
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