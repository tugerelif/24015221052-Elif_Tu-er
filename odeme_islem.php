<?php
session_start();
// Dosya ana dizinde (index.php'nin yanında) olduğu için yol budur:
require_once 'includes/veritabani.php'; 

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['ders_id'])) {
    $kullanici_id = $_SESSION['kullanici_id'];
    $ders_id = $_POST['ders_id'];

    try {
        // Zaten satın alınmış mı kontrol et
        $check = $db->prepare("SELECT id FROM siparisler WHERE kullanici_id = ? AND ders_id = ?");
        $check->execute([$kullanici_id, $ders_id]);

        if ($check->rowCount() == 0) {
            // Ödeme simülasyonu -> Siparişi veritabanına ekle
            $sql = "INSERT INTO siparisler (kullanici_id, ders_id) VALUES (?, ?)";
            $stmt = $db->prepare($sql);
            $stmt->execute([$kullanici_id, $ders_id]);
            $_SESSION['basari_mesaji'] = "Ödemeniz onaylandı! Eğitimin kilidi açıldı.";
        }

        // İşlem bitince ders detay sayfasına geri gönder
        header("Location: ders_detay.php?id=" . $ders_id);
        exit();

    } catch (PDOException $e) {
        die("Veritabanı Hatası: " . $e->getMessage());
    }
} else {
    // Doğrudan erişilirse ana sayfaya at
    header("Location: index.php");
    exit();
}