<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Tim - UPN Mengajar</title>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;600;700;800&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
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
</head>
<body class="bg-surface text-gray-800 flex min-h-screen">

<aside class="h-screen w-72 fixed left-0 top-0 bottom-0 z-50 p-6 flex flex-col bg-white border-r shadow-[20px_0_40px_rgba(0,0,0,0.02)]">
    <div class="mb-10 px-4">
        <span class="font-headline font-extrabold text-red-600 text-2xl tracking-tighter uppercase">UPN Mengajar</span>
    </div>

    <div class="flex items-center gap-4 px-4 py-6 mb-6 rounded-xl bg-gray-50">
        <div class="w-12 h-12 rounded-full bg-red-50 text-red-600 flex items-center justify-center font-bold">
            <span class="material-symbols-outlined">person</span>
        </div>
        <div>
            <p class="font-body font-semibold text-slate-800 text-sm leading-none">{{ session('nama_lengkap') ?? 'Admin Utama' }}</p>
            <p class="text-[10px] text-gray-400 uppercase tracking-wider mt-1">Super Admin</p>
        </div>
    </div>

    <nav class="flex-1 space-y-1 overflow-y-auto">
        <a href="/admin/dashboard" class="flex items-center gap-3 px-4 py-3 rounded-lg font-body font-medium text-sm transition-all text-slate-600 hover:bg-gray-100">
            <span class="material-symbols-outlined text-[20px]">dashboard</span> Dashboard
        </a>
        
        <a href="/admin/kelola-relawan" class="flex items-center gap-3 px-4 py-3 rounded-lg font-body font-medium text-sm transition-all text-slate-600 hover:bg-gray-100">
            <span class="material-symbols-outlined text-[20px]">group</span> Data Relawan
        </a>
        
        <a href="/admin/kelola-kegiatan" class="flex items-center gap-3 px-4 py-3 rounded-lg font-body font-medium text-sm transition-all text-slate-600 hover:bg-gray-100">
            <span class="material-symbols-outlined text-[20px]">assignment</span> Kegiatan
        </a>

        <a href="/admin/kelola-dokumentasi" class="flex items-center gap-3 px-4 py-3 rounded-lg font-body font-medium text-sm transition-all text-slate-600 hover:bg-gray-100">
            <span class="material-symbols-outlined text-[20px]">image</span> Kelola Dokumentasi
        </a>

        <a href="/admin/kelola-mitra" class="flex items-center gap-3 px-4 py-3 rounded-lg font-body font-medium text-sm transition-all text-slate-600 hover:bg-gray-100">
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
        
        <a href="/admin/kelola-tim" class="flex items-center gap-3 px-4 py-3 rounded-lg font-body font-semibold text-sm bg-red-600 text-white shadow-md shadow-red-200 transition-all">
            <span class="material-symbols-outlined text-[20px]">badge</span> Kelola Tim
        </a>
    </nav>

    @if ($errors->any())
            <div class="p-3 mb-4 text-xs text-red-800 rounded-xl bg-red-50 border border-red-100 space-y-1">
                <p class="font-bold">Gagal menyimpan karena:</p>
                <ul class="list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

    <div class="pt-6 border-t border-gray-100">
        <form action="/logout" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin keluar?')">
            @csrf
            <button type="submit" class="w-full flex items-center gap-3 px-4 py-3 rounded-lg font-body font-medium text-sm text-red-600 hover:bg-red-50 transition-all group text-left cursor-pointer">
                <span class="material-symbols-outlined text-[20px] group-hover:rotate-12 transition-transform">logout</span> Logout
            </button>
        </form>
    </div>
</aside>

<main class="flex-1 ml-72 p-8">
    <header class="flex justify-between items-center mb-6">
        <div>
            <h1 class="font-headline font-bold text-2xl text-primary">Kelola Anggota Tim</h1>
            <p class="text-xs text-gray-400 mt-0.5">Manajemen kepengurusan / anggota organisasi UPN Mengajar.</p>
        </div>
        <button onclick="toggleModal('modal-tambah')" class="bg-primary hover:bg-red-700 text-white font-bold py-2.5 px-4 rounded-xl text-sm flex items-center gap-2 shadow-sm cursor-pointer">
            <span class="material-symbols-outlined text-sm">add</span> Tambah Anggota
        </button>
    </header>

    @if(session('pesan'))
    <div class="p-4 mb-6 text-sm text-green-800 rounded-xl bg-green-50 border border-green-100">
        {{ session('pesan') }}
    </div>
    @endif

    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
        <table class="w-full text-left text-sm">
            <thead class="bg-gray-50 text-[11px] font-bold text-gray-400 uppercase tracking-wider border-b">
                <tr>
                    <th class="px-6 py-4 w-16 text-center">Urutan</th>
                    <th class="px-6 py-4">Foto</th>
                    <th class="px-6 py-4">Nama</th>
                    <th class="px-6 py-4">Kategori & Jabatan</th>
                    <th class="px-6 py-4">Kontak / Sosmed</th>
                    <th class="px-6 py-4 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse($tim as $item)
                <tr class="hover:bg-gray-50/50">
                    <td class="px-6 py-4 text-center font-bold text-gray-400">{{ $item->urutan }}</td>
                    <td class="px-6 py-4">
                        @if($item->foto)
                            <img src="{{ asset('foto_tim/'.$item->foto) }}" class="w-10 h-10 object-cover rounded-full border border-gray-100">
                        @else
                            <div class="w-10 h-10 rounded-full bg-gray-100 flex items-center justify-center text-gray-400">?</div>
                        @endif
                    </td>
                    <td class="px-6 py-4 font-semibold text-gray-900">{{ $item->nama }}</td>
                    <td class="px-6 py-4">
                        <span class="px-2 py-0.5 text-[10px] font-bold uppercase rounded-full {{ $item->kategori == 'bph' ? 'bg-red-50 text-primary' : 'bg-blue-50 text-blue-600' }} block w-fit mb-1">
                            {{ $item->kategori == 'bph' ? 'BPH' : 'STAF AHLI' }}
                        </span>
                        <span class="text-gray-600 text-xs">{{ $item->jabatan }}</span>
                    </td>
                    <td class="px-6 py-4 space-y-0.5 text-xs text-gray-500">
                        <div class="flex items-center gap-1">📧 {{ $item->email ?? '-' }}</div>
                        <div class="flex items-center gap-1">📸 {{ $item->instagram ?? '-' }}</div>
                        <div class="flex items-center gap-1">💼 {{ $item->linkedin ?? '-' }}</div>
                    </td>
                    <td class="px-6 py-4">
                        <div class="flex items-center justify-center gap-2">
                            <button onclick="bukaModalEdit({{ json_encode($item) }})" class="p-2 bg-gray-50 text-gray-600 hover:bg-gray-100 rounded-lg transition-all cursor-pointer">
                                <span class="material-symbols-outlined text-sm">edit</span>
                            </button>
                            <form action="/admin/kelola-tim/{{ $item->id }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus anggota ini?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="p-2 bg-red-50 text-primary hover:bg-red-100 rounded-lg transition-all cursor-pointer">
                                    <span class="material-symbols-outlined text-sm">delete</span>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center py-10 text-gray-400 text-sm">Belum ada data anggota tim.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</main>

<div id="modal-tambah" class="hidden fixed inset-0 z-50 bg-black/40 flex items-center justify-center p-4">
    <div class="bg-white w-full max-w-md rounded-2xl shadow-xl p-6 relative">
        <h3 class="font-headline font-bold text-lg text-gray-900 mb-4">Tambah Anggota Baru</h3>
        <form action="/admin/kelola-tim" method="POST" enctype="multipart/form-data" class="space-y-4">
            @csrf
            <div>
                <label class="text-[11px] font-bold text-gray-400 uppercase tracking-wider block mb-1">Nama Anggota</label>
                <input type="text" name="nama" required class="w-full text-sm rounded-xl border-gray-200 focus:ring-primary focus:border-primary">
            </div>
            <div class="grid grid-cols-2 gap-3">
                <div>
                    <label class="text-[11px] font-bold text-gray-400 uppercase tracking-wider block mb-1">Kategori</label>
                    <select name="kategori" required class="w-full text-sm rounded-xl border-gray-200 focus:ring-primary focus:border-primary bg-white">
                        <option value="bph">BPH</option>
                        <option value="staf_ahli">Staf Ahli</option>
                    </select>
                </div>
                <div>
                    <label class="text-[11px] font-bold text-gray-400 uppercase tracking-wider block mb-1">Jabatan</label>
                    <input type="text" name="jabatan" required placeholder="Ketua / Staff" class="w-full text-sm rounded-xl border-gray-200 focus:ring-primary focus:border-primary">
                </div>
            </div>
            <div>
                <label class="text-[11px] font-bold text-gray-400 uppercase tracking-wider block mb-1">Foto Anggota</label>
                <input type="file" name="foto" required accept="image/*" class="w-full text-sm rounded-xl border border-gray-200 bg-gray-50 file:mr-3 file:py-1.5 file:px-3 file:border-0 file:text-xs file:font-semibold file:bg-red-50 file:text-primary">
            </div>
            <div>
                <label class="text-[11px] font-bold text-gray-400 uppercase tracking-wider block mb-1">Email</label>
                <input type="email" name="email" placeholder="nama@upnmengajar.com" class="w-full text-sm rounded-xl border-gray-200 focus:ring-primary focus:border-primary">
            </div>
            <div class="grid grid-cols-2 gap-3">
                <div>
                    <label class="text-[11px] font-bold text-gray-400 uppercase tracking-wider block mb-1">Instagram (@)</label>
                    <input type="text" name="instagram" placeholder="@username" class="w-full text-sm rounded-xl border-gray-200 focus:ring-primary focus:border-primary">
                </div>
                <div>
                    <label class="text-[11px] font-bold text-gray-400 uppercase tracking-wider block mb-1">LinkedIn URL</label>
                    <input type="url" name="linkedin" placeholder="https://..." class="w-full text-sm rounded-xl border-gray-200 focus:ring-primary focus:border-primary">
                </div>
            </div>
            <div>
                <label class="text-[11px] font-bold text-gray-400 uppercase tracking-wider block mb-1">No Urut Tampil</label>
                <input type="number" name="urutan" value="0" min="0" class="w-full text-sm rounded-xl border-gray-200 focus:ring-primary focus:border-primary">
            </div>
            <div class="flex gap-3 pt-2">
                <button type="submit" class="flex-1 bg-primary text-white font-bold py-2.5 rounded-xl text-sm cursor-pointer">Simpan</button>
                <button type="button" onclick="toggleModal('modal-tambah')" class="flex-1 bg-gray-100 text-gray-600 font-bold py-2.5 rounded-xl text-sm cursor-pointer">Batal</button>
            </div>
        </form>
    </div>
</div>

<div id="modal-edit" class="hidden fixed inset-0 z-50 bg-black/40 flex items-center justify-center p-4">
    <div class="bg-white w-full max-w-md rounded-2xl shadow-xl p-6 relative">
        <h3 class="font-headline font-bold text-lg text-gray-900 mb-4">Ubah Data Anggota</h3>
        
        <form id="form-edit" method="POST" enctype="multipart/form-data" class="space-y-4">
            @csrf @method('PUT')
            <div>
                <label class="text-[11px] font-bold text-gray-400 uppercase tracking-wider block mb-1">Nama Anggota</label>
                <input type="text" name="nama" id="edit-nama" required class="w-full text-sm rounded-xl border-gray-200 focus:ring-primary focus:border-primary">
            </div>
            <div class="grid grid-cols-2 gap-3">
                <div>
                    <label class="text-[11px] font-bold text-gray-400 uppercase tracking-wider block mb-1">Kategori</label>
                    <select name="kategori" id="edit-kategori" required class="w-full text-sm rounded-xl border-gray-200 focus:ring-primary focus:border-primary bg-white">
                        <option value="bph">BPH</option>
                        <option value="staf_ahli">Staf Ahli</option>
                    </select>
                </div>
                <div>
                    <label class="text-[11px] font-bold text-gray-400 uppercase tracking-wider block mb-1">Jabatan</label>
                    <input type="text" name="jabatan" id="edit-jabatan" required class="w-full text-sm rounded-xl border-gray-200 focus:ring-primary focus:border-primary">
                </div>
            </div>
            <div>
                <label class="text-[11px] font-bold text-gray-400 uppercase tracking-wider block mb-1">Foto Anggota (Kosongkan jika tidak diganti)</label>
                <input type="file" name="foto" accept="image/*" class="w-full text-sm rounded-xl border border-gray-200 bg-gray-50 file:mr-3 file:py-1.5 file:px-3 file:border-0 file:text-xs file:font-semibold file:bg-red-50 file:text-primary">
            </div>
            <div>
                <label class="text-[11px] font-bold text-gray-400 uppercase tracking-wider block mb-1">Email</label>
                <input type="email" name="email" id="edit-email" class="w-full text-sm rounded-xl border-gray-200 focus:ring-primary focus:border-primary">
            </div>
            <div class="grid grid-cols-2 gap-3">
                <div>
                    <label class="text-[11px] font-bold text-gray-400 uppercase tracking-wider block mb-1">Instagram</label>
                    <input type="text" name="instagram" id="edit-instagram" class="w-full text-sm rounded-xl border-gray-200 focus:ring-primary focus:border-primary">
                </div>
                <div>
                    <label class="text-[11px] font-bold text-gray-400 uppercase tracking-wider block mb-1">LinkedIn</label>
                    <input type="url" name="linkedin" id="edit-linkedin" class="w-full text-sm rounded-xl border-gray-200 focus:ring-primary focus:border-primary">
                </div>
            </div>
            <div>
                <label class="text-[11px] font-bold text-gray-400 uppercase tracking-wider block mb-1">No Urut Tampil</label>
                <input type="number" name="urutan" id="edit-urutan" min="0" class="w-full text-sm rounded-xl border-gray-200 focus:ring-primary focus:border-primary">
            </div>
            <div class="flex gap-3 pt-2">
                <button type="submit" class="flex-1 bg-primary text-white font-bold py-2.5 rounded-xl text-sm cursor-pointer">Update</button>
                <button type="button" onclick="toggleModal('modal-edit')" class="flex-1 bg-gray-100 text-gray-600 font-bold py-2.5 rounded-xl text-sm cursor-pointer">Batal</button>
            </div>
        </form>
    </div>
</div>

<script>
    function toggleModal(id) {
        const modal = document.getElementById(id);
        modal.classList.toggle('hidden');
    }

    // 🌟 REVISI 2: Pengisian URL action yang absolut dan aman dari cache browser
    function bukaModalEdit(data) {
        const formElement = document.getElementById('form-edit');
        formElement.action = window.location.protocol + '//' + window.location.host + '/admin/kelola-tim/' + data.id;
        
        document.getElementById('edit-nama').value = data.nama;
        document.getElementById('edit-kategori').value = data.kategori;
        document.getElementById('edit-jabatan').value = data.jabatan;
        document.getElementById('edit-email').value = data.email ?? '';
        document.getElementById('edit-instagram').value = data.instagram ?? '';
        document.getElementById('edit-linkedin').value = data.linkedin ?? '';
        document.getElementById('edit-urutan').value = data.urutan;
        toggleModal('modal-edit');
    }
</script>
</body>
</html>