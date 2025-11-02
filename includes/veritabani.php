<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
$host = "localhost";
$kullanici = "root"; 
$sifre = ""; 
$vt_adi = "techacademy"; 

try {
    $db = new PDO("mysql:host=$host;dbname=$vt_adi;charset=utf8mb4", $kullanici, $sifre);
    
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    
} catch (PDOException $e) {
    echo "<h1>Veritabanı bağlantı hatası!</h1>";
    echo "Hata Detayı: " . $e->getMessage();
    die(); 
}
?>