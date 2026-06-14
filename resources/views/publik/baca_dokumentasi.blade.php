<!doctype html>
<html lang="id">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>{{ $dokumentasi->judul_foto }} - UPN Mengajar</title>

    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Instrument+Serif:ital@0;1&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
      rel="stylesheet"
    />

    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        poppins: ['Poppins', 'sans-serif'],
                    }
                }
            }
        }
    </script>
  </head>

  <body class="bg-gray-50 font-poppins">
   <header class="fixed top-0 left-0 w-full z-50 transition-all duration-300 bg-red-900 shadow-lg">
<div class="flex items-center justify-between px-6 py-0.5 text-white">

<div class="flex items-center">
<a href="/" class="overflow-hidden">
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
class="relative
{{ request()->is('/') ? 'after:w-full' : 'after:w-0' }}
after:absolute
after:left-0
after:-bottom-1
after:h-[1.5px]
after:bg-white
after:transition-all
after:duration-300
hover:after:w-full">
Home
</a>
</li>

<li class="relative group">

<a href="#"
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
transition-all duration-300 ease-out rounded-lg overflow-hidden">

<li>
<a href="{{ url('/ukm') }}" class="block px-5 py-2 hover:bg-gray-100">
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
class="relative
{{ request()->is('kegiatan*') ? 'after:w-full' : 'after:w-0' }}
after:absolute
after:left-0
after:-bottom-1
after:h-[1.5px]
after:bg-white
after:transition-all
after:duration-300
hover:after:w-full">
Kegiatan
</a>
</li>

<li>
<a href="{{ url('/relawan') }}"
class="relative
{{ request()->is('relawan*') ? 'after:w-full' : 'after:w-0' }}
after:absolute
after:left-0
after:-bottom-1
after:h-[1.5px]
after:bg-white
after:transition-all
after:duration-300
hover:after:w-full">
Dokumentasi
</a>
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
    <a href="{{ route('logout') }}" class="hover:text-red-400 transition-all duration-300">
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

<main class="pt-32 pb-24 bg-gray-50">
    <div class="max-w-4xl mx-auto px-6">
        
        {{-- Tombol Kembali --}}
        <div class="mb-6">
            <a href="{{ route('relawan') }}" class="inline-flex items-center text-[#8B1E1E] text-sm font-bold hover:text-red-700 gap-2 group">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 transition-transform duration-200 group-hover:-translate-x-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                <span>Kembali ke Galeri</span>
            </a>
        </div>

        {{-- Konten Utama Berita --}}
        <article class="bg-white rounded-3xl p-8 md:p-12 shadow-[0_4px_25px_-5px_rgba(0,0,0,0.05)] border border-gray-100">
            
            {{-- Nama Kegiatan --}}
            <span class="inline-block px-4 py-1.5 bg-red-50 text-[#8B1E1E] rounded-xl text-xs font-bold tracking-wide uppercase mb-4">
                {{ $dokumentasi->nama_kegiatan }}
            </span>

            {{-- Judul Utama --}}
            <h1 class="text-3xl md:text-4xl font-extrabold text-gray-950 leading-tight mb-4">
                {{ $dokumentasi->judul_foto }}
            </h1>

            {{-- Meta Data: Tanggal --}}
            <div class="flex items-center gap-2 text-gray-400 text-sm font-medium mb-8 pb-6 border-b border-gray-100">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                </svg>
                <span>Diterbitkan pada: {{ date('d M Y', strtotime($dokumentasi->created_at ?? now())) }}</span>
            </div>

            {{-- Pemrosesan Array Foto --}}
            @php
                $arrayFoto = $dokumentasi->foto ? explode(',', $dokumentasi->foto) : [];
                $fotoUtama = count($arrayFoto) > 0 ? $arrayFoto[0] : null;
            @endphp

            {{-- Area Foto Sampul Utama --}}
            @if($fotoUtama)
                <div class="rounded-2xl overflow-hidden aspect-[16/9] bg-gray-100 shadow-inner mb-8">
                    <img src="/foto/{{ basename($fotoUtama) }}" class="w-full h-full object-cover" alt="Foto Utama {{ $dokumentasi->judul_foto }}">
                </div>
            @endif

            {{-- Isi Narasi/Deskripsi Cerita --}}
            <div class="text-gray-700 text-base md:text-lg leading-relaxed whitespace-pre-line mb-12">
                {{ $dokumentasi->deskripsi }}
            </div>

            {{-- Grid Lampiran Foto Tambahan --}}
            @if(count($arrayFoto) > 1)
                <div class="pt-8 border-t border-gray-100">
                    <h3 class="text-lg font-bold text-gray-900 mb-6 flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-[#8B1E1E]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                        <span>Dokumentasi Tambahan Album</span>
                    </h3>
                    
                    <div class="grid grid-cols-2 sm:grid-cols-3 gap-4">
                        @foreach($arrayFoto as $index => $subFoto)
                            {{-- Lewati foto pertama karena sudah dijadikan banner utama --}}
                            @if($index > 0)
                                <div class="rounded-xl overflow-hidden aspect-square bg-gray-50 border border-gray-100 group relative shadow-sm">
                                    <img src="/foto/{{ basename($subFoto) }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" alt="Dokumentasi {{ $index }}">
                                    <div class="absolute inset-0 bg-black/10 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>
            @endif

        </article>
    </div>
</main>

    <footer class="w-full bg-[#8B1E1E] text-white pt-16">
      <div
        class="max-w-7xl mx-auto px-6 md:px-20 grid md:grid-cols-3 gap-10 pb-10"
      >
        <div class="md:border-r md:border-red-300 md:pr-10">
          <div class="w-24 h-24 overflow-hidden mb-5">
            <img
              src="{{ asset('foto/logo.jpeg') }}"
              alt="Logo UPN Mengajar"
              class="w-full h-full object-cover scale-150"
            />
          </div>

          <h4 class="font-semibold mb-3 text-lg">Menu</h4>
          <ul class="space-y-2 text-sm">
            <li><a href="{{ url('/') }}" class="hover:underline">Home</a></li>
            <li><a href="#" class="hover:underline">Tentang</a></li>
            <li><a href="{{ url('/kegiatan') }}" class="hover:underline">Kegiatan</a></li>
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
              <img
                src="{{ asset('foto/Untitled design (17).png') }}"
                alt="Email"
                class="w-5 h-6"
                onerror="this.src='https://cdn-icons-png.flaticon.com/512/732/732200.png'"
              />
              <a href="mailto:upnmengajar.jt@gmail.com" class="hover:underline">
                upnmengajar.jt@gmail.com
              </a>
            </div>

            <div class="flex items-center gap-2">
              <img src="{{ asset('foto/instagram.png') }}" alt="Instagram" class="w-5 h-6" onerror="this.src='https://cdn-icons-png.flaticon.com/512/2111/2111463.png'" />
              <a
                href="https://instagram.com/upnmengajar.jt"
                class="hover:underline"
              >
                @upnmengajar.jt
              </a>
            </div>

            <div class="flex items-center gap-2">
              <img src="{{ asset('foto/whatsapp.png') }}" alt="WhatsApp" class="w-5 h-6" onerror="this.src='https://cdn-icons-png.flaticon.com/512/733/733585.png'" />
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
  </body>
</html>