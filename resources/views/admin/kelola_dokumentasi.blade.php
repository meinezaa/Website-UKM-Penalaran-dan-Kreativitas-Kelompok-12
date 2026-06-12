<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Dokumentasi - UPN Mengajar</title>

    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;600;700;800&family=Inter:wght@400;500;600&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet"/>
    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
    </style>
</head>

<body class="bg-gray-50 flex">

<aside class="w-64 bg-white min-h-screen border-r border-gray-100 flex flex-col justify-between p-6 fixed top-0 left-0 bottom-0 z-50">
    <div>
        <div class="flex items-center gap-3 px-2 mb-8">
            <span class="text-red-600 font-bold text-xl tracking-wider">UPN MENGAJAR</span>
        </div>

        <div class="bg-gray-50 rounded-2xl p-4 flex items-center gap-4 mb-8 border border-gray-100">
            <div class="w-12 h-12 rounded-full bg-red-50 flex items-center justify-center text-red-600">
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

<main class="flex-1 ml-64 p-10 min-h-screen">

    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-10">
        <div>
            <h1 class="text-3xl font-bold text-gray-900 tracking-tight">
                Kelola Dokumentasi
            </h1>
            <p class="text-gray-500 mt-1 text-sm font-medium">
                Kelola seluruh dokumentasi foto album kegiatan UPN Mengajar
            </p>
        </div>

        <a href="/admin/tambah-dokumentasi"
           class="bg-[#8B1E1E] text-white px-5 py-3 rounded-xl font-semibold hover:bg-red-900 flex items-center gap-2 shadow-lg shadow-red-100 transition-all duration-200 text-sm">
            <span class="material-symbols-outlined text-xl">
                add_photo_alternate
            </span>
            Tambah Dokumentasi
        </a>
    </div>

    @if(session('success'))
        <div class="bg-emerald-50 border border-emerald-100 text-emerald-700 px-5 py-4 rounded-xl mb-8 flex items-center gap-3 text-sm font-medium">
            <span class="material-symbols-outlined text-emerald-600">check_circle</span>
            <div>{{ session('success') }}</div>
        </div>
    @endif

    <div class="grid sm:grid-cols-2 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">

        @forelse($dokumentasi as $item)
            <div class="bg-white rounded-2xl overflow-hidden border border-gray-100 shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300 flex flex-col justify-between">
                <div>
                    <div class="relative group overflow-hidden">
                        <img src="{{ asset('storage/'.$item->foto) }}"
                             class="w-full h-48 object-cover group-hover:scale-105 transition-all duration-500" alt="Dokumentasi">
                    </div>

                    <div class="p-5">
                        <h3 class="font-bold text-gray-800 text-base tracking-tight line-clamp-1">
                            {{ $item->judul_foto }}
                        </h3>

                        <p class="text-xs font-semibold text-red-600 uppercase tracking-wider mt-1.5 flex items-center gap-1.5">
                            <span class="material-symbols-outlined text-sm">collections_bookmark</span>
                            {{ $item->nama_kegiatan }}
                        </p>

                        <p class="text-gray-400 text-sm mt-3 line-clamp-2 leading-relaxed">
                            {{ $item->deskripsi }}
                        </p>
                    </div>
                </div>

                <div class="px-5 pb-5 pt-2">
                    <form action="/admin/hapus-dokumentasi/{{ $item->id_dokumentasi }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button onclick="return confirm('Apakah Anda yakin ingin menghapus foto dokumentasi ini?')"
                                class="w-full bg-red-50 text-red-600 py-2.5 rounded-xl text-xs font-bold hover:bg-red-600 hover:text-white shadow-sm transition-all duration-200 flex items-center justify-center gap-1.5">
                            <span class="material-symbols-outlined text-base">delete</span>
                            Hapus Berkas
                        </button>
                    </form>
                </div>
            </div>
        @empty
            <div class="col-span-full py-16">
                <div class="bg-white rounded-2xl p-16 text-center border border-dashed border-gray-200 max-w-xl mx-auto">
                    <div class="w-16 h-16 bg-gray-50 rounded-full flex items-center justify-center mx-auto text-gray-400">
                        <span class="material-symbols-outlined text-3xl">photo_library</span>
                    </div>
                    <h3 class="mt-4 text-lg font-bold text-gray-800">
                        Belum Ada Dokumentasi
                    </h3>
                    <p class="text-gray-400 mt-1.5 text-sm max-w-xs mx-auto leading-relaxed">
                        Belum ada galeri foto yang diunggah. Tambahkan dokumentasi pertama untuk memulai!
                    </p>
                </div>
            </div>
        @endforelse

    </div>
</main>
</body>
</html>