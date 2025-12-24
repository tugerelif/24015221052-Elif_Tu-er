<?php
session_start();
require_once '../includes/veritabani.php';

// Yetki Kontrolü: Sadece admin ve egitmen silebilir
if (!isset($_SESSION['kullanici_id']) || !in_array($_SESSION['rol'], ['admin', 'egitmen'])) {
    header("Location: ../index.php");
    exit();
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    try {
        $sql = "DELETE FROM dersler WHERE id = ?";
        $stmt = $db->prepare($sql);
        $stmt->execute([$id]);
        header("Location: dersler.php?durum=silindi");
    } catch (PDOException $e) {
        header("Location: dersler.php?durum=hata");
    }
} else {
    header("Location: dersler.php");
}
exit();