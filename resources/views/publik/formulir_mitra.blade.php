<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulir Kemitraan - UPN Mengajar</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Plus+Jakarta+Sans:wght@600;700;800&display=swap" rel="stylesheet">
    
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        "primary": "#bb0016",
                        "primary-hover": "#990012",
                    },
                    fontFamily: { 
                        sans: ["Inter", "sans-serif"],
                        headline: ["Plus Jakarta Sans", "sans-serif"] 
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-slate-50 text-slate-800 font-sans antialiased min-h-screen flex items-center justify-center p-4 md:p-8">

    <div class="w-full max-w-2xl bg-white rounded-[24px] shadow-xl border border-slate-100 overflow-hidden my-6">
        <div class="bg-primary p-8 md:p-10 text-white relative">
            <div class="absolute top-6 right-8 text-xs font-headline font-bold opacity-30 uppercase tracking-widest">UPN MENGAJAR</div>
            <h1 class="font-headline font-extrabold text-2xl md:text-3xl tracking-tight">Formulir Pengajuan Mitra</h1>
            <p class="text-red-100 text-sm mt-2 font-medium leading-relaxed">Jalin kolaborasi bersama kami untuk membangun harapan pendidikan masa depan yang lebih cerah.</p>
        </div>

        <form action="/formulir-mitra" method="POST" class="p-8 md:p-10 space-y-6">
            @csrf

            @if(session('sukses'))
                <div class="bg-emerald-50 border border-emerald-200 text-emerald-800 p-4 rounded-2xl text-sm font-medium flex items-start gap-3 shadow-sm">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-emerald-600 shrink-0 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <span>{{ session('sukses') }}</span>
                </div>
            @endif

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="flex flex-col gap-2">
                    <label class="text-xs font-bold text-slate-500 uppercase tracking-wider font-headline">Nama Instansi / Lembaga</label>
                    <input type="text" name="nama_instansi" required placeholder="Contoh: Yayasan Pendidikan A" 
                           class="w-full px-4 py-3.5 rounded-xl border border-slate-200 text-sm focus:outline-none focus:border-primary focus:ring-2 focus:ring-red-100 transition-all bg-slate-50/50 font-medium placeholder:text-slate-400">
                </div>

                <div class="flex flex-col gap-2">
                    <label class="text-xs font-bold text-slate-500 uppercase tracking-wider font-headline">Nama Penanggung Jawab</label>
                    <input type="text" name="nama_penanggung_jawab" required placeholder="Contoh: Budi Santoso, S.Pd." 
                           class="w-full px-4 py-3.5 rounded-xl border border-slate-200 text-sm focus:outline-none focus:border-primary focus:ring-2 focus:ring-red-100 transition-all bg-slate-50/50 font-medium placeholder:text-slate-400">
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="flex flex-col gap-2">
                    <label class="text-xs font-bold text-slate-500 uppercase tracking-wider font-headline">Email Resmi</label>
                    <input type="email" name="email_instansi" required placeholder="Contoh: kontak@instansi.com" 
                           class="w-full px-4 py-3.5 rounded-xl border border-slate-200 text-sm focus:outline-none focus:border-primary focus:ring-2 focus:ring-red-100 transition-all bg-slate-50/50 font-medium placeholder:text-slate-400">
                </div>

                <div class="flex flex-col gap-2">
                    <label class="text-xs font-bold text-slate-500 uppercase tracking-wider font-headline">No. HP / WhatsApp Aktif</label>
                    <input type="text" name="no_hp" required placeholder="Contoh: 081234567xxx" 
                           class="w-full px-4 py-3.5 rounded-xl border border-slate-200 text-sm focus:outline-none focus:border-primary focus:ring-2 focus:ring-red-100 transition-all bg-slate-50/50 font-medium placeholder:text-slate-400">
                </div>
            </div>

            <div class="flex flex-col gap-2">
                <label class="text-xs font-bold text-slate-500 uppercase tracking-wider font-headline">Bentuk Kolaborasi / Kemitraan</label>
                <div class="relative">
                    <select name="jenis_kemitraan" required 
                            class="w-full px-4 py-3.5 rounded-xl border border-slate-200 text-sm focus:outline-none focus:border-primary focus:ring-2 focus:ring-red-100 transition-all bg-slate-50/50 font-medium appearance-none text-slate-700">
                        <option value="" disabled selected class="text-slate-400">-- Pilih Bentuk Kemitraan --</option>
                        <option value="Sponsorship / Pendanaan">Sponsorship / Pendanaan</option>
                        <option value="Penyediaan Lokasi Mengajar">Penyediaan Lokasi / Sekolah Mitra</option>
                        <option value="Media Partner">Media Partner</option>
                        <option value="Kolaborasi Program Kerja">Kolaborasi Program Kerja / Event</option>
                    </select>
                    <div class="absolute inset-y-0 right-0 flex items-center pr-4 pointer-events-none text-slate-400">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                    </div>
                </div>
            </div>

            <div class="flex flex-col gap-2">
                <label class="text-xs font-bold text-slate-500 uppercase tracking-wider font-headline">Rencana / Pesan Tambahan</label>
                <textarea name="pesan_kolaborasi" rows="4" placeholder="Jelaskan secara singkat rencana atau harapan kolaborasi Anda..." 
                          class="w-full px-4 py-3.5 rounded-xl border border-slate-200 text-sm focus:outline-none focus:border-primary focus:ring-2 focus:ring-red-100 transition-all bg-slate-50/50 resize-none font-medium placeholder:text-slate-400"></textarea>
            </div>

            <div class="flex items-center justify-between gap-4 pt-6 border-t border-slate-100">
                <a href="/" class="text-sm font-semibold text-slate-400 hover:text-primary transition-colors flex items-center gap-2 group">
                    <svg class="w-4 h-4 transform group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    Kembali ke Beranda
                </a>
                <button type="submit" class="bg-primary hover:bg-primary-hover text-white px-8 py-3.5 rounded-xl text-sm font-bold shadow-lg shadow-red-100 hover:shadow-red-200 transition-all transform active:scale-[0.98]">
                    Kirim Pengajuan
                </button>
            </div>
        </form>
    </div>

</body>
</html>