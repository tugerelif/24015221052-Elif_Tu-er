<?php
require_once 'includes/header.php';
require_once 'includes/veritabani.php';

$dersler = [];
try {
    $sql = "SELECT id, ders_adi, kisa_aciklama, fiyat, resim_yolu FROM dersler ORDER BY fiyat ASC";
    $stmt = $db->query($sql);
    $dersler = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) { echo "Hata!"; }
?>

<h1 class="mb-4 text-center fw-bold">Tüm Kodlama Derslerimiz</h1>

<div class="row row-cols-1 row-cols-md-3 g-4">
    <?php foreach ($dersler as $ders): ?>
        <div class="col">
            <div class="card h-100 shadow-sm border-0">
               <?php
    // Veritabanından gelen resmi kontrol et
    $resim = $ders['resim_yolu'] ?? 'default.jpg';
    // Eğer link ise direkt bas, değilse assets klasöründen al
    $resim_src = (strpos($resim, 'http') === 0) ? $resim : "assets/img/" . $resim;
?>
<img src="<?= $resim_src ?>" class="card-img-top" style="height: 200px; object-fit: cover;" onerror="this.src='assets/img/default.jpg'">
                
                <div class="card-body d-flex flex-column">
                    <h5 class="card-title text-primary fw-bold"><?= htmlspecialchars($ders['ders_adi']) ?></h5>
                    <p class="card-text text-muted flex-grow-1 small"><?= htmlspecialchars($ders['kisa_aciklama']) ?></p>
                    <div class="d-flex justify-content-between align-items-center mt-3">
                        <span class="fs-4 fw-bold"><?= number_format($ders['fiyat'], 2, ',', '.') ?> TL</span>
                        <a href="ders_detay.php?id=<?= $ders['id'] ?>" class="btn btn-sm btn-info text-white">Detayları Gör</a>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>

<?php require_once 'includes/footer.php'; ?>