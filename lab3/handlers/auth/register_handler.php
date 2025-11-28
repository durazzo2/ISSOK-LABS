<?php
session_start();
require_once '../../database/db_connection.php';

$db = connectDatabase();

$username = trim($_POST['username'] ?? '');
$password = $_POST['password'] ?? '';

if ($username === '' || $password === '') {
    $_SESSION['error'] = "Сите полиња се задолжителни.";
    header("Location: ../../pages/auth/register.php");
    exit;
}

$stmt = $db->prepare("SELECT id FROM users WHERE username = :u");
$stmt->bindValue(':u', $username, SQLITE3_TEXT);
$exists = $stmt->execute()->fetchArray();

if ($exists) {
    $_SESSION['error'] = "Корисничкото име веќе постои.";
    header("Location: ../../pages/auth/register.php");
    exit;
}

$hash = password_hash($password, PASSWORD_DEFAULT);
$stmt = $db->prepare("INSERT INTO users (username, password) VALUES (:u, :p)");
$stmt->bindValue(':u', $username, SQLITE3_TEXT);
$stmt->bindValue(':p', $hash, SQLITE3_TEXT);
$stmt->execute();

$_SESSION['success'] = "Успешна регистрација. Најавете се.";
header("Location: ../../pages/auth/login.php");
exit;
