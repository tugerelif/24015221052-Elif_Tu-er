<?php
require_once '../includes/header.php';
require_once '../includes/veritabani.php';

if (!isset($_SESSION['kullanici_id']) || $_SESSION['rol'] !== 'admin') {
    header("Location: ../index.php");
    exit();
}

// Bildirim Mesajları
$mesaj = "";
if (isset($_GET['durum'])) {
    if ($_GET['durum'] == 'sil_ok') $mesaj = '<div class="alert alert-success">Kullanıcı başarıyla silindi.</div>';
    elseif ($_GET['durum'] == 'gun_ok') $mesaj = '<div class="alert alert-success">Kullanıcı bilgileri güncellendi.</div>';
    else $mesaj = '<div class="alert alert-danger">Bir hata oluştu!</div>';
}

$kullanicilar = [];
try {
    $sql = "SELECT * FROM kullanicilar ORDER BY id DESC";
    $stmt = $db->query($sql);
    $kullanicilar = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    $hata_mesaji = "Hata: " . $e->getMessage();
}
?>

<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center border-bottom pb-2 mb-4">
        <h1 class="fw-bold text-dark"><i class="bi bi-people-fill text-info"></i> Kullanıcı Yönetimi</h1>
        <a href="index.php" class="btn btn-outline-secondary btn-sm"><i class="bi bi-arrow-left"></i> Panele Dön</a>
    </div>

    <?= $mesaj ?>

    <div class="card shadow-sm border-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-dark text-center">
                    <tr>
                        <th>ID</th>
                        <th>Ad Soyad</th>
                        <th>E-posta</th>
                        <th>Yetki</th>
                        <th>Kayıt Tarihi</th>
                        <th>İşlemler</th>
                    </tr>
                </thead>
                <tbody class="text-center">
                    <?php foreach ($kullanicilar as $user): ?>
                        <tr>
                            <td class="fw-bold">#<?= $user['id'] ?></td>
                            <td><?= htmlspecialchars($user['ad_soyad'] ?? 'Bilinmiyor') ?></td>
                            <td><?= htmlspecialchars($user['email']) ?></td>
                            <td>
                                <span class="badge <?= $user['rol'] === 'admin' ? 'bg-danger' : 'bg-primary' ?>">
                                    <?= strtoupper($user['rol']) ?>
                                </span>
                            </td>
                            <td>
                                <?php 
                                $tarih = $user['tarih'] ?? $user['kayit_tarihi'] ?? null;
                                echo ($tarih) ? date('d.m.Y', strtotime($tarih)) : '---';
                                ?>
                            </td>
                            <td>
                                
                                <a href="kullanici_islem.php?islem=sil&id=<?= $user['id'] ?>" 
                                   class="btn btn-sm btn-danger shadow-sm" 
                                   onclick="return confirm('Bu kullanıcıyı silmek istediğinize emin misiniz?')">
                                   <i class="bi bi-trash"></i>
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php require_once '../includes/footer.php'; ?>