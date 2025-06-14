<?php
session_start();
require 'config/db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $stmt = $pdo->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
    $stmt->execute([$username, $password]);
    header("Location: login.php");
}
?>

<?php include 'includes/header.php'; ?>
<h2>Kayıt Ol</h2>
<form method="post">
    <div class="mb-3">
        <label>Kullanıcı Adı</label>
        <input type="text" name="username" class="form-control" required>
    </div>
    <div class="mb-3">
        <label>Şifre</label>
        <input type="password" name="password" class="form-control" required>
    </div>
    <button type="submit" class="btn custom-save">Kayıt Ol</button>
</form>
<?php include 'includes/footer.php'; ?>