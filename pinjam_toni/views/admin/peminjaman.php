<!DOCTYPE html>
<html>
<head>
    <title>Data Peminjaman</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <div class="admin-page">
        <?php include __DIR__ . '/sidebar.php'; ?>
        <main class="admin-content">
            <div class="page-header">
                <h2>Data Peminjaman</h2>
                <a class="btn-logout" href="?page=logout">Logout</a>
            </div>
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
                        <td><?= $p['id_peminjaman'] ?></td>
                        <td><?= htmlspecialchars($p['nama_lengkap']) ?></td>
                        <td><?= htmlspecialchars($p['nama_alat']) ?></td>
                        <td><?= $p['tgl_pinjam'] ?></td>
                        <td><?= $p['tgl_kembali'] ?? '' ?></td>
                        <td><?= $p['status'] ?></td>
                        <td>
                            <?php if(strtolower($p['status']) == 'menunggu'): ?>
                                <a href="?page=peminjaman&setujui=<?= $p['id_peminjaman'] ?>">Setujui</a> |
                                <a href="?page=peminjaman&tolak=<?= $p['id_peminjaman'] ?>">Tolak</a>
                            <?php elseif(strtolower($p['status']) == 'dipinjam'): ?>
                                <a href="?page=peminjaman&kembalikan=<?= $p['id_peminjaman'] ?>">Kembalikan</a>
                            <?php else: ?>
                                -
                            <?php endif ?>
                        </td>
                    </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </main>
    </div>
</body>
</html>