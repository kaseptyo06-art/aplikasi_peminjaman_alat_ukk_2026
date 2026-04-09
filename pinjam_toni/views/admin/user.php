<!DOCTYPE html>
<html>
<head>
    <title>CRUD User</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <div class="admin-page">
        <?php include __DIR__ . '/sidebar.php'; ?>
        <main class="admin-content">
            <div class="page-header">
                <h2>Data User</h2>
                <a class="btn-logout" href="?page=logout">Logout</a>
            </div>
            <?php $isEdit = isset($edit); ?>
    <form method="post" action="">
        <input type="hidden" name="aksi" value="<?= $isEdit ? 'edit' : 'tambah' ?>">
        <?php if ($isEdit): ?>
            <input type="hidden" name="id" value="<?= $edit['user_id'] ?>">
        <?php endif; ?>
        <input type="text" name="nama_lengkap" placeholder="Nama Lengkap" value="<?= $isEdit ? htmlspecialchars($edit['nama_lengkap']) : '' ?>" required>
        <input type="text" name="username" placeholder="Username" value="<?= $isEdit ? htmlspecialchars($edit['username']) : '' ?>" required>
        <?php if (!$isEdit): ?>
            <input type="password" name="password" placeholder="Password" required>
        <?php endif; ?>
        <select name="level" required>
            <option value="">- Pilih Level -</option>
            <?php foreach(['Admin','Petugas','Peminjam'] as $l): ?>
                <option value="<?= $l ?>" <?= $isEdit && $edit['level'] == $l ? 'selected' : '' ?>><?= ucfirst($l) ?></option>
            <?php endforeach ?>
        </select>
        <button type="submit"><?= $isEdit ? 'Update' : 'Tambah' ?></button>
        <?php if ($isEdit): ?>
            <a href="?page=users">Batal Edit</a>
        <?php endif; ?>
    </form>
    <br>

    <!-- Tabel User -->
    <table border="1" cellpadding="8" cellspacing="0">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama Lengkap</th>
                <th>Username</th>
                <th>Level</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($users as $u): ?>
            <tr>
                <td><?= $u['user_id'] ?></td>
                <td><?= htmlspecialchars($u['nama_lengkap']) ?></td>
                <td><?= htmlspecialchars($u['username']) ?></td>
                <td><?= $u['level'] ?></td>
                <td>
                    <a href="?page=users&edit=<?= $u['user_id'] ?>">Edit</a> | 
                    <a href="?page=users&delete=<?= $u['user_id'] ?>" onclick="return confirm('Hapus user ini?')">Hapus</a>
                </td>
            </tr>
            <?php endforeach ?>
        </tbody>
    </table>
        </main>
    </div>
</body>
</html>