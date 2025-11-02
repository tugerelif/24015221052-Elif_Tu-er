<?php
require_once '../includes/header.php'; 
require_once '../includes/veritabani.php'; 

if (!isset($_SESSION['kullanici_id']) || $_SESSION['rol'] !== 'admin' || !isset($_GET['id'])) {
    header("Location: ../index.php"); 
    exit();
}
$ders_id = $_GET['id'];

$hata_mesaji = '';
$basari_mesaji = '';
$ders = [];

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['ders_guncelle'])) {
    
    $ders_adi = trim($_POST['ders_adi']);
    $kisa_aciklama = trim($_POST['kisa_aciklama']);
    $detayli_icerik = trim($_POST['detayli_icerik']);
    $fiyat = (float)$_POST['fiyat'];
    $resim_yolu = '';

    $sql = "UPDATE dersler SET ders_adi = ?, kisa_aciklama = ?, detayli_icerik = ?, fiyat = ?, resim_yolu = ? WHERE id = ?";
    
    try {
        $stmt = $db->prepare($sql);
        $stmt->execute([$ders_adi, $kisa_aciklama, $detayli_icerik, $fiyat, $resim_yolu, $ders_id]);
        
        $basari_mesaji = "Ders başarıyla güncellendi.";
        
    } catch (PDOException $e) {
        $hata_mesaji = "Ders güncellenirken bir hata oluştu: " . $e->getMessage();
    }
}

try {
    $sql = "SELECT * FROM dersler WHERE id = ?";
    $stmt = $db->prepare($sql);
    $stmt->execute([$ders_id]);
    $ders = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$ders) {
        $hata_mesaji = "Düzenlenecek ders bulunamadı.";
    }

} catch (PDOException $e) {
    $hata_mesaji = "Ders bilgileri yüklenirken hata oluştu.";
}

?>

<h1 class="mb-4">Ders Düzenle (ID: <?= htmlspecialchars($ders_id) ?>)</h1>

<?php if ($basari_mesaji): ?>
    <div class="alert alert-success"><?= $basari_mesaji ?></div>
<?php endif; ?>
<?php if ($hata_mesaji): ?>
    <div class="alert alert-danger"><?= $hata_mesaji ?></div>
<?php endif; ?>

<?php if ($ders): ?>
<form action="ders_duzenle.php?id=<?= htmlspecialchars($ders_id) ?>" method="POST" class="col-md-8 mx-auto">
    <input type="hidden" name="ders_guncelle" value="1">

    <div class="mb-3">
        <label for="ders_adi" class="form-label">Ders Adı</label>
        <input type="text" class="form-control" id="ders_adi" name="ders_adi" value="<?= htmlspecialchars($ders['ders_adi']) ?>" required>
    </div>
    <div class="mb-3">
        <label for="kisa_aciklama" class="form-label">Kısa Açıklama</label>
        <input type="text" class="form-control" id="kisa_aciklama" name="kisa_aciklama" maxlength="500" value="<?= htmlspecialchars($ders['kisa_aciklama']) ?>" required>
    </div>
    <div class="mb-3">
        <label for="detayli_icerik" class="form-label">Detaylı İçerik</label>
        <textarea class="form-control" id="detayli_icerik" name="detayli_icerik" rows="5" required><?= htmlspecialchars($ders['detayli_icerik']) ?></textarea>
    </div>
    <div class="mb-3">
        <label for="fiyat" class="form-label">Fiyat (TL)</label>
        <input type="number" step="0.01" class="form-control" id="fiyat" name="fiyat" value="<?= htmlspecialchars($ders['fiyat']) ?>" required>
    </div>
    
    <button type="submit" class="btn btn-warning w-100 mt-3">Dersi Güncelle (UPDATE)</button>
    <a href="dersler.php" class="btn btn-secondary w-100 mt-2">Ders Listesine Geri Dön</a>

</form>
<?php endif; ?>


<?php
require_once '../includes/footer.php';
?>