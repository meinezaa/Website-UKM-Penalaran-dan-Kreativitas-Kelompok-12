<!doctype html>
<html lang="id">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>UPN Mengajar - Langkah Nyata Mencerdaskan Bangsa</title>

    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Instrument+Serif:ital@0;1&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900&display=swap"
      rel="stylesheet"
    />

    <script src="https://cdn.tailwindcss.com"></script>
    <style>
      body {
        font-family: "Poppins", sans-serif;
      }
      .font-serif-custom {
        font-family: "Instrument Serif", serif;
      }
      .glass-effect {
        background: rgba(255, 255, 255, 0.9);
        backdrop-filter: blur(10px);
      }
      .card-hover:hover {
        transform: translateY(-10px);
        box-shadow:
          0 20px 25px -5px rgba(139, 30, 30, 0.1),
          0 10px 10px -5px rgba(139, 30, 30, 0.04);
      }
    </style>
  </head>

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


    <main>
      <section
        class="relative h-[600px] w-full flex items-center justify-start overflow-hidden"
      >
        <img
          src="./foto/slide1.jpg"
          class="absolute inset-0 w-full h-full object-cover"
        />
        <div
          class="absolute inset-0 bg-gradient-to-r from-[#8B1E1E] via-[#8B1E1E]/80 to-transparent"
        ></div>

        <div class="relative z-10 px-12 md:px-24 text-white max-w-4xl">
          <span
            class="inline-block px-4 py-1 bg-white/20 backdrop-blur-md rounded-full text-sm font-medium mb-6"
            >Program Kerja Bidang SOSIAL & PENDIDIKAN</span
          >
          <h1 class="text-6xl md:text-7xl font-bold mb-6 leading-tight">
            Mencerdaskan Bangsa Melalui
            <span class="italic font-light">Aksi Nyata.</span>
          </h1>
          <p
            class="text-lg md:text-xl opacity-90 mb-8 font-light leading-relaxed"
          >
            Pendekatan interaktif untuk menutup celah pendidikan pasca-pandemi.
            Kami menghadirkan pengalaman belajar bermakna bagi seluruh lapisan
            masyarakat.
          </p>
          <a
            href="#gabung"
            class="bg-white text-[#8B1E1E] px-10 py-4 rounded-full font-bold text-lg hover:bg-gray-100 transition shadow-lg"
            >Gabung Jadi Relawan</a
          >
        </div>
      </section>

      <section class="py-24 px-8 md:px-24 bg-white">
        <div class="max-w-7xl mx-auto grid md:grid-cols-2 gap-20 items-center">
          <div class="relative">
            <div
              class="absolute -top-10 -left-10 w-40 h-40 bg-red-50 rounded-full z-0"
            ></div>
            <h3
              class="text-4xl font-bold text-gray-900 mb-8 relative z-10 leading-snug"
            >
              Berpacu dengan <br /><span class="text-[#8B1E1E]"
                >SDGs 4: Kualitas Pendidikan.</span
              >
            </h3>
            <p class="text-gray-600 text-lg leading-relaxed mb-6">
              Output utama kami adalah memastikan teknik pembelajaran yang
              diajarkan dapat diterapkan secara mandiri oleh peserta di
              lingkungan mereka secara berkelanjutan.
            </p>
            <div class="space-y-4">
              <div class="flex items-start gap-4">
                <p class="text-gray-700 font-medium">
                  Pembelajaran Berbasis Eksperimen & Praktik Langsung.
                </p>
              </div>
              <div class="flex items-start gap-4">
                <p class="text-gray-700 font-medium">
                  Kurikulum Inklusif untuk Semua Kalangan Masyarakat.
                </p>
              </div>
            </div>
          </div>

          <div class="grid grid-cols-2 gap-6">
            <div
              class="p-8 bg-[#8B1E1E] text-white rounded-[2rem] text-center card-hover transition duration-300 flex flex-col items-center justify-center"
            >
              <div class="mb-3 opacity-80">
                <svg
                  xmlns="http://www.w3.org/2000/svg"
                  class="w-10 h-10 mx-auto"
                  fill="none"
                  viewBox="0 0 24 24"
                  stroke="currentColor"
                >
                  <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="1.5"
                    d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"
                  />
                </svg>
              </div>

              <h4 class="text-5xl font-bold mb-1">2x</h4>
              <p
                class="text-xs opacity-90 uppercase tracking-widest font-bold mb-2"
              >
                Pertemuan / Lokasi
              </p>

              <div class="mt-2 pt-3 border-t border-white/20">
                <p class="text-[10px] leading-relaxed opacity-70 italic">
                  Intensitas belajar optimal untuk <br />
                  efektivitas penyampaian materi.
                </p>
              </div>
            </div>

            <div
              class="p-8 bg-white border-2 border-[#8B1E1E] rounded-[2rem] text-center card-hover transition duration-300 cursor-pointer group"
            >
              <div class="flex flex-col items-center justify-center h-full">
                <div
                  class="mb-3 p-3 bg-red-50 rounded-full group-hover:bg-[#8B1E1E] transition duration-300"
                >
                  <svg
                    xmlns="http://www.w3.org/2000/svg"
                    class="w-8 h-8 text-[#8B1E1E] group-hover:text-white"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor"
                  >
                    <path
                      stroke-linecap="round"
                      stroke-linejoin="round"
                      stroke-width="2"
                      d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"
                    />
                  </svg>
                </div>
                <h4 class="text-2xl font-bold mb-1 text-gray-900">
                  Timeline Kegiatan
                </h4>
                <p
                  class="text-sm text-[#8B1E1E] font-semibold uppercase tracking-wider mb-4"
                >
                  Program Kerja 2026
                </p>
                <a
                  href="jadwal-lengkap.html"
                  class="text-xs bg-[#8B1E1E] text-white px-4 py-2 rounded-full hover:bg-red-800 transition shadow-md"
                >
                  Lihat Jadwal Lengkap
                </a>
              </div>
            </div>
            <div
              class="col-span-2 p-10 bg-red-50 rounded-[2rem] border border-red-100"
            >
              <p class="text-[#8B1E1E] font-medium leading-relaxed italic">
                "Bukan hanya sekadar mengajar materi sekolah, tetapi kami
                membekali mereka dengan kreativitas untuk masa depan yang lebih
                cerah."
              </p>
            </div>
          </div>
        </div>
      </section>

      <section class="py-24 bg-gray-50 px-8 md:px-24">
        <div class="max-w-7xl mx-auto">
          <div class="text-center max-w-2xl mx-auto mb-16">
            <h2 class="text-4xl font-bold text-gray-900 mb-4">
              Wilayah Jangkauan
            </h2>
            <p class="text-gray-500">
              Dari sekolah formal hingga komunitas inklusif, kami menjangkau
              setiap sudut yang membutuhkan sentuhan pendidikan.
            </p>
          </div>

          <div class="grid md:grid-cols-3 gap-10">
            <div class="group bg-white rounded-[2.5rem] overflow-hidden shadow-sm border border-gray-100 card-hover transition duration-500">
                <div class="h-56 bg-gray-200 overflow-hidden relative">
                <img src="./foto/sd.JPG" class="w-full h-full object-cover group-hover:scale-110 transition duration-500" />
                </div>
                <div class="p-10">
                <h4 class="text-2xl font-bold mb-4 text-gray-900">Sekolah Dasar (SD)</h4>
                <p class="text-gray-600 text-sm mb-8 leading-relaxed">
                    Fokus pada literasi dan numerasi dasar melalui metode visual yang interaktif bagi anak-anak.
                </p>
                <div class="flex items-center mt-6">
                    <a href="{{ url('/kegiatan?kategori=sd') }}" class="bg-[#8B1E1E] text-white px-5 py-2 rounded-lg text-sm font-semibold hover:bg-red-700 transition">
                        Lihat Detail
                    </a>
                </div>
                </div>
            </div>

            <div class="group bg-white rounded-[2.5rem] overflow-hidden shadow-sm border border-gray-100 card-hover transition duration-500">
                <div class="h-56 bg-gray-200 overflow-hidden relative">
                <img src="./foto/slb.JPG" class="w-full h-full object-cover group-hover:scale-110 transition duration-500" />
                <div class="absolute top-4 left-4 bg-[#8B1E1E] text-white text-[10px] px-3 py-1 rounded-full font-bold">INKLUSIF</div>
                </div>
                <div class="p-10">
                <h4 class="text-2xl font-bold mb-4 text-gray-900">Sekolah Luar Biasa</h4>
                <p class="text-gray-600 text-sm mb-8 leading-relaxed">
                    Memberikan dukungan pendidikan khusus dengan pendekatan emosional yang dirancang khusus.
                </p>
                <div class="flex items-center mt-6">
                    <a href="{{ url('/kegiatan?kategori=slb') }}" class="bg-[#8B1E1E] text-white px-5 py-2 rounded-lg text-sm font-semibold hover:bg-red-700 transition">
                        Lihat Detail
                    </a>
                </div>
                </div>
            </div>

            <div class="group bg-white rounded-[2.5rem] overflow-hidden shadow-sm border border-gray-100 card-hover transition duration-500">
                <div class="h-56 bg-gray-200 overflow-hidden relative">
                <img src="./foto/yayasan.jpg" class="w-full h-full object-cover group-hover:scale-110 transition duration-500" />
                </div>
                <div class="p-10">
                <h4 class="text-2xl font-bold mb-4 text-gray-900">Yayasan & Komunitas</h4>
                <p class="text-gray-600 text-sm mb-8 leading-relaxed">
                    Pendampingan belajar untuk anak-anak di panti asuhan maupun komunitas belajar jalanan.
                </p>
                <div class="flex items-center mt-6">
                    <a href="{{ url('/kegiatan?kategori=yayasan') }}" class="bg-[#8B1E1E] text-white px-5 py-2 rounded-lg text-sm font-semibold hover:bg-red-700 transition">
                        Lihat Detail
                    </a>
                </div>
                </div>
            </div>
            </div>     
            </section>

      <section
        id="gabung"
        class="py-24 px-8 md:px-24 bg-white overflow-hidden relative"
      >
        <div
          class="max-w-6xl mx-auto bg-[#8B1E1E] rounded-[3rem] p-12 md:p-20 text-center relative overflow-hidden"
        >
          <div class="relative z-10">
            <h2 class="text-4xl md:text-5xl font-bold text-white mb-6">
              Siap Menjadi Bagian dari Perubahan?
            </h2>
            <p
              class="text-white/80 text-lg mb-10 max-w-2xl mx-auto leading-relaxed"
            >
              Mari berkontribusi nyata bagi pendidikan Indonesia. Jadilah
              relawan penggerak bersama tim UPN Mengajar sekarang juga.
            </p>
            <a
              href="relawan.html"
              class="bg-white text-[#8B1E1E] px-12 py-5 rounded-full font-black text-xl hover:scale-105 transition shadow-2xl uppercase tracking-wider inline-block"
            >
              Gabung Jadi Relawan
            </a>
          </div>
        </div>
      </section>
    </main>

    <footer class="bg-[#8B1E1E] text-white pt-16">
      <div
        class="max-w-7xl mx-auto px-6 md:px-20 grid md:grid-cols-3 gap-10 pb-10"
      >
        <div class="md:border-r md:border-red-300 md:pr-10">
          <div class="w-24 h-24 overflow-hidden mb-5">
            <img
              src="foto/logo.jpeg"
              class="w-full h-full object-cover scale-150"
            />
          </div>

          <h4 class="font-semibold mb-3 text-lg">Menu</h4>
          <ul class="space-y-2 text-sm">
            <li><a href="{{ url('/') }}" class="hover:underline">Home</a></li>
            <li><a href="tentang.html" class="hover:underline">Tentang</a></li>
            <li>
              <a href="{{ url('/kegiatan') }}" class="hover:underline">Kegiatan</a>
            </li>
            <li><a href="{{ url('/relawan') }}" class="hover:underline">Relawan</a></li>
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
              <img src="./foto/Untitled design (17).png" class="w-5 h-6" />
              <a href="mailto:upnmengajar.jt@gmail.com" class="hover:underline">
                upnmengajar.jt@gmail.com
              </a>
            </div>

            <div class="flex items-center gap-2">
              <img src="foto/instagram.png" class="w-5 h-6" />
              <a
                href="https://instagram.com/upnmengajar.jt"
                class="hover:underline"
              >
                @upnmengajar.jt
              </a>
            </div>

            <div class="flex items-center gap-2">
              <img src="foto/whatsapp.png" class="w-5 h-6" />
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
          <span class="font-semibold"
            >Vina • Naila • Inez Sistem Informasi UPNVJT 2024</span
          >
        </p>
      </div>
    </footer>

    <script>
      const header = document.getElementById("mainHeader");
      window.addEventListener("scroll", function () {
        if (window.scrollY > 50) {
          header.classList.add(
            "bg-red-950/95",
            "backdrop-blur-md",
            "shadow-xl",
          );
        } else {
          header.classList.remove(
            "bg-red-950/95",
            "backdrop-blur-md",
            "shadow-xl",
          );
        }
      });
    </script>
  </body>
</html>

