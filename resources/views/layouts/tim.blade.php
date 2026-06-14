<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tim UPN Mengajar</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        poppins: ['Poppins', 'sans-serif'],
                    }
                }
            }
        }
    </script>
</head>
<body class="font-poppins bg-[#fafafa] overflow-x-hidden">
    
<header id="main-nav" class="fixed top-0 left-0 w-full text-white z-[9999] transition-all duration-300">
    <div class="flex items-center justify-between px-6 py-0.5 text-white">
        
        <div class="flex items-center">
            <a href="{{ url('/') }}" class="overflow-hidden">
                <img src="{{ asset('foto/logo.jpeg') }}" alt="Logo UPN Mengajar" class="w-16 scale-125">
            </a>
        </div>

        <div class="flex items-center gap-12">
            <nav>
                <ul class="flex gap-12 font-poppins font-semibold items-center">
                    <li>
                        <a href="{{ url('/') }}" class="relative {{ request()->is('/') ? 'after:w-full' : 'after:w-0' }} after:absolute after:left-0 after:-bottom-1 after:h-[1.5px] after:bg-white after:transition-all after:duration-300 hover:after:w-full">
                            Home
                        </a>
                    </li>
                    
                    <li class="relative group">
                        <a href="#" class="flex items-center gap-1 relative after:absolute after:left-0 after:-bottom-1 after:h-[1.5px] after:w-full after:bg-white after:transition-all after:duration-300">
                            Tentang
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 transition-transform duration-200 group-hover:rotate-180" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                            </svg>
                        </a>
                        <ul class="absolute left-0 mt-3 w-max bg-white text-gray-600 text-sm shadow-md opacity-0 invisible -translate-y-2 group-hover:opacity-100 group-hover:visible group-hover:translate-y-0 transition-all duration-300 ease-out rounded-lg overflow-hidden">
                            <li><a href="{{ url('/ukm') }}" class="block px-5 py-2 hover:bg-gray-100">UKM Penalaran dan Kreativitas</a></li>
                            <li><a href="{{ url('/upnmengajar') }}" class="block px-5 py-2 hover:bg-gray-100">Program Kerja UPN Mengajar</a></li>
                            <li><a href="{{ url('/tim') }}" class="block px-5 py-2 bg-red-5 hover:bg-red-100">Tim UPN Mengajar</a></li>
                        </ul>
                    </li>

                    <li>
                        <a href="{{ url('/kegiatan') }}" class="relative {{ request()->is('kegiatan*') ? 'after:w-full' : 'after:w-0' }} after:absolute after:left-0 after:-bottom-1 after:h-[1.5px] after:bg-white after:transition-all after:duration-300 hover:after:w-full">
                            Kegiatan
                        </a>
                    </li>
                    
                    <li>
                        <a href="{{ url('/relawan') }}" class="relative {{ request()->is('relawan*') ? 'after:w-full' : 'after:w-0' }} after:absolute after:left-0 after:-bottom-1 after:h-[1.5px] after:bg-white after:transition-all after:duration-300 hover:after:w-full">
                            Dokumentasi
                        </a>
                    </li>

                    @if(session('role') === 'admin')
                    <li>
                        <a href="{{ route('admin.dashboard') }}" class="relative after:absolute after:left-0 after:-bottom-1 after:h-[1.5px] after:w-0 after:bg-white after:transition-all after:duration-300 hover:after:w-full">
                            Dashboard Admin
                        </a>
                    </li>
                    @endif
                </ul>
            </nav>
            
            <div class="relative group">
                @if (session('id_user'))
                    <a href="{{ route('logout') }}" class="hover:text-red-400 transition-all duration-300 flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                        </svg>
                    </a>
                    <div class="absolute -bottom-12 left-1/2 -translate-x-1/2 bg-black/80 backdrop-blur-sm text-white text-[11px] px-4 py-2 opacity-0 group-hover:opacity-100 transition-all duration-300 whitespace-nowrap rounded-lg shadow-2xl border border-white/10">
                        Keluar
                    </div>
                @else
                    <a href="{{ url('/login') }}" class="hover:text-gray-300 transition-all duration-300 flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A9 9 0 1118.879 17.804M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                    </a>
                    <div class="absolute -bottom-12 left-1/2 -translate-x-1/2 bg-black/80 backdrop-blur-sm text-white text-[11px] px-4 py-2 opacity-0 group-hover:opacity-100 transition-all duration-300 whitespace-nowrap rounded-lg shadow-2xl border border-white/10">
                        Masuk / Daftar
                    </div>
                @endif
            </div>

        </div>
    </div>
</header>

<div class="h-24"></div>

<main class="bg-gradient-to-b from-white via-red-50/30 to-white">

    <section class="relative overflow-hidden bg-white">
        <div class="absolute top-0 right-0 w-[45%] h-full bg-gradient-to-br from-[#8B1E1E] to-[#B22222] rounded-bl-[180px]"></div>

        <div class="max-w-7xl mx-auto px-6 py-20 relative z-10">
            <div class="flex justify-between items-center gap-10">
                
                <div class="w-[45%]">
                    <span class="inline-flex items-center px-4 py-2 rounded-full bg-red-100 text-[#8B1E1E] text-sm font-semibold">
                        TIM UPN MENGAJAR
                    </span>

                    <h1 class="mt-6 text-6xl font-extrabold leading-none">
                        TIM UPN
                        <span class="block text-[#8B1E1E] mt-2">MENGAJAR</span>
                    </h1>

                    <p class="mt-8 text-gray-600 text-lg leading-relaxed max-w-xl">
                        Program UPN Mengajar dikelola oleh Bidang Pendidikan Sosial
                        (Diksos) UKM Penalaran dan Kreativitas UPN Veteran Jawa Timur.
                        Kami berperan dalam merancang dan mengoordinasikan kegiatan
                        together dengan relawan mahasiswa yang terlibat.
                    </p>

                    <div class="mt-8 flex items-center gap-3">
                        <span class="text-sm font-bold uppercase tracking-wider text-gray-700">
                            Kenali Tim Kami
                        </span>
                        <div class="h-[2px] w-14 bg-[#8B1E1E]"></div>
                    </div>
                </div>

                <div class="relative">
                    <div class="absolute -top-10 -right-10 w-40 h-40 border border-white/30 rounded-full"></div>
                    <div class="relative">
                        <div class="bg-white p-3 rounded-[30px] shadow-2xl">
                            <img src="{{ asset('foto/Foto Lengkap Diksos.jpg') }}" alt="Tim UPN Mengajar" class="w-full h-[420px] object-cover rounded-[24px]">
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <section id="bph" class="max-w-7xl mx-auto px-6 py-20">
        <div class="text-center mb-16">
            <h2 class="text-4xl font-bold text-[#8B1E1E] uppercase">BPH Bidang Diksos</h2>
            <div class="flex items-center justify-center gap-3 mt-3">
                <span class="w-10 h-[2px] bg-yellow-500"></span>
                <span class="w-20 h-[3px] bg-[#8B1E1E]"></span>
                <span class="w-10 h-[2px] bg-yellow-500"></span>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 max-w-6xl mx-auto">
            @foreach($bph_teams as $team)
                <div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-8 pb-14 flex flex-col items-center text-center relative overflow-hidden transition-all duration-300 hover:shadow-2xl hover:-translate-y-2 hover:scale-105">
                    
                    @php
                        $namaFileBph = basename($team->foto);
                        
                        if ($team->foto && file_exists(public_path('foto_tim/' . $namaFileBph))) {
                            $srcFotoBph = asset('foto_tim/' . $namaFileBph);
                        } elseif ($team->foto && file_exists(public_path('foto/' . $namaFileBph))) {
                            $srcFotoBph = asset('foto/' . $namaFileBph);
                        } else {
                            $srcFotoBph = 'https://ui-avatars.com/api/?name=' . urlencode($team->nama) . '&background=8B1E1E&color=fff&size=256';
                        }
                    @endphp

                    <img src="{{ $srcFotoBph }}" 
                         alt="{{ $team->nama }}" 
                         class="w-64 h-64 rounded-2xl object-cover object-center border-4 border-gray-100 shadow-md bg-gray-100 mx-auto"
                         onerror="this.onerror=null; this.src='https://ui-avatars.com/api/?name={{ urlencode($team->nama) }}&background=8B1E1E&color=fff&size=256';">
                    
                    <div class="mt-6 flex flex-col justify-center">
                        <h3 class="font-bold text-xl text-gray-800 px-2 line-clamp-2 min-h-[3.5rem] flex items-center justify-center">
                            {{ $team->nama }}
                        </h3>
                        <p class="mt-1 text-[#8B1E1E] text-sm font-semibold uppercase tracking-wider">
                            {{ ltrim($team->jabatan, '.') }}
                        </p>
                    </div>
                    
                    <div class="absolute bottom-0 left-0 w-full h-[5px] bg-[#8B1E1E]"></div>
                </div>
            @endforeach
        </div>
    </section>

    <section class="max-w-7xl mx-auto px-6 py-8">
        <div class="text-center mb-16">
            <h2 class="text-4xl font-bold text-[#8B1E1E] uppercase">Staf Ahli</h2>
            <div class="w-16 h-1 bg-[#8B1E1E] mx-auto mt-3"></div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-6 items-stretch">
            @foreach($staf_teams as $staf)
                <div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-6 pb-12 flex flex-col items-center text-center justify-between min-h-[320px] relative overflow-hidden transition-all duration-300 hover:shadow-2xl hover:-translate-y-2 hover:scale-105">
                    
                    @php
                        $namaFileStaf = basename($staf->foto);

                        if ($staf->foto && file_exists(public_path('foto_tim/' . $namaFileStaf))) {
                            $urlFoto = asset('foto_tim/' . $namaFileStaf);
                        } elseif ($staf->foto && file_exists(public_path('foto/' . $namaFileStaf))) {
                            $urlFoto = asset('foto/' . $namaFileStaf);
                        } else {
                            $urlFoto = 'https://ui-avatars.com/api/?name=' . urlencode($staf->nama) . '&background=8B1E1E&color=fff&size=256';
                        }
                    @endphp
                    
                    <img src="{{ $urlFoto }}" 
                         alt="{{ $staf->nama }}" 
                         class="w-36 h-36 rounded-2xl object-cover object-center border-4 border-gray-100 shadow-md bg-gray-100 mx-auto mt-2"
                         onerror="this.onerror=null; this.src='https://ui-avatars.com/api/?name={{ urlencode($staf->nama) }}&background=8B1E1E&color=fff&size=256';">
                    
                    <div class="mt-4 flex-grow flex flex-col justify-center w-full">
                        <h3 class="font-bold text-lg text-gray-800 line-clamp-2 px-1 min-h-[3rem] flex items-center justify-center">
                            {{ $staf->nama }}
                        </h3>
                        <p class="text-[#8B1E1E] text-sm font-medium mt-1">
                            {{ ltrim($staf->jabatan, '.') }}
                        </p>
                    </div>
                    
                    <div class="absolute bottom-0 left-0 w-full h-1.5 bg-[#8B1E1E]"></div>
                </div>
            @endforeach
        </div>
    </section>

</main>

<footer class="bg-[#8B1E1E] text-white pt-16">
    <div class="max-w-7xl mx-auto px-6 md:px-20 grid md:grid-cols-3 gap-10 pb-10">
        <div class="md:border-r md:border-red-300 md:pr-10">
            <div class="w-24 h-24 overflow-hidden mb-5">
                <img src="{{ asset('foto/logo.jpeg') }}" class="w-full h-full object-cover scale-150">
            </div>
            <h4 class="font-semibold mb-3 text-lg">Menu</h4>
            <ul class="space-y-2 text-sm">
                <li><a href="{{ url('/') }}" class="hover:underline">Home</a></li>
                <li><a href="#" class="hover:underline">Tentang</a></li>
                <li><a href="{{ url('/kegiatan') }}" class="hover:underline">Kegiatan</a></li>
                <li><a href="{{ url('/relawan') }}" class="hover:underline">Dokumentasi</a></li>
            </ul>
        </div>

        <div class="text-center md:border-r md:border-red-300 md:px-10">
            <h4 class="font-semibold mb-2 text-lg">Send Message</h4>
            <p class="text-xs text-gray-200 mb-4">Pesan akan dikirim ke email UPN Mengajar</p>
            <form action="mailto:upnmengajar.jt@gmail.com" method="post" enctype="text/plain" class="space-y-3">
                <input type="text" name="nama" placeholder="Nama" class="w-full px-3 py-2 rounded text-black text-sm">
                <input type="email" name="email" placeholder="Email" class="w-full px-3 py-2 rounded text-black text-sm">
                <textarea name="pesan" placeholder="Pesan" rows="3" class="w-full px-3 py-2 rounded text-black text-sm"></textarea>
                <div class="text-left">
                    <button type="submit" class="bg-white text-[#8B1E1E] px-5 py-2 rounded text-sm font-semibold hover:bg-gray-200 transition">
                        Kirim
                    </button>
                </div>
            </form>
        </div>

        <div class="md:pl-10">
            <h4 class="font-semibold mb-4 text-lg">Contact Us</h4>
            <div class="space-y-3 text-sm">
                <div class="flex items-center gap-2">
                    <img src="{{ asset('foto/Untitled design (17).png') }}" class="w-5 h-6" alt="" onerror="this.src='https://cdn-icons-png.flaticon.com/512/732/732200.png'">
                    <a href="mailto:upnmengajar.jt@gmail.com" class="hover:underline">upnmengajar.jt@gmail.com</a>
                </div>
                <div class="flex items-center gap-2">
                    <img src="{{ asset('foto/instagram.png') }}" class="w-5 h-6" alt="" onerror="this.src='https://cdn-icons-png.flaticon.com/512/2111/2111463.png'">
                    <a href="https://instagram.com/upnmengajar.jt" class="hover:underline">@upnmengajar.jt</a>
                </div>
                <div class="flex items-center gap-2">
                    <img src="{{ asset('foto/whatsapp.png') }}" class="w-5 h-6" alt="" onerror="this.src='https://cdn-icons-png.flaticon.com/512/733/733585.png'">
                    <a href="https://wa.me/6289699808453" class="hover:underline">089699808453 (Nabila)</a>
                </div>
            </div>
            <div class="mt-8 text-sm text-gray-200 leading-relaxed">
                <p class="font-semibold mb-1">Sekretariat Kami Berada di:</p>
                <p>Universitas Pembangunan Nasional "Veteran" Jawa Timur<br>Jl. Raya Rungkut Madya, Gunung Anyar, Surabaya, Jawa Timur</p>
            </div>
        </div>
    </div>

    <div class="bg-[#6e1515] px-6 md:px-20 py-4 flex flex-col md:flex-row justify-between text-sm text-gray-200">
        <p>© 2026 UPN Mengajar — UKM Penalaran & Kreativitas UPN "Veteran" Jawa Timur</p>
        <p>Website by <span class="font-semibold">Vina • Naila • Inez Sistem informasi UPNVJT 2024</span></p>
    </div>
</footer>

<script>
const nav = document.getElementById("main-nav");

function ubahNav() {
    if (window.scrollY > 50) {
        nav.classList.add("bg-red-900", "shadow-lg");
    } else {
        nav.classList.add("bg-red-900");
        nav.classList.remove("shadow-lg");
    }
}

window.addEventListener("scroll", ubahNav);
window.addEventListener("DOMContentLoaded", ubahNav);
</script>
</body>
</html>