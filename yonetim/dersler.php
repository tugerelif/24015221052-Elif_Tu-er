<?php
require_once '../includes/header.php'; 
require_once '../includes/veritabani.php'; 

if (!isset($_SESSION['kullanici_id']) || !in_array($_SESSION['rol'], ['admin', 'egitmen'])) {
    header("Location: ../index.php"); exit();
}

$hata = ''; $basari = '';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['ders_ekle'])) {
    $ders_adi = trim($_POST['ders_adi']);
    $kisa = trim($_POST['kisa_aciklama']);
    $detay = trim($_POST['detayli_icerik']);
    $fiyat = (float)$_POST['fiyat'];
    $resim = trim($_POST['resim_yolu']);
    $video = $_POST['video']; // Video embed kodu

    try {
        $sql = "INSERT INTO dersler (ders_adi, kisa_aciklama, detayli_icerik, fiyat, resim_yolu, video) VALUES (?, ?, ?, ?, ?, ?)";
        $db->prepare($sql)->execute([$ders_adi, $kisa, $detay, $fiyat, $resim, $video]);
        $basari = "Ders başarıyla eklendi.";
    } catch (PDOException $e) { $hata = "Hata: " . $e->getMessage(); }
}

$dersler = $db->query("SELECT * FROM dersler ORDER BY id DESC")->fetchAll(PDO::FETCH_ASSOC);
?>

<div class="container py-4">
    <div class="d-flex justify-content-between mb-4">
        <h1 class="fw-bold">Ders Yönetimi</h1>
        <button class="btn btn-success fw-bold" data-bs-toggle="modal" data-bs-target="#dersEkle">+ Yeni Ders Ekle</button>
    </div>

    <?php if($basari): ?><div class="alert alert-success shadow-sm"><?=$basari?></div><?php endif; ?>
    <?php if($hata): ?><div class="alert alert-danger shadow-sm"><?=$hata?></div><?php endif; ?>

    <div class="card shadow-sm border-0">
        <table class="table table-hover align-middle mb-0">
            <thead class="table-dark">
                <tr><th>Önizleme</th><th>Ders Adı</th><th>Fiyat</th><th class="text-center">İşlemler</th></tr>
            </thead>
            <tbody>
            <?php foreach($dersler as $d): ?>
    <tr class="align-middle">
        <td>
            <?<?php 
    $resim = $d['resim_yolu'] ?? 'default.jpg';
    if (empty($resim)) {
        $resim_src = "../assets/img/default.jpg";
    } elseif (strpos($resim, 'http') === 0) {
        $resim_src = $resim;
    } else {
       $resim_src = (strpos($resim, 'http') === 0) ? $resim : "../assets/img/" . $resim;
    }
?>
<img src="<?= $resim_src ?>" class="rounded shadow-sm" style="width: 60px; height: 40px; object-fit: cover;" onerror="this.src='../assets/img/default.jpg'">
        </td>
        <td class="fw-bold"><?= htmlspecialchars($d['ders_adi']) ?></td>
        <td class="text-success fw-bold"><?= number_format($d['fiyat'], 2, ',', '.') ?> TL</td>
        <td class="text-center">
            <a href="ders_duzenle.php?id=<?= $d['id'] ?>" class="btn btn-sm btn-warning">Düzenle</a>
            <a href="ders_sil.php?id=<?= $d['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Silinsin mi?')">Sil</a>
        </td>
    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<div class="modal fade" id="dersEkle" tabindex="-1">
  <div class="modal-dialog modal-lg">
    <form action="dersler.php" method="POST" class="modal-content border-0 shadow-lg">
      <div class="modal-header bg-primary text-white"><h5 class="modal-title fw-bold">Yeni Ders & Video Kaydı</h5><button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button></div>
      <div class="modal-body">
          <div class="row">
              <div class="col-md-6 mb-3"><label class="form-label fw-bold">Ders Adı</label><input type="text" name="ders_adi" class="form-control" required></div>
              <div class="col-md-6 mb-3"><label class="form-label fw-bold">Fiyat (TL)</label><input type="number" step="0.01" name="fiyat" class="form-control" required></div>
          </div>
          <div class="mb-3"><label class="form-label fw-bold">Resim URL</label><input type="text" name="resim_yolu" class="form-control" placeholder="https://..."></div>
          <div class="mb-3"><label class="form-label fw-bold">Video Embed (Iframe) Kodu</label><textarea name="video" class="form-control" rows="3" placeholder="<iframe...></iframe"></textarea></div>
          <div class="mb-3"><label class="form-label fw-bold">Kısa Açıklama</label><input type="text" name="kisa_aciklama" class="form-control" required></div>
          <div class="mb-3"><label class="form-label fw-bold">Detaylı İçerik</label><textarea name="detayli_icerik" class="form-control" rows="4" required></textarea></div>
      </div>
      <div class="modal-footer bg-light"><button type="submit" name="ders_ekle" class="btn btn-primary w-100 fw-bold">Dersi Kaydet</button></div>
    </form>
  </div>
</div>

<?php require_once '../includes/footer.php'; ?>