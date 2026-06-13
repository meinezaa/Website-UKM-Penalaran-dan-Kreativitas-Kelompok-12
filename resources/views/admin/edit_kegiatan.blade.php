<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Kegiatan - UPN Mengajar</title>
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;600;700;800&family=Inter:wght@400;500;600&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        "primary": "#bb0016",
                        "surface": "#f8fafc",
                        "surface-card": "#ffffff",
                    },
                    fontFamily: { headline: ["Manrope"], body: ["Inter"] }
                }
            }
        }
    </script>
    <style>
        .material-symbols-outlined { font-variation-settings: 'FILL' 0, 'wght' 500, 'GRAD' 0, 'opsz' 24; }
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="bg-surface text-slate-800 flex min-h-screen">

<!-- SIDEBAR FIX (Ditambahkan agar layouting halaman konsisten dengan dashboard utama) -->
<aside class="h-screen w-72 fixed left-0 top-0 bottom-0 z-50 p-6 flex flex-col bg-white border-r border-slate-100 shadow-[10px_0_30px_rgba(0,0,0,0.01)]">
    <div class="mb-10 px-4">
        <span class="font-headline font-extrabold text-primary text-2xl tracking-tighter uppercase">UPN Mengajar</span>
    </div>

    <div class="flex items-center gap-4 px-4 py-4 mb-6 rounded-2xl bg-slate-50 border border-slate-100">
        <div class="w-10 h-10 rounded-full bg-red-50 flex items-center justify-center text-primary font-bold shadow-sm">
            <span class="material-symbols-outlined text-xl">person</span>
        </div>
        <div>
            <p class="font-semibold text-slate-800 text-xs leading-none">{{ Auth::user()->nama_lengkap ?? 'Admin' }}</p>
            <p class="text-[9px] text-slate-400 uppercase tracking-wider mt-1 font-bold">Super Admin</p>
        </div>
    </div>

    <nav class="flex-1 space-y-1.5">
        <a href="/admin/dashboard" class="flex items-center gap-3 px-4 py-3 rounded-xl text-slate-500 hover:bg-slate-50 hover:text-slate-900 transition-all">
            <span class="material-symbols-outlined text-[20px]">dashboard</span> 
            <span class="text-xs font-semibold">Dashboard</span>
        </a>
        <a href="/admin/kelola-relawan" class="flex items-center gap-3 px-4 py-3 rounded-xl text-slate-500 hover:bg-slate-50 hover:text-slate-900 transition-all">
            <span class="material-symbols-outlined text-[20px]">group</span> 
            <span class="text-xs font-semibold">Data Relawan</span>
        </a>
        <a href="/admin/kelola-kegiatan" class="flex items-center gap-3 px-4 py-3 rounded-xl bg-primary text-white shadow-md shadow-red-100">
            <span class="material-symbols-outlined text-[20px]">assignment</span> 
            <span class="text-xs font-semibold">Kelola Kegiatan</span>
        </a>
    </nav>
</aside>

<!-- MAIN CONTENT LAYER -->
<main class="flex-1 ml-72 p-12 max-w-[1000px]">
    
    <!-- TOP NAVIGATION / BACK BUTTON -->
    <div class="mb-8 flex items-center justify-between">
        <div class="space-y-1">
            <a href="/admin/kelola-kegiatan" class="inline-flex items-center gap-1.5 text-xs font-bold text-slate-400 hover:text-primary transition-colors group mb-2">
                <span class="material-symbols-outlined text-base group-hover:-translate-x-0.5 transition-transform">arrow_back</span> Kembali ke Manajemen Kegiatan
            </a>
            <h1 class="font-headline font-extrabold text-2xl text-slate-900 tracking-tight">Formulir Pembaruan Kegiatan</h1>
            <p class="text-xs text-slate-400 font-medium">Lakukan perubahan informasi, pengaturan linimasa pendaftaran, atau pembagian divisi penempatan.</p>
        </div>
        <span class="bg-slate-100 border text-slate-600 px-3 py-1 rounded-lg text-[10px] font-bold tracking-wider uppercase">ID: #{{ $kegiatan->id_kegiatan }}</span>
    </div>

    <!-- FORM CARD UTAMA -->
    <form action="/admin/edit-kegiatan/{{ $kegiatan->id_kegiatan }}" method="POST" enctype="multipart/form-data" class="space-y-8">
        @csrf
        @method('PUT')

        <!-- SECTION 1: DATA INTI & INFORMASI UTAMA -->
        <div class="bg-white border border-slate-100 rounded-2xl p-6 shadow-sm space-y-5">
            <h2 class="text-xs font-black text-slate-400 uppercase tracking-widest border-b pb-3 flex items-center gap-2">
                <span class="material-symbols-outlined text-primary text-lg">info</span> Informasi Utama Kegiatan
            </h2>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
                <div class="md:col-span-2">
                    <label class="block text-xs font-bold text-slate-500 mb-1.5">Nama Kegiatan / Agenda</label>
                    <input type="text" name="nama_kegiatan" value="{{ $kegiatan->nama_kegiatan }}" required class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 focus:border-primary focus:bg-white rounded-xl text-xs font-semibold outline-none transition-all">
                </div>
                <div>
                    <label class="block text-xs font-bold text-slate-500 mb-1.5">Kategori Jenjang</label>
                    <input type="text" name="kategori" value="{{ $kegiatan->kategori }}" placeholder="Contoh: sd, smp, sma, atau umum" required class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 focus:border-primary focus:bg-white rounded-xl text-xs font-semibold outline-none transition-all">
                </div>
            </div>
        </div>

        <!-- SECTION 2: TIMELINE / LINIMASA TANGGAL -->
        <div class="bg-white border border-slate-100 rounded-2xl p-6 shadow-sm space-y-5">
            <h2 class="text-xs font-black text-slate-400 uppercase tracking-widest border-b pb-3 flex items-center gap-2">
                <span class="material-symbols-outlined text-primary text-lg">calendar_month</span> Penjadwalan & Alur Linimasa
            </h2>
            
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-4">
                <div class="bg-slate-50 p-3 rounded-xl border border-slate-100">
                    <label class="block text-[10px] font-bold uppercase tracking-wider text-slate-400 mb-1.5">2. Batas Registrasi</label>
                    <input type="date" name="batas_registrasi" value="{{ $kegiatan->batas_registrasi }}" class="w-full px-3 py-1.5 bg-white border border-slate-200 rounded-lg text-xs font-bold text-slate-700 outline-none focus:border-primary">
                </div>
                <div class="bg-slate-50 p-3 rounded-xl border border-slate-100">
                    <label class="block text-[10px] font-bold uppercase tracking-wider text-slate-400 mb-1.5">Tanggal Pelaksanaan</label>
                    <input type="date" name="tanggal_pelaksanaan" value="{{ $kegiatan->tanggal_pelaksanaan }}" class="w-full px-3 py-1.5 bg-white border border-slate-200 rounded-lg">
                </div>
                <div class="bg-slate-50 p-3 rounded-xl border border-slate-100">
                    <label class="block text-[10px] font-bold uppercase tracking-wider text-slate-400 mb-1.5">4. Pelaksanaan H-H</label>
                    <input type="date" name="tanggal_pelaksanaan" value="{{ $kegiatan->tanggal_pelaksanaan }}" class="w-full px-3 py-1.5 bg-white border border-slate-200 rounded-lg text-xs font-bold text-slate-700 outline-none focus:border-primary">
                </div>
            </div>
        </div>

        <!-- SECTION 3: KEBUTUHAN DIVISI RELAWAN -->
        <div class="bg-white border border-slate-100 rounded-2xl p-6 shadow-sm space-y-4">
            <div class="flex items-center justify-between border-b pb-3">
                <h2 class="text-xs font-black text-slate-400 uppercase tracking-widest flex items-center gap-2">
                    <span class="material-symbols-outlined text-primary text-lg">groups</span> Spesifikasi Divisi Relawan
                </h2>
                <span class="text-[10px] bg-red-50 text-primary px-2 py-0.5 rounded font-bold">Pemisah Koma ( , )</span>
            </div>
        </div>

        <!-- SECTION 4: TEMPAT PELAKSANAAN & WAKTU LOGISTIK -->
        <div class="bg-white border border-slate-100 rounded-2xl p-6 shadow-sm space-y-5">
            <h2 class="text-xs font-black text-slate-400 uppercase tracking-widest border-b pb-3 flex items-center gap-2">
                <span class="material-symbols-outlined text-primary text-lg">pin_drop</span> Titik Lokasi & Waktu Operasional
            </h2>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
                <div class="md:col-span-2">
                    <label class="block text-xs font-bold text-slate-500 mb-1.5">Nama Instansi / Sekolah Penempatan</label>
                    <input type="text" name="lokasi" value="{{ $kegiatan->lokasi }}" required class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 focus:border-primary focus:bg-white rounded-xl text-xs font-semibold outline-none transition-all">
                </div>
                <div>
                    <label class="block text-xs font-bold text-slate-500 mb-1.5">Jam Kegiatan (WIB)</label>
                    <input type="text" name="jam_kegiatan" value="{{ $kegiatan->jam_kegiatan }}" placeholder="Contoh: 08.00 - Selesai" class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 focus:border-primary focus:bg-white rounded-xl text-xs font-semibold outline-none transition-all">
                </div>
                <div class="md:col-span-3">
                    <label class="block text-xs font-bold text-slate-500 mb-1.5">Alamat Lengkap Titik Lokasi</label>
                    <input type="text" name="alamat_lengkap" value="{{ $kegiatan->alamat_lengkap }}" required class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 focus:border-primary focus:bg-white rounded-xl text-xs font-semibold outline-none transition-all">
                </div>
            </div>
        </div>

        <!-- SECTION 5: NARASI PANJANG & MEDIA BANNER -->
        <div class="bg-white border border-slate-100 rounded-2xl p-6 shadow-sm space-y-5">
            <h2 class="text-xs font-black text-slate-400 uppercase tracking-widest border-b pb-3 flex items-center gap-2">
                <span class="material-symbols-outlined text-primary text-lg">subject</span> Detail Narasi & Lampiran Berkas
            </h2>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                <div>
                    <label class="block text-xs font-bold text-slate-500 mb-1.5">Deskripsi Detail Kegiatan</label>
                    <textarea name="deskripsi_detail" rows="5" class="w-full px-4 py-3 bg-slate-50 border border-slate-200 focus:border-primary focus:bg-white rounded-xl text-xs font-medium leading-relaxed outline-none transition-all resize-none">{{ $kegiatan->deskripsi_detail }}</textarea>
                </div>
                <div>
                    <label class="block text-xs font-bold text-slate-500 mb-1.5">Detail Rincian Aktivitas Relawan</label>
                    <textarea name="detail_aktivitas" rows="5" class="w-full px-4 py-3 bg-slate-50 border border-slate-200 focus:border-primary focus:bg-white rounded-xl text-xs font-medium leading-relaxed outline-none transition-all resize-none">{{ $kegiatan->detail_aktivitas }}</textarea>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-5 pt-2 border-t border-slate-50">
                <div>
                    <label class="block text-xs font-bold text-slate-500 mb-1.5">Status Validasi Agenda</label>
                    <select name="status_kegiatan" class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 focus:border-primary focus:bg-white rounded-xl text-xs font-bold text-slate-700 outline-none transition-all">
                        <option value="aktif" {{ $kegiatan->status_kegiatan == 'aktif' ? 'selected' : '' }}>AKTIF (TAMPIL DI PUBLIK)</option>
                        <option value="selesai" {{ $kegiatan->status_kegiatan == 'selesai' ? 'selected' : '' }}>SELESAI / ARSIPKAN</option>
                    </select>
                </div>
                <div>
                    <label class="block text-xs font-bold text-slate-500 mb-1.5">Unggah Foto Banner Pendukung</label>
                    <input type="file" name="foto_kegiatan" class="w-full text-xs font-semibold text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-bold file:bg-red-50 file:text-primary hover:file:bg-red-100 transition-all cursor-pointer">
                    @if($kegiatan->foto_kegiatan)
                        <div class="mt-2 flex items-center gap-1.5 text-[10px] font-medium text-slate-400 bg-slate-50 px-2.5 py-1 rounded-lg border w-fit">
                            <span class="material-symbols-outlined text-sm">attach_file</span> Berkas terpasang: {{ $kegiatan->foto_kegiatan }}
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- FOOTER SUBMIT ACTIONS -->
        <div class="pt-2 flex justify-end gap-3">
            <a href="/admin/kelola-kegiatan" class="px-6 py-2.5 border border-slate-200 hover:border-slate-300 rounded-xl text-xs font-bold text-slate-600 hover:bg-slate-50 transition-all">
                Batalkan Perubahan
            </a>
            <button type="submit" class="bg-primary text-white px-6 py-2.5 rounded-xl text-xs font-bold shadow-md shadow-red-100 hover:bg-red-700 transition-all flex items-center gap-1.5">
                <span class="material-symbols-outlined text-sm">save</span> Simpan Perubahan Data
            </button>
        </div>

    </form>
</main>

</body>
</html>