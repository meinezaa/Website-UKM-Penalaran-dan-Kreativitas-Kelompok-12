@extends('layouts.app')
@section('title', 'UKM Penalaran & Kreativitas')

@section('content')

{{-- HERO --}}
<section class="w-full bg-gray-100">
    <img src="{{ asset('foto/heroukm.png') }}" alt="UKM PNK" class="w-full h-auto object-contain">
</section>

{{-- ABOUT --}}
<section class="min-h-screen flex items-center justify-center bg-white py-20">
    <div class="relative w-full max-w-6xl">
        <img src="{{ asset('foto/kegiatanukm1.JPG') }}" class="w-full h-[400px] md:h-[450px] object-cover grayscale shadow-lg" alt="Kegiatan UKM">
        <div class="absolute inset-0 bg-black/50"></div>
        <div class="absolute inset-0 flex items-center justify-center text-center px-6">
            <div class="max-w-2xl">
                <p class="text-xs tracking-widest text-white/80 mb-2">WELCOME TO OUR COMMUNITY</p>
                <h1 class="text-2xl md:text-3xl font-semibold text-white leading-tight mb-3">
                    UKM Penalaran & Kreativitas<br>UPN Veteran Jawa Timur
                </h1>
                <p class="text-white/80 text-sm leading-relaxed mb-6">
                    UKM Penalaran dan Kreativitas merupakan wadah bagi mahasiswa untuk mengembangkan kemampuan
                    berpikir kritis, inovatif, dan solutif melalui penelitian ilmiah dan pengembangan ide kreatif.
                    Kami berkomitmen menciptakan lingkungan kolaboratif yang mendorong mahasiswa untuk berkembang,
                    berprestasi, dan memberikan dampak nyata bagi masyarakat.
                </p>
                <div class="flex justify-center gap-6 mt-4">
                    <a href="https://wa.me/6289699808453" target="_blank"><img src="{{ asset('foto/icn-whatsapp.png') }}" class="w-6 h-6 hover:scale-125 transition" alt="WhatsApp"></a>
                    <a href="mailto:upnmengajar.jt@gmail.com"><img src="{{ asset('foto/icn-email.png') }}" class="w-6 h-6 hover:scale-125 transition" alt="Email"></a>
                    <a href="https://instagram.com/upnmengajar.jt" target="_blank"><img src="{{ asset('foto/icn-instagram.png') }}" class="w-6 h-6 hover:scale-125 transition" alt="Instagram"></a>
                    <a href="#" target="_blank"><img src="{{ asset('foto/icn-linkedin.png') }}" class="w-6 h-6 hover:scale-125 transition" alt="LinkedIn"></a>
                    <a href="#" target="_blank"><img src="{{ asset('foto/icn-tiktok.png') }}" class="w-6 h-6 hover:scale-125 transition" alt="TikTok"></a>
                    <a href="#" target="_blank"><img src="{{ asset('foto/icn-x.png') }}" class="w-6 h-6 hover:scale-125 transition" alt="X"></a>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- VISI MISI --}}
<section class="py-20 bg-white">
    <div class="max-w-6xl mx-auto px-6 grid md:grid-cols-2 gap-10">
        <div class="bg-white p-8 rounded-2xl shadow hover:shadow-xl transition">
            <h3 class="text-2xl font-bold text-[#8B1E1E] mb-4">Visi</h3>
            <p class="text-gray-700">Terwujudnya lingkungan kampus yang lebih akademis, selaras dengan nilai-nilai Tridarma Perguruan Tinggi.</p>
        </div>
        <div class="bg-white p-8 rounded-2xl shadow hover:shadow-xl transition">
            <h3 class="text-2xl font-bold text-[#8B1E1E] mb-4">Misi</h3>
            <ul class="list-disc ml-5 space-y-2 text-gray-700">
                <li>Mengajak mahasiswa sebagai roda penggerak dalam mewujudkan Kampus Pelopor Peradaban.</li>
                <li>Menghasilkan kader yang kompetitif, inovatif, dan kreatif serta berdaya saing tinggi di bidang keilmuan, penelitian, dan pengabdian masyarakat.</li>
                <li>Menjadikan lingkungan kampus yang aman dan memiliki jiwa pengabdian pada masyarakat.</li>
            </ul>
        </div>
    </div>
</section>

{{-- BIDANG --}}
<section class="py-20 bg-gray-50">
    <div class="max-w-6xl mx-auto px-6 text-center">
        <h2 class="text-3xl font-bold text-[#8B1E1E] mb-12">Bidang dalam UKM</h2>
        <div class="grid md:grid-cols-3 gap-8">
            <div class="bg-white p-8 rounded-2xl shadow hover:shadow-xl transition">
                <h3 class="font-bold text-xl mb-3 text-gray-800">Penelitian</h3>
                <p class="text-gray-600">Mengembangkan kemampuan riset dan karya ilmiah mahasiswa.</p>
            </div>
            <div class="bg-white p-8 rounded-2xl shadow hover:shadow-xl transition">
                <h3 class="font-bold text-xl mb-3 text-gray-800">Kreativitas</h3>
                <p class="text-gray-600">Mendorong inovasi dan ide kreatif dalam berbagai bidang.</p>
            </div>
            <div class="bg-white p-8 rounded-2xl shadow hover:shadow-xl transition">
                <h3 class="font-bold text-xl mb-3 text-gray-800">Pengembangan SDM</h3>
                <p class="text-gray-600">Meningkatkan kualitas anggota melalui pelatihan dan mentoring.</p>
            </div>
        </div>
    </div>
</section>

{{-- BADAN PENGURUS HARIAN --}}
<section class="py-20 bg-white">
    <div class="max-w-4xl mx-auto px-6 text-center">
        <h2 class="text-3xl font-bold text-[#8B1E1E] mb-3">Badan Pengurus Harian</h2>
        <p id="roleTitle" class="text-lg text-gray-600 font-semibold mb-8">Ketua Umum</p>

        <div id="cardContainer" class="mb-4">

            {{-- Ketua --}}
            <div class="card-role">
                <div class="flex justify-center">
                    <div class="bg-white rounded-2xl shadow border border-gray-100 p-6 w-60 hover:shadow-xl transition">
                        <img src="{{ asset('foto/ketuaumum.png') }}" class="rounded-full mx-auto mb-4 w-24 h-24 object-cover" alt="Ketua Umum">
                        <h4 class="font-bold text-gray-800">Mayla Zaskia K</h4>
                        <p class="text-sm text-gray-500">Ekonomi Pembangunan '24</p>
                    </div>
                </div>
            </div>

            {{-- Sekretaris --}}
            <div class="card-role hidden">
                <div class="flex gap-6 justify-center flex-wrap">
                    <div class="bg-white rounded-2xl shadow border border-gray-100 p-6 w-60">
                        <img src="{{ asset('foto/sekjen.png') }}" class="rounded-full mx-auto mb-4 w-24 h-24 object-cover" alt="Sekjen">
                        <h4 class="font-bold text-gray-800">Yanis Nabila J</h4>
                        <p class="text-sm text-gray-500">Ekonomi Pembangunan '24</p>
                    </div>
                    <div class="bg-white rounded-2xl shadow border border-gray-100 p-6 w-60">
                        <img src="{{ asset('foto/sekre1.png') }}" class="rounded-full mx-auto mb-4 w-24 h-24 object-cover" alt="Sekretaris 1">
                        <h4 class="font-bold text-gray-800">Putra Batara S W</h4>
                        <p class="text-sm text-gray-500">Hukum '24</p>
                    </div>
                    <div class="bg-white rounded-2xl shadow border border-gray-100 p-6 w-60">
                        <img src="{{ asset('foto/sekre2.png') }}" class="rounded-full mx-auto mb-4 w-24 h-24 object-cover" alt="Sekretaris 2">
                        <h4 class="font-bold text-gray-800">Hikmah Maulida</h4>
                        <p class="text-sm text-gray-500">Manajemen '24</p>
                    </div>
                </div>
            </div>

            {{-- Bendahara --}}
            <div class="card-role hidden">
                <div class="flex gap-6 justify-center flex-wrap">
                    <div class="bg-white rounded-2xl shadow border border-gray-100 p-6 w-60">
                        <img src="{{ asset('foto/bendahara1.png') }}" class="rounded-full mx-auto mb-4 w-24 h-24 object-cover" alt="Bendahara 1">
                        <h4 class="font-bold text-gray-800">Dhanesia Vega Susila</h4>
                        <p class="text-sm text-gray-500">Manajemen '24</p>
                    </div>
                    <div class="bg-white rounded-2xl shadow border border-gray-100 p-6 w-60">
                        <img src="{{ asset('foto/bendahara2.png') }}" class="rounded-full mx-auto mb-4 w-24 h-24 object-cover" alt="Bendahara 2">
                        <h4 class="font-bold text-gray-800">Syalsabilla Noer R</h4>
                        <p class="text-sm text-gray-500">Administrasi Publik '24</p>
                    </div>
                </div>
            </div>

        </div>

        <div class="flex justify-center gap-10 mt-6">
            <button onclick="prevSlide()" class="text-3xl text-[#8B1E1E] hover:scale-125 transition focus:outline-none">←</button>
            <button onclick="nextSlide()" class="text-3xl text-[#8B1E1E] hover:scale-125 transition focus:outline-none">→</button>
        </div>
    </div>
</section>

{{-- HIGHLIGHT KEGIATAN --}}
<section class="py-20 bg-gray-50">
    <div class="max-w-6xl mx-auto px-6 text-center">
        <h2 class="text-3xl font-bold text-[#8B1E1E] mb-12">Highlight Kegiatan</h2>
        <div class="grid md:grid-cols-3 gap-8">
            @forelse ($kegiatan as $item)
            <div class="bg-white rounded-2xl overflow-hidden shadow hover:shadow-xl transition">
                {{-- Penyesuaian pemanggilan objek menggunakan tanda panah (->) --}}
                <img src="{{ asset('foto/' . ($item->foto ?? 'default.jpg')) }}" class="w-full h-48 object-cover hover:scale-105 transition duration-300" alt="{{ $item->judul ?? $item->nama_kegiatan }}">
                <div class="p-5 text-left">
                    <h4 class="font-bold text-gray-800 mb-2">{{ $item->judul ?? $item->nama_kegiatan ?? 'Judul Kegiatan' }}</h4>
                    <p class="text-sm text-gray-600 leading-relaxed">{{ $item->deskripsi ?? 'Tidak ada deskripsi untuk kegiatan ini.' }}</p>
                </div>
            </div>
            @empty
            <div class="col-span-3 py-10 text-gray-400 italic">
                Belum ada data highlight kegiatan yang tersedia saat ini.
            </div>
            @endforelse
        </div>
    </div>
</section>

@endsection

@push('scripts')
<script>
    const roles = ["Ketua Umum", "Sekretaris", "Bendahara"];
    let index = 0;
    const cards = document.querySelectorAll(".card-role");
    const title = document.getElementById("roleTitle");

    function showSlide(i) {
        cards.forEach(card => card.classList.add("hidden"));
        cards[i].classList.remove("hidden");
        title.innerText = roles[i];
    }
    function nextSlide() { 
        index = (index + 1) % cards.length; 
        showSlide(index); 
    }
    function prevSlide() { 
        index = (index - 1 + cards.length) % cards.length; 
        showSlide(index); 
    }
</script>
@endpush