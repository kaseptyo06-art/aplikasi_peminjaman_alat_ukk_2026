<!DOCTYPE html>
<html>
<head>
    <title>Data Peminjaman - Petugas</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <h2>Data Peminjaman Alat</h2>
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
                <th>Aksi</th>
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
                <td><?= $p['status'] ?></td>
                <td>
                    <?php if(strtolower($p['status']) == 'menunggu'): ?>
                        <a href="?page=peminjaman&setujui=<?= $p['id'] ?>">Setujui</a> | 
                        <a href="?page=peminjaman&tolak=<?= $p['id'] ?>">Tolak</a>
                    <?php elseif(strtolower($p['status']) == 'dipinjam'): ?>
                        <a href="?page=peminjaman&kembalikan=<?= $p['id'] ?>">Kembalikan</a>
                    <?php else: ?>
                        -
                    <?php endif ?>
                </td>
            </tr>
        <?php endforeach ?>
        </tbody>
    </table>
</body>
</html>