<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Relawan - UPN Mengajar</title>
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
            <h1 class="font-headline font-extrabold text-3xl text-slate-900 tracking-tight">Manajemen Relawan</h1>
            <p class="text-sm text-slate-400 mt-1">Tinjau, filter, dan kelola berkas pendaftaran calon relawan.</p>
        </div>
        
        <div class="grid grid-cols-2 gap-3 w-full lg:w-auto">
            <form action="/admin/impor-relawan" method="POST" enctype="multipart/form-data" class="col-span-2 sm:col-span-1 flex items-center gap-2 bg-white p-1.5 rounded-2xl border border-slate-200 shadow-sm whitespace-nowrap overflow-x-auto min-w-0">
                @csrf
                <label class="relative flex-shrink-0 flex items-center px-3 py-2 bg-slate-50 hover:bg-slate-100 text-slate-600 rounded-xl cursor-pointer text-xs font-semibold whitespace-nowrap min-w-0">
                    <span class="material-symbols-outlined text-sm mr-2 flex-shrink-0">upload_file</span>
                    <span id="file-chosen" class="truncate min-w-0">Pilih File CSV</span>
                    <input type="file" name="file_csv" accept=".csv" required class="hidden" onchange="document.getElementById('file-chosen').textContent = this.files[0].name; document.getElementById('file-chosen').classList.remove('truncate');">
                </label>
                <button type="submit" class="flex-shrink-0 bg-slate-900 text-white px-4 py-2 rounded-xl text-xs font-bold hover:bg-black transition-all">Impor Data</button>
            </form>

            <div class="col-span-2 sm:col-span-1 flex items-center gap-3 w-full">
                <a href="{{ route('admin.relawan.pdf') }}" class="flex-1 bg-rose-700 text-white px-5 py-3 rounded-2xl text-sm font-bold flex items-center gap-2 hover:bg-rose-800 transition-all shadow-sm whitespace-nowrap justify-center">
                    <span class="material-symbols-outlined text-lg">picture_as_pdf</span> Cetak PDF
                </a>

                <a href="{{ route('admin.relawan.ekspor') }}" class="flex-1 bg-emerald-600 text-white px-5 py-3 rounded-2xl text-sm font-bold flex items-center gap-2 hover:bg-emerald-700 transition-all shadow-sm whitespace-nowrap justify-center">
                    <span class="material-symbols-outlined text-lg">download</span> Ekspor Excel
                </a>
            </div>
        </div>
    </header>

    @if(session('pesan'))
        <div class="bg-emerald-50 border border-emerald-100 text-emerald-800 px-6 py-4 rounded-2xl text-sm font-semibold mb-8 flex items-center gap-3">
            <span class="material-symbols-outlined text-emerald-600">check_circle</span>{{ session('pesan') }}
        </div>
    @endif

    <section class="bg-white p-6 rounded-3xl border border-slate-100 shadow-sm mb-10">
        <form action="" method="GET" class="flex flex-col md:flex-row gap-5 items-end">
            <div class="flex-1 space-y-2 w-full">
                <label class="text-[11px] font-bold text-slate-400 uppercase tracking-widest px-1 Headline">Pencarian Calon Relawan</label>
                <div class="relative flex items-center">
                    <span class="material-symbols-outlined absolute left-4 text-slate-400">search</span>
                    <input type="text" name="search" placeholder="Cari nama mahasiswa atau program studi..." value="{{ request('search') }}" class="w-full pl-12 pr-4 py-3.5 bg-slate-50 border border-transparent rounded-2xl focus:border-slate-200 focus:bg-white text-sm outline-none font-medium text-slate-800">
                </div>
            </div>
            <div class="w-full md:w-72 space-y-2">
                <label class="text-[11px] font-bold text-slate-400 uppercase tracking-widest px-1 Headline">Filter Berdasar Divisi</label>
                <select name="divisi" class="w-full px-4 py-3.5 bg-slate-50 border border-transparent rounded-2xl text-sm font-semibold cursor-pointer outline-none text-slate-700">
                    <option value="semua">Semua Divisi</option>
                    <option value="Acara" {{ request('divisi') == 'Acara' ? 'selected' : '' }}>Divisi Acara</option>
                    <option value="Humas" {{ request('divisi') == 'Humas' ? 'selected' : '' }}>Divisi Humas</option>
                    <option value="Perlengkapan" {{ request('divisi') == 'Perlengkapan' ? 'selected' : '' }}>Divisi Perlengkapan</option>
                    <option value="Konsumsi" {{ request('divisi') == 'Konsumsi' ? 'selected' : '' }}>Divisi Konsumsi</option>
                    <option value="PDD" {{ request('divisi') == 'PDD' ? 'selected' : '' }}>Divisi PDD</option>
                    <option value="Pengajar" {{ request('divisi') == 'Pengajar' ? 'selected' : '' }}>Divisi Pengajar</option>
                </select>
            </div>
            <button type="submit" class="w-full md:w-auto bg-primary text-white px-8 py-3.5 rounded-2xl font-bold text-sm hover:bg-primary-hover transition-all flex items-center gap-2 justify-center"><span class="material-symbols-outlined text-lg">filter_alt</span>Terapkan</button>
        </form>
    </section>

    <div class="space-y-4">
        <div class="grid grid-cols-12 px-8 text-[11px] font-bold text-slate-400 uppercase tracking-widest Headline">
            <div class="col-span-4">Calon Relawan</div>
            <div class="col-span-3">Program Studi</div>
            <div class="col-span-2">Pilihan Divisi (1 & 2)</div>
            <div class="col-span-2">Status Seleksi</div>
            <div class="col-span-1 text-right">Aksi</div>
        </div>

        <div class="space-y-3">
            @forelse($relawan as $row)
                <div class="grid grid-cols-12 items-center bg-white p-5 px-8 rounded-2xl border border-slate-100 shadow-sm hover:shadow-md transition-all group">
                    <div class="col-span-4 flex items-center gap-4">
                        <div class="w-11 h-11 rounded-xl bg-primary-light text-primary flex items-center justify-center font-headline font-bold text-sm flex-shrink-0">
                            {{ strtoupper(substr($row->nama_lengkap, 0, 1)) }}
                        </div>
                        <div class="pr-4 overflow-hidden">
                            <p class="font-headline font-bold text-slate-800 group-hover:text-primary transition-colors text-[15px] truncate">{{ $row->nama_lengkap }}</p>
                            <p class="text-xs text-slate-400 font-medium mt-0.5 truncate">{{ $row->email }}</p>
                        </div>
                    </div>

                    <div class="col-span-3">
                        <p class="text-sm font-semibold text-slate-600 line-clamp-2 pr-6">{{ $row->asal_prodi }}</p>
                    </div>

                    <div class="col-span-2 flex flex-col gap-1 items-start">
                        <span class="px-2.5 py-1 bg-red-50 text-primary rounded-md text-[10px] font-bold uppercase tracking-wide">
                            1. {{ $row->pilihan_divisi_1 }}
                        </span>
                        @if(!empty($row->pilihan_divisi_2))
                        <span class="px-2.5 py-1 bg-slate-50 text-slate-500 rounded-md text-[10px] font-semibold uppercase tracking-wide">
                            2. {{ $row->pilihan_divisi_2 }}
                        </span>
                        @endif
                    </div>

                    <div class="col-span-2">
                        @php
                            $status = strtoupper($row->status_seleksi ?? 'PENDING');
                            $color = "bg-amber-50 text-amber-600 border-amber-100/70";
                            if($status == 'DITERIMA') $color = "bg-emerald-50 text-emerald-600 border-emerald-100/70";
                            if($status == 'DITOLAK') $color = "bg-rose-50 text-rose-600 border-rose-100/70";
                        @endphp
                        <span class="px-3 py-1.5 {{ $color }} rounded-xl text-[11px] font-bold border tracking-wide inline-block">
                            {{ $status }}
                        </span>
                    </div>

                    <div class="col-span-1 flex justify-end gap-1">
                        <a href="/admin/detail-relawan/{{ $row->id_pendaftaran }}" class="w-9 h-9 flex items-center justify-center text-slate-400 hover:text-blue-600 hover:bg-blue-50 rounded-xl transition-all" title="Lihat Berkas Lengkap">
                            <span class="material-symbols-outlined text-xl">visibility</span>
                        </a>
                        <form action="/admin/kelola-relawan/{{ $row->id_user }}" method="POST" class="inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data pendaftar ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="w-9 h-9 flex items-center justify-center text-slate-300 hover:text-rose-600 hover:bg-rose-50 rounded-xl transition-all" title="Hapus Data">
                                <span class="material-symbols-outlined text-xl">delete</span>
                            </button>
                        </form>
                    </div>
                </div>
            @empty
                <div class="bg-white p-20 rounded-3xl border border-dashed border-slate-200 text-center col-span-12 flex flex-col items-center justify-center gap-3">
                    <span class="material-symbols-outlined text-5xl text-slate-300">person_search</span>
                    <p class="text-slate-400 font-headline font-bold text-xs uppercase tracking-widest Headline">Tidak ada relawan yang ditemukan</p>
                </div>
            @endforelse
        </div>
    </div>
</main>

</body>
</html>