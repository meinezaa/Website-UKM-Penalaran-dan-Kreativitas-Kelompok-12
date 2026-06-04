@php
    // PROTEKSI & DATA OTOMATIS: 
    // Laravel otomatis mengambil data user yang sedang login melalui auth()->user()
    // Kolom 'nama_lengkap' dan 'email' diambil dari tabel users bawaan database Anda
    $user_data = auth()->user();
    $email_otomatis = $user_data ? $user_data->email : '';
    $nama_otomatis  = $user_data ? $user_data->nama_lengkap : ''; 
@endphp

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pendaftaran | UPN Mengajar</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        .bg-pattern { background-color: #bb0016; background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='100' height='100' viewBox='0 0 100 100'%3E%3Cg fill='%23ffffff' fill-opacity='0.05'%3E%3Cpath d='M96 95h4v1h-4v4h-1v-4h-9v4h-1v-4h-9v4h-1v-4h-9v4h-1v-4h-9v4h-1v-4h-9v4h-1v-4h-9v4h-1v-4h-9v4h-1v-4h-9v4h-1v-4H0v-1h15v-9H0v-1h15v-9H0v-1h15v-9H0v-1h15v-9H0v-1h15v-9H0v-1h15v-9H0v-1h15v-9H0v-1h15V0h1v15h9V0h1v15h9V0h1v15h9V0h1v15h9V0h1v15h9V0h1v15h9V0h1v15h9V0h1v15h4v1h-4v9h4v1h-4v9h4v1h-4v9h4v1h-4v9h4v1h-4v9h4v1h-4v9h4v1h-4v9h4v1h-4v9z'/%3E%3C/g%3E%3C/svg%3E"); }
    </style>
</head>
<body class="bg-pattern min-h-screen flex items-center justify-center p-6">
    <div class="bg-white w-full max-w-2xl rounded-[2.5rem] shadow-2xl overflow-hidden">
        
        {{-- HEADER & TAHAPAN STEP INDIKATOR --}}
        <div class="bg-gray-50 px-10 py-8 border-b border-gray-100 text-center">
            <h1 class="text-2xl font-extrabold text-gray-900 italic">Formulir <span class="text-red-600">Relawan</span></h1>
            <p class="text-xs text-gray-400 font-semibold mt-1 uppercase tracking-wide">{{ $kegiatan->nama_kegiatan }}</p>
            <div class="flex items-center justify-center mt-6 space-x-3">
                <div id="dot-1" class="w-10 h-2 rounded-full bg-red-600 transition-all duration-300"></div>
                <div id="dot-2" class="w-6 h-2 rounded-full bg-gray-200 transition-all duration-300"></div>
                <div id="dot-3" class="w-6 h-2 rounded-full bg-gray-200 transition-all duration-300"></div>
            </div>
        </div>

        {{-- FORM UTAMA --}}
        <form id="formRelawan" action="{{ route('pendaftaran.simpan') }}" method="POST" enctype="multipart/form-data" class="p-10">
            @csrf

            {{-- SINKRONISASI: Diambil dari object $kegiatan dari controller --}}
            <input type="hidden" name="id_kegiatan" value="{{ $kegiatan->id_kegiatan }}">
            
            {{-- STEP 1: INFORMASI DATA DIRI & DIVISI --}}
            <div id="step-1" class="space-y-5">
                <div>
                    <label class="block text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-1">Nama Lengkap</label>
                    <input type="text" name="nama_lengkap" value="{{ $nama_otomatis }}" readonly class="w-full px-5 py-3 bg-gray-100 border rounded-xl outline-none text-gray-500 font-semibold cursor-not-allowed">
                </div>
                
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-1">WhatsApp</label>
                        <input type="number" name="no_hp" required placeholder="08..." class="w-full px-5 py-3 bg-gray-50 border rounded-xl outline-none focus:border-red-600">
                    </div>
                    <div>
                        <label class="block text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-1">Email Aktif</label>
                        <input type="text" value="{{ $email_otomatis }}" readonly class="w-full px-5 py-3 bg-gray-100 border rounded-xl text-gray-500 text-sm font-semibold italic cursor-not-allowed">
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-4 items-center">
                    <div>
                        <label class="block text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-1">Umur</label>
                        <input type="number" name="umur" required placeholder="20" class="w-full px-5 py-3 bg-gray-50 border rounded-xl outline-none focus:border-red-600">
                    </div>
                    <div>
                        <label class="block text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-1">Jenis Kelamin</label>
                        <div class="flex gap-2">
                            <input type="radio" name="jenis_kelamin" id="L" value="Laki-laki" class="hidden" required onchange="updateGenderStyle()">
                            <label id="label-L" for="L" class="flex-1 text-center py-2.5 border rounded-xl cursor-pointer text-sm font-bold text-gray-400 bg-gray-50 transition-all">Laki-laki</label>
                            
                            <input type="radio" name="jenis_kelamin" id="P" value="Perempuan" class="hidden" onchange="updateGenderStyle()">
                            <label id="label-P" for="P" class="flex-1 text-center py-2.5 border rounded-xl cursor-pointer text-sm font-bold text-gray-400 bg-gray-50 transition-all">Perempuan</label>
                        </div>
                    </div>
                </div>

                <div>
                    <label class="block text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-1">Jurusan / Program Studi</label>
                    <select name="asal_prodi" required class="w-full px-5 py-3 bg-gray-50 border rounded-xl outline-none focus:border-red-600">
                        <option value="">Pilih Program Studi</option>
                        <option value="Informatika">Informatika</option>
                        <option value="Sistem Informasi">Sistem Informasi</option>
                        <option value="Teknik Industri">Teknik Industri</option>
                        <option value="Sains Data">Sains Data</option>
                        <option value="Manajemen">Manajemen</option>
                        <option value="Akuntansi">Akuntansi</option>
                    </select>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-1">Divisi Utama</label>
                        <select name="pilihan_divisi_1" required class="w-full px-5 py-3 bg-gray-50 border rounded-xl outline-none focus:border-red-600">
                            <option value="">Pilih Divisi Utama</option>
                            {{-- SINKRONISASI: Membaca data divisi kegiatan aktif dari database --}}
                            @foreach($divisi_kegiatan as $divisi)
                                <option value="{{ $divisi->nama_divisi }}">{{ $divisi->nama_divisi }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="block text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-1">Divisi Cadangan</label>
                        <select name="pilihan_divisi_2" required class="w-full px-5 py-3 bg-gray-50 border rounded-xl outline-none focus:border-red-600">
                            <option value="">Pilih Divisi Cadangan</option>
                            @foreach($divisi_kegiatan as $divisi)
                                <option value="{{ $divisi->nama_divisi }}">{{ $divisi->nama_divisi }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div>
                    <label class="block text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-1">Link Portofolio</label>
                    <input type="url" name="portofolio" required placeholder="https://drive.google.com/..." class="w-full px-5 py-3 bg-gray-50 border rounded-xl outline-none mb-3 focus:border-red-600">
                    
                    <label class="block text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-1">Pengalaman & Keahlian</label>
                    {{-- SINKRONISASI: Mengubah nama dari deskripsi menjadi pengalaman_keahlian --}}
                    <textarea name="pengalaman_keahlian" required placeholder="Ceritakan pengalaman organisasi atau keahlian kepengurusanmu..." class="w-full px-5 py-3 bg-gray-50 border rounded-xl outline-none min-h-[80px] focus:border-red-600"></textarea>
                </div>
            </div>

            {{-- STEP 2: METODE BIAYA REGISTRASI --}}
            <div id="step-2" class="hidden space-y-6 text-center">
                <div class="bg-red-50 p-6 rounded-3xl border border-red-100 italic font-bold text-red-700">
                    BIAYA REGISTRASI: RP 50.000<br>
                    <span class="text-[10px] text-red-500 tracking-widest uppercase">BCA 12345678 A/N UPN MENGJAR</span>
                </div>
                <div class="text-left">
                    <label class="block text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-2">Metode Transfer</label>
                    {{-- SINKRONISASI: Mengubah opsi value agar valid sesuai ENUM database Anda --}}
                    <select name="metode_pembayaran" required class="w-full px-5 py-3 bg-gray-50 border rounded-xl outline-none focus:border-red-600">
                        <option value="BCA">Bank BCA</option>
                        <option value="BNI">Bank BNI</option>
                        <option value="MANDIRI">Bank Mandiri</option>
                    </select>
                </div>
                <div class="border-2 border-dashed border-gray-200 rounded-[2rem] p-12 relative hover:border-red-400 transition-all group">
                    <input type="file" name="bukti_pembayaran" required class="absolute inset-0 opacity-0 cursor-pointer" onchange="document.getElementById('file-name').innerText = 'File: ' + this.files[0].name">
                    <p id="file-name" class="text-gray-400 font-bold text-[10px] uppercase tracking-[0.2em] group-hover:text-red-600 transition-all">Upload Bukti Transfer</p>
                </div>
            </div>

            {{-- STEP 3: KONFIRMASI PERSETUJUAN AKHIR --}}
            <div id="step-3" class="hidden text-center space-y-6">
                <div class="w-16 h-16 bg-green-50 text-green-600 rounded-full flex items-center justify-center mx-auto">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                </div>
                <h2 class="text-lg font-extrabold italic">Konfirmasi Akhir</h2>
                <div class="bg-gray-50 p-6 rounded-2xl text-left text-[11px] text-gray-400 border border-gray-100 uppercase font-semibold leading-relaxed">
                    1. Saya bersedia mengikuti seluruh rangkaian program pengabdian.<br>
                    2. Seluruh data berkas dan bukti pembayaran yang dilampirkan adalah benar.
                </div>
                <label class="flex items-center gap-4 p-5 bg-gray-50 rounded-2xl cursor-pointer border hover:border-red-600/20 transition-all">
                    <input type="checkbox" name="persetujuan" required class="w-6 h-6 accent-red-600 rounded-lg">
                    <span class="text-[10px] font-bold text-gray-400 uppercase text-left leading-tight">Saya setuju dengan S&K di atas.</span>
                </label>
            </div>

            {{-- NAVIGASI BUTTON FOOTER --}}
            <div class="flex justify-between items-center mt-12">
                <button type="button" id="prevBtn" onclick="move(-1)" class="hidden text-gray-400 font-bold text-xs uppercase hover:text-red-600">Kembali</button>
                <div class="flex-1"></div>
                <button type="button" id="nextBtn" onclick="move(1)" class="bg-red-600 text-white px-12 py-4 rounded-2xl font-bold text-xs uppercase tracking-[0.2em] shadow-2xl shadow-red-200 hover:bg-red-800 transition-all active:scale-95">Lanjut</button>
            </div>
        </form>
    </div>

    {{-- INTERAKTIVITAS LOGIC MULTI-STEP VIA JAVASCRIPT --}}
    <script>
        let step = 1;

        function move(n) {
            // Evaluasi Validasi HTML saat klik Tombol "Lanjut" (n = 1)
            if (n === 1) {
                const currentStepDiv = document.getElementById(`step-${step}`);
                const requiredInputs = currentStepDiv.querySelectorAll("input[required], select[required], textarea[required]");
                
                // Cek Radio Button jenis kelamin secara spesifik di tahapan step 1
                const isRadioValid = step !== 1 || document.querySelector('input[name="jenis_kelamin"]:checked');
                
                let allFilled = true;
                requiredInputs.forEach(input => { 
                    if (!input.value || !input.checkValidity()) {
                        allFilled = false;
                        input.reportValidity(); // Memunculkan tooltip validasi default browser jika kosong
                    } 
                });

                if (!allFilled || !isRadioValid) { 
                    return false; 
                }
            }

            // Aksi Eksekusi Form Submit jika berada di Step 3 dan klik "Kirim Sekarang"
            if (step + n > 3) {
                document.getElementById('formRelawan').submit();
                return true;
            }

            // Sembunyikan container step saat ini, lalu pindah tahapan indeks angka step
            document.getElementById(`step-${step}`).classList.add("hidden");
            step += n;
            
            // Tampilkan container step tujuan baru
            document.getElementById(`step-${step}`).classList.remove("hidden");

            // Mengatur visibilitas Tombol Kembali
            document.getElementById("prevBtn").classList.toggle("hidden", step === 1);
            
            // Mengubah tipe dan isi teks tombol kanan utama
            const nextBtn = document.getElementById("nextBtn");
            if (step === 3) {
                nextBtn.innerText = "Kirim Sekarang";
            } else {
                nextBtn.innerText = "Lanjut";
            }

            // Update animasi tampilan garis Dot Indikator Tahapan Atas
            for(let i = 1; i <= 3; i++) {
                const dot = document.getElementById(`dot-${i}`);
                if (i === step) {
                    dot.className = "w-10 h-2 rounded-full bg-red-600 transition-all duration-300";
                } else if (i < step) {
                    dot.className = "w-6 h-2 rounded-full bg-red-800 transition-all duration-300";
                } else {
                    dot.className = "w-6 h-2 rounded-full bg-gray-200 transition-all duration-300";
                }
            }
        }

        // Fungsi pewarnaan background komponen visual Radio Button Jenis Kelamin saat diklik
        function updateGenderStyle() {
            const labelL = document.getElementById('label-L');
            const labelP = document.getElementById('label-P');
            const radioL = document.getElementById('L');
            const radioP = document.getElementById('P');

            if (radioL.checked) {
                labelL.className = "flex-1 text-center py-2.5 border border-red-600 rounded-xl cursor-pointer text-sm font-bold text-red-600 bg-red-50 transition-all";
                labelP.className = "flex-1 text-center py-2.5 border border-gray-200 rounded-xl cursor-pointer text-sm font-bold text-gray-400 bg-gray-50 transition-all";
            } else if (radioP.checked) {
                labelP.className = "flex-1 text-center py-2.5 border border-red-600 rounded-xl cursor-pointer text-sm font-bold text-red-600 bg-red-50 transition-all";
                labelL.className = "flex-1 text-center py-2.5 border border-gray-200 rounded-xl cursor-pointer text-sm font-bold text-gray-400 bg-gray-50 transition-all";
            }
        }
    </script>
</body>
</html>