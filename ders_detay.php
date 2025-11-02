<?php
require_once 'includes/header.php'; 
require_once 'includes/veritabani.php'; 

$ders_id = $_GET['id'] ?? null;

if (!$ders_id || !is_numeric($ders_id)) {
    header("Location: dersler.php");
    exit();
}

$ders = null;

try {
    $sql = "SELECT ders_adi, detayli_icerik, fiyat, resim_yolu FROM dersler WHERE id = ?";
    $stmt = $db->prepare($sql);
    $stmt->execute([$ders_id]);
    $ders = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$ders) {
        header("Location: dersler.php?hata=ders_yok");
        exit();
    }

} catch (PDOException $e) {
    header("Location: dersler.php?hata=db_sorunu");
    exit();
}
?>

<div class="row">
    <div class="col-md-8">
        <h1 class="mb-3 text-primary"><?= htmlspecialchars($ders['ders_adi']) ?></h1>
        <hr>
        
        <div class="card card-body shadow-sm mb-4">
            <h4>Ders İçeriği</h4>
            <p><?= nl2br(htmlspecialchars($ders['detayli_icerik'])) ?></p>
        </div>

        </div>

    <div class="col-md-4">
        <div class="card text-center border-success shadow">
            <img src="assets/img/<?= htmlspecialchars($ders['resim_yolu'] ?? 'default.jpg') ?>" class="card-img-top" alt="<?= htmlspecialchars($ders['ders_adi']) ?>">
            <div class="card-body">
                <p class="display-5 fw-bold text-success mb-3"><?= number_format($ders['fiyat'], 2, ',', '.') ?> TL</p>
                
                <?php if (isset($_SESSION['kullanici_id'])): ?>
                    <a href="satin_al.php?ders_id=<?= $ders_id ?>" class="btn btn-lg btn-success w-100">Hemen Satın Al</a>
                <?php else: ?>
                    <div class="alert alert-warning">
                        Bu dersi satın almak için <a href="giris.php">Giriş Yapmalısınız</a>.
                    </div>
                <?php endif; ?>
                
                <p class="card-text text-muted mt-3"><small>Ödeme onaylandıktan sonra ders içeriğine anında erişim!</small></p>
            </div>
        </div>
    </div>
</div>

<a href="dersler.php" class="btn btn-outline-secondary mt-4">Tüm Derslere Geri Dön</a>

<?php
require_once 'includes/footer.php';
?>