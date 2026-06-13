<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - Kelola UPN Mengajar</title>
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
        .material-symbols-outlined { font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24; }
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
        <a href="/admin/dashboard" class="flex items-center gap-3 px-4 py-3 rounded-lg font-body font-medium text-sm text-gray-600 hover:bg-surface-container-low transition-all">
            <span class="material-symbols-outlined text-[20px]">dashboard</span> Dashboard
        </a>
        
        <a href="/admin/data-relawan" class="flex items-center gap-3 px-4 py-3 rounded-lg font-body font-medium text-sm text-gray-600 hover:bg-surface-container-low transition-all">
            <span class="material-symbols-outlined text-[20px]">group</span> Data Relawan
        </a>
        
        <a href="/admin/kelola-kegiatan" class="flex items-center gap-3 px-4 py-3 rounded-lg font-body font-medium text-sm text-gray-600 hover:bg-surface-container-low transition-all">
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

        <a href="/admin/kelola-upnmengajar" class="flex items-center gap-3 px-4 py-3 rounded-lg font-body font-medium text-sm transition-all bg-primary text-white shadow-md shadow-red-200">
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

<main class="flex-1 ml-72 min-h-screen pb-20">
    <header class="w-full sticky top-0 z-40 bg-white/80 backdrop-blur-md flex justify-between items-center px-8 py-4 border-b">
        <h1 class="font-headline font-bold text-2xl text-primary">Kelola Konten Publik UPN Mengajar</h1>
        <div class="flex items-center gap-4">
           <a href="{{ url('/') }}" class="flex items-center gap-2 px-4 py-2 bg-gray-100 hover:bg-gray-200 rounded-xl text-sm font-bold text-gray-700 transition-all">
                <span class="material-symbols-outlined text-lg">home</span> Beranda
            </a>
        </div>
    </header>

    <div class="p-8 max-w-4xl space-y-6">
        
        @if(session('pesan'))
            <div class="p-4 mb-4 text-sm text-green-800 rounded-xl bg-green-50 border border-green-200 shadow-sm flex items-center gap-2" role="alert">
                <span class="material-symbols-outlined text-lg">check_circle</span>
                <div><span class="font-bold">Berhasil!</span> {{ session('pesan') }}</div>
            </div>
        @endif

        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="p-6 bg-gray-50/50 border-b border-gray-100 flex items-center gap-3">
                <span class="material-symbols-outlined text-primary">edit_note</span>
                <div>
                    <h3 class="font-headline font-bold text-gray-900">Pengaturan Seluruh Komponen Halaman</h3>
                    <p class="text-xs text-gray-500 mt-0.5">Kelola data tekstual dari bagian atas (Hero Banner) hingga kutipan di halaman publik.</p>
                </div>
            </div>

            <form action="{{ route('admin.kelola_upnmengajar.update') }}" method="POST" class="p-6 space-y-6">
                @csrf
                <input type="hidden" name="id_setting" value="{{ $profil->id_setting ?? '' }}">
                
                <div class="space-y-4">
                    <h4 class="text-xs font-bold text-gray-400 uppercase tracking-wider pb-1 border-b border-gray-100">1. Bagian Atas (Hero Banner)</h4>
                    
                    <div class="space-y-2">
                        <label for="sub_judul" class="block font-body font-semibold text-sm text-gray-700">Sub Judul / Tag Kategori</label>
                        <input 
                            type="text" name="sub_judul" id="sub_judul"
                            value="{{ $profil->sub_judul ?? 'Program Kerja Bidang SOSIAL & PENDIDIKAN' }}"
                            class="w-full rounded-xl border-gray-200 text-sm focus:border-primary focus:ring-primary transition-all py-3"
                        />
                    </div>

                    <div class="space-y-2">
                        <label for="judul_hero" class="block font-body font-semibold text-sm text-gray-700">Judul Utama Banner <span class="text-red-500">*</span></label>
                        <input 
                            type="text" name="judul_hero" id="judul_hero" required
                            value="{{ $profil->judul_hero ?? 'Mencerdaskan Bangsa Melalui Aksi Nyata.' }}"
                            class="w-full rounded-xl border-gray-200 text-sm focus:border-primary focus:ring-primary transition-all py-3"
                        />
                    </div>

                    <div class="space-y-2">
                        <label for="deskripsi_hero" class="block font-body font-semibold text-sm text-gray-700">Deskripsi Pendek Banner <span class="text-red-500">*</span></label>
                        <textarea 
                            name="deskripsi_hero" id="deskripsi_hero" rows="3" required
                            class="w-full rounded-xl border-gray-200 text-sm focus:border-primary focus:ring-primary transition-all"
                        >{{ $profil->deskripsi_hero ?? 'Pendekatan interaktif untuk menutup celah pendidikan pasca-pandemi. Kami menghadirkan pengalaman belajar bermakna bagi seluruh lapisan masyarakat.' }}</textarea>
                    </div>
                </div>

                <div class="space-y-4 pt-4 border-t border-gray-100">
                    <h4 class="text-xs font-bold text-gray-400 uppercase tracking-wider pb-1 border-b border-gray-100">2. Bagian Konten & Metodologi</h4>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="space-y-2">
                            <label for="sdgs_text" class="block font-body font-semibold text-sm text-gray-700">Penjelasan SDGs 4</label>
                            <textarea 
                                name="sdgs_text" id="sdgs_text" rows="4" 
                                class="w-full rounded-xl border-gray-200 text-sm focus:border-primary focus:ring-primary transition-all"
                            >{{ $profil->sdgs_text ?? 'Output utama kami adalah memastikan teknik pembelajaran yang diajarkan dapat diterapkan secara mandiri oleh peserta di lingkungan mereka secara berkelanjutan.' }}</textarea>
                        </div>

                        <div class="space-y-2">
                            <label for="metodologi_text" class="block font-body font-semibold text-sm text-gray-700">Deskripsi Metodologi Pengajaran</label>
                            <textarea 
                                name="metodologi_text" id="metodologi_text" rows="4" 
                                class="w-full rounded-xl border-gray-200 text-sm focus:border-primary focus:ring-primary transition-all"
                            >{{ $profil->metodologi_text ?? 'Menyusun modul adaptif pasca-pandemi yang berfokus pada pendekatan kreatif, emosional, dan motorik agar anak-anak memperoleh pengalaman belajar bermakna.' }}</textarea>
                        </div>
                    </div>
                </div>

                <div class="space-y-4 pt-4 border-t border-gray-100">
                    <h4 class="text-xs font-bold text-gray-400 uppercase tracking-wider pb-1 border-b border-gray-100">3. Bagian Kutipan (Quotes)</h4>
                    
                    <div class="space-y-2">
                        <label for="quotes" class="block font-body font-semibold text-sm text-gray-700">Kalimat Kutipan Utama</label>
                        <textarea 
                            name="quotes" id="quotes" rows="2" 
                            class="w-full rounded-xl border-gray-200 text-sm focus:border-primary focus:ring-primary transition-all italic font-medium"
                        >{{ $profil->quotes ?? '"Bukan hanya sekadar mengajar materi sekolah, tetapi kami membekali mereka dengan kreativitas untuk masa depan yang lebih cerah."' }}</textarea>
                    </div>
                </div>

                <div class="pt-4 border-t border-gray-100 flex justify-end">
                    <button type="submit" class="bg-primary text-white px-6 py-3 rounded-xl text-sm font-bold flex items-center gap-2 hover:bg-red-700 transition-all shadow-md shadow-red-100">
                        <span class="material-symbols-outlined text-lg">save</span> Simpan Perubahan Data
                    </button>
                </div>
            </form>
        </div>

    </div>
</main>

</body>
</html>