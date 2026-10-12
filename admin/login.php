<?php
session_start();
if (!empty($_SESSION['admin_logged_in'])) {
    header("Location: index.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login Admin | S1 Pendidikan Bahasa Inggris</title>
  <link rel="icon" type="image/png" href="../img/Logo_UPGRI.png">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@500;600;700;800&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="admin.css">
</head>
<body class="login-page-body">

  <div class="login-card">
    <div class="login-brand-header">
      <img src="../img/Logo_UPGRI.png" alt="Logo Universitas PGRI Pontianak">
      <h1>Panel Admin</h1>
      <p>S1 Pendidikan Bahasa Inggris &bull; FPBS UPGRI Pontianak</p>
    </div>

    <div id="error-alert" class="login-alert-error" role="alert"></div>

    <form id="login-form">
      <div class="form-group">
        <label class="form-label" for="username">Username Admin</label>
        <input type="text" id="username" class="form-input" placeholder="Masukkan username" required autofocus autocomplete="username">
      </div>

      <div class="form-group" style="margin-bottom: 1.5rem;">
        <label class="form-label" for="password">Password</label>
        <input type="password" id="password" class="form-input" placeholder="Masukkan password" required autocomplete="current-password">
      </div>

      <button type="submit" class="btn-action btn-primary" style="width: 100%; min-height: 44px;">
        Masuk ke Panel Admin
      </button>

      <div class="form-hint" style="text-align: center; margin-top: 0.85rem;">
        Kredensial default: <code>admin</code> / <code>admin123</code>
      </div>
    </form>

    <div class="login-footer-link">
      <a href="../index.php">Kembali ke Website Utama</a>
    </div>
  </div>

  <script>
    document.getElementById('login-form').addEventListener('submit', async (e) => {
      e.preventDefault();
      const errEl = document.getElementById('error-alert');
      errEl.style.display = 'none';

      const username = document.getElementById('username').value.trim();
      const password = document.getElementById('password').value.trim();

      if (!username || !password) {
        errEl.innerText = 'Username dan password wajib diisi.';
        errEl.style.display = 'block';
        return;
      }

      try {
        const res = await fetch('../api/api.php?action=login', {
          method: 'POST',
          headers: { 'Content-Type': 'application/json' },
          body: JSON.stringify({ username, password })
        });
        const data = await res.json();

        if (res.ok && data.success) {
          window.location.href = 'index.php';
        } else {
          errEl.innerText = data.message || 'Login gagal. Periksa kembali username dan password.';
          errEl.style.display = 'block';
        }
      } catch (err) {
        errEl.innerText = 'Terjadi kesalahan jaringan atau koneksi ke server.';
        errEl.style.display = 'block';
      }
    });
  </script>
</body>
</html>
