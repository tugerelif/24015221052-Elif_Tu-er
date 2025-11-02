<?php
require_once 'includes/header.php'; 

require_once 'includes/veritabani.php'; 

if (isset($_SESSION['kullanici_id'])) {
    header("Location: index.php"); 
    exit();
}

$hata_mesaji = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $email = trim($_POST['email']);
    $sifre_girilen = $_POST['sifre'];

    $sql = "SELECT id, ad_soyad, sifre, rol FROM kullanicilar WHERE email = ?";
    $stmt = $db->prepare($sql);
    $stmt->execute([$email]);
    $kullanici = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($kullanici) {

        if (password_verify($sifre_girilen, $kullanici['sifre'])) {
            
            $_SESSION['kullanici_id'] = $kullanici['id'];
            $_SESSION['ad_soyad'] = $kullanici['ad_soyad'];
            $_SESSION['rol'] = $kullanici['rol'];

            header("Location: index.php");
            exit();

        } else {
            $hata_mesaji = "E-posta veya şifre hatalı.";
        }
    } else {
        $hata_mesaji = "E-posta veya şifre hatalı.";
    }
}
?>

<h2 class="text-center">Kullanıcı Girişi</h2>

<div class="col-md-6 mx-auto">
    <?php if ($hata_mesaji): ?>
        <div class="alert alert-danger mt-3"><?= $hata_mesaji ?></div>
    <?php endif; ?>
</div>

<form action="giris.php" method="POST" class="col-md-6 mx-auto">
    <div class="mb-3">
        <label for="email" class="form-label">E-posta</label>
        <input type="email" class="form-control" id="email" name="email" required>
    </div>
    <div class="mb-3">
        <label for="sifre" class="form-label">Şifre</label>
        <input type="password" class="form-control" id="sifre" name="sifre" required>
    </div>
    
    <button type="submit" class="btn btn-success w-100 mt-3">Giriş Yap</button>

    <p class="text-center mt-3">Hesabın yok mu? <a href="kayit.php">Hemen Kayıt Ol</a></p>
</form>

<?php
require_once 'includes/footer.php';
?>