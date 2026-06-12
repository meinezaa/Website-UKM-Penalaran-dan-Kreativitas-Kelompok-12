<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Mitra - UPN Mengajar</title>
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
            <a href="/admin/dashboard" 
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
               {{ Request::is('admin/kelola-kegiatan*') ? 'bg-red-600 text-white shadow-md shadow-red-100' : 'text-gray-500 hover:bg-gray-50 hover:text-gray-900' }}">
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
               {{ Request::is('admin/kelola-mitra*') || Request::is('admin/kelola-mitra') ? 'bg-red-600 text-white shadow-md shadow-red-100' : 'text-gray-500 hover:bg-gray-50 hover:text-gray-900' }}">
                <span class="material-symbols-outlined">handshake</span>
                <span>Data Kemitraan</span>
            </a>
        </nav>
    </div>

    <div class="px-2">
        <a href="/logout" 
           class="flex items-center gap-4 px-4 py-3 text-red-500 hover:bg-red-50 rounded-xl font-semibold text-sm transition-all duration-200">
            <span class="material-symbols-outlined">logout</span>
            <span>Logout</span>
        </a>
    </div>
</aside>

<main class="flex-1 ml-64 p-12 overflow-x-hidden min-h-screen">
    
    <header class="flex flex-col lg:flex-row justify-between items-start lg:items-center gap-6 mb-10">
        <div>
            <h1 class="font-headline font-extrabold text-3xl text-slate-900 tracking-tight">Manajemen Pengajuan Mitra</h1>
            <p class="text-sm text-slate-400 mt-1">Tinjau, filter, dan kelola berkas kerja sama dari calon instansi/lembaga mitra.</p>
        </div>
    </header>

    @if(session('pesan'))
        <div class="bg-emerald-50 border border-emerald-100 text-emerald-800 px-6 py-4 rounded-2xl text-sm font-semibold mb-8 flex items-center gap-3">
            <span class="material-symbols-outlined text-emerald-600">check_circle</span>
            {{ session('pesan') }}
        </div>
    @endif

    <section class="bg-white p-6 rounded-3xl border border-slate-100 shadow-sm mb-10">
        <form action="/admin/kelola-mitra" method="GET" class="flex flex-col md:flex-row gap-5 items-end">
            <div class="flex-1 space-y-2 w-full">
                <label class="text-[11px] font-bold text-slate-400 uppercase tracking-widest px-1 Headline">Cari Mitra</label>
                <div class="relative flex items-center">
                    <span class="material-symbols-outlined absolute left-4 text-slate-400">search</span>
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Nama instansi atau penanggung jawab..." 
                           class="w-full pl-12 pr-4 py-3.5 bg-slate-50 border border-transparent rounded-2xl focus:border-slate-200 focus:bg-white text-sm outline-none font-medium text-slate-800">
                </div>
            </div>

            <div class="w-full md:w-72 space-y-2">
                <label class="text-[11px] font-bold text-slate-400 uppercase tracking-widest px-1 Headline">Filter Status</label>
                <select name="status" class="w-full px-4 py-3.5 bg-slate-50 border border-transparent rounded-2xl text-sm font-semibold cursor-pointer outline-none text-slate-700">
                    <option value="semua" {{ request('status') == 'semua' ? 'selected' : '' }}>Semua Status</option>
                    <option value="PENDING" {{ request('status') == 'PENDING' ? 'selected' : '' }}>PENDING</option>
                    <option value="DISETUJUI" {{ request('status') == 'DISETUJUI' ? 'selected' : '' }}>DISETUJUI</option>
                    <option value="DITOLAK" {{ request('status') == 'DITOLAK' ? 'selected' : '' }}>DITOLAK</option>
                </select>
            </div>

            <button type="submit" class="w-full md:w-auto bg-primary text-white px-8 py-3.5 rounded-2xl font-bold text-sm hover:bg-primary-hover transition-all flex items-center gap-2 justify-center">
                <span class="material-symbols-outlined text-lg">filter_alt</span>Terapkan Filter
            </button>
        </form>
    </section>

    <div class="bg-white rounded-3xl border border-slate-100 shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-slate-50 border-b border-slate-100 text-[11px] font-bold text-slate-400 uppercase tracking-widest font-headline">
                        <th class="p-5 pl-8">Detail Instansi</th>
                        <th class="p-5">Kontak Resmi</th>
                        <th class="p-5">Bentuk Kemitraan</th>
                        <th class="p-5">Pesan Kolaborasi</th>
                        <th class="p-5">Status</th>
                        <th class="p-5 pr-8 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 text-sm">
                    @forelse($mitra as $row)
                        <tr class="hover:bg-slate-50/80 transition-colors group">
                            <td class="p-5 pl-8">
                                <div class="font-headline font-bold text-slate-800 group-hover:text-primary transition-colors text-[15px]">{{ $row->nama_instansi }}</div>
                                <div class="text-xs text-slate-400 font-medium mt-0.5">PJ: {{ $row->nama_penanggung_jawab }}</div>
                            </td>
                            <td class="p-5">
                                <div class="font-semibold text-slate-600">{{ $row->email_instansi }}</div>
                                <div class="text-xs text-slate-400 font-medium mt-0.5">{{ $row->no_hp }}</div>
                            </td>
                            <td class="p-5 font-bold text-xs text-slate-500 uppercase tracking-wide">
                                {{ $row->jenis_kemitraan }}
                            </td>
                            <td class="p-5 max-w-xs truncate text-slate-500" title="{{ $row->pesan_kolaborasi }}">
                                {{ $row->pesan_kolaborasi ?? '-' }}
                            </td>
                            <td class="p-5">
                                @php
                                    $status = strtoupper($row->status_mitra ?? 'PENDING');
                                    $color = "bg-amber-50 text-amber-600 border-amber-100/70";
                                    if($status == 'DISETUJUI' || $status == 'DITERIMA') $color = "bg-emerald-50 text-emerald-600 border-emerald-100/70";
                                    if($status == 'DITOLAK') $color = "bg-rose-50 text-rose-600 border-rose-100/70";
                                @endphp
                                <span class="px-3 py-1.5 {{ $color }} rounded-xl text-[11px] font-bold border tracking-wide inline-block">
                                    {{ $status }}
                                </span>
                            </td>
                            <td class="p-5 pr-8">
                                <div class="flex items-center justify-center gap-2">
                                    <form action="/admin/kelola-mitra/{{ $row->id_mitra }}/update-status" method="POST" class="inline-flex gap-1">
                                        @csrf
                                        @if($row->status_mitra !== 'DISETUJUI')
                                            <button type="submit" name="status_mitra" value="DISETUJUI" class="bg-emerald-600 hover:bg-emerald-700 text-white px-3 py-1.5 text-xs font-bold rounded-xl transition-all shadow-sm">Terima</button>
                                        @endif
                                        @if($row->status_mitra !== 'DITOLAK')
                                            <button type="submit" name="status_mitra" value="DITOLAK" class="bg-rose-600 hover:bg-rose-700 text-white px-3 py-1.5 text-xs font-bold rounded-xl transition-all shadow-sm">Tolak</button>
                                        @endif
                                    </form>

                                    <form action="/admin/kelola-mitra/{{ $row->id_mitra }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data kemitraan ini?')" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="w-9 h-9 flex items-center justify-center text-slate-300 hover:text-rose-600 hover:bg-rose-50 rounded-xl transition-all" title="Hapus Data">
                                            <span class="material-symbols-outlined text-xl">delete</span>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="p-20 text-center">
                                <div class="flex flex-col items-center justify-center gap-3">
                                    <span class="material-symbols-outlined text-5xl text-slate-300">handshake</span>
                                    <p class="text-slate-400 font-headline font-bold text-xs uppercase tracking-widest Headline">Tidak ada data pengajuan kemitraan yang ditemukan</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</main>

</body>
</html>