<!DOCTYPE html>
<html>
<head>
    <title>Laporan Bukti ACC - Petugas</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <style>
        @media print {
            .no-print { display: none; }
            body { font-size: 12px; }
        }
    </style>
</head>
<body>
    <h2>Laporan Bukti ACC Peminjaman</h2>
    <nav class="navbar">
        <a href="?page=logout">Logout</a>
        <a href="?page=peminjaman">Data Peminjaman</a>
        <a href="?page=laporan">Laporan ACC</a>
        <a href="?page=pemantauan">Pemantauan Pengembalian</a>
    </nav>
    <button class="no-print" onclick="window.print()">Cetak Laporan</button>
    <br><br>
    <table border="1" cellpadding="8" cellspacing="0">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama Peminjam</th>
                <th>Nama Alat</th>
                <th>Tanggal Pinjam</th>
                <th>Tanggal Kembali</th>
                <th>Status</th>
                <th>Tanda Tangan Petugas</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach($peminjaman as $p): ?>
            <tr>
                <td><?= $p['id'] ?></td>
                <td><?= htmlspecialchars($p['nama_lengkap']) ?></td>
                <td><?= htmlspecialchars($p['nama_alat']) ?></td>
                <td><?= $p['tgl_pinjam'] ?></td>
                <td><?= $p['tgl_kembali'] ?></td>
                <td>Disetujui</td>
                <td>____________________</td>
            </tr>
        <?php endforeach ?>
        </tbody>
    </table>
</body>
</html>