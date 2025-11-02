<?php
require_once 'includes/header.php'; 
require_once 'includes/veritabani.php'; 

if (!isset($_SESSION['kullanici_id'])) {
    $_SESSION['hata_mesaji'] = "Profilinizi görmek için lütfen giriş yapın.";
    header("Location: giris.php");
    exit();
}

$kullanici_id = $_SESSION['kullanici_id'];
$siparisler = [];

try {
    $sql = "SELECT d.ders_adi, d.fiyat, s.siparis_tarihi
            FROM siparisler s
            INNER JOIN dersler d ON s.ders_id = d.id
            WHERE s.kullanici_id = ?
            ORDER BY s.siparis_tarihi DESC";
            
    $stmt = $db->prepare($sql);
    $stmt->execute([$kullanici_id]);
    $siparisler = $stmt->fetchAll(PDO::FETCH_ASSOC);

} catch (PDOException $e) {
    $hata_mesaji = "Sipariş geçmişiniz yüklenirken bir hata oluştu.";
}
?>

<h1 class="mb-4 text-primary">Hoş Geldiniz, <?= htmlspecialchars($_SESSION['ad_soyad']) ?></h1>
<p class="lead">Bu sayfadan satın aldığınız dersleri ve profil bilgilerinizi yönetebilirsiniz.</p>

<div class="row">
    <div class="col-md-4">
        <div class="card shadow-sm mb-4">
            <div class="card-header bg-info text-white">
                Hesap Bilgileri
            </div>
            <div class="card-body">
                <p><strong>Ad Soyad:</strong> <?= htmlspecialchars($_SESSION['ad_soyad']) ?></p>
                <p><strong>Yetki Seviyesi:</strong> <?= htmlspecialchars(ucfirst($_SESSION['rol'])) ?></p>
            </div>
        </div>
    </div>
    
    <div class="col-md-8">
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white">
                Satın Alınan Dersler (Ödevin Sipariş Kısmı)
            </div>
            <div class="card-body">
                <?php if (!empty($siparisler)): ?>
                    <ul class="list-group list-group-flush">
                        <?php foreach ($siparisler as $siparis): ?>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <div>
                                    <h6 class="mb-1"><?= htmlspecialchars($siparis['ders_adi']) ?></h6>
                                    <small class="text-muted">Tarih: <?= date('d/m/Y H:i', strtotime($siparis['siparis_tarihi'])) ?></small>
                                </div>
                                <span class="badge bg-success rounded-pill"><?= number_format($siparis['fiyat'], 2, ',', '.') ?> TL</span>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                <?php else: ?>
                    <p class="alert alert-warning text-center">Henüz satın alınmış dersiniz bulunmamaktadır.</p>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<?php
require_once 'includes/footer.php';
?>