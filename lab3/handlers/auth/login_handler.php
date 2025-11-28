<?php
session_start();
require_once '../../database/db_connection.php';
require_once '../../jwt_helper.php';

$db = connectDatabase();

$username = trim($_POST['username'] ?? '');
$password = $_POST['password'] ?? '';

if ($username === '' || $password === '') {
    $_SESSION['error'] = "Сите полиња се задолжителни.";
    header("Location: ../../pages/auth/login.php");
    exit;
}

$stmt = $db->prepare("SELECT * FROM users WHERE username = :u");
$stmt->bindValue(':u', $username, SQLITE3_TEXT);
$user = $stmt->execute()->fetchArray(SQLITE3_ASSOC);

if (!$user || !password_verify($password, $user['password'])) {
    $_SESSION['error'] = "Погрешно корисничко име или лозинка.";
    header("Location: ../../pages/auth/login.php");
    exit;
}

$token = generateJWT((int)$user['id']);

$_SESSION['jwt'] = $token;
$_SESSION['username'] = $user['username'];

header("Location: ../../pages/create.php");
exit;
