<?php 
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <title>TechAcademy</title>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm">
  <div class="container">
    <a class="navbar-brand text-warning fw-bold" href="index.php"><i class="bi bi-code-slash"></i> TechAcademy</a>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav me-auto">
        <li class="nav-item"><a class="nav-link" href="dersler.php">Tüm Dersler</a></li>
      </ul>
      <ul class="navbar-nav ms-auto align-items-center">
        <?php if (isset($_SESSION['kullanici_id'])): ?>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle fw-bold text-light" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown">
                    <i class="bi bi-person-circle text-warning"></i> <?= htmlspecialchars(explode(' ', $_SESSION['ad_soyad'] ?? 'Kullanıcı')[0]) ?>
                </a>
                <ul class="dropdown-menu dropdown-menu-end shadow border-0">
                    <li><a class="dropdown-item" href="profil.php"><i class="bi bi-person"></i> Profilim</a></li>
                    <?php if (isset($_SESSION['rol']) && ($_SESSION['rol'] === 'admin' || $_SESSION['rol'] === 'egitmen')): ?>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item text-primary fw-bold" href="yonetim/index.php"><i class="bi bi-speedometer2"></i> Yönetim Paneli</a></li>
                    <?php endif; ?>
                    <li><hr class="dropdown-divider"></li>
                    <li><a class="dropdown-item text-danger" href="cikis.php"><i class="bi bi-box-arrow-right"></i> Çıkış Yap</a></li>
                </ul>
            </li>
        <?php else: ?>
            <li class="nav-item"><a class="nav-link" href="giris.php">Giriş Yap</a></li>
            <li class="nav-item"><a class="btn btn-outline-warning btn-sm ms-2" href="kayit.php">Kayıt Ol</a></li>
        <?php endif; ?>
      </ul>
    </div>
  </div>
</nav>
<main class="container my-5">