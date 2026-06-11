<!doctype html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Eksplorasi Kegiatan - Website UKM Penalaran</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <link rel="stylesheet" href="{{ asset('dist/output.css') }}">

<style>
    body { font-family: 'Poppins', sans-serif; background-color: #F8FAFC; margin: 0; padding: 0; color: #1E293B; }
    .main-container { max-w: 1200px; margin: 0 auto; padding: 0 24px; }
    
    /* Navigasi Filter */
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

    /* GRID UTAMA */
    .grid-kegiatan { 
        display: grid; grid-template-columns: repeat(auto-fill, minmax(275px, 1fr)); gap: 24px; margin-bottom: 60px;
    }

    /* Card Layout */
    .card-kegiatan { 
        background: #ffffff; border-radius: 24px; overflow: hidden; border: 1px solid #F1F5F9; 
        display: flex; flex-direction: column; justify-content: flex-start;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1); box-shadow: 0 4px 18px rgba(15, 23, 42, 0.03);
    }
    .card-kegiatan:hover { transform: translateY(-6px); box-shadow: 0 12px 30px rgba(15, 23, 42, 0.08); }
    
    .img-container { width: auto; aspect-ratio: 1.4 / 1; margin: 12px 12px 0 12px; position: relative; border-radius: 16px; overflow: hidden; background-color: #F8FAFC; }
    .img-container img { width: 100%; height: 100%; object-fit: cover; }
    .img-bnw { filter: grayscale(100%) !important; }
    
    .badge-status { position: absolute; top: 12px; right: 12px; padding: 4px 10px; font-size: 9px; font-weight: 700; color: white; border-radius: 8px; text-transform: uppercase; letter-spacing: 0.05em; }
    .bg-buka { background-color: #10B981; }
    .bg-berjalan { background-color: #3B82F6; }
    .bg-selesai { background-color: #64748B; }

    .card-body { padding: 12px 14px 4px 14px; display: flex; flex-direction: column; gap: 6px; }
    
    /* Kunci Tinggi Isi Konten Agar Sejajar */
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
    
 /* ==================================================================
       PERBAIKAN FOOTER: Menggunakan Grid murni dengan tinggi baris dikunci 
       ================================================================== */
    .card-footer { 
        padding: 6px 14px 14px 14px; 
        display: grid;
        grid-template-rows: 34px 34px; /* Mengunci 2 slot baris, masing-masing wajib 34px */
        gap: 6px; 
        box-sizing: border-box;
        margin-top: auto; /* Memaksa menempel ke dasar card */
    }
    
    .btn-action { 
        display: block; 
        text-align: center; 
        width: 100%; 
        background-color: #8B1E1E; 
        color: white; 
        text-decoration: none; 
        font-size: 12px; 
        font-weight: 600; 
        height: 34px; 
        line-height: 34px; /* Menyelaraskan teks tepat di tengah secara vertikal */
        border-radius: 10px; 
        transition: all 0.2s ease; 
        border: none; 
        cursor: pointer; 
        box-sizing: border-box;
        padding: 0; /* Padding dinolkan karena tinggi diatur oleh height & line-height */
    }
    .btn-action:hover { background-color: #701717; }
    .btn-disabled { background-color: #F1F5F9; color: #94A3B8; cursor: not-allowed; border: 1px solid #E2E8F0; }
    
    .btn-secondary { background-color: #FFF5F5; color: #8B1E1E; border: 1px solid #FEE2E2; }
    .btn-secondary:hover { background-color: #8B1E1E; color: #FFFFFF; border-color: #8B1E1E; }

    /* Paksa tombol "Lihat Detail" pada kategori SELESAI agar melompati baris pertama 
       dan langsung menempati baris kedua (posisi bawah) */
    .card-kegiatan[data-status="selesai"] .card-footer .btn-secondary {
        grid-row: 2;
    }
</style>

</head>
<body>
    <div style="background: #FFF; padding: 20px; border: 3px solid red; z-index: 9999; position: relative;">
    <h3>Hasil Deteksi Data Dari Controller:</h3>
    <p>Jumlah Kegiatan Buka: {{ $kegiatanBuka->count() }}</p>
    <p>Jumlah Kegiatan Berjalan: {{ $kegiatanBerjalan->count() }}</p>
    <p>Jumlah Kegiatan Selesai: {{ $kegiatanSelesai->count() }}</p>
</div>

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
                        <li><a href="/" class="relative after:absolute after:left-0 after:-bottom-1 after:h-[1.5px] after:w-0 after:bg-white after:transition-all after:duration-300 hover:after:w-full">Home</a></li>
                        <li class="relative group">
                            <a href="#" class="flex items-center gap-1 relative after:absolute after:left-0 after:-bottom-1 after:h-[1.5px] after:w-0 after:bg-white after:transition-all after:duration-300 hover:after:w-full">Tentang</a>
                            <ul class="absolute left-0 mt-3 w-max bg-white text-gray-600 text-sm shadow-md opacity-0 invisible -translate-y-2 group-hover:opacity-100 group-hover:visible group-hover:translate-y-0 transition-all duration-300 ease-out">
                                <li><a href="ukm.html" class="block px-5 py-2 hover:bg-gray-100">UKM Penalaran dan Kreativitas</a></li>
                                <li><a href="upnmengajar.html" class="block px-5 py-2 hover:bg-gray-100">Program Kerja UPN Mengajar</a></li>
                                <li><a href="struktur.html" class="block px-5 py-2 hover:bg-gray-100">Tim UPN Mengajar</a></li>
                            </ul>
                        </li>
                        <li><a href="/kegiatan" class="relative after:absolute after:right-0 after:-bottom-1 after:h-[1.5px] after:w-full after:bg-white">Kegiatan</a></li>
                        <li><a href="relawan.php" class="relative after:absolute after:left-0 after:-bottom-1 after:h-[1.5px] after:w-0 after:bg-white after:transition-all after:duration-300 hover:after:w-full">Relawan</a></li>
                        @if(session('role') === 'admin')
                        <li><a href="{{ route('admin.dashboard') }}" class="relative after:absolute after:left-0 after:-bottom-1 after:h-[1.5px] after:w-0 after:bg-white after:transition-all after:duration-300 hover:after:w-full">Dashboard Admin</a></li>
                        @endif
                    </ul>
                </nav>
                <div class="relative group">
                    @if (session('id_user'))
                        <a href="#" class="hover:text-red-400 transition-all duration-300">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" /></svg>
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="hover:text-gray-300 transition-all duration-300">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A9 9 0 1118.879 17.804M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </header>

    <section class="relative h-[220px] w-full flex items-center justify-center bg-gradient-to-br from-red-800 via-red-700 to-red-600 text-white pt-14" style="background: linear-gradient(135deg, #7f1d1d 0%, #b91c1c 100%); text-align: center; color: white;">
        <div style="padding: 0 16px;">
            <h1 style="margin: 0 0 6px 0; font-size: 26px; font-weight: 700;">Eksplorasi Kegiatan Relawan</h1>
            <p style="margin: 0; font-size: 13px; color: #fca5a5; font-style: italic; font-weight: 300;">Ikuti aksi nyata dan berkontribusi langsung bagi pendidikan bangsa</p>
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
                        <a href="/formulir?kegiatan={{ $keg->id_kegiatan }}" class="btn-action">Daftar Relawan</a>
                        <a href="/kegiatan/detail/{{ $keg->id_kegiatan }}" class="btn-action btn-secondary">Lihat Detail</a>
                    </div>
                </div>
            @endforeach

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
                        <button disabled class="btn-action btn-disabled">Pendaftaran Ditutup</button>
                        <a href="/kegiatan/detail/{{ $keg->id_kegiatan }}" class="btn-action btn-secondary">Lihat Detail</a>
                    </div>
                </div>
            @endforeach

            @foreach($kegiatanSelesai as $keg)
                <div class="card-kegiatan" data-status="selesai">
                    <div class="img-container">
                        <img src="{{ asset('foto/' . $keg->foto_kegiatan) }}" alt="{{ $keg->nama_kegiatan }}" class="img-bnw">
                        <span class="badge-status bg-selesai">SELESAI</span>
                    </div>
                    <div class="card-body">
                        <h3 class="card-title" style="color: #64748B;" title="{{ $keg->nama_kegiatan }}">{{ $keg->nama_kegiatan }}</h3>
                        
                        <div class="card-dates" style="background-color: #F1F5F9;">
                            <div class="date-item" style="color: #94A3B8;">⏱️ <span><strong>Registrasi:</strong> Berakhir</span></div>
                            <div class="date-item" style="color: #64748B;">📅 <span><strong>Selesai Pada:</strong> {{ \Carbon\Carbon::parse($keg->tanggal_pelaksanaan)->translatedFormat('d M Y') }}</span></div>
                        </div>

                        <div class="meta-space-category">
                            <div class="place-info" style="color: #94A3B8;" title="{{ $keg->lokasi }}">📍 <span>{{ $keg->lokasi }}</span></div>
                            <span class="tag-kategori tag-selesai">{{ $keg->kategori ?? 'SMA / UMUM' }}</span>
                        </div>
                        
                        <p class="card-desc" style="color: #94A3B8;">{{ $keg->deskripsi_detail }}</p>
                    </div>
                    <div class="card-footer">
                        <a href="/kegiatan/detail/{{ $keg->id_kegiatan }}" class="btn-action btn-secondary">Lihat Detail</a>
                    </div>
                </div>
            @endforeach

        </div>

        <div id="no-data-msg" class="hidden" style="text-align: center; padding: 48px 0; background: white; border-radius: 24px; border: 1px solid #E2E8F0; margin-bottom: 40px;">
            <p style="color: #94A3B8; font-size: 13px; font-style: italic; margin: 0;">Tidak ada agenda kegiatan relawan dalam kategori ini. 🌟</p>
        </div>

    </div>

    <footer class="bg-[#8B1E1E] text-white pt-16" style="background-color: #8B1E1E; color: white; padding-top: 40px; margin-top: 40px; font-size: 14px;">
        <div class="bg-[#6e1515]" style="background-color: #6e1515; text-align: center; padding: 15px; font-size: 12px; margin-top: 30px;">
            <p>© 2026 UPN Mengajar — UKM Penalaran & Kreativitas UPN "Veteran" Jawa Timur</p>
        </div>
    </footer>

    <script>
        const header = document.querySelector("header");
        window.addEventListener("scroll", function () {
            if (window.scrollY > 50) { header.classList.add("bg-red-900", "shadow-lg"); } 
            else { header.classList.remove("bg-red-900", "shadow-lg"); }
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
                if (status === 'semua' || card.getAttribute('data-status') === status) {
                    card.classList.remove('hidden');
                    visibleCount++;
                } else {
                    card.classList.add('hidden');
                }
            });

            const noDataMsg = document.getElementById('no-data-msg');
            if (visibleCount === 0) { noDataMsg.classList.remove('hidden'); } 
            else { noDataMsg.classList.add('hidden'); }
        }

        window.addEventListener('DOMContentLoaded', () => { updateSlidingBg(true); });
        window.addEventListener('resize', () => { updateSlidingBg(false); });
    </script>
</body>
</html>