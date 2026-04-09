<!DOCTYPE html>
<html>
<head>
    <title>Pengajuan & Riwayat Pinjam Alat</title>
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
    <div class="alat-grid">
        <?php foreach($alat as $a): ?>
            <div class="alat-card">
                <?php if (!empty($a['gambar'])): ?>
                    <img src="assets/uploads/<?= htmlspecialchars($a['gambar']) ?>" alt="<?= htmlspecialchars($a['nama_alat']) ?>">
                <?php else: ?>
                    <div class="image-placeholder">No Image</div>
                <?php endif; ?>
                <div class="alat-card-body">
                    <h3><?= htmlspecialchars($a['nama_alat']) ?></h3>
                    <p class="kategori-chip"><?= htmlspecialchars($a['nama_kategori']) ?></p>
                    <p class="stok-label">Stok: <span><?= $a['stok'] ?></span></p>
                    <button class="btn-primary" onclick="openModal(<?= $a['alat_id'] ?>, '<?= htmlspecialchars($a['nama_alat']) ?>', <?= $a['denda_per_hari'] ?>)">Pilih Alat</button>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
    <br>
    <!-- Modal untuk peminjaman -->
    <div id="pinjamModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeModal()">&times;</span>
            <h3 id="modalTitle">Ajukan Peminjaman</h3>
            <form method="post" action="">
                <input type="hidden" name="aksi" value="ajukan">
                <input type="hidden" id="modalAlatId" name="id_alat" value="">
                <p><strong>Alat:</strong> <span id="modalAlatNama"></span></p>
                <label for="tgl_pinjam">Tanggal Pinjam:</label>
                <input type="date" id="tgl_pinjam" name="tgl_pinjam" required>
                <label for="tgl_kembali">Tanggal Kembali:</label>
                <input type="date" id="tgl_kembali" name="tgl_kembali" required>
                <p class="denda-info"><strong>Denda per hari jika telat:</strong> Rp <span id="modalDenda"></span></p>
                <button type="submit">Ajukan Pinjam</button>
            </form>
        </div>
    </div>

    <h2>Riwayat Peminjaman Saya</h2>
    <table border="1" cellpadding="8" cellspacing="0">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama Alat</th>
                <th>Tgl Pinjam</th>
                <th>Tgl Kembali</th>
                <th>Status</th>
                <th>Aksi</th>
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
                <td>
                    <?php if(strtolower($p['status']) == 'dipinjam'): ?>
                        <a href="?page=peminjaman&kembalikan=<?= $p['id'] ?>" onclick="return confirm('Kembalikan alat ini?')">Kembalikan</a>
                    <?php else: ?>
                        -
                    <?php endif ?>
                </td>
            </tr>
        <?php endforeach ?>
        </tbody>
    </table>

    <script>
        function openModal(alatId, namaAlat, denda) {
            document.getElementById('modalAlatId').value = alatId;
            document.getElementById('modalAlatNama').textContent = namaAlat;
            document.getElementById('modalDenda').textContent = denda.toLocaleString('id-ID');
            document.getElementById('pinjamModal').style.display = 'block';
        }

        function closeModal() {
            document.getElementById('pinjamModal').style.display = 'none';
        }

        // Close modal when clicking outside
        window.onclick = function(event) {
            if (event.target == document.getElementById('pinjamModal')) {
                closeModal();
            }
        }
    </script>
</body>
</html>