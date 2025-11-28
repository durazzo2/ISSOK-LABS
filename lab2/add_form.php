<?php
$title = $_GET['title'] ?? '';
$due_date = $_GET['due_date'] ?? '';
$priority = $_GET['priority'] ?? '';
$status = $_GET['status'] ?? '';
$error = $_GET['error'] ?? null;
?>
<!DOCTYPE html>
<html lang="mk">
<head>
    <meta charset="UTF-8">
    <title>Додај нова задача</title>
</head>
<body>
<h1>Додај нова задача</h1>

<?php if ($error): ?>
    <p style="color: red;"><?= htmlspecialchars($error) ?></p>
<?php endif; ?>

<form method="POST" action="add.php">
    <p>Наслов:
        <input type="text" name="title" value="<?= htmlspecialchars($title) ?>">
    </p>

    <p>Рок:
        <input type="date" name="due_date" value="<?= htmlspecialchars($due_date) ?>">
    </p>

    <p>Приоритет:
        <select name="priority">
            <option value="">--Избери--</option>
            <option value="Low" <?= $priority === 'Low' ? 'selected' : '' ?>>Low</option>
            <option value="Medium" <?= $priority === 'Medium' ? 'selected' : '' ?>>Medium</option>
            <option value="High" <?= $priority === 'High' ? 'selected' : '' ?>>High</option>
        </select>
    </p>

    <p>Статус:
        <select name="status">
            <option value="">--Избери--</option>
            <option value="Pending" <?= $status === 'Pending' ? 'selected' : '' ?>>Pending</option>
            <option value="Done" <?= $status === 'Done' ? 'selected' : '' ?>>Done</option>
        </select>
    </p>

    <p>
        <button type="submit">Зачувај</button>
        <a href="index.php">Откажи</a>
    </p>
</form>
</body>
</html>
