<?php
// WAJIB: Cek apakah user sudah login atau belum
session_start();
if (!isset($_SESSION['id_user'])) {
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Form Relawan</title>
  
<link rel="stylesheet" href="../dist/output.css">

  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&family=Playfair+Display:wght@600&display=swap" rel="stylesheet">
</head>

<body class="bg-gradient-to-br from-red-500 to-red-700 min-h-screen flex items-center justify-center">

<div class="bg-white w-full max-w-3xl rounded-2xl shadow-2xl p-8">
    
  <div class="text-center mb-6">
    <h1 class="text-3xl font-bold text-black">Formulir Pendaftaran</h1>
    <p class="text-lg text-gray-600 font-[Playfair Display]">UPN Mengajar Jilid IX</p>
  </div>

<div class="pl-2 flex items-center justify-center mb-8 text-xs">

  <div class="flex flex-col items-center">
    <div class="circle w-6 h-6 rounded-full bg-red-600 text-white flex items-center justify-center text-[10px]">1</div>
    <span class="step mt-2 text-red-600">Data</span>
  </div>

  <div class="line w-12 h-[0.5px] bg-gray-300 mx-3 relative -top-3 transition-all duration-500"></div>

  <div class="flex flex-col items-center">
    <div class="circle w-6 h-6 rounded-full bg-gray-300 text-white flex items-center justify-center text-[10px]">2</div>
    <span class="step mt-2 text-gray-400">Pembayaran</span>
  </div>

  <div class="line w-12 h-[0.5px] bg-gray-300 mx-3 relative -top-3 transition-all duration-500"></div>

  <div class="flex flex-col items-center">
    <div class="circle w-6 h-6 rounded-full bg-gray-300 text-white flex items-center justify-center text-[10px]">3</div>
    <span class="step mt-2 text-gray-400">Persetujuan</span>
  </div>

</div>

  <form id="formRelawan" action="proses_pendaftaran.php" method="POST" enctype="multipart/form-data">
    
    <input type="hidden" name="daftar_relawan" value="1">

    <div class="step-content">

  <h2 class="text-lg font-semibold mb-4 text-black">Data Diri & Informasi</h2>

  <div class="mb-4">
    <label class="block text-sm mb-1 text-gray-600">Nama Lengkap</label>
    <input type="text" name="nama_lengkap" placeholder="Isi nama lengkap"
      class="w-full p-3 bg-gray-100 border rounded-lg focus:ring-2 focus:ring-red-400">
  </div>

  <div class="grid grid-cols-2 gap-4 mb-4">
    
    <div>
      <label class="block text-sm mb-1 text-gray-600">Email</label>
      <input type="email" name="email" placeholder="Isi email aktif"
        class="w-full p-3 bg-gray-100 border rounded-lg focus:ring-2 focus:ring-red-400">
    </div>

    <div>
      <label class="block text-sm mb-1 text-gray-600">No HP</label>
      <input type="text" name="no_hp" placeholder="Isi nomor HP"
        class="w-full p-3 bg-gray-100 border rounded-lg focus:ring-2 focus:ring-red-400">
    </div>

  </div>

  <div class="grid grid-cols-2 gap-4 mb-4">

    <div>
      <label class="block text-sm mb-1 text-gray-600">Umur</label>
      <input type="number" name="umur" placeholder="Isi umur"
        class="w-full p-3 bg-gray-100 border rounded-lg focus:ring-2 focus:ring-red-400">
    </div>

    <div>
  <label class="block text-sm mb-1 text-gray-600">Jenis Kelamin</label>

  <div class="flex gap-6 mt-2">
    <label class="flex items-center gap-2 text-sm">
      <input type="radio" name="jk" value="Laki-laki" class="accent-red-500">
      Laki-laki
    </label>

    <label class="flex items-center gap-2 text-sm">
      <input type="radio" name="jk" value="Perempuan" class="accent-red-500">
      Perempuan
    </label>
  </div>
</div>

  </div>

  <div class="mb-4">
    <label class="block text-sm mb-1 text-gray-600">Program Studi</label>
    <input type="text" name="asal_prodi" placeholder="Isi program studi" required
      class="w-full p-3 bg-gray-100 border rounded-lg focus:ring-2 focus:ring-red-400">
  </div>

  <div class="grid grid-cols-2 gap-4 mb-4">

    <div>
      <label class="block text-sm mb-1 text-gray-600">Pilih Divisi</label>
      <select name="pilihan_divisi" required class="w-full p-3 bg-gray-100 border rounded-lg focus:ring-2 focus:ring-red-400">
        <option value="">Pilih divisi</option>
        <option value="Pendidikan">Pendidikan</option>
        <option value="Kesehatan">Kesehatan</option>
        <option value="PDD">PDD</option>
      </select>
    </div>

    <div>
      <label class="block text-sm mb-1 text-gray-600">Portofolio (khusus PDD)</label>
      <input type="text" name="portofolio" placeholder="Isi link portofolio"
        class="w-full p-3 bg-gray-100 border rounded-lg focus:ring-2 focus:ring-red-400">
    </div>

  </div>

  <div>
    <label class="block text-sm mb-1 text-gray-600">Pengalaman / Keahlian</label>
    <textarea name="alasan" required placeholder="Ceritakan pengalaman atau keahlian kamu"
      class="w-full p-3 bg-gray-100 border rounded-lg focus:ring-2 focus:ring-red-400"></textarea>
  </div>

</div>

    <div class="step-content hidden">
      <h2 class="text-lg font-semibold mb-4 text-red-600">Pembayaran</h2>

      <p class="text-sm text-gray-600 mb-4">
        Silakan melakukan pembayaran sebesar <b>Rp50.000</b> untuk melanjutkan proses pendaftaran.
      </p>

      <select name="metode_pembayaran" class="p-3 border rounded-lg w-full mb-4">
        <option value="Transfer Bank">Transfer Bank</option>
        <option value="DANA">DANA</option>
        <option value="OVO">OVO</option>
      </select>

      <input type="file" name="bukti_pembayaran" required accept="image/*" class="p-2 border rounded-lg w-full">
    </div>

    <div class="step-content hidden">
      <h2 class="text-lg font-semibold mb-4 text-red-600">Persetujuan</h2>

      <div class="text-sm text-gray-600 space-y-3 max-h-40 overflow-y-auto border p-4 rounded-lg">
        <p>Saya menyatakan bahwa data yang saya isi adalah benar.</p>
        <p>Saya bersedia mengikuti seluruh kegiatan relawan.</p>
        <p>Saya akan mematuhi aturan dan menjaga nama baik organisasi.</p>
        <p>Saya siap menerima konsekuensi jika melanggar.</p>
      </div>

      <label class="flex items-center gap-2 mt-4">
        <input type="checkbox" name="persetujuan" id="agree" required>
        Saya setuju
      </label>
    </div>

    <div class="flex justify-between mt-6">
      <button type="button" onclick="prevStep()" class="px-4 py-2 bg-gray-200 rounded-lg">Kembali</button>
      <button type="button" id="nextBtn" onclick="nextStep()" class="px-4 py-2 bg-red-600 text-white rounded-lg">Lanjut</button>
    </div>

  </form>

</div>

<script>
let currentStep = 0;
const steps = document.querySelectorAll(".step-content");
const indicators = document.querySelectorAll(".step");
const circles = document.querySelectorAll(".circle");
const nextBtn = document.getElementById("nextBtn");
const lines = document.querySelectorAll(".line");

function showStep(index) {
  steps.forEach((step, i) => {
    step.classList.toggle("hidden", i !== index);
  });

indicators.forEach((el, i) => {
  if (i <= index) {
    el.classList.remove("text-gray-400");
    el.classList.add("text-red-600");
  } else {
    el.classList.remove("text-red-600");
    el.classList.add("text-gray-400");
  }
});

circles.forEach((c, i) => {
  if (i <= index) {
    c.classList.remove("bg-gray-300");
    c.classList.add("bg-red-600");
  } else {
    c.classList.remove("bg-red-600");
    c.classList.add("bg-gray-300");
  }
});

  // 🔥 LINE PROGRESS
  lines.forEach((line, i) => {
    if (i < index) {
      line.classList.remove("bg-gray-300");
      line.classList.add("bg-red-600");
    } else {
      line.classList.remove("bg-red-600");
      line.classList.add("bg-gray-300");
    }
  });

  nextBtn.textContent = index === steps.length - 1 ? "Kirim" : "Lanjut";
}

function nextStep() {
  if (currentStep === steps.length - 1) {
    // Saat klik Kirim, form langsung disubmit ke proses_pendaftaran.php
    document.getElementById("formRelawan").submit();
    return;
  }

  currentStep++;
  showStep(currentStep);
}

function prevStep() {
  if (currentStep > 0) {
    currentStep--;
    showStep(currentStep);
  }
}

showStep(currentStep);
</script>

</body>
</html>