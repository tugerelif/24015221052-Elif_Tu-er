<?php
require_once 'includes/header.php'; 
require_once 'includes/veritabani.php'; 

$ders_id = $_GET['id'] ?? null;
if (!$ders_id) { header("Location: dersler.php"); exit(); }

$ders = null;
$ders_satin_alindi = false;

try {
    // Ders bilgilerini çek
    $stmt = $db->prepare("SELECT * FROM dersler WHERE id = ?");
    $stmt->execute([$ders_id]);
    $ders = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$ders) { header("Location: dersler.php"); exit(); }

    // Kullanıcı giriş yapmışsa satın alma kontrolü yap
    if (isset($_SESSION['kullanici_id'])) {
        $check = $db->prepare("SELECT id FROM siparisler WHERE kullanici_id = ? AND ders_id = ?");
        $check->execute([$_SESSION['kullanici_id'], $ders_id]);
        if ($check->rowCount() > 0) { $ders_satin_alindi = true; }
    }
} catch (PDOException $e) { die("Hata!"); }
?>

<div class="container py-5">
    <?php if (isset($_SESSION['basari_mesaji'])): ?>
        <div class="alert alert-success"><?= $_SESSION['basari_mesaji']; unset($_SESSION['basari_mesaji']); ?></div>
    <?php endif; ?>

    <div class="row">
        <div class="col-md-8">
            <h1 class="fw-bold"><?= htmlspecialchars($ders['ders_adi']) ?></h1>
            <hr>
            
            <?php if ($ders_satin_alindi || (isset($_SESSION['rol']) && $_SESSION['rol'] === 'admin')): ?>
                <div class="ratio ratio-16x9 mb-4 shadow rounded overflow-hidden">
                    <?= $ders['video'] ?: '<div class="bg-dark text-white d-flex align-items-center justify-content-center">Video Henüz Eklenmemiş</div>' ?>
                </div>
                <div class="alert alert-info">Ders İçeriği: Açık (İzleyebilirsiniz)</div>
            <?php else: ?>
                <div class="bg-light p-5 text-center border rounded mb-4">
                    <i class="bi bi-lock-fill display-1 text-muted"></i>
                    <h3 class="mt-3">Bu Video Kilitlidir</h3>
                    <p>Eğitimi izlemek için lütfen satın alın.</p>
                </div>
            <?php endif; ?>

            <div class="mt-4">
                <h4>Ders Detayları</h4>
                <p><?= nl2br(htmlspecialchars($ders['detayli_icerik'])) ?></p>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card shadow-sm border-0 sticky-top" style="top: 20px;">
                <img src="<?= (strpos($ders['resim_yolu'], 'http') === 0) ? $ders['resim_yolu'] : 'assets/img/'.$ders['resim_yolu'] ?>" class="card-img-top">
                <div class="card-body">
                    <h2 class="text-success fw-bold mb-3"><?= number_format($ders['fiyat'], 2, ',', '.') ?> TL</h2>
                    
                    <?php if ($ders_satin_alindi): ?>
                        <button class="btn btn-secondary w-100 disabled">Zaten Satın Alındı</button>
                    <?php else: ?>
                        <a href="satin_al.php?ders_id=<?= $ders['id'] ?>" class="btn btn-primary btn-lg w-100 fw-bold">Hemen Satın Al</a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require_once 'includes/footer.php'; ?>