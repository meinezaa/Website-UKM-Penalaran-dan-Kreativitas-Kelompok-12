<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Relawan - UPN Mengajar</title>
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
        <a href="/admin/kelola-relawan" class="flex items-center gap-3 px-4 py-3 rounded-lg font-body font-medium text-sm transition-all bg-primary text-white shadow-md shadow-red-200">
            <span class="material-symbols-outlined text-[20px]">group</span> Data Relawan
        </a>
        <a href="/admin/kelola-kegiatan" class="flex items-center gap-3 px-4 py-3 rounded-lg font-body font-medium text-sm transition-all {{ Request::is('admin/kelola-kegiatan*') ? 'bg-primary text-white shadow-md shadow-red-200' : 'text-gray-600 hover:bg-surface-container-low' }}">
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
            <a href="/admin/kelola-relawan" class="p-2 hover:bg-gray-100 rounded-xl transition-all flex items-center justify-center text-gray-500 hover:text-black">
                <span class="material-symbols-outlined">arrow_back</span>
            </a>
            <div>
                <h1 class="font-headline font-bold text-2xl text-primary">Detail Berkas Pendaftaran</h1>
                <p class="text-xs text-gray-400 mt-0.5">Evaluasi keselarasan profil pendaftar dengan divisi target.</p>
            </div>
        </div>
        
        <div>
            @php
                $status = strtoupper($relawan->status_seleksi ?? 'PROSES');
                $color = "bg-yellow-50 text-yellow-600 border-yellow-100";
                if($status == 'DITERIMA') $color = "bg-green-50 text-green-600 border-green-100";
                if($status == 'DITOLAK') $color = "bg-red-50 text-red-600 border-red-100";
            @endphp
            <span class="px-4 py-1.5 {{ $color }} rounded-xl text-xs font-black border uppercase tracking-wider">
                Status Saat Ini: {{ $status }}
            </span>
        </div>
    </header>

    <div class="p-8 max-w-5xl space-y-8">
        @if(session('pesan'))
            <div class="p-4 text-sm text-green-800 rounded-lg bg-green-50 border border-green-100 flex items-center gap-2" role="alert">
                <span class="material-symbols-outlined text-base">check_circle</span>
                {{ session('pesan') }}
            </div>
        @endif

        <div class="grid grid-cols-3 gap-8">
            <div class="col-span-1 space-y-6">
                <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm text-center flex flex-col items-center">
                    <div class="w-20 h-20 rounded-2xl bg-red-50 text-primary flex items-center justify-center font-headline font-black text-2xl border border-red-100 mb-4 shadow-sm shadow-red-50">
                        {{ strtoupper(substr($relawan->nama_lengkap ?? 'R', 0, 1)) }}
                    </div>
                    <h3 class="font-headline font-bold text-on-surface text-lg leading-snug">{{ $relawan->nama_lengkap ?? 'Nama Relawan' }}</h3>
                    <p class="text-xs text-gray-400 font-medium mt-1 truncate w-full">{{ $relawan->email ?? '-' }}</p>
                    
                    <div class="w-full border-t border-dashed border-gray-100 my-5"></div>
                    
                    <div class="w-full space-y-3.5 text-left">
                        <div>
                            <span class="text-[10px] font-bold text-gray-400 uppercase tracking-wider block">Program Studi</span>
                            <span class="text-sm font-semibold text-gray-700 block mt-0.5">{{ $relawan->asal_prodi }}</span>
                        </div>
                        <div>
                            <span class="text-[10px] font-bold text-gray-400 uppercase tracking-wider block">Kontak WhatsApp</span>
                            <a href="https://wa.me/{{ $relawan->no_hp }}" target="_blank" class="text-sm font-bold text-primary hover:underline flex items-center gap-1 mt-0.5">
                                {{ $relawan->no_hp }} <span class="material-symbols-outlined text-xs">open_in_new</span>
                            </a>
                        </div>
                        <div>
                            <span class="text-[10px] font-bold text-gray-400 uppercase tracking-wider block">Karakteristik Fisik</span>
                            <span class="text-sm font-semibold text-gray-700 block mt-0.5">{{ $relawan->jenis_kelamin }} ({{ $relawan->umur }} Tahun)</span>
                        </div>
                    </div>
                </div>

                <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm space-y-4">
                    <h4 class="font-headline font-bold text-sm text-gray-800">Tentukan Keputusan Seleksi</h4>
                    <p class="text-xs text-gray-400 leading-normal">Tindakan ini akan langsung memperbarui status pelamar dan mengunci keputusannya.</p>
                    
                    <form action="{{ route('admin.relawan.update_status', $relawan->id_pendaftaran) }}" method="POST" class="space-y-2">
                        @csrf
                        <button type="submit" name="status_seleksi" value="DITERIMA" class="w-full bg-emerald-600 hover:bg-emerald-700 text-white font-bold text-xs py-3 px-4 rounded-xl transition-all shadow-md shadow-emerald-50 flex items-center justify-center gap-2 cursor-pointer">
                            <span class="material-symbols-outlined text-sm">check</span> Terima Sebagai Relawan
                        </button>
                        <button type="submit" name="status_seleksi" value="DITOLAK" class="w-full bg-primary hover:bg-red-700 text-white font-bold text-xs py-3 px-4 rounded-xl transition-all shadow-md shadow-red-50 flex items-center justify-center gap-2 cursor-pointer">
                            <span class="material-symbols-outlined text-sm">close</span> Tolak Pendaftaran
                        </button>
                    </form>
                </div>
            </div>

            <div class="col-span-2 space-y-6">
                <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm space-y-4">
                    <div class="flex items-center gap-2 text-primary">
                        <span class="material-symbols-outlined text-[20px]">assignment</span>
                        <h4 class="font-headline font-bold text-sm uppercase tracking-wider">Agenda Kegiatan yang Diikuti</h4>
                    </div>
                    <div class="bg-surface p-4 rounded-xl border border-gray-100">
                        <h2 class="font-headline font-bold text-base text-on-surface">{{ $relawan->kegiatan->nama_kegiatan ?? 'Nama Agenda Kegiatan' }}</h2>
                        <div class="grid grid-cols-2 gap-4 mt-3 text-xs text-gray-500 font-medium">
                            <div class="flex items-center gap-1.5">
                                <span class="material-symbols-outlined text-base text-gray-400">location_on</span>
                                <span>{{ $relawan->kegiatan->lokasi ?? '-' }}</span>
                            </div>
                            <div class="flex items-center gap-1.5">
                                <span class="material-symbols-outlined text-base text-gray-400">calendar_today</span>
                                <span>{{ isset($relawan->kegiatan->tanggal_pelaksanaan) ? \Carbon\Carbon::parse($relawan->kegiatan->tanggal_pelaksanaan)->isoFormat('D MMMM YYYY') : '-' }}</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm space-y-6">
                    <div>
                        <h4 class="font-headline font-bold text-xs text-gray-400 uppercase tracking-wider mb-2">Prioritas Pilihan Divisi</h4>
                        <div class="flex gap-3">
                            <div class="flex-1 bg-red-50/50 border border-red-100 p-4 rounded-xl">
                                <span class="text-[9px] font-black text-primary uppercase tracking-widest block">Pilihan Utama (1)</span>
                                <span class="text-sm font-bold text-gray-800 mt-1 block">{{ $relawan->pilihan_divisi_1 }}</span>
                            </div>
                            <div class="flex-1 bg-gray-50 border border-gray-100 p-4 rounded-xl">
                                <span class="text-[9px] font-bold text-gray-400 uppercase tracking-widest block">Pilihan Cadangan (2)</span>
                                <span class="text-sm font-bold text-gray-600 mt-1 block">{{ $relawan->pilihan_divisi_2 ?? 'Tidak Memilih' }}</span>
                            </div>
                        </div>
                    </div>

                    <div>
                        <h4 class="font-headline font-bold text-xs text-gray-400 uppercase tracking-wider mb-2">Alasan & Motivasi Bergabung</h4>
                        <div class="bg-surface p-5 rounded-xl border border-gray-100 text-sm text-gray-700 leading-relaxed font-medium">
                            @php
                                $dataRelawanArray = get_object_vars($relawan);
                                // REVISI UTAMA: Mengutamakan kolom 'pengalaman_keahlian' sesuai dengan gambar database aslimu
                                $teksAlasan = $dataRelawanArray['pengalaman_keahlian'] 
                                              ?? $dataRelawanArray['alasan_bergabung'] 
                                              ?? $dataRelawanArray['alasan'] 
                                              ?? $dataRelawanArray['motivasi'] 
                                              ?? 'Tidak ada alasan tertulis yang dicantumkan.';
                            @endphp
                            {!! nl2br(e($teksAlasan)) !!}
                        </div>
                    </div>

                    <div class="border-t border-gray-100 pt-6">
                        <div class="flex items-center gap-2 text-primary mb-4">
                            <span class="material-symbols-outlined text-[20px]">payments</span>
                            <h4 class="font-headline font-bold text-sm uppercase tracking-wider">Informasi Transaksi & Administrasi</h4>
                        </div>
                        
                        <div class="grid grid-cols-3 gap-6">
                            <div class="col-span-1 space-y-4">
                                <div class="bg-surface p-4 rounded-xl border border-gray-100">
                                    <span class="text-[10px] font-bold text-gray-400 uppercase tracking-wider block">Metode Pembayaran</span>
                                    <span class="text-sm font-bold text-gray-800 block mt-1">
                                        {{ $relawan->metode_pembayaran ?? 'Transfer Bank' }}
                                    </span>
                                </div>
                                <div class="bg-surface p-4 rounded-xl border border-gray-100">
                                    <span class="text-[10px] font-bold text-gray-400 uppercase tracking-wider block">Status Berkas</span>
                                    @if(!empty($relawan->bukti_pembayaran) && $relawan->bukti_pembayaran !== 'tidak_ada.png')
                                        <span class="text-xs font-semibold text-emerald-700 bg-emerald-50 px-2 py-0.5 rounded border border-emerald-100 inline-block mt-2">
                                            Sudah Mengunggah
                                        </span>
                                    @else
                                        <span class="text-xs font-semibold text-red-700 bg-red-50 px-2 py-0.5 rounded border border-red-100 inline-block mt-2">
                                            Belum Mengunggah
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="col-span-2">
                                <span class="text-[10px] font-bold text-gray-400 uppercase tracking-wider block mb-2">Lampiran Bukti Transfer</span>
                                
                                @if(!empty($relawan->bukti_pembayaran) && $relawan->bukti_pembayaran !== 'tidak_ada.png')
                                    <div class="relative bg-surface rounded-xl border border-gray-200 p-2 overflow-hidden group cursor-pointer" onclick="openModal()">
                                        <img src="{{ asset('foto/' . $relawan->bukti_pembayaran) }}" 
                                             alt="Bukti Pembayaran" 
                                             class="w-full max-h-60 object-contain rounded-lg bg-white shadow-inner transition-transform duration-300 group-hover:scale-[1.01]">
                                        
                                        <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 flex items-center justify-center transition-opacity duration-200 rounded-xl">
                                            <button type="button" class="bg-white text-gray-900 font-bold text-xs py-2 px-4 rounded-xl shadow flex items-center gap-1.5 hover:bg-gray-100 transition-colors">
                                                <span class="material-symbols-outlined text-sm">zoom_in</span> Lihat Ukuran Penuh
                                            </button>
                                        </div>
                                    </div>
                                @else
                                    <div class="w-full h-40 flex flex-col items-center justify-center text-gray-400 bg-gray-50 border border-dashed border-gray-200 rounded-xl">
                                        <span class="material-symbols-outlined text-3xl text-gray-300">image_not_supported</span>
                                        <p class="text-xs font-medium mt-2">Bukti transaksi tidak ditemukan / Kosong</p>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

@if(!empty($relawan->bukti_pembayaran) && $relawan->bukti_pembayaran !== 'tidak_ada.png')
<div id="imageModal" class="fixed inset-0 z-[100] hidden flex items-center justify-center bg-black/80 backdrop-blur-sm opacity-0 transition-opacity duration-300" onclick="closeModal()">
    <div class="relative max-w-4xl max-h-[85vh] p-2 bg-white rounded-2xl shadow-2xl m-4 flex flex-col scale-95 transform transition-transform duration-300" onclick="event.stopPropagation()">
        
        <div class="flex items-center justify-between px-4 py-2.5 border-b border-gray-100">
            <span class="text-xs font-bold text-gray-500 uppercase tracking-wider font-headline">Lampiran Bukti Transaksi</span>
            <button onclick="closeModal()" class="text-gray-400 hover:text-black transition-colors p-1 rounded-lg hover:bg-gray-100 flex items-center justify-center">
                <span class="material-symbols-outlined text-[20px]">close</span>
            </button>
        </div>

        <div class="p-2 overflow-auto bg-gray-50 rounded-b-xl flex justify-center items-center">
            <img src="{{ asset('foto/' . $relawan->bukti_pembayaran) }}" 
                 alt="Bukti Pembayaran Besar" 
                 class="max-w-full max-h-[70vh] object-contain rounded-lg shadow-sm">
        </div>
    </div>
</div>

<script>
    function openModal() {
        const modal = document.getElementById('imageModal');
        const modalBox = modal.querySelector('div');
        
        modal.classList.remove('hidden');
        modal.classList.add('flex');
        
        setTimeout(() => {
            modal.classList.remove('opacity-0');
            modalBox.classList.remove('scale-95');
        }, 10);
    }

    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') closeModal();
    });

    function closeModal() {
        const modal = document.getElementById('imageModal');
        const modalBox = modal.querySelector('div');
        
        modal.add('opacity-0');
        modalBox.classList.add('scale-95');
        
        setTimeout(() => {
            modal.classList.remove('flex');
            modal.classList.add('hidden');
        }, 300);
    }
</script>
@endif

</body>
</html>