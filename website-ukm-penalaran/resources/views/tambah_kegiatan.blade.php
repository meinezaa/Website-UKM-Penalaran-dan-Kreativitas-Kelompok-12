<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Kegiatan - Admin Panel</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <style> body { font-family: 'Poppins', sans-serif; } </style>
</head>
<body class="bg-gray-100 p-6">

    <div class="max-w-4xl w-full mx-auto bg-white rounded-2xl shadow-xl overflow-hidden my-10">
        <div class="bg-red-700 p-6 text-white text-center">
            <h2 class="text-2xl font-bold">Tambah Kegiatan Baru</h2>
            <p class="text-red-100 text-sm">Input data detail kegiatan dan kebutuhan relawan</p>
        </div>

        <form action="{{ route('admin.kegiatan.simpan') }}" method="POST" enctype="multipart/form-data" class="p-8 space-y-8" novalidate>
            @csrf

            <div>
                <h3 class="text-lg font-bold text-red-700 border-b-2 border-red-100 mb-4">1. Informasi Dasar</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="md:col-span-2">
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Nama Kegiatan</label>
                        <input type="text" name="nama_kegiatan" required value="{{ old('nama_kegiatan') }}" placeholder="Contoh: Relawan Penggerak SD Medokan"
                               class="w-full border border-gray-300 px-4 py-2.5 rounded-lg focus:ring-2 focus:ring-red-500 outline-none">
                    </div>
                    <div class="md:col-span-2">
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Foto Utama Kegiatan</label>
                        <input type="file" name="foto_kegiatan" accept="image/*" required
                               class="w-full border border-gray-300 px-4 py-2 rounded-lg bg-gray-50">
                        <p class="text-xs text-gray-500 mt-1">*Disarankan rasio 16:9 (Contoh: 1280x720 px)</p>
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Kategori Program</label>
                        <select name="kategori" required class="w-full border border-gray-300 px-4 py-2.5 rounded-lg focus:ring-2 focus:ring-red-500 bg-white">
                            <option value="sd" {{ old('kategori') == 'sd' ? 'selected' : '' }}>Sekolah Dasar</option>
                            <option value="slb" {{ old('kategori') == 'slb' ? 'selected' : '' }}>Sekolah Luar Biasa</option>
                            <option value="yayasan" {{ old('kategori') == 'yayasan' ? 'selected' : '' }}>Yayasan / Panti</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Status</label>
                        <select name="status_kegiatan" class="w-full border border-gray-300 px-4 py-2.5 rounded-lg focus:ring-2 focus:ring-red-500 bg-white">
                            <option value="aktif" {{ old('status_kegiatan') == 'aktif' ? 'selected' : '' }}>Aktif</option>
                            <option value="selesai" {{ old('status_kegiatan') == 'selesai' ? 'selected' : '' }}>Selesai</option>
                        </select>
                    </div>
                </div>
            </div>

            <div>
                <h3 class="text-lg font-bold text-red-700 border-b-2 border-red-100 mb-4">2. Waktu & Lokasi</h3>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-4">
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Tanggal Pelaksanaan</label>
                        <input type="date" name="tanggal_pelaksanaan" required value="{{ old('tanggal_pelaksanaan') }}" class="w-full border border-gray-300 px-4 py-2.5 rounded-lg focus:ring-2 focus:ring-red-500">
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Jam Kegiatan</label>
                        <input type="text" name="jam_kegiatan" required value="{{ old('jam_kegiatan') }}" placeholder="08.00 - 12.00 WIB" class="w-full border border-gray-300 px-4 py-2.5 rounded-lg focus:ring-2 focus:ring-red-500">
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Batas Registrasi</label>
                        <input type="date" name="batas_registrasi" required value="{{ old('batas_registrasi') }}" class="w-full border border-gray-300 px-4 py-2.5 rounded-lg focus:ring-2 focus:ring-red-500">
                    </div>
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Nama Lokasi (Gedung/Sekolah)</label>
                    <input type="text" name="lokasi" required value="{{ old('lokasi') }}" placeholder="Contoh: SD Medokan Ayu 1" class="w-full border border-gray-300 px-4 py-2.5 rounded-lg focus:ring-2 focus:ring-red-500">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Alamat Lengkap</label>
                    <textarea name="alamat_lengkap" rows="2" required placeholder="Jl. Raya Medokan Sawah No.7, Kec. Rungkut..." class="w-full border border-gray-300 px-4 py-2.5 rounded-lg focus:ring-2 focus:ring-red-500">{{ old('alamat_lengkap') }}</textarea>
                </div>
            </div>

            <div>
                <h3 class="text-lg font-bold text-red-700 border-b-2 border-red-100 mb-4">3. Deskripsi & Aktivitas</h3>
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Detail Aktivitas (Poin-poin)</label>
                        <textarea name="detail_aktivitas" rows="3" required placeholder="Mendampingi belajar, Membantu literasi..." class="w-full border border-gray-300 px-4 py-2.5 rounded-lg focus:ring-2 focus:ring-red-500">{{ old('detail_aktivitas') }}</textarea>
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Deskripsi Lengkap</label>
                        <textarea name="deskripsi_detail" rows="4" required placeholder="Latar belakang kegiatan secara detail..." class="w-full border border-gray-300 px-4 py-2.5 rounded-lg focus:ring-2 focus:ring-red-500">{{ old('deskripsi_detail') }}</textarea>
                    </div>
                </div>
            </div>

            <div>
                <h3 class="text-lg font-bold text-red-700 border-b-2 border-red-100 mb-4">4. Kebutuhan Per Divisi</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    @php
                    $divisis = [
                        'sekretaris' => 'Sekretaris', 'bendahara' => 'Bendahara', 
                        'acara' => 'Acara', 'humas' => 'Humas', 
                        'perkap' => 'Perkap', 'pendamping' => 'Pendamping Kelompok', 
                        'pdd' => 'PDD', 'sponsorship' => 'Sponsorship'
                    ];
                    @endphp
                    
                    @foreach($divisis as $key => $label)
                    <div class="p-4 bg-gray-50 border border-gray-200 rounded-xl">
                        <label class="block text-md font-bold text-gray-800 mb-3 border-b pb-1">{{ $label }}</label>
                        <div class="space-y-3">
                            <div>
                                <label class="block text-xs font-semibold text-gray-600 uppercase">Kuota Orang</label>
                                <input type="number" name="kuota_{{ $key }}" value="{{ old('kuota_'.$key) }}" placeholder="0" min="0" class="w-full border border-gray-300 px-3 py-1.5 rounded-lg focus:ring-2 focus:ring-red-500 outline-none">
                            </div>
                            <div>
                                <label class="block text-xs font-semibold text-gray-600 uppercase">Job Description</label>
                                <textarea name="jobdesc_{{ $key }}" rows="2" placeholder="Tugas divisi..." class="w-full border border-gray-300 px-3 py-1.5 rounded-lg focus:ring-2 focus:ring-red-500 text-sm outline-none">{{ old('jobdesc_'.$key) }}</textarea>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

            <div class="flex gap-4 pt-6 border-t border-gray-100">
                <button type="submit" class="flex-1 bg-red-700 text-white font-bold py-4 rounded-xl hover:bg-red-800 shadow-lg transition-all transform hover:-translate-y-1">Simpan Kegiatan</button>
                <a href="{{ route('admin.dashboard') }}" class="flex-1 bg-gray-200 text-gray-700 font-bold py-4 rounded-xl text-center hover:bg-gray-300 transition-all">Batal</a>
            </div>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    @if(session('status_sukses'))
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({
                icon: 'success',
                title: 'Mantap!',
                text: "{{ session('status_sukses') }}",
                showConfirmButton: false,
                timer: 2000
            }).then(() => {
                window.location.href = "{{ route('admin.dashboard') }}";
            });
        });
    </script>
    @endif

    <script>
        document.querySelector('form').addEventListener('submit', function(e) {
            let adaYangKosong = false;

            const inputWajib = document.querySelectorAll('input[required], select[required], textarea[required]');
            
            inputWajib.forEach(input => {
                if (input.type === 'file') {
                    if (input.files.length === 0) {
                        adaYangKosong = true;
                    }
                } else {
                    if (input.value.trim() === '') {
                        adaYangKosong = true;
                    }
                }
            });

            if (adaYangKosong) {
                e.preventDefault();
                Swal.fire({
                    icon: 'warning',
                    title: 'Data Belum Lengkap!',
                    text: 'Mohon lengkapi semua isian data dan foto sebelum menyimpan.',
                    confirmButtonColor: '#b91c1c'
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
                    title: 'Kuota Kosong!',
                    text: 'Silakan isi minimal 1 kuota relawan di salah satu divisi.',
                    confirmButtonColor: '#b91c1c'
                });
                return;
            }
        });
    </script>
</body>
</html>