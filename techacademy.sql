-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Anamakine: 127.0.0.1:3306
-- Üretim Zamanı: 02 Kas 2025, 16:31:20
-- Sunucu sürümü: 9.1.0
-- PHP Sürümü: 8.3.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `techacademy`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `dersler`
--

DROP TABLE IF EXISTS `dersler`;
CREATE TABLE IF NOT EXISTS `dersler` (
  `id` int NOT NULL AUTO_INCREMENT,
  `ders_adi` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kisa_aciklama` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL,
  `detayli_icerik` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `fiyat` decimal(10,2) NOT NULL,
  `resim_yolu` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Tablo döküm verisi `dersler`
--

INSERT INTO `dersler` (`id`, `ders_adi`, `kisa_aciklama`, `detayli_icerik`, `fiyat`, `resim_yolu`) VALUES
(1, 'Serkan Hoca\'dan Giriş Seviyesi PHP & MySQL Kursu', 'PHP ile dinamik web siteleri ve MySQL veritabanı yönetimi temellerini öğrenin.', '1. Modül: PHP Temelleri (Değişkenler, Döngüler, Koşullar)\r\n 2. Modül: Form Yönetimi (POST/GET metotları, Güvenlik)\r\n 3. Modül: Veritabanı Bağlantısı (PDO, Güvenli Sorgular) \r\n4. Modül: CRUD Uygulamaları (Veri Ekleme, Silme, Güncelleme)', 400.00, ''),
(2, 'Serkan Hoca\'dan Modern Frontend: HTML5 & CSS3', 'Modern web standartları, Flexbox, Grid sistemi ve Bootstrap ile responsive tasarımın temelleri.', 'Modül 1: HTML5 Semantiği.\r\n Modül 2: CSS Selektörleri, Konumlandırma. \r\n Modül 3: Flexbox ve Grid ile Layout.\r\n Modül 4: Mobil Uyumlu Tasarım (Media Queries).', 300.00, ''),
(3, 'Serkan Hoca\'dan JavaScript Temelleri ve DOM Manipülasyonu', 'Tarayıcıda dinamik etkileşim, değişkenler, fonksiyonlar, DOM\'u yönetme ve kullanıcı olaylarını yakalama.', 'Modül 1: JS Sözdizimi ve Veri Tipleri. \r\nModül 2: Koşullar ve Döngüler. \r\nModül 3: Fonksiyonlar ve Kapsam. \r\nModül 4: DOM\'da Element Seçimi ve Değiştirme.', 250.00, ''),
(4, 'Serkan Hoca\'dan Git ve GitHub ile Versiyon Kontrolü', 'Proje takibi, ekip çalışması, branch yönetimi ve kodunuzu güvenli bir şekilde GitHub\'da saklama.', 'Modül 1: Git Temelleri (Commit, Staging).\r\nModül 2: Branch Oluşturma ve Merge Etme. \r\nModül 3: GitHub ile Uzak Depo Yönetimi. \r\nModül 4: Çakışma (Conflict) Çözümü.', 200.00, ''),
(5, 'Fatih Hoca\'dan Giriş Seviyesi PHP & MySQL Kursu', 'PHP ile dinamik web siteleri ve MySQL veritabanı yönetimi temellerini öğrenin.', '1. Modül: PHP Temelleri (Değişkenler, Döngüler, Koşullar)\r\n 2. Modül: Form Yönetimi (POST/GET metotları, Güvenlik)\r\n 3. Modül: Veritabanı Bağlantısı (PDO, Güvenli Sorgular) \r\n4. Modül: CRUD Uygulamaları (Veri Ekleme, Silme, Güncelleme)', 400.00, ''),
(6, 'Serkan Hoca\'dan Temel SQL ve Veritabanı Tasarımı', 'MySQL\'den bağımsız olarak tüm SQL sorgu tipleri, ilişki türleri (One-to-Many, Many-to-Many) ve indeksleme konuları.', 'Modül 1: SELECT, INSERT, UPDATE, DELETE. \r\nModül 2: JOIN Türleri. \r\nModül 3: Veri Normalizasyonu. \r\nModül 4: Indeksleme ve Performans.', 250.00, ''),
(7, 'Serkan Hoca\'dan Bootstrap İle Hızlandırılmış Prototipleme', 'Bootstrap\'ın tüm bileşenlerini (Modal, Carousel, Collapse, Card) hızlıca kullanarak bir proje prototipi oluşturma ve özelleştirme teknikleri.', 'Modül 1: Bootstrap Grid ve Utility Sınıfları. \r\nModül 2: Navigasyon ve Bileşen Kullanımı. \r\nModül 3: Form Tasarımı ve Validasyon. \r\nModül 4: Özelleştirme (SASS Temelleri).', 200.00, ''),
(8, 'Fatih Hoca\'dan Python Programlama Dili Temelleri', 'Python\'ın temel sözdizimi, veri yapıları (listeler, sözlükler) ve basit otomasyon betikleri yazma becerisi kazanma.', 'Modül 1: Python Kurulumu ve Sözdizimi. \r\nModül 2: Temel Veri Tipleri ve Operatörler. \r\nModül 3: Fonksiyonlar ve Kapsam. \r\nModül 4: Dosya Okuma/Yazma İşlemleri.', 400.00, ''),
(9, 'Serkan Hoca\'dan C# ve .NET Ortamına Giriş', 'Microsoft\'un güçlü C# diline ve .NET ortamına ilk adım. Değişkenler, türler ve nesne yönelimli programlama (OOP) temelleri.', 'Modül 1: C# Ortamı ve Visual Studio. \r\nModül 2: Değişkenler, Koşullar ve Döngüler. \r\nModül 3: Metotlar ve Sınıflar (Class). \r\nModül 4: Basit Konsol Uygulaması Geliştirme.', 400.00, ''),
(10, 'TypeScript: Modern JavaScript\'in Gücü', 'JavaScript\'e statik tür kontrolü ekleyen TypeScript\'e giriş. Büyük projelerde güvenilir kod yazma prensipleri', 'Modül 1: TypeScript Neden Gerekli? \r\nModül 2: Tip Tanımlamaları ve Arayüzler (Interfaces). \r\nModül 3: Sınıflar ve Kalıtım (Inheritance). \r\nModül 4: Kodun JavaScript\'e Derlenmesi.', 300.00, ''),
(11, 'Docker ve Konteyner Teknolojileri', 'Uygulamaları farklı ortamlarda standart bir şekilde çalıştırmak için Docker\'ın temelleri, imaj oluşturma ve Docker Compose kullanımı.', 'Modül 1: Konteyner Kavramı. \r\nModül 2: Dockerfile Oluşturma. \r\nModül 3: Docker Compose ile Çoklu Konteynerler. \r\nModül 4: Temel Ağ Yapılandırması.', 350.00, ''),
(12, 'Temel Siber Güvenlik ve Penetrasyon Testi', 'Kodlamanın ötesinde, yaygın web zafiyetlerini (XSS, CSRF, Clickjacking) anlama ve basit araçlarla test etme yöntemleri.', 'Modül 1: Yaygın Saldırı Vektörleri. \r\nModül 2: Saldırı Simülasyonu (Temeller). \r\nModül 3: Güvenlik Protokolleri (HTTPS). \r\nModül 4: Güvenli Kimlik Doğrulama.', 250.00, ''),
(13, 'Veri Bilimi ve Pandas (Python Kütüphanesi)', 'Python\'ın Pandas kütüphanesi kullanarak büyük veri kümelerini temizleme, analiz etme ve temel istatistiksel işlemleri gerçekleştirme.', 'Modül 1: Pandas Temelleri. \r\nModül 2: Veri Setlerini Yükleme ve Temizleme. \r\nModül 3: Veri Manipülasyonu. \r\nModül 4: Temel Veri Görselleştirme.', 300.00, '');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `kullanicilar`
--

DROP TABLE IF EXISTS `kullanicilar`;
CREATE TABLE IF NOT EXISTS `kullanicilar` (
  `id` int NOT NULL AUTO_INCREMENT,
  `ad_soyad` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `sifre` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `rol` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Tablo döküm verisi `kullanicilar`
--

INSERT INTO `kullanicilar` (`id`, `ad_soyad`, `email`, `sifre`, `rol`) VALUES
(1, 'elif tuğer', 'eliftuger@gmail.com', '$2y$10$nwgYzAhGfP5l4baf.vdUEOd563jQ5aOSIOz7hQcRGhRBHQNb7q9a.', 'admin'),
(2, 'ibrahim mercan', 'ibra4himxa@gmail.com', '$2y$10$TGYSPZa4J1M0EULKnVeB0ug8XTpIEsIrDf3WrTM1.ddgZpc5eSMlm', 'musteri');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `siparisler`
--

DROP TABLE IF EXISTS `siparisler`;
CREATE TABLE IF NOT EXISTS `siparisler` (
  `id` int NOT NULL AUTO_INCREMENT,
  `kullanici_id` int NOT NULL,
  `ders_id` int NOT NULL,
  `siparis_tarihi` datetime NOT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Tablo döküm verisi `siparisler`
--

INSERT INTO `siparisler` (`id`, `kullanici_id`, `ders_id`, `siparis_tarihi`) VALUES
(1, 2, 4, '0000-00-00 00:00:00'),
(2, 2, 4, '0000-00-00 00:00:00'),
(3, 2, 4, '0000-00-00 00:00:00'),
(4, 3, 7, '0000-00-00 00:00:00'),
(5, 2, 1, '0000-00-00 00:00:00'),
(6, 2, 7, '0000-00-00 00:00:00'),
(7, 2, 2, '0000-00-00 00:00:00');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
