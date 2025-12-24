<?php
require_once '../includes/header.php'; 
require_once '../includes/veritabani.php'; 

// Sadece admin ve egitmen girebilir
if (!isset($_SESSION['kullanici_id']) || !in_array($_SESSION['rol'], ['admin', 'egitmen'])) {
    header("Location: ../index.php"); 
    exit();
}
?>

<div class="container py-4">
    <h1 class="mb-4 fw-bold border-bottom pb-2">Yönetim Paneli</h1>
    <div class="row mt-4">
        <div class="col-md-4 mb-4">
            <div class="card border-primary h-100 shadow-sm border-2">
                <div class="card-body text-center d-flex flex-column">
                    <i class="bi bi-journal-code text-primary display-4 mb-3"></i>
                    <h5 class="card-title fw-bold">Ders & Video Yönetimi</h5>
                    <p class="card-text text-muted">Ders ekleyebilir ve videoları güncelleyebilirsiniz.</p>
                    <a href="dersler.php" class="btn btn-primary mt-auto fw-bold">Derslere Git</a>
                </div>
            </div>
        </div>
        
        <?php if ($_SESSION['rol'] === 'admin'): ?>
        <div class="col-md-4 mb-4">
            <div class="card border-info h-100 shadow-sm border-2">
                <div class="card-body text-center d-flex flex-column">
                    <i class="bi bi-people text-info display-4 mb-3"></i>
                    <h5 class="card-title fw-bold text-info">Kullanıcı Yönetimi</h5>
                    <p class="card-text text-muted">Kullanıcı listesi ve yetki ayarları.</p>
                    <a href="kullanicilar.php" class="btn btn-info text-white mt-auto fw-bold">Yönet</a>
                </div>
            </div>
        </div>
        <?php endif; ?>
    </div>
</div>

<?php require_once '../includes/footer.php'; ?>