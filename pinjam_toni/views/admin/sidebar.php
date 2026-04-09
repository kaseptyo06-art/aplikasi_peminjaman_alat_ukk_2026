<aside class="admin-sidebar">
    <div class="sidebar-brand">Straw Hat Crew</div>
    <?php $currentPage = $_GET['page'] ?? 'users'; ?>
    <nav>
        <a href="?page=users" class="<?= $currentPage === 'users' ? 'active' : '' ?>">Users</a>
        <a href="?page=alat" class="<?= $currentPage === 'alat' ? 'active' : '' ?>">Alat</a>
        <a href="?page=kategori" class="<?= $currentPage === 'kategori' ? 'active' : '' ?>">Kategori</a>
        <a href="?page=peminjaman" class="<?= $currentPage === 'peminjaman' ? 'active' : '' ?>">Peminjaman</a>
    </nav>
</aside>