<!DOCTYPE html>
<html>
<head>
    <title>Ajukan Peminjaman Alat</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <h2>Ajukan Peminjaman Alat</h2>
    <nav class="navbar">
        <a href="?page=logout">Logout</a>
        <a href="?page=peminjaman">Ajukan Peminjaman</a>
        <a href="?page=status">Status Peminjaman</a>
        <a href="?page=riwayat">Riwayat Peminjaman</a>
    </nav>
    <form method="post" action="">
        <select name="id_alat" required>
            <option value="">- Pilih Alat -</option>
            <?php foreach($alat as $a): ?>
                <option value="<?= $a['alat_id'] ?>"><?= htmlspecialchars($a['nama_alat']) ?> (Stok: <?= $a['stok'] ?>)</option>
            <?php endforeach ?>
        </select>
        <input type="date" name="tgl_pinjam" required>
        <input type="date" name="tgl_kembali" required>
        <button type="submit">Ajukan Pinjam</button>
    </form>
</body>
</html>
