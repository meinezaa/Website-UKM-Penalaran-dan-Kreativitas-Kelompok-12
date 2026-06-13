<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Kegiatan - UPN Mengajar</title>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;600;700;800&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet"/>
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
            <p class="font-body font-semibold text-on-surface text-sm leading-none">{{ session('nama_lengkap', 'Admin1') }}</p>
            <p class="text-[10px] text-gray-400 uppercase tracking-wider mt-1">{{ session('role', 'SUPER ADMIN') }}</p>
        </div>
    </div>

    <nav class="flex-1 space-y-2 overflow-y-auto">
        <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg font-body font-medium text-sm transition-all {{ Request::is('admin/dashboard*') ? 'bg-primary text-white shadow-md shadow-red-200' : 'text-gray-600 hover:bg-surface-container-low' }}">
            <span class="material-symbols-outlined text-[20px]">dashboard</span> Dashboard
        </a>
        <a href="/admin/kelola-relawan" class="flex items-center gap-3 px-4 py-3 rounded-lg font-body font-medium text-sm transition-all {{ Request::is('admin/kelola-relawan*') ? 'bg-primary text-white shadow-md shadow-red-200' : 'text-gray-600 hover:bg-surface-container-low' }}">
            <span class="material-symbols-outlined text-[20px]">group</span> Data Relawan
        </a>
        <a href="/admin/kelola-kegiatan" class="flex items-center gap-3 px-4 py-3 rounded-lg font-body font-medium text-sm transition-all bg-primary text-white shadow-md shadow-red-200">
            <span class="material-symbols-outlined text-[20px]">assignment</span> Kegiatan
        </a>
        <a href="/admin/kelola-dokumentasi" class="flex items-center gap-3 px-4 py-3 rounded-lg font-body font-medium text-sm transition-all {{ Request::is('admin/kelola-dokumentasi*') ? 'bg-primary text-white shadow-md shadow-red-200' : 'text-gray-600 hover:bg-surface-container-low' }}">
            <span class="material-symbols-outlined text-[20px]">image</span> Kelola Dokumentasi
        </a>
        <a href="/admin/kelola-mitra" class="flex items-center gap-3 px-4 py-3 rounded-lg font-body font-medium text-sm transition-all {{ Request::is('admin/kelola-mitra*') ? 'bg-primary text-white shadow-md shadow-red-200' : 'text-gray-600 hover:bg-surface-container-low' }}">
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
        <a href="{{ route('logout') }}" class="w-full flex items-center gap-3 px-4 py-3 rounded-lg font-body font-medium text-sm text-red-600 hover:bg-red-50 transition-all group text-left">
            <span class="material-symbols-outlined text-[20px] group-hover:rotate-12 transition-transform">logout</span> Logout
        </a>
    </div>
</aside>

<main class="flex-1 ml-72 min-h-screen pb-20">
    <header class="w-full sticky top-0 z-40 bg-white/80 backdrop-blur-md flex justify-between items-center px-8 py-4 border-b">
        <div class="flex items-center gap-4">
            <a href="/admin/kelola-kegiatan" class="p-2 hover:bg-gray-100 rounded-xl transition-all flex items-center justify-center text-gray-500 hover:text-black">
                <span class="material-symbols-outlined">arrow_back</span>
            </a>
            <div>
                <h1 class="font-headline font-bold text-2xl text-primary">Tambah Kegiatan Baru</h1>
                <p class="text-xs text-gray-400 mt-0.5">Input data detail kegiatan beserta pengaturan kebutuhan kuota per divisi.</p>
            </div>
        </div>
    </header>

    <div class="p-8 max-w-5xl">
        @if(session('error'))
        <div class="p-4 mb-6 text-sm text-red-800 rounded-xl bg-red-50 border border-red-100 flex items-center gap-2" role="alert">
            <span class="material-symbols-outlined text-base">error</span>
            {{ session('error') }}
        </div>
        @endif

        <form action="{{ route('admin.kegiatan.store') }}" method="POST" enctype="multipart/form-data" class="space-y-8" novalidate>
            @csrf 
            
            <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm space-y-4">
                <div class="flex items-center gap-2 text-primary border-b pb-2 border-gray-100">
                    <span class="material-symbols-outlined text-[20px]">info</span>
                    <h3 class="font-headline font-bold text-sm uppercase tracking-wider">1. Informasi Dasar</h3>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="md:col-span-2">
                        <label class="text-[11px] font-bold text-gray-400 uppercase tracking-wider block mb-1">Nama Kegiatan</label>
                        <input type="text" name="nama_kegiatan" value="{{ old('nama_kegiatan') }}" required placeholder="Contoh: Relawan Penggerak SD Medokan"
                               class="w-full text-sm rounded-xl border-gray-200 focus:border-primary focus:ring-primary">
                    </div>
                    <div class="md:col-span-2">
                        <label class="text-[11px] font-bold text-gray-400 uppercase tracking-wider block mb-1">Foto Utama Kegiatan</label>
                        <input type="file" name="foto_kegiatan" accept="image/*" required
                               class="w-full text-sm rounded-xl border border-gray-200 bg-gray-50 file:mr-4 file:py-2 file:px-4 file:rounded-l-xl file:border-0 file:text-xs file:font-semibold file:bg-red-50 file:text-primary hover:file:bg-red-100">
                        <p class="text-[10px] text-gray-400 mt-1">*Disarankan menggunakan rasio dimensi lanskap 16:9 (Contoh: 1280x720 px)</p>
                    </div>
                    <div>
                        <label class="text-[11px] font-bold text-gray-400 uppercase tracking-wider block mb-1">Kategori Program</label>
                        <select name="kategori" required class="w-full text-sm rounded-xl border-gray-200 focus:border-primary focus:ring-primary bg-white">
                            <option value="sd" {{ old('kategori') == 'sd' ? 'selected' : '' }}>Sekolah Dasar</option>
                            <option value="slb" {{ old('kategori') == 'slb' ? 'selected' : '' }}>Sekolah Luar Biasa</option>
                            <option value="yayasan" {{ old('kategori') == 'yayasan' ? 'selected' : '' }}>Yayasan / Panti</option>
                        </select>
                    </div>
                    <div>
                        <label class="text-[11px] font-bold text-gray-400 uppercase tracking-wider block mb-1">Status Kegiatan</label>
                        <select name="status_kegiatan" class="w-full text-sm rounded-xl border-gray-200 focus:border-primary focus:ring-primary bg-white">
                            <option value="BUKA" {{ old('status_kegiatan') == 'BUKA' ? 'selected' : '' }}>BUKA</option>
                            <option value="BERJALAN" {{ old('status_kegiatan') == 'BERJALAN' ? 'selected' : '' }}>BERJALAN</option>
                            <option value="SELESAI" {{ old('status_kegiatan') == 'SELESAI' ? 'selected' : '' }}>SELESAI</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm space-y-4">
                <div class="flex items-center gap-2 text-primary border-b pb-2 border-gray-100">
                    <span class="material-symbols-outlined text-[20px]">location_on</span>
                    <h3 class="font-headline font-bold text-sm uppercase tracking-wider">2. Waktu & Lokasi</h3>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div>
                        <label class="text-[11px] font-bold text-gray-400 uppercase tracking-wider block mb-1">Tanggal Pelaksanaan</label>
                        <input type="date" name="tanggal_pelaksanaan" value="{{ old('tanggal_pelaksanaan') }}" required class="w-full text-sm rounded-xl border-gray-200 focus:border-primary focus:ring-primary">
                    </div>
                    <div>
                        <label class="text-[11px] font-bold text-gray-400 uppercase tracking-wider block mb-1">Jam Kegiatan</label>
                        <input type="text" name="jam_kegiatan" value="{{ old('jam_kegiatan') }}" required placeholder="08.00 - 12.00 WIB" class="w-full text-sm rounded-xl border-gray-200 focus:border-primary focus:ring-primary">
                    </div>
                    <div>
                        <label class="text-[11px] font-bold text-gray-400 uppercase tracking-wider block mb-1">Batas Penutupan Registrasi</label>
                        <input type="date" name="batas_registrasi" value="{{ old('batas_registrasi') }}" required class="w-full text-sm rounded-xl border-gray-200 focus:border-primary focus:ring-primary">
                    </div>
                    <div class="md:col-span-3">
                        <label class="text-[11px] font-bold text-gray-400 uppercase tracking-wider block mb-1">Nama Tempat / Lokasi (Gedung/Sekolah)</label>
                        <input type="text" name="lokasi" value="{{ old('lokasi') }}" required placeholder="Contoh: SD Medokan Ayu 1" class="w-full text-sm rounded-xl border-gray-200 focus:border-primary focus:ring-primary">
                    </div>
                    <div class="md:col-span-3">
                        <label class="text-[11px] font-bold text-gray-400 uppercase tracking-wider block mb-1">Alamat Lengkap</label>
                        <textarea name="alamat_lengkap" rows="2" required placeholder="Jl. Raya Medokan Sawah No.7, Kec. Rungkut..." class="w-full text-sm rounded-xl border-gray-200 focus:border-primary focus:ring-primary">{{ old('alamat_lengkap') }}</textarea>
                    </div>
                </div>
            </div>

            <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm space-y-4">
                <div class="flex items-center gap-2 text-primary border-b pb-2 border-gray-100">
                    <span class="material-symbols-outlined text-[20px]">description</span>
                    <h3 class="font-headline font-bold text-sm uppercase tracking-wider">3. Deskripsi & Aktivitas</h3>
                </div>
                
                <div class="space-y-4">
                    <div>
                        <label class="text-[11px] font-bold text-gray-400 uppercase tracking-wider block mb-1">Detail Aktivitas Utama (Poin-poin singkat)</label>
                        <textarea name="detail_aktivitas" rows="3" required placeholder="Mendampingi belajar mengajar di kelas, Membantu program literasi sekolah, Mengadakan fun-games edukatif..." class="w-full text-sm rounded-xl border-gray-200 focus:border-primary focus:ring-primary">{{ old('detail_aktivitas') }}</textarea>
                    </div>
                    <div>
                        <label class="text-[11px] font-bold text-gray-400 uppercase tracking-wider block mb-1">Deskripsi Lengkap / Latar Belakang Kegiatan</label>
                        <textarea name="deskripsi_detail" rows="4" required placeholder="Berikan rincian detail mengenai latar belakang penugasan, benefit bagi relawan, maupun output yang ditargetkan..." class="w-full text-sm rounded-xl border-gray-200 focus:border-primary focus:ring-primary">{{ old('deskripsi_detail') }}</textarea>
                    </div>
                </div>
            </div>

            <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm space-y-4">
                <div class="flex items-center gap-2 text-primary border-b pb-2 border-gray-100">
                    <span class="material-symbols-outlined text-[20px]">groups</span>
                    <h3 class="font-headline font-bold text-sm uppercase tracking-wider">4. Kebutuhan Per Divisi</h3>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    @php 
                    $divisis = [
                        'sekretaris' => 'Sekretaris', 'bendahara' => 'Bendahara', 
                        'acara' => 'Acara', 'humas' => 'Humas', 
                        'perkap' => 'Perkap', 'pendamping' => 'Pendamping Kelompok', 
                        'pdd' => 'PDD / Dokumentasi', 'sponsorship' => 'Sponsorship'
                    ];
                    @endphp
                    
                    @foreach($divisis as $key => $label)
                    <div class="p-4 bg-surface rounded-xl border border-gray-100 space-y-3">
                        <label class="font-headline font-bold text-sm text-gray-700 block border-b pb-1.5 border-dashed border-gray-200">{{ $label }}</label>
                        <div class="grid grid-cols-3 gap-3">
                            <div class="col-span-1">
                                <label class="text-[10px] font-bold text-gray-400 uppercase tracking-wider block mb-0.5">Kuota (Orang)</label>
                                <input type="number" name="kuota_{{ $key }}" value="{{ old('kuota_'.$key) }}" placeholder="0" min="0" class="w-full text-sm rounded-xl border-gray-200 focus:border-primary focus:ring-primary">
                            </div>
                            <div class="col-span-2">
                                <label class="text-[10px] font-bold text-gray-400 uppercase tracking-wider block mb-0.5">Job Description Singkat</label>
                                <input type="text" name="jobdesc_{{ $key }}" value="{{ old('jobdesc_'.$key) }}" placeholder="Tugas utama divisi..." class="w-full text-sm rounded-xl border-gray-200 focus:border-primary focus:ring-primary">
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

            <div class="flex items-center gap-4 pt-4">
                <button type="submit" class="flex-1 bg-primary hover:bg-red-700 text-white font-bold py-3.5 px-4 rounded-xl transition-all shadow-md shadow-red-100 text-center text-sm cursor-pointer">
                    Simpan & Terbitkan Kegiatan
                </button>
                <a href="/admin/kelola-kegiatan" class="flex-1 bg-gray-100 hover:bg-gray-200 text-gray-600 font-bold py-3.5 px-4 rounded-xl transition-all text-center text-sm">
                    Batalkan
                </a>
            </div>
        </form>
    </div>
</main>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.querySelector('form').addEventListener('submit', function(e) {
        let adaYangKosong = false;
        const inputWajib = document.querySelectorAll('input[required], select[required], textarea[required]');
        
        inputWajib.forEach(input => {
            if (input.type === 'file') {
                if (input.files.length === 0) { adaYangKosong = true; }
            } else {
                if (input.value.trim() === '') { adaYangKosong = true; }
            }
        });

        if (adaYangKosong) {
            e.preventDefault(); 
            Swal.fire({
                icon: 'warning',
                title: 'Data Belum Lengkap!',
                text: 'Mohon isi seluruh kolom wajib dan unggah foto kegiatan sebelum menyimpan.',
                confirmButtonColor: '#bb0016'
            });
            return; 
        }

        let totalKuota = 0;
        const kuotaInputs = document.querySelectorAll('input[name^="kuota_"]');
        kuotaInputs.forEach(input => {
            totalKuota += Number(input.value) || 0; 
        });

        if (totalKuota === 0) {
            e.preventDefault();
            Swal.fire({
                icon: 'warning',
                title: 'Kuota Divisi Kosong!',
                text: 'Harap masukkan minimal 1 kuota relawan pada salah satu divisi yang tersedia.',
                confirmButtonColor: '#bb0016'
            });
            return;
        }
    });
</script>
</body>
</html>