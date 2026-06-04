@extends('layouts.app')
 
@section('title', 'Admin Panel - UPN Mengajar')
 
@section('head')
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;600;700;800&family=Inter:wght@400;500;600&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
    <style>
        .material-symbols-outlined { font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24; }
        body { font-family: 'Inter', sans-serif; min-height: 100vh; }
    </style>
@endsection
 
@section('content')
<div class="bg-[#f9f9f9] text-[#1a1c1c] flex min-h-screen">
 
    {{-- ===================== SIDEBAR ===================== --}}
    <aside class="h-screen w-72 fixed left-0 top-0 bottom-0 z-50 p-6 flex flex-col bg-white border-r shadow-[20px_0_40px_rgba(0,0,0,0.02)]">
        <div class="mb-10 px-4">
            <span class="font-['Manrope'] font-extrabold text-[#bb0016] text-2xl tracking-tighter uppercase">UPN Mengajar</span>
        </div>
 
        {{-- Info Admin --}}
        <div class="flex items-center gap-4 px-4 py-6 mb-6 rounded-xl bg-[#f3f3f3]">
            <div class="w-12 h-12 rounded-full bg-red-50 text-[#bb0016] flex items-center justify-center font-bold">
                <span class="material-symbols-outlined">person</span>
            </div>
            <div>
                <p class="font-['Inter'] font-semibold text-[#1a1c1c] text-sm leading-none">
                    {{ session('nama_lengkap', 'Admin') }}
                </p>
                <p class="text-[10px] text-gray-400 uppercase tracking-wider mt-1">Super Admin</p>
            </div>
        </div>
 
        {{-- Nav --}}
        <nav class="flex-1 space-y-2">
            <a href="{{ route('admin.dashboard') }}"
               class="flex items-center gap-3 px-4 py-3 rounded-lg font-['Inter'] font-medium text-sm transition-all bg-[#bb0016] text-white shadow-md shadow-red-200">
                <span class="material-symbols-outlined text-[20px]">dashboard</span> Dashboard
            </a>
            <a href="{{ route('admin.relawan') }}"
               class="flex items-center gap-3 px-4 py-3 rounded-lg font-['Inter'] font-medium text-sm text-gray-600 hover:bg-[#f3f3f3] transition-all">
                <span class="material-symbols-outlined text-[20px]">group</span> Data Relawan
            </a>
            <a href="{{ route('admin.kegiatan') }}"
               class="flex items-center gap-3 px-4 py-3 rounded-lg font-['Inter'] font-medium text-sm text-gray-600 hover:bg-[#f3f3f3] transition-all">
                <span class="material-symbols-outlined text-[20px]">assignment</span> Kegiatan
            </a>
        </nav>
 
        {{-- Logout --}}
        <div class="pt-6 border-t border-gray-100">
            <a href="{{ route('logout') }}"
               onclick="return confirm('Apakah Anda yakin ingin keluar?')"
               class="flex items-center gap-3 px-4 py-3 rounded-lg font-['Inter'] font-medium text-sm text-red-600 hover:bg-red-50 transition-all group">
                <span class="material-symbols-outlined text-[20px] group-hover:rotate-12 transition-transform">logout</span> Logout
            </a>
        </div>
    </aside>
 
    {{-- ===================== MAIN CONTENT ===================== --}}
    <main class="flex-1 ml-72 min-h-screen pb-20">
 
        {{-- Header --}}
        <header class="w-full sticky top-0 z-40 bg-white/80 backdrop-blur-md flex justify-between items-center px-8 py-4 border-b">
            <h1 class="font-['Manrope'] font-bold text-2xl text-[#bb0016]">Dashboard</h1>
            <div class="flex items-center gap-4">
                <a href="{{ route('beranda') }}"
                   class="flex items-center gap-2 px-4 py-2 bg-gray-100 hover:bg-gray-200 rounded-xl text-sm font-bold text-gray-700 transition-all">
                    <span class="material-symbols-outlined text-lg">home</span>
                    Lihat Beranda
                </a>
            </div>
        </header>
 
        <div class="p-8 space-y-10">
 
            {{-- Flash message pesan hapus --}}
            @if(session('success'))
                <div class="bg-green-50 border border-green-200 text-green-700 px-6 py-3 rounded-xl text-sm font-semibold">
                    {{ session('success') }}
                </div>
            @endif
 
            {{-- ===================== STATISTIK ===================== --}}
            <section class="grid grid-cols-1 md:grid-cols-3 gap-6">
 
                <div class="p-8 rounded-2xl bg-gradient-to-br from-[#bb0016] to-red-800 text-white shadow-xl shadow-red-100">
                    <span class="material-symbols-outlined text-4xl mb-4 opacity-70">group</span>
                    <h3 class="text-5xl font-['Manrope'] font-black">{{ $countRelawan }}</h3>
                    <p class="text-xs font-bold uppercase tracking-widest opacity-80 mt-2">Total Relawan</p>
                </div>
 
                <div class="p-8 rounded-2xl bg-white border border-gray-100 shadow-sm">
                    <div class="w-12 h-12 rounded-lg bg-red-50 flex items-center justify-center mb-4 text-[#bb0016]">
                        <span class="material-symbols-outlined">school</span>
                    </div>
                    <h3 class="text-5xl font-['Manrope'] font-black text-[#1a1c1c]">{{ $countProgram }}</h3>
                    <p class="text-gray-400 text-xs font-bold uppercase tracking-widest mt-2">Program Aktif</p>
                </div>
 
                <div class="p-8 rounded-2xl bg-gray-50 border border-gray-100">
                    <div class="w-12 h-12 rounded-lg bg-white flex items-center justify-center mb-4 text-orange-500 shadow-sm">
                        <span class="material-symbols-outlined">person_add</span>
                    </div>
                    <h3 class="text-5xl font-['Manrope'] font-black text-[#1a1c1c]">{{ $countBaru }}</h3>
                    <p class="text-gray-400 text-xs font-bold uppercase tracking-widest mt-2">Antrian Baru</p>
                </div>
 
            </section>
 
            {{-- ===================== TABEL KEGIATAN ===================== --}}
            <section class="space-y-4">
                <div class="flex justify-between items-end">
                    <h3 class="text-xl font-['Manrope'] font-extrabold">Daftar Kegiatan</h3>
                    <a href="{{ route('admin.tambahKegiatan') }}"
                       class="bg-[#bb0016] text-white px-4 py-2 rounded-xl text-xs font-bold flex items-center gap-2 hover:bg-red-700 transition-all shadow-md shadow-red-100">
                        <span class="material-symbols-outlined text-sm">add</span> Tambah
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
                        <tbody class="divide-y divide-gray-100 text-sm">
                            @forelse($kegiatan as $rk)
                            <tr class="hover:bg-gray-50 transition-colors">
                                <td class="px-6 py-4 font-bold">{{ $rk->nama_kegiatan }}</td>
                                <td class="px-6 py-4 text-gray-500">{{ $rk->lokasi }}</td>
                                <td class="px-6 py-4 text-center">
                                    <div class="flex justify-center gap-2">
                                        <a href="{{ route('admin.editKegiatan', $rk->id_kegiatan) }}"
                                           class="text-blue-500 hover:bg-blue-50 p-1.5 rounded-lg" title="Edit">
                                            <span class="material-symbols-outlined text-lg">edit</span>
                                        </a>
                                        <a href="#"
                                           onclick="return confirm('Arsipkan kegiatan ini? (Akan hilang dari beranda)')"
                                           class="text-orange-500 hover:bg-orange-50 p-1.5 rounded-lg" title="Arsipkan">
                                            <span class="material-symbols-outlined text-lg">inventory_2</span>
                                        </a>
                                        <a href="{{ route('admin.hapusKegiatan', $rk->id_kegiatan) }}"
                                           onclick="return confirm('Hapus permanen?')"
                                           class="text-red-400 hover:text-red-600 p-1.5 rounded-lg" title="Hapus">
                                            <span class="material-symbols-outlined text-lg">delete</span>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="3" class="px-6 py-12 text-center text-gray-400 font-bold uppercase text-[10px] tracking-widest">
                                    Belum ada kegiatan aktif
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </section>
 
            {{-- ===================== TABEL ANTRIAN PENDAFTAR ===================== --}}
            <section class="space-y-4">
                <h3 class="text-xl font-['Manrope'] font-extrabold">Antrian Pendaftar Baru</h3>
 
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
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-3">
                                        <div class="w-8 h-8 rounded-full bg-red-50 text-[#bb0016] flex items-center justify-center text-xs font-bold border border-red-100">
                                            {{ strtoupper(substr($rp->nama_lengkap, 0, 1)) }}
                                        </div>
                                        <span class="font-bold">{{ $rp->nama_lengkap }}</span>
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-gray-500">{{ $rp->asal_prodi }}</td>
                                <td class="px-6 py-4">
                                    <span class="bg-yellow-50 text-yellow-600 border border-yellow-100 px-2 py-1 rounded text-[9px] font-black uppercase">
                                        {{ $rp->status_seleksi }}
                                    </span>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex justify-end gap-3">
                                        <a href="#"
                                           class="text-blue-600 hover:bg-blue-50 p-1.5 rounded-full transition-all" title="Lihat Detail">
                                            <span class="material-symbols-outlined text-2xl">visibility</span>
                                        </a>
                                        <a href="#"
                                           class="text-green-600 hover:bg-green-50 p-1.5 rounded-full transition-all" title="Terima">
                                            <span class="material-symbols-outlined text-2xl">check_circle</span>
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
 
</div>
@endsection