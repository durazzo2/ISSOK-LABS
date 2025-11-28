<?php
require_once 'db.php';
$db = db_connect();

$id = $_GET['id'] ?? null;
if (!$id) {
    header("Location: index.php");
    exit;
}

$task = $db->querySingle("SELECT * FROM tasks WHERE id = $id", true);
if (!$task) {
    die("Задачата не е пронајдена.");
}
?>
<!DOCTYPE html>
<html lang="mk">
<head>
    <meta charset="UTF-8">
    <title>Ажурирај задача</title>
</head>
<body>
<h1>Ажурирај задача</h1>

<?php
if (isset($_GET['error'])) {
    echo "<p style='color:red'>" . htmlspecialchars($_GET['error']) . "</p>";
}
?>

<form method="POST" action="edit.php">
    <input type="hidden" name="id" value="<?= $task['id'] ?>">
    <p>Наслов: <input type="text" name="title" value="<?= htmlspecialchars($task['title']) ?>"></p>
    <p>Рок: <input type="date" name="due_date" value="<?= htmlspecialchars($task['due_date']) ?>"></p>
    <p>Приоритет:
        <select name="priority">
            <?php foreach (['Low','Medium','High'] as $p): ?>
                <option value="<?= $p ?>" <?= $task['priority'] === $p ? 'selected' : '' ?>><?= $p ?></option>
            <?php endforeach; ?>
        </select>
    </p>
    <p>Статус:
        <select name="status">
            <?php foreach (['Pending','Done'] as $s): ?>
                <option value="<?= $s ?>" <?= $task['status'] === $s ? 'selected' : '' ?>><?= $s ?></option>
            <?php endforeach; ?>
        </select>
    </p>
    <p>
        <button type="submit">Зачувај</button>
        <a href="index.php">Откажи</a>
    </p>
</form>
</body>
</html>
