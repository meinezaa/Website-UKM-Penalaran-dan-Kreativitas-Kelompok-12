<!doctype html>
<html lang="id">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Kegiatan - UKM Penalaran</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <link rel="stylesheet" href="{{ asset('css/output.css') }}">
  </head>
  
<body class="bg-gray-50 font-poppins">

  <!-- Header / Navbar Statis Merah -->
  <header class="bg-red-900 w-full z-50 shadow-lg">
    <div class="flex items-center justify-between px-6 py-0.5 text-white max-w-7xl mx-auto">
      <div class="flex items-center">
        <a href="{{ url('/') }}" class="overflow-hidden">
          <img src="{{ asset('foto/logo.jpeg') }}" alt="Logo UPN Mengajar" class="w-16 scale-125">
        </a>
      </div>

      <div class="flex items-center gap-12">
        <nav>
          <ul class="flex gap-12 font-semibold">
            <li><a href="{{ url('/') }}" class="hover:text-gray-300">Home</a></li>
            <li class="relative group">
              <a href="{{ route('tentang.ukm') }}" class="flex items-center gap-1 hover:text-gray-300">
                Tentang
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 transition-transform duration-200 group-hover:rotate-180" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                </svg>
              </a>
              <ul class="absolute left-0 mt-3 w-max bg-white text-gray-600 text-sm shadow-md opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300">
                <li><a href="{{ route('tentang.ukm') }}" class="block px-5 py-2 hover:bg-gray-100">UKM Penalaran dan Kreativitas</a></li>
                <li><a href="{{ route('tentang.upnmengajar') }}" class="block px-5 py-2 hover:bg-gray-100">Program Kerja UPN Mengajar</a></li>
                <li><a href="{{ route('tentang.struktur') }}" class="block px-5 py-2 hover:bg-gray-100">Tim UPN Mengajar</a></li>
              </ul>
            </li>
            <li><a href="{{ route('kegiatan') }}" class="text-red-300 border-b-2 border-red-300">Kegiatan</a></li>
            <li><a href="{{ route('relawan.index') }}" class="hover:text-gray-300">Relawan</a></li>
          </ul>
        </nav>
      </div>
    </div>
  </header>

  <!-- Konten Utama Sementara -->
  <main class="max-w-7xl mx-auto px-6 py-20 text-center">
    <div class="bg-white p-12 rounded-2xl shadow-xl max-w-2xl mx-auto border border-gray-100">
      <div class="w-20 h-20 bg-red-100 rounded-full flex items-center justify-center mx-auto mb-6">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-red-700" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
        </svg>
      </div>
      <h1 class="text-3xl font-bold text-gray-800 mb-4">Halaman Kegiatan</h1>
      <p class="text-gray-600 leading-relaxed">
        Halaman ini sedang dalam proses pengembangan. Di sini nantinya akan menampilkan seluruh riwayat, dokumentasi, dan detail kegiatan pengabdian dari UPN Mengajar.
      </p>
      <div class="mt-8">
        <a href="{{ url('/') }}" class="bg-red-700 hover:bg-red-800 text-white font-medium px-6 py-2.5 rounded-full transition-all">
          ← Kembali ke Beranda
        </a>
      </div>
    </div>
  </main>

</body>
</html>