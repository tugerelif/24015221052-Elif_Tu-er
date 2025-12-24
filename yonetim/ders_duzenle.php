<?php
require_once '../includes/header.php';
require_once '../includes/veritabani.php';

if (!isset($_SESSION['kullanici_id']) || !in_array($_SESSION['rol'], ['admin', 'egitmen'])) {
    header("Location: ../index.php"); exit();
}

$id = $_GET['id'] ?? null;
$hata = ''; $basari = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $ders_adi = trim($_POST['ders_adi']);
    $kisa = trim($_POST['kisa_aciklama']);
    $detay = trim($_POST['detayli_icerik']);
    $fiyat = (float)$_POST['fiyat'];
    $resim = trim($_POST['resim_yolu']);
    $video = $_POST['video'];

    try {
        $sql = "UPDATE dersler SET ders_adi=?, kisa_aciklama=?, detayli_icerik=?, fiyat=?, resim_yolu=?, video=? WHERE id=?";
        $db->prepare($sql)->execute([$ders_adi, $kisa, $detay, $fiyat, $resim, $video, $id]);
        $basari = "Ders başarıyla güncellendi.";
    } catch (PDOException $e) { $hata = "Hata: " . $e->getMessage(); }
}

$stmt = $db->prepare("SELECT * FROM dersler WHERE id = ?");
$stmt->execute([$id]);
$ders = $stmt->fetch(PDO::FETCH_ASSOC);
if (!$ders) { header("Location: dersler.php"); exit(); }
?>

<div class="container py-4">
    <div class="card shadow border-0">
        <div class="card-header bg-warning text-dark fw-bold">Ders Düzenle: <?= htmlspecialchars($ders['ders_adi']) ?></div>
        <form method="POST" class="card-body">
            <?php if($basari): ?><div class="alert alert-success"><?=$basari?></div><?php endif; ?>
            <?php if($hata): ?><div class="alert alert-danger"><?=$hata?></div><?php endif; ?>
            
            <div class="row">
                <div class="col-md-6 mb-3"><label class="form-label fw-bold">Ders Adı</label><input type="text" name="ders_adi" class="form-control" value="<?=$ders['ders_adi']?>" required></div>
                <div class="col-md-6 mb-3"><label class="form-label fw-bold">Fiyat (TL)</label><input type="number" step="0.01" name="fiyat" class="form-control" value="<?=$ders['fiyat']?>" required></div>
            </div>
            <div class="mb-3"><label class="form-label fw-bold">Resim URL</label><input type="text" name="resim_yolu" class="form-control" value="<?=$ders['resim_yolu']?>"></div>
            <div class="mb-3"><label class="form-label fw-bold">Video Embed (Iframe)</label><textarea name="video" class="form-control" rows="2"><?=$ders['video']?></textarea></div>
            <div class="mb-3"><label class="form-label fw-bold">Kısa Açıklama</label><input type="text" name="kisa_aciklama" class="form-control" value="<?=$ders['kisa_aciklama']?>" required></div>
            <div class="mb-3"><label class="form-label fw-bold">Detaylı İçerik</label><textarea name="detayli_icerik" class="form-control" rows="5" required><?=$ders['detayli_icerik']?></textarea></div>
            
            <button type="submit" class="btn btn-warning w-100 fw-bold">Değişiklikleri Kaydet</button>
            <a href="dersler.php" class="btn btn-secondary w-100 mt-2">Vazgeç ve Geri Dön</a>
        </form>
    </div>
</div>

<?php require_once '../includes/footer.php'; ?>