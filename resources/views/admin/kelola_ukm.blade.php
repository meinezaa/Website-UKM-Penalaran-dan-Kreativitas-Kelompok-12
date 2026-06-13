<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - Kelola Info UKM</title>
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

        <a href="/admin/kelola-ukm" class="flex items-center gap-3 px-4 py-3 rounded-lg font-body font-medium text-sm transition-all bg-primary text-white shadow-md shadow-red-200">
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

<main class="flex-1 ml-72 min-h-screen pb-20">
    <header class="w-full sticky top-0 z-40 bg-white/80 backdrop-blur-md flex justify-between items-center px-8 py-4 border-b">
        <h1 class="font-headline font-bold text-2xl text-primary">Kelola Komponen Halaman Info UKM</h1>
        <div class="flex items-center gap-4">
            <a href="{{ url('/') }}" class="flex items-center gap-2 px-4 py-2 bg-gray-100 hover:bg-gray-200 rounded-xl text-sm font-bold text-gray-700 transition-all">
                <span class="material-symbols-outlined text-lg">home</span> Beranda
            </a>
        </div>
    </header>

    <div class="p-8 space-y-6 max-w-5xl w-full mx-auto">
        
        @if(session('pesan'))
        <div class="p-4 bg-emerald-50 border border-emerald-200 text-emerald-800 rounded-xl text-sm flex items-center gap-2">
            <span class="material-symbols-outlined text-emerald-600">check_circle</span>
            {{ session('pesan') }}
        </div>
        @endif

        <div class="flex border border-gray-200 bg-white rounded-xl p-1 shadow-sm gap-1">
            <button onclick="switchTab('tab-visimisi')" id="btn-tab-visimisi" class="tab-btn flex-1 py-2.5 text-center font-body font-semibold text-sm rounded-lg transition-all bg-primary text-white shadow-sm">
                Visi & Misi
            </button>
            <button onclick="switchTab('tab-bph')" id="btn-tab-bph" class="tab-btn flex-1 py-2.5 text-center font-body font-medium text-sm rounded-lg transition-all text-gray-500 hover:text-gray-900">
                Badan Pengurus (BPH)
            </button>
            <button onclick="switchTab('tab-divisi')" id="btn-tab-divisi" class="tab-btn flex-1 py-2.5 text-center font-body font-medium text-sm rounded-lg transition-all text-gray-500 hover:text-gray-900">
                Divisi / Bidang
            </button>
        </div>

        <div id="tab-visimisi" class="tab-content block bg-white border border-gray-200 rounded-2xl p-6 shadow-sm space-y-6">
            <div>
                <div class="flex justify-between items-center mb-3">
                    <h4 class="text-sm font-headline font-extrabold uppercase tracking-wider text-indigo-600">Bagian Visi</h4>
                    <button onclick="openAddVisiMisiModal('visi')" class="px-3 py-1.5 bg-primary text-white text-xs font-bold rounded-lg flex items-center gap-1 shadow-sm hover:bg-red-700 transition-all">
                        <span class="material-symbols-outlined text-sm">add</span> Tambah Visi Baru
                    </button>
                </div>
                <div class="space-y-2">
                    @foreach($visis as $visi)
                    <div class="p-4 bg-gray-50 border border-gray-100 rounded-xl flex justify-between items-center gap-4">
                        <p class="text-sm text-gray-700 font-medium font-body">{{ $visi->content }}</p>
                        <button onclick="openVisiMisiModal('{{ $visi->id }}', '{{ addslashes($visi->content) }}')" class="px-3 py-1.5 bg-amber-500 hover:bg-amber-600 text-white text-xs font-medium rounded-lg flex items-center gap-1 shrink-0 transition-all">
                            <span class="material-symbols-outlined text-sm">edit</span> Edit
                        </button>
                    </div>
                    @endforeach
                </div>
            </div>

            <div class="pt-4 border-t border-gray-100">
                <div class="flex justify-between items-center mb-3">
                    <h4 class="text-sm font-headline font-extrabold uppercase tracking-wider text-teal-600">Bagian Misi Poin</h4>
                    <button onclick="openAddVisiMisiModal('misi')" class="px-3 py-1.5 bg-primary text-white text-xs font-bold rounded-lg flex items-center gap-1 shadow-sm hover:bg-red-700 transition-all">
                        <span class="material-symbols-outlined text-sm">add</span> Tambah Misi Baru
                    </button>
                </div>
                <div class="space-y-2">
                    @foreach($misis as $misi)
                    <div class="p-4 bg-gray-50 border border-gray-100 rounded-xl flex justify-between items-center gap-4">
                        <p class="text-sm text-gray-700 font-medium font-body">{{ $misi->content }}</p>
                        <button onclick="openVisiMisiModal('{{ $misi->id }}', '{{ addslashes($misi->content) }}')" class="px-3 py-1.5 bg-amber-500 hover:bg-amber-600 text-white text-xs font-medium rounded-lg flex items-center gap-1 shrink-0 transition-all">
                            <span class="material-symbols-outlined text-sm">edit</span> Edit
                        </button>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>

        <div id="tab-bph" class="tab-content hidden bg-white border border-gray-200 rounded-2xl p-6 shadow-sm space-y-4">
            <div class="flex justify-between items-center mb-2">
                <h3 class="font-headline font-bold text-gray-950 text-base">Anggota Pengurus Inti (BPH)</h3>
                <button onclick="openAddBphModal()" class="px-3 py-1.5 bg-primary text-white text-xs font-bold rounded-lg flex items-center gap-1 shadow-sm hover:bg-red-700 transition-all">
                    <span class="material-symbols-outlined text-sm">person_add</span> Tambah Pengurus BPH
                </button>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                @foreach(array_merge($bph_ketua->toArray(), $bph_sekre->toArray(), $bph_bendahara->toArray()) as $k)
                <div class="p-4 bg-gray-50 border border-gray-100 rounded-xl flex justify-between items-center gap-4">
                    <div class="flex items-center gap-3">
                        <img src="{{ asset('foto/'.$k['photo']) }}" class="w-12 h-12 object-cover rounded-full border border-gray-300 bg-white">
                        <div>
                            <h4 class="font-headline font-bold text-sm text-gray-900 leading-tight">{{ $k['name'] }}</h4>
                            <p class="text-[11px] text-primary font-bold tracking-wide uppercase mt-0.5">{{ $k['role'] }}</p>
                            <p class="text-xs text-gray-500 font-body">{{ $k['major_year'] }}</p>
                        </div>
                    </div>
                    <button onclick="openBphModal('{{ $k['id'] }}', '{{ addslashes($k['name']) }}', '{{ addslashes($k['major_year']) }}')" class="px-3 py-1.5 bg-amber-500 hover:bg-amber-600 text-white text-xs font-medium rounded-lg flex items-center gap-1 shrink-0 transition-all">
                        <span class="material-symbols-outlined text-sm">edit</span> Edit
                    </button>
                </div>
                @endforeach
            </div>
        </div>

        <div id="tab-divisi" class="tab-content hidden bg-white border border-gray-200 rounded-2xl p-6 shadow-sm space-y-4">
            <div class="flex justify-between items-center mb-2">
                <h3 class="font-headline font-bold text-gray-950 text-base">Daftar Divisi Organisasi</h3>
                <button onclick="openAddDivisiModal()" class="px-3 py-1.5 bg-primary text-white text-xs font-bold rounded-lg flex items-center gap-1 shadow-sm hover:bg-red-700 transition-all">
                    <span class="material-symbols-outlined text-sm">add_box</span> Tambah Divisi Baru
                </button>
            </div>
            
            <div class="space-y-4">
                @foreach($divisions as $div)
                <div class="p-5 bg-white border border-gray-200 rounded-2xl shadow-sm hover:shadow-md transition-all">
                    <div class="flex justify-between items-start gap-4 mb-4">
                        <div>
                            <h4 class="font-headline font-bold text-base text-gray-900 mb-1">{{ $div->name }}</h4>
                            <p class="text-xs text-gray-500 font-body leading-relaxed">{{ $div->description }}</p>
                        </div>
                        <button onclick="openDivisiModal('{{ $div->id }}', '{{ addslashes($div->name) }}', '{{ addslashes($div->description) }}')" class="px-3 py-1.5 bg-amber-500 hover:bg-amber-600 text-white text-xs font-medium rounded-xl flex items-center gap-1 shrink-0 transition-all shadow-sm">
                            <span class="material-symbols-outlined text-sm">edit</span> Edit Divisi
                        </button>
                    </div>

                    <div class="border-t border-dashed border-gray-200 my-3"></div>

                    <div>
                        <div class="flex items-center gap-1.5 text-gray-400 mb-2">
                            <span class="material-symbols-outlined text-sm text-primary">assignment</span>
                            <span class="text-[11px] font-bold uppercase tracking-wider">Daftar Program Kerja</span>
                        </div>
                        
                        <div class="bg-gray-50 rounded-xl p-3 border border-gray-100 space-y-2">
                            @php
                                $prokerDivisi = $programs->where('division_id', $div->id);
                            @endphp

                            @forelse($prokerDivisi as $proker)
                            <div class="flex justify-between items-center py-2 border-b border-gray-100 last:border-0">
                                <div class="flex items-start gap-2.5 text-sm">
                                    <span class="text-primary text-xs mt-0.5">✦</span>
                                    <div>
                                        <span class="font-semibold text-gray-800 text-xs block">{{ $proker->name }}</span>
                                        @if(!empty($proker->description))
                                            <p class="text-[11px] text-gray-500 leading-normal mt-0.5">{{ $proker->description }}</p>
                                        @endif
                                    </div>
                                </div>
                                <button type="button" onclick="openProkerModal('{{ $proker->id }}', '{{ addslashes($proker->name) }}', '{{ addslashes($proker->description) }}')" class="px-2.5 py-1 bg-white border border-gray-200 text-amber-500 hover:text-amber-700 text-[11px] font-semibold rounded-lg flex items-center gap-0.5 shadow-sm transition-all">
                                    <span class="material-symbols-outlined text-xs">edit</span> Edit Proker
                                </button>
                            </div>
                            @empty
                            <div class="text-center py-2 text-gray-400 text-xs italic">
                                Belum ada program kerja terdaftar di bidang ini.
                            </div>
                            @endforelse
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</main>

<div id="editorModal" class="fixed inset-0 bg-black/50 hidden items-center justify-center z-50 p-4 backdrop-blur-sm">
    <div class="bg-white max-w-lg w-full rounded-2xl shadow-xl p-6 space-y-4">
        <div class="flex justify-between items-center border-b border-gray-100 pb-3">
            <h3 class="font-headline font-bold text-gray-900 text-base" id="modal-title-text">Edit Komponen Konten</h3>
            <button onclick="closeModal()" class="text-gray-400 hover:text-gray-600 text-2xl leading-none">&times;</button>
        </div>
        
        <form action="" method="POST" id="modal-form-action" enctype="multipart/form-data" class="space-y-4">
            @csrf
            <input type="hidden" name="target_table" id="modal-target">
            <input type="hidden" name="id" id="modal-id">
            <input type="hidden" name="type" id="modal-type-visimisi">

            <div id="box-role-field" class="hidden">
                <label class="block text-xs font-bold text-gray-600 uppercase mb-1">Jabatan Inti BPH</label>
                <select name="role" id="input-role-field" class="w-full px-4 py-2 border border-gray-200 rounded-xl text-xs focus:outline-none focus:border-primary">
                    <option value="Ketua Umum">Ketua Umum</option>
                    <option value="Sekretaris">Sekretaris</option>
                    <option value="Bendahara">Bendahara</option>
                </select>
            </div>

            <div id="box-field-1">
                <label id="label-field-1" class="block text-xs font-bold text-gray-600 uppercase mb-1">Nama</label>
                <input type="text" name="name" id="input-field-1" class="w-full px-4 py-2 border border-gray-200 rounded-xl text-xs focus:outline-none focus:border-primary">
            </div>

            <div id="box-field-2">
                <label id="label-field-2" class="block text-xs font-bold text-gray-600 uppercase mb-1">Keterangan</label>
                <textarea name="description" id="input-field-2" rows="4" class="w-full px-4 py-2 border border-gray-200 rounded-xl text-xs focus:outline-none focus:border-primary"></textarea>
            </div>

            <div id="box-content-field" class="hidden">
                <label class="block text-xs font-bold text-gray-600 uppercase mb-1">Isi Teks</label>
                <textarea name="content" id="input-content" rows="4" class="w-full px-4 py-2 border border-gray-200 rounded-xl text-xs focus:outline-none focus:border-primary"></textarea>
            </div>

            <div id="box-photo-field" class="hidden">
                <label id="label-photo-title" class="block text-xs font-bold text-gray-600 uppercase mb-1">Foto Profil</label>
                <input type="file" name="photo" class="w-full text-xs text-gray-500 file:mr-3 file:py-1.5 file:px-3 file:rounded-lg file:border-0 file:text-[11px] file:font-semibold file:bg-red-50 file:text-primary">
            </div>

            <div class="pt-2 border-t border-gray-100 flex justify-end gap-2 text-xs font-medium">
                <button type="button" onclick="closeModal()" class="px-4 py-2 bg-gray-100 text-gray-600 rounded-lg hover:bg-gray-200">Batal</button>
                <button type="submit" class="px-5 py-2 bg-primary hover:bg-red-700 text-white rounded-lg font-bold">Simpan Data</button>
            </div>
        </form>
    </div>
</div>

<script>
    function switchTab(tabId) {
        document.querySelectorAll('.tab-content').forEach(el => el.classList.replace('block', 'hidden'));
        document.getElementById(tabId).classList.replace('hidden', 'block');

        document.querySelectorAll('.tab-btn').forEach(btn => {
            btn.classList.remove('bg-primary', 'text-white', 'shadow-sm');
            btn.classList.add('text-gray-500', 'hover:text-gray-900');
        });
        document.getElementById('btn-' + tabId).classList.add('bg-primary', 'text-white', 'shadow-sm');
    }

    function showModal(title, actionUrl) {
        document.getElementById('modal-title-text').innerText = title;
        document.getElementById('modal-form-action').action = actionUrl;
        const modal = document.getElementById('editorModal');
        modal.classList.remove('hidden');
        modal.classList.add('flex');
    }

    function closeModal() {
        const modal = document.getElementById('editorModal');
        modal.classList.remove('flex');
        modal.classList.add('hidden');
    }

    function openVisiMisiModal(id, content) {
        document.getElementById('modal-target').value = 'visions_missions';
        document.getElementById('modal-id').value = id;
        
        document.getElementById('box-field-1').classList.add('hidden');
        document.getElementById('box-field-2').classList.add('hidden');
        document.getElementById('box-photo-field').classList.add('hidden');
        document.getElementById('box-role-field').classList.add('hidden');
        
        document.getElementById('box-content-field').classList.remove('hidden');
        document.getElementById('input-content').value = content;
        showModal('Edit Visi & Misi', '{{ route("admin.kelola_ukm.update") }}');
    }

    function openBphModal(id, name, majorYear) {
        document.getElementById('modal-target').value = 'bph_members';
        document.getElementById('modal-id').value = id;
        
        document.getElementById('box-content-field').classList.add('hidden');
        document.getElementById('box-role-field').classList.add('hidden');
        
        document.getElementById('box-field-1').classList.remove('hidden');
        document.getElementById('label-field-1').innerText = 'Nama Anggota BPH';
        document.getElementById('input-field-1').value = name;

        document.getElementById('box-field-2').classList.remove('hidden');
        document.getElementById('label-field-2').innerText = 'Jurusan & Angkatan';
        document.getElementById('input-field-2').value = majorYear;

        document.getElementById('box-photo-field').classList.remove('hidden');
        document.getElementById('label-photo-title').innerText = 'Ganti Foto Profil Anggota';
        showModal('Edit Anggota BPH', '{{ route("admin.kelola_ukm.update") }}');
    }

    function openDivisiModal(id, name, description) {
        document.getElementById('modal-target').value = 'divisions';
        document.getElementById('modal-id').value = id;
        
        document.getElementById('box-content-field').classList.add('hidden');
        document.getElementById('box-photo-field').classList.add('hidden');
        document.getElementById('box-role-field').classList.add('hidden');
        
        document.getElementById('box-field-1').classList.remove('hidden');
        document.getElementById('label-field-1').innerText = 'Nama Divisi / Bidang';
        document.getElementById('input-field-1').value = name;

        document.getElementById('box-field-2').classList.remove('hidden');
        document.getElementById('label-field-2').innerText = 'Fokus Inti / Deskripsi Kerja';
        document.getElementById('input-field-2').value = description;
        showModal('Edit Informasi Divisi', '{{ route("admin.kelola_ukm.update") }}');
    }

    // REVISI: Fungsi JS Baru untuk Membuka Modal Pengeditan Program Kerja
    function openProkerModal(id, name, description) {
        document.getElementById('modal-target').value = 'programs';
        document.getElementById('modal-id').value = id;
        
        document.getElementById('box-content-field').classList.add('hidden');
        document.getElementById('box-photo-field').classList.add('hidden');
        document.getElementById('box-role-field').classList.add('hidden');
        
        document.getElementById('box-field-1').classList.remove('hidden');
        document.getElementById('label-field-1').innerText = 'Nama Program Kerja';
        document.getElementById('input-field-1').value = name;

        document.getElementById('box-field-2').classList.remove('hidden');
        document.getElementById('label-field-2').innerText = 'Deskripsi Program Kerja';
        document.getElementById('input-field-2').value = description;
        
        showModal('Edit Program Kerja', '{{ route("admin.kelola_ukm.update") }}');
    }

    function openAddVisiMisiModal(type) {
        document.getElementById('modal-target').value = 'visions_missions';
        document.getElementById('modal-type-visimisi').value = type;
        
        document.getElementById('box-field-1').classList.add('hidden');
        document.getElementById('box-field-2').classList.add('hidden');
        document.getElementById('box-photo-field').classList.add('hidden');
        document.getElementById('box-role-field').classList.add('hidden');
        
        document.getElementById('box-content-field').classList.remove('hidden');
        document.getElementById('input-content').value = '';
        
        const CapitalizedType = type.charAt(0).toUpperCase() + type.slice(1);
        showModal('Tambah Data ' + CapitalizedType + ' Baru', '{{ route("admin.kelola_ukm.store") }}');
    }

    function openAddBphModal() {
        document.getElementById('modal-target').value = 'bph_members';
        
        document.getElementById('box-content-field').classList.add('hidden');
        document.getElementById('box-role-field').classList.remove('hidden');
        
        document.getElementById('box-field-1').classList.remove('hidden');
        document.getElementById('label-field-1').innerText = 'Nama Lengkap Pengurus';
        document.getElementById('input-field-1').value = '';

        document.getElementById('box-field-2').classList.remove('hidden');
        document.getElementById('label-field-2').innerText = 'Program Studi & Angkatan';
        document.getElementById('input-field-2').value = '';

        document.getElementById('box-photo-field').classList.remove('hidden');
        document.getElementById('label-photo-title').innerText = 'Upload Foto Profil';
        showModal('Tambah Pengurus BPH Baru', '{{ route("admin.kelola_ukm.store") }}');
    }

    function openAddDivisiModal() {
        document.getElementById('modal-target').value = 'divisions';
        
        document.getElementById('box-content-field').classList.add('hidden');
        document.getElementById('box-photo-field').classList.add('hidden');
        document.getElementById('box-role-field').classList.add('hidden');
        
        document.getElementById('box-field-1').classList.remove('hidden');
        document.getElementById('label-field-1').innerText = 'Nama Divisi Baru';
        document.getElementById('input-field-1').value = '';

        document.getElementById('box-field-2').classList.remove('hidden');
        document.getElementById('label-field-2').innerText = 'Deskripsi Fungsional Kerja';
        document.getElementById('input-field-2').value = '';
        showModal('Tambah Divisi Organisasi Baru', '{{ route("admin.kelola_ukm.store") }}');
    }
</script>
</body>
</html>