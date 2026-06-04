<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Kegiatan - UPN Mengajar</title>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;600;700;800&family=Inter:wght@400;500;600&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        "primary": "#bb0016",
                        "surface": "#f9f9f9",
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
<body class="bg-surface text-gray-900 flex">

<aside class="h-screen w-72 fixed left-0 top-0 bottom-0 z-50 p-6 flex flex-col bg-surface-container-lowest border-r shadow-[20px_0_40px_rgba(0,0,0,0.02)]">
    <div class="mb-10 px-4">
        <span class="font-headline font-extrabold text-primary text-2xl tracking-tighter uppercase">UPN Mengajar</span>
    </div>

    <div class="flex items-center gap-4 px-4 py-6 mb-6 rounded-xl bg-surface-container-low">
        <div class="w-12 h-12 rounded-full bg-red-50 flex items-center justify-center text-primary font-bold shadow-sm">
            <span class="material-symbols-outlined">person</span>
        </div>
        <div>
            <p class="font-semibold text-gray-800 text-sm leading-none">{{ Auth::user()->nama_lengkap ?? 'Admin' }}</p>
            <p class="text-[10px] text-gray-400 uppercase tracking-wider mt-1 font-bold">Super Admin</p>
        </div>
    </div>

    <nav class="flex-1 space-y-2">
        <a href="/admin/dashboard" class="flex items-center gap-3 px-4 py-3 rounded-lg text-gray-600 hover:bg-surface-container-low transition-all">
            <span class="material-symbols-outlined text-[20px]">dashboard</span> 
            <span class="text-sm font-medium">Dashboard</span>
        </a>
       <a href="/admin/kelola-relawan" class="flex items-center gap-3 px-4 py-3 rounded-lg text-gray-600 hover:bg-surface-container-low transition-all">

<a href="{{ url('/admin/kelola-relawan') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg text-gray-600 hover:bg-surface-container-low transition-all">
            <span class="material-symbols-outlined text-[20px]">group</span> 
            <span class="text-sm font-medium">Data Relawan</span>
        </a>
        <a href="/admin/kelola-kegiatan" class="flex items-center gap-3 px-4 py-3 rounded-lg bg-primary text-white shadow-md shadow-red-200">
            <span class="material-symbols-outlined text-[20px]">assignment</span> 
            <span class="text-sm font-medium">Kelola Kegiatan</span>
        </a>
    </nav>

    <div class="pt-6 border-t border-gray-100">
        <form action="/logout" method="POST" onsubmit="return confirm('Keluar?')">
            @csrf
            <button type="submit" class="w-full flex items-center gap-3 px-4 py-3 rounded-lg text-red-600 hover:bg-red-50 transition-all group text-left">
                <span class="material-symbols-outlined text-[20px] group-hover:rotate-12 transition-transform">logout</span> 
                <span class="text-sm font-medium">Logout</span>
            </button>
        </form>
    </div>
</aside>

<main class="flex-1 ml-72 min-h-screen">
    
    <header class="w-full sticky top-0 z-40 bg-white/80 backdrop-blur-md flex justify-between items-center px-8 py-4 border-b">
        <h1 class="font-headline font-bold text-2xl text-primary">Kelola Kegiatan</h1>
        <a href="/admin/tambah-kegiatan" class="bg-primary text-white px-5 py-2.5 rounded-xl text-sm font-bold flex items-center gap-2 hover:bg-red-700 shadow-md shadow-red-100 transition-all">
            <span class="material-symbols-outlined text-sm">add</span> Tambah Kegiatan
        </a>
    </header>

    <div class="p-8 space-y-6">
        
        @if(session('pesan'))
            <div class="bg-green-50 border border-green-200 text-green-700 px-6 py-4 rounded-xl text-sm font-semibold">
                {{ session('pesan') }}
            </div>
        @endif

        <div class="flex justify-between items-center px-2">
            <h3 class="text-xl font-headline font-bold text-gray-800">Daftar Agenda Kegiatan</h3>
            <span class="text-[11px] font-black text-gray-400 uppercase tracking-widest bg-gray-100 px-3 py-1 rounded-md">Total: {{ $kegiatan->count() }}</span>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse($kegiatan as $row)
                <div class="bg-white border border-gray-100 rounded-2xl shadow-sm overflow-hidden flex flex-col group hover:shadow-md transition-all duration-300">
                    
                    <div class="h-44 w-full bg-gray-50 relative overflow-hidden flex-shrink-0 border-b border-gray-100">
                        @if(!empty($row->foto_kegiatan))
                            <img src="{{ asset('storage/' . $row->foto_kegiatan) }}" alt="Foto {{ $row->nama_kegiatan }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                        @else
                            <div class="w-full h-full flex flex-col items-center justify-center text-gray-300 gap-1.5">
                                <span class="material-symbols-outlined text-4xl text-gray-200">landscape</span>
                                <span class="text-[10px] font-bold uppercase tracking-wider text-gray-400">Belum Ada Foto</span>
                            </div>
                        @endif
                        
                        <span class="absolute top-3 left-3 bg-gray-900/70 backdrop-blur-sm text-white px-2 py-0.5 rounded text-[10px] font-medium">
                            ID: #{{ $row->id_kegiatan }}
                        </span>

                        <span class="absolute top-3 right-3 {{ ($row->status_kegiatan ?? 'aktif') == 'aktif' ? 'bg-emerald-500' : 'bg-gray-400' }} text-white px-2 py-0.5 rounded text-[10px] font-bold uppercase tracking-wide">
                            {{ $row->status_kegiatan ?? 'aktif' }}
                        </span>
                    </div>

                    <div class="p-5 flex-1 flex flex-col justify-between space-y-4">
                        <div>
                            <h4 class="font-headline font-bold text-base text-gray-800 group-hover:text-primary transition-colors line-clamp-1 leading-snug">
                                {{ $row->nama_kegiatan ?? 'Tanpa Nama Kegiatan' }}
                            </h4>
                            <p class="text-gray-400 text-xs font-normal mt-1.5 line-clamp-2 leading-relaxed">
                                {{ $row->deskripsi_detail ?? 'Tidak ada deskripsi singkat untuk kegiatan ini.' }}
                            </p>
                        </div>

                        <div class="pt-3 border-t border-gray-50 space-y-2 text-xs text-gray-500 font-medium">
                            <div class="flex items-center gap-2 text-red-700 bg-red-50/50 px-2.5 py-1.5 rounded-lg border border-red-100/40">
                                <span class="material-symbols-outlined text-base">how_to_reg</span>
                                <div class="flex flex-col">
                                    <span class="text-[9px] uppercase tracking-wider font-bold text-gray-400 leading-none mb-0.5">Masa Pendaftaran</span>
                                    <span class="font-bold text-[11px]">
                                        {{ isset($row->pendaftaran_dibuka) ? date('d M', strtotime($row->pendaftaran_dibuka)) : 'N/A' }} - 
                                        {{ isset($row->batas_registrasi) ? date('d M Y', strtotime($row->batas_registrasi)) : 'N/A' }}
                                    </span>
                                </div>
                            </div>

                            <div class="flex items-center gap-2 px-1 mt-1">
                                <span class="material-symbols-outlined text-gray-400 text-base">calendar_month</span>
                                <span>Pelaksanaan: <b>{{ isset($row->tanggal_pelaksanaan) ? date('d M Y', strtotime($row->tanggal_pelaksanaan)) : 'N/A' }}</b></span>
                            </div>
                            <div class="flex items-center gap-2 px-1">
                                <span class="material-symbols-outlined text-gray-400 text-base">location_on</span>
                                <span class="line-clamp-1 text-gray-600">{{ $row->lokasi ?? 'Lokasi N/A' }}</span>
                            </div>
                        </div>
                    </div>

                    <div class="px-5 py-3.5 bg-gray-50/70 border-t border-gray-100 flex items-center gap-2">
                        <a href="/admin/kelola-kegiatan/{{ $row->id_kegiatan }}" class="w-10 h-10 bg-white border border-gray-200 hover:border-gray-300 text-gray-600 rounded-xl flex items-center justify-center transition-all shadow-sm" title="Lihat Detail Lengkap">
                            <span class="material-symbols-outlined text-lg">visibility</span>
                        </a>

                        <a href="/admin/edit-kegiatan/{{ $row->id_kegiatan }}" class="flex-1 py-2.5 bg-white border border-gray-200 hover:border-gray-300 text-gray-600 rounded-xl text-xs font-bold flex items-center justify-center gap-1 transition-all shadow-sm">
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
                <div class="col-span-full bg-white rounded-2xl border border-gray-100 p-16 text-center shadow-sm">
                    <div class="flex flex-col items-center opacity-30">
                        <span class="material-symbols-outlined text-5xl text-primary">event_busy</span>
                        <p class="mt-2 font-headline font-bold uppercase tracking-widest text-xs text-gray-500">Belum ada kegiatan</p>
                    </div>
                </div>
            @endforelse
        </div>

    </div>
</main>

</body>
</html>