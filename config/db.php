<?php
$host = 'localhost';
$db = 'dbstorage23360859076';
$user = 'dbusr23360859076';
$pass = '9UlBFiS4sNAe';
try {
    $pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Veritabanı bağlantı hatası: " . $e->getMessage());
}
?>