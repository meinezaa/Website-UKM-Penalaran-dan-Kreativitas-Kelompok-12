<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Kegiatan - UPN Mengajar</title>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;600;700;800&family=Inter:wght@400;500;600&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        "primary": "#bb0016",
                        "surface": "#f9f9f9",
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
<body class="bg-surface text-gray-900 flex">

<aside class="h-screen w-72 fixed left-0 top-0 bottom-0 z-50 p-6 flex flex-col bg-surface-container-lowest border-r shadow-[20px_0_40px_rgba(0,0,0,0.02)]">
    <div class="mb-10 px-4">
        <span class="font-headline font-extrabold text-primary text-2xl tracking-tighter uppercase">UPN Mengajar</span>
    </div>

    <div class="flex items-center gap-4 px-4 py-6 mb-6 rounded-xl bg-surface-container-low">
        <div class="w-12 h-12 rounded-full bg-red-50 flex items-center justify-center text-primary font-bold shadow-sm">
            <span class="material-symbols-outlined">person</span>
        </div>
        <div>
            <p class="font-semibold text-gray-800 text-sm leading-none">{{ Auth::user()->nama_lengkap ?? 'Admin' }}</p>
            <p class="text-[10px] text-gray-400 uppercase tracking-wider mt-1 font-bold">Super Admin</p>
        </div>
    </div>

    <nav class="flex-1 space-y-2">
        <a href="/admin/dashboard" class="flex items-center gap-3 px-4 py-3 rounded-lg text-gray-600 hover:bg-surface-container-low transition-all">
            <span class="material-symbols-outlined text-[20px]">dashboard</span> 
            <span class="text-sm font-medium">Dashboard</span>
        </a>
        <a href="/admin/kelola-relawan" class="flex items-center gap-3 px-4 py-3 rounded-lg text-gray-600 hover:bg-surface-container-low transition-all">
            <span class="material-symbols-outlined text-[20px]">group</span> 
            <span class="text-sm font-medium">Data Relawan</span>
        </a>
        <a href="/admin/kelola-kegiatan" class="flex items-center gap-3 px-4 py-3 rounded-lg bg-primary text-white shadow-md shadow-red-200">
            <span class="material-symbols-outlined text-[20px]">assignment</span> 
            <span class="text-sm font-medium">Kelola Kegiatan</span>
        </a>
    </nav>
</aside>

<main class="flex-1 ml-72 p-12 max-w-[1100px] space-y-8">
    
    <div class="mb-8">
        <a href="/admin/kelola-kegiatan" class="inline-flex items-center gap-2 text-sm font-bold text-gray-400 hover:text-gray-900 transition-colors group mb-4">
            <span class="material-symbols-outlined text-lg group-hover:-translate-x-0.5 transition-transform">arrow_back</span> Kembali ke Daftar Kegiatan
        </a>
        <div class="flex flex-wrap items-center justify-between gap-4">
            <div>
                <span class="text-xs font-extrabold text-primary uppercase tracking-widest bg-red-50 px-3 py-1 rounded-md border border-red-100">Kategori: {{ strtoupper($kegiatan->kategori ?? 'Umum') }}</span>
                <h1 class="font-headline font-extrabold text-3xl text-gray-900 tracking-tight mt-2">{{ $kegiatan->nama_kegiatan }}</h1>
            </div>
            <div class="flex gap-2">
                <a href="/admin/edit-kegiatan/{{ $kegiatan->id_kegiatan }}" class="bg-white border border-gray-200 text-gray-700 px-4 py-2.5 rounded-xl text-xs font-bold flex items-center gap-1.5 hover:bg-gray-50 transition-all shadow-sm">
                    <span class="material-symbols-outlined text-base">edit</span> Edit Data
                </a>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        
        <div class="lg:col-span-2 space-y-6">
            
            <div class="bg-white border border-gray-100 rounded-3xl overflow-hidden shadow-sm">
                <div class="h-64 w-full bg-gray-50 relative">
                    @if(!empty($kegiatan->foto_kegiatan))
                        <img src="{{ asset('storage/' . $kegiatan->foto_kegiatan) }}" alt="Foto {{ $kegiatan->nama_kegiatan }}" class="w-full h-full object-cover">
                    @else
                        <div class="w-full h-full flex flex-col items-center justify-center text-gray-300 gap-2">
                            <span class="material-symbols-outlined text-5xl text-gray-200">landscape</span>
                            <span class="text-xs font-bold uppercase tracking-wider text-gray-400">Belum Ada Banner Dokumentasi</span>
                        </div>
                    @endif
                </div>
            </div>

            <div class="bg-white border border-gray-100 rounded-3xl p-8 shadow-sm space-y-6">
                <div>
                    <h3 class="font-headline font-bold text-base text-gray-800 border-b pb-3 mb-4 flex items-center gap-2">
                        <span class="material-symbols-outlined text-primary text-xl">description</span> Deskripsi Detail Kegiatan
                    </h3>
                    <p class="text-sm text-gray-600 font-medium leading-relaxed whitespace-pre-line">
                        {{ $kegiatan->deskripsi_detail ?? 'Tidak ada rincian deskripsi untuk kegiatan ini.' }}
                    </p>
                </div>

                <div>
                    <h3 class="font-headline font-bold text-base text-gray-800 border-b pb-3 mb-4 flex items-center gap-2">
                        <span class="material-symbols-outlined text-primary text-xl">local_activity</span> Detail Aktivitas Relawan
                    </h3>
                    <p class="text-sm text-gray-600 font-medium leading-relaxed whitespace-pre-line">
                        {{ $kegiatan->detail_aktivitas ?? 'Tidak ada rincian tugas atau aktivitas spesifik relawan.' }}
                    </p>
                </div>
            </div>

            <div class="bg-white border border-gray-100 rounded-3xl p-8 shadow-sm">
                <h3 class="font-headline font-bold text-base text-gray-800 border-b pb-3 mb-6 flex items-center gap-2">
                    <span class="material-symbols-outlined text-primary text-xl">timeline</span> Timeline Alur Program Kegiatan
                </h3>
                
                <div class="relative pl-6 border-l-2 border-gray-100 space-y-6 ml-2">
                    <div class="relative">
                        <div class="absolute -left-[31px] top-0 w-4 h-4 rounded-full bg-emerald-500 border-4 border-white shadow-sm"></div>
                        <p class="text-[10px] font-bold text-emerald-600 uppercase tracking-wider leading-none">Tahap Awal</p>
                        <h4 class="text-sm font-bold text-gray-800 mt-1">Gerbang Pendaftaran Relawan Dibuka</h4>
                        <p class="text-xs font-semibold text-gray-400 mt-0.5">{{ isset($kegiatan->pendaftaran_dibuka) ? date('d F Y', strtotime($kegiatan->pendaftaran_dibuka)) : 'Tanggal Belum Diatur' }}</p>
                    </div>
                    <div class="relative">
                        <div class="absolute -left-[31px] top-0 w-4 h-4 rounded-full bg-amber-500 border-4 border-white shadow-sm"></div>
                        <p class="text-[10px] font-bold text-amber-600 uppercase tracking-wider leading-none">Batas Akhir</p>
                        <h4 class="text-sm font-bold text-gray-800 mt-1">Penutupan Registrasi (Deadline)</h4>
                        <p class="text-xs font-semibold text-gray-400 mt-0.5">{{ isset($kegiatan->batas_registrasi) ? date('d F Y', strtotime($kegiatan->batas_registrasi)) : 'Tanggal Belum Diatur' }}</p>
                    </div>
                    <div class="relative">
                        <div class="absolute -left-[31px] top-0 w-4 h-4 rounded-full bg-blue-500 border-4 border-white shadow-sm"></div>
                        <p class="text-[10px] font-bold text-blue-600 uppercase tracking-wider leading-none">Seleksi Admin</p>
                        <h4 class="text-sm font-bold text-gray-800 mt-1">Pengumuman Kelulusan Berkas Relawan</h4>
                        <p class="text-xs font-semibold text-gray-400 mt-0.5">{{ isset($kegiatan->pengumuman_seleksi) ? date('d F Y', strtotime($kegiatan->pengumuman_seleksi)) : 'Tanggal Belum Diatur' }}</p>
                    </div>
                    <div class="relative">
                        <div class="absolute -left-[31px] top-0 w-4 h-4 rounded-full bg-primary border-4 border-white shadow-sm"></div>
                        <p class="text-[10px] font-bold text-primary uppercase tracking-wider leading-none">Hari H Program</p>
                        <h4 class="text-sm font-bold text-gray-800 mt-1">Pelaksanaan Eksekusi Kegiatan</h4>
                        <p class="text-xs font-semibold text-gray-400 mt-0.5">{{ isset($kegiatan->tanggal_pelaksanaan) ? date('d F Y', strtotime($kegiatan->tanggal_pelaksanaan)) : 'Tanggal Belum Diatur' }}</p>
                    </div>
                </div>
            </div>

        </div>

        <div class="space-y-6">
            
            <div class="bg-white border border-gray-100 rounded-3xl p-6 shadow-sm space-y-4">
                <h3 class="text-xs font-bold text-gray-400 uppercase tracking-widest">Detail Pelaksanaan</h3>
                
                <div class="space-y-3.5">
                    <div class="flex items-start gap-3">
                        <span class="material-symbols-outlined text-gray-400 bg-gray-50 p-2 rounded-xl text-xl">location_on</span>
                        <div>
                            <p class="text-[11px] font-bold text-gray-400 uppercase">Nama Lokasi</p>
                            <p class="text-xs font-bold text-gray-800 mt-0.5">{{ $kegiatan->lokasi ?? 'N/A' }}</p>
                        </div>
                    </div>
                    <div class="flex items-start gap-3">
                        <span class="material-symbols-outlined text-gray-400 bg-gray-50 p-2 rounded-xl text-xl">map</span>
                        <div>
                            <p class="text-[11px] font-bold text-gray-400 uppercase">Alamat Lengkap</p>
                            <p class="text-xs font-medium text-gray-600 mt-0.5 leading-relaxed">{{ $kegiatan->alamat_lengkap ?? 'N/A' }}</p>
                        </div>
                    </div>
                    <div class="flex items-start gap-3">
                        <span class="material-symbols-outlined text-gray-400 bg-gray-50 p-2 rounded-xl text-xl">schedule</span>
                        <div>
                            <p class="text-[11px] font-bold text-gray-400 uppercase">Jam Kegiatan</p>
                            <p class="text-xs font-bold text-gray-800 mt-0.5">{{ $kegiatan->jam_kegiatan ?? 'N/A' }} WIB</p>
                        </div>
                    </div>
                    <div class="flex items-start gap-3">
                        <span class="material-symbols-outlined text-gray-400 bg-gray-50 p-2 rounded-xl text-xl">toggle_on</span>
                        <div>
                            <p class="text-[11px] font-bold text-gray-400 uppercase">Status Kegiatan</p>
                            <span class="inline-block px-2.5 py-0.5 {{ ($kegiatan->status_kegiatan ?? 'aktif') == 'aktif' ? 'bg-emerald-50 text-emerald-700 border-emerald-100' : 'bg-gray-50 text-gray-500 border-gray-200' }} text-[10px] font-bold rounded border uppercase mt-1">
                                {{ $kegiatan->status_kegiatan ?? 'aktif' }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-white border border-gray-100 rounded-3xl p-6 shadow-sm">
                <h3 class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-3">Divisi yang Dibutuhkan</h3>
                
                @if(!empty($kegiatan->divisi_dibutuhkan))
                    <div class="flex flex-wrap gap-1.5">
                        @foreach(explode(',', $kegiatan->divisi_dibutuhkan) as $divisi)
                            <span class="px-3 py-1.5 bg-red-50 text-primary border border-red-100/60 rounded-xl text-xs font-bold flex items-center gap-1">
                                <span class="material-symbols-outlined text-xs">done</span> {{ trim($divisi) }}
                            </span>
                        @endforeach
                    </div>
                @else
                    <p class="text-xs font-medium text-gray-400 italic">Belum ada spesifikasi penempatan divisi relawan.</p>
                @endif
            </div>

        </div>

    </div>

    <div class="bg-white border border-gray-100 rounded-3xl p-8 shadow-sm space-y-4">
        <div class="flex items-center justify-between border-b pb-4">
            <h3 class="font-headline font-bold text-lg text-gray-800 flex items-center gap-2">
                <span class="material-symbols-outlined text-primary text-2xl">group_add</span> Calon Relawan Terdaftar
            </h3>
            <span class="text-xs font-bold bg-slate-100 text-slate-600 px-3 py-1 rounded-full">
                Total Pendaftar: {{ isset($pendaftar) ? count($pendaftar) : 0 }}
            </span>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs border-collapse">
                <thead>
                    <tr class="border-b border-gray-100 text-gray-400 uppercase font-bold tracking-wider">
                        <th class="py-3 px-4">Nama Lengkap</th>
                        <th class="py-3 px-4">Program Studi</th>
                        <th class="py-3 px-4">Pilihan Divisi 1</th>
                        <th class="py-3 px-4 text-center">Status Seleksi</th>
                        <th class="py-3 px-4 text-right">Aksi Berkas</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50 font-medium text-gray-700">
                    @if(isset($pendaftar) && count($pendaftar) > 0)
                        @foreach($pendaftar as $p)
                            <tr class="hover:bg-slate-50/80 transition-colors">
                                <td class="py-3.5 px-4">
                                    <p class="font-bold text-gray-900 text-sm">{{ $p->nama_lengkap }}</p>
                                    <p class="text-[11px] text-gray-400 font-normal mt-0.5">{{ $p->email }}</p>
                                </td>
                                <td class="py-3.5 px-4 text-gray-600">{{ $p->asal_prodi }}</td>
                                <td class="py-3.5 px-4">
                                    <span class="bg-red-50 text-primary px-2.5 py-1 rounded-lg text-[11px] font-bold">{{ $p->pilihan_divisi_1 }}</span>
                                </td>
                                <td class="py-3.5 px-4 text-center">
                                    <span class="px-3 py-1 rounded-full text-[10px] font-black uppercase tracking-wide
                                        {{ $p->status_seleksi == 'DITERIMA' ? 'bg-emerald-100 text-emerald-700' : '' }}
                                        {{ $p->status_seleksi == 'DITOLAK' ? 'bg-rose-100 text-rose-700' : '' }}
                                        {{ $p->status_seleksi == 'PENDING' ? 'bg-amber-100 text-amber-700' : '' }}
                                    ">
                                        {{ $p->status_seleksi }}
                                    </span>
                                </td>
                                <td class="py-3.5 px-4 text-right">
                                    <a href="/admin/detail-relawan/{{ $p->id_pendaftaran }}" class="inline-flex items-center gap-1 bg-white border border-gray-200 hover:border-gray-400 px-3 py-1.5 rounded-lg text-[11px] font-bold text-gray-600 transition-all">
                                        <span class="material-symbols-outlined text-xs">folder_open</span> Buka Berkas
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="5" class="py-12 text-center text-gray-400 italic">
                                <span class="material-symbols-outlined text-3xl opacity-30 block mb-1">person_search</span>
                                Belum ada relawan yang mendaftar pada kegiatan ini.
                            </td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
    
</main>

</body>
</html>