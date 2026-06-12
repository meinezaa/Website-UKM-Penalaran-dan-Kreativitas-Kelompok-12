<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Kegiatan - UPN Mengajar</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght=600;700;800&family=Inter:wght=400;500;600;700&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" rel="stylesheet"/>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        "primary": "#bb0016",
                        "primary-light": "#fff5f5",
                        "primary-hover": "#990012",
                        "neutral-bg": "#f8fafc",
                    },
                    fontFamily: { headline: ["Plus Jakarta Sans"], body: ["Inter"] }
                }
            }
        }
    </script>
    <style> body { font-family: 'Inter', sans-serif; } </style>
</head>
<body class="bg-neutral-bg text-slate-900 flex min-h-screen relative">

<aside class="w-64 bg-white min-h-screen border-r border-gray-100 flex flex-col justify-between p-6 fixed top-0 left-0 bottom-0 z-50">
    <div>
        <div class="flex items-center gap-3 px-2 mb-8">
            <span class="text-red-600 font-bold text-xl tracking-wider Headline uppercase tracking-tighter">UPN MENGAJAR</span>
        </div>

        <div class="bg-gray-50 rounded-2xl p-4 flex items-center gap-4 mb-8 border border-gray-100">
            <div class="w-12 h-12 rounded-full bg-red-50 flex items-center justify-center text-red-600 border border-red-100">
                <span class="material-symbols-outlined text-2xl">person</span>
            </div>
            <div>
                <h4 class="font-bold text-sm text-gray-800">{{ session('nama_lengkap', 'Admin1') }}</h4>
                <p class="text-xs text-gray-400 font-medium uppercase tracking-wider">{{ session('role', 'SUPER ADMIN') }}</p>
            </div>
        </div>

        <nav class="space-y-2">
            <a href="{{ route('admin.dashboard') }}" 
               class="flex items-center gap-4 px-4 py-3 rounded-xl font-medium text-sm transition-all duration-200 
               {{ Request::is('admin/dashboard*') ? 'bg-red-600 text-white shadow-md shadow-red-100' : 'text-gray-500 hover:bg-gray-50 hover:text-gray-900' }}">
                <span class="material-symbols-outlined">dashboard</span>
                <span>Dashboard</span>
            </a>

            <a href="/admin/data-relawan" 
               class="flex items-center gap-4 px-4 py-3 rounded-xl font-medium text-sm transition-all duration-200 
               {{ Request::is('admin/data-relawan*') || Request::is('admin/kelola-relawan*') ? 'bg-red-600 text-white shadow-md shadow-red-100' : 'text-gray-500 hover:bg-gray-50 hover:text-gray-900' }}">
                <span class="material-symbols-outlined">group</span>
                <span>Data Relawan</span>
            </a>

            <a href="/admin/kelola-kegiatan" 
               class="flex items-center gap-4 px-4 py-3 rounded-xl font-medium text-sm transition-all duration-200 
               {{ Request::is('admin/kelola-kegiatan*') || Request::is('admin/edit-kegiatan*') ? 'bg-red-600 text-white shadow-md shadow-red-100' : 'text-gray-500 hover:bg-gray-50 hover:text-gray-900' }}">
                <span class="material-symbols-outlined">calendar_today</span>
                <span>Kegiatan</span>
            </a>

            <a href="/admin/kelola-dokumentasi" 
               class="flex items-center gap-4 px-4 py-3 rounded-xl font-medium text-sm transition-all duration-200 
               {{ Request::is('admin/kelola-dokumentasi*') ? 'bg-red-600 text-white shadow-md shadow-red-100' : 'text-gray-500 hover:bg-gray-50 hover:text-gray-900' }}">
                <span class="material-symbols-outlined">description</span>
                <span>Kelola Dokumentasi</span>
            </a>

            <a href="/admin/kelola-mitra" 
               class="flex items-center gap-4 px-4 py-3 rounded-xl font-medium text-sm transition-all duration-200 
               {{ Request::is('admin/kelola-mitra*') ? 'bg-red-600 text-white shadow-md shadow-red-100' : 'text-gray-500 hover:bg-gray-50 hover:text-gray-900' }}">
                <span class="material-symbols-outlined">handshake</span>
                <span>Data Kemitraan</span>
            </a>
        </nav>
    </div>

    <div class="px-2">
        <a href="{{ route('logout') }}" 
           class="flex items-center gap-4 px-4 py-3 text-red-500 hover:bg-red-50 rounded-xl font-semibold text-sm transition-all duration-200">
            <span class="material-symbols-outlined">logout</span>
            <span>Logout</span>
        </a>
    </div>
</aside>

<main class="flex-1 ml-64 p-12 overflow-x-hidden min-h-screen">
    <header class="flex flex-col lg:flex-row justify-between items-start lg:items-center gap-6 mb-10">
        <div>
            <h1 class="font-headline font-extrabold text-3xl text-slate-900 tracking-tight">Kelola Kegiatan</h1>
            <p class="text-sm text-slate-400 mt-1">Buat, perbarui, dan pantau seluruh agenda program UPN Mengajar.</p>
        </div>
        
        <a href="/admin/tambah-kegiatan" class="w-full lg:w-auto bg-primary text-white px-6 py-3.5 rounded-2xl text-sm font-bold flex items-center justify-center gap-2 hover:bg-primary-hover shadow-sm transition-all whitespace-nowrap">
            <span class="material-symbols-outlined text-lg">add</span> Tambah Kegiatan
        </a>
    </header>

    @if(session('pesan'))
        <div class="bg-emerald-50 border border-emerald-100 text-emerald-800 px-6 py-4 rounded-2xl text-sm font-semibold mb-8 flex items-center gap-3">
            <span class="material-symbols-outlined text-emerald-600">check_circle</span>{{ session('pesan') }}
        </div>
    @endif

    <div class="flex justify-between items-center mb-6 px-1">
        <h3 class="text-lg font-headline font-bold text-slate-800">Daftar Agenda Kegiatan</h3>
        <span class="text-[11px] font-bold text-slate-400 uppercase tracking-widest bg-slate-100 px-3 py-1.5 rounded-xl Headline">Total: {{ $kegiatan->count() }}</span>
    </div>
    
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($kegiatan as $row)
            <div class="bg-white border border-slate-100 rounded-3xl shadow-sm overflow-hidden flex flex-col group hover:shadow-md transition-all duration-300">
                
                <div class="h-44 w-full bg-slate-50 relative overflow-hidden flex-shrink-0 border-b border-slate-100">
                    @if(!empty($row->foto_kegiatan))
                        <img src="{{ asset('storage/' . $row->foto_kegiatan) }}" alt="Foto {{ $row->nama_kegiatan }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                    @else
                        <div class="w-full h-full flex flex-col items-center justify-center text-slate-300 gap-1.5">
                            <span class="material-symbols-outlined text-4xl text-slate-200">landscape</span>
                            <span class="text-[10px] font-bold uppercase tracking-wider text-slate-400 Headline">Belum Ada Foto</span>
                        </div>
                    @endif
                    
                    <span class="absolute top-3 left-3 bg-slate-900/70 backdrop-blur-sm text-white px-2 py-1 rounded-md text-[10px] font-semibold">
                        ID: #{{ $row->id_kegiatan }}
                    </span>

                    @php
                        $statusKegiatan = strtolower($row->status_kegiatan ?? 'aktif');
                        $statusColor = $statusKegiatan == 'aktif' ? 'bg-emerald-500' : 'bg-slate-400';
                    @endphp
                    <span class="absolute top-3 right-3 {{ $statusColor }} text-white px-2.5 py-1 rounded-md text-[10px] font-bold uppercase tracking-wide">
                        {{ $statusKegiatan }}
                    </span>
                </div>

                <div class="p-6 flex-1 flex flex-col justify-between space-y-5">
                    <div>
                        <h4 class="font-headline font-bold text-base text-slate-800 group-hover:text-primary transition-colors line-clamp-1 leading-snug">
                            {{ $row->nama_kegiatan ?? 'Tanpa Nama Kegiatan' }}
                        </h4>
                        <p class="text-slate-400 text-xs font-normal mt-2 line-clamp-2 leading-relaxed">
                            {{ $row->deskripsi_detail ?? 'Tidak ada deskripsi singkat untuk kegiatan ini.' }}
                        </p>
                    </div>

                    <div class="pt-4 border-t border-slate-50 space-y-2.5 text-xs text-slate-500 font-medium">
                        <div class="flex items-center gap-2 text-red-700 bg-red-50/50 px-3 py-2 rounded-xl border border-red-100/40">
                            <span class="material-symbols-outlined text-base">how_to_reg</span>
                            <div class="flex flex-col">
                                <span class="text-[9px] uppercase tracking-wider font-bold text-slate-400 leading-none mb-0.5">Masa Pendaftaran</span>
                                <span class="font-bold text-[11px]">
                                    {{ isset($row->pendaftaran_dibuka) ? date('d M', strtotime($row->pendaftaran_dibuka)) : 'N/A' }} - 
                                    {{ isset($row->batas_registrasi) ? date('d M Y', strtotime($row->batas_registrasi)) : 'N/A' }}
                                </span>
                            </div>
                        </div>

                        <div class="flex items-center gap-2 px-1 mt-1">
                            <span class="material-symbols-outlined text-slate-400 text-base">calendar_month</span>
                            <span>Pelaksanaan: <b class="text-slate-700">{{ isset($row->tanggal_pelaksanaan) ? date('d M Y', strtotime($row->tanggal_pelaksanaan)) : 'N/A' }}</b></span>
                        </div>
                        <div class="flex items-center gap-2 px-1">
                            <span class="material-symbols-outlined text-slate-400 text-base">location_on</span>
                            <span class="line-clamp-1 text-slate-600">{{ $row->lokasi ?? 'Lokasi N/A' }}</span>
                        </div>
                    </div>
                </div>

                <div class="px-6 py-4 bg-slate-50/70 border-t border-slate-100 flex items-center gap-2">
                    <a href="/admin/kelola-kegiatan/{{ $row->id_kegiatan }}" class="w-10 h-10 bg-white border border-slate-200 hover:border-slate-300 text-slate-600 rounded-xl flex items-center justify-center transition-all shadow-sm" title="Lihat Detail Lengkap">
                        <span class="material-symbols-outlined text-lg">visibility</span>
                    </a>

                    <a href="/admin/edit-kegiatan/{{ $row->id_kegiatan }}" class="flex-1 py-2.5 bg-white border border-slate-200 hover:border-slate-300 text-slate-600 rounded-xl text-xs font-bold flex items-center justify-center gap-1 transition-all shadow-sm">
                        <span class="material-symbols-outlined text-base">edit</span> Edit
                    </a>
                    
                    <form action="/admin/kelola-kegiatan/{{ $row->id_kegiatan }}" method="POST" class="flex-1" onsubmit="return confirm('Hapus kegiatan ini?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="w-full py-2.5 bg-red-50 text-red-600 hover:bg-red-600 hover:text-white border border-red-100 rounded-xl text-xs font-bold flex items-center justify-center gap-1 transition-all shadow-sm">
                            <span class="material-symbols-outlined text-base">delete</span> Hapus
                        </button>
                    </form>
                </div>

            </div>
        @empty
            <div class="col-span-full bg-white rounded-3xl border border-dashed border-slate-200 p-20 text-center shadow-sm flex flex-col items-center justify-center gap-3">
                <span class="material-symbols-outlined text-5xl text-slate-300">event_busy</span>
                <p class="font-headline font-bold text-xs uppercase tracking-widest text-slate-400 Headline">Belum ada agenda kegiatan</p>
            </div>
        @endforelse
    </div>
</main>

</body>
</html>