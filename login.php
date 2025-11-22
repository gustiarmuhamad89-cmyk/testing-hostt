<?php

session_start();

// Contoh data user (demo). Di produksi, ambil dari database.
$users = [
    // username => password_hash('password123', PASSWORD_DEFAULT)
    'admin' => password_hash('password123', PASSWORD_DEFAULT),
    'user'  => password_hash('rahasia', PASSWORD_DEFAULT)
];

$errors = [];

// Jika user sudah login, arahkan ke dashboard
if (isset($_SESSION['username'])) {
    header('Location: dashboard.php');
    exit;
}

// Proses form POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = isset($_POST['username']) ? trim($_POST['username']) : '';
    $password = isset($_POST['password']) ? $_POST['password'] : '';

    if ($username === '' || $password === '') {
        $errors[] = "Username dan password harus diisi.";
    } else {
        if (array_key_exists($username, $users)) {
            $stored_hash = $users[$username];
            if (password_verify($password, $stored_hash)) {
                // Login sukses
                session_regenerate_id(true);
                $_SESSION['username'] = $username;
                // Kamu bisa menyimpan info lain di session jika perlu
                header('Location: dashboard.php');
                exit;
            } else {
                $errors[] = "Password salah.";
            }
        } else {
            $errors[] = "Username tidak ditemukan.";
        }
    }
}
?>
<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>Login</title>
  <style>
    body { font-family: Arial, sans-serif; background:#f5f5f5; display:flex; align-items:center; justify-content:center; height:100vh; margin:0; }
    .card { background:#fff; padding:24px; border-radius:8px; box-shadow:0 6px 18px rgba(0,0,0,0.08); width:320px; }
    h2 { margin-top:0; }
    .input { width:100%; padding:10px; margin:8px 0; box-sizing:border-box; border:1px solid #ccc; border-radius:4px; }
    .btn { width:100%; padding:10px; border:0; border-radius:6px; cursor:pointer; background:#2d89ef; color:#fff; font-weight:bold; }
    .errors { background:#ffe6e6; color:#900; padding:8px; border-radius:4px; margin-bottom:10px; }
    .small { font-size:0.9rem; color:#666; margin-top:8px; display:block; text-align:center; }
  </style>
</head>
<body>
  <div class="card">
    <h2>Masuk</h2>

    <?php if (!empty($errors)): ?>
      <div class="errors">
        <?php foreach ($errors as $err): ?>
          <div><?=htmlspecialchars($err)?></div>
        <?php endforeach; ?>
      </div>
    <?php endif; ?>

    <form method="post" action="login.php" novalidate>
      <input class="input" type="text" name="username" placeholder="Username" value="<?= isset($username) ? htmlspecialchars($username) : '' ?>">
      <input class="input" type="password" name="password" placeholder="Password">
      <button class="btn" type="submit">Login</button>
    </form>

    <span class="small">Contoh akun demo: <strong>admin / password123</strong> atau <strong>user / rahasia</strong></span>
  </div>
</body>
</html>
