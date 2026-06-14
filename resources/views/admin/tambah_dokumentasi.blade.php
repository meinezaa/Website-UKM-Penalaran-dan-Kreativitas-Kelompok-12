<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Dokumentasi</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-slate-50 min-h-screen text-slate-800 antialiased">

<div class="max-w-3xl mx-auto py-12 px-4 sm:px-6">

    <div class="bg-white rounded-3xl shadow-xl border border-slate-100 overflow-hidden">
        
        <div class="bg-gradient-to-r from-red-800 to-red-900 px-8 py-6 text-white">
            <h1 class="text-2xl font-bold tracking-tight">
                Tambah Dokumentasi Kegiatan
            </h1>
            <p class="text-red-100 text-sm mt-1">
                Unggah galeri foto dokumentasi dan deskripsi kegiatan admin.
            </p>
        </div>
        
        <form action="/admin/tambah-dokumentasi" method="POST" enctype="multipart/form-data" class="p-8 space-y-6">
            @csrf

            {{-- Pilih Kegiatan --}}
            <div>
                <label class="block mb-2 font-semibold text-sm text-slate-700 tracking-wide uppercase">
                    Nama Kegiatan <span class="text-red-500">*</span>
                </label>
                <div class="relative">
                    <select
                        name="id_kegiatan"
                        class="w-full bg-slate-50 border border-slate-200 rounded-2xl px-4 py-3.5 text-slate-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-transparent transition-all duration-200 appearance-none cursor-pointer"
                        required
                    >
                        <option value="" class="text-slate-400">-- Pilih Kegiatan Terkait --</option>
                        @foreach($kegiatan as $item)
                            <option value="{{ $item->id_kegiatan }}">
                                {{ $item->nama_kegiatan }}
                            </option>
                        @endforeach
                    </select>
                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-4 text-slate-500">
                        <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
                    </div>
                </div>
            </div>

            {{-- Judul Foto --}}
            <div>
                <label class="block mb-2 font-semibold text-sm text-slate-700 tracking-wide uppercase">
                    Judul Dokumentasi <span class="text-red-500">*</span>
                </label>
                <input
                    type="text"
                    name="judul_foto"
                    class="w-full bg-slate-50 border border-slate-200 rounded-2xl px-4 py-3.5 text-slate-700 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-transparent transition-all duration-200"
                    placeholder="Contoh: Sesi Pembelajaran Literasi Bersama Anak"
                    required
                >
            </div>

            {{-- Upload Foto (Multiple) --}}
            <div>
                <label class="block mb-2 font-semibold text-sm text-slate-700 tracking-wide uppercase">
                    Upload Foto Dokumentasi <span class="text-red-500">*</span>
                </label>

                <div id="drop-area"
                    class="border-2 border-dashed border-slate-300 rounded-2xl p-8 text-center hover:border-red-500 bg-slate-50/50 hover:bg-red-50/10 transition-all duration-300 cursor-pointer group">

                    <div class="flex flex-col items-center">
                        <svg xmlns="http://www.w3.org/2000/svg"
                             class="w-16 h-16 text-slate-400 group-hover:text-red-600 group-hover:-translate-y-1 transition-all duration-300 mb-3"
                             fill="none"
                             viewBox="0 0 24 24"
                             stroke="currentColor">
                            <path stroke-linecap="round"
                                  stroke-linejoin="round"
                                  stroke-width="1.5"
                                  d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"/>
                        </svg>

                        <p class="font-semibold text-slate-700">
                            Drag & Drop Foto-Foto di Sini
                        </p>
                        <p class="text-sm text-slate-400 mt-1">
                            Bisa memilih beberapa file foto sekaligus (.jpg, .png, .jpeg)
                        </p>

                        <button type="button"
                            onclick="document.getElementById('foto').click()"
                            class="mt-4 bg-slate-800 text-white px-5 py-2.5 rounded-xl font-medium text-sm hover:bg-slate-900 transition shadow-sm">
                            Pilih File Foto
                        </button>
                    </div>

                    <input
                        type="file"
                        id="foto"
                        name="foto[]"multiple
                        accept="image/*"
                        class="hidden"
                        multiple
                        required>
                </div>

                <div id="preview-container" class="grid grid-cols-3 sm:grid-cols-4 gap-4 mt-4 hidden">
                    </div>
                <p id="file-count" class="mt-2 text-xs text-slate-500 font-medium"></p>
            </div>

            {{-- Deskripsi --}}
            <div>
                <label class="block mb-2 font-semibold text-sm text-slate-700 tracking-wide uppercase">
                    Deskripsi / Catatan Dokumentasi
                </label>
                <textarea
                    name="deskripsi"
                    rows="4"
                    class="w-full bg-slate-50 border border-slate-200 rounded-2xl px-4 py-3.5 text-slate-700 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-transparent transition-all duration-200 resize-none"
                    placeholder="Masukkan detail tambahan tentang kumpulan dokumentasi ini..."
                ></textarea>
            </div>

            <div class="border-t border-slate-100 pt-6 flex flex-col sm:flex-row items-center justify-end gap-3">
                <a href="/admin/kelola-dokumentasi"
                   class="w-full sm:w-auto text-center px-6 py-3.5 rounded-2xl bg-slate-100 text-slate-700 font-semibold text-sm hover:bg-slate-200 transition-colors duration-200">
                    Batal
                </a>
                <button
                    type="submit"
                    class="w-full sm:w-auto px-6 py-3.5 rounded-2xl bg-gradient-to-r from-red-700 to-red-800 text-white font-semibold text-sm hover:from-red-800 hover:to-red-900 shadow-md shadow-red-900/10 hover:shadow-lg transition-all duration-200">
                    Simpan Semua Dokumentasi
                </button>
            </div>

        </form>
    </div>
</div>

<script>
const dropArea = document.getElementById('drop-area');
const fileInput = document.getElementById('foto');
const previewContainer = document.getElementById('preview-container');
const fileCountText = document.getElementById('file-count');

// Mencegah Aksi Default Browser saat Drag File
['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
    dropArea.addEventListener(eventName, preventDefaults, false);
});

function preventDefaults(e) {
    e.preventDefault();
    e.stopPropagation();
}

// Efek Visual saat File Berada di Atas Area Dropzone
['dragenter', 'dragover'].forEach(eventName => {
    dropArea.addEventListener(eventName, () => dropArea.classList.add('border-red-500', 'bg-red-50/10'), false);
});

['dragleave', 'drop'].forEach(eventName => {
    dropArea.addEventListener(eventName, () => dropArea.classList.remove('border-red-500', 'bg-red-50/10'), false);
});

// Aksi saat File Dilepas (Drop)
dropArea.addEventListener('drop', function(e) {
    const files = e.dataTransfer.files;
    if (files && files.length > 0) {
        fileInput.files = files;
        handleFilePreview(files);
    }
});

// Aksi saat Memilih File Lewat Tombol Konvensional
fileInput.addEventListener('change', function() {
    handleFilePreview(this.files);
});

// Fungsi Membuat Live Preview Banyak Gambar Sekaligus
function handleFilePreview(files) {
    previewContainer.innerHTML = ''; // Kosongkan preview lama
    
    if (files.length > 0) {
        previewContainer.classList.remove('hidden');
        fileCountText.innerText = `${files.length} foto berhasil dipilih.`;

        // Looping untuk membuat pratinjau thumbnail gambar
        Array.from(files).forEach(file => {
            if (file.type.startsWith('image/')) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const div = document.createElement('div');
                    div.className = "relative aspect-square rounded-xl overflow-hidden border border-slate-200 shadow-sm bg-slate-100 group";
                    div.innerHTML = `
                        <img src="${e.target.result}" class="w-full h-full object-cover">
                        <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity duration-200 flex items-center justify-center">
                            <p class="text-[10px] text-white font-medium px-2 text-center truncate w-full">${file.name}</p>
                        </div>
                    `;
                    previewContainer.appendChild(div);
                }
                reader.readAsDataURL(file);
            }
        });
    } else {
        previewContainer.classList.add('hidden');
        fileCountText.innerText = 'Belum ada file dipilih';
    }
}
</script>

</body>
</html>