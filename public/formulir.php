<?php
session_start();
require_once 'koneksi.php';

// PROTEKSI: Jika tidak ada session, tendang ke login.php
if (!isset($_SESSION['id_user'])) {
    header("Location: login.php");
    exit();
}

// Ambil data user berdasarkan session
$id_user = $_SESSION['id_user'];
$query_user = mysqli_query($koneksi, "SELECT * FROM users WHERE id_user = '$id_user'");
$user_data = mysqli_fetch_assoc($query_user);

// Jika user tidak ditemukan di DB (tapi session ada), logout paksa
if (!$user_data) {
    session_destroy();
    header("Location: login.php");
    exit();
}

$email_otomatis = $user_data['email'];
$nama_otomatis  = $user_data['nama_lengkap'];
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pendaftaran | UPN Mengajar</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        .bg-pattern { background-color: #bb0016; background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='100' height='100' viewBox='0 0 100 100'%3E%3Cg fill='%23ffffff' fill-opacity='0.05'%3E%3Cpath d='M96 95h4v1h-4v4h-1v-4h-9v4h-1v-4h-9v4h-1v-4h-9v4h-1v-4h-9v4h-1v-4h-9v4h-1v-4h-9v4h-1v-4h-9v4h-1v-4h-9v4h-1v-4H0v-1h15v-9H0v-1h15v-9H0v-1h15v-9H0v-1h15v-9H0v-1h15v-9H0v-1h15v-9H0v-1h15v-9H0v-1h15v-9H0v-1h15V0h1v15h9V0h1v15h9V0h1v15h9V0h1v15h9V0h1v15h9V0h1v15h9V0h1v15h9V0h1v15h9V0h1v15h4v1h-4v9h4v1h-4v9h4v1h-4v9h4v1h-4v9h4v1h-4v9h4v1h-4v9h4v1h-4v9h4v1h-4v9z'/%3E%3C/g%3E%3C/svg%3E"); }
        input[type="radio"]:checked + label { background-color: #fee2e2; border-color: #ef4444; color: #b91c1c; }
    </style>
</head>
<body class="bg-pattern min-h-screen flex items-center justify-center p-6">
    <div class="bg-white w-full max-w-2xl rounded-[2.5rem] shadow-2xl overflow-hidden">
        <div class="bg-gray-50 px-10 py-8 border-b border-gray-100 text-center">
            <h1 class="text-2xl font-extrabold text-gray-900 italic">Formulir <span class="text-red-600">Relawan</span></h1>
            <div class="flex items-center justify-center mt-6 space-x-3">
                <div id="dot-1" class="w-10 h-2 rounded-full bg-red-600 transition-all duration-300"></div>
                <div id="dot-2" class="w-6 h-2 rounded-full bg-gray-200 transition-all duration-300"></div>
                <div id="dot-3" class="w-6 h-2 rounded-full bg-gray-200 transition-all duration-300"></div>
            </div>
        </div>

        <form id="formRelawan" action="proses_pendaftaran.php" method="POST" enctype="multipart/form-data" class="p-10">
            <div id="step-1" class="space-y-5">
                <div>
                    <label class="block text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-1">Nama Lengkap</label>
                    <input type="text" name="nama_lengkap" value="<?php echo $nama_otomatis; ?>" readonly class="w-full px-5 py-3 bg-gray-100 border rounded-xl outline-none text-gray-500 font-semibold cursor-not-allowed">
                </div>
                
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-1">WhatsApp</label>
                        <input type="number" name="no_hp" required placeholder="08..." class="w-full px-5 py-3 bg-gray-50 border rounded-xl outline-none focus:border-red-600">
                    </div>
                    <div>
                        <label class="block text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-1">Email Aktif</label>
                        <input type="text" value="<?php echo $email_otomatis; ?>" readonly class="w-full px-5 py-3 bg-gray-100 border rounded-xl text-gray-500 text-sm font-semibold italic cursor-not-allowed">
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-4 items-center">
                    <div>
                        <label class="block text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-1">Umur</label>
                        <input type="number" name="umur" required placeholder="20" class="w-full px-5 py-3 bg-gray-50 border rounded-xl outline-none">
                    </div>
                    <div>
                        <label class="block text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-1">Jenis Kelamin</label>
                        <div class="flex gap-2">
                            <input type="radio" name="jenis_kelamin" id="L" value="Laki-laki" class="hidden" required>
                            <label for="L" class="flex-1 text-center py-2.5 border rounded-xl cursor-pointer text-sm font-bold text-gray-400 transition-all">Laki-laki</label>
                            <input type="radio" name="jenis_kelamin" id="P" value="Perempuan" class="hidden">
                            <label for="P" class="flex-1 text-center py-2.5 border rounded-xl cursor-pointer text-sm font-bold text-gray-400 transition-all">Perempuan</label>
                        </div>
                    </div>
                </div>

                <div>
                    <label class="block text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-1">Jurusan</label>
                    <select name="asal_prodi" required class="w-full px-5 py-3 bg-gray-50 border rounded-xl outline-none">
                        <option value="">Pilih Program Studi</option>
                        <option value="Informatika">Informatika</option>
                        <option value="Sistem Informasi">Sistem Informasi</option>
                        <option value="Teknik Industri">Teknik Industri</option>
                    </select>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <select name="pilihan_divisi_1" required class="w-full px-5 py-3 bg-gray-50 border rounded-xl outline-none">
                        <option value="">Divisi Utama</option>
                        <option value="Acara">Acara</option>
                        <option value="PDD">PDD</option>
                        <option value="Humas">Humas</option>
                    </select>
                    <select name="pilihan_divisi_2" required class="w-full px-5 py-3 bg-gray-50 border rounded-xl outline-none">
                        <option value="">Divisi Cadangan</option>
                        <option value="Acara">Acara</option>
                        <option value="PDD">PDD</option>
                        <option value="Humas">Humas</option>
                    </select>
                </div>

                <div>
                    <label class="block text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-1">Link Portofolio</label>
                    <input type="url" name="portofolio" placeholder="https://..." class="w-full px-5 py-3 bg-gray-50 border rounded-xl outline-none mb-3">
                    <label class="block text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-1">Deskripsi Diri</label>
                    <textarea name="deskripsi" placeholder="Ceritakan pengalamanmu..." class="w-full px-5 py-3 bg-gray-50 border rounded-xl outline-none min-h-[80px]"></textarea>
                </div>
            </div>

            <div id="step-2" class="hidden space-y-6 text-center">
                <div class="bg-red-50 p-6 rounded-3xl border border-red-100 italic font-bold text-red-700">
                    BIAYA REGISTRASI: RP 50.000<br>
                    <span class="text-[10px] text-red-500 tracking-widest uppercase">BCA 12345678 A/N UPN MENGGURAI</span>
                </div>
                <div class="text-left">
                    <label class="block text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-2">Metode Transfer</label>
                    <select name="metode_pembayaran" required class="w-full px-5 py-3 bg-gray-50 border rounded-xl outline-none">
                        <option value="BCA">Bank BCA</option>
                        <option value="DANA">E-Wallet DANA</option>
                    </select>
                </div>
                <div class="border-2 border-dashed border-gray-200 rounded-[2rem] p-12 relative hover:border-red-400 transition-all group">
                    <input type="file" name="bukti_pembayaran" required class="absolute inset-0 opacity-0 cursor-pointer" onchange="document.getElementById('file-name').innerText = 'File: ' + this.files[0].name">
                    <p id="file-name" class="text-gray-400 font-bold text-[10px] uppercase tracking-[0.2em] group-hover:text-red-600 transition-all">Upload Bukti Transfer</p>
                </div>
            </div>

            <div id="step-3" class="hidden text-center space-y-6">
                <div class="w-16 h-16 bg-green-50 text-green-600 rounded-full flex items-center justify-center mx-auto">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                </div>
                <h2 class="text-lg font-extrabold italic">Konfirmasi Akhir</h2>
                <div class="bg-gray-50 p-6 rounded-2xl text-left text-[11px] text-gray-400 border border-gray-100 uppercase font-semibold leading-relaxed">
                    1. Saya bersedia mengikuti rangkaian acara.<br>
                    2. Data yang saya berikan adalah benar.
                </div>
                <label class="flex items-center gap-4 p-5 bg-gray-50 rounded-2xl cursor-pointer border hover:border-red-600/20 transition-all">
                    <input type="checkbox" name="persetujuan" required class="w-6 h-6 accent-red-600 rounded-lg">
                    <span class="text-[10px] font-bold text-gray-400 uppercase text-left leading-tight">Saya setuju dengan S&K di atas.</span>
                </label>
            </div>

            <div class="flex justify-between items-center mt-12">
                <button type="button" id="prevBtn" onclick="move(-1)" class="hidden text-gray-400 font-bold text-xs uppercase hover:text-red-600">Kembali</button>
                <div class="flex-1"></div>
                <button type="submit" name="daftar_relawan" id="nextBtn" onclick="return move(1)" class="bg-red-600 text-white px-12 py-4 rounded-2xl font-bold text-xs uppercase tracking-[0.2em] shadow-2xl shadow-red-200 hover:bg-red-800 transition-all active:scale-95">Lanjut</button>
            </div>
        </form>
    </div>

    <script>
        let step = 1;
        function move(n) {
            if (n === 1) {
                const currentStepDiv = document.getElementById(`step-${step}`);
                const requiredInputs = currentStepDiv.querySelectorAll("input[required], select[required], textarea[required]");
                const isRadioValid = step !== 1 || document.querySelector('input[name="jenis_kelamin"]:checked');
                let allFilled = true;
                requiredInputs.forEach(input => { if (!input.value) allFilled = false; });
                if (!allFilled || !isRadioValid) { alert("Lengkapi data!"); return false; }
            }
            if (step + n > 3) return true;
            event.preventDefault();
            document.getElementById(`step-${step}`).classList.add("hidden");
            step += n;
            document.getElementById(`step-${step}`).classList.remove("hidden");
            document.getElementById("prevBtn").classList.toggle("hidden", step === 1);
            document.getElementById("nextBtn").innerText = step === 3 ? "Kirim Sekarang" : "Lanjut";
            for(let i=1; i<=3; i++) document.getElementById(`dot-${i}`).className = i <= step ? "w-10 h-2 rounded-full bg-red-600 transition-all duration-300" : "w-6 h-2 rounded-full bg-gray-200 transition-all duration-300";
        }
    </script>
</body>
</html>