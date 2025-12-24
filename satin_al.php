<?php
require_once 'includes/header.php';
require_once 'includes/veritabani.php';

if (!isset($_SESSION['kullanici_id']) || !isset($_GET['ders_id'])) {
    header("Location: giris.php");
    exit();
}

$ders_id = $_GET['ders_id'];
$stmt = $db->prepare("SELECT ders_adi, fiyat FROM dersler WHERE id = ?");
$stmt->execute([$ders_id]);
$ders = $stmt->fetch(PDO::FETCH_ASSOC);
?>

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow-lg border-0">
                <div class="card-header bg-primary text-white text-center py-3">
                    <h4 class="mb-0"><i class="bi bi-credit-card"></i> Güvenli Ödeme</h4>
                </div>
                <div class="card-body p-4">
                    <div class="mb-4">
                        <h5 class="text-muted">Satın Alınacak Ders:</h5>
                        <p class="fw-bold fs-5 text-dark"><?= htmlspecialchars($ders['ders_adi']) ?></p>
                        <h4 class="text-success fw-bold"><?= number_format($ders['fiyat'], 2, ',', '.') ?> TL</h4>
                    </div>

                    <form action="odeme_islem.php" method="POST">
                        <input type="hidden" name="ders_id" value="<?= $ders_id ?>">
                        
                        <div class="mb-3">
                            <label class="form-label fw-bold">Kart Üzerindeki İsim</label>
                            <input type="text" class="form-control" placeholder="Ad Soyad" required>
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label fw-bold">Kart Numarası</label>
                            <input type="text" class="form-control" placeholder="0000 0000 0000 0000" maxlength="16" required>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Son Kullanma</label>
                                <input type="text" class="form-control" placeholder="AA/YY" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">CVV</label>
                                <input type="password" class="form-control" placeholder="***" maxlength="3" required>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-success btn-lg w-100 fw-bold mt-3 shadow">
                            <i class="bi bi-shield-check"></i> Ödemeyi Tamamla ve Eğitimi Başlat
                        </button>
                    </form>
                    <div class="text-center mt-3 text-muted small">
                        <i class="bi bi-lock-fill"></i> 256-bit SSL ile şifrelenmiş ödeme altyapısı.
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require_once 'includes/footer.php'; ?>
