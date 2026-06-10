<!DOCTYPE html>
<html>
<head>
    <title>{{ $kegiatan->nama_kegiatan }}</title>
</head>
<body>

<h1>{{ $kegiatan->nama_kegiatan }}</h1>

<p>
    Lokasi:
    {{ $kegiatan->lokasi }}
</p>

<p>
    Tanggal:
    {{ $kegiatan->tanggal_pelaksanaan }}
</p>

<p>
    {{ $kegiatan->deskripsi_detail }}
</p>

<a href="/formulir">
    Daftar Sekarang
</a>

</body>
</html>