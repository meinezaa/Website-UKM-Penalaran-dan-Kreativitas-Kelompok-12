<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Kemitraan - UPN Mengajar</title>
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
        .material-symbols-outlined { font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24; }
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
        <a href="/admin/dashboard" class="flex items-center gap-3 px-4 py-3 rounded-lg font-body font-medium text-sm transition-all {{ Request::is('admin/dashboard*') ? 'bg-primary text-white shadow-md shadow-red-200' : 'text-gray-600 hover:bg-surface-container-low' }}">
            <span class="material-symbols-outlined text-[20px]">dashboard</span> Dashboard
        </a>
        <a href="/admin/data-relawan" class="flex items-center gap-3 px-4 py-3 rounded-lg font-body font-medium text-sm transition-all {{ Request::is('admin/data-relawan*') || Request::is('admin/kelola-relawan*') ? 'bg-primary text-white shadow-md shadow-red-200' : 'text-gray-600 hover:bg-surface-container-low' }}">
            <span class="material-symbols-outlined text-[20px]">group</span> Data Relawan
        </a>
        <a href="/admin/kelola-kegiatan" class="flex items-center gap-3 px-4 py-3 rounded-lg font-body font-medium text-sm transition-all {{ Request::is('admin/kelola-kegiatan*') || Request::is('admin/edit-kegiatan*') ? 'bg-primary text-white shadow-md shadow-red-200' : 'text-gray-600 hover:bg-surface-container-low' }}">
            <span class="material-symbols-outlined text-[20px]">assignment</span> Kegiatan
        </a>
        
        <a href="/admin/kelola-dokumentasi" class="flex items-center gap-3 px-4 py-3 rounded-lg font-body font-medium text-sm transition-all {{ Request::is('admin/kelola-dokumentasi*') || Request::is('admin/tambah-dokumentasi*') ? 'bg-primary text-white shadow-md shadow-red-200' : 'text-gray-600 hover:bg-surface-container-low' }}">
            <span class="material-symbols-outlined text-[20px]">image</span> Kelola Dokumentasi
        </a>
        
        <a href="/admin/kelola-mitra" class="flex items-center gap-3 px-4 py-3 rounded-lg font-body font-medium text-sm transition-all {{ Request::is('admin/kelola-mitra*') ? 'bg-primary text-white shadow-md shadow-red-200' : 'text-gray-600 hover:bg-surface-container-low' }}">
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
            <button type="submit" class="w-full flex items-center gap-3 px-4 py-3 rounded-lg font-body font-medium text-sm text-red-600 hover:bg-red-50 transition-all group text-left cursor-pointer">
                <span class="material-symbols-outlined text-[20px] group-hover:rotate-12 transition-transform">logout</span> Logout
            </button>
        </form>
    </div>
</aside>

<main class="flex-1 ml-72 min-h-screen pb-20">
    <header class="w-full sticky top-0 z-40 bg-white/80 backdrop-blur-md flex justify-between items-center px-8 py-4 border-b">
        <h1 class="font-headline font-bold text-2xl text-primary">Manajemen Pengajuan Mitra</h1>
        <div class="flex items-center gap-4">
            <a href="{{ url('/') }}" class="flex items-center gap-2 px-4 py-2 bg-gray-100 hover:bg-gray-200 rounded-xl text-sm font-bold text-gray-700 transition-all">
                <span class="material-symbols-outlined text-lg">home</span> Beranda
            </a>
        </div>
    </header>

    <div class="p-8 space-y-8">
        
        @if(session('pesan'))
            <div class="p-4 text-sm text-green-800 rounded-xl bg-green-50 border border-green-100 flex items-center gap-2" role="alert">
                <span class="material-symbols-outlined text-lg">check_circle</span>
                {{ session('pesan') }}
            </div>
        @endif

        <section class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm">
            <form action="/admin/kelola-mitra" method="GET" class="flex flex-col md:flex-row gap-4 items-end">
                <div class="flex-1 space-y-1.5 w-full">
                    <label class="text-[10px] font-bold text-gray-400 uppercase tracking-widest px-1 font-headline">Cari Mitra</label>
                    <div class="relative flex items-center">
                        <span class="material-symbols-outlined absolute left-4 text-gray-400 text-[20px]">search</span>
                        <input type="text" name="search" value="{{ request('search') }}" placeholder="Nama instansi atau penanggung jawab..." 
                               class="w-full pl-12 pr-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl focus:border-primary focus:ring-1 focus:ring-primary focus:bg-white text-sm outline-none font-medium text-gray-800 transition-all">
                    </div>
                </div>

                <div class="w-full md:w-64 space-y-1.5">
                    <label class="text-[10px] font-bold text-gray-400 uppercase tracking-widest px-1 font-headline">Filter Status</label>
                    <select name="status" class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl text-sm font-semibold cursor-pointer outline-none text-gray-700 focus:border-primary focus:ring-1 focus:ring-primary focus:bg-white transition-all">
                        <option value="semua" {{ request('status') == 'semua' ? 'selected' : '' }}>Semua Status</option>
                        <option value="PENDING" {{ request('status') == 'PENDING' ? 'selected' : '' }}>PENDING</option>
                        <option value="DISETUJUI" {{ request('status') == 'DISETUJUI' ? 'selected' : '' }}>DISETUJUI</option>
                        <option value="DITOLAK" {{ request('status') == 'DITOLAK' ? 'selected' : '' }}>DITOLAK</option>
                    </select>
                </div>

                <button type="submit" class="w-full md:w-auto bg-primary text-white px-6 py-2.5 rounded-xl font-bold text-sm hover:bg-red-700 transition-all flex items-center gap-2 justify-center shadow-md shadow-red-100 cursor-pointer">
                    <span class="material-symbols-outlined text-lg">filter_alt</span> Terapkan Filter
                </button>
            </form>
        </section>

        <section class="space-y-4">
            <h3 class="text-xl font-headline font-extrabold text-on-surface">Daftar Berkas Pengajuan</h3>
            
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-left">
                        <thead class="bg-gray-50 border-b">
                            <tr class="text-[10px] font-bold uppercase tracking-widest text-gray-500 font-headline">
                                <th class="px-6 py-4">Detail Instansi</th>
                                <th class="px-6 py-4">Kontak Resmi</th>
                                <th class="px-6 py-4">Bentuk Kemitraan</th>
                                <th class="px-6 py-4">Pesan Kolaborasi</th>
                                <th class="px-6 py-4 text-center">Status</th>
                                <th class="px-6 py-4 text-center">Tindakan</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100 text-sm font-body text-gray-700">
                            @forelse($mitra as $row)
                            <tr class="hover:bg-gray-50/80 transition-colors">
                                <td class="px-6 py-4">
                                    <div class="font-bold text-on-surface text-base">{{ $row->nama_instansi }}</div>
                                    <div class="text-xs text-gray-400 font-medium mt-0.5">PJ: {{ $row->nama_penanggung_jawab }}</div>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="font-semibold text-gray-700 leading-tight">{{ $row->email_instansi }}</div>
                                    <div class="text-xs text-gray-400 mt-1">{{ $row->no_hp }}</div>
                                </td>
                                <td class="px-6 py-4">
                                    <span class="bg-gray-100 text-gray-600 text-[10px] font-bold uppercase tracking-wider px-2 py-1 rounded">
                                        {{ $row->jenis_kemitraan }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 max-w-xs truncate text-gray-500" title="{{ $row->pesan_kolaborasi }}">
                                    {{ $row->pesan_kolaborasi ?? '-' }}
                                </td>
                                <td class="px-6 py-4 text-center">
                                    @php
                                        $status = strtoupper($row->status_mitra ?? 'PENDING');
                                        $color = "bg-yellow-50 text-yellow-600 border-yellow-100";
                                        if($status == 'DISETUJUI' || $status == 'DITERIMA') $color = "bg-green-50 text-green-600 border-green-100";
                                        if($status == 'DITOLAK') $color = "bg-red-50 text-red-600 border-red-100";
                                    @endphp
                                    <span class="{{ $color }} border px-2.5 py-1 rounded text-[9px] font-black uppercase tracking-wide inline-block">
                                        {{ $status }}
                                    </span>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center justify-center gap-2">
                                        
                                        <form action="/admin/kelola-mitra/{{ $row->id_mitra }}/update-status" method="POST" class="inline-flex gap-1">
                                            @csrf
                                            @if(strtoupper($row->status_mitra) !== 'DISETUJUI')
                                                <button type="submit" name="status_mitra" value="DISETUJUI" class="bg-green-600 hover:bg-green-700 text-white px-2.5 py-1.5 text-xs font-bold rounded-lg transition-all shadow-sm cursor-pointer">
                                                    Terima
                                                </button>
                                            @endif

                                            @if(strtoupper($row->status_mitra) !== 'DITOLAK')
                                                <button type="submit" name="status_mitra" value="DITOLAK" class="bg-red-600 hover:bg-red-700 text-white px-2.5 py-1.5 text-xs font-bold rounded-lg transition-all shadow-sm cursor-pointer">
                                                    Tolak
                                                </button>
                                            @endif
                                        </form>

                                        <form action="/admin/kelola-mitra/{{ $row->id_mitra }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data kemitraan ini?')" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-gray-400 hover:text-red-600 p-1.5 rounded-lg transition-all cursor-pointer" title="Hapus Permanen">
                                                <span class="material-symbols-outlined text-[20px]">delete</span>
                                            </button>
                                        </form>

                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="px-6 py-16 text-center text-gray-400 font-bold uppercase text-[10px] tracking-widest">
                                    <span class="material-symbols-outlined text-4xl block mb-2 opacity-50">handshake</span>
                                    Tidak ada berkas pengajuan kemitraan saat ini
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </section>

    </div>
</main>

</body>
</html>