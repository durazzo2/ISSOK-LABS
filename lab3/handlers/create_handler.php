<?php
session_start();
require_once '../jwt_helper.php';
require_login();
require_once '../database/db_connection.php';

$name      = trim($_POST['name'] ?? '');
$location  = trim($_POST['location'] ?? '');
$eventDate = $_POST['event_date'] ?? '';
$eventType = $_POST['event_type'] ?? '';

if ($name === '' || $location === '' || $eventDate === '' || $eventType === '') {
    $_SESSION['error'] = "Сите полиња се задолжителни.";
    header("Location: ../pages/create.php");
    exit;
}

if (!in_array($eventType, ['јавен','приватен'], true)) {
    $_SESSION['error'] = "Невалиден тип.";
    header("Location: ../pages/create.php");
    exit;
}

$db = connectDatabase();
$stmt = $db->prepare("
INSERT INTO events (name, location, event_date, event_type)
VALUES (:n, :l, :d, :t)
");
$stmt->bindValue(':n', $name, SQLITE3_TEXT);
$stmt->bindValue(':l', $location, SQLITE3_TEXT);
$stmt->bindValue(':d', $eventDate, SQLITE3_TEXT);
$stmt->bindValue(':t', $eventType, SQLITE3_TEXT);
$stmt->execute();

header("Location: ../index.php");
exit;
