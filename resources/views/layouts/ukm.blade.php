<!doctype html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Website UKM Penalaran</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Instrument+Serif:ital,wght@0,400;1,400&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('dist/output.css') }}">
</head>

<body class="font-[Poppins] bg-gray-50">

    <header class="fixed top-0 left-0 w-full z-50 transition-all duration-300">
        <div class="flex items-center justify-between px-6 py-0.5 text-white">

            <div class="flex items-center">
                <a href="{{ url('/') }}" class="overflow-hidden">
                    <img src="{{ asset('foto/logo.jpeg') }}" alt="Logo UPN Mengajar" class="w-16 scale-125">
                </a>
            </div>

            <div class="flex items-center gap-12">
                <nav>
                    <ul class="flex gap-12 font-poppins font-semibold">
                        <li>
                            <a href="{{ url('/') }}" class="relative after:absolute after:left-0 after:-bottom-1 after:h-[1.5px] {{ request()->is('/') ? 'after:w-full' : 'after:w-0' }} after:bg-white after:transition-all after:duration-300 hover:after:w-full">
                                Home
                            </a>
                        </li>

                        <li class="relative group">
                            <a href="javascript:void(0)" class="flex items-center gap-1 relative after:absolute after:left-0 after:-bottom-1 after:h-[1.5px] {{ request()->is('ukm') || request()->is('upnmengajar') || request()->is('tim') ? 'after:w-full' : 'after:w-0' }} after:bg-white after:transition-all after:duration-300 hover:after:w-full">
                                Tentang
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 transition-transform duration-200 group-hover:rotate-180" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                </svg>
                            </a>

                            <ul class="absolute left-0 mt-3 w-max bg-white text-gray-600 text-sm shadow-md opacity-0 invisible -translate-y-2 group-hover:opacity-100 group-hover:visible group-hover:translate-y-0 transition-all duration-300 ease-out z-50 rounded-b-md overflow-hidden">
                                <li>
                                    <a href="{{ url('/ukm') }}" class="block px-5 py-2.5 hover:bg-gray-100 hover:text-red-700 transition {{ request()->is('ukm') ? 'bg-gray-100 text-red-800 font-semibold' : '' }}">
                                        UKM Penalaran dan Kreativitas
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ url('/upnmengajar') }}" class="block px-5 py-2.5 hover:bg-gray-100 hover:text-red-700 transition {{ request()->is('upnmengajar') ? 'bg-gray-100 text-red-800 font-semibold' : '' }}">
                                        Program Kerja UPN Mengajar
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ url('/tim') }}" class="block px-5 py-2.5 hover:bg-gray-100 hover:text-red-700 transition {{ request()->is('tim') ? 'bg-gray-100 text-red-800 font-semibold' : '' }}">
                                        Tim UPN Mengajar
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <li>
                            <a href="{{ url('/kegiatan') }}" class="relative after:absolute after:left-0 after:-bottom-1 after:h-[1.5px] {{ request()->is('kegiatan*') ? 'after:w-full' : 'after:w-0' }} after:bg-white after:transition-all after:duration-300 hover:after:w-full">
                                Kegiatan
                            </a>
                        </li>

                        <li>
                            <a href="{{ url('/relawan') }}" class="relative after:absolute after:left-0 after:-bottom-1 after:h-[1.5px] {{ request()->is('relawan*') ? 'after:w-full' : 'after:w-0' }} after:bg-white after:transition-all after:duration-300 hover:after:w-full">
                                Relawan
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
                        <a href="#" class="hover:text-red-400 transition-all duration-300">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                            </svg>
                        </a>
                        <div class="absolute -bottom-12 left-1/2 -translate-x-1/2 bg-black/80 backdrop-blur-sm text-white text-[11px] px-4 py-2 opacity-0 group-hover:opacity-100 transition-all duration-300 whitespace-nowrap rounded-lg shadow-2xl border border-white/10">
                            Keluar
                        </div>
                    @else
                        <a href="{{ url('/login') }}" class="hover:text-gray-300 transition-all duration-300">
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

    <section class="w-full bg-gray-100 pt-0 pb-0">
        <div class="max-w-[20000px] mx-auto px-0">
            <img src="{{ asset('foto/heroukm.png') }}" alt="UKM PNK" class="w-full h-auto object-contain">
        </div>
    </section>

    <section class="min-h-screen flex items-center justify-center bg-white py-20">
        <div class="relative w-full max-w-6xl">
            <img src="{{ asset('foto/kegiatanukm1.JPG') }}" class="w-full h-[400px] md:h-[450px] object-cover grayscale shadow-lg">
            <div class="absolute inset-0 bg-black/50"></div>
            <div class="absolute inset-0 flex items-center justify-center text-center px-6">
                <div class="max-w-2xl">
                    <p class="text-xs tracking-widest text-white/80 mb-2">WELCOME TO OUR COMMUNITY</p>
                    <h1 class="text-2xl md:text-3xl font-semibold text-white leading-tight mb-3">
                        UKM Penalaran & Kreativitas <br> UPN Veteran Jawa Timur
                    </h1>
                    <p class="text-white/80 text-sm leading-relaxed mb-6">
                        UKM Penalaran dan Kreativitas merupakan wadah bagi mahasiswa untuk mengembangkan kemampuan berpikir kritis, inovatif, dan solutif melalui penelitian ilmiah and pengembangan ide kreatif. Kami berkomitmen menciptakan lingkungan kolaboratif yang mendorong mahasiswa untuk berkembang, berprestasi, dan memberikan dampak nyata bagi masyarakat.
                    </p>

                    <div class="flex justify-center gap-6 mt-4">
                        <a href="{{ $medsos['whatsapp'] ?? '#' }}" target="_blank" class="flex items-center justify-center w-10 h-10 rounded-full overflow-hidden bg-white/20 backdrop-blur-sm hover:scale-125 transition duration-300">
                            <img src="{{ asset('foto/icn-whatsapp.png') }}" class="w-full h-full object-cover">
                        </a>
                        <a href="mailto:{{ $medsos['email'] ?? '' }}" class="flex items-center justify-center w-10 h-10 rounded-full overflow-hidden bg-white/20 backdrop-blur-sm hover:scale-125 transition duration-300">
                            <img src="{{ asset('foto/icn-email.png') }}" class="w-full h-full object-cover">
                        </a>
                        <a href="{{ $medsos['instagram'] ?? '#' }}" target="_blank" class="flex items-center justify-center w-10 h-10 rounded-full overflow-hidden bg-white/20 backdrop-blur-sm hover:scale-125 transition duration-300">
                            <img src="{{ asset('foto/icn-instagram.png') }}" class="w-full h-full object-cover">
                        </a>
                        <a href="{{ $medsos['linkedin'] ?? '#' }}" target="_blank" class="flex items-center justify-center w-10 h-10 rounded-full overflow-hidden bg-white/20 backdrop-blur-sm hover:scale-125 transition duration-300">
                            <img src="{{ asset('foto/icn-linkedin.png') }}" class="w-full h-full object-cover">
                        </a>
                        <a href="{{ $medsos['tiktok'] ?? '#' }}" target="_blank" class="flex items-center justify-center w-10 h-10 rounded-full overflow-hidden bg-white/20 backdrop-blur-sm hover:scale-125 transition duration-300">
                            <img src="{{ asset('foto/icn-tiktok.png') }}" class="w-full h-full object-cover">
                        </a>
                        <a href="{{ $medsos['x'] ?? '#' }}" target="_blank" class="flex items-center justify-center w-10 h-10 rounded-full overflow-hidden bg-white/20 backdrop-blur-sm hover:scale-125 transition duration-300">
                            <img src="{{ asset('foto/icn-x.png') }}" class="w-full h-full object-cover">
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="py-20 bg-[#ffffff]">
        <div class="flex justify-center items-center group">
            <div class="puzzle puzzle-left">
                <div class="puzzle-content">
                    <h3 class="text-2xl font-bold mb-3">Visi</h3>
                    @foreach($visis as $visi)
                        <p class="mb-2">{{ $visi->content }}</p>
                    @endforeach
                </div>
            </div>
            <div class="puzzle puzzle-right">
                <div class="puzzle-content">
                    <h3 class="text-2xl font-bold mb-3">Misi</h3>
                    <ul class="list-disc ml-5 text-left">
                        @foreach($misis as $misi)
                            <li>{{ $misi->content }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <section class="py-20">
        <div class="max-w-4xl mx-auto px-6 text-center">
            <h2 class="text-3xl font-bold text-[#8B1E1E] mb-3">Badan Pengurus Harian</h2>
            <p id="roleTitle" class="text-lg text-gray-600 font-semibold mb-8">Ketua Umum</p>

            <div id="cardContainer" class="mb-4">
                <div class="card-role">
                    <div class="flex justify-center flex-wrap gap-6">
                        @foreach($bph_ketua as $k)
                        <div class="bg-gray-500 rounded-2xl shadow p-6 w-60 hover:shadow-xl transition">
                            <img src="{{ asset('foto/'.$k->photo) }}" class="rounded-full mx-auto mb-4 w-32 h-32 object-cover">
                            <h4>{{ $k->name }}</h4>
                            <p class="text-sm text-gray-500">{{ $k->major_year }}</p>
                        </div>
                        @endforeach
                    </div>
                </div>

                <div class="card-role hidden">
                    <div class="flex gap-6 justify-center flex-wrap">
                        @foreach($bph_sekre as $s)
                        <div class="bg-white rounded-2xl shadow p-6 w-60 hover:shadow-xl transition">
                            <img src="{{ asset('foto/'.$s->photo) }}" class="rounded-full mx-auto mb-4 w-32 h-32 object-cover">
                            <h4>{{ $s->name }}</h4>
                            <p class="text-sm text-gray-500">{{ $s->major_year }}</p>
                        </div>
                        @endforeach
                    </div>
                </div>

                <div class="card-role hidden">
                    <div class="flex gap-6 justify-center flex-wrap">
                        @foreach($bph_bendahara as $b)
                        <div class="bg-white rounded-2xl shadow p-6 w-60 hover:shadow-xl transition">
                            <img src="{{ asset('foto/'.$b->photo) }}" class="rounded-full mx-auto mb-4 w-32 h-32 object-cover">
                            <h4>{{ $b->name }}</h4>
                            <p class="text-sm text-gray-500">{{ $b->major_year }}</p>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <div class="flex justify-center gap-10 mt-6">
                <button onclick="prevSlide()" class="text-3xl text-[#8B1E1E] hover:scale-125 transition">←</button>
                <button onclick="nextSlide()" class="text-3xl text-[#8B1E1E] hover:scale-125 transition">→</button>
            </div>
        </div>
    </section>

    <section class="py-12 bg-gradient-to-b from-gray-50 via-white to-gray-50 relative overflow-hidden">
        <div class="absolute top-0 left-1/4 w-96 h-96 bg-red-500/5 rounded-full blur-3xl pointer-events-none"></div>
        <div class="absolute bottom-0 right-1/4 w-96 h-96 bg-red-500/5 rounded-full blur-3xl pointer-events-none"></div>

        <div class="max-w-6xl mx-auto px-6 relative z-10 text-center">
            <div class="inline-block px-3 py-1 bg-red-50 text-[#8B1E1E] text-xs font-semibold tracking-widest uppercase rounded-full mb-3 border border-red-100">
                Struktur Organisasi
            </div>
            <h2 class="text-4xl font-extrabold text-gray-900 tracking-tight mb-4">
                Bidang & <span class="text-[#8B1E1E]">Fokus Kerja</span>
            </h2>
            <p class="text-gray-500 mb-12 max-w-2xl mx-auto text-sm sm:text-base leading-relaxed">
                Mengenal pilar-pilar penggerak, rincian tugas komprehensif, serta implementasi program kerja utama di bawah naungan UKM Penalaran & Kreativitas.
            </p>

            <div class="grid md:grid-cols-3 gap-8 justify-center">
                @foreach($divisions as $idx => $division)
                <div class="group relative bg-white/80 backdrop-blur-md rounded-2xl p-6 border border-gray-100 shadow-sm hover:shadow-2xl hover:-translate-y-1.5 transition-all duration-300 text-left flex flex-col justify-between overflow-hidden">
                    <div class="absolute top-0 left-0 w-full h-[4px] bg-[#8B1E1E] group-hover:h-[6px] transition-all duration-300"></div>
                    <div class="absolute -top-10 -right-10 w-28 h-28 bg-[#8B1E1E]/5 rounded-full blur-xl group-hover:bg-[#8B1E1E]/10 transition-all duration-500"></div>
                    
                    <div class="relative z-10">
                        <h3 class="text-xl font-bold text-gray-800 mb-3 flex items-center gap-2">
                            <span class="p-1.5 bg-red-50 rounded-lg text-[#8B1E1E] text-sm font-normal">
                                {{ str_pad($idx + 1, 2, '0', STR_PAD_LEFT) }}
                            </span>
                            {{ $division->name }}
                        </h3>
                        <p class="text-gray-600 text-xs sm:text-sm leading-relaxed mb-6 font-light">
                            <span class="font-medium text-gray-800">Fokus Inti:</span> {{ $division->description }}
                        </p>
                    </div>

                    <div class="relative z-10 mt-auto">
                        <div class="bg-gradient-to-br from-gray-50 to-red-50/30 p-4 rounded-xl border border-dashed border-red-200 shadow-inner">
                            <span class="text-xs font-bold text-[#8B1E1E] block mb-2.5 uppercase tracking-wider flex items-center gap-1.5">
                                {{ $division->icon ?? '💡' }} Program Kerja
                            </span>
                            <ul class="text-xs text-gray-700 space-y-2">
                                @foreach($division->programs as $program)
                                <li class="flex items-start gap-2">
                                    <span class="text-[#8B1E1E] font-semibold">»</span>
                                    <span>{{ $program->name }}</span>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <footer class="bg-[#8B1E1E] text-white pt-16">
        <div class="max-w-7xl mx-auto px-6 md:px-20 grid md:grid-cols-3 gap-10 pb-10">
            <div class="md:border-r md:border-red-300 md:pr-10">
                <div class="w-24 h-24 overflow-hidden mb-5">
                    <img src="{{ asset('foto/logo.jpeg') }}" class="w-full h-full object-cover scale-150">
                </div>
                <h4 class="font-semibold mb-3 text-lg">Menu</h4>
                <ul class="space-y-2 text-sm">
                    <li><a href="{{ url('/') }}" class="hover:underline">Home</a></li>
                    <li><a href="{{ url('/ukm') }}" class="hover:underline">Tentang</a></li>
                    <li><a href="{{ url('/kegiatan') }}" class="hover:underline">Kegiatan</a></li>
                    <li><a href="{{ url('/relawan') }}" class="hover:underline">Relawan</a></li>
                </ul>
            </div>

            <div class="text-center md:border-r md:border-red-300 md:px-10">
                <h4 class="font-semibold mb-2 text-lg">Send Message</h4>
                <p class="text-xs text-gray-200 mb-4">Pesan akan dikirim ke email UPN Mengajar</p>
                <form action="mailto:{{ $medsos['email'] ?? 'upnmengajar.jt@gmail.com' }}" method="post" enctype="text/plain" class="space-y-3">
                    <input type="text" name="nama" placeholder="Nama" class="w-full px-3 py-2 rounded text-black text-sm">
                    <input type="email" name="email" placeholder="Email" class="w-full px-3 py-2 rounded text-black text-sm">
                    <textarea name="pesan" placeholder="Pesan" rows="3" class="w-full px-3 py-2 rounded text-black text-sm"></textarea>
                    <div class="text-left">
                        <button type="submit" class="bg-white text-[#8B1E1E] px-5 py-2 rounded text-sm font-semibold hover:bg-gray-200 transition">Kirim</button>
                    </div>
                </form>
            </div>

            <div class="md:pl-10">
                <h4 class="font-semibold mb-4 text-lg">Contact Us</h4>
                <div class="space-y-3 text-sm">
                    <div class="flex items-center gap-2">
                        <img src="{{ asset('foto/email.png') }}" class="w-5 h-6">
                        <a href="mailto:{{ $medsos['email'] ?? 'upnmengajar.jt@gmail.com' }}" class="hover:underline">{{ $medsos['email'] ?? 'upnmengajar.jt@gmail.com' }}</a>
                    </div>
                    <div class="flex items-center gap-2">
                        <img src="{{ asset('foto/instagram.png') }}" class="w-5 h-6">
                        <a href="{{ $medsos['instagram'] ?? 'https://instagram.com/upnmengajar.jt' }}" class="hover:underline">@upnmengajar.jt</a>
                    </div>
                    <div class="flex items-center gap-2">
                        <img src="{{ asset('foto/whatsapp.png') }}" class="w-5 h-6">
                        <a href="{{ $medsos['whatsapp'] ?? 'https://wa.me/6289699808453' }}" class="hover:underline">089699808453 (Nabila)</a>
                    </div>
                </div>
                <div class="mt-8 text-sm text-gray-200 leading-relaxed">
                    <p class="font-semibold mb-1">Sekretariat Kami Berada di:</p>
                    <p>Universitas Pembangunan Nasional "Veteran" Jawa Timur <br>Jl. Raya Rungkut Madya, Gunung Anyar, Surabaya, Jawa Timur</p>
                </div>
            </div>
        </div>

        <div class="bg-[#6e1515] px-6 md:px-20 py-4 flex flex-col md:flex-row justify-between text-sm text-gray-200">
            <p>© 2026 UKM Penalaran & Kreativitas UPN "Veteran" Jawa Timur</p>
            <p>Website by <span class="font-semibold">Vina • Naila • Inez Sistem informasi UPNVJT 2024</span></p>
        </div>
    </footer>

    <script>
        // Scroll Effect Navbar
        const header = document.querySelector("header");
        window.addEventListener("scroll", function () {
            if (window.scrollY > 50) {
                header.classList.add("bg-red-900", "shadow-lg");
            } else {
                header.classList.remove("bg-red-900", "shadow-lg");
            }
        });

        // BPH Carousel Slide
        const roles = ["Ketua Umum", "Sekretaris", "Bendahara"];
        let currentIndex = 0;
        const cards = document.querySelectorAll(".card-role");
        const title = document.getElementById("roleTitle");

        function showSlide(i) {
            cards.forEach(card => card.classList.add("hidden"));
            cards[i].classList.remove("hidden");
            title.innerText = roles[i];
        }

        function nextSlide() {
            currentIndex = (currentIndex + 1) % cards.length;
            showSlide(currentIndex);
        }

        function prevSlide() {
            currentIndex = (currentIndex - 1 + cards.length) % cards.length;
            showSlide(currentIndex);
        }
    </script>
</body>
</html>