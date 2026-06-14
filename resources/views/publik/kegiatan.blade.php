<!doctype html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Eksplorasi Kegiatan - Website UKM Penalaran</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Instrument+Serif:ital@0;1&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    
    <link rel="stylesheet" href="{{ asset('dist/output.css') }}">

    <style>
        body { font-family: 'Poppins', sans-serif; background-color: #F8FAFC; margin: 0; padding: 0; color: #1E293B; }
        .main-container { max-w: 1200px; margin: 0 auto; padding: 0 24px; }
        
        .jumbotron-section {
            padding-top: 100px; 
            padding-bottom: 40px;
            width: 100%; 
            display: flex; 
            align-items: center; 
            justify-content: center; 
            text-align: center;
            background: linear-gradient(135deg, #7f1d1d 0%, #b91c1c 100%);
            color: white;
        }

        /* Navigasi Filter Kapsul Slider */
        .filter-navigation { 
            display: flex; justify-content: center; gap: 12px; margin-top: 40px; margin-bottom: 32px;
            padding: 6px; position: relative; background-color: #E2E8F0; border-radius: 99px; 
            width: max-content; margin-left: auto; margin-right: auto;
        }

        .tab-link { 
            font-family: 'Poppins', sans-serif; font-size: 13px; font-weight: 500;
            color: #475569; background: none; border: none; padding: 8px 20px; border-radius: 99px;
            cursor: pointer; transition: color 0.3s ease, font-weight 0.3s ease; position: relative; z-index: 2; 
        }
        .tab-link.active { color: #FFFFFF; font-weight: 600; }

        .sliding-bg {
            position: absolute; top: 6px; left: 0; height: calc(100% - 12px); 
            background-color: #8B1E1E; border-radius: 99px;
            transition: all 0.35s cubic-bezier(0.4, 0, 0.2, 1); z-index: 1; pointer-events: none;
            box-shadow: 0 4px 12px rgba(139, 30, 30, 0.2);
        }

        /* Grid Utama */
        .grid-kegiatan { 
            display: grid; grid-template-columns: repeat(auto-fill, minmax(275px, 1fr)); gap: 24px; margin-bottom: 60px;
        }

        /* Ukuran Card Rata */
        .card-kegiatan { 
            background: #ffffff; border-radius: 24px; overflow: hidden; border: 1px solid #F1F5F9; 
            display: flex; flex-direction: column; justify-content: flex-start;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1); box-shadow: 0 4px 18px rgba(15, 23, 42, 0.03);
            height: 100%;
        }
        .card-kegiatan:hover { transform: translateY(-6px); box-shadow: 0 12px 30px rgba(15, 23, 42, 0.08); }
        
        .img-container { width: auto; aspect-ratio: 1.4 / 1; margin: 12px 12px 0 12px; position: relative; border-radius: 16px; overflow: hidden; background-color: #F8FAFC; }
        .img-container img { width: 100%; height: 100%; object-fit: cover; }
        
        .badge-status { position: absolute; top: 12px; right: 12px; padding: 4px 10px; font-size: 9px; font-weight: 700; color: white; border-radius: 8px; text-transform: uppercase; letter-spacing: 0.05em; }
        .bg-buka { background-color: #10B981; }
        .bg-berjalan { background-color: #3B82F6; }
        .bg-selesai { background-color: #64748B; }

        .card-body { padding: 12px 14px 4px 14px; display: flex; flex-direction: column; gap: 6px; }
        
        .card-title { font-size: 14px; font-weight: 700; color: #0F172A; margin: 0; line-height: 1.3; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; height: 38px; }
        .card-dates { display: flex; flex-direction: column; gap: 3px; background-color: #F8FAFC; padding: 6px 10px; border-radius: 10px; border: 1px solid #F1F5F9; margin: 0; height: 44px; box-sizing: border-box; }
        .date-item { display: flex; align-items: center; gap: 6px; font-size: 11px; color: #475569; line-height: 1.3; }
        .date-item strong { font-weight: 600; color: #1E293B; }

        .meta-space-category { display: flex; justify-content: space-between; align-items: center; gap: 8px; font-size: 11px; padding: 2px 0; margin-top: 2px; height: 22px; box-sizing: border-box; }
        .place-info { display: flex; align-items: center; gap: 4px; color: #64748B; font-weight: 500; max-width: 62%; overflow: hidden; text-overflow: ellipsis; white-space: nowrap; }
        
        .tag-kategori { font-size: 9px; font-weight: 600; text-transform: uppercase; letter-spacing: 0.03em; color: #A855F7; background-color: #F3E8FF; padding: 3px 8px; border-radius: 6px; max-width: 35%; overflow: hidden; text-overflow: ellipsis; white-space: nowrap; }
        .tag-berjalan { color: #3B82F6; background-color: #EFF6FF; }
        .tag-selesai { color: #64748B; background-color: #F1F5F9; }

        .card-desc { font-size: 11px; color: #64748B; margin: 0; line-height: 1.45; display: -webkit-box; -webkit-line-clamp: 3; -webkit-box-orient: vertical; overflow: hidden; height: 48px; }
        
        .card-footer { padding: 6px 14px 14px 14px; box-sizing: border-box; margin-top: auto; }
        
        .btn-action { 
            display: block; text-align: center; width: 100%; background-color: #8B1E1E; color: white; text-decoration: none; 
            font-size: 12px; font-weight: 600; height: 36px; line-height: 36px; border-radius: 10px; transition: all 0.2s ease; 
            border: none; cursor: pointer; box-sizing: border-box; padding: 0;
        }
        .btn-action:hover { background-color: #701717; box-shadow: 0 4px 12px rgba(139, 30, 30, 0.2); }
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
                        <li>
                            <a href="{{ url('/') }}" class="relative {{ request()->is('/') ? 'after:w-full' : 'after:w-0' }} after:absolute after:left-0 after:-bottom-1 after:h-[1.5px] after:bg-white after:transition-all after:duration-300 hover:after:w-full">
                                Home
                            </a>
                        </li>

                        <li class="relative group">
                            <a href="#" class="flex items-center gap-1 relative after:absolute after:left-0 after:-bottom-1 after:h-[1.5px] after:w-0 after:bg-white after:transition-all after:duration-300 hover:after:w-full">
                                Tentang
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 transition-transform duration-200 group-hover:rotate-180" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                </svg>
                            </a>
                            <ul class="absolute left-0 mt-3 w-max bg-white text-gray-600 text-sm shadow-md opacity-0 invisible -translate-y-2 group-hover:opacity-100 group-hover:visible group-hover:translate-y-0 transition-all duration-300 ease-out">
                                <li><a href="{{ url('/ukm') }}" class="block px-5 py-2 hover:bg-gray-100">UKM Penalaran dan Kreativitas</a></li>
                                <li><a href="{{ url('/upnmengajar') }}" class="block px-5 py-2 hover:bg-gray-100">Program Kerja UPN Mengajar</a></li>
                                <li><a href="{{ url('/tim') }}" class="block px-5 py-2 hover:bg-gray-100">Tim UPN Mengajar</a></li>
                            </ul>
                        </li>

                        <li>
                            <a href="{{ url('/kegiatan') }}" class="relative {{ request()->is('kegiatan*') ? 'after:w-full' : 'after:w-0' }} after:absolute after:left-0 after:-bottom-1 after:h-[1.5px] after:bg-white after:transition-all after:duration-300 hover:after:w-full">
                                Kegiatan
                            </a>
                        </li>

                        <li>
                            <a href="{{ url('/relawan') }}" class="relative {{ request()->is('relawan*') ? 'after:w-0' : 'after:w-0' }} after:absolute after:left-0 after:-bottom-1 after:h-[1.5px] after:bg-white after:transition-all after:duration-300 hover:after:w-full">

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
                        <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="hover:text-red-400 transition-all duration-300">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" /></svg>
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                        <div class="absolute -bottom-12 left-1/2 -translate-x-1/2 bg-black/80 backdrop-blur-sm text-white text-[11px] px-4 py-2 opacity-0 group-hover:opacity-100 transition-all duration-300 whitespace-nowrap rounded-lg shadow-2xl border border-white/10">Keluar</div>
                    @else
                        <a href="{{ url('/login') }}" class="hover:text-gray-300 transition-all duration-300">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A9 9 0 1118.879 17.804M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                        </a>
                        <div class="absolute -bottom-12 left-1/2 -translate-x-1/2 bg-black/80 backdrop-blur-sm text-white text-[11px] px-4 py-2 opacity-0 group-hover:opacity-100 transition-all duration-300 whitespace-nowrap rounded-lg shadow-2xl border border-white/10">Masuk / Daftar</div>
                    @endif
                </div>

            </div>
        </div>
    </header>

    <section class="jumbotron-section">
        <div class="w-full max-w-4xl px-6 flex flex-col items-center">
            <h1 style="margin: 0 0 6px 0; font-size: 34px; font-weight: 700;">Eksplorasi Kegiatan Relawan</h1>
            <p style="margin: 0 0 24px 0; font-size: 14px; color: #fca5a5; font-style: italic; font-weight: 300;">Ikuti aksi nyata dan berkontribusi langsung bagi pendidikan bangsa</p>
            
            <div class="w-full max-w-2xl bg-white/10 backdrop-blur-md border border-white/15 rounded-2xl p-4 shadow-inner flex items-center gap-3.5 text-left">
                <div class="p-2 bg-amber-400 text-slate-950 rounded-xl shadow-md shrink-0">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                    </svg>
                </div>
                <div>
                    <h4 class="text-xs font-bold text-amber-300 tracking-wide uppercase m-0">Syarat Pendaftaran Relawan</h4>
                    <p class="text-xs text-gray-100 font-medium leading-relaxed mt-0.5 m-0">
                        Calon relawan <span class="font-bold underline text-white">wajib memiliki akun dan login terlebih dahulu</span> untuk melihat detail serta mengisi formulir registrasi program kerja.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <div class="main-container">

        <div class="filter-navigation">
            <button onclick="filterKegiatan('semua')" id="btn-semua" class="tab-link active">Semua Kegiatan</button>
            <button onclick="filterKegiatan('buka')" id="btn-buka" class="tab-link">Registrasi Dibuka</button>
            <button onclick="filterKegiatan('berjalan')" id="btn-berjalan" class="tab-link">Sedang Berlangsung</button>
            <button onclick="filterKegiatan('selesai')" id="btn-selesai" class="tab-link">Sudah Selesai</button>
            <div class="sliding-bg" id="floating-bg"></div>
        </div>

        <div id="container-kegiatan" class="grid-kegiatan">
            
            {{-- DATA FILTER: REGISTRASI DIBUKA --}}
            @foreach($kegiatanBuka as $keg)
                <div class="card-kegiatan" data-status="buka">
                    <div class="img-container">
                        <img src="{{ asset('foto/' . $keg->foto_kegiatan) }}" alt="{{ $keg->nama_kegiatan }}">
                        <span class="badge-status bg-buka">BUKA</span>
                    </div>
                    <div class="card-body">
                        <h3 class="card-title" title="{{ $keg->nama_kegiatan }}">{{ $keg->nama_kegiatan }}</h3>
                        <div class="card-dates">
                            <div class="date-item">⏱️ <span><strong>Registrasi:</strong> s.d. {{ \Carbon\Carbon::parse($keg->batas_registrasi)->translatedFormat('d M Y') }}</span></div>
                            <div class="date-item">📅 <span><strong>Pelaksanaan:</strong> {{ \Carbon\Carbon::parse($keg->tanggal_pelaksanaan ?? $keg->batas_registrasi)->translatedFormat('d M Y') }}</span></div>
                        </div>
                        <div class="meta-space-category">
                            <div class="place-info" title="{{ $keg->lokasi }}">📍 <span>{{ $keg->lokasi }}</span></div>
                            <span class="tag-kategori">{{ $keg->kategori ?? 'SD / MI' }}</span>
                        </div>
                        <p class="card-desc">{{ $keg->deskripsi_detail }}</p>
                    </div>
                    <div class="card-footer">
                        <a href="{{ route('kegiatan.detail', $keg->id_kegiatan) }}" class="btn-action">Lihat Detail</a>
                    </div>
                </div>
            @endforeach

            {{-- DATA FILTER: SEDANG BERLANGSUNG --}}
            @foreach($kegiatanBerjalan as $keg)
                <div class="card-kegiatan" data-status="berjalan">
                    <div class="img-container">
                        <img src="{{ asset('foto/' . $keg->foto_kegiatan) }}" alt="{{ $keg->nama_kegiatan }}">
                        <span class="badge-status bg-berjalan">AKTIF</span>
                    </div>
                    <div class="card-body">
                        <h3 class="card-title" title="{{ $keg->nama_kegiatan }}">{{ $keg->nama_kegiatan }}</h3>
                        <div class="card-dates">
                            <div class="date-item" style="color: #94A3B8;">⏱️ <span><strong>Registrasi:</strong> Ditutup</span></div>
                            <div class="date-item">📅 <span><strong>Pelaksanaan:</strong> {{ \Carbon\Carbon::parse($keg->tanggal_pelaksanaan)->translatedFormat('d M Y') }}</span></div>
                        </div>
                        <div class="meta-space-category">
                            <div class="place-info" title="{{ $keg->lokasi }}">📍 <span>{{ $keg->lokasi }}</span></div>
                            <span class="tag-kategori tag-berjalan">{{ $keg->kategori ?? 'SMP / MTS' }}</span>
                        </div>
                        <p class="card-desc">{{ $keg->deskripsi_detail }}</p>
                    </div>
                    <div class="card-footer">
                        <a href="{{ route('kegiatan.detail', $keg->id_kegiatan) }}" class="btn-action">Lihat Detail</a>
                    </div>
                </div>
            @endforeach

            {{-- DATA FILTER: SUDAH SELESAI --}}
            @foreach($kegiatanSelesai as $keg)
                <div class="card-kegiatan" data-status="selesai">
                    <div class="img-container">
                        <img src="{{ asset('foto/' . $keg->foto_kegiatan) }}" alt="{{ $keg->nama_kegiatan }}">
                        <span class="badge-status bg-selesai">SELESAI</span>
                    </div>
                    <div class="card-body">
                        <h3 class="card-title" title="{{ $keg->nama_kegiatan }}">{{ $keg->nama_kegiatan }}</h3>
                        <div class="card-dates">
                            <div class="date-item" style="color: #94A3B8;">⏱️ <span><strong>Registrasi:</strong> Berakhir</span></div>
                            <div class="date-item">📅 <span><strong>Selesai Pada:</strong> {{ \Carbon\Carbon::parse($keg->tanggal_pelaksanaan)->translatedFormat('d M Y') }}</span></div>
                        </div>
                        <div class="meta-space-category">
                            <div class="place-info" title="{{ $keg->lokasi }}">📍 <span>{{ $keg->lokasi }}</span></div>
                            <span class="tag-kategori tag-selesai">{{ $keg->kategori ?? 'SMA / UMUM' }}</span>
                        </div>
                        <p class="card-desc">{{ $keg->deskripsi_detail }}</p>
                    </div>
                    <div class="card-footer">
                        <a href="{{ route('kegiatan.detail', $keg->id_kegiatan) }}" class="btn-action">Lihat Detail</a>
                    </div>
                </div>
            @endforeach

        </div>

        <div id="no-data-msg" style="display: none; text-align: center; padding: 48px 0; background: white; border-radius: 24px; border: 1px solid #E2E8F0; margin-bottom: 40px;">
            <p style="color: #94A3B8; font-size: 13px; font-style: italic; margin: 0;">Tidak ada agenda kegiatan relawan dalam kategori ini. 🌟</p>
        </div>

    </div>

    <footer class="bg-[#8B1E1E] text-white pt-16">
        <div class="max-w-7xl mx-auto px-6 md:px-20 grid md:grid-cols-3 gap-10 pb-10">
            <div class="md:border-r md:border-red-300 md:pr-10">
                <div class="w-24 h-24 overflow-hidden mb-5">
                    <img src="{{ asset('foto/logo.jpeg') }}" class="w-full h-full object-cover scale-150" alt="Logo">
                </div>
                <h4 class="font-semibold mb-3 text-lg">Menu</h4>
                <ul class="space-y-2 text-sm">
                    <li><a href="{{ url('/') }}" class="hover:underline">Home</a></li>
                    <li><a href="{{ url('/ukm') }}" class="hover:underline">Tentang</a></li>
                    <li><a href="{{ url('/kegiatan') }}" class="hover:underline">Kegiatan</a></li>
                    <li><a href="{{ url('/relawan') }}" class="hover:underline">Relawan</a></li>
                </ul>
            </div>

            <div class="text-center md:border-r md:border-red-300 md:px-10">
                <h4 class="font-semibold mb-2 text-lg">Send Message</h4>
                <p class="text-xs text-gray-200 mb-4">Pesan akan dikirim ke email UPN Mengajar</p>
                <form action="mailto:upnmengajar.jt@gmail.com" method="post" enctype="text/plain" class="space-y-3">
                    <input type="text" name="nama" placeholder="Nama" class="w-full px-3 py-2 rounded text-black text-sm">
                    <input type="email" name="email" placeholder="Email" class="w-full px-3 py-2 rounded text-black text-sm">
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
                        <img src="{{ asset('foto/email.png') }}" class="w-5 h-6" alt="Email">
                        <a href="mailto:upnmengajar.jt@gmail.com" class="hover:underline">upnmengajar.jt@gmail.com</a>
                    </div>
                    <div class="flex items-center gap-2">
                        <img src="{{ asset('foto/instagram.png') }}" class="w-5 h-6" alt="Instagram">
                        <a href="https://instagram.com/upnmengajar.jt" class="hover:underline">@upnmengajar.jt</a>
                    </div>
                    <div class="flex items-center gap-2">
                        <img src="{{ asset('foto/whatsapp.png') }}" class="w-5 h-6" alt="Whatsapp">
                        <a href="https://wa.me/6289699808453" class="hover:underline">089699808453 (Nabila)</a>
                    </div>
                </div>
                <div class="mt-8 text-sm text-gray-200 leading-relaxed">
                    <p class="font-semibold mb-1">Sekretariat Kami Berada di:</p>
                    <p>Universitas Pembangunan Nasional "Veteran" Jawa Timur<br>Jl. Raya Rungkut Madya, Gunung Anyar, Surabaya, Jawa Timur</p>
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
            if (window.scrollY > 50) {
                header.classList.add("bg-red-900", "shadow-lg");
            } else {
                header.classList.remove("bg-red-900", "shadow-lg");
            }
        });

        function updateSlidingBg(isInitial = false) {
            const activeBtn = document.querySelector('.tab-link.active');
            const bgContainer = document.getElementById('floating-bg');
            
            if (activeBtn && bgContainer) {
                if (isInitial) { bgContainer.style.transition = 'none'; } 
                else { bgContainer.style.transition = 'all 0.35s cubic-bezier(0.4, 0, 0.2, 1)'; }

                const rect = activeBtn.getBoundingClientRect();
                const parentRect = activeBtn.parentElement.getBoundingClientRect();
                
                bgContainer.style.width = `${rect.width}px`;
                bgContainer.style.left = `${rect.left - parentRect.left}px`;
                if (isInitial) {
                    bgContainer.offsetHeight;
                    bgContainer.style.transition = 'all 0.35s cubic-bezier(0.4, 0, 0.2, 1)';
                }
            }
        }

        function filterKegiatan(status) {
            const cards = document.querySelectorAll('.card-kegiatan');
            const buttons = document.querySelectorAll('.tab-link');
            let visibleCount = 0;

            buttons.forEach(btn => btn.classList.remove('active'));
            document.getElementById(`btn-${status}`).classList.add('active');

            updateSlidingBg(false);

            cards.forEach(card => {
                const cardStatus = card.getAttribute('data-status');
                if (status === 'semua' || cardStatus === status) {
                    card.style.display = 'flex';
                    visibleCount++;
                } else {
                    card.style.display = 'none';
                }
            });

            const noDataMsg = document.getElementById('no-data-msg');
            if (visibleCount === 0) { 
                noDataMsg.style.display = 'block'; 
            } else { 
                noDataMsg.style.display = 'none'; 
            }
        }

        // Panggil filterKegiatan('semua') di awal agar inisialisasi javascript menyinkronkan seluruh card
        window.addEventListener('DOMContentLoaded', () => { 
            updateSlidingBg(true); 
            filterKegiatan('semua');
        });
        window.addEventListener('resize', () => { updateSlidingBg(false); });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    @if(session('sukses_daftar'))
    <script>
        Swal.fire({
            title: 'Pendaftaran Berhasil!',
            text: 'Data Anda telah tersimpan. Silakan bergabung ke grup WhatsApp untuk mendapatkan pembaruan informasi selanjutnya.',
            icon: 'success',
            iconColor: '#ef4444', // Warna merah menyesuaikan tema UPN
            showCancelButton: true,
            confirmButtonColor: '#25D366', // Warna hijau khas WhatsApp
            cancelButtonColor: '#d33',
            confirmButtonText: '🟢 Gabung Grup WA',
            cancelButtonText: 'Tutup',
            allowOutsideClick: false,
            customClass: {
                popup: 'rounded-[2rem]',
                confirmButton: 'rounded-xl font-bold uppercase tracking-wider text-xs px-6 py-3',
                cancelButton: 'rounded-xl font-bold uppercase tracking-wider text-xs px-6 py-3'
            }
        }).then((result) => {
            if (result.isConfirmed) {
                // Membuka link Grup WhatsApp di tab baru jika tombol diklik
                window.open("{{ session('link_wa') }}", '_blank');
            }
        });
    </script>
    @endif
    
</body>
</html>