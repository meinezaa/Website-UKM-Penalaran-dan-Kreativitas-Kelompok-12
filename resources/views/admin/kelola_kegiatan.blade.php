<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Kegiatan - UPN Mengajar</title>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;600;700;800&family=Inter:wght@400;500;600&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        "primary": "#bb0016",
                        "primary-container": "#e32128",
                        "surface": "#f9f9f9",
                        "on-surface": "#1a1c1c",
                        "surface-container-low": "#f3f3f3",
                        "surface-container-lowest": "#ffffff",
                    },
                    fontFamily: { headline: ["Manrope"], body: ["Inter"] }
                }
            }
        }
    </script>
    <style>
        .material-symbols-outlined { font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24; display: inline-flex; align-items: center; justify-content: center; vertical-align: middle; }
        body { font-family: 'Inter', sans-serif; min-height: 100vh; }
    </style>
</head>
<body class="bg-surface text-on-surface flex">

<aside class="h-screen w-72 fixed left-0 top-0 bottom-0 z-50 p-6 flex flex-col bg-surface-container-lowest border-r shadow-[20px_0_40px_rgba(0,0,0,0.02)]">
    <div class="mb-10 px-4">
        <span class="font-headline font-extrabold text-primary text-2xl tracking-tighter uppercase">UPN Mengajar</span>
    </div>

    <div class="flex items-center gap-4 px-4 py-6 mb-6 rounded-xl bg-surface-container-low">
        <div class="w-12 h-12 rounded-full bg-red-50 text-primary flex items-center justify-center font-bold">
            <span class="material-symbols-outlined">person</span>
        </div>
        <div>
            <p class="font-body font-semibold text-on-surface text-sm leading-none">{{ session('nama_lengkap') ?? 'Admin Utama' }}</p>
            <p class="text-[10px] text-gray-400 uppercase tracking-wider mt-1">Super Admin</p>
        </div>
    </div>

    <nav class="flex-1 space-y-2 overflow-y-auto">
        <a href="/admin/dashboard" class="flex items-center gap-3 px-4 py-3 rounded-lg font-body font-medium text-sm transition-all text-gray-600 hover:bg-surface-container-low">
            <span class="material-symbols-outlined text-[20px]">dashboard</span> Dashboard
        </a>
        <a href="/admin/data-relawan" class="flex items-center gap-3 px-4 py-3 rounded-lg font-body font-medium text-sm text-gray-600 hover:bg-surface-container-low transition-all">
            <span class="material-symbols-outlined text-[20px]">group</span> Data Relawan
        </a>
        <a href="/admin/kelola-kegiatan" class="flex items-center gap-3 px-4 py-3 rounded-lg font-body font-medium text-sm transition-all bg-primary text-white shadow-md shadow-red-200">
            <span class="material-symbols-outlined text-[20px]">assignment</span> Kegiatan
        </a>
        <a href="/admin/kelola-dokumentasi" class="flex items-center gap-3 px-4 py-3 rounded-lg font-body font-medium text-sm text-gray-600 hover:bg-surface-container-low transition-all">
            <span class="material-symbols-outlined text-[20px]">image</span> Kelola Dokumentasi
        </a>
        <a href="/admin/kelola-mitra" class="flex items-center gap-3 px-4 py-3 rounded-lg font-body font-medium text-sm text-gray-600 hover:bg-surface-container-low transition-all">
            <span class="material-symbols-outlined text-[20px]">handshake</span> Data Kemitraan
        </a>

        <div class="pt-4 pb-1 px-4 font-headline font-bold text-[10px] uppercase tracking-widest text-gray-400 border-t border-gray-100 mt-4">
            Konten Dropdown Tentang
        </div>

        <a href="/admin/kelola-ukm" class="flex items-center gap-3 px-4 py-3 rounded-lg font-body font-medium text-sm text-gray-600 hover:bg-surface-container-low transition-all">
            <span class="material-symbols-outlined text-[20px]">hub</span> Kelola Info UKM
        </a>

        <a href="/admin/kelola-upnmengajar" class="flex items-center gap-3 px-4 py-3 rounded-lg font-body font-medium text-sm text-gray-600 hover:bg-surface-container-low transition-all">
            <span class="material-symbols-outlined text-[20px]">description</span> Kelola Program Kerja
        </a>

        <a href="/admin/kelola-tim" class="flex items-center gap-3 px-4 py-3 rounded-lg font-body font-medium text-sm text-gray-600 hover:bg-surface-container-low transition-all">
            <span class="material-symbols-outlined text-[20px]">badge</span> Kelola Tim
        </a>
    </nav>

    <div class="pt-6 border-t border-surface-container">
        <form action="/logout" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin keluar?')">
            @csrf
            <button type="submit" class="w-full flex items-center gap-3 px-4 py-3 rounded-lg font-body font-medium text-sm text-red-600 hover:bg-red-50 transition-all group text-left">
                <span class="material-symbols-outlined text-[20px] group-hover:rotate-12 transition-transform">logout</span> Logout
            </button>
        </form>
    </div>
</aside>

<main class="flex-1 ml-72 min-h-screen pb-20">
    <header class="w-full sticky top-0 z-40 bg-white/80 backdrop-blur-md flex justify-between items-center px-8 py-4 border-b">
        <div>
            <h1 class="font-headline font-extrabold text-2xl text-primary tracking-tight">Kelola Kegiatan</h1>
        </div>
        <div class="flex items-center gap-4">
            <a href="/admin/tambah-kegiatan" class="flex items-center gap-2 px-4 py-2.5 bg-primary hover:bg-red-700 rounded-xl text-xs font-bold text-white transition-all shadow-md shadow-red-100 font-headline">
                <span class="material-symbols-outlined text-sm">add</span>
                Tambah Kegiatan
            </a>
            <a href="{{ url('/') }}" class="flex items-center gap-2 px-4 py-2 bg-gray-100 hover:bg-gray-200 rounded-xl text-sm font-bold text-gray-700 transition-all">
                <span class="material-symbols-outlined text-lg">home</span>
                Beranda
            </a>
        </div>
    </header>

    <div class="p-8 space-y-8">
        
        @if(session('pesan'))
            <div class="p-4 text-sm text-green-800 rounded-xl bg-green-50 border border-green-100 flex items-center gap-2" role="alert">
                <span class="material-symbols-outlined text-base">check_circle</span>
                {{ session('pesan') }}
            </div>
        @endif

        <div class="flex justify-between items-center px-1">
            <h3 class="text-lg font-headline font-extrabold text-on-surface">Daftar Agenda Kegiatan</h3>
            <span class="text-[10px] font-bold text-gray-400 uppercase tracking-widest bg-surface-container-low px-3 py-1.5 rounded-lg font-headline">Total: {{ $kegiatan->count() }}</span>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse($kegiatan as $row)
                <div class="bg-surface-container-lowest border border-gray-100 rounded-2xl shadow-sm overflow-hidden flex flex-col group hover:shadow-md transition-all duration-300 p-4">
                    
                    <div class="h-44 w-full bg-surface-container-low relative overflow-hidden rounded-xl flex-shrink-0 border border-gray-100">
                        @if(!empty($row->foto_kegiatan))
                            <img src="{{ asset('foto/' . $row->foto_kegiatan) }}" 
                                alt="Foto {{ $row->nama_kegiatan }}" 
                                class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500 rounded-xl"
                                onerror="this.onerror=null; this.src='https://placehold.co/600x400/f3f3f3/a3a3a3?text=No+Image';">
                        @else
                            <div class="w-full h-full flex flex-col items-center justify-center text-gray-300 gap-1.5">
                                <span class="material-symbols-outlined text-4xl text-gray-200">landscape</span>
                                <span class="text-[9px] font-bold uppercase tracking-wider text-gray-400 font-headline">Belum Ada Foto</span>
                            </div>
                        @endif
                        
                        <span class="absolute top-3 left-3 bg-slate-900/70 backdrop-blur-sm text-white px-2 py-0.5 rounded text-[9px] font-bold font-headline">
                            ID: #{{ $row->id_kegiatan }}
                        </span>

                        @php
                            $statusKegiatan = strtolower($row->status_kegiatan ?? 'aktif');
                            $statusColor = $statusKegiatan == 'aktif' ? 'bg-emerald-500' : 'bg-gray-400';
                        @endphp
                        <span class="absolute top-3 right-3 {{ $statusColor }} text-white px-2.5 py-0.5 rounded text-[9px] font-bold uppercase tracking-wide font-headline">
                            {{ $statusKegiatan }}
                        </span>
                    </div>

                    <div class="pt-5 pb-2 flex-1 flex flex-col justify-between space-y-4">
                        <div>
                            <h4 class="font-headline font-bold text-base text-on-surface group-hover:text-primary transition-colors line-clamp-1 leading-snug">
                                {{ $row->nama_kegiatan ?? 'Tanpa Nama Kegiatan' }}
                            </h4>
                            <p class="text-gray-400 text-xs font-medium mt-1.5 line-clamp-2 leading-relaxed">
                                {{ $row->deskripsi_detail ?? 'Tidak ada deskripsi singkat untuk kegiatan ini.' }}
                            </p>
                        </div>

                        <div class="pt-3 border-t border-gray-100 space-y-2 text-xs text-gray-500 font-medium">
                            <div class="flex items-center gap-3 text-primary bg-red-50/50 px-3 py-2 rounded-xl border border-red-100/40">
                                <span class="material-symbols-outlined text-base">how_to_reg</span>
                                <div class="flex flex-col">
                                    <span class="text-[8px] uppercase tracking-wider font-bold text-gray-400 leading-none mb-1 font-headline">Masa Pendaftaran</span>
                                    <span class="font-bold text-[11px] text-on-surface">
                                        {{ isset($row->pendaftaran_dibuka) ? date('d M', strtotime($row->pendaftaran_dibuka)) : 'N/A' }} - 
                                        {{ isset($row->batas_registrasi) ? date('d M Y', strtotime($row->batas_registrasi)) : 'N/A' }}
                                    </span>
                                </div>
                            </div>

                            <div class="flex items-center gap-2 px-1 mt-1">
                                <span class="material-symbols-outlined text-gray-400 text-base">calendar_month</span>
                                <span>Pelaksanaan: <b class="text-on-surface font-semibold">{{ isset($row->tanggal_pelaksanaan) ? date('d M Y', strtotime($row->tanggal_pelaksanaan)) : 'N/A' }}</b></span>
                            </div>
                            <div class="flex items-center gap-2 px-1">
                                <span class="material-symbols-outlined text-gray-400 text-base">location_on</span>
                                <span class="line-clamp-1 text-gray-500">Lokasi: <b class="text-on-surface font-semibold">{{ $row->lokasi ?? 'Lokasi N/A' }}</b></span>
                            </div>
                        </div>
                    </div>

                    <div class="pt-4 bg-surface-container-lowest border-t border-gray-100 flex items-center gap-2 mt-auto">
                        <a href="/admin/kelola-kegiatan/{{ $row->id_kegiatan }}" class="w-10 h-10 bg-white border border-gray-200 hover:border-gray-300 text-gray-600 rounded-xl flex items-center justify-center transition-all shadow-sm shrink-0" title="Lihat Detail">
                            <span class="material-symbols-outlined text-lg">visibility</span>
                        </a>

                        <a href="/admin/edit-kegiatan/{{ $row->id_kegiatan }}" class="flex-1 py-2.5 bg-white border border-gray-200 hover:border-gray-300 text-gray-600 rounded-xl text-xs font-bold flex items-center justify-center gap-1 transition-all shadow-sm font-headline">
                            <span class="material-symbols-outlined text-base">edit</span> Edit
                        </a>
                        
                        <form action="/admin/kelola-kegiatan/{{ $row->id_kegiatan }}" method="POST" class="flex-1" onsubmit="return confirm('Apakah Anda yakin ingin menghapus kegiatan ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="w-full py-2.5 bg-red-50 text-primary hover:bg-primary hover:text-white border border-red-100 rounded-xl text-xs font-bold flex items-center justify-center gap-1 transition-all shadow-sm font-headline cursor-pointer">
                                <span class="material-symbols-outlined text-base">delete</span> Hapus
                            </button>
                        </form>
                    </div>

                </div>
            @empty
                <div class="col-span-full bg-surface-container-lowest rounded-2xl border border-dashed border-gray-200 p-20 text-center shadow-sm flex flex-col items-center justify-center gap-3">
                    <span class="material-symbols-outlined text-5xl text-gray-300">event_busy</span>
                    <p class="font-headline font-bold text-xs uppercase tracking-widest text-gray-400">Belum ada agenda kegiatan</p>
                </div>
            @endforelse
        </div>
    </div>
</main>

</body>
</html>