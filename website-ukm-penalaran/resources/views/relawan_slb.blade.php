<!doctype html>
<html lang="id">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Detail Relawan SLB - {{ $kegiatan->nama_kegiatan ?? 'Belum Ada Kegiatan' }}</title>

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
              <li><a href="/beranda" class="relative after:absolute after:left-0 after:-bottom-1 after:h-[1.5px] after:w-0 after:bg-white after:transition-all after:duration-300 hover:after:w-full">Home</a></li>
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
              <li><a href="/kegiatan" class="relative after:absolute after:left-0 after:-bottom-1 after:h-[1.5px] after:w-0 after:bg-white after:transition-all after:duration-300 hover:after:w-full">Kegiatan</a></li>
              <li><a href="/relawan" class="relative after:absolute after:right-0 after:-bottom-1 after:h-[1.5px] after:w-full after:bg-white">Relawan</a></li>
              @auth
                @if(auth()->user()->role === 'admin')
                  <li><a href="/admin/dashboard" class="relative after:absolute after:left-0 after:-bottom-1 after:h-[1.5px] after:w-0 after:bg-white after:transition-all after:duration-300 hover:after:w-full">Dashboard Admin</a></li>
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
            @endauth
            @guest
              <a href="/login" class="hover:text-gray-300 transition-all duration-300">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A9 9 0 1118.879 17.804M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                </svg>
              </a>
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
            @php $foto = $kegiatan->foto_kegiatan ?? 'slb.jpg'; @endphp
            <img src="{{ asset('foto/' . $foto) }}" alt="Kegiatan SLB" class="w-full h-full object-cover" />
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

          {{-- PEMBARUAN: STRUKTUR FORMULIR MULTI-STEP RELAWAN SLB --}}
          <div id="form-pendaftaran" class="bg-white rounded-[20px] border border-gray-100 shadow-md p-6 md:p-8 scroll-mt-28">
            <div class="flex flex-col md:flex-row justify-between items-start md:items-center border-b border-gray-100 pb-4 mb-6 gap-4">
              <div>
                <h3 class="text-2xl font-bold text-gray-900 mb-1">Formulir Pendaftaran Relawan</h3>
                <p class="text-gray-500 text-sm">Silakan lengkapi tahapan data untuk mendaftar sebagai relawan Sekolah Luar Biasa (SLB).</p>
              </div>
              {{-- Progress Indikator Step --}}
              <div class="flex items-center space-x-2 bg-gray-50 px-4 py-2 rounded-xl border">
                <div id="dot-1" class="w-8 h-2 rounded-full bg-red-600 transition-all duration-300"></div>
                <div id="dot-2" class="w-4 h-2 rounded-full bg-gray-200 transition-all duration-300"></div>
                <div id="dot-3" class="w-4 h-2 rounded-full bg-gray-200 transition-all duration-300"></div>
              </div>
            </div>

            @if(session('sukses'))
              <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-xl mb-4">{{ session('sukses') }}</div>
            @endif

            <form id="formRelawan" action="/pendaftaran/simpan" method="POST" enctype="multipart/form-data" class="space-y-5">
              @csrf
              <input type="hidden" name="id_kegiatan" value="{{ $kegiatan->id_kegiatan ?? 0 }}">
              <input type="hidden" name="kategori" value="slb">

              {{-- STEP 1: INFORMASI PERSONAL & PILIHAN DIVISI --}}
              <div id="step-1" class="space-y-5">
                <div>
                  <label class="block text-sm font-semibold text-gray-700 mb-2">Nama Lengkap</label>
                  <input type="text" name="nama_lengkap" value="{{ auth()->check() ? (auth()->user()->nama_lengkap ?? auth()->user()->name) : '' }}" readonly class="w-full px-4 py-2.5 rounded-xl border border-gray-200 bg-gray-50 text-gray-500 outline-none cursor-not-allowed font-medium">
                </div>

                <div class="grid md:grid-cols-2 gap-4">
                  <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Nomor WhatsApp</label>
                    <input type="number" name="no_hp" placeholder="Contoh: 0896..." class="w-full px-4 py-2.5 rounded-xl border border-gray-300 focus:ring-2 focus:ring-red-100 focus:border-[#8B1E1E] outline-none transition" required>
                  </div>
                  <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Email Aktif</label>
                    <input type="email" value="{{ auth()->check() ? auth()->user()->email : '' }}" readonly class="w-full px-4 py-2.5 rounded-xl border border-gray-200 bg-gray-50 text-gray-500 outline-none cursor-not-allowed font-medium">
                  </div>
                </div>

                <div class="grid md:grid-cols-2 gap-4 items-center">
                  <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Umur</label>
                    <input type="number" name="umur" placeholder="Contoh: 21" class="w-full px-4 py-2.5 rounded-xl border border-gray-300 focus:ring-2 focus:ring-red-100 focus:border-[#8B1E1E] outline-none transition" required>
                  </div>
                  <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Jenis Kelamin</label>
                    <div class="flex gap-2">
                      <input type="radio" name="jenis_kelamin" id="L" value="Laki-laki" class="hidden" required onchange="updateGenderStyle()">
                      <label id="label-L" for="L" class="flex-1 text-center py-2.5 border rounded-xl cursor-pointer text-sm font-bold text-gray-400 bg-gray-50 transition-all">Laki-laki</label>
                      
                      <input type="radio" name="jenis_kelamin" id="P" value="Perempuan" class="hidden" onchange="updateGenderStyle()">
                      <label id="label-P" for="P" class="flex-1 text-center py-2.5 border rounded-xl cursor-pointer text-sm font-bold text-gray-400 bg-gray-50 transition-all">Perempuan</label>
                    </div>
                  </div>
                </div>

                <div>
                  <label class="block text-sm font-semibold text-gray-700 mb-2">Program Studi / Jurusan</label>
                  <select name="asal_prodi" required class="w-full px-4 py-2.5 rounded-xl border border-gray-300 focus:ring-2 focus:ring-red-100 focus:border-[#8B1E1E] outline-none transition bg-white">
                    <option value="">Pilih Program Studi</option>
                    <option value="Informatika">Informatika</option>
                    <option value="Sistem Informasi">Sistem Informasi</option>
                    <option value="Teknik Industri">Teknik Industri</option>
                    <option value="Sains Data">Sains Data</option>
                    <option value="Manajemen">Manajemen</option>
                    <option value="Akuntansi">Akuntansi</option>
                  </select>
                </div>

                <div class="grid md:grid-cols-2 gap-4">
                  <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Divisi Utama</label>
                    <select name="pilihan_divisi_1" class="w-full px-4 py-2.5 rounded-xl border border-gray-300 focus:ring-2 focus:ring-red-100 focus:border-[#8B1E1E] outline-none transition bg-white" required>
                      <option value="">-- Pilih Divisi Utama --</option>
                      @if(isset($divisi_kegiatan))
                        @foreach($divisi_kegiatan as $divisi)
                          @if(($divisi->kuota ?? 0) > 0)
                            <option value="{{ $divisi->nama_divisi }}">{{ $divisi->nama_divisi }}</option>
                          @endif
                        @endforeach
                      @endif
                    </select>
                  </div>
                  <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Divisi Cadangan</label>
                    <select name="pilihan_divisi_2" class="w-full px-4 py-2.5 rounded-xl border border-gray-300 focus:ring-2 focus:ring-red-100 focus:border-[#8B1E1E] outline-none transition bg-white" required>
                      <option value="">-- Pilih Divisi Cadangan --</option>
                      @if(isset($divisi_kegiatan))
                        @foreach($divisi_kegiatan as $divisi)
                          @if(($divisi->kuota ?? 0) > 0)
                            <option value="{{ $divisi->nama_divisi }}">{{ $divisi->nama_divisi }}</option>
                          @endif
                        @endforeach
                      @endif
                    </select>
                  </div>
                </div>

                <div>
                  <label class="block text-sm font-semibold text-gray-700 mb-2">Link Portofolio</label>
                  <input type="url" name="portofolio" placeholder="https://drive.google.com/..." class="w-full px-4 py-2.5 rounded-xl border border-gray-300 focus:ring-2 focus:ring-red-100 focus:border-[#8B1E1E] outline-none transition" required>
                </div>

                <div>
                  <label class="block text-sm font-semibold text-gray-700 mb-2">Pengalaman & Alasan Mengikuti Program</label>
                  <textarea name="pengalaman_keahlian" rows="4" class="w-full px-4 py-2.5 rounded-xl border border-gray-300 focus:ring-2 focus:ring-red-100 focus:border-[#8B1E1E] outline-none transition" placeholder="Ceritakan pengurus organisasi atau motivasimu mengikuti program SLB..." required></textarea>
                </div>
              </div>

              {{-- STEP 2: ADMINISTRASI & BUKTI TRANSFER --}}
              <div id="step-2" class="hidden space-y-5">
                <div class="bg-red-50 p-5 rounded-2xl border border-red-100 text-center font-bold text-red-700 text-sm md:text-base">
                  BIAYA REGISTRASI: RP 50.000<br>
                  <span class="text-xs text-red-500 font-semibold tracking-wide uppercase block mt-1">BCA 12345678 A/N UPN MENGAJAR</span>
                </div>
                <div>
                  <label class="block text-sm font-semibold text-gray-700 mb-2">Metode Transfer</label>
                  <select name="metode_pembayaran" class="w-full px-4 py-2.5 rounded-xl border border-gray-300 focus:ring-2 focus:ring-red-100 focus:border-[#8B1E1E] outline-none transition bg-white" required>
                    <option value="BCA">Bank BCA</option>
                    <option value="BNI">Bank BNI</option>
                    <option value="MANDIRI">Bank Mandiri</option>
                  </select>
                </div>
                <div>
                  <label class="block text-sm font-semibold text-gray-700 mb-2">Upload Bukti Transfer</label>
                  <div class="border-2 border-dashed border-gray-200 rounded-2xl p-8 text-center relative hover:border-red-400 transition group bg-gray-50">
                    <input type="file" name="bukti_pembayaran" class="absolute inset-0 opacity-0 cursor-pointer" required onchange="document.getElementById('file-name').innerText = 'Berkas dipilih: ' + this.files[0].name">
                    <p id="file-name" class="text-gray-500 font-semibold text-sm group-hover:text-[#8B1E1E] transition">Klik atau Seret Berkas Gambar di Sini</p>
                  </div>
                </div>
              </div>

              {{-- STEP 3: LEMBAR KONFIRMASI PERSETUJUAN --}}
              <div id="step-3" class="hidden space-y-5 text-center">
                <div class="w-14 h-14 bg-green-50 text-green-600 rounded-full flex items-center justify-center mx-auto mb-2">
                  <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                </div>
                <h4 class="text-lg font-bold text-gray-900">Konfirmasi Lembar Persetujuan</h4>
                <div class="bg-gray-50 p-5 rounded-xl text-left text-xs md:text-sm text-gray-600 border border-gray-100 space-y-2 leading-relaxed">
                  <p>1. Saya berkomitmen penuh untuk mengikuti seluruh rangkaian program kerelawanan SLB.</p>
                  <p>2. Seluruh data berkas dan bukti pembayaran yang dilampirkan adalah benar dan dapat dipertanggungjawabkan.</p>
                </div>
                <label class="flex items-center gap-3 p-4 bg-gray-50 rounded-xl cursor-pointer border hover:border-red-200 transition text-left">
                  <input type="checkbox" name="persetujuan" class="w-5 h-5 accent-[#8B1E1E] rounded-md" required>
                  <span class="text-xs md:text-sm font-medium text-gray-600 select-none">Saya menyatakan setuju dengan seluruh ketentuan di atas.</span>
                </label>
              </div>

              {{-- BOTTOM CONTROLS FORM NAVIGASI --}}
              <div class="flex justify-between items-center pt-4 border-t border-gray-100">
                <button type="button" id="prevBtn" onclick="move(-1)" class="hidden text-gray-500 font-bold text-sm hover:text-[#8B1E1E] transition">← Kembali</button>
                <div class="flex-1"></div>
                <button type="button" id="nextBtn" onclick="move(1)" class="bg-[#8B1E1E] hover:bg-red-900 text-white font-bold py-2.5 px-8 rounded-xl transition shadow-sm text-sm">Lanjut</button>
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
      <div class="bg-[#6e1515] px-6 md:px-20 py-4 text-center text-sm text-gray-200">
        <p>© 2026 UPN Mengajar — UKM Penalaran & Kreativitas UPN "Veteran" Jawa Timur</p>
      </div>
    </footer>

    {{-- INTERAKTIVITAS LOGIC MULTI-STEP JAVASCRIPT --}}
    <script>
      const header = document.querySelector("header");
      window.addEventListener("scroll", function () {
        if (window.scrollY > 50) { header.classList.add("bg-red-900", "shadow-lg"); } 
        else { header.classList.remove("bg-red-900", "shadow-lg"); }
      });

      let step = 1;

      function move(n) {
        if (n === 1) {
          const currentStepDiv = document.getElementById(`step-${step}`);
          const requiredInputs = currentStepDiv.querySelectorAll("input[required], select[required], textarea[required]");
          
          const isRadioValid = step !== 1 || document.querySelector('input[name="jenis_kelamin"]:checked');
          
          let allFilled = true;
          requiredInputs.forEach(input => { 
            if (!input.value || !input.checkValidity()) {
              allFilled = false;
              input.reportValidity();
            } 
          });

          if (!allFilled || !isRadioValid) { 
            if(!isRadioValid && allFilled) alert("Silakan pilih Jenis Kelamin terlebih dahulu!");
            return false; 
          }
        }

        if (step + n > 3) {
          document.getElementById('formRelawan').submit();
          return true;
        }

        document.getElementById(`step-${step}`).classList.add("hidden");
        step += n;
        
        document.getElementById(`step-${step}`).classList.remove("hidden");
        document.getElementById("prevBtn").classList.toggle("hidden", step === 1);
        
        const nextBtn = document.getElementById("nextBtn");
        if (step === 3) {
          nextBtn.innerText = "Kirim Pendaftaran";
        } else {
          nextBtn.innerText = "Lanjut";
        }

        for(let i = 1; i <= 3; i++) {
          const dot = document.getElementById(`dot-${i}`);
          if (i === step) {
            dot.className = "w-8 h-2 rounded-full bg-red-600 transition-all duration-300";
          } else if (i < step) {
            dot.className = "w-4 h-2 rounded-full bg-red-800 transition-all duration-300";
          } else {
            dot.className = "w-4 h-2 rounded-full bg-gray-200 transition-all duration-300";
          }
        }
      }

      function updateGenderStyle() {
        const labelL = document.getElementById('label-L');
        const labelP = document.getElementById('label-P');
        const radioL = document.getElementById('L');
        const radioP = document.getElementById('P');

        if (radioL.checked) {
          labelL.className = "flex-1 text-center py-2.5 border border-red-600 rounded-xl cursor-pointer text-sm font-bold text-red-600 bg-red-50 transition-all";
          labelP.className = "flex-1 text-center py-2.5 border border-gray-200 rounded-xl cursor-pointer text-sm font-bold text-gray-400 bg-gray-50 transition-all";
        } else if (radioP.checked) {
          labelP.className = "flex-1 text-center py-2.5 border border-red-600 rounded-xl cursor-pointer text-sm font-bold text-red-600 bg-red-50 transition-all";
          labelL.className = "flex-1 text-center py-2.5 border border-gray-200 rounded-xl cursor-pointer text-sm font-bold text-gray-400 bg-gray-50 transition-all";
        }
      }
    </script>
  </body>
</html>