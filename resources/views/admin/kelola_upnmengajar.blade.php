<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin - Kelola UPN Mengajar</title>
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
                <a href="/admin/kelola-upnmengajar" class="text-blue-400 font-semibold py-1">➔ Kelola Visi Misi</a>
                <a href="/admin/kelola-ukm" class="hover:text-blue-400 py-1">➔ Kelola Program UKM</a>
                <a href="/admin/kelola-tim" class="hover:text-blue-400 py-1">➔ Kelola Tim</a>
                <a href="/logout" class="text-red-400 mt-10 hover:underline pt-5">Keluar Aplikasi</a>
            </nav>
        </aside>

        <main class="flex-1 p-10">
            <div class="bg-white p-8 rounded-lg shadow-md max-w-4xl mx-auto">
                <h1 class="text-2xl font-bold text-gray-800 mb-6">Kelola Konten Visi & Misi UPN Mengajar</h1>
                
                @if(session('pesan'))
                    <div class="bg-green-100 text-green-800 p-4 rounded mb-6 font-medium">{{ session('pesan') }}</div>
                @endif

                <form action="{{ route('admin.kelola_upnmengajar.update') }}" method="POST" class="space-y-6">
                    @csrf
                    <div>
                        <label class="block text-gray-700 font-semibold mb-2">Visi Organisasi</label>
                        <textarea name="vision" rows="4" class="w-full p-3 border border-gray-300 rounded focus:ring-2 focus:ring-blue-500 outline-none" required>{{ $profil->vision ?? '' }}</textarea>
                    </div>

                    <div>
                        <label class="block text-gray-700 font-semibold mb-2">Misi Organisasi</label>
                        <textarea name="mission" rows="6" class="w-full p-3 border border-gray-300 rounded focus:ring-2 focus:ring-blue-500 outline-none" required>{{ $profil->mission ?? '' }}</textarea>
                    </div>

                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-6 rounded shadow transition">
                        Simpan & Perbarui Data
                    </button>
                </form>
            </div>
        </main>
    </div>
</body>
</html>