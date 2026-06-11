```blade
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
        body{
            font-family:'Inter',sans-serif;
        }
    </style>
</head>

<body class="bg-gray-50">

<div class="max-w-7xl mx-auto px-8 py-10">

    <div class="flex justify-between items-center mb-8">

        <div>
            <h1 class="text-3xl font-bold text-[#8B1E1E]">
                Kelola Dokumentasi
            </h1>

            <p class="text-gray-500 mt-1">
                Kelola seluruh dokumentasi kegiatan UPN Mengajar
            </p>
        </div>

        <a href="/admin/tambah-dokumentasi"
           class="bg-[#8B1E1E] text-white px-5 py-3 rounded-xl font-semibold hover:bg-red-900 flex items-center gap-2">

            <span class="material-symbols-outlined">
                add_photo_alternate
            </span>

            Tambah Dokumentasi
        </a>

    </div>

    @if(session('success'))
        <div class="bg-green-100 text-green-700 p-4 rounded-xl mb-6">
            {{ session('success') }}
        </div>
    @endif

    <div class="grid md:grid-cols-3 lg:grid-cols-4 gap-6">

        @forelse($dokumentasi as $item)

            <div class="bg-white rounded-2xl overflow-hidden shadow-sm hover:shadow-lg transition">

                <img src="{{ asset('storage/'.$item->foto) }}"
                     class="w-full h-52 object-cover">

                <div class="p-4">

                    <h3 class="font-bold text-lg text-gray-800">
                        {{ $item->judul_foto }}
                    </h3>

                    <p class="text-sm text-[#8B1E1E] mt-1">
                        {{ $item->nama_kegiatan }}
                    </p>

                    <p class="text-gray-500 text-sm mt-2 line-clamp-2">
                        {{ $item->deskripsi }}
                    </p>

                    <div class="mt-4">

                        <form action="/admin/hapus-dokumentasi/{{ $item->id_dokumentasi }}"
                              method="POST">

                            @csrf
                            @method('DELETE')

                            <button
                                onclick="return confirm('Hapus dokumentasi ini?')"
                                class="w-full bg-red-50 text-red-600 py-2 rounded-xl hover:bg-red-600 hover:text-white transition">

                                Hapus
                            </button>

                        </form>

                    </div>

                </div>

            </div>

        @empty

            <div class="col-span-full">

                <div class="bg-white rounded-2xl p-16 text-center shadow-sm">

                    <span class="material-symbols-outlined text-6xl text-gray-300">
                        photo_library
                    </span>

                    <h3 class="mt-4 text-xl font-bold text-gray-700">
                        Belum Ada Dokumentasi
                    </h3>

                    <p class="text-gray-500 mt-2">
                        Tambahkan dokumentasi pertama kegiatan UPN Mengajar.
                    </p>

                </div>

            </div>

        @endforelse

    </div>

</div>

</body>
</html>
```
