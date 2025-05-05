<?php
  session_start();
  if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit();
  }

  $username = $_SESSION['username'];
  $email = $_SESSION['email'] ?? 'nincs email';
  $role = $_SESSION['role'] ?? 'felhasználó';
?>

<?php include('../../views/header.php'); ?>

<div class="content-box">
  <h2 class="section-title">Profilod</h2>

  <div class="card">
    <p><strong>Felhasználónév:</strong> <?= htmlspecialchars($username) ?></p>
    <p><strong>Email:</strong> <?= htmlspecialchars($email) ?></p>
    <p><strong>Szerepkör:</strong> <?= htmlspecialchars($role) ?></p>
  </div>

  <div class="card">
    <h3 class="section-title">Beállítások</h3>
    <a class="btn primary" href="resetPassword.php">Jelszó módosítása</a>
    <a class="btn primary" href="../../controllers/logout.php" style="margin-left: 1rem;">Kijelentkezés</a>
  </div>
</div>

<?php include('../../views/footer.php'); ?>
