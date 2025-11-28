<?php
session_start();
require './database/db_connection.php';
require './jwt_helper.php';

// Проверка на JWT токен
if (!isset($_SESSION['jwt']) || !decodeJWT($_SESSION['jwt'])) {
    header("Location: pages/auth/login.php");
    exit;
}

$db = connectDatabase();

// Земаме сите настани
$query = "SELECT * FROM events ORDER BY event_date ASC";
$result = $db->query($query);

if (!$result) {
    die("Error fetching events: " . $db->lastErrorMsg());
}
?>

<body>
<div>
    <h1>Events List</h1>

    <a href="pages/create.php">Add Event</a>
    <a href="handlers/auth/logout_handler.php">Одјави се</a>
</div>

<table border="1" cellpadding="5">
    <thead>
    <tr>
        <th>ID</th>
        <th>Име</th>
        <th>Датум</th>
        <th>Локација</th>
        <th>Тип</th>
        <th>Акции</th>
    </tr>
    </thead>

    <tbody>
    <?php if ($result): ?>
        <?php while ($event = $result->fetchArray(SQLITE3_ASSOC)): ?>
            <tr>
                <td><?= htmlspecialchars($event['id']); ?></td>
                <td><?= htmlspecialchars($event['name']); ?></td>
                <td><?= htmlspecialchars($event['event_date']); ?></td>
                <td><?= htmlspecialchars($event['location']); ?></td>
                <td><?= htmlspecialchars($event['event_type']); ?></td>
                <td>

                    <?php if ($event['event_type'] === 'јавен'): ?>
                        <form action="handlers/delete_handler.php" method="get" style="display:inline;">
                            <input type="hidden" name="id" value="<?= $event['id']; ?>">
                            <button type="submit">Delete</button>
                        </form>
                    <?php endif; ?>

                    <form action="pages/edit.php" method="get" style="display:inline;">
                        <input type="hidden" name="id" value="<?= $event['id']; ?>">
                        <button type="submit">Update</button>
                    </form>

                </td>
            </tr>
        <?php endwhile; ?>
    <?php else: ?>
        <tr>
            <td colspan="6">No events found.</td>
        </tr>
    <?php endif; ?>
    </tbody>
</table>
</body>
