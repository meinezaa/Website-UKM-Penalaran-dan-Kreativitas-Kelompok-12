<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Kegiatan - Admin Panel</title>
    
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    
    <script src="https://cdn.tailwindcss.com"></script>
    <style> body { font-family: 'Poppins', sans-serif; } </style>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen p-6">

    <div class="max-w-xl w-full bg-white rounded-2xl shadow-xl overflow-hidden border-t-4 border-blue-600">
        <div class="p-6 text-center">
            <h2 class="text-2xl font-bold text-gray-800">Edit Data Kegiatan</h2>
            <p class="text-gray-500 text-sm">Silakan ubah data yang diperlukan</p>
        </div>

        @if ($errors->any())
            <div class="mx-8 p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 border border-red-200">
                <ul class="list-disc pl-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.kegiatan.update', $data->id_kegiatan) }}" method="POST" class="p-8 space-y-5">
            @csrf
            @method('PUT') <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Nama Kegiatan</label>
                <input type="text" name="nama_kegiatan" required 
                       value="{{ old('nama_kegiatan', $data->nama_kegiatan) }}"
                       class="w-full border border-gray-300 px-4 py-2.5 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none transition">
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Tanggal Pelaksanaan</label>
                    <input type="date" name="tanggal_pelaksanaan" required 
                           value="{{ old('tanggal_pelaksanaan', $data->tanggal_pelaksanaan ?? $data->tanggal_kegiatan) }}"
                           class="w-full border border-gray-300 px-4 py-2.5 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none transition">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Status</label>
                    <select name="status_kegiatan" class="w-full border border-gray-300 px-4 py-2.5 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none transition">
                        <option value="aktif" {{ old('status_kegiatan', $data->status_kegiatan) == 'aktif' ? 'selected' : '' }}>Aktif</option>
                        <option value="selesai" {{ old('status_kegiatan', $data->status_kegiatan) == 'selesai' ? 'selected' : '' }}>Selesai</option>
                    </select>
                </div>
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Lokasi Kegiatan</label>
                <input type="text" name="lokasi" required 
                       value="{{ old('lokasi', $data->lokasi) }}"
                       class="w-full border border-gray-300 px-4 py-2.5 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none transition">
            </div>

            <div class="flex gap-4 pt-4 border-t border-gray-100">
                <button type="submit" class="flex-1 bg-blue-600 text-white font-bold py-3 rounded-lg hover:bg-blue-700 shadow-lg transition-all">
                    Simpan Perubahan
                </button>
                <a href="{{ route('admin.kegiatan') }}" 
                   class="flex-1 bg-gray-200 text-gray-700 font-bold py-3 rounded-lg text-center hover:bg-gray-300 transition-all">
                    Batal
                </a>
            </div>
        </form>
    </div>

</body>
</html>