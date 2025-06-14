<?php
session_start();
if (!isset($_SESSION['user_id'])) header("Location: login.php");
require 'config/db.php';

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $imagePath = null;

    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {

        $targetDir = __DIR__ . "/uploads/";

        if (!is_dir($targetDir)) mkdir($targetDir, 0755, true);

        $fileName = uniqid() . "_" . basename($_FILES["image"]["name"]);

        $targetFile = $targetDir . $fileName;

        if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFile)) {
            $imagePath = "uploads/" . $fileName;
            echo "<p style='color:green;'>✅ Dosya yüklendi: $imagePath</p>";
        } else {
            echo "<p style='color:red;'>❌ Dosya yüklenemedi!</p>";
            echo "<p>Temp dosya: " . $_FILES["image"]["tmp_name"] . "</p>";
            echo "<p>Hedef yol: $targetFile</p>";
        }
    }

    $stmt = $pdo->prepare("INSERT INTO entries (user_id, title, artist, album, notes, image) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->execute([
        $_SESSION['user_id'],
        $_POST['title'],
        $_POST['artist'],
        $_POST['album'],
        $_POST['notes'],
        $imagePath
    ]);

    header("Location: index.php");
    exit;
}

include 'includes/header.php';
?>

<h2>Yeni Müzik Kaydı</h2>
<form method="post" enctype="multipart/form-data">
    <div class="mb-3"><label>Şarkı Adı</label><input name="title" class="form-control" required></div>
    <div class="mb-3"><label>Sanatçı</label><input name="artist" class="form-control" required></div>
    <div class="mb-3"><label>Albüm</label><input name="album" class="form-control"></div>
    <div class="mb-3"><label>Notlar</label><textarea name="notes" class="form-control"></textarea></div>
    <div class="mb-3">
        <label>Melodiye Eşlik Eden Resim (opsiyonel)</label>
        <input type="file" name="image" accept="image/*" class="form-control">
    </div>
    <button class="btn custom-save">Kaydet</button>
</form>

<?php include 'includes/footer.php'; ?>
