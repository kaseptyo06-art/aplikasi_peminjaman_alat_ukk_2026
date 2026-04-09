<!DOCTYPE html>
<html>
<head>
    <title>CRUD Alat</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <div class="admin-page">
        <?php include __DIR__ . '/sidebar.php'; ?>
        <main class="admin-content">
            <div class="page-header">
                <h2>Data Alat</h2>
                <a class="btn-logout" href="?page=logout">Logout</a>
            </div>
            <?php $isEdit = isset($edit); ?>
    <form method="post" action="" enctype="multipart/form-data">
        <input type="hidden" name="aksi" value="<?= $isEdit ? 'edit' : 'tambah' ?>">
        <?php if ($isEdit): ?>
            <input type="hidden" name="id" value="<?= $edit['alat_id'] ?>">
        <?php endif; ?>
        <input type="text" name="nama_alat" placeholder="Nama Alat" value="<?= $isEdit ? htmlspecialchars($edit['nama_alat']) : '' ?>" required>
        <input type="number" name="stok" placeholder="Stok" value="<?= $isEdit ? $edit['stok'] : '' ?>" required>
        <select name="id_kategori" required>
            <option value="">- Pilih Kategori -</option>
            <?php foreach($kategori as $k): ?>
                <option value="<?= $k['kategori_id'] ?>" <?= $isEdit && $k['kategori_id'] == $edit['kategori_id'] ? 'selected' : '' ?>>
                    <?= htmlspecialchars($k['nama_kategori']) ?>
                </option>
            <?php endforeach ?>
        </select>
        <label class="upload-label">Foto Alat (jpg/png/gif)</label>
        <input type="file" name="gambar" accept="image/*">
        <?php if ($isEdit && !empty($edit['gambar'])): ?>
            <div class="image-preview">
                <img src="assets/uploads/<?= htmlspecialchars($edit['gambar']) ?>" alt="Preview" />
            </div>
        <?php endif; ?>
        <button type="submit"><?= $isEdit ? 'Update' : 'Tambah' ?></button>
        <?php if ($isEdit): ?>
            <a href="?page=alat">Batal Edit</a>
        <?php endif; ?>
    </form>
    <br>

    <!-- Tabel Alat -->
    <table border="1" cellpadding="8" cellspacing="0">
        <thead>
            <tr>
                <th>ID</th>
                <th>Foto</th>
                <th>Nama Alat</th>
                <th>Stok</th>
                <th>Kategori</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach($alat as $a): ?>
            <tr>
                <td><?= $a['alat_id'] ?></td>
                <td>
                    <?php if (!empty($a['gambar'])): ?>
                        <img class="table-thumb" src="assets/uploads/<?= htmlspecialchars($a['gambar']) ?>" alt="<?= htmlspecialchars($a['nama_alat']) ?>">
                    <?php else: ?>
                        -
                    <?php endif; ?>
                </td>
                <td><?= htmlspecialchars($a['nama_alat']) ?></td>
                <td><?= $a['stok'] ?></td>
                <td><?= $a['nama_kategori'] ?></td>
                <td>
                    <a href="?page=alat&edit=<?= $a['alat_id'] ?>">Edit</a> | 
                    <a href="?page=alat&delete=<?= $a['alat_id'] ?>" onclick="return confirm('Hapus alat ini?')">Hapus</a>
                </td>
            </tr>
        <?php endforeach ?>
        </tbody>
    </table>
        </main>
    </div>
</body>
</html>