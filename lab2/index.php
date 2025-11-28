<?php
require_once 'db.php';
$db = db_connect();

$allowedSorts = ['due_date', 'priority', 'status'];
$sort = $_GET['sort'] ?? 'due_date';
$order = $_GET['order'] ?? 'asc';

if (!in_array($sort, $allowedSorts)) {
    $sort = 'due_date';
}
$order = strtolower($order) === 'desc' ? 'desc' : 'asc';

$nextOrder = $order === 'asc' ? 'desc' : 'asc';

if ($sort === 'priority') {
    if ($order === 'asc') {
        $query = "
            SELECT * FROM tasks
            ORDER BY CASE priority
                WHEN 'High' THEN 1
                WHEN 'Medium' THEN 2
                WHEN 'Low' THEN 3
            END ASC
        ";
    } else {
        $query = "
            SELECT * FROM tasks
            ORDER BY CASE priority
                WHEN 'Low' THEN 1
                WHEN 'Medium' THEN 2
                WHEN 'High' THEN 3
            END ASC
        ";
    }
} else {
    $query = "SELECT * FROM tasks ORDER BY $sort $order";
}

$result = $db->query($query);

$tasks = [];
while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
    $tasks[] = $row;
}

$flash = $_GET['flash'] ?? null;
?>
<!DOCTYPE html>
<html lang="mk">
<head>
    <meta charset="UTF-8">
    <title>Листа на задачи</title>
</head>
<body>
<h1>Листа на задачи</h1>

<?php if ($flash): ?>
    <p style="color: green;"><?= htmlspecialchars($flash) ?></p>
<?php endif; ?>

<p><a href="add_form.php">Додај нова задача</a></p>

<table border="1" cellspacing="0" cellpadding="5">
    <thead>
    <tr>
        <th>Наслов</th>
        <th><a href="?sort=due_date&order=<?= $nextOrder ?>">Рок</a></th>
        <th><a href="?sort=priority&order=<?= $nextOrder ?>">Приоритет</a></th>
        <th><a href="?sort=status&order=<?= $nextOrder ?>">Статус</a></th>
        <th>Акции</th>
    </tr>
    </thead>
    <tbody>
    <?php if (count($tasks) === 0): ?>
        <tr>
            <td colspan="5">Нема задачи.</td>
        </tr>
    <?php else: ?>
        <?php foreach ($tasks as $task): ?>
            <tr>
                <td><?= htmlspecialchars($task['title']) ?></td>
                <td><?= htmlspecialchars($task['due_date']) ?></td>
                <td><?= htmlspecialchars($task['priority']) ?></td>
                <td><?= htmlspecialchars($task['status']) ?></td>
                <td>
                    <a href="edit_form.php?id=<?= $task['id'] ?>">Ажурирај</a> |
                    <form method="POST" action="delete.php" style="display:inline"
                          onsubmit="return confirm('Дали сте сигурни дека сакате да ја избришете оваа задача?');">
                        <input type="hidden" name="id" value="<?= $task['id'] ?>">
                        <button type="submit">Избриши</button>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
    <?php endif; ?>
    </tbody>
</table>
</body>
</html>
