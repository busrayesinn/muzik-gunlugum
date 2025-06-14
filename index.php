<?php
session_start();
if (!isset($_SESSION['user_id'])) header("Location: login.php");
require 'config/db.php';
include 'includes/header.php';

$stmt = $pdo->prepare("SELECT * FROM entries WHERE user_id = ? ORDER BY created_at DESC");
$stmt->execute([$_SESSION['user_id']]);
$entries = $stmt->fetchAll();
?>

<a href="add.php" class="btn btn-success mb-3">Yeni Kayıt Ekle</a>
<div class="row">
<?php foreach ($entries as $entry): ?>
  <div class="col-md-4 mb-4">
    <div class="card h-100">
      <div class="card-body">
        <h5 class="card-title"><?= htmlspecialchars($entry['title']) ?> - <?= htmlspecialchars($entry['artist']) ?></h5>

        <?php if (!empty($entry['image'])): ?>
          <img src="<?= htmlspecialchars($entry['image']) ?>" alt="Albüm görseli" class="img-fluid mb-3" style="max-height: 200px; object-fit: cover;">
        <?php endif; ?>

        <p class="card-text"><?= nl2br(htmlspecialchars($entry['notes'])) ?></p>
        <a href="edit.php?id=<?= $entry['id'] ?>" class="btn custom-save">Düzenle</a>
        <a href="delete.php?id=<?= $entry['id'] ?>" class="btn custom-delete">Sil</a>
      </div>
    </div>
  </div>
<?php endforeach; ?>
</div>

<?php include 'includes/footer.php'; ?>