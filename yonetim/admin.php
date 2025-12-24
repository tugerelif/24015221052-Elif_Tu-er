<?php
require_once '../includes/header.php'; 
require_once '../includes/veritabani.php'; 

if (!isset($_SESSION['kullanici_id']) || $_SESSION['rol'] !== 'admin') {
    header("Location: ../index.php"); 
    exit();
}
?>

<div class="container py-4">
    <h1 class="mb-4 fw-bold border-bottom pb-2 text-dark">Yönetim Paneli</h1>
    <p class="lead text-muted">Sistemdeki dersleri, kullanıcıları ve satışları buradan kontrol edebilirsiniz.</p>

    <div class="row mt-4">
        <div class="col-md-4 mb-4">
            <div class="card border-primary h-100 shadow-sm transition-hover">
                <div class="card-body text-center d-flex flex-column">
                    <i class="bi bi-journal-code text-primary display-4 mb-3"></i>
                    <h5 class="card-title fw-bold">Ders Yönetimi (CRUD)</h5>
                    <p class="card-text text-muted flex-grow-1">Ders ekle, düzenle, video linki yapıştır veya sil.</p>
                    <a href="dersler.php" class="btn btn-primary fw-bold">Dersleri Yönet</a>
                </div>
            </div>
        </div>
        
        <div class="col-md-4 mb-4">
            <div class="card border-info h-100 shadow-sm transition-hover">
                <div class="card-body text-center d-flex flex-column">
                    <i class="bi bi-people text-info display-4 mb-3"></i>
                    <h5 class="card-title fw-bold">Kullanıcı Yönetimi</h5>
                    <p class="card-text text-muted flex-grow-1">Sisteme kayıtlı tüm kullanıcıları ve yetkilerini gör.</p>
                    <a href="kullanicilar.php" class="btn btn-info text-white fw-bold">Kullanıcıları Gör</a>
                </div>
            </div>
        </div>
        
        <div class="col-md-4 mb-4">
            <div class="card border-success h-100 shadow-sm transition-hover">
                <div class="card-body text-center d-flex flex-column">
                    <i class="bi bi-cart-check text-success display-4 mb-3"></i>
                    <h5 class="card-title fw-bold">Sipariş Yönetimi</h5>
                    <p class="card-text text-muted flex-grow-1">Hangi ders kim tarafından satın alınmış takip et.</p>
                    <a href="siparisler.php" class="btn btn-success fw-bold">Siparişleri Takip Et</a>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .transition-hover { transition: transform 0.3s ease; border-width: 2px; }
    .transition-hover:hover { transform: translateY(-8px); box-shadow: 0 10px 20px rgba(0,0,0,0.1) !important; }
</style>

<?php require_once '../includes/footer.php'; ?>         