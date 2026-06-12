<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Daftar Relawan - UPN Mengajar</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;600;700;800&family=Inter:wght@400;500;600&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        "primary": "#bb0016",
                        "surface": "#fcfcfc",
                        "on-surface": "#1a1c1c",
                        "on-surface-variant": "#6b7280",
                    },
                    fontFamily: { headline: ["Manrope"], body: ["Inter"] }
                }
            }
        }
    </script>
    <style>
        .material-symbols-outlined { font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24; }
        .custom-shadow { box-shadow: 0 25px 50px -12px rgba(187, 0, 22, 0.1); }
        .input-focus:focus { border-color: #bb0016; background-color: white; box-shadow: 0 0 0 4px rgba(187, 0, 22, 0.05); }
    </style>
</head>
<body class="bg-surface font-body text-on-surface min-h-screen flex items-center justify-center p-4 md:p-8">

    <a href="{{ url('/') }}" class="fixed top-6 left-6 z-50 hidden md:flex items-center gap-2 px-5 py-2.5 bg-white border border-gray-100 rounded-full text-xs font-bold text-gray-500 hover:text-primary transition-all shadow-sm group">
        <span class="material-symbols-outlined text-lg group-hover:-translate-x-1 transition-transform">arrow_back</span>
        KEMBALI KE BERANDA
    </a>

    <main class="w-full max-w-5xl relative z-10">
        <div class="grid grid-cols-1 lg:grid-cols-12 bg-white rounded-[2rem] md:rounded-[3rem] overflow-hidden custom-shadow border border-gray-50">
            
            <div class="hidden lg:flex lg:col-span-5 flex-col justify-end p-12 relative overflow-hidden bg-gray-400">
                <img src="{{ asset('foto/kegiatan3.jpg') }}" class="absolute inset-0 w-full h-full object-cover opacity-60" alt="Kegiatan">
                <div class="absolute inset-0 bg-gradient-to-t from-primary/90 via-black/40 to-transparent z-10"></div>

                <div class="relative z-20">
                    <h2 class="font-headline text-4xl font-extrabold text-white tracking-tight leading-tight mb-4">
                        Jadi Bagian <br/> Dari UPN Mengajar
                    </h2>
                    <p class="text-red-100 font-body leading-relaxed text-sm opacity-90">
                        Langkah kecilmu untuk dampak besar bagi pendidikan bangsa, daftar sekarang!
                    </p>
                </div>
            </div>

            <div class="lg:col-span-7 p-8 md:p-16 flex flex-col justify-center">
                <div class="mb-8">
                    <h1 class="font-headline text-3xl font-black text-on-surface tracking-tight mb-2">Pendaftaran</h1>
                    <p class="text-on-surface-variant text-sm">Buat akun relawan untuk mulai berkontribusi.</p>
                </div>

                @if ($errors->any())
                    <div class="mb-6 flex flex-col gap-1 p-4 rounded-2xl text-xs font-bold bg-red-50 text-red-700 border border-red-100">
                        @foreach ($errors->all() as $error)
                            <div class="flex items-center gap-3">
                                <span class="material-symbols-outlined text-lg">error</span>
                                <span>{{ $error }}</span>
                            </div>
                        @endforeach
                    </div>
                @endif

                <form action="{{ route('register.proses') }}" method="POST" class="space-y-4">
                    @csrf {{-- Token pengaman form di Laravel --}}

                    <div class="space-y-1">
                        <label class="text-[10px] font-black uppercase tracking-widest text-gray-400 ml-1">Nama Lengkap</label>
                        <div class="relative group">
                            <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-gray-400 text-lg group-focus-within:text-primary transition-colors">person</span>
                            <input type="text" name="nama_lengkap" required value="{{ old('nama_lengkap') }}"
                                class="w-full pl-12 pr-5 py-3.5 bg-gray-50 border border-gray-100 rounded-2xl text-sm outline-none transition-all input-focus" 
                                placeholder="Nama sesuai KTP">
                        </div>
                    </div>

                    <div class="space-y-1">
                        <label class="text-[10px] font-black uppercase tracking-widest text-gray-400 ml-1">Email Aktif</label>
                        <div class="relative group">
                            <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-gray-400 text-lg group-focus-within:text-primary transition-colors">mail</span>
                            <input type="email" name="email" required value="{{ old('email') }}"
                                class="w-full pl-12 pr-5 py-3.5 bg-gray-50 border border-gray-100 rounded-2xl text-sm outline-none transition-all input-focus" 
                                placeholder="nama@email.com">
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="space-y-1">
                            <label class="text-[10px] font-black uppercase tracking-widest text-gray-400 ml-1">Password</label>
                            <input type="password" name="password" required
                                class="w-full px-5 py-3.5 bg-gray-50 border border-gray-100 rounded-2xl text-sm outline-none transition-all input-focus" 
                                placeholder="••••••••">
                        </div>
                        <div class="space-y-1">
                            <label class="text-[10px] font-black uppercase tracking-widest text-gray-400 ml-1">Konfirmasi</label>
                            <input type="password" name="konfirmasi_password" required
                                class="w-full px-5 py-3.5 bg-gray-50 border border-gray-100 rounded-2xl text-sm outline-none transition-all input-focus" 
                                placeholder="••••••••">
                        </div>
                    </div>

                    <button type="submit" class="w-full bg-primary hover:bg-red-700 text-white font-headline font-bold py-4 rounded-2xl shadow-lg shadow-red-100 hover:shadow-red-200 active:scale-[0.99] transition-all flex items-center justify-center gap-2 mt-4 text-xs uppercase tracking-[0.2em]">
                        DAFTAR SEKARANG
                        <span class="material-symbols-outlined text-sm">arrow_forward</span>
                    </button>
                </form>

                <div class="mt-8 text-center">
                    <p class="text-xs text-on-surface-variant font-medium">
                        Sudah punya akun? <a href="{{ route('login') }}" class="text-primary font-bold hover:underline underline-offset-4">Log in</a>
                    </p>
                </div>
            </div>
        </div>
        
        <div class="text-center mt-10">
            <p class="text-[9px] uppercase tracking-[0.4em] font-black text-gray-300">
                UKM Penalaran & Kreativitas • UPN "Veteran" Jawa Timur
            </p>
        </div>
    </main>

</body>
</html>