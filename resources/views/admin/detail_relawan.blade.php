<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Relawan - UPN Mengajar</title>
    <!-- Font Premium Plus Jakarta Sans & Inter -->
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@500;600;700;800&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" rel="stylesheet"/>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        "primary": "#bb0016",
                        "primary-light": "#fff5f5",
                        "slate-background": "#f8fafc",
                    },
                    fontFamily: { headline: ["Plus Jakarta Sans"], body: ["Inter"] }
                }
            }
        }
    </script>
    <style>
        body { font-family: 'Inter', sans-serif; }
        .font-headline { font-family: 'Plus Jakarta Sans', sans-serif; }
    </style>
</head>
<body class="bg-slate-background text-slate-800 flex min-h-screen tracking-tight">

<!-- SIDEBAR -->
<aside class="h-screen w-72 fixed left-0 top-0 z-50 p-6 flex flex-col bg-white border-r border-slate-100/80">
    <div class="mb-12 px-4 flex items-center gap-3">
        <div class="w-3 h-7 bg-primary rounded-full shadow-sm shadow-red-500/50"></div>
        <span class="font-headline font-extrabold text-primary text-xl tracking-tight uppercase">UPN Mengajar</span>
    </div>
    <nav class="flex-1 space-y-1.5">
        <a href="/admin/dashboard" class="flex items-center gap-3.5 px-4 py-3.5 rounded-xl text-slate-500 hover:bg-slate-50 text-sm font-medium">
            <span class="material-symbols-outlined text-[22px]">dashboard</span> Dashboard
        </a>
        <a href="/admin/kelola-relawan" class="flex items-center gap-3.5 px-4 py-3.5 bg-red-50 text-primary rounded-xl text-sm font-bold shadow-sm shadow-red-100/50">
            <span class="material-symbols-outlined text-[22px]" style="font-variation-settings: 'FILL' 1">group</span> Data Relawan
        </a>
        <a href="/admin/kelola-kegiatan" class="flex items-center gap-3.5 px-4 py-3.5 text-slate-500 hover:bg-slate-50 text-sm font-medium">
            <span class="material-symbols-outlined text-[22px]">assignment</span> Kelola Kegiatan
        </a>
    </nav>
</aside>

<!-- MAIN CONTENT -->
<main class="flex-1 ml-72 p-12 max-w-[1000px]">
    
    <!-- BACK BUTTON & HEADER -->
    <div class="mb-8">
        <a href="/admin/kelola-relawan" class="flex items-center gap-3 px-4 py-3 rounded-lg text-gray-600 hover:bg-surface-container-low transition-all">
            <span class="material-symbols-outlined text-lg group-hover:-translate-x-0.5 transition-transform">arrow_back</span> Kembali ke Daftar
        </a>
        <h1 class="font-headline font-extrabold text-3xl text-slate-900 tracking-tight">Profil Lengkap Pendaftar</h1>
    </div>

    <!-- NOTIFIKASI BERHASIL UBAH STATUS -->
    @if(session('pesan'))
        <div class="bg-emerald-50 border border-emerald-100/80 text-emerald-800 px-6 py-4 rounded-2xl text-sm font-semibold mb-6 flex items-center gap-3 shadow-sm animate-fade-in">
            <span class="material-symbols-outlined text-emerald-600">check_circle</span>
            {{ session('pesan') }}
        </div>
    @endif

    <!-- MAIN SINGLE CARD CONTAINER -->
    <div class="bg-white border border-slate-100 rounded-3xl shadow-sm overflow-hidden">
        
        <!-- TOP PROFILE HEADER COMPONENT -->
        <div class="p-8 border-b border-slate-100 bg-gradient-to-r from-slate-50/50 to-white flex flex-col sm:flex-row items-center justify-between gap-6">
            <div class="flex flex-col sm:flex-row items-center gap-5 text-center sm:text-left">
                <!-- Foto Inisial -->
                <div class="w-20 h-20 rounded-2xl bg-primary-light text-primary flex items-center justify-center font-headline font-extrabold text-2xl border border-red-100/40 shadow-sm flex-shrink-0">
                    {{ strtoupper(substr($relawan->nama_lengkap, 0, 1)) }}
                </div>
                <div>
                    <h2 class="font-headline font-bold text-xl text-slate-900 leading-snug tracking-tight">{{ $relawan->nama_lengkap }}</h2>
                    <p class="text-sm text-slate-400 font-medium mt-1">{{ $relawan->email }}</p>
                    
                    <!-- Status Badge -->
                    <div class="mt-3">
                        @php
                            $status = strtoupper($relawan->status_seleksi ?? 'PENDING');
                            $color = "bg-amber-50 text-amber-600 border-amber-100";
                            if($status == 'DITERIMA') $color = "bg-emerald-50 text-emerald-600 border-emerald-100";
                            if($status == 'DITOLAK') $color = "bg-rose-50 text-rose-600 border-rose-100";
                        @endphp
                        <span class="inline-block px-3 py-1 {{ $color }} text-[11px] font-extrabold rounded-lg border tracking-wide uppercase">
                            {{ $status }}
                        </span>
                    </div>
                </div>
            </div>

            <!-- Hubungi Via WA Button -->
            <div class="w-full sm:w-auto flex-shrink-0">
                @php
                    $clean_wa = preg_replace('/[^0-9]/', '', $relawan->no_hp);
                    if(strpos($clean_wa, '0') === 0) {
                        $clean_wa = '62' . substr($clean_wa, 1);
                    }
                @endphp
                <a href="https://wa.me/{{ $clean_wa }}" target="_blank" class="w-full sm:w-auto px-5 py-3 bg-emerald-600 hover:bg-emerald-700 text-white rounded-2xl font-bold text-sm flex items-center justify-center gap-2 transition-all shadow-md shadow-emerald-100/70 hover:-translate-y-0.5">
                    <span class="material-symbols-outlined text-lg">chat</span> Hubungi via WhatsApp
                </a>
            </div>
        </div>

        <!-- LOWER BLOCKS: DETAILS AND ESSAYS -->
        <div class="p-8 space-y-8">
            
            <!-- SECTION 1: BIODATA -->
            <div>
                <h3 class="font-headline font-bold text-sm text-slate-400 uppercase tracking-widest border-b border-slate-100 pb-2.5 mb-4 flex items-center gap-2">
                    <span class="material-symbols-outlined text-slate-400 text-lg">badge</span> Informasi Biodata Diri
                </h3>
                <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                    <div>
                        <p class="text-xs font-semibold text-slate-400">Program Studi</p>
                        <p class="text-[14px] font-bold text-slate-700 mt-1">{{ $relawan->asal_prodi }}</p>
                    </div>
                    <div>
                        <p class="text-xs font-semibold text-slate-400">Nomor Telepon</p>
                        <p class="text-[14px] font-bold text-slate-700 mt-1">{{ $relawan->no_hp }}</p>
                    </div>
                    <div>
                        <p class="text-xs font-semibold text-slate-400">Umur Mahasiswa</p>
                        <p class="text-[14px] font-bold text-slate-700 mt-1">{{ $relawan->umur }} Tahun</p>
                    </div>
                    <div>
                        <p class="text-xs font-semibold text-slate-400">Jenis Kelamin</p>
                        <p class="text-[14px] font-bold text-slate-700 mt-1">{{ $relawan->jenis_kelamin }}</p>
                    </div>
                </div>
            </div>

            <!-- KOREKSI: SECTION KEGIATAN YANG DIIKUTI -->
            <div>
                <h3 class="font-headline font-bold text-sm text-slate-400 uppercase tracking-widest border-b border-slate-100 pb-2.5 mb-4 flex items-center gap-2">
                    <span class="material-symbols-outlined text-slate-400 text-lg">volunteer_activism</span> Kegiatan yang Diikuti
                </h3>
                @if(isset($relawan->kegiatan))
                    <div class="p-5 bg-gradient-to-r from-red-50/30 to-transparent border border-red-100/40 rounded-2xl flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                        <div class="flex items-start gap-3.5">
                            <span class="material-symbols-outlined text-primary bg-red-50 p-2.5 rounded-xl text-2xl mt-0.5">event_note</span>
                            <div>
                                <span class="text-[10px] font-black text-primary uppercase tracking-widest bg-red-50 px-2 py-0.5 rounded border border-red-100/60">
                                    Kategori: {{ strtoupper($relawan->kegiatan->kategori ?? 'Umum') }}
                                </span>
                                <h4 class="font-headline font-bold text-base text-slate-800 mt-1.5">{{ $relawan->kegiatan->nama_kegiatan }}</h4>
                                <div class="flex flex-wrap items-center gap-x-4 gap-y-1 text-xs text-slate-400 font-medium mt-1">
                                    <span class="flex items-center gap-1"><span class="material-symbols-outlined text-sm">location_on</span> {{ $relawan->kegiatan->lokasi ?? 'N/A' }}</span>
                                    <span class="flex items-center gap-1"><span class="material-symbols-outlined text-sm">calendar_month</span> {{ isset($relawan->kegiatan->tanggal_pelaksanaan) ? date('d F Y', strtotime($relawan->kegiatan->tanggal_pelaksanaan)) : 'N/A' }}</span>
                                </div>
                            </div>
                        </div>
                        <a href="/admin/kelola-kegiatan/{{ $relawan->kegiatan->id_kegiatan }}" class="text-xs font-bold text-primary hover:text-red-700 bg-white hover:bg-red-50/50 border border-slate-200 hover:border-red-200 px-4 py-2 rounded-xl flex items-center justify-center gap-1 transition-all self-start sm:self-center">
                            Lihat Kegiatan <span class="material-symbols-outlined text-sm">arrow_forward</span>
                        </a>
                    </div>
                @else
                    <div class="p-4 bg-slate-50 border border-slate-100 rounded-2xl text-xs font-medium text-slate-400 italic flex items-center gap-2">
                        <span class="material-symbols-outlined text-base">info</span> Data kegiatan tidak ditemukan atau tautan rusak.
                    </div>
                @endif
            </div>

            <!-- SECTION 2: PLACEMENT PREFERENCES -->
            <div>
                <h3 class="font-headline font-bold text-sm text-slate-400 uppercase tracking-widest border-b border-slate-100 pb-2.5 mb-4 flex items-center gap-2">
                    <span class="material-symbols-outlined text-slate-400 text-lg">schema</span> Pilihan Penempatan Divisi
                </h3>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div class="p-4 bg-red-50/40 border border-red-100/50 rounded-2xl">
                        <p class="text-[10px] font-bold text-primary uppercase tracking-widest">Pilihan Utama (Divisi 1)</p>
                        <p class="text-base font-bold text-slate-800 mt-1">{{ $relawan->pilihan_divisi_1 }}</p>
                    </div>
                    <div class="p-4 bg-slate-50 border border-slate-200/50 rounded-2xl">
                        <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Pilihan Cadangan (Divisi 2)</p>
                        <p class="text-base font-bold text-slate-800 mt-1">{{ $relawan->pilihan_divisi_2 ?? '-' }}</p>
                    </div>
                </div>
            </div>

            <!-- SECTION 3: STATEMENT / ESSAY -->
            <div>
                <h3 class="font-headline font-bold text-sm text-slate-400 uppercase tracking-widest border-b border-slate-100 pb-2.5 mb-4 flex items-center gap-2">
                    <span class="material-symbols-outlined text-slate-400 text-lg">forum</span> Alasan Ingin Bergabung
                </h3>
                <div class="p-5 bg-slate-50 border border-slate-100 rounded-2xl text-sm text-slate-600 font-medium leading-relaxed shadow-inner">
                    {{ $relawan->alasan_bergabung ?? 'Calon relawan tidak menuliskan alasan bergabung.' }}
                </div>
            </div>

            <!-- SECTION 4: AKSI KELULUSAN (UPDATE STATUS) -->
            <div class="pt-4 border-t border-slate-100">
                <h3 class="font-headline font-bold text-sm text-slate-400 uppercase tracking-widest mb-4 flex items-center gap-2">
                    <span class="material-symbols-outlined text-slate-400 text-lg">gavel</span> Keputusan Hasil Seleksi Admin
                </h3>
                
                <div class="flex flex-wrap items-center gap-3">
                    <!-- Form Terima -->
                    <form action="/admin/detail-relawan/{{ $relawan->id_pendaftaran }}/update-status" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin MENERIMA relawan ini?')">
                        @csrf
                        <input type="hidden" name="status_seleksi" value="Diterima">
                        <button type="submit" class="px-6 py-3 bg-emerald-50 text-emerald-700 hover:bg-emerald-600 hover:text-white border border-emerald-200 rounded-2xl text-sm font-bold flex items-center gap-2 transition-all shadow-sm hover:-translate-y-0.5">
                            <span class="material-symbols-outlined text-lg">check_circle</span> Terima Relawan
                        </button>
                    </form>

                    <!-- Form Tolak -->
                    <form action="/admin/detail-relawan/{{ $relawan->id_pendaftaran }}/update-status" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin MENOLAK pendaftaran relawan ini?')">
                        @csrf
                        <input type="hidden" name="status_seleksi" value="Ditolak">
                        <button type="submit" class="px-6 py-3 bg-rose-50 text-rose-700 hover:bg-rose-600 hover:text-white border border-rose-200 rounded-2xl text-sm font-bold flex items-center gap-2 transition-all shadow-sm hover:-translate-y-0.5">
                            <span class="material-symbols-outlined text-lg">cancel</span> Tolak Pendaftaran
                        </button>
                    </form>

                    <!-- Form Kembalikan ke Pending (Jika Admin salah pencet) -->
                    @if(strtoupper($relawan->status_seleksi ?? 'PENDING') !== 'PENDING')
                    <form action="/admin/detail-relawan/{{ $relawan->id_pendaftaran }}/update-status" method="POST">
                        @csrf
                        <input type="hidden" name="status_seleksi" value="Pending">
                        <button type="submit" class="px-5 py-3 bg-slate-50 text-slate-500 hover:bg-slate-200 border border-slate-200 rounded-2xl text-xs font-semibold flex items-center gap-2 transition-all">
                            <span class="material-symbols-outlined text-base">history</span> Kembalikan ke Pending
                        </button>
                    </form>
                    @endif
                </div>
            </div>

        </div>
    </div>
</main>

</body>
</html>