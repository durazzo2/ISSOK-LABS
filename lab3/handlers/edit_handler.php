<?php
session_start();
require_once '../jwt_helper.php';
require_login();
require_once '../database/db_connection.php';

$id        = (int)($_POST['id'] ?? 0);
$name      = trim($_POST['name'] ?? '');
$location  = trim($_POST['location'] ?? '');
$eventDate = $_POST['event_date'] ?? '';
$eventType = $_POST['event_type'] ?? '';

if ($id <= 0) {
    $_SESSION['error'] = "Невалиден ID.";
    header("Location: ../index.php");
    exit;
}

if ($name === '' || $location === '' || $eventDate === '' || $eventType === '') {
    $_SESSION['error'] = "Сите полиња се задолжителни.";
    header("Location: ../pages/edit.php?id=" . $id);
    exit;
}

if (!in_array($eventType, ['јавен','приватен'], true)) {
    $_SESSION['error'] = "Невалиден тип.";
    header("Location: ../pages/edit.php?id=" . $id);
    exit;
}

$db = connectDatabase();

$stmt = $db->prepare("
UPDATE events SET
    name = :n,
    location = :l,
    event_date = :d,
    event_type = :t
WHERE id = :id
");
$stmt->bindValue(':n', $name, SQLITE3_TEXT);
$stmt->bindValue(':l', $location, SQLITE3_TEXT);
$stmt->bindValue(':d', $eventDate, SQLITE3_TEXT);
$stmt->bindValue(':t', $eventType, SQLITE3_TEXT);
$stmt->bindValue(':id', $id, SQLITE3_INTEGER);
$stmt->execute();

header("Location: ../index.php");
exit;
