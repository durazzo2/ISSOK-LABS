<?php
require_once 'db.php';
$db = db_connect();

$id = intval($_POST['id'] ?? 0);
$title = trim($_POST['title'] ?? '');
$due_date = trim($_POST['due_date'] ?? '');
$priority = trim($_POST['priority'] ?? '');
$status = trim($_POST['status'] ?? '');

$validPriorities = ['Low', 'Medium', 'High'];
$validStatuses = ['Pending', 'Done'];

if ($title === '' || $due_date === '' || $priority === '' || $status === '') {
    header("Location: edit_form.php?id=$id&error=Сите полиња се задолжителни.");
    exit;
}
if (!in_array($priority, $validPriorities)) {
    header("Location: edit_form.php?id=$id&error=Невалиден приоритет.");
    exit;
}
if (!in_array($status, $validStatuses)) {
    header("Location: edit_form.php?id=$id&error=Невалиден статус.");
    exit;
}

$stmt = $db->prepare("UPDATE tasks SET title=:title, due_date=:due_date, priority=:priority, status=:status WHERE id=:id");
$stmt->bindValue(':title', $title, SQLITE3_TEXT);
$stmt->bindValue(':due_date', $due_date, SQLITE3_TEXT);
$stmt->bindValue(':priority', $priority, SQLITE3_TEXT);
$stmt->bindValue(':status', $status, SQLITE3_TEXT);
$stmt->bindValue(':id', $id, SQLITE3_INTEGER);
$stmt->execute();

header("Location: index.php?flash=Задачата е ажурирана!");
exit;
?>
