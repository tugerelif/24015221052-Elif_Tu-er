<?php
require_once '../includes/veritabani.php';
session_start();

// Admin Güvenlik Kontrolü
if (!isset($_SESSION['kullanici_id']) || $_SESSION['rol'] !== 'admin') {
    exit('Yetkisiz Erişim!');
}

// --- SİLME İŞLEMİ (GET) ---
if (isset($_GET['islem']) && $_GET['islem'] == 'sil' && isset($_GET['id'])) {
    $id = $_GET['id'];
    
    // Admin kendi hesabını silemesin
    if ($id == $_SESSION['kullanici_id']) {
        header("Location: kullanicilar.php?durum=hata");
        exit();
    }

    try {
        $stmt = $db->prepare("DELETE FROM kullanicilar WHERE id = ?");
        $stmt->execute([$id]);
        header("Location: kullanicilar.php?durum=sil_ok");
    } catch (PDOException $e) {
        header("Location: kullanicilar.php?durum=hata");
    }
}

// --- GÜNCELLEME İŞLEMİ (POST) ---
if (isset($_POST['islem']) && $_POST['islem'] == 'guncelle') {
    $id = $_POST['id'];
    $ad_soyad = $_POST['ad_soyad'];
    $email = $_POST['email'];
    $rol = $_POST['rol'];

    try {
        $stmt = $db->prepare("UPDATE kullanicilar SET ad_soyad = ?, email = ?, rol = ? WHERE id = ?");
        $stmt->execute([$ad_soyad, $email, $rol, $id]);
        header("Location: kullanicilar.php?durum=gun_ok");
    } catch (PDOException $e) {
        header("Location: kullanicilar.php?durum=hata");
    }
}