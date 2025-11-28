<?php
session_start();
require_once '../jwt_helper.php';
require_login();
require_once '../database/db_connection.php';

$id = (int)($_GET['id'] ?? 0);

if ($id <= 0) {
    $_SESSION['error'] = "Невалиден ID.";
    header("Location: ../index.php");
    exit;
}

$db = connectDatabase();

$stmt = $db->prepare("SELECT event_type FROM events WHERE id = :id");
$stmt->bindValue(':id', $id, SQLITE3_INTEGER);
$event = $stmt->execute()->fetchArray(SQLITE3_ASSOC);

if (!$event) {
    $_SESSION['error'] = "Настанот не постои.";
    header("Location: ../index.php");
    exit;
}

if ($event['event_type'] === 'приватен') {
    $_SESSION['error'] = "Приватен настан не може да се избрише.";
    header("Location: ../index.php");
    exit;
}

$stmt = $db->prepare("DELETE FROM events WHERE id = :id");
$stmt->bindValue(':id', $id, SQLITE3_INTEGER);
$stmt->execute();

header("Location: ../index.php");
exit;
