<?php
session_start();
require '../jwt_helper.php';
require_login();
require '../database/db_connection.php';

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

if ($id <= 0) {
    $_SESSION['error'] = "Невалиден ID.";
    header("Location: ../index.php");
    exit;
}

$db = connectDatabase();

$stmt = $db->prepare("SELECT * FROM events WHERE id = :id");
$stmt->bindValue(':id', $id, SQLITE3_INTEGER);
$event = $stmt->execute()->fetchArray(SQLITE3_ASSOC);

if (!$event) {
    $_SESSION['error'] = "Настанот не постои.";
    header("Location: ../index.php");
    exit;
}

$error = $_SESSION['error'] ?? null;
unset($_SESSION['error']);
?>
<h2>Edit Event</h2>

<?php if ($error): ?>
    <p style="color:red;"><?= htmlspecialchars($error) ?></p>
<?php endif; ?>

<form action="../handlers/edit_handler.php" method="POST">
    <input type="hidden" name="id" value="<?= $event['id'] ?>">

    <div>
        <label>Име на настан</label>
        <input type="text" name="name" value="<?= htmlspecialchars($event['name']) ?>" required>
    </div>
    <br>

    <div>
        <label>Локација</label>
        <input type="text" name="location" value="<?= htmlspecialchars($event['location']) ?>" required>
    </div>
    <br>

    <div>
        <label>Датум</label>
        <input type="date" name="event_date" value="<?= htmlspecialchars($event['event_date']) ?>" required>
    </div>
    <br>

    <div>
        <label>Тип</label>
        <select name="event_type">
            <option value="јавен" <?= $event['event_type'] === 'јавен' ? 'selected' : '' ?>>Јавен</option>
            <option value="приватен" <?= $event['event_type'] === 'приватен' ? 'selected' : '' ?>>Приватен</option>
        </select>
    </div>
    <br>

    <button type="submit">Зачувај</button>
    <a href="../index.php">Назад</a>
</form>
