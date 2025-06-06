<?php

header("X-Frame-Options: DENY");
header("X-Content-Type-Options: nosniff");
header("X-XSS-Protection: 1; mode=block");
header("Referrer-Policy: no-referrer-when-downgrade");
header('Content-Type: text/html; charset=UTF-8');


require_once 'db.php';
require_once 'tokens.php';
generateCSRFToken();

if (!empty($_SESSION['login'])) {
    header('Location: index.php');
    exit();
}

$error = '';


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = trim($_POST['password'] ?? '');
    if (empty($_POST['username'])) {
        $error = 'Введите логин';
    }
    elseif (empty($_POST['password'])) {
        $error = 'Введите пароль';
    }
    else {
        try {
            $pdo = getDBConnection();

            $stmt = $pdo->prepare("SELECT id, username, password FROM support_users WHERE username = :username");
            $stmt->execute([$username]);
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($user && password_verify($password, $user['password'])) {
                $_SESSION['username'] = $_POST['username'];
                $_SESSION['user_id'] = $user['id'];

                header('Location: profile.php');
                
                exit();
            } else {
                $error = "Неверный логин или пароль";
            }
        } catch (PDOException $e) {
            $error = "Ошибка базы данных.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Авторизация</title>
    <link rel="stylesheet" href="style_login.css">
</head>
<body>
    <div class="auth-section">
        <form method="POST" class="auth-form">
            <input type="hidden" name="csrf_token" value="<?= generateCSRFToken(); ?>">
            
            <h3>Вход в систему</h3>

            <?php if (!empty($error)): ?>
                <div class="error"><?= htmlspecialchars($error) ?></div>
            <?php endif; ?>

            <div class="form-group">
                <label for="username">Логин:</label>
                <input type="text" id="username" name="username" required 
                    value="<?= !empty($_POST['username']) ? htmlspecialchars($_POST['username']) : '' ?>">
            </div>
            
            <div class="form-group">
                <label for="password">Пароль:</label>
                <input type="password" id="password" name="password" required>
            </div>

            <button type="submit" class="auth-btn">ВОЙТИ</button>

            <?php if (!empty($_COOKIE['username']) && !empty($_COOKIE['password'])): ?>
                <div class="auth-hint">
                    Ваши данные для входа:<br>
                    Логин: <?= htmlspecialchars($_COOKIE['username']) ?><br>
                    Пароль: <?= htmlspecialchars($_COOKIE['password']) ?>
                </div>
            <?php endif; ?>
        </form>
    </div>
</body>
</html>