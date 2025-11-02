<?php
require_once 'includes/header.php'; 

require_once 'includes/veritabani.php'; 

if (isset($_SESSION['kullanici_id'])) {
    header("Location: profilim.php"); 
    exit();
}

$hata_mesaji = '';
$basari_mesaji = '';
$ad_soyad = '';
$email = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $ad_soyad = trim($_POST['ad_soyad']);
    $email = trim(strtolower($_POST['email']));
    $sifre = $_POST['sifre'];
    $rol = 'musteri'; 

    $hashed_sifre = password_hash($sifre, PASSWORD_DEFAULT);

    $sql_check = "SELECT id FROM kullanicilar WHERE email = ?";
    $stmt_check = $db->prepare($sql_check);
    $stmt_check->execute([$email]);

    if ($stmt_check->rowCount() > 0) {
        $hata_mesaji = "Bu e-posta adresi zaten kayıtlı.";
    } else {
        $sql = "INSERT INTO kullanicilar (ad_soyad, email, sifre, rol) VALUES (?, ?, ?, ?)";
        
        try {
            $stmt = $db->prepare($sql);
            $stmt->execute([$ad_soyad, $email, $hashed_sifre, $rol]);

            header("Location: kayit.php?durum=basarili");
            exit();
            
        } catch (PDOException $e) {
            $hata_mesaji = "Kayıt sırasında beklenmedik bir veritabanı hatası oluştu. Hata: " . $e->getMessage();
        }
    }
}

if (isset($_GET['durum']) && $_GET['durum'] === 'basarili') {
    $basari_mesaji = "Kayıt Başarılı! Şimdi giriş yapabilirsiniz.";
}
?>

<h2 class="text-center">Yeni Hesap Oluştur</h2>

<div class="col-md-6 mx-auto">
    <?php if ($basari_mesaji): ?>
        <div class="alert alert-success mt-3"><?= $basari_mesaji ?></div>
    <?php endif; ?>
    <?php if ($hata_mesaji): ?>
        <div class="alert alert-danger mt-3"><?= $hata_mesaji ?></div>
    <?php endif; ?>
</div>

<form action="kayit.php" method="POST" class="col-md-6 mx-auto">
    <div class="mb-3">
        <label for="ad_soyad" class="form-label">Ad Soyad</label>
        <input type="text" class="form-control" id="ad_soyad" name="ad_soyad" value="<?= htmlspecialchars($ad_soyad) ?>" required>
    </div>
    <div class="mb-3">
        <label for="email" class="form-label">E-posta</label>
        <input type="email" class="form-control" id="email" name="email" value="<?= htmlspecialchars($email) ?>" required>
    </div>
    <div class="mb-3">
        <label for="sifre" class="form-label">Şifre</label>
        <input type="password" class="form-control" id="sifre" name="sifre" required>
        <small class="form-text text-muted">Güvenliğiniz için lütfen güçlü bir şifre seçiniz.</small>
    </div>
    
    <button type="submit" class="btn btn-primary w-100 mt-3">Kayıt Ol</button>

    <p class="text-center mt-3">Zaten hesabın var mı? <a href="giris.php">Giriş Yap</a></p>
</form>


<?php
require_once 'includes/footer.php';
?>