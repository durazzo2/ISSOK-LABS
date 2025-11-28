<?php
require_once 'db.php';
$db = db_connect();

$title = trim($_POST['title'] ?? '');
$due_date = trim($_POST['due_date'] ?? '');
$priority = trim($_POST['priority'] ?? '');
$status = trim($_POST['status'] ?? '');

$validPriorities = ['Low', 'Medium', 'High'];
$validStatuses = ['Pending', 'Done'];

function redirectWithError($message, $title, $due_date, $priority, $status) {
    $params = http_build_query([
            'error' => $message,
            'title' => $title,
            'due_date' => $due_date,
            'priority' => $priority,
            'status' => $status
    ]);
    header("Location: add_form.php?$params");
    exit;
}

if ($title === '' || $due_date === '' || $priority === '' || $status === '') {
    redirectWithError('Сите полиња се задолжителни.', $title, $due_date, $priority, $status);
}

if (!in_array($priority, $validPriorities)) {
    redirectWithError('Невалиден приоритет.', $title, $due_date, $priority, $status);
}

if (!in_array($status, $validStatuses)) {
    redirectWithError('Невалиден статус.', $title, $due_date, $priority, $status);
}

$stmt = $db->prepare("
    INSERT INTO tasks (title, due_date, priority, status)
    VALUES (:title, :due_date, :priority, :status)
");
$stmt->bindValue(':title', $title, SQLITE3_TEXT);
$stmt->bindValue(':due_date', $due_date, SQLITE3_TEXT);
$stmt->bindValue(':priority', $priority, SQLITE3_TEXT);
$stmt->bindValue(':status', $status, SQLITE3_TEXT);
$stmt->execute();

header("Location: index.php?flash=Задачата е успешно додадена!");
exit;
?>
