<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Status Pendaftaran | UPN Mengajar</title>
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.tailwindcss.com"></script>
    
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; background-color: #ffffff; }
        .gradient-text { background: linear-gradient(90deg, #bb0016, #ff4d4d); -webkit-background-clip: text; -webkit-text-fill-color: transparent; }
    </style>
</head>
<body class="min-h-screen flex items-center justify-center p-6">
    <div class="max-w-md w-full text-center">
        <div class="mb-8">
            <div class="w-20 h-20 bg-red-50 rounded-full flex items-center justify-center mx-auto">
                <svg class="w-10 h-10 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path>
                </svg>
            </div>
        </div>

        <h1 class="text-3xl font-extrabold text-gray-900 mb-4">
            Terima Kasih, <br>
            <span class="gradient-text">{{ $nama_depan }}!</span>
        </h1>
        
        <p class="text-gray-500 text-sm leading-relaxed mb-6 px-4">
            Pendaftaranmu untuk <span class="font-bold text-gray-800">{{ $data->nama_kegiatan ?? 'UPN Mengajar' }}</span> telah berhasil kami terima.
        </p>

        <div class="mb-10">
            @if($status === 'pending' || $status === 'menunggu')
                <span class="px-4 py-2 rounded-full bg-yellow-50 text-yellow-600 text-[10px] font-black uppercase tracking-widest border border-yellow-100">
                    Status: Menunggu Verifikasi
                </span>
            @elseif($status === 'diterima' || $status === 'lolos')
                <span class="px-4 py-2 rounded-full bg-green-50 text-green-600 text-[10px] font-black uppercase tracking-widest border border-green-100">
                    Status: Selamat! Kamu Diterima
                </span>
            @else
                <span class="px-4 py-2 rounded-full bg-red-50 text-red-600 text-[10px] font-black uppercase tracking-widest border border-red-100">
                    Status: Mohon Maaf, Belum Lolos
                </span>
            @endif
        </div>

        <div class="bg-gray-50 rounded-[2.5rem] p-8 border border-gray-100 mb-8 shadow-sm">
            <h3 class="text-gray-800 font-bold mb-3 text-lg">Gabung Grup Koordinasi</h3>
            <p class="text-[11px] text-gray-400 leading-relaxed mb-6 italic">
                "Wajib bagi seluruh calon anggota untuk bergabung ke grup koordinasi WhatsApp untuk informasi alur seleksi selanjutnya."
            </p>
            
            <a href="https://chat.whatsapp.com/GANTI_DENGAN_LINK_GRUP_KAMU" target="_blank" class="flex items-center justify-center gap-3 w-full py-4 bg-green-500 hover:bg-green-600 text-white rounded-2xl font-bold text-xs uppercase tracking-widest transition-all shadow-lg shadow-green-100 active:scale-95">
                Masuk Grup WhatsApp
            </a>
        </div>

        <div>
            <a href="/beranda" class="inline-block text-[10px] font-bold text-gray-400 hover:text-red-600 uppercase tracking-[0.2em] transition-all">
                Kembali ke Beranda
            </a>
        </div>
    </div>
</body>
</html>