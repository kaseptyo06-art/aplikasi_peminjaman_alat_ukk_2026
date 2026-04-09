<!DOCTYPE html>
<html>
<head>
    <title>Pemantauan Pengembalian - Petugas</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <h2>Pemantauan Pengembalian Alat</h2>
    <nav class="navbar">
        <a href="?page=logout">Logout</a>
        <a href="?page=peminjaman">Data Peminjaman</a>
        <a href="?page=laporan">Laporan ACC</a>
        <a href="?page=pemantauan">Pemantauan Pengembalian</a>
    </nav>
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
                <th>Overdue</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
        <?php
        $today = date('Y-m-d');
        foreach($peminjaman as $p):
            $overdue = (strtotime($p['tgl_kembali']) < strtotime($today)) ? 'Ya' : 'Tidak';
        ?>
            <tr>
                <td><?= $p['id'] ?></td>
                <td><?= htmlspecialchars($p['nama_lengkap']) ?></td>
                <td><?= htmlspecialchars($p['nama_alat']) ?></td>
                <td><?= $p['tgl_pinjam'] ?></td>
                <td><?= $p['tgl_kembali'] ?></td>
                <td>Dipinjam</td>
                <td style="color: <?= $overdue == 'Ya' ? 'red' : 'green' ?>;"><?= $overdue ?></td>
                <td>
                    <a href="?page=peminjaman&kembalikan=<?= $p['id'] ?>">Kembalikan</a>
                </td>
            </tr>
        <?php endforeach ?>
        </tbody>
    </table>
</body>
</html>