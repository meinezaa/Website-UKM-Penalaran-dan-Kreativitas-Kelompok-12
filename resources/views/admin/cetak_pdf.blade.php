<!DOCTYPE html>
<html>
<head>
    <title>Laporan Relawan UPN Mengajar</title>
    <style>
        body { font-family: sans-serif; font-size: 12px; color: #1a1c1c; }
        .header { text-align: center; margin-bottom: 30px; }
        .header h2 { margin: 0; color: #bb0016; text-transform: uppercase; letter-spacing: 1px; }
        .header p { margin: 5px 0 0 0; color: #666; }
        table { w-full: 100%; width: 100%; border-collapse: collapse; margin-top: 10px; }
        th { bg-color: #f3f3f3; background-color: #f3f3f3; color: #555; text-transform: uppercase; font-size: 10px; letter-spacing: 0.5px; }
        th, td { border: 1px solid #e3e3e3; padding: 10px; text-align: left; }
        tr:nth-child(even) { background-color: #fafafa; }
        .status { font-weight: bold; text-transform: uppercase; font-size: 10px; }
    </style>
</head>
<body>

    <div class="header">
        <h2>Laporan Data Relawan UPN Mengajar</h2>
        <p>Dicetak pada tanggal: {{ date('d F Y') }}</p>
    </div>

    <table>
        <thead>
            <tr>
                <th>Nama Lengkap</th>
                <th>Email</th>
                <th>No HP</th>
                <th>Asal Prodi</th>
                <th>Nama Kegiatan</th>
                <th>Divisi</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach($dataRelawan as $row)
            <tr>
                <td><strong>{{ $row->nama_lengkap }}</strong></td>
                <td>{{ $row->email }}</td>
                <td>{{ $row->no_hp }}</td>
                <td>{{ $row->asal_prodi }}</td>
                <td>{{ $row->nama_kegiatan }}</td>
                <td>{{ $row->pilihan_divisi_1 }}</td>
                <td class="status">{{ $row->status_seleksi }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

</body>
</html>