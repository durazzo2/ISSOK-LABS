<?php
session_start();
require '../jwt_helper.php';
require_login();
require '../database/db_connection.php';

$db = connectDatabase();
$result = $db->query("SELECT * FROM events ORDER BY event_date ASC");

$error = $_SESSION['error'] ?? null;
unset($_SESSION['error']);
?>

<h2>Настани</h2>

<p>
    Најавен корисник: <strong><?= htmlspecialchars($_SESSION['username'] ?? '') ?></strong>
    | <a href="../handlers/auth/logout_handler.php">Одјава</a>
</p>

<?php if ($error): ?>
    <p style="color:red;"><?= htmlspecialchars($error) ?></p>
<?php endif; ?>

<h3>Додај нов настан</h3>

<form action="../handlers/create_handler.php" method="POST">
    <div>
        <label>Име на настан</label>
        <input type="text" name="name" required>
    </div>
    <br>
    <div>
        <label>Локација</label>
        <input type="text" name="location" required>
    </div>
    <br>
    <div>
        <label>Датум</label>
        <input type="date" name="event_date" required>
    </div>
    <br>
    <div>
        <label>Тип</label>
        <select name="event_type">
            <option value="јавен">Јавен</option>
            <option value="приватен">Приватен</option>
        </select>
    </div>
    <br>
    <button type="submit">Зачувај</button>
</form>

<hr>

<h3>Листа на настани</h3>

<table border="1" cellpadding="5" cellspacing="0">
    <tr>
        <th>Име</th>
        <th>Датум</th>
        <th>Локација</th>
        <th>Тип</th>
        <th>Акции</th>
    </tr>

    <?php while ($row = $result->fetchArray(SQLITE3_ASSOC)): ?>
        <tr>
            <td><?= htmlspecialchars($row['name']) ?></td>
            <td><?= htmlspecialchars($row['event_date']) ?></td>
            <td><?= htmlspecialchars($row['location']) ?></td>
            <td><?= htmlspecialchars($row['event_type']) ?></td>
            <td>
                <a href="edit.php?id=<?= $row['id'] ?>">Ажурирај</a> |
                <a href="../handlers/delete_handler.php?id=<?= $row['id'] ?>" onclick="return confirm('Дали сте сигурни?');">
                    Избриши
                </a>
            </td>
        </tr>
    <?php endwhile; ?>
</table>
