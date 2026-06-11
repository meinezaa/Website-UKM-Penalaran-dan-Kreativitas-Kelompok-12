<!doctype html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Detail Kegiatan - {{ $kegiatan->nama_kegiatan }}</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <link rel="stylesheet" href="{{ asset('dist/output.css') }}">

    <style>
        body { font-family: 'Poppins', sans-serif; background-color: #F8FAFC; margin: 0; padding: 0; color: #1E293B; }
        .main-container { max-w: 1200px; margin: 0 auto; padding: 0 24px; }
        
        .jumbotron-detail {
            padding-top: 80px; 
            height: 240px; 
            width: 100%; 
            display: flex; 
            align-items: center; 
            background: linear-gradient(rgba(139, 30, 30, 0.85), rgba(30, 41, 59, 0.9)), url('{{ asset("foto/" . $kegiatan->foto_kegiatan) }}');
            background-size: cover;
            background-position: center;
            color: white;
        }

        .badge-status-admin {
            padding: 4px 12px; font-size: 11px; font-weight: 700; border-radius: 6px; text-transform: uppercase; letter-spacing: 0.05em; display: inline-block;
        }
        .bg-buka { background-color: #DEF7EC; color: #03543F; border: 1px solid #84E1BC; }
        .bg-berjalan { background-color: #EBF5FF; color: #1E429F; border: 1px solid #A4CAFE; }
        .bg-selesai { background-color: #F3F4F6; color: #374151; border: 1px solid #D1D5DB; }
    </style>
</head>
<body>

    <header class="fixed top-0 left-0 w-full z-50 transition-all duration-300">
        <div class="flex items-center justify-between px-6 py-0.5 text-white">
            <div class="flex items-center">
                <a href="{{ url('/') }}" class="overflow-hidden">
                    <img src="{{ asset('foto/logo.jpeg') }}" alt="Logo UPN Mengajar" class="w-16 scale-125">
                </a>
            </div>
            <div class="flex items-center gap-12">
                <nav>
                    <ul class="flex gap-12 font-poppins font-semibold">
                        <li><a href="{{ url('/') }}" class="relative after:absolute after:left-0 after:-bottom-1 after:h-[1.5px] after:w-0 after:bg-white after:transition-all after:duration-300 hover:after:w-full">Home</a></li>
                        <li class="relative group">
                            <a href="#" class="flex items-center gap-1 relative after:absolute after:left-0 after:-bottom-1 after:h-[1.5px] after:w-0 after:bg-white after:transition-all after:duration-300 hover:after:w-full">Tentang
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 transition-transform duration-200 group-hover:rotate-180" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                            </a>
                            <ul class="absolute left-0 mt-3 w-max bg-white text-gray-600 text-sm shadow-md opacity-0 invisible -translate-y-2 group-hover:opacity-100 group-hover:visible group-hover:translate-y-0 transition-all duration-300 ease-out">
                                <li><a href="{{ url('/ukm') }}" class="block px-5 py-2 hover:bg-gray-100">UKM Penalaran dan Kreativitas</a></li>
                                <li><a href="{{ url('/upnmengajar') }}" class="block px-5 py-2 hover:bg-gray-100">Program Kerja UPN Mengajar</a></li>
                                <li><a href="{{ url('/tim') }}" class="block px-5 py-2 hover:bg-gray-100">Tim UPN Mengajar</a></li>
                            </ul>
                        </li>
                        <li><a href="{{ url('/kegiatan') }}" class="relative after:w-full after:absolute after:left-0 after:-bottom-1 after:h-[1.5px] after:bg-white after:transition-all after:duration-300">Kegiatan</a></li>
                        <li><a href="{{ url('/formulir') }}" class="relative after:w-0 after:absolute after:left-0 after:-bottom-1 after:h-[1.5px] after:bg-white after:transition-all after:duration-300 hover:after:w-full">Relawan</a></li>
                        @if(session('role') === 'admin')
                        <li><a href="{{ route('admin.dashboard') }}" class="relative after:absolute after:left-0 after:-bottom-1 after:h-[1.5px] after:w-0 after:bg-white after:transition-all after:duration-300 hover:after:w-full">Dashboard Admin</a></li>
                        @endif
                    </ul>
                </nav>
                <div class="relative group">
                    @if (session('id_user'))
                        <a href="#" class="hover:text-red-400 transition-all duration-300"><svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" /></svg></a>
                    @else
                        <a href="{{ url('/login') }}" class="hover:text-gray-300 transition-all duration-300"><svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A9 9 0 1118.879 17.804M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg></a>
                    @endif
                </div>
            </div>
        </div>
    </header>

    <section class="jumbotron-detail">
        <div class="main-container w-full flex flex-col items-start gap-2">
            <div class="badge-status-admin {{ $kegiatan->status_kegiatan === 'buka' ? 'bg-buka' : ($kegiatan->status_kegiatan === 'berjalan' ? 'bg-berjalan' : 'bg-selesai') }}">
                ● {{ $kegiatan->status_kegiatan === 'buka' ? 'Registrasi Dibuka' : ($kegiatan->status_kegiatan === 'berjalan' ? 'Sedang Berlangsung' : 'Sudah Selesai') }}
            </div>
            <h1 class="m-0 text-2xl md:text-3xl font-extrabold text-white tracking-tight drop-shadow-sm">
                {{ $kegiatan->nama_kegiatan }}
            </h1>
            <p class="text-xs text-red-200 m-0">ID Kegiatan: #{{ $kegiatan->id_kegiatan }} • Kategori: {{ $kegiatan->kategori ?? 'Umum' }}</p>
        </div>
    </section>

    <main class="main-container my-8">
        
        <div class="mb-5">
            <a href="{{ url('/kegiatan') }}" class="inline-flex items-center gap-1.5 text-xs font-semibold text-slate-500 hover:text-[#8B1E1E] transition-colors">
                ← Kembali ke List Eksplorasi
            </a>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 items-start">
            
            <div class="space-y-6">
                <div class="bg-white p-3 rounded-xl border border-slate-200 shadow-sm overflow-hidden">
                    <img src="{{ asset('foto/' . $kegiatan->foto_kegiatan) }}" alt="{{ $kegiatan->nama_kegiatan }}" class="w-full h-52 md:h-72 object-cover rounded-lg shadow-inner">
                </div>

                <div class="bg-white p-5 rounded-xl border border-slate-200 shadow-sm space-y-2.5">
                    <h3 class="text-xs font-bold text-slate-800 uppercase tracking-wider border-b border-slate-100 pb-2 m-0 flex items-center gap-1.5">
                        <span>📋</span> Deskripsi Lengkap Program
                    </h3>
                    <div class="text-xs text-slate-600 leading-relaxed whitespace-pre-line m-0 font-normal">
                        {{ $kegiatan->deskripsi_detail }}
                    </div>
                </div>

                <div class="bg-white p-5 rounded-xl border border-slate-200 shadow-sm space-y-2.5">
                    <h3 class="text-xs font-bold text-slate-800 uppercase tracking-wider border-b border-slate-100 pb-2 m-0 flex items-center gap-1.5">
                        <span>🚀</span> Detail Aktivitas & Beban Kerja Relawan
                    </h3>
                    <div class="text-xs text-slate-600 leading-relaxed whitespace-pre-line m-0 font-normal">
                        {{ $kegiatan->detail_aktivitas ?? 'Detail aktivitas lapangan belum ditambahkan oleh administrator.' }}
                    </div>
                </div>
            </div>

            <div class="space-y-6">
                
                <div class="bg-white p-5 rounded-xl border border-slate-200 shadow-sm space-y-4">
                    <h3 class="text-xs font-bold text-slate-800 uppercase tracking-wider border-b border-slate-100 pb-2 m-0 flex items-center gap-1.5">
                        <span>📍</span> Parameter & Tempat Pelaksanaan
                    </h3>
                    
                    <div class="grid grid-cols-2 gap-3 text-xs">
                        <div class="bg-slate-50 p-3 rounded-lg border border-slate-100">
                            <span class="text-[10px] text-slate-400 font-bold uppercase block mb-0.5">Lokasi Utama</span>
                            <strong class="text-slate-800 font-semibold block">{{ $kegiatan->lokasi }}</strong>
                        </div>
                        <div class="bg-slate-50 p-3 rounded-lg border border-slate-100">
                            <span class="text-[10px] text-slate-400 font-bold uppercase block mb-0.5">Jam Operasional</span>
                            <span class="text-slate-700 font-medium block">🕒 {{ $kegiatan->jam_kegiatan ?? '08:00 WIB' }}</span>
                        </div>
                    </div>

                    <div class="bg-slate-50 p-3 rounded-lg border border-slate-100 text-xs">
                        <span class="text-[10px] text-slate-400 font-bold uppercase block mb-0.5">Alamat Lengkap</span>
                        <p class="text-slate-600 m-0 leading-relaxed font-normal">{{ $kegiatan->alamat_lengkap ?? 'Alamat lengkap lokasi belum diisi.' }}</p>
                    </div>

                    <div class="bg-red-50/60 p-3 rounded-lg border border-red-100 text-xs">
                        <span class="text-[10px] text-[#8B1E1E] font-bold uppercase block mb-0.5">🤝 Divisi yang Dibutuhkan</span>
                        <p class="text-red-900 font-semibold m-0">{{ $kegiatan->divisi_dibutuhkan ?? 'Divisi Pengajar, Logistik, Dokumentasi' }}</p>
                    </div>
                </div>

                <div class="bg-white p-5 rounded-xl border border-slate-200 shadow-sm">
                    <h3 class="text-xs font-bold text-slate-800 uppercase tracking-wider mb-3.5 m-0 flex items-center gap-1.5">
                        <span>📅</span> Log Linimasa Sistem
                    </h3>
                    <div class="grid grid-cols-2 gap-3 text-xs">
                        <div class="bg-slate-50 p-2.5 rounded-lg border border-slate-100">
                            <span class="text-[9px] text-emerald-600 uppercase font-bold block mb-0.5">🟢 Pendaftaran Buka</span>
                            <strong class="text-slate-700 block">{{ $kegiatan->pendaftaran_dibuka ? \Carbon\Carbon::parse($kegiatan->pendaftaran_dibuka)->translatedFormat('d M Y') : '-' }}</strong>
                        </div>
                        <div class="bg-slate-50 p-2.5 rounded-lg border border-slate-100">
                            <span class="text-[9px] text-red-600 uppercase font-bold block mb-0.5">🔴 Batas Registrasi</span>
                            <strong class="text-slate-700 block">{{ \Carbon\Carbon::parse($kegiatan->batas_registrasi)->translatedFormat('d M Y') }}</strong>
                        </div>
                        <div class="bg-slate-50 p-2.5 rounded-lg border border-slate-100">
                            <span class="text-[9px] text-amber-600 uppercase font-bold block mb-0.5">🟡 Pengumuman Seleksi</span>
                            <strong class="text-slate-700 block">{{ $kegiatan->pengumuman_seleksi ? \Carbon\Carbon::parse($kegiatan->pengumuman_seleksi)->translatedFormat('d M Y') : '-' }}</strong>
                        </div>
                        <div class="bg-slate-50 p-2.5 rounded-lg border border-slate-100">
                            <span class="text-[9px] text-blue-600 uppercase font-bold block mb-0.5">🔵 Tanggal Pelaksanaan</span>
                            <strong class="text-slate-700 block">{{ \Carbon\Carbon::parse($kegiatan->tanggal_pelaksanaan ?? $kegiatan->batas_registrasi)->translatedFormat('d M Y') }}</strong>
                        </div>
                    </div>
                </div>

                <div class="bg-white p-5 rounded-xl border border-slate-200 shadow-sm">
                    <h4 class="text-xs font-bold text-slate-800 uppercase tracking-wider m-0 mb-3">⚡ Gerbang Pendaftaran Relawan</h4>
                    
                    @if($kegiatan->status_kegiatan !== 'buka')
                        <div class="p-3 bg-red-50 text-red-900 border border-red-200 rounded-lg text-xs leading-relaxed font-medium">
                            🔒 <strong>Pendaftaran Ditutup</strong><br>Mohon maaf, sistem telah mengunci pengisian formulir karena periode agenda ini sudah terlewati.
                        </div>
                    @elseif(!session('id_user'))
                        <div class="space-y-3">
                            <div class="p-3 bg-amber-50 text-amber-900 border border-amber-200 rounded-lg text-xs leading-relaxed font-medium">
                                ⚠️ <strong>Autentikasi Diperlukan</strong><br>Sistem mendeteksi Anda belum masuk. Silakan login terlebih dahulu untuk mengakses formulir pendaftaran.
                            </div>
                            <a href="{{ url('/login') }}" class="block w-full py-2.5 text-center text-xs font-bold text-white bg-[#8B1E1E] hover:bg-[#701717] rounded-lg transition-colors shadow-sm">
                                Masuk / Login Akun
                            </a>
                        </div>
                    @else
                        <div class="space-y-3">
                            <div class="p-3 bg-emerald-50 text-emerald-900 border border-emerald-200 rounded-lg text-xs leading-relaxed">
                                Sesi Relawan Aktif. Anda dapat langsung mengirimkan berkas data pendaftaran untuk program kerja ini.
                            </div>
                            <a href="{{ url('/formulir?kegiatan=' . $kegiatan->id_kegiatan) }}" class="block w-full py-2.5 text-center text-xs font-bold text-white bg-emerald-600 hover:bg-emerald-700 rounded-lg transition-colors shadow-sm">
                                Ajukan Formulir Relawan Sekarang ✨
                            </a>
                        </div>
                    @endif
                </div>

            </div>
        </div>
    </main>

    <footer class="bg-[#8B1E1E] text-white pt-16">
        <div class="max-w-7xl mx-auto px-6 md:px-20 grid md:grid-cols-3 gap-10 pb-10">
            <div class="md:border-r md:border-red-300 md:pr-10">
                <div class="w-24 h-24 overflow-hidden mb-5">
                    <img src="{{ asset('foto/logo.jpeg') }}" class="w-full h-full object-cover scale-150">
                </div>
                <h4 class="font-semibold mb-3 text-lg">Menu</h4>
                <ul class="space-y-2 text-sm">
                    <li><a href="{{ url('/') }}" class="hover:underline">Home</a></li>
                    <li><a href="{{ url('/ukm') }}" class="hover:underline">Tentang</a></li>
                    <li><a href="{{ url('/kegiatan') }}" class="hover:underline">Kegiatan</a></li>
                    <li><a href="{{ url('/formulir') }}" class="hover:underline">Relawan</a></li>
                </ul>
            </div>
            <div class="text-center md:border-r md:border-red-300 md:px-10">
                <h4 class="font-semibold mb-2 text-lg">Send Message</h4>
                <p class="text-xs text-gray-200 mb-4">Pesan akan dikirim ke email UPN Mengajar</p>
                <form action="mailto:upnmengajar.jt@gmail.com" method="post" enctype="text/plain" class="space-y-3">
                    <input type="text" name="nama" placeholder="Nama" class="w-full px-3 py-2 rounded text-black text-sm">
                    <input type="email" name="email" placeholder="Email" class="w-full px-3 py-2 rounded text-black text-sm">
                    <textarea name="pesan" placeholder="Pesan" rows="3" class="w-full px-3 py-2 rounded text-black text-sm"></textarea>
                    <div class="text-left"><button type="submit" class="bg-white text-[#8B1E1E] px-5 py-2 rounded text-sm font-semibold hover:bg-gray-200 transition">Kirim</button></div>
                </form>
            </div>
            <div class="md:pl-10">
                <h4 class="font-semibold mb-4 text-lg">Contact Us</h4>
                <div class="space-y-3 text-sm">
                    <div class="flex items-center gap-2"><img src="{{ asset('foto/email.png') }}" class="w-5 h-6"><a href="mailto:upnmengajar.jt@gmail.com" class="hover:underline">upnmengajar.jt@gmail.com</a></div>
                    <div class="flex items-center gap-2"><img src="{{ asset('foto/instagram.png') }}" class="w-5 h-6"><a href="https://instagram.com/upnmengajar.jt" class="hover:underline">@upnmengajar.jt</a></div>
                    <div class="flex items-center gap-2"><img src="{{ asset('foto/whatsapp.png') }}" class="w-5 h-6"><a href="https://wa.me/6289699808453" class="hover:underline">089699808453 (Nabila)</a></div>
                </div>
            </div>
        </div>
        <div class="bg-[#6e1515] px-6 md:px-20 py-4 flex flex-col md:flex-row justify-between text-sm text-gray-200">
            <p>© 2026 UPN Mengajar — UKM Penalaran & Kreativitas UPN "Veteran" Jawa Timur</p>
            <p>Website by <span class="font-semibold">Vina • Naila • Inez Sistem Informasi UPNVJT 2024</span></p>
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