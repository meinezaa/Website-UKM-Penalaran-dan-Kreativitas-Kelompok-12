<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Dokumentasi</title>

    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50">

<div class="max-w-3xl mx-auto py-10 px-6">

    <div class="bg-white rounded-2xl shadow-md p-8">

        <h1 class="text-2xl font-bold text-red-800 mb-8">
            Tambah Dokumentasi Kegiatan
        </h1>

        <form action="/admin/tambah-dokumentasi" method="POST" enctype="multipart/form-data">
            @csrf

            {{-- Pilih Kegiatan --}}
            <div class="mb-5">
                <label class="block mb-2 font-semibold">
                    Kegiatan
                </label>

                <select
                    name="id_kegiatan"
                    class="w-full border rounded-xl px-4 py-3"
                    required
                >
                    <option value="">
                        -- Pilih Kegiatan --
                    </option>

                    @foreach($kegiatan as $item)
                        <option value="{{ $item->id_kegiatan }}">
                            {{ $item->nama_kegiatan }}
                        </option>
                    @endforeach

                </select>
            </div>

            {{-- Judul Foto --}}
            <div class="mb-5">
                <label class="block mb-2 font-semibold">
                    Judul Foto
                </label>

                <input
                    type="text"
                    name="judul_foto"
                    class="w-full border rounded-xl px-4 py-3"
                    placeholder="Contoh: Sesi Pembelajaran Literasi"
                    required
                >
            </div>

            {{-- Upload Foto --}}
<div class="mb-5">

    <label class="block mb-2 font-semibold">
        Upload Foto
    </label>

    <div id="drop-area"
        class="border-2 border-dashed border-gray-300 rounded-2xl p-8 text-center hover:border-red-500 transition cursor-pointer">

        <div class="flex flex-col items-center">

            <svg xmlns="http://www.w3.org/2000/svg"
                 class="w-14 h-14 text-gray-400 mb-3"
                 fill="none"
                 viewBox="0 0 24 24"
                 stroke="currentColor">

                <path stroke-linecap="round"
                      stroke-linejoin="round"
                      stroke-width="1.5"
                      d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"/>
            </svg>

            <p class="font-semibold text-gray-700">
                Drag & Drop Foto di Sini
            </p>

            <p class="text-sm text-gray-500 mt-1">
                atau klik tombol di bawah
            </p>

            <button type="button"
                onclick="document.getElementById('foto').click()"
                class="mt-4 bg-red-700 text-white px-5 py-2 rounded-xl hover:bg-red-800">
                Choose File
            </button>

            <p id="file-name"
               class="mt-3 text-sm text-gray-500">
                Belum ada file dipilih
            </p>

        </div>

        <input
            type="file"
            id="foto"
            name="foto"
            accept="image/*"
            class="hidden"
            required>

        </div>

    </div>

            {{-- Deskripsi --}}
            <div class="mb-6">
                <label class="block mb-2 font-semibold">
                    Deskripsi
                </label>

                <textarea
                    name="deskripsi"
                    rows="4"
                    class="w-full border rounded-xl px-4 py-3"
                    placeholder="Masukkan deskripsi dokumentasi..."
                ></textarea>
            </div>

            <div class="flex gap-3">

                <a href="/admin/kelola-dokumentasi"
                   class="px-6 py-3 rounded-xl bg-gray-200 font-semibold">
                    Kembali
                </a>

                <button
                    type="submit"
                    class="px-6 py-3 rounded-xl bg-red-700 text-white font-semibold hover:bg-red-800">
                    Simpan Dokumentasi
                </button>

            </div>

        </form>

    </div>

</div>

...

<script>

const dropArea = document.getElementById('drop-area');
const fileInput = document.getElementById('foto');
const fileName = document.getElementById('file-name');

['dragenter','dragover','dragleave','drop'].forEach(eventName => {

    dropArea.addEventListener(eventName, preventDefaults, false);

});

function preventDefaults(e){
    e.preventDefault();
    e.stopPropagation();
}

dropArea.addEventListener('drop', function(e){

    const files = e.dataTransfer.files;

    console.log('DROP');
    console.log(files);

    if(files && files.length > 0){

        fileInput.files = files;

        fileName.innerText = files[0].name;

    } else {

        alert('File tidak dapat dibaca. Drag langsung dari Windows Explorer.');

    }

});

fileInput.addEventListener('change', function(){

    if(this.files.length > 0){

        fileName.innerText = this.files[0].name;

    }

});

</script>

</body>
</html>

