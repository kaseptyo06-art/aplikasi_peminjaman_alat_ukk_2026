<!DOCTYPE html>
<html>
<head>
    <title>Riwayat Peminjaman</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <h2>Riwayat Peminjaman Saya</h2>
    <nav class="navbar">
        <a href="?page=logout">Logout</a>
        <a href="?page=peminjaman">Ajukan Peminjaman</a>
        <a href="?page=status">Status Peminjaman</a>
        <a href="?page=riwayat">Riwayat Peminjaman</a>
    </nav>
    <table border="1" cellpadding="8" cellspacing="0">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama Alat</th>
                <th>Tgl Pinjam</th>
                <th>Tgl Kembali</th>
                <th>Status</th>
                <th>Denda</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach($riwayat as $p): ?>
            <tr>
                <td><?= $p['id'] ?></td>
                <td><?= htmlspecialchars($p['nama_alat']) ?></td>
                <td><?= $p['tgl_pinjam'] ?></td>
                <td><?= $p['tgl_kembali'] ?></td>
                <td><?= $p['status'] ?></td>
                <td>Rp <?= number_format($p['total_denda'] ?? 0, 0, ',', '.') ?></td>
            </tr>
        <?php endforeach ?>
        </tbody>
    </table>
</body>
</html>