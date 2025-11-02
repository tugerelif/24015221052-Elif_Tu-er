<?php
session_start();
require_once '../includes/veritabani.php'; 

if (!isset($_SESSION['kullanici_id']) || $_SESSION['rol'] !== 'admin' || !isset($_GET['id'])) {
    header("Location: dersler.php"); 
    exit();
}

$ders_id = $_GET['id'];

$sql = "DELETE FROM dersler WHERE id = ?";

try {
    $stmt = $db->prepare($sql);

    $stmt->execute([$ders_id]);

    header("Location: dersler.php?silindi=basarili");
    exit();
    
} catch (PDOException $e) {
    header("Location: dersler.php?silindi=hata");
    exit();
}
?>