<!doctype html>
<html lang="id">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Detail Relawan SD - {{ $kegiatan->nama_kegiatan ?? 'Belum Ada Kegiatan' }}</title>

    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet" />
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <style>
        body { font-family: 'Poppins', sans-serif; background-color: #f8f9fa; }
    </style>
  </head>

  <body class="text-gray-800">
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
                <a href="/relawan" class="relative after:absolute after:right-0 after:-bottom-1 after:h-[1.5px] after:w-full after:bg-white">Relawan</a>
              </li>
              @auth
                @if(auth()->user()->role === 'admin')
                  <li>
                    <a href="/admin/dashboard" class="relative after:absolute after:left-0 after:-bottom-1 after:h-[1.5px] after:w-0 after:bg-white after:transition-all after:duration-300 hover:after:w-full">Dashboard Admin</a>
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
              <form id="logout-form" action="/logout" method="POST" class="hidden">@csrf</form>
              <div class="absolute -bottom-12 left-1/2 -translate-x-1/2 bg-black/80 backdrop-blur-sm text-white text-[11px] px-4 py-2 opacity-0 group-hover:opacity-100 transition-all duration-300 whitespace-nowrap rounded-lg shadow-2xl border border-white/10">Keluar</div>
            @endauth
            @guest
              <a href="/login" class="hover:text-gray-300 transition-all duration-300">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A9 9 0 1118.879 17.804M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                </svg>
              </a>
              <div class="absolute -bottom-12 left-1/2 -translate-x-1/2 bg-black/80 backdrop-blur-sm text-white text-[11px] px-4 py-2 opacity-0 group-hover:opacity-100 transition-all duration-300 whitespace-nowrap rounded-lg shadow-2xl border border-white/10">Masuk / Daftar</div>
            @endguest
          </div>
        </div>
      </div>
    </header>

    <main class="max-w-7xl mx-auto px-6 pb-12 pt-32">
      <div class="mb-6">
        <a href="/relawan" class="inline-flex items-center text-[#8B1E1E] font-semibold hover:underline">
          ← Kembali ke Pilihan Program
        </a>
      </div>

      <div class="grid grid-cols-1 lg:grid-cols-[2fr_1fr] gap-8 items-start">
        <div class="space-y-6">
          
          <div class="bg-white rounded-[20px] overflow-hidden shadow-sm border border-gray-100 aspect-video md:h-[450px]">
            @php $foto = $kegiatan->foto_kegiatan ?? 'sd.jpg'; @endphp
            <img src="{{ asset('foto/' . $foto) }}" alt="Kegiatan SD" class="w-full h-full object-cover" />
          </div>

          <div class="bg-white rounded-[20px] border border-gray-100 shadow-sm p-6 md:p-8">
            <h3 class="text-xl font-bold text-gray-900 mb-4">Deskripsi</h3>
            <p class="text-gray-600 leading-relaxed text-sm md:text-base whitespace-pre-line">
              {{ $kegiatan->deskripsi_detail ?? ($kegiatan->deskripsi ?? 'Belum ada deskripsi yang ditambahkan.') }}
            </p>
          </div>

          <div class="bg-white rounded-[20px] border border-gray-100 shadow-sm p-6 md:p-8">
            <h3 class="text-xl font-bold text-gray-900 mb-4">Detail Aktivitas</h3>
            <ul class="space-y-3 text-gray-600 text-sm md:text-base">
              @php
                $aktivitas_raw = $kegiatan->detail_aktivitas ?? '';
                $aktivitas_list = array_filter(array_map('trim', explode("\n", $aktivitas_raw)));
              @endphp
              @if(empty($aktivitas_list))
                <li>Belum ada detail aktivitas.</li>
              @else
                @foreach($aktivitas_list as $act)
                  <li class="flex items-start gap-3"><span class="text-gray-400 mt-1">•</span> <span>{{ $act }}</span></li>
                @endforeach
              @endif
            </ul>
          </div>

          <div class="space-y-4">
            <h3 class="text-xl font-bold text-gray-900 mt-8 mb-2">Kebutuhan Relawan</h3>
            @if(isset($kegiatan->id_kegiatan) && isset($divisi_kegiatan) && $divisi_kegiatan->count() > 0)
              @foreach($divisi_kegiatan as $divisi)
                @if(($divisi->kuota ?? 0) > 0)
                  <div class="bg-white rounded-[20px] border border-gray-100 shadow-sm p-6">
                    <h4 class="font-bold text-lg text-gray-900">{{ $divisi->nama_divisi }}</h4>
                    @if(!empty($divisi->jobdesc))
                      <p class="text-sm text-gray-600 mt-2 mb-3 leading-relaxed">{!! nl2br(e($divisi->jobdesc)) !!}</p>
                    @endif
                    <div class="flex flex-wrap gap-6 mt-3 text-sm text-gray-500 font-medium">
                      <span class="flex items-center gap-2 bg-red-50 text-red-600 px-3 py-1 rounded-md">👤 Kuota: {{ $divisi->kuota }} orang</span>
                    </div>
                  </div>
                @endif
              @endforeach
            @else
              <p class="text-sm text-gray-500 bg-white p-6 rounded-[20px] border border-gray-100 shadow-sm">Belum ada data kebutuhan divisi yang ditambahkan oleh admin.</p>
            @endif
          </div>

          <div id="form-pendaftaran" class="bg-white rounded-[20px] border border-gray-100 shadow-md p-6 md:p-8 scroll-mt-28">
            <h3 class="text-2xl font-bold text-gray-900 mb-2">Formulir Pendaftaran Relawan</h3>
            <p class="text-gray-500 text-sm mb-6">Silakan isi data diri Anda secara lengkap untuk mendaftar sebagai relawan Sekolah Dasar.</p>

            @if(session('sukses'))
              <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-xl mb-4">{{ session('sukses') }}</div>
            @endif

            <form action="/pendaftaran/simpan" method="POST" class="space-y-5">
              @csrf
              <input type="hidden" name="id_kegiatan" value="{{ $kegiatan->id_kegiatan ?? 0 }}">
              <input type="hidden" name="kategori" value="sd">

              <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Nama Lengkap</label>
                <input type="text" name="nama" value="{{ auth()->check() ? auth()->user()->name : '' }}" class="w-full px-4 py-2.5 rounded-xl border border-gray-300 focus:ring-2 focus:ring-red-200 focus:border-[#8B1E1E] outline-none transition" placeholder="Masukkan nama lengkap" required>
              </div>
              <div class="grid md:grid-cols-2 gap-4">
                <div>
                  <label class="block text-sm font-semibold text-gray-700 mb-2">NPM / NIM</label>
                  <input type="text" name="npm" class="w-full px-4 py-2.5 rounded-xl border border-gray-300 focus:ring-2 focus:ring-red-200 focus:border-[#8B1E1E] outline-none transition" placeholder="Contoh: 21081010..." required>
                </div>
                <div>
                  <label class="block text-sm font-semibold text-gray-700 mb-2">Nomor WhatsApp</label>
                  <input type="text" name="whatsapp" class="w-full px-4 py-2.5 rounded-xl border border-gray-300 focus:ring-2 focus:ring-red-200 focus:border-[#8B1E1E] outline-none transition" placeholder="Contoh: 0896..." required>
                </div>
              </div>
              <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Program Studi / Jurusan</label>
                <input type="text" name="prodi" class="w-full px-4 py-2.5 rounded-xl border border-gray-300 focus:ring-2 focus:ring-red-200 focus:border-[#8B1E1E] outline-none transition" placeholder="Contoh: Sistem Informasi" required>
              </div>

              @if(isset($divisi_kegiatan) && $divisi_kegiatan->count() > 0)
              <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Pilih Divisi yang Diminati</label>
                <select name="divisi_pilihan" class="w-full px-4 py-2.5 rounded-xl border border-gray-300 focus:ring-2 focus:ring-red-200 focus:border-[#8B1E1E] outline-none transition bg-white" required>
                  <option value="">-- Pilih Divisi --</option>
                  @foreach($divisi_kegiatan as $divisi)
                    @if(($divisi->kuota ?? 0) > 0)
                      <option value="{{ $divisi->nama_divisi }}">{{ $divisi->nama_divisi }}</option>
                    @endif
                  @endforeach
                </select>
              </div>
              @endif

              <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Mengapa kamu tertarik memilih program ini?</label>
                <textarea name="alasan" rows="4" class="w-full px-4 py-2.5 rounded-xl border border-gray-300 focus:ring-2 focus:ring-red-200 focus:border-[#8B1E1E] outline-none transition" placeholder="Ceritakan motivasi singkatmu..." required></textarea>
              </div>
              <div class="pt-4">
                <button type="submit" class="w-full bg-[#8B1E1E] hover:bg-red-900 text-white font-bold py-3 px-6 rounded-xl transition shadow-md">Kirim Formulir Pendaftaran</button>
              </div>
            </form>
          </div>
        </div>

        <aside class="lg:sticky lg:top-28 h-fit">
          <div class="bg-white rounded-[24px] border border-gray-100 shadow-md p-6 md:p-8 flex flex-col">
            <div class="mb-5">
              <span class="inline-block text-xs font-semibold text-white px-3 py-1.5 rounded-lg bg-gradient-to-r from-purple-500 to-purple-400 mb-4">Event</span>
              <h2 class="text-2xl md:text-3xl font-bold leading-tight text-gray-900 mb-4">{{ $kegiatan->nama_kegiatan ?? 'Judul Kegiatan Belum Diinput' }}</h2>
            </div>
            <div class="rounded-2xl border border-gray-100 overflow-hidden flex-1 flex flex-col mb-6">
              <div class="p-5 space-y-6">
                <div class="flex gap-4">
                  <div class="text-blue-400 text-xl mt-1">📅</div>
                  <div>
                    <p class="text-gray-400 text-xs uppercase tracking-wider font-semibold mb-1">Jadwal Event</p>
                    <p class="text-gray-900 font-semibold text-sm">{{ $kegiatan->tanggal_pelaksanaan ?? 'Tanggal belum diset' }}</p>
                    <p class="text-gray-900 text-sm mt-0.5">{{ $kegiatan->jam_kegiatan ?? 'Jam belum diset' }} WIB</p>
                  </div>
                </div>
                <div class="flex gap-4">
                  <div class="text-red-400 text-xl mt-1">📍</div>
                  <div>
                    <p class="text-gray-400 text-xs uppercase tracking-wider font-semibold mb-1">Lokasi</p>
                    <p class="text-gray-900 font-semibold text-sm">{{ $kegiatan->lokasi ?? 'Nama lokasi belum diset' }}</p>
                    <p class="text-gray-600 text-sm mt-1 leading-relaxed">{{ $kegiatan->alamat_lengkap ?? 'Alamat lengkap belum diset' }}</p>
                  </div>
                </div>
              </div>
              <div class="bg-gray-50 px-5 py-4 text-xs text-gray-600 border-t border-gray-100">
                <span class="font-semibold text-gray-800">Batas Registrasi:</span> {{ $kegiatan->batas_registrasi ?? '-' }}
              </div>
            </div>
            <a href="#form-pendaftaran" class="block w-full text-center bg-[#EB1D2D] hover:bg-red-700 text-white font-semibold py-3.5 rounded-xl transition shadow-sm">Daftar Sekarang</a>
          </div>
        </aside>
      </div>
    </main>

    <footer class="w-full bg-[#8B1E1E] text-white pt-16">
      <div class="max-w-7xl mx-auto px-6 md:px-20 grid md:grid-cols-3 gap-10 pb-10">
        <div class="md:border-r md:border-red-300 md:pr-10">
          <div class="w-24 h-24 overflow-hidden mb-5"><img src="{{ asset('foto/logo.jpeg') }}" class="w-full h-full object-cover scale-150" /></div>
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
            <div class="text-left"><button type="submit" class="bg-white text-[#8B1E1E] px-5 py-2 rounded text-sm font-semibold">Kirim</button></div>
          </form>
        </div>
        <div class="md:pl-10">
          <h4 class="font-semibold mb-4 text-lg">Contact Us</h4>
          <div class="space-y-3 text-sm">
            <div class="flex items-center gap-2"><img src="{{ asset('foto/instagram.png') }}" class="w-5 h-6" /><a href="https://instagram.com/upnmengajar.jt" class="hover:underline">@upnmengajar.jt</a></div>
            <div class="flex items-center gap-2"><img src="{{ asset('foto/whatsapp.png') }}" class="w-5 h-6" /><a href="https://wa.me/6289699808453" class="hover:underline">089699808453</a></div>
          </div>
        </div>
      </div>
      <div class="bg-[#6e1515] px-6 md:px-20 py-4 flex flex-col md:flex-row justify-between text-sm text-gray-200">
        <p>© 2026 UPN Mengajar — UKM Penalaran & Kreativitas UPN "Veteran" Jatim</p>
      </div>
    </footer>

    <script>
      const header = document.querySelector("header");
      window.addEventListener("scroll", function () {
        if (window.scrollY > 50) { header.classList.add("bg-red-900", "shadow-lg"); } 
        else { header.classList.remove("bg-red-900", "shadow-lg"); }
      });
    </script>
  </body>
</html>