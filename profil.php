<?php
require_once 'includes/header.php'; 
require_once 'includes/veritabani.php'; 

if (!isset($_SESSION['kullanici_id'])) { header("Location: giris.php"); exit(); }

$kullanici_id = $_SESSION['kullanici_id'];
$siparisler = [];

try {
    $sql = "SELECT d.id, d.ders_adi, d.fiyat, s.siparis_tarihi 
            FROM siparisler s 
            JOIN dersler d ON s.ders_id = d.id 
            WHERE s.kullanici_id = ? ORDER BY s.siparis_tarihi DESC";
    $stmt = $db->prepare($sql);
    $stmt->execute([$kullanici_id]);
    $siparisler = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) { }
?>

<div class="container py-5">
    <div class="row">
        <div class="col-md-4 text-center">
            <div class="card p-4 shadow-sm border-0">
                <div class="display-1 text-primary"><i class="bi bi-person-circle"></i></div>
                <h4 class="mt-2"><?= $_SESSION['ad_soyad'] ?></h4>
                <p class="text-muted"><?= $_SESSION['rol'] == 'admin' ? 'Yönetici' : 'Öğrenci' ?></p>
            </div>
        </div>
        <div class="col-md-8">
            <h3>Eğitimlerim</h3>
            <div class="list-group">
                <?php foreach ($siparisler as $s): ?>
                    <a href="ders_detay.php?id=<?= $s['id'] ?>" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center p-3">
                        <div>
                            <h6 class="mb-0 fw-bold"><?= $s['ders_adi'] ?></h6>
                            <small class="text-muted">Tarih: <?= $s['siparis_tarihi'] ?></small>
                        </div>
                        <span class="badge bg-primary rounded-pill">İzle</span>
                    </a>
                <?php endforeach; ?>
                <?php if (empty($siparisler)): ?>
                    <div class="alert alert-warning">Henüz bir ders satın almadınız.</div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<?php require_once 'includes/footer.php'; ?>