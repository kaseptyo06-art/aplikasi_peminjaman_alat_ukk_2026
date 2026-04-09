<!DOCTYPE html>
<html>
<head>
  <title>Login Aplikasi Peminjaman Alat</title>
  <link rel="stylesheet" href="assets/css/style.css">
  <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate">
  <meta http-equiv="Pragma" content="no-cache">
  <meta http-equiv="Expires" content="0">
</head>
<body>
  <h2 class="auth-form">Login</h2>
  <?php if (!empty($error)) echo "<p>$error</p>"; ?>
  <form class="auth-form" method="post" action="?page=login">
    <input type="text" name="username" placeholder="Username" required><br>
    <input type="password" name="password" placeholder="Password" required><br>
    <button type="submit">Login</button>
  </form>
  <p class="auth-form">Belum punya akun? <a href="?page=register">Register</a></p>
  <script>
    // Prevent back button after logout
    window.history.replaceState(null, null, window.location.href);
    window.addEventListener('popstate', function(event) {
      window.history.replaceState(null, null, window.location.href);
    });
  </script>
</body>
</html>