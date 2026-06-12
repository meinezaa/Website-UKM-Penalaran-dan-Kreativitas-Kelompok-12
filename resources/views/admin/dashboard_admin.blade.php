<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - UPN Mengajar</title>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;600;700;800&family=Inter:wght@400;500;600&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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

    <nav class="flex-1 space-y-2">
        <a href="/admin/dashboard" class="flex items-center gap-3 px-4 py-3 rounded-lg font-body font-medium text-sm transition-all bg-primary text-white shadow-md shadow-red-200">
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
        <h1 class="font-headline font-bold text-2xl text-primary">Dashboard</h1>
        <div class="flex items-center gap-4">
            <a href="{{ url('/') }}" class="flex items-center gap-2 px-4 py-2 bg-gray-100 hover:bg-gray-200 rounded-xl text-sm font-bold text-gray-700 transition-all">
                <span class="material-symbols-outlined text-lg">home</span>
                Beranda
            </a>
        </div>
    </header>

    <div class="p-8 space-y-10">
        
        @if(session('pesan'))
            <div class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50" role="alert">
                {{ session('pesan') }}
            </div>
        @endif

        <section class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="p-8 rounded-2xl bg-gradient-to-br from-primary to-red-800 text-white shadow-xl shadow-red-100">
                <span class="material-symbols-outlined text-4xl mb-4 opacity-70">group</span>
                <h3 class="text-5xl font-headline font-black">{{ $count_relawan }}</h3>
                <p class="text-xs font-bold uppercase tracking-widest opacity-80 mt-2">Total Relawan</p>
            </div>
            <div class="p-8 rounded-2xl bg-white border border-gray-100 shadow-sm">
                <div class="w-12 h-12 rounded-lg bg-red-50 flex items-center justify-center mb-4 text-primary">
                    <span class="material-symbols-outlined">school</span>
                </div>
                <h3 class="text-5xl font-headline font-black text-on-surface">{{ $count_program }}</h3>
                <p class="text-gray-400 text-xs font-bold uppercase tracking-widest mt-2">Program Aktif</p>
            </div>
            <div class="p-8 rounded-2xl bg-gray-50 border border-gray-100">
                <div class="w-12 h-12 rounded-lg bg-white flex items-center justify-center mb-4 text-orange-500 shadow-sm">
                    <span class="material-symbols-outlined">person_add</span>
                </div>
                <h3 class="text-5xl font-headline font-black text-on-surface">{{ $count_baru }}</h3>
                <p class="text-gray-400 text-xs font-bold uppercase tracking-widest mt-2">Antrian Baru</p>
            </div>
        </section>

        <section class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <div class="lg:col-span-2 p-6 bg-white rounded-2xl border border-gray-100 shadow-sm">
                <h3 class="text-lg font-headline font-extrabold text-on-surface mb-4">Grafik Pertumbuhan Data</h3>
                <div class="h-64 flex items-center justify-center">
                    <canvas id="dashboardChart"></canvas>
                </div>
            </div>
        </section>

        <section class="space-y-4">
            <div class="flex justify-between items-end">
                <h3 class="text-xl font-headline font-extrabold text-on-background">Daftar Kegiatan</h3>
                <a href="/admin/kelola-kegiatan" class="bg-primary text-white px-4 py-2 rounded-xl text-xs font-bold flex items-center gap-2 hover:bg-red-700 transition-all shadow-md shadow-red-100">
                    <span class="material-symbols-outlined text-sm">visibility</span> Kelola Semua Kegiatan
                </a>
            </div>
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                <table class="w-full text-left">
                    <thead class="bg-gray-50 border-b">
                        <tr class="text-[10px] font-bold uppercase tracking-widest text-gray-500">
                            <th class="px-6 py-4">Nama Program</th>
                            <th class="px-6 py-4">Lokasi</th>
                            <th class="px-6 py-4 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100 text-sm font-body">
                        @foreach($kegiatan as $rk)
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="px-6 py-4 font-bold">{{ $rk->nama_kegiatan }}</td>
                            <td class="px-6 py-4 text-gray-500">{{ $rk->lokasi }}</td>
                            <td class="px-6 py-4 text-center">
                                <div class="flex justify-center gap-2">
                                    <a href="/admin/edit-kegiatan/{{ $rk->id_kegiatan }}" class="text-blue-500 hover:bg-blue-50 p-1.5 rounded-lg" title="Edit"><span class="material-symbols-outlined text-lg">edit</span></a>
                                    
                                    <form action="/admin/kelola-kegiatan/{{ $rk->id_kegiatan }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus kegiatan ini secara permanen?')" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-400 hover:text-red-600 p-1.5 rounded-lg" title="Hapus">
                                            <span class="material-symbols-outlined text-lg">delete</span>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </section>

        <section class="space-y-4">
            <div class="flex justify-between items-center">
                <h3 class="text-xl font-headline font-extrabold text-on-background">Antrian Pendaftar Baru</h3>
                <a href="/admin/data-relawan" class="text-xs text-primary font-bold hover:underline">Lihat Semua Data Relawan &rarr;</a>
            </div>
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                <table class="w-full text-left">
                    <thead class="bg-gray-50 border-b">
                        <tr class="text-[10px] font-bold uppercase tracking-widest text-gray-500">
                            <th class="px-6 py-4">Calon Relawan</th>
                            <th class="px-6 py-4">Program Studi</th>
                            <th class="px-6 py-4">Status</th>
                            <th class="px-6 py-4 text-right">Tindakan</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100 text-sm">
                        @forelse($pendaftar as $rp)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 flex items-center gap-3">
                                <div class="w-8 h-8 rounded-full bg-red-50 text-primary flex items-center justify-center text-xs font-bold border border-red-100">
                                    {{ strtoupper(substr($rp->user->nama_lengkap ?? 'R', 0, 1)) }}
                                </div>
                                <span class="font-bold">{{ $rp->user->nama_lengkap ?? 'Nama Tidak Ditemukan' }}</span>
                            </td>
                            <td class="px-6 py-4 text-gray-500">{{ $rp->asal_prodi }}</td>
                            <td class="px-6 py-4">
                                <span class="bg-yellow-50 text-yellow-600 border border-yellow-100 px-2 py-1 rounded text-[9px] font-black uppercase">
                                    {{ $rp->status_seleksi }}
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex justify-end gap-3">
                                    <a href="/admin/detail-relawan/{{ $rp->id_pendaftaran }}" class="text-blue-600 hover:bg-blue-50 p-1.5 rounded-full transition-all" title="Lihat Detail">
                                        <span class="material-symbols-outlined text-2xl">visibility</span>
                                    </a>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="px-6 py-12 text-center text-gray-400 font-bold uppercase text-[10px] tracking-widest">
                                Tidak ada antrian pendaftar saat ini
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </section>
    </div>
</main>

<script>
    const ctx = document.getElementById('dashboardChart').getContext('2d');
    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['Total Relawan', 'Program Aktif', 'Antrian Baru'],
            datasets: [{
                label: 'Jumlah Data Real-time',
                data: [{{ $count_relawan }}, {{ $count_program }}, {{ $count_baru }}],
                backgroundColor: [
                    'rgba(187, 0, 22, 0.8)', 
                    'rgba(31, 41, 55, 0.8)',  
                    'rgba(245, 158, 11, 0.8)'  
                ],
                borderColor: [
                    '#bb0016',
                    '#1f2937',
                    '#f59e0b'
                ],
                borderWidth: 2,
                borderRadius: 8
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: { stepSize: 1 }
                }
            }
        }
    });
</script>

</body>
</html>