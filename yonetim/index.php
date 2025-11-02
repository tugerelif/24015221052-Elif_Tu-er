<?php
require_once '../includes/header.php'; 
require_once '../includes/veritabani.php'; 

if (!isset($_SESSION['kullanici_id']) || $_SESSION['rol'] !== 'admin') {
    header("Location: ../index.php"); 
    exit();
}
?>

<h1 class="mb-4">Yönetim Paneli - Hoş Geldiniz</h1>
<p class="lead">Bu bölümden dersleri, kullanıcıları ve siparişleri yönetebilirsiniz.</p>

<div class="row">
    <div class="col-md-4 mb-4">
        <div class="card border-primary h-100">
            <div class="card-body">
                <h5 class="card-title">Ders Yönetimi (CRUD)</h5>
                <p class="card-text">Yeni ders ekleyin, mevcut dersleri düzenleyin veya silin.</p>
                <a href="dersler.php" class="btn btn-primary">Derslere Git</a>
            </div>
        </div>
    </div>
    
    <div class="col-md-4 mb-4">
        <div class="card border-secondary h-100">
            <div class="card-body">
                <h5 class="card-title">Kullanıcı Yönetimi</h5>
                <p class="card-text">Kayıtlı kullanıcıları görüntüleyin (Admin/Müşteri).</p>
                <a href="#" class="btn btn-secondary disabled">Çok Yakında</a>
            </div>
        </div>
    </div>
    
    <div class="col-md-4 mb-4">
        <div class="card border-success h-100">
            <div class="card-body">
                <h5 class="card-title">Sipariş Yönetimi</h5>
                <p class="card-text">Tüm kullanıcı siparişlerini takip edin.</p>
                <a href="#" class="btn btn-success disabled">Çok Yakında</a>
            </div>
        </div>
    </div>
</div>

<?php
require_once '../includes/footer.php';
?>