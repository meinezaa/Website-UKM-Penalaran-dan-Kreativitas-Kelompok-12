<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Kegiatan - UPN Mengajar</title>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;600;700;800&family=Inter:wght@400;500;600&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        "primary": "#bb0016",
                        "primary-container": "#e32128",
                        "surface": "#f9f9f9",
                        "on-surface": "#1a1c1c",
                        "surface-container-low": "#f3f3f3",
                        "surface-container-lowest": "#ffffff",
                    },
                    fontFamily: { headline: ["Manrope"], body: ["Inter"] }
                }
            }
        }
    </script>
    <style>
        .material-symbols-outlined { font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24; display: inline-flex; align-items: center; justify-content: center; vertical-align: middle; }
        body { font-family: 'Inter', sans-serif; min-height: 100vh; }
    </style>
</head>
<body class="bg-surface text-on-surface flex">

<aside class="h-screen w-72 fixed left-0 top-0 bottom-0 z-50 p-6 flex flex-col bg-surface-container-lowest border-r shadow-[20px_0_40px_rgba(0,0,0,0.02)]">
    <div class="mb-10 px-4">
        <span class="font-headline font-extrabold text-primary text-2xl tracking-tighter uppercase">UPN Mengajar</span>
    </div>

    <div class="flex items-center gap-4 px-4 py-6 mb-6 rounded-xl bg-surface-container-low">
        <div class="w-12 h-12 rounded-full bg-red-50 text-primary flex items-center justify-center font-bold">
            <span class="material-symbols-outlined">person</span>
        </div>
        <div>
            <p class="font-body font-semibold text-on-surface text-sm leading-none">{{ session('nama_lengkap') ?? 'Admin Utama' }}</p>
            <p class="text-[10px] text-gray-400 uppercase tracking-wider mt-1">Super Admin</p>
        </div>
    </div>

    <nav class="flex-1 space-y-2 overflow-y-auto">
        <a href="/admin/dashboard" class="flex items-center gap-3 px-4 py-3 rounded-lg font-body font-medium text-sm transition-all text-gray-600 hover:bg-surface-container-low">
            <span class="material-symbols-outlined text-[20px]">dashboard</span> Dashboard
        </a>
        <a href="/admin/data-relawan" class="flex items-center gap-3 px-4 py-3 rounded-lg font-body font-medium text-sm text-gray-600 hover:bg-surface-container-low transition-all">
            <span class="material-symbols-outlined text-[20px]">group</span> Data Relawan
        </a>
        <a href="/admin/kelola-kegiatan" class="flex items-center gap-3 px-4 py-3 rounded-lg font-body font-medium text-sm transition-all bg-primary text-white shadow-md shadow-red-200">
            <span class="material-symbols-outlined text-[20px]">assignment</span> Kegiatan
        </a>
        <a href="/admin/kelola-dokumentasi" class="flex items-center gap-3 px-4 py-3 rounded-lg font-body font-medium text-sm text-gray-600 hover:bg-surface-container-low transition-all">
            <span class="material-symbols-outlined text-[20px]">image</span> Kelola Dokumentasi
        </a>
        <a href="/admin/kelola-mitra" class="flex items-center gap-3 px-4 py-3 rounded-lg font-body font-medium text-sm text-gray-600 hover:bg-surface-container-low transition-all">
            <span class="material-symbols-outlined text-[20px]">handshake</span> Data Kemitraan
        </a>

        <div class="pt-4 pb-1 px-4 font-headline font-bold text-[10px] uppercase tracking-widest text-gray-400 border-t border-gray-100 mt-4">
            Konten Dropdown Tentang
        </div>

        <a href="/admin/kelola-ukm" class="flex items-center gap-3 px-4 py-3 rounded-lg font-body font-medium text-sm text-gray-600 hover:bg-surface-container-low transition-all">
            <span class="material-symbols-outlined text-[20px]">hub</span> Kelola Info UKM
        </a>

        <a href="/admin/kelola-upnmengajar" class="flex items-center gap-3 px-4 py-3 rounded-lg font-body font-medium text-sm text-gray-600 hover:bg-surface-container-low transition-all">
            <span class="material-symbols-outlined text-[20px]">description</span> Kelola Program Kerja
        </a>

        <a href="/admin/kelola-tim" class="flex items-center gap-3 px-4 py-3 rounded-lg font-body font-medium text-sm text-gray-600 hover:bg-surface-container-low transition-all">
            <span class="material-symbols-outlined text-[20px]">badge</span> Kelola Tim
        </a>
    </nav>

    <div class="pt-6 border-t border-surface-container">
        <form action="/logout" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin keluar?')">
            @csrf
            <button type="submit" class="w-full flex items-center gap-3 px-4 py-3 rounded-lg font-body font-medium text-sm text-red-600 hover:bg-red-50 transition-all group text-left">
                <span class="material-symbols-outlined text-[20px] group-hover:rotate-12 transition-transform">logout</span> Logout
            </button>
        </form>
    </div>
</aside>

<main class="flex-1 ml-72 p-12 max-w-[1100px]">
    
    <div class="mb-8 flex items-center justify-between">
        <div class="space-y-1">
            <a href="/admin/kelola-kegiatan" class="inline-flex items-center gap-1.5 text-xs font-bold text-gray-400 hover:text-primary transition-colors group mb-2 font-headline">
                <span class="material-symbols-outlined text-base group-hover:-translate-x-0.5 transition-transform">arrow_back</span> Kembali ke Manajemen Kegiatan
            </a>
            <h1 class="font-headline font-extrabold text-2xl text-on-surface tracking-tight">Formulir Pembaruan Kegiatan</h1>
            <p class="text-xs text-gray-400 font-medium">Lakukan perubahan informasi, pengaturan linimasa pendaftaran, atau pembagian divisi penempatan.</p>
        </div>
        <span class="bg-surface-container-low border text-gray-600 px-3 py-1 rounded-lg text-[10px] font-bold tracking-wider uppercase font-headline">ID: #{{ $kegiatan->id_kegiatan }}</span>
    </div>

    <form action="/admin/edit-kegiatan/{{ $kegiatan->id_kegiatan }}" method="POST" enctype="multipart/form-data" class="space-y-8">
        @csrf
        @method('PUT')

        <div class="bg-surface-container-lowest border border-gray-100 rounded-2xl p-6 shadow-sm space-y-5">
            <h2 class="text-xs font-black text-gray-400 uppercase tracking-widest border-b pb-3 flex items-center gap-2 font-headline">
                <span class="material-symbols-outlined text-primary text-lg">info</span> Informasi Utama Kegiatan
            </h2>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
                <div class="md:col-span-2">
                    <label class="block text-xs font-bold text-gray-500 mb-1.5 font-headline">Nama Kegiatan / Agenda</label>
                    <input type="text" name="nama_kegiatan" value="{{ $kegiatan->nama_kegiatan ?? '' }}" required class="w-full px-4 py-2.5 bg-surface-container-low border border-gray-200 focus:border-primary focus:bg-white rounded-xl text-xs font-semibold outline-none transition-all">
                </div>
                <div>
                    <label class="block text-xs font-bold text-gray-500 mb-1.5 font-headline">Kategori Jenjang</label>
                    <input type="text" name="kategori" value="{{ $kegiatan->kategori ?? '' }}" placeholder="Contoh: sd, smp, sma, atau umum" required class="w-full px-4 py-2.5 bg-surface-container-low border border-gray-200 focus:border-primary focus:bg-white rounded-xl text-xs font-semibold outline-none transition-all">
                </div>
            </div>
        </div>

        <div class="bg-surface-container-lowest border border-gray-100 rounded-2xl p-6 shadow-sm space-y-5">
            <h2 class="text-xs font-black text-gray-400 uppercase tracking-widest border-b pb-3 flex items-center gap-2 font-headline">
                <span class="material-symbols-outlined text-primary text-lg">calendar_month</span> Penjadwalan & Alur Linimasa
            </h2>
            
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-4">
                <div class="bg-slate-50 p-3 rounded-xl border border-slate-100">
                    <label class="block text-[10px] font-bold uppercase tracking-wider text-slate-400 mb-1.5">1. Pendaftaran Buka</label>
                    <input type="date" name="pendaftaran_dibuka" value="{{ $kegiatan->pendaftaran_dibuka }}" class="w-full px-3 py-1.5 bg-white border border-slate-200 rounded-lg text-xs font-bold text-slate-700 outline-none focus:border-primary">
                </div>
                <div class="bg-slate-50 p-3 rounded-xl border border-slate-100">
                    <label class="block text-[10px] font-bold uppercase tracking-wider text-slate-400 mb-1.5">2. Batas Registrasi</label>
                    <input type="date" name="batas_registrasi" value="{{ $kegiatan->batas_registrasi }}" class="w-full px-3 py-1.5 bg-white border border-slate-200 rounded-lg text-xs font-bold text-slate-700 outline-none focus:border-primary">
                </div>
                <div class="bg-slate-50 p-3 rounded-xl border border-slate-100">
                    <label class="block text-[10px] font-bold uppercase tracking-wider text-slate-400 mb-1.5">3. Hari Pengumuman</label>
                    <input type="date" name="pengumuman_seleksi" value="{{ $kegiatan->pengumuman_seleksi }}" class="w-full px-3 py-1.5 bg-white border border-slate-200 rounded-lg text-xs font-bold text-slate-700 outline-none focus:border-primary">
                </div>
                <div class="bg-surface-container-low p-3 rounded-xl border border-gray-100">
                    <label class="block text-[10px] font-bold uppercase tracking-wider text-gray-400 mb-1.5 font-headline">4. Pelaksanaan H-H</label>
                    <input type="date" name="tanggal_pelaksanaan" value="{{ $kegiatan->tanggal_pelaksanaan ?? '' }}" class="w-full px-3 py-1.5 bg-white border border-gray-200 rounded-lg text-xs font-bold text-gray-700 outline-none focus:border-primary">
                </div>
            </div>
        </div>

        <div class="bg-surface-container-lowest border border-gray-100 rounded-2xl p-6 shadow-sm space-y-4">
            <div class="flex items-center justify-between border-b pb-3">
                <h2 class="text-xs font-black text-gray-400 uppercase tracking-widest flex items-center gap-2 font-headline">
                    <span class="material-symbols-outlined text-primary text-lg">groups</span> Spesifikasi Divisi Relawan
                </h2>
                <span class="text-[10px] bg-red-50 text-primary px-2 py-0.5 rounded font-bold font-headline">Pemisah Koma ( , )</span>
            </div>
            <div>
                <label class="block text-xs font-bold text-slate-500 mb-1">Daftar Kebutuhan Divisi</label>
                <input type="text" name="divisi_dibutuhkan" value="{{ $kegiatan->divisi_dibutuhkan }}" placeholder="Contoh: Divisi Mengajar, Divisi Logistik, Medis, Dokumentasi" class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 focus:border-primary focus:bg-white rounded-xl text-xs font-semibold outline-none transition-all">
                <p class="text-[10px] text-slate-400 mt-1.5 font-medium leading-relaxed">Sistem akan secara otomatis memecah isian teks di atas menjadi label tag dinamis pada lembar rincian kegiatan relawan.</p>
            </div>
        </div>

        <div class="bg-surface-container-lowest border border-gray-100 rounded-2xl p-6 shadow-sm space-y-5">
            <h2 class="text-xs font-black text-gray-400 uppercase tracking-widest border-b pb-3 flex items-center gap-2 font-headline">
                <span class="material-symbols-outlined text-primary text-lg">pin_drop</span> Titik Lokasi & Waktu Operasional
            </h2>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
                <div class="md:col-span-2">
                    <label class="block text-xs font-bold text-gray-500 mb-1.5 font-headline">Nama Instansi / Sekolah Penempatan</label>
                    <input type="text" name="lokasi" value="{{ $kegiatan->lokasi ?? '' }}" required class="w-full px-4 py-2.5 bg-surface-container-low border border-gray-200 focus:border-primary focus:bg-white rounded-xl text-xs font-semibold outline-none transition-all">
                </div>
                <div>
                    <label class="block text-xs font-bold text-gray-500 mb-1.5 font-headline">Jam Kegiatan (WIB)</label>
                    <input type="text" name="jam_kegiatan" value="{{ $kegiatan->jam_kegiatan ?? '' }}" placeholder="Contoh: 08.00 - Selesai" class="w-full px-4 py-2.5 bg-surface-container-low border border-gray-200 focus:border-primary focus:bg-white rounded-xl text-xs font-semibold outline-none transition-all">
                </div>
                <div class="md:col-span-3">
                    <label class="block text-xs font-bold text-gray-500 mb-1.5 font-headline">Alamat Lengkap Titik Lokasi</label>
                    <input type="text" name="alamat_lengkap" value="{{ $kegiatan->alamat_lengkap ?? '' }}" required class="w-full px-4 py-2.5 bg-surface-container-low border border-gray-200 focus:border-primary focus:bg-white rounded-xl text-xs font-semibold outline-none transition-all">
                </div>
            </div>
        </div>

        <div class="bg-surface-container-lowest border border-gray-100 rounded-2xl p-6 shadow-sm space-y-5">
            <h2 class="text-xs font-black text-gray-400 uppercase tracking-widest border-b pb-3 flex items-center gap-2 font-headline">
                <span class="material-symbols-outlined text-primary text-lg">subject</span> Detail Narasi & Lampiran Berkas
            </h2>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                <div>
                    <label class="block text-xs font-bold text-gray-500 mb-1.5 font-headline">Deskripsi Detail Kegiatan</label>
                    <textarea name="deskripsi_detail" rows="5" class="w-full px-4 py-3 bg-surface-container-low border border-gray-200 focus:border-primary focus:bg-white rounded-xl text-xs font-medium leading-relaxed outline-none transition-all resize-none">{{ $kegiatan->deskripsi_detail ?? '' }}</textarea>
                </div>
                <div>
                    <label class="block text-xs font-bold text-gray-500 mb-1.5 font-headline">Detail Rincian Aktivitas Relawan</label>
                    <textarea name="detail_aktivitas" rows="5" class="w-full px-4 py-3 bg-surface-container-low border border-gray-200 focus:border-primary focus:bg-white rounded-xl text-xs font-medium leading-relaxed outline-none transition-all resize-none">{{ $kegiatan->detail_aktivitas ?? '' }}</textarea>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-5 pt-4 border-t border-gray-100">
                <div>
                    <label class="block text-xs font-bold text-gray-500 mb-1.5 font-headline">Status Validasi Agenda</label>
                    <select name="status_kegiatan" class="w-full px-4 py-2.5 bg-surface-container-low border border-gray-200 focus:border-primary focus:bg-white rounded-xl text-xs font-bold text-gray-700 outline-none transition-all font-headline">
                        <option value="aktif" {{ ($kegiatan->status_kegiatan ?? '') == 'aktif' ? 'selected' : '' }}>AKTIF (TAMPIL DI PUBLIK)</option>
                        <option value="selesai" {{ ($kegiatan->status_kegiatan ?? '') == 'selesai' ? 'selected' : '' }}>SELESAI / ARSIPKAN</option>
                    </select>
                </div>
                <div>
                    <label class="block text-xs font-bold text-gray-500 mb-1.5 font-headline">Unggah Foto Banner Pendukung</label>
                    <input type="file" name="foto_kegiatan" class="w-full text-xs font-semibold text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-bold file:bg-red-50 file:text-primary hover:file:bg-red-100 transition-all cursor-pointer font-headline">
                    
                    @if(!empty($kegiatan->foto_kegiatan))
                        <div class="mt-4 p-3 bg-surface-container-low border border-gray-100 rounded-xl flex items-center gap-4 max-w-md">
                            <div class="w-20 h-14 bg-white rounded-lg overflow-hidden border border-gray-200 shrink-0">
                                <img src="{{ asset('storage/' . $kegiatan->foto_kegiatan) }}" 
                                     alt="Pratinjau Banner" 
                                     class="w-full h-full object-cover"
                                     onerror="this.onerror=null; this.src='https://placehold.co/600x400/f3f3f3/a3a3a3?text=No+Image';">
                            </div>
                            <div class="overflow-hidden">
                                <span class="text-[9px] uppercase tracking-wider font-bold text-gray-400 block leading-none mb-1 font-headline">Berkas Terpasang</span>
                                <p class="text-xs font-semibold text-gray-700 truncate font-body">{{ $kegiatan->foto_kegiatan }}</p>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <div class="pt-2 flex justify-end gap-3 font-headline">
            <a href="/admin/kelola-kegiatan" class="px-6 py-2.5 border border-gray-200 hover:border-gray-300 rounded-xl text-xs font-bold text-gray-600 hover:bg-surface-container-low transition-all">
                Batalkan Perubahan
            </a>
            <button type="submit" class="bg-primary text-white px-6 py-2.5 rounded-xl text-xs font-bold shadow-md shadow-red-100 hover:bg-red-700 transition-all flex items-center gap-1.5 cursor-pointer">
                <span class="material-symbols-outlined text-sm">save</span> Simpan Perubahan Data
            </button>
        </div>

    </form>
</main>

</body>
</html>