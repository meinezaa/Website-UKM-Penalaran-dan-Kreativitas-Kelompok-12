<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Masuk - UPN Mengajar</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;600;700;800&family=Inter:wght@400;500;600&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
    <script id="tailwind-config">
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        "primary": "#bb0016",
                        "surface": "#f9f9f9",
                        "on-surface": "#1a1c1c",
                        "on-surface-variant": "#5d3f3c",
                    },
                    fontFamily: { headline: ["Manrope"], body: ["Inter"] }
                }
            }
        }
    </script>
    <style>
        .material-symbols-outlined { font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24; }
        .editorial-shadow { box-shadow: 0 12px 40px rgba(186, 26, 26, 0.08); }
    </style>
</head>
<body class="bg-surface font-body text-on-surface min-h-screen relative flex items-center justify-center py-12 px-4">

    <a href="{{ url('/') }}" class="fixed top-6 left-6 z-50 flex items-center gap-2 px-4 py-2 bg-white/90 backdrop-blur-sm border border-gray-200 rounded-full text-sm font-bold text-gray-700 hover:text-primary transition-all shadow-sm group">
        <span class="material-symbols-outlined text-lg group-hover:-translate-x-1 transition-transform">arrow_back</span>
        Beranda
    </a>

    <main class="w-full max-w-6xl">
        <div class="grid grid-cols-1 md:grid-cols-2 bg-white rounded-[2.5rem] overflow-hidden editorial-shadow border border-gray-100">
            
            <div class="hidden md:flex flex-col justify-between p-12 bg-gray-900 relative group" 
                 style="background-image: url('{{ asset('foto/foto3.jpg') }}'); background-size: cover; background-position: center;">
                
                <div class="absolute inset-0 bg-gradient-to-t from-primary/90 via-black/40 to-black/20 z-0"></div>

                <div class="relative z-10 mt-auto">
                    <h2 class="font-headline text-5xl font-extrabold text-white tracking-tight leading-tight mb-4">
                        Selamat <br/>
                        Datang Kembali.
                    </h2>
                    <p class="text-red-100 font-body leading-relaxed max-w-sm text-sm opacity-90">
                        Akses dashboard Anda untuk terus berbagi inspirasi dan mengelola kegiatan relawan di UPN Mengajar.
                    </p>
                </div>
            </div>

            <div class="p-10 md:p-16 flex flex-col justify-center">
                <div class="mb-10 text-center md:text-left">
                    <h1 class="font-headline text-4xl font-black text-on-surface tracking-tight">Login Relawan</h1>
                    <p class="text-on-surface-variant text-sm mt-3 leading-relaxed italic">"Ilmu adalah investasi terbaik untuk masa depan."</p>
                </div>

                @if ($errors->any())
                    <div class="mb-6 p-4 bg-red-50 text-red-700 border-red-600 border-l-4 text-xs font-bold rounded-r-lg flex items-center gap-3">
                        <span class="material-symbols-outlined text-lg">error</span>
                        <div>
                            @foreach ($errors->all() as $error)
                                <p>{{ $error }}</p>
                            @endforeach
                        </div>
                    </div>
                @endif

                <form action="{{ route('login') }}" method="POST" class="space-y-5">
                    @csrf {{-- Wajib di Laravel untuk keamanan token form --}}
                    
                    <div class="space-y-1.5">
                        <label class="text-[10px] font-bold uppercase tracking-widest text-on-surface-variant ml-1" for="email">Alamat Email</label>
                        <div class="relative group">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-gray-400 group-focus-within:text-primary transition-colors">
                                <span class="material-symbols-outlined text-lg">mail</span>
                            </div>
                            <input type="email" name="email" id="email" required 
                                value="{{ old('email') }}"
                                class="block w-full pl-12 pr-4 py-4 bg-gray-50 border border-gray-100 rounded-2xl focus:ring-4 focus:ring-primary/5 focus:border-primary focus:bg-white transition-all text-sm outline-none" 
                                placeholder="alamatemail@gmail.com">
                        </div>
                    </div>

                    <div class="space-y-1.5">
                        <div class="flex justify-between items-center px-1">
                            <label class="text-[10px] font-bold uppercase tracking-widest text-on-surface-variant" for="password">Kata Sandi</label>
                            <a href="#" class="text-[10px] font-bold text-primary hover:underline">Lupa Password?</a>
                        </div>
                        <div class="relative group">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-gray-400 group-focus-within:text-primary transition-colors">
                                <span class="material-symbols-outlined text-lg">key</span>
                            </div>
                            <input type="password" name="password" id="password" required
                                class="block w-full pl-12 pr-4 py-4 bg-gray-50 border border-gray-100 rounded-2xl focus:ring-4 focus:ring-primary/5 focus:border-primary focus:bg-white transition-all text-sm outline-none" 
                                placeholder="••••••••">
                        </div>
                    </div>

                    <div class="flex items-center px-1">
                        <label class="flex items-center gap-2 cursor-pointer group">
                            <input type="checkbox" name="remember" class="w-4 h-4 rounded border-gray-300 text-primary focus:ring-primary/20 transition-all" {{ old('remember') ? 'checked' : '' }}>
                            <span class="text-xs font-medium text-gray-500 group-hover:text-primary transition-colors">Ingat login saya</span>
                        </label>
                    </div>

                    <button type="submit" class="w-full bg-primary hover:bg-red-700 text-white font-headline font-bold py-4 rounded-2xl shadow-xl shadow-red-100 active:scale-[0.98] transition-all flex items-center justify-center gap-2 mt-2 text-sm uppercase tracking-widest">
                        Masuk Ke Akun
                        <span class="material-symbols-outlined text-lg">login</span>
                    </button>
                </form>

                <div class="mt-10 pt-8 border-t border-gray-50 text-center">
                    <p class="text-xs text-on-surface-variant font-medium">
                        Belum punya akun? <a href="{{ url('/register') }}" class="text-primary font-bold hover:underline">Daftar Akun</a>
                    </p>
                </div>
            </div>
        </div>
        
        <p class="text-center mt-8 text-[10px] uppercase tracking-[0.3em] font-bold text-gray-400">
            © UKM Penalaran & Kreativitas UPN "Veteran" Jawa Timur • 2026
        </p>
    </main>
</body>
</html>