<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Relawan - UPN Mengajar</title>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;600;700;800&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet"/>
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
            <p class="font-body font-semibold text-on-surface text-sm leading-none">{{ session('nama_lengkap', 'Admin1') }}</p>
            <p class="text-[10px] text-gray-400 uppercase tracking-wider mt-1">{{ session('role', 'SUPER ADMIN') }}</p>
        </div>
    </div>

    <nav class="flex-1 space-y-2 overflow-y-auto">
        <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg font-body font-medium text-sm transition-all {{ Request::is('admin/dashboard*') ? 'bg-primary text-white shadow-md shadow-red-200' : 'text-gray-600 hover:bg-surface-container-low' }}">
            <span class="material-symbols-outlined text-[20px]">dashboard</span> Dashboard
        </a>
        <a href="/admin/data-relawan" class="flex items-center gap-3 px-4 py-3 rounded-lg font-body font-medium text-sm transition-all {{ Request::is('admin/data-relawan*') || Request::is('admin/kelola-relawan*') ? 'bg-primary text-white shadow-md shadow-red-200' : 'text-gray-600 hover:bg-surface-container-low' }}">
            <span class="material-symbols-outlined text-[20px]">group</span> Data Relawan
        </a>
        <a href="/admin/kelola-kegiatan" class="flex items-center gap-3 px-4 py-3 rounded-lg font-body font-medium text-sm transition-all {{ Request::is('admin/kelola-kegiatan*') ? 'bg-primary text-white shadow-md shadow-red-200' : 'text-gray-600 hover:bg-surface-container-low' }}">
            <span class="material-symbols-outlined text-[20px]">assignment</span> Kegiatan
        </a>
        <a href="/admin/kelola-dokumentasi" class="flex items-center gap-3 px-4 py-3 rounded-lg font-body font-medium text-sm transition-all {{ Request::is('admin/kelola-dokumentasi*') ? 'bg-primary text-white shadow-md shadow-red-200' : 'text-gray-600 hover:bg-surface-container-low' }}">
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
        <a href="{{ route('logout') }}" class="w-full flex items-center gap-3 px-4 py-3 rounded-lg font-body font-medium text-sm text-red-600 hover:bg-red-50 transition-all group text-left">
            <span class="material-symbols-outlined text-[20px] group-hover:rotate-12 transition-transform">logout</span> Logout
        </a>
    </div>
</aside>

<main class="flex-1 ml-72 min-h-screen pb-20">
    <header class="w-full sticky top-0 z-40 bg-white/80 backdrop-blur-md flex flex-col lg:flex-row justify-between items-start lg:items-center gap-6 px-8 py-4 border-b">
        <div>
            <h1 class="font-headline font-bold text-2xl text-primary">Manajemen Relawan</h1>
            <p class="text-xs text-gray-400 mt-0.5">Tinjau, filter, dan kelola berkas pendaftaran calon relawan.</p>
        </div>
        
        <div class="grid grid-cols-2 gap-3 w-full lg:w-auto">
            <form action="/admin/impor-relawan" method="POST" enctype="multipart/form-data" class="col-span-2 sm:col-span-1 flex items-center gap-2 bg-white p-1.5 rounded-xl border border-gray-200 shadow-sm whitespace-nowrap overflow-x-auto min-w-0">
                @csrf
                <label class="relative flex-shrink-0 flex items-center px-3 py-1.5 bg-gray-50 hover:bg-gray-100 text-gray-600 rounded-lg cursor-pointer text-xs font-semibold whitespace-nowrap min-w-0">
                    <span class="material-symbols-outlined text-sm mr-2 flex-shrink-0">upload_file</span>
                    <span id="file-chosen" class="truncate min-w-0">Pilih File CSV</span>
                    <input type="file" name="file_csv" accept=".csv" required class="hidden" onchange="document.getElementById('file-chosen').textContent = this.files[0].name; document.getElementById('file-chosen').classList.remove('truncate');">
                </label>
                <button type="submit" class="flex-shrink-0 bg-gray-900 text-white px-4 py-1.5 rounded-lg text-xs font-bold hover:bg-black transition-all cursor-pointer">Impor Data</button>
            </form>

            <div class="col-span-2 sm:col-span-1 flex items-center gap-3 w-full">
                <a href="{{ route('admin.relawan.pdf') }}" class="flex-1 bg-primary text-white px-4 py-2.5 rounded-xl text-xs font-bold flex items-center gap-2 hover:bg-red-700 transition-all shadow-md shadow-red-100 whitespace-nowrap justify-center">
                    <span class="material-symbols-outlined text-sm">picture_as_pdf</span> Cetak PDF
                </a>
                <a href="{{ route('admin.relawan.ekspor') }}" class="flex-1 bg-emerald-600 text-white px-4 py-2.5 rounded-xl text-xs font-bold flex items-center gap-2 hover:bg-emerald-700 transition-all shadow-md shadow-emerald-100 whitespace-nowrap justify-center">
                    <span class="material-symbols-outlined text-sm">download</span> Ekspor Excel
                </a>
            </div>
        </div>
    </header>

    <div class="p-8 space-y-10">
        @if(session('pesan'))
            <div class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 border border-green-100 flex items-center gap-2" role="alert">
                <span class="material-symbols-outlined text-base">check_circle</span>
                {{ session('pesan') }}
            </div>
        @endif

        <section class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm">
            <form action="" method="GET" class="flex flex-col md:flex-row gap-4 items-end">
                <div class="flex-1 space-y-1.5 w-full">
                    <label class="text-[10px] font-bold text-gray-400 uppercase tracking-widest px-1 font-headline">Pencarian Calon Relawan</label>
                    <div class="relative flex items-center">
                        <span class="material-symbols-outlined absolute left-4 text-gray-400 text-[20px]">search</span>
                        <input type="text" name="search" placeholder="Cari nama mahasiswa atau program studi..." value="{{ request('search') }}" class="w-full pl-12 pr-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl focus:border-primary focus:ring-1 focus:ring-primary focus:bg-white text-sm outline-none font-medium text-gray-800 transition-all">
                    </div>
                </div>
                <div class="w-full md:w-64 space-y-1.5">
                    <label class="text-[10px] font-bold text-gray-400 uppercase tracking-widest px-1 font-headline">Filter Berdasar Divisi</label>
                    <select name="divisi" class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl text-sm font-semibold cursor-pointer outline-none text-gray-700 focus:border-primary focus:ring-1 focus:ring-primary focus:bg-white transition-all">
                        <option value="semua">Semua Divisi</option>
                        <option value="Acara" {{ request('divisi') == 'Acara' ? 'selected' : '' }}>Divisi Acara</option>
                        <option value="Humas" {{ request('divisi') == 'Humas' ? 'selected' : '' }}>Divisi Humas</option>
                        <option value="Perlengkapan" {{ request('divisi') == 'Perlengkapan' ? 'selected' : '' }}>Divisi Perlengkapan</option>
                        <option value="Konsumsi" {{ request('divisi') == 'Konsumsi' ? 'selected' : '' }}>Divisi Konsumsi</option>
                        <option value="PDD" {{ request('divisi') == 'PDD' ? 'selected' : '' }}>Divisi PDD</option>
                        <option value="Pengajar" {{ request('divisi') == 'Pengajar' ? 'selected' : '' }}>Divisi Pengajar</option>
                    </select>
                </div>
                <button type="submit" class="w-full md:w-auto bg-primary text-white px-6 py-2.5 rounded-xl font-bold text-sm hover:bg-red-700 transition-all flex items-center gap-2 justify-center shadow-md shadow-red-100 cursor-pointer">
                    <span class="material-symbols-outlined text-lg">filter_alt</span> Terapkan
                </button>
            </form>
        </section>

        <section class="space-y-4">
            <div class="grid grid-cols-12 px-6 text-[10px] font-bold text-gray-400 uppercase tracking-widest font-headline">
                <div class="col-span-4">Calon Relawan</div>
                <div class="col-span-3">Program Studi</div>
                <div class="col-span-2">Pilihan Divisi (1 & 2)</div>
                <div class="col-span-2">Status Seleksi</div>
                <div class="col-span-1 text-right">Aksi</div>
            </div>

            <div class="space-y-3">
                @forelse($relawan as $row)
                    <div class="grid grid-cols-12 items-center bg-white p-5 px-6 rounded-2xl border border-gray-100 shadow-sm hover:shadow-md transition-all group">
                        <div class="col-span-4 flex items-center gap-4">
                            <div class="w-11 h-11 rounded-xl bg-red-50 text-primary flex items-center justify-center font-headline font-bold text-sm flex-shrink-0 border border-red-100">
                                {{ strtoupper(substr($row->nama_lengkap, 0, 1)) }}
                            </div>
                            <div class="pr-4 overflow-hidden">
                                <p class="font-headline font-bold text-on-surface group-hover:text-primary transition-colors text-[15px] truncate">{{ $row->nama_lengkap }}</p>
                                <p class="text-xs text-gray-400 font-medium mt-0.5 truncate">{{ $row->email }}</p>
                            </div>
                        </div>

                        <div class="col-span-3">
                            <p class="text-sm font-semibold text-gray-600 line-clamp-2 pr-6">{{ $row->asal_prodi }}</p>
                        </div>

                        <div class="col-span-2 flex flex-col gap-1 items-start">
                            <span class="px-2 py-0.5 bg-red-50 text-primary rounded text-[9px] font-black uppercase tracking-wide">
                                1. {{ $row->pilihan_divisi_1 }}
                            </span>
                            @if(!empty($row->pilihan_divisi_2))
                            <span class="px-2 py-0.5 bg-gray-100 text-gray-500 rounded text-[9px] font-bold uppercase tracking-wide">
                                2. {{ $row->pilihan_divisi_2 }}
                            </span>
                            @endif
                        </div>

                        <div class="col-span-2">
                            @php
                                $status = strtoupper($row->status_seleksi ?? 'PENDING');
                                $color = "bg-yellow-50 text-yellow-600 border-yellow-100";
                                if($status == 'DITERIMA') $color = "bg-green-50 text-green-600 border-green-100";
                                if($status == 'DITOLAK') $color = "bg-red-50 text-red-600 border-red-100";
                            @endphp
                            <span class="px-2.5 py-1 {{ $color }} rounded text-[9px] font-black border uppercase tracking-wide inline-block">
                                {{ $status }}
                            </span>
                        </div>

                        <div class="col-span-1 flex justify-end gap-1">
                            <a href="/admin/detail-relawan/{{ $row->id_pendaftaran }}" class="text-blue-500 hover:bg-blue-50 p-1.5 rounded-lg" title="Lihat Berkas Lengkap">
                                <span class="material-symbols-outlined text-lg">visibility</span>
                            </a>
                            <form action="/admin/kelola-relawan/{{ $row->id_user }}" method="POST" class="inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data pendaftar ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-gray-400 hover:text-red-600 p-1.5 rounded-lg transition-colors cursor-pointer" title="Hapus Data">
                                    <span class="material-symbols-outlined text-lg">delete</span>
                                </button>
                            </form>
                        </div>
                    </div>
                @empty
                    <div class="bg-white p-20 rounded-2xl border border-gray-100 text-center flex flex-col items-center justify-center gap-3 shadow-sm">
                        <span class="material-symbols-outlined text-5xl text-gray-300">person_search</span>
                        <p class="text-gray-400 font-headline font-bold text-xs uppercase tracking-widest">Tidak ada relawan yang ditemukan</p>
                    </div>
                @endforelse
            </div>
        </section>
    </div>
</main>

</body>
</html>