<!DOCTYPE html>
<html>
<head>
  <title>Register Aplikasi Peminjaman Alat</title>
  <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
  <h2>Register</h2>
  <?php if (!empty($error)) echo "<p>$error</p>"; ?>
  <form class="auth-form" method="post" action="?page=register">
    <input type="text" name="nama_lengkap" placeholder="Nama Lengkap" required><br>
    <input type="text" name="username" placeholder="Username" required><br>
    <input type="password" name="password" placeholder="Password" required><br>
    <select name="level" required>
      <option value="">- Pilih Level -</option>
      <option value="Admin">Admin</option>
      <option value="Petugas">Petugas</option>
      <option value="Peminjam">Peminjam</option>
    </select><br>
    <button type="submit">Register</button>
  </form>
  <p>Sudah punya akun? <a href="?page=login">Login</a></p>
</body>
</html>