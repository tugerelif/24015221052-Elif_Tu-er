<?php
require_once '../includes/header.php'; 
require_once '../includes/veritabani.php'; 

if (!isset($_SESSION['kullanici_id']) || $_SESSION['rol'] !== 'admin') {
    header("Location: ../index.php"); 
    exit();
}

$hata_mesaji = '';
$basari_mesaji = '';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['ders_ekle'])) {
    
    $ders_adi = trim($_POST['ders_adi']);
    $kisa_aciklama = trim($_POST['kisa_aciklama']);
    $detayli_icerik = trim($_POST['detayli_icerik']);
    $fiyat = (float)$_POST['fiyat'];
    $resim_yolu = '';

    $sql = "INSERT INTO dersler (ders_adi, kisa_aciklama, detayli_icerik, fiyat, resim_yolu) VALUES (?, ?, ?, ?, ?)";
    
    try {
        $stmt = $db->prepare($sql);
        $stmt->execute([$ders_adi, $kisa_aciklama, $detayli_icerik, $fiyat, $resim_yolu]);
        
        $basari_mesaji = "Yeni ders başarıyla eklendi.";
        
    } catch (PDOException $e) {
        $hata_mesaji = "Ders eklenirken bir hata oluştu: " . $e->getMessage();
    }
}


$dersler = [];
try {
    $sql = "SELECT id, ders_adi, kisa_aciklama, fiyat FROM dersler ORDER BY id DESC";
    $stmt = $db->query($sql);
    $dersler = $stmt->fetchAll(PDO::FETCH_ASSOC);

} catch (PDOException $e) {
    $hata_mesaji = "Mevcut dersler yüklenirken hata oluştu.";
}

?>

<h1 class="mb-4">Ders Yönetimi</h1>

<?php if ($basari_mesaji): ?>
    <div class="alert alert-success"><?= $basari_mesaji ?></div>
<?php endif; ?>
<?php if ($hata_mesaji): ?>
    <div class="alert alert-danger"><?= $hata_mesaji ?></div>
<?php endif; ?>

<button class="btn btn-success mb-4" data-bs-toggle="modal" data-bs-target="#dersEkleModal">
    + Yeni Ders Ekle (CREATE)
</button>

<div class="modal fade" id="dersEkleModal" tabindex="-1" aria-labelledby="dersEkleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <form action="dersler.php" method="POST">
      <div class="modal-header">
        <h5 class="modal-title" id="dersEkleModalLabel">Yeni Ders Ekle</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        
        <div class="mb-3">
            <label for="ders_adi" class="form-label">Ders Adı</label>
            <input type="text" class="form-control" id="ders_adi" name="ders_adi" required>
        </div>
        <div class="mb-3">
            <label for="kisa_aciklama" class="form-label">Kısa Açıklama</label>
            <input type="text" class="form-control" id="kisa_aciklama" name="kisa_aciklama" maxlength="500" required>
        </div>
        <div class="mb-3">
            <label for="detayli_icerik" class="form-label">Detaylı İçerik</label>
            <textarea class="form-control" id="detayli_icerik" name="detayli_icerik" rows="5" required></textarea>
        </div>
        <div class="mb-3">
            <label for="fiyat" class="form-label">Fiyat (TL)</label>
            <input type="number" step="0.01" class="form-control" id="fiyat" name="fiyat" required>
        </div>
        
        <input type="hidden" name="resim_yolu" value="">

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kapat</button>
        <button type="submit" name="ders_ekle" class="btn btn-primary">Dersi Kaydet</button>
      </div>
      </form>
    </div>
  </div>
</div>


<h2>Mevcut Dersler (<?= count($dersler) ?> Adet)</h2>

<table class="table table-striped table-hover">
    <thead>
        <tr>
            <th>ID</th>
            <th>Ders Adı</th>
            <th>Kısa Açıklama</th>
            <th>Fiyat (TL)</th>
            <th>İşlemler (UPDATE / DELETE)</th>
        </tr>
    </thead>
    <tbody>
        <?php if (count($dersler) > 0): ?>
            <?php foreach ($dersler as $ders): ?>
                <tr>
                    <td><?= htmlspecialchars($ders['id']) ?></td>
                    <td><?= htmlspecialchars($ders['ders_adi']) ?></td>
                    <td><?= htmlspecialchars(substr($ders['kisa_aciklama'], 0, 50)) ?>...</td>
                    <td><?= number_format($ders['fiyat'], 2, ',', '.') ?> TL</td>
                    <td>
                        <a href="ders_duzenle.php?id=<?= $ders['id'] ?>" class="btn btn-sm btn-warning">Düzenle</a>
                        <a href="ders_sil.php?id=<?= $ders['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Bu dersi silmek istediğinizden emin misiniz?')">Sil</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="5" class="text-center text-muted">Henüz hiç ders eklenmemiştir.</td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>

<?php
require_once '../includes/footer.php';
?>