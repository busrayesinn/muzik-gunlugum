<?php if (session_status() === PHP_SESSION_NONE) session_start(); ?>

<!DOCTYPE html>
<html lang="tr">
<head>
  <meta charset="UTF-8">
  <title>Müzik Günlüğüm</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;600&display=swap" rel="stylesheet">

  <style>
    body {
      font-family: 'Poppins', sans-serif;
      background: #121212;
      background-size: cover;
      color: #eee;
      margin: 0;
      padding-top: 70px;
      min-height: 100vh;
    }

    h1, h2, h5.card-title {
      color: #9370DB;
    }

    .btn-success {
      background-color: #9370DB;
      border-color: #9370DB;
    }

    .card {
      background-color: rgba(30, 30, 30, 0.85);
      border: none;
      color: #eee;
      margin-bottom: 1rem;
    }

    .card-text {
      color: #ccc;
    }

    a {
      color: #9370DB;
    }

    a:hover {
      text-decoration: underline;
    }

    .navbar {
      background-color: #1e1e1e;
      box-shadow: 0 2px 5px rgba(0,0,0,0.5);
    }

    .custom-delete {
      background-color:rgb(255, 255, 255);
      color: rgb(0, 0, 0);
      border: none;
    }

    .custom-save {
      background-color:rgb(79, 35, 136);
      color: white;
      border: none;
    }

    .custom-edit:hover,
    .custom-delete:hover,
    .custom-save:hover {
      opacity: 0.9;
    }

  </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark fixed-top">
  <div class="container">
    <a class="navbar-brand" href="index.php">🎶 Müzik Günlüğüm</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarMenu">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarMenu">
      <ul class="navbar-nav ms-auto">
        <?php if (isset($_SESSION['user_id'])): ?>
          <li class="nav-item">
            <a class="nav-link" href="add.php">➕ Yeni Kayıt</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="logout.php">🚪 Çıkış</a>
          </li>
        <?php else: ?>
          <li class="nav-item">
            <a class="nav-link" href="login.php">🔑 Giriş</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="register.php">📝 Kayıt</a>
          </li>
        <?php endif; ?>
      </ul>
    </div>
  </div>
</nav>
<div class="container py-4">
