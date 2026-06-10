<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tim UPN Mengajar</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Instrument+Serif:ital@0;1&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    
    <link rel="stylesheet" href="../dist/output.css">
</head>
<body class="font-[Poppins] bg-gray-50">
    
 <header id="main-nav" class="fixed top-0 left-0 w-full bg-red-900 text-white z-[9999] shadow-md">
    <div class="flex items-center justify-between px-6 py-0.5 text-white">
        <div class="flex items-center">
            <a href="beranda.html" class="overflow-hidden">
                <img src="./foto/logo.jpeg" alt="Logo UPN Mengajar" class="w-16 scale-125">
            </a>
        </div>

        <div class="flex items-center gap-12">
            <nav>
                <ul class="flex gap-12 font-poppins font-semibold">
                    <li><a href="beranda.html" class="relative after:absolute after:left-0 after:-bottom-1 after:h-[1.5px] after:w-0 after:bg-white after:transition-all after:duration-300 hover:after:w-full">Home</a></li>
                    <li class="relative group">
                        <a href="#" class="flex items-center gap-1 relative after:absolute after:left-0 after:-bottom-1 after:h-[1.5px] after:w-full after:bg-white after:transition-all after:duration-300">
                            Tentang
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 transition-transform duration-200 group-hover:rotate-180" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                            </svg>
                        </a>
                        <ul class="absolute left-0 mt-3 w-max bg-white text-gray-600 text-sm shadow-md opacity-0 invisible -translate-y-2 group-hover:opacity-100 group-hover:visible group-hover:translate-y-0 transition-all duration-300 ease-out">
                            <li><a href="{{ url('/tentang') }}" class="block px-5 py-2 hover:bg-gray-100">UKM Penalaran dan Kreativitas</a></li>
                            <li><a href="{{ url('/upnmengajar') }}" class="block px-5 py-2 hover:bg-gray-100">Program Kerja UPN Mengajar</a></li>
                            <li><a href="{{ url('/tim') }}" class="block px-5 py-2 bg-red-5 hover:bg-red-100">Tim UPN Mengajar</a></li>
                        </ul>
                    </li>
                    <li><a href="{{ url('/kegiatan') }}" class="relative after:absolute after:left-0 after:-bottom-1 after:h-[1.5px] after:w-0 after:bg-white after:transition-all after:duration-300 hover:after:w-full">Kegiatan</a></li>
                    <li><a href="{{ url('/formulir') }}" class="relative after:absolute after:left-0 after:-bottom-1 after:h-[1.5px] after:w-0 after:bg-white after:transition-all after:duration-300 hover:after:w-full">Relawan</a></li>
                </ul>
            </nav>
            <div class="relative group">
                <a href="#" class="hover:text-gray-300">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A9 9 0 1118.879 17.804M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                    </svg>
                </a>
            </div>
        </div>
    </div>
</header>

<div class="h-24"></div>
    <section class="px-6 text-center">
        <div class="max-w-5xl mx-auto">
            <h1 class="text-center text-3xl font-bold mt-4">TIM UPN MENGAJAR</h1>
        
            <p class="text-gray-600 mb-8 mt-4">Program UPN Mengajar dikelola oleh Bidang Pendidikan Sosial (Diksos) UKM Penalaran dan Kreativitas UPN Veteran Jawa Timur. 
            Bidang ini berperan dalam merancang dan mengoordinasikan kegiatan bersama relawan mahasiswa yang terlibat dalam program UPN Mengajar.</p>

            <div class="py-5">
                <div class="mt-8 overflow-hidden rounded-2xl shadow-2xl shadow-gray-200">
                    <img src="foto/Foto lengkap.jpg" alt="all diksos" 
                    class="mx-auto w-full h-auto object-cover object-center transform transition-transform duration-700 ease-out hover:scale-105">
                </div>
            </div>
            
           <section class="pt-16">
               <h2 class="mt-16 text-2xl font-semibold mb-10 uppercase">BPH BIDANG DIKSOS</h2>
                <div class="grid md:grid-cols-3 gap-8 mb-16">
                    <div class="bg-white p-4 rounded-xl shadow hover:shadow-lg transition-shadow duration-300">
                        <div class="overflow-hidden rounded-lg mb-4">
                        <img src="foto/Ketua Bidang.jpeg" 
                        class="w-full h-auto transform transition-transform duration-500 ease-out hover:scale-110">
                        </div>
                            <div class="text-center">
                            <h3 class="font-bold text-gray-800">Raihan Putra Pradana</h3>
                            <p class="text-sm text-gray-500">Ketua Bidang</p>
                            </div>
                    </div>
                    
                    <div class="bg-white p-4 rounded-xl shadow hover:shadow-lg transition-shadow duration-300">
                        <div class="overflow-hidden rounded-lg mb-4">
                            <img src="foto/Wakil Ketua Bidang.jpg" 
                            class="w-full h-auto transform transition-transform duration-500 ease-out hover:scale-110">
                         </div>
                             <div class="text-center">
                                <h3 class="font-bold text-gray-800">Andre Luhut Jairus</h3>
                                <p class="text-sm text-gray-500">Wakil Ketua</p>
                            </div>
                        </div>
    
                    <div class="bg-white p-4 rounded-xl shadow hover:shadow-lg transition-shadow duration-300">
                         <div class="overflow-hidden rounded-lg mb-4">
                         <img src="foto/Sekretaris Bidang.jpg" 
                         class="w-full h-auto transform transition-transform duration-500 ease-out hover:scale-110">
                        </div>
                            <div class="text-center">
                                <h3 class="font-bold text-gray-800">Nabila Devi Salma</h3>
                                <p class="text-sm text-gray-500">Sekretaris</p>
                            </div>
                        </div>
                    </div>
                    </div>
            </section>

           <section class="mb-16">
                <h2 class="text-2xl font-semibold mb-8 text-center md:text-left">STAF AHLI</h2>
                <div class="grid md:grid-cols-4 gap-8">
                    <div class="bg-white p-4 rounded-xl shadow hover:shadow-lg transition-shadow duration-300">
                    <div class="overflow-hidden rounded-lg mb-3">
                <img src="foto/Staff Ahli Medsos Diksos.jpg" 
                class="w-full h-auto transform transition-transform duration-500 ease-out hover:scale-110">
            </div>
            <div class="text-center">
                <h3 class="text-sm font-semibold text-gray-800">Fitri Aulia Taulani</h3>
                <p class="text-xs text-gray-500">Medsos Diksos</p>
            </div>
        </div>

        <div class="bg-white p-4 rounded-xl shadow hover:shadow-lg transition-shadow duration-300">
            <div class="overflow-hidden rounded-lg mb-3">
                <img src="foto/Staff Ahli Bina Desa.jpg" 
                class="w-full h-auto transform transition-transform duration-500 ease-out hover:scale-110">
            </div>
            <div class="text-center">
                <h3 class="text-sm font-semibold text-gray-800">Muhammad Alvin</h3>
                <p class="text-xs text-gray-500">Bina Desa</p>
            </div>
        </div>

        <div class="bg-white p-4 rounded-xl shadow hover:shadow-lg transition-shadow duration-300">
            <div class="overflow-hidden rounded-lg mb-3">
                <img src="foto/Staff Ahli UPN Mengajar.jpg" 
                class="w-full h-auto transform transition-transform duration-500 ease-out hover:scale-110">
            </div>
            <div class="text-center">
                <h3 class="text-sm font-semibold text-gray-800">Margaretha Deana</h3>
                <p class="text-xs text-gray-500">UPN Mengajar</p>
            </div>
        </div>

        <div class="bg-white p-4 rounded-xl shadow hover:shadow-lg transition-shadow duration-300">
            <div class="overflow-hidden rounded-lg mb-3">
                <img src="foto/Staff Ahlii Nalar Peduli.jpg" 
                class="w-full h-auto transform transition-transform duration-500 ease-out hover:scale-110">
            </div>
            <div class="text-center">
                <h3 class="text-sm font-semibold text-gray-800">Nayla Sabrina</h3>
                <p class="text-xs text-gray-500">Nalar Peduli</p>
            </div>
        </div>
        
    </div> </section>

    <footer class="bg-[#8B1E1E] text-white pt-16">
        <div class="max-w-7xl mx-auto px-6 md:px-20 grid md:grid-cols-3 gap-10 pb-10">

            <div class="md:border-r md:border-red-300 md:pr-10">
                <div class="w-24 h-24 overflow-hidden mb-5">
                    <img src="foto/logo.jpeg" class="w-full h-full object-cover scale-150">
                </div>
                <h4 class="font-semibold mb-3 text-lg">Menu</h4>
                <ul class="space-y-2 text-sm">
                    <li><a href="#" class="hover:underline">Home</a></li>
                    <li><a href="#" class="hover:underline">Tentang</a></li>
                    <li><a href="#" class="hover:underline">Kegiatan</a></li>
                    <li><a href="#" class="hover:underline">Relawan</a></li>
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
                        <img src="./foto/Untitled design (17).png" class="w-5 h-6" alt="">
                        <a href="mailto:upnmengajar.jt@gmail.com" class="hover:underline">upnmengajar.jt@gmail.com</a>
                    </div>
                    <div class="flex items-center gap-2">
                        <img src="foto/instagram.png" class="w-5 h-6" alt="">
                        <a href="https://instagram.com/upnmengajar.jt" class="hover:underline">@upnmengajar.jt</a>
                    </div>
                    <div class="flex items-center gap-2">
                        <img src="foto/whatsapp.png" class="w-5 h-6" alt="">
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
        nav.classList.remove("bg-red-500");
    } else {
        nav.classList.add("bg-red-900"); // tetap ada warna!
        nav.classList.remove("shadow-lg");
    }
}

window.addEventListener("scroll", ubahNav);
window.addEventListener("DOMContentLoaded", ubahNav);
</script>
    </body>
</html>