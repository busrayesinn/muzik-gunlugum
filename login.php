<?php
session_start();
require 'config/db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->execute([$_POST['username']]);
    $user = $stmt->fetch();
    if ($user && password_verify($_POST['password'], $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        header("Location: index.php");
        exit;
    } else {
        $error = "Hatalı kullanıcı adı veya şifre.";
    }
}
?>

<style>
  body {
    font-family: 'Poppins', sans-serif;
    background: #121212 url('images/vinyl-background.png') no-repeat center center fixed;
    background-size: cover;
    color: #eee;
    margin: 0;
    height: 100vh;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
  }
  h1.site-title {
    margin-bottom: 2rem;
    color: #9370DB;
    font-weight: 600;
    user-select: none;
  }
  .login-container {
    background: rgba(30, 30, 30, 0.85);
    padding: 2rem;
    border-radius: 12px;
    width: 320px;
    max-width: 90vw;
    text-align: center;
    box-shadow: 0 0 15px 	#9370DB;
  }
  .login-container h2 {
    margin-bottom: 1rem;
    color: #9370DB;
  }
  .form-control {
    background: #2c2c2c;
    border: none;
    color: #eee;
    width: 100%;
    padding: 0.5rem;
    margin-bottom: 1rem;
    border-radius: 6px;
    font-size: 1rem;
  }
  .form-control:focus {
    background: #3a3a3a;
    color: #9370DB;
    outline: none;
    box-shadow: 0 0 5px #9370DB;
  }
  .btn-primary {
    background: #9370DB;
    border: none;
    width: 100%;
    padding: 0.7rem;
    border-radius: 6px;
    font-size: 1.1rem;
    cursor: pointer;
    transition: background-color 0.3s ease;
    color: white;
  }
  .btn-primary:hover {
    background: #9370DB;
  }
  a {
    color: #9370DB;
    text-decoration: none;
  }
  a:hover {
    text-decoration: underline;
  }
  .alert-danger {
    background-color: #9370DB;
    border: none;
    padding: 0.5rem 1rem;
    margin-bottom: 1rem;
    border-radius: 6px;
  }
</style>

<h1 class="site-title">Kişisel Müzik Günlüğüm</h1>

<div class="login-container">
  <h2>Giriş Yap</h2>
  <?php if (!empty($error)) : ?>
    <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
  <?php endif; ?>
  <form method="post" autocomplete="off">
      <input id="username" type="text" name="username" class="form-control" placeholder="Kullanıcı Adı" required autofocus>
      <input id="password" type="password" name="password" class="form-control" placeholder="Şifre" required>
      <button type="submit" class="btn btn-primary">Giriş Yap</button>
  </form>
  <p class="mt-3">
    Hesabınız yok mu? <a href="register.php">Kayıt olun</a>
  </p>
</div>

<?php include 'includes/footer.php'; ?>
