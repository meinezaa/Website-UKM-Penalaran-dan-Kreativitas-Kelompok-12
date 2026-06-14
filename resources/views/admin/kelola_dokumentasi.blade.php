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
        body { font-family: 'Inter', sans-serif; }
        .modal { transition: opacity 0.25s ease; }
        body.modal-active { overflow: hidden; }
    </style>
</head>

<body class="bg-gray-50 flex">

<aside class="h-screen w-72 fixed left-0 top-0 bottom-0 z-50 p-6 flex flex-col bg-white border-r shadow-[20px_0_40px_rgba(0,0,0,0.02)]">
    <div class="mb-10 px-4">
        <span class="font-headline font-extrabold text-red-600 text-2xl tracking-tighter uppercase">UPN Mengajar</span>
    </div>

    <div class="flex items-center gap-4 px-4 py-6 mb-6 rounded-xl bg-gray-50">
        <div class="w-12 h-12 rounded-full bg-red-50 text-red-600 flex items-center justify-center font-bold">
            <span class="material-symbols-outlined">person</span>
        </div>
        <div>
            <p class="font-body font-semibold text-slate-800 text-sm leading-none">{{ session('nama_lengkap') ?? 'Vina Dwi' }}</p>
            <p class="text-[10px] text-gray-400 uppercase tracking-wider mt-1">Super Admin</p>
        </div>
    </div>

    <nav class="flex-1 space-y-1 overflow-y-auto">
        <a href="/admin/dashboard" class="flex items-center gap-3 px-4 py-3 rounded-lg font-body font-medium text-sm transition-all {{ Request::is('admin/dashboard*') ? 'bg-red-600 text-white shadow-md shadow-red-200' : 'text-slate-600 hover:bg-gray-100' }}">
            <span class="material-symbols-outlined text-[20px]">dashboard</span> Dashboard
        </a>
        
        <a href="/admin/data-relawan" class="flex items-center gap-3 px-4 py-3 rounded-lg font-body font-medium text-sm transition-all {{ Request::is('admin/data-relawan*') || Request::is('admin/kelola-relawan*') ? 'bg-red-600 text-white shadow-md shadow-red-200' : 'text-slate-600 hover:bg-gray-100' }}">
            <span class="material-symbols-outlined text-[20px]">group</span> Data Relawan
        </a>
        
        <a href="/admin/kelola-kegiatan" class="flex items-center gap-3 px-4 py-3 rounded-lg font-body font-medium text-sm transition-all {{ Request::is('admin/kelola-kegiatan*') || Request::is('admin/edit-kegiatan*') ? 'bg-red-600 text-white shadow-md shadow-red-200' : 'text-slate-600 hover:bg-gray-100' }}">
            <span class="material-symbols-outlined text-[20px]">assignment</span> Kegiatan
        </a>

        <a href="/admin/kelola-dokumentasi" class="flex items-center gap-3 px-4 py-3 rounded-lg font-body font-medium text-sm transition-all {{ Request::is('admin/kelola-dokumentasi*') || Request::is('admin/tambah-dokumentasi*') ? 'bg-red-600 text-white shadow-md shadow-red-200' : 'text-slate-600 hover:bg-gray-100' }}">
            <span class="material-symbols-outlined text-[20px]">image</span> Kelola Dokumentasi
        </a>

        <a href="/admin/kelola-mitra" class="flex items-center gap-3 px-4 py-3 rounded-lg font-body font-medium text-sm transition-all {{ Request::is('admin/kelola-mitra*') ? 'bg-red-600 text-white shadow-md shadow-red-200' : 'text-slate-600 hover:bg-gray-100' }}">
            <span class="material-symbols-outlined text-[20px]">handshake</span> Data Kemitraan
        </a>

        <div class="pt-4 pb-1 px-4 font-headline font-bold text-[10px] uppercase tracking-widest text-gray-400 border-t border-gray-100 mt-4">
            Konten Dropdown Tentang
        </div>

        <a href="/admin/kelola-ukm" class="flex items-center gap-3 px-4 py-3 rounded-lg font-body font-medium text-sm text-slate-600 hover:bg-gray-100 transition-all">
            <span class="material-symbols-outlined text-[20px]">hub</span> Kelola Info UKM
        </a>
        
        <a href="/admin/kelola-upnmengajar" class="flex items-center gap-3 px-4 py-3 rounded-lg font-body font-medium text-sm text-slate-600 hover:bg-gray-100 transition-all">
            <span class="material-symbols-outlined text-[20px]">description</span> Kelola Program Kerja
        </a>
        
        <a href="/admin/kelola-tim" class="flex items-center gap-3 px-4 py-3 rounded-lg font-body font-medium text-sm text-slate-600 hover:bg-gray-100 transition-all">
            <span class="material-symbols-outlined text-[20px]">badge</span> Kelola Tim
        </a>
    </nav>

    <div class="pt-6 border-t border-gray-100">
        <form action="/logout" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin keluar?')">
            @csrf
            <button type="submit" class="w-full flex items-center gap-3 px-4 py-3 rounded-lg font-body font-medium text-sm text-red-600 hover:bg-red-50 transition-all group text-left cursor-pointer">
                <span class="material-symbols-outlined text-[20px] group-hover:rotate-12 transition-transform">logout</span> Logout
            </button>
        </form>
    </div>
</aside>

<main class="flex-1 ml-64 p-10 min-h-screen">

    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-10">
        <div>
            <h1 class="text-3xl font-bold text-gray-900 tracking-tight">Kelola Dokumentasi</h1>
            <p class="text-gray-500 mt-1 text-sm font-medium">Kelola dan tinjau album artikel dokumentasi UPN Mengajar lewat Pop-up</p>
        </div>

        <a href="/admin/tambah-dokumentasi" class="bg-[#8B1E1E] text-white px-5 py-3 rounded-xl font-semibold hover:bg-red-900 flex items-center gap-2 shadow-lg shadow-red-100 transition-all duration-200 text-sm">
            <span class="material-symbols-outlined text-xl">add_photo_alternate</span>Tambah Artikel Dokumentasi
        </a>
    </div>

    @if(session('pesan'))
        <div class="bg-emerald-50 border border-emerald-100 text-emerald-700 px-5 py-4 rounded-xl mb-8 flex items-center gap-3 text-sm font-medium">
            <span class="material-symbols-outlined text-emerald-600">check_circle</span>
            <div>{{ session('pesan') }}</div>
        </div>
    @endif

    <div class="grid sm:grid-cols-2 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
        @forelse($dokumentasi as $item)
            @php
                $filesFoto = $item->foto ? explode(',', $item->foto) : [];
                $jumlahFoto = count($filesFoto);
                $fotoCover = $jumlahFoto > 0 ? $filesFoto[0] : null;
            @endphp

            <div class="bg-white rounded-2xl overflow-hidden border border-gray-100 shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300 flex flex-col justify-between">
                <div>
                    <div class="relative group overflow-hidden bg-gray-100 aspect-[4/3]">
                        @if($fotoCover)
                           <img src="/foto/{{ basename($fotoCover) }}" class="w-full h-full object-cover group-hover:scale-105 transition-all duration-500" alt="Cover">
                                <div class="absolute bottom-3 right-3 bg-black/70 backdrop-blur-sm text-white px-2.5 py-1 rounded-lg text-xs font-semibold flex items-center gap-1.5">
                                    <span class="material-symbols-outlined text-sm">photo_library</span><span>{{ $jumlahFoto }} Foto</span>
                                </div>
                        @else
                            <div class="w-full h-full flex flex-col items-center justify-center text-gray-400">
                                <span class="material-symbols-outlined text-3xl">image_not_supported</span><span class="text-xs mt-1">Tidak ada foto</span>
                            </div>
                        @endif
                    </div>

                    <div class="p-5">
                        <h3 class="font-bold text-gray-800 text-base tracking-tight line-clamp-1">{{ $item->judul_foto }}</h3>
                        <p class="text-xs font-semibold text-red-600 uppercase tracking-wider mt-1.5 flex items-center gap-1.5">
                            <span class="material-symbols-outlined text-sm">collections_bookmark</span>{{ $item->nama_kegiatan }}
                        </p>
                        <p class="text-gray-400 text-sm mt-3 line-clamp-2 leading-relaxed">{{ $item->deskripsi }}</p>
                    </div>
                </div>

                <div class="px-5 pb-5 pt-2 space-y-2">
                    <button type="button" 
                            onclick="bukaPopupDetail('{{ $item->judul_foto }}', '{{ $item->nama_kegiatan }}', '{{ e($item->deskripsi) }}', '{{ $item->foto }}', '{{ $item->id_dokumentasi }}', '{{ $item->id_kegiatan }}')"
                            class="w-full bg-gray-100 text-gray-700 py-2.5 rounded-xl text-xs font-bold hover:bg-gray-200 transition-all duration-200 flex items-center justify-center gap-1.5">
                        <span class="material-symbols-outlined text-base">visibility</span>Lihat Detail (Pop-Up)
                    </button>

                    <form action="/admin/hapus-dokumentasi/{{ $item->id_dokumentasi }}" method="POST">
                        @csrf @method('DELETE')
                        <button onclick="return confirm('Hapus artikel ini?')" type="submit" class="w-full bg-red-50 text-red-600 py-2.5 rounded-xl text-xs font-bold hover:bg-red-600 hover:text-white transition-all duration-200 flex items-center justify-center gap-1.5">
                            <span class="material-symbols-outlined text-base">delete</span>Hapus
                        </button>
                    </form>
                </div>
            </div>
        @empty
            <div class="col-span-full py-16 text-center">Belum ada dokumentasi.</div>
        @endforelse
    </div>
</main>

<div id="modalDetail" class="modal opacity-0 pointer-events-none fixed w-full h-full top-0 left-0 flex items-center justify-center z-50">
    <div class="modal-overlay absolute w-full h-full bg-gray-900 opacity-50" onclick="tutupPopupDetail()"></div>
    <div class="modal-container bg-white w-11/12 md:max-w-2xl mx-auto rounded-2xl shadow-2xl z-50 overflow-y-auto max-h-[85vh]">
        <div class="p-6">
            <div class="flex justify-between items-center pb-3 border-b border-gray-100">
                <p class="text-xl font-bold text-gray-800" id="popJudul">Judul Dokumentasi</p>
                <button onclick="tutupPopupDetail()" class="text-gray-400 hover:text-gray-600"><span class="material-symbols-outlined">close</span></button>
            </div>
            
            <div class="my-4 space-y-4">
                <p class="text-xs font-bold text-red-600 uppercase" id="popKegiatan">Nama Kegiatan</p>
                <div class="text-sm text-gray-600 bg-gray-50 p-4 rounded-xl whitespace-pre-line leading-relaxed" id="popDeskripsi">Deskripsi...</div>
                
                <p class="font-bold text-sm text-gray-800">Koleksi Gambar:</p>
                <div class="grid grid-cols-3 gap-2" id="popGaleri"></div>
            </div>

            <div class="flex justify-end pt-4 border-t border-gray-100 gap-2">
                <button onclick="tutupPopupDetail()" class="px-4 py-2 bg-gray-100 text-gray-700 rounded-xl text-sm font-medium hover:bg-gray-200">Tutup</button>
                <button onclick="pindahKeModalEdit()" class="px-4 py-2 bg-[#8B1E1E] text-white rounded-xl text-sm font-medium hover:bg-red-900 flex items-center gap-1">
                    <span class="material-symbols-outlined text-sm">edit</span> Edit Data
                </button>
            </div>
        </div>
    </div>
</div>

<div id="modalEdit" class="modal opacity-0 pointer-events-none fixed w-full h-full top-0 left-0 flex items-center justify-center z-50">
    <div class="modal-overlay absolute w-full h-full bg-gray-900 opacity-50" onclick="tutupPopupEdit()"></div>
    <div class="modal-container bg-white w-11/12 md:max-w-xl mx-auto rounded-2xl shadow-2xl z-50 overflow-y-auto max-h-[85vh]">
        <form id="formEditDokumentasi" method="POST" enctype="multipart/form-data" class="p-6">
            @csrf @method('PUT')
            <div class="flex justify-between items-center pb-3 border-b border-gray-100">
                <p class="text-xl font-bold text-gray-800">Form Ubah Dokumentasi</p>
                <button type="button" onclick="tutupPopupEdit()" class="text-gray-400 hover:text-gray-600"><span class="material-symbols-outlined">close</span></button>
            </div>

            <div class="my-4 space-y-4 text-sm">
                <div>
                    <label class="block font-semibold text-gray-700 mb-1">Judul Artikel/Foto</label>
                    <input type="text" name="judul_foto" id="editJudul" required class="w-full px-4 py-2.5 border rounded-xl focus:outline-none focus:ring-2 focus:ring-red-500">
                </div>

                <div>
                    <label class="block font-semibold text-gray-700 mb-1">Hubungkan ke Kegiatan</label>
                    <select name="id_kegiatan" id="editKegiatanSelect" required class="w-full px-4 py-2.5 border rounded-xl focus:outline-none">
                        @foreach($kegiatan as $keg)
                            <option value="{{ $keg->id_kegiatan }}">{{ $keg->nama_kegiatan }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block font-semibold text-gray-700 mb-1">Isi Deskripsi Narasi</label>
                    <textarea name="deskripsi" id="editDeskripsi" rows="4" required class="w-full px-4 py-2.5 border rounded-xl focus:outline-none focus:ring-2 focus:ring-red-500"></textarea>
                </div>

                <div>
                    <label class="block font-semibold text-gray-700 mb-1">Ganti Foto Pendukung <span class="text-xs font-normal text-gray-400">(Biarkan kosong jika tidak ingin mengubah foto)</span></label>
                    <input type="file" name="foto[]" multiple class="w-full px-3 py-2 border rounded-xl text-xs">
                </div>
            </div>

            <div class="flex justify-end pt-4 border-t border-gray-100 gap-2">
                <button type="button" onclick="tutupPopupEdit()" class="px-4 py-2 bg-gray-100 text-gray-700 rounded-xl font-medium hover:bg-gray-200">Batal</button>
                <button type="submit" class="px-4 py-2 bg-emerald-600 text-white rounded-xl font-medium hover:bg-emerald-700">Simpan Perubahan</button>
            </div>
        </form>
    </div>
</div>

<script>
    // Variabel penampung data aktif global
    let dataAktif = {};

    function bukaPopupDetail(judul, kegiatan, deskripsi, fotoString, idDokumentasi, idKegiatan) {
        // Simpan data ke variabel global agar bisa dioper ke modal edit
        dataAktif = { idDokumentasi, idKegiatan, judul, kegiatan, deskripsi, fotoString };

        document.getElementById('popJudul').innerText = judul;
        document.getElementById('popKegiatan').innerText = "Kegiatan: " + kegiatan;
        document.getElementById('popDeskripsi').innerText = deskripsi;

        const containerGaleri = document.getElementById('popGaleri');
        containerGaleri.innerHTML = ''; // kosongkan galeri lama

        if(fotoString) {
            const listFoto = fotoString.split(',');
            listFoto.forEach(foto => {
                let imgNode = document.createElement('img');
                imgNode.src = "/foto/" + foto.split('/').pop();
                imgNode.className = "w-full h-24 object-cover rounded-lg border shadow-sm";
                containerGaleri.appendChild(imgNode);
            });
        } else {
            containerGaleri.innerHTML = '<p class="text-xs text-gray-400 col-span-3">Tidak ada berkas foto.</p>';
        }

        const modal = document.getElementById('modalDetail');
        modal.classList.remove('opacity-0', 'pointer-events-none');
        document.body.classList.add('modal-active');
    }

    function tutupPopupDetail() {
        const modal = document.getElementById('modalDetail');
        modal.classList.add('opacity-0', 'pointer-events-none');
        document.body.classList.remove('modal-active');
    }

    function pindahKeModalEdit() {
        // 1. Tutup modal detail dahulu
        tutupPopupDetail();

        // 2. Isi data form edit berdasarkan variabel global dataAktif
        document.getElementById('editJudul').value = dataAktif.judul;
        document.getElementById('editDeskripsi').value = dataAktif.deskripsi;
        document.getElementById('editKegiatanSelect').value = dataAktif.idKegiatan;

        // 3. Atur action route form agar mengarah ke ID yang benar secara dinamis
        document.getElementById('formEditDokumentasi').action = "/admin/update-dokumentasi/" + dataAktif.idDokumentasi;

        // 4. Buka modal edit
        setTimeout(() => {
            const modalEdit = document.getElementById('modalEdit');
            modalEdit.classList.remove('opacity-0', 'pointer-events-none');
            document.body.classList.add('modal-active');
        }, 200);
    }

    function tutupPopupEdit() {
        const modalEdit = document.getElementById('modalEdit');
        modalEdit.classList.add('opacity-0', 'pointer-events-none');
        document.body.classList.remove('modal-active');
    }
</script>

</body>
</html>