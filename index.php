<?php
require_once 'includes/header.php';
require_once 'includes/veritabani.php';

$anasayfa_dersler = [];
try {  
    $sql = "SELECT id, ders_adi, kisa_aciklama, fiyat, resim_yolu, video FROM dersler LIMIT 6";
    $stmt = $db->prepare($sql);
    $stmt->execute();
    $anasayfa_dersler = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo '<div class="alert alert-danger">Hata: ' . $e->getMessage() . '</div>';
}
?>

<div class="p-5 mb-4 bg-dark text-white rounded-3 shadow-lg">
    <div class="container-fluid py-5 text-center">
        <h1 class="display-5 fw-bold text-warning">TechAcademy'ye Hoş Geldiniz!</h1>
        <p class="col-md-8 fs-4 mx-auto text-light">Sektörün en güncel kodlama dersleriyle kariyerinize başlayın veya kendinizi geliştirin.</p>
        <a class="btn btn-warning btn-lg px-4 fw-bold" href="dersler.php" role="button">Tüm Dersleri İncele</a>
    </div>
</div>

<div class="container">
    <h2 class="mb-4 text-center fw-bold text-dark border-bottom pb-3">Öne Çıkan Derslerimiz</h2>

    <div class="row row-cols-1 row-cols-md-3 g-4">
        <?php if (count($anasayfa_dersler) > 0): ?>
            <?php foreach ($anasayfa_dersler as $ders): ?>
                <div class="col">
                    <div class="card h-100 shadow border-0 transition-hover">
                       <?php 
    // Resim yolunun içeriğini kontrol et
    $resim = $ders['resim_yolu'] ?? 'default.jpg';
    
    // Eğer http ile başlıyorsa internet linkidir, değilse yerel klasörüdür
    $resim_src = (strpos($resim, 'http') === 0) ? $resim : "assets/img/" . $resim;
?>
<img src="<?= $resim_src ?>" class="card-img-top" style="height: 200px; object-fit: cover;">
                        <div class="card-body">
                            <h5 class="card-title fw-bold text-primary"><?= htmlspecialchars($ders['ders_adi']) ?></h5>
                            <p class="card-text text-muted small"><?= htmlspecialchars($ders['kisa_aciklama']) ?></p>
                            
                            <?php if (!empty($ders['video'])): ?>
                                <span class="badge bg-success"><i class="bi bi-play-circle"></i> Video İçerikli</span>
                            <?php endif; ?>
                        </div>
                        
                        <div class="card-footer bg-transparent border-0 d-flex justify-content-between align-items-center pb-3">
                            <span class="fs-4 fw-bold text-dark"><?= number_format($ders['fiyat'], 2, ',', '.') ?> TL</span>
                            <a href="ders_detay.php?id=<?= $ders['id'] ?>" class="btn btn-primary btn-sm px-3">Detaylar</a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="col-12 text-center">
                <div class="alert alert-info">Şu an gösterilecek ders bulunmuyor.</div>
            </div>
        <?php endif; ?>
    </div>
</div>
<style>
    .transition-hover {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    .transition-hover:hover {
        transform: translateY(-8px);
        box-shadow: 0 10px 20px rgba(0,0,0,0.15) !important;
    }
    body {
        background-color: #f4f7f6;
    }
</style>

<?php
require_once 'includes/footer.php';
?>