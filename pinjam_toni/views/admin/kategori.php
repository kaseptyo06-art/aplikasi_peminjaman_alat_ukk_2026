<!DOCTYPE html>
<html>
<head>
    <title>Daftar Kategori</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <div class="admin-page">
        <?php include __DIR__ . '/sidebar.php'; ?>
        <main class="admin-content">
            <div class="page-header">
                <h2>Daftar Kategori</h2>
                <a class="btn-logout" href="?page=logout">Logout</a>
            </div>
            <?php $isEdit = isset($edit); ?>
            <form method="post" action="">
                <input type="hidden" name="aksi" value="<?= $isEdit ? 'edit' : 'tambah' ?>">
                <?php if ($isEdit): ?>
                    <input type="hidden" name="id" value="<?= $edit['kategori_id'] ?>">
                <?php endif; ?>
                <input type="text" name="nama_kategori" placeholder="Nama Kategori" value="<?= $isEdit ? htmlspecialchars($edit['nama_kategori']) : '' ?>" required>
                <textarea name="deskripsi" placeholder="Deskripsi kategori" rows="3"><?= $isEdit ? htmlspecialchars($edit['deskripsi']) : '' ?></textarea>
                <button type="submit"><?= $isEdit ? 'Update' : 'Tambah' ?></button>
                <?php if ($isEdit): ?>
                    <a href="?page=kategori">Batal Edit</a>
                <?php endif; ?>
            </form>
            <table border="1" cellpadding="8" cellspacing="0">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama Kategori</th>
                <th>Deskripsi</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach($kategori as $k): ?>
            <tr>
                <td><?= $k['kategori_id'] ?></td>
                <td><?= htmlspecialchars($k['nama_kategori']) ?></td>
                <td><?= htmlspecialchars($k['deskripsi']) ?></td>
                <td>
                    <a href="?page=kategori&edit=<?= $k['kategori_id'] ?>">Edit</a> |
                    <a href="?page=kategori&delete=<?= $k['kategori_id'] ?>" onclick="return confirm('Yakin?')">Hapus</a>
                </td>
            </tr>
        <?php endforeach ?>
        </tbody>
    </table>
        </main>
    </div>
</body>
</html>