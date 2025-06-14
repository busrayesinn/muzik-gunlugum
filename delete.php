<?php
session_start();
if (!isset($_SESSION['user_id'])) header("Location: login.php");
require 'config/db.php';
$id = $_GET['id'];
$stmt = $pdo->prepare("DELETE FROM entries WHERE id = ? AND user_id = ?");
$stmt->execute([$id, $_SESSION['user_id']]);
header("Location: index.php");
?>