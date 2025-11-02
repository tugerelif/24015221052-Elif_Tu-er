<?php
require_once 'includes/header.php'; 
require_once 'includes/veritabani.php'; 

$hata_mesaji = '';
$dersler = [];

try {
    $sql = "SELECT id, ders_adi, kisa_aciklama, fiyat, resim_yolu FROM dersler ORDER BY fiyat ASC";
    $stmt = $db->query($sql);
    $dersler = $stmt->fetchAll(PDO::FETCH_ASSOC);

} catch (PDOException $e) {
    $hata_mesaji = "Dersler yüklenirken bir hata oluştu.";
}

$ders_sayisi = count($dersler);
?>

<h1 class="mb-4 text-center">Tüm Kodlama Derslerimiz (<?= $ders_sayisi ?> Adet)</h1>

<?php if ($hata_mesaji): ?>
    <div class="alert alert-danger text-center"><?= $hata_mesaji ?></div>
<?php endif; ?>

<div class="row row-cols-1 row-cols-md-3 g-4">
    <?php if ($ders_sayisi > 0): ?>
        <?php foreach ($dersler as $ders): ?>
            <div class="col">
                <div class="card h-100 shadow-sm">
                    <img src="assets/img/<?= htmlspecialchars($ders['resim_yolu'] ?? 'default.jpg') ?>" class="card-img-top" alt="<?= htmlspecialchars($ders['ders_adi']) ?>">
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title text-primary"><?= htmlspecialchars($ders['ders_adi']) ?></h5>
                        <p class="card-text text-muted flex-grow-1"><?= htmlspecialchars($ders['kisa_aciklama']) ?></p>
                        
                        <div class="d-flex justify-content-between align-items-center mt-3">
                            <span class="fs-4 fw-bold text-success"><?= number_format($ders['fiyat'], 2, ',', '.') ?> TL</span>
                            <a href="ders_detay.php?id=<?= $ders['id'] ?>" class="btn btn-sm btn-info text-white">Detayları Gör</a>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <div class="col-12 text-center">
            <p class="alert alert-warning">Sistemde henüz yayınlanmış ders bulunmamaktadır.</p>
        </div>
    <?php endif; ?>
</div>

<?php
require_once 'includes/footer.php';
?>