<?php
session_start();
require '../../jwt_helper.php';

// ако веќе има валиден JWT → прати на листа
if (isset($_SESSION['jwt']) && decodeJWT($_SESSION['jwt']) !== false) {
    header("Location: ../create.php");
    exit;
}

$error = $_SESSION['error'] ?? null;
$success = $_SESSION['success'] ?? null;
unset($_SESSION['error'], $_SESSION['success']);
?>
<h2>Login</h2>

<?php if ($error): ?>
    <p style="color:red;"><?= htmlspecialchars($error) ?></p>
<?php endif; ?>

<?php if ($success): ?>
    <p style="color:green;"><?= htmlspecialchars($success) ?></p>
<?php endif; ?>

<form action="../../handlers/auth/login_handler.php" method="POST">
    <div>
        <label for="username">Username</label>
        <input type="text" name="username" id="username" required>
    </div>
    <br>
    <div>
        <label for="password">Password</label>
        <input type="password" name="password" id="password" required>
    </div>
    <br>
    <button type="submit">Login</button>
    <p>
        <a href="register.php">Register here</a>
    </p>
</form>
