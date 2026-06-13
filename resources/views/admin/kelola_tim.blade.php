<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin - Kelola Anggota Tim</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 font-sans">
    <div class="flex min-h-screen">
        <aside class="w-64 bg-slate-800 text-white p-6 space-y-6">
            <h2 class="text-2xl font-bold border-b border-slate-700 pb-3">Dashboard</h2>
            <nav class="space-y-3 flex flex-col">
                <a href="/admin/kelola-kegiatan" class="hover:text-blue-400 py-1">➔ Kelola Kegiatan</a>
                <a href="/admin/kelola-relawan" class="hover:text-blue-400 py-1">➔ Kelola Relawan</a>
                <a href="/admin/kelola-mitra" class="hover:text-blue-400 py-1">➔ Kelola Mitra</a>
                <a href="/admin/kelola-upnmengajar" class="hover:text-blue-400 py-1">➔ Kelola Visi Misi</a>
                <a href="/admin/kelola-ukm" class="hover:text-blue-400 py-1">➔ Kelola Program UKM</a>
                <a href="/admin/kelola-tim" class="text-blue-400 font-semibold py-1">➔ Kelola Tim</a>
            </nav>
        </aside>

        <main class="flex-1 p-10">
            <div class="max-w-6xl mx-auto space-y-10">
                
                <div class="bg-white p-6 rounded-lg shadow-md">
                    <h2 class="text-xl font-bold text-gray-800 mb-4">Tambah Anggota Tim Internal</h2>
                    @if(session('pesan'))
                        <div class="bg-green-100 text-green-800 p-3 rounded mb-4">{{ session('pesan') }}</div>
                    @endif
                    
                    <form action="{{ route('admin.kelola_tim.store') }}" method="POST" enctype="multipart/form-data" class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        @csrf
                        <div class="space-y-2">
                            <label class="block font-medium text-gray-700">Nama Lengkap</label>
                            <input type="text" name="name" class="w-full p-2 border border-gray-300 rounded" required>
                        </div>
                        <div class="space-y-2">
                            <label class="block font-medium text-gray-700">Jabatan / Posisi</label>
                            <input type="text" name="position" placeholder="Contoh: Koordinator Lapangan" class="w-full p-2 border border-gray-300 rounded" required>
                        </div>
                        <div class="space-y-2">
                            <label class="block font-medium text-gray-700">Foto Profil</label>
                            <input type="file" name="image" class="w-full p-1 border border-gray-300 rounded">
                        </div>
                        <div class="md:col-span-3 pt-2">
                            <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-6 rounded">Simpan Anggota</button>
                        </div>
                    </form>
                </div>

                <div class="bg-white p-6 rounded-lg shadow-md">
                    <h2 class="text-xl font-bold text-gray-800 mb-6">Struktur Pengurus / Tim Terdaftar</h2>
                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-6">
                        @forelse($tim as $person)
                        <div class="border border-gray-200 rounded-lg p-4 text-center bg-gray-50 flex flex-col justify-between items-center shadow-sm">
                            <div class="mb-3">
                                @if($person->image)
                                    <img src="{{ asset('storage/' . $person->image) }}" class="w-24 h-24 object-cover rounded-full mx-auto border-2 border-indigo-400">
                                @else
                                    <div class="w-24 h-24 bg-gray-300 rounded-full mx-auto flex items-center justify-center text-gray-500 font-bold">User</div>
                                @endif
                            </div>
                            <div>
                                <h4 class="font-bold text-gray-800 text-base">{{ $person->name }}</h4>
                                <p class="text-xs text-indigo-600 font-medium mb-4">{{ $person->position }}</p>
                            </div>
                            <form action="/admin/kelola-tim/delete/{{ $person->id }}" method="POST" onsubmit="return confirm('Hapus anggota tim ini?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="text-xs text-red-500 hover:text-red-700 font-semibold border border-red-200 px-3 py-1 rounded bg-white hover:bg-red-50">Hapus Data</button>
                            </form>
                        </div>
                        @empty
                        <div class="col-span-4 text-center text-gray-400 py-4">Belum ada susunan pengurus tim.</div>
                        @endforelse
                    </div>
                </div>

            </div>
        </main>
    </div>
</body>
</html>