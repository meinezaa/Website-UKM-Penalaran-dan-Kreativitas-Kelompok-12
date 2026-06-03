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
        <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg text-gray-600 hover:bg-surface-container-low transition-all">
            <span class="material-symbols-outlined text-[20px]">dashboard</span> 
            <span class="text-sm font-medium">Dashboard</span>
        </a>
        <a href="{{ route('admin.relawan') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg text-gray-600 hover:bg-surface-container-low transition-all">
            <span class="material-symbols-outlined text-[20px]">group</span> 
            <span class="text-sm font-medium">Data Relawan</span>
        </a>
        <a href="{{ route('admin.kegiatan') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg bg-primary text-white shadow-md shadow-red-200">
            <span class="material-symbols-outlined text-[20px]">assignment</span> 
            <span class="text-sm font-medium">Kelola Kegiatan</span>
        </a>
    </nav>

    <div class="pt-6 border-t border-gray-100">
        <a href="#" onclick="event.preventDefault(); if(confirm('Keluar?')) { document.getElementById('logout-form').submit(); }" class="flex items-center gap-3 px-4 py-3 rounded-lg text-red-600 hover:bg-red-50 transition-all group">
            <span class="material-symbols-outlined text-[20px] group-hover:rotate-12 transition-transform">logout</span> 
            <span class="text-sm font-medium">Logout</span>
        </a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
            @csrf
        </form>
    </div>
</aside>

<main class="flex-1 ml-72 min-h-screen">
    <header class="w-full sticky top-0 z-40 bg-white/80 backdrop-blur-md flex justify-between items-center px-8 py-4 border-b">
        <h1 class="font-headline font-bold text-2xl text-primary">Kelola Kegiatan</h1>
        <a href="{{ route('admin.kegiatan.tambah') }}" class="bg-primary text-white px-5 py-2.5 rounded-xl text-sm font-bold flex items-center gap-2 hover:bg-red-700 shadow-md shadow-red-100 transition-all">
            <span class="material-symbols-outlined text-sm">add</span> Tambah Kegiatan
        </a>
    </header>

    <div class="p-8 space-y-8">
        
        @if(session('pesan') == 'terhapus')
            <div class="p-4 text-sm text-red-800 rounded-xl bg-red-50 border border-red-100">
                Kegiatan berhasil dihapus secara permanen.
            </div>
        @endif

        @if(session('pesan') == 'diperbarui')
            <div class="p-4 text-sm text-green-800 rounded-xl bg-green-50 border border-green-100">
                Data agenda kegiatan berhasil diperbarui!
            </div>
        @endif

        <section class="space-y-4">
            <div class="flex justify-between items-center px-2">
                <h3 class="text-xl font-headline font-bold text-gray-800">Daftar Agenda Kegiatan</h3>
                <span class="text-[11px] font-black text-gray-400 uppercase tracking-widest">Total: {{ $query_kegiatan->count() }}</span>
            </div>
            
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                <table class="w-full text-left">
                    <thead class="bg-gray-50 border-b">
                        <tr class="text-[10px] font-bold uppercase tracking-widest text-gray-500">
                            <th class="px-8 py-4">Nama Kegiatan</th>
                            <th class="px-8 py-4">Informasi</th>
                            <th class="px-8 py-4">Lokasi</th>
                            <th class="px-8 py-4 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100 text-sm font-body">
                        @forelse($query_kegiatan as $row)
                        <tr class="hover:bg-gray-50/50 transition-colors group">
                            <td class="px-8 py-5">
                                <div class="flex items-center gap-4">
                                    <div class="w-10 h-10 rounded-xl bg-red-50 text-primary flex items-center justify-center font-bold border border-red-100">
                                        <span class="material-symbols-outlined">event_note</span>
                                    </div>
                                    <div>
                                        <p class="font-bold text-gray-800">{{ $row->nama_kegiatan ?? 'Tanpa Nama' }}</p>
                                        <p class="text-[11px] text-gray-400 font-medium tracking-tight">ID: #{{ $row->id_kegiatan }}</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-8 py-5">
                                <p class="font-semibold text-gray-700">
                                    @if(isset($row->tanggal_kegiatan))
                                        {{ date('d M Y', strtotime($row->tanggal_kegiatan)) }}
                                    @elseif(isset($row->tanggal))
                                        {{ date('d M Y', strtotime($row->tanggal)) }}
                                    @else
                                        Tanggal N/A
                                    @@endif
                                </p>
                                <p class="text-[11px] text-gray-400">{{ $row->jam ?? $row->waktu ?? 'Waktu N/A' }}</p>
                            </td>
                            <td class="px-8 py-5">
                                <div class="flex items-center gap-1.5 text-gray-500">
                                    <span class="material-symbols-outlined text-sm">location_on</span>
                                    <span class="font-medium text-xs">{{ $row->lokasi ?? 'Lokasi N/A' }}</span>
                                </div>
                            </td>
                            <td class="px-8 py-5 text-center">
                                <div class="flex justify-center gap-1">
                                    <a href="{{ route('admin.kegiatan.edit', $row->id_kegiatan) }}" class="w-8 h-8 flex items-center justify-center text-blue-600 hover:bg-blue-50 rounded-lg transition-all" title="Edit">
                                        <span class="material-symbols-outlined text-xl">edit</span>
                                    </a>
                                    
                                    <form action="{{ route('admin.kegiatan.hapus', $row->id_kegiatan) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" onclick="return confirm('Hapus kegiatan ini?')" class="w-8 h-8 flex items-center justify-center text-red-400 hover:text-red-600 hover:bg-red-50 rounded-lg transition-all" title="Hapus">
                                            <span class="material-symbols-outlined text-xl">delete</span>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="px-8 py-20 text-center">
                                <div class="flex flex-col items-center opacity-20">
                                    <span class="material-symbols-outlined text-5xl">event_busy</span>
                                    <p class="mt-2 font-bold uppercase tracking-widest text-xs">Belum ada kegiatan</p>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </section>
    </div>
</main>

</body>
</html>