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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>TechAcademy - Kodlama Dersleri E-Ticaret Sitesi</title>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container">
    <a class="navbar-brand" href="index.php">TechAcademy</a>
    
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav me-auto">
        <li class="nav-item">
          <a class="nav-link" href="dersler.php">Tüm Dersler</a>
        </li>
      </ul>
      
      <ul class="navbar-nav">
        <?php if (isset($_SESSION['kullanici_id'])): ?>
            <li class="nav-item">
                <a class="nav-link" href="profilim.php">Hoş Geldin, <?= htmlspecialchars(explode(' ', $_SESSION['ad_soyad'] ?? 'Kullanıcı')[0]) ?></a>
            </li>
            
            <?php if (isset($_SESSION['rol']) && $_SESSION['rol'] === 'admin'): ?>
                <li class="nav-item">
                    <a class="nav-link text-warning" href="yonetim/index.php">Yönetim Paneli</a>
                </li>
            <?php endif; ?>
            <li class="nav-item">
                <a class="nav-link" href="cikis.php">Çıkış Yap</a>
            </li>
        <?php else: ?>
            <li class="nav-item">
                <a class="nav-link" href="giris.php">Giriş Yap</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="kayit.php">Kayıt Ol</a>
            </li>
        <?php endif; ?>
      </ul>
    </div>
  </div>
</nav>

<main class="container my-4">