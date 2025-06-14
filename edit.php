<?php
session_start();
if (!isset($_SESSION['user_id'])) header("Location: login.php");
require 'config/db.php';

$id = $_GET['id'] ?? null;
if (!$id) die("Geçersiz ID.");

$stmt = $pdo->prepare("SELECT * FROM entries WHERE id = ? AND user_id = ?");
$stmt->execute([$id, $_SESSION['user_id']]);
$entry = $stmt->fetch();
if (!$entry) die("Kayıt bulunamadı.");

// Mevcut görsel
$imagePath = $entry['image'];

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $title = $_POST['title'];
    $artist = $_POST['artist'];
    $album = $_POST['album'];
    $notes = $_POST['notes'];

    // Dosya yüklendiyse işle
    if (isset($_FILES['imageFile']) && $_FILES['imageFile']['error'] === UPLOAD_ERR_OK) {
        $uploadDir = 'uploads/';
        if (!is_dir($uploadDir)) mkdir($uploadDir, 0777, true);

        $filename = uniqid() . '_' . basename($_FILES['imageFile']['name']);
        $targetFile = $uploadDir . $filename;
        $fileType = mime_content_type($_FILES['imageFile']['tmp_name']);

        if (in_array($fileType, ['image/jpeg', 'image/png', 'image/gif'])) {
            move_uploaded_file($_FILES['imageFile']['tmp_name'], $targetFile);
            $imagePath = $targetFile;
        }
    }

    $stmt = $pdo->prepare("UPDATE entries SET title=?, artist=?, album=?, notes=?, image=? WHERE id=? AND user_id=?");
    $stmt->execute([$title, $artist, $album, $notes, $imagePath, $id, $_SESSION['user_id']]);

    header("Location: index.php");
    exit;
}
include 'includes/header.php';
?>

<h2>Kayıt Düzenle</h2>
<form method="post" enctype="multipart/form-data">
    <div class="mb-3">
        <label>Şarkı Adı</label>
        <input name="title" class="form-control" value="<?= htmlspecialchars($entry['title']) ?>" required>
    </div>
    <div class="mb-3">
        <label>Sanatçı</label>
        <input name="artist" class="form-control" value="<?= htmlspecialchars($entry['artist']) ?>" required>
    </div>
    <div class="mb-3">
        <label>Albüm</label>
        <input name="album" class="form-control" value="<?= htmlspecialchars($entry['album']) ?>">
    </div>
    <div class="mb-3">
        <label>Melodiye Eşlik Eden Resim:</label><br>
        <?php if (!empty($entry['image'])): ?>
            <img src="<?= htmlspecialchars($entry['image']) ?>" alt="Mevcut Görsel" style="max-height: 150px; margin-bottom: 10px;">
        <?php endif; ?>
        <input type="file" name="imageFile" class="form-control mt-2">
        <small class="text-muted">Yeni bir görsel seçerseniz eski görselin yerini alır.</small>
    </div>
    <div class="mb-3">
        <label>Notlar</label>
        <textarea name="notes" class="form-control"><?= htmlspecialchars($entry['notes']) ?></textarea>
    </div>
    <button class="btn custom-save">Güncelle</button>
</form>

<?php include 'includes/footer.php'; ?>
