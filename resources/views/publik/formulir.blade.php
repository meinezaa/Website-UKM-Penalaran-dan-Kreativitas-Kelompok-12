<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pendaftaran | UPN Mengajar</title>
    <link rel="stylesheet" href="{{ asset('dist/output.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700;800&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        .bg-pattern { background-color: #bb0016; background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='100' height='100' viewBox='0 0 100 100'%3E%3Cg fill='%23ffffff' fill-opacity='0.05'%3E%3Cpath d='M96 95h4v1h-4v4h-1v-4h-9v4h-1v-4h-9v4h-1v-4h-9v4h-1v-4h-9v4h-1v-4h-9v4h-1v-4h-9v4h-1v-4H0v-1h15v-9H0v-1h15v-9H0v-1h15v-9H0v-1h15v-9H0v-1h15v-9H0v-1h15v-9H0v-1h15V0h1v15h9V0h1v15h9V0h1v15h9V0h1v15h9V0h1v15h9V0h1v15h4v1h-4v9h4v1h-4v9h4v1h-4v9h4v1h-4v9h4v1h-4v9h4v1h-4v9h4v1h-4v9h4v1h-4v9z'/%3E%3C/g%3E%3C/svg%3E"); }
        
        input[type="radio"]:checked + .method-card {
            border-color: #ef4444;
            background-color: #fef2f2;
            box-shadow: 0 10px 15px -3px rgba(239, 68, 68, 0.1);
        }
        input[type="radio"]:checked + .gender-card {
            background-color: #fef2f2;
            border-color: #ef4444;
            color: #b91c1c;
        }
    </style>
</head>
<body class="bg-pattern min-h-screen flex items-center justify-center p-6">
    <div class="bg-white w-full max-w-2xl rounded-[2.5rem] shadow-2xl overflow-hidden my-6">
        <div class="bg-gray-50 px-10 py-8 border-b border-gray-100 text-center">
            <h1 class="text-2xl font-extrabold text-gray-900 italic">Formulir <span class="text-red-600">Relawan</span></h1>
            <div class="flex items-center justify-center mt-6 space-x-3">
                <div id="dot-1" class="w-10 h-2 rounded-full bg-red-600 transition-all duration-300"></div>
                <div id="dot-2" class="w-6 h-2 rounded-full bg-gray-200 transition-all duration-300"></div>
                <div id="dot-3" class="w-6 h-2 rounded-full bg-gray-200 transition-all duration-300"></div>
            </div>
        </div>

        <form id="formRelawan" action="{{ route('relawan.daftar', $kegiatan->id_kegiatan) }}" method="POST" enctype="multipart/form-data" class="p-10">
            @csrf

            <input type="hidden" name="id_kegiatan" value="{{ $kegiatan->id_kegiatan }}">

            <div id="step-1" class="space-y-5">
                <div>
                    <label class="block text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-1">Nama Lengkap</label>
                    <input type="text" name="nama_lengkap" value="{{ Auth::user()->nama_lengkap ?? '' }}" required placeholder="Masukkan nama lengkap Anda" class="w-full px-5 py-3 bg-gray-50 border rounded-xl outline-none focus:border-red-600 transition-all font-semibold">
                </div>
                
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-1">WhatsApp</label>
                        <input type="number" name="no_hp" required placeholder="08..." class="w-full px-5 py-3 bg-gray-50 border rounded-xl outline-none focus:border-red-600 transition-all">
                    </div>
                    <div>
                        <label class="block text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-1">Email Aktif</label>
                        <input type="email" name="email" value="{{ Auth::user()->email ?? '' }}" required placeholder="contoh@gmail.com" class="w-full px-5 py-3 bg-gray-50 border rounded-xl outline-none focus:border-red-600 transition-all font-medium">
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-4 items-center">
                    <div>
                        <label class="block text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-1">Umur</label>
                        <input type="number" name="umur" required placeholder="20" class="w-full px-5 py-3 bg-gray-50 border rounded-xl outline-none focus:border-red-600 transition-all">
                    </div>
                    <div>
                        <label class="block text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-1">Jenis Kelamin</label>
                        <div class="flex gap-2">
                            <input type="radio" name="jenis_kelamin" id="L" value="Laki-laki" class="hidden" required>
                            <label for="L" class="gender-card flex-1 text-center py-3 border rounded-xl cursor-pointer text-sm font-bold text-gray-400 transition-all hover:bg-gray-50">Laki-laki</label>
                            
                            <input type="radio" name="jenis_kelamin" id="P" value="Perempuan" class="hidden">
                            <label for="P" class="gender-card flex-1 text-center py-3 border rounded-xl cursor-pointer text-sm font-bold text-gray-400 transition-all hover:bg-gray-50">Perempuan</label>
                        </div>
                    </div>
                </div>

                <div>
                    <label class="block text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-1">Program Studi / Jurusan</label>
                    <input type="text" name="asal_prodi" required placeholder="Contoh: S1 Sistem Informasi" class="w-full px-5 py-3 bg-gray-50 border rounded-xl outline-none focus:border-red-600 transition-all">
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-1">Divisi Utama</label>
                        <select name="pilihan_divisi_1" required class="w-full px-5 py-3 bg-gray-50 border rounded-xl outline-none focus:border-red-600 transition-all">
                            <option value="">Pilih Divisi Utama</option>
                            @if(isset($kegiatan->divisi) && $kegiatan->divisi->count() > 0)
                                @foreach($kegiatan->divisi as $div)
                                    <option value="{{ $div->nama_divisi }}">{{ $div->nama_divisi }}</option>
                                @endforeach
                            @else
                                <option value="Umum">Umum / Semua Divisi</option>
                            @endif
                        </select>
                    </div>
                    <div>
                        <label class="block text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-1">Divisi Cadangan</label>
                        <select name="pilihan_divisi_2" required class="w-full px-5 py-3 bg-gray-50 border rounded-xl outline-none focus:border-red-600 transition-all">
                            <option value="">Pilih Divisi Cadangan</option>
                            @if(isset($kegiatan->divisi) && $kegiatan->divisi->count() > 0)
                                @foreach($kegiatan->divisi as $div)
                                    <option value="{{ $div->nama_divisi }}">{{ $div->nama_divisi }}</option>
                                @endforeach
                            @else
                                <option value="Umum">Umum / Semua Divisi</option>
                            @endif
                        </select>
                    </div>
                </div>

                <div>
                    <label class="block text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-1">Link Portofolio</label>
                    <input type="url" name="portofolio" placeholder="https://..." class="w-full px-5 py-3 bg-gray-50 border rounded-xl outline-none focus:border-red-600 transition-all mb-3">
                    
                    <label class="block text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-1">Deskripsi / Alasan Bergabung</label>
                    <textarea name="deskripsi" placeholder="Ceritakan motivasi dan kecocokan keahlian Anda..." class="w-full px-5 py-3 bg-gray-50 border rounded-xl outline-none focus:border-red-600 transition-all min-h-[90px]"></textarea>
                </div>
            </div>

<div id="step-2" class="hidden space-y-6 text-center">
    <div class="bg-red-50 p-6 rounded-3xl border border-red-100 italic font-bold text-red-700">
        BIAYA REGISTRASI: RP 50.000<br>
        <span class="text-[10px] text-red-500 tracking-widest uppercase font-mono">BCA: 12345678 | BNI: 87654321 A/N UPN MENGGURAI</span>
    </div>
    
    <div class="text-left">
        <label class="block text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-3">Metode Transfer Pembayaran</label>
        
        <div class="grid grid-cols-2 gap-4">
            <div>
                <input type="radio" name="metode_pembayaran" id="BCA" value="transfer bca" class="hidden" checked required>
                <label for="BCA" class="method-card block p-4 bg-white border border-gray-200 rounded-2xl cursor-pointer hover:bg-gray-50 transition-all text-center">
                    <span class="block text-sm font-extrabold text-blue-800 tracking-wider">⚡ BANK BCA</span>
                    <span class="block text-[9px] font-semibold text-gray-400 mt-1 uppercase">Transfer Bank BCA</span>
                </label>
            </div>
            
            <div>
                <input type="radio" name="metode_pembayaran" id="BNI" value="bni" class="hidden">
                <label for="BNI" class="method-card block p-4 bg-white border border-gray-200 rounded-2xl cursor-pointer hover:bg-gray-50 transition-all text-center">
                    <span class="block text-sm font-extrabold text-orange-600 tracking-wider">🏦 BANK BNI</span>
                    <span class="block text-[9px] font-semibold text-gray-400 mt-1 uppercase">Transfer Bank BNI</span>
                </label>
            </div>
        </div>
    </div>

    <div class="border-2 border-dashed border-gray-200 rounded-[2rem] p-12 relative hover:border-red-400 transition-all group bg-gray-50/50">
        <input type="file" name="bukti_pembayaran" id="bukti_pembayaran" class="absolute inset-0 opacity-0 cursor-pointer" onchange="document.getElementById('file-name').innerText = 'File: ' + this.files[0].name">
        <p id="file-name" class="text-gray-400 font-bold text-[10px] uppercase tracking-[0.2em] group-hover:text-red-600 transition-all">Upload Bukti Transfer</p>
    </div>
</div>

            <div id="step-3" class="hidden text-center space-y-6">
                <div class="w-16 h-16 bg-green-50 text-green-600 rounded-full flex items-center justify-center mx-auto">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                </div>
                <h2 class="text-lg font-extrabold italic">Konfirmasi Akhir Berkas</h2>
                <div class="bg-gray-50 p-6 rounded-2xl text-left text-[11px] text-gray-400 border border-gray-100 uppercase font-semibold leading-relaxed">
                    1. Saya bersedia mengikuti rangkaian acara secara bertanggung jawab.<br>
                    2. Seluruh data identitas & berkas administrasi yang diisi adalah valid.
                </div>
                <label class="flex items-center gap-4 p-5 bg-gray-50 rounded-2xl cursor-pointer border hover:border-red-600/20 transition-all">
                    <input type="checkbox" name="persetujuan" id="persetujuan" required class="w-6 h-6 accent-red-600 rounded-lg">
                    <span class="text-[10px] font-bold text-gray-400 uppercase text-left leading-tight">Saya menyetujui syarat & ketentuan pendaftaran di atas.</span>
                </label>
            </div>

            <div class="flex justify-between items-center mt-12">
                <button type="button" id="prevBtn" onclick="move(-1)" class="hidden text-gray-400 font-bold text-xs uppercase hover:text-red-600 transition-all">Kembali</button>
                <div class="flex-1"></div>
                <button type="button" id="nextBtn" onclick="move(1)" class="bg-red-600 text-white px-12 py-4 rounded-2xl font-bold text-xs uppercase tracking-[0.2em] shadow-2xl shadow-red-200 hover:bg-red-800 transition-all active:scale-95">Lanjut</button>
            </div>
        </form>
    </div>

    <script>
        let step = 1;
        const form = document.getElementById('formRelawan');

        function move(n) {
            // Validasi Input sebelum pindah ke step berikutnya
            if (n === 1) {
                const currentStepDiv = document.getElementById(`step-${step}`);
                const requiredInputs = currentStepDiv.querySelectorAll("input[required], select[required], textarea[required]");
                
                let allFilled = true;
                requiredInputs.forEach(input => { 
                    if (!input.value) {
                        allFilled = false;
                        input.classList.add('border-red-500'); // beri tanda merah jika kosong
                    } else {
                        input.classList.remove('border-red-500');
                    }
                });

                // Validasi Radio Gender Khusus Step 1
                const isRadioValid = step !== 1 || document.querySelector('input[name="jenis_kelamin"]:checked');
                
                // Validasi Bukti Pembayaran Khusus Step 2
                const isFileValid = step !== 2 || document.getElementById('bukti_pembayaran').files.length > 0;

                if (!allFilled || !isRadioValid || !isFileValid) { 
                    alert("Harap lengkapi seluruh data wajib berkas pada langkah ini!"); 
                    return false; 
                }
            }

            // JIKA SUDAH DI STEP 3 DAN KLIK LANJUT -> SUBMIT FORM LANGSUNG
            if (step === 3 && n === 1) {
                const persetujuan = document.getElementById('persetujuan');
                if(persetujuan.checked) {
                    form.submit();
                    return true;
                } else {
                    alert("Anda harus menyetujui syarat dan ketentuan!");
                    return false;
                }
            }

            // Ganti Step Visual
            document.getElementById(`step-${step}`).classList.add("hidden");
            step += n;
            document.getElementById(`step-${step}`).classList.remove("hidden");
            
            // Atur Visibilitas Tombol Kembali & Teks Tombol Lanjut
            document.getElementById("prevBtn").classList.toggle("hidden", step === 1);
            document.getElementById("nextBtn").innerText = step === 3 ? "Kirim Sekarang" : "Lanjut";
            
            // Update Indikator Progress Dot
            for(let i=1; i<=3; i++) {
                document.getElementById(`dot-${i}`).className = i <= step 
                    ? "w-10 h-2 rounded-full bg-red-600 transition-all duration-300" 
                    : "w-6 h-2 rounded-full bg-gray-200 transition-all duration-300";
            }
        }
    </script>
</body>
</html>