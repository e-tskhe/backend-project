<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

header("X-Frame-Options: DENY");
header("X-Content-Type-Options: nosniff");
header("X-XSS-Protection: 1; mode=block");
header("Referrer-Policy: no-referrer-when-downgrade");
header('Content-Type: text/html; charset=UTF-8');

require_once 'db.php';
require_once 'tokens.php';

if (!empty($_SESSION['login'])) {
    header('Location: profile.php');
    exit();
}

$error = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = trim($_POST['password'] ?? '');
    
    if (empty($_POST['username'])) {
        $error = 'Введите логин';
    } elseif (empty($_POST['password'])) {
        $error = 'Введите пароль';
    } else {
        try {
            $db = getDBConnection();

            $stmt = $db->prepare("SELECT id, username, password FROM support_users WHERE username = :username");
            $stmt->execute([':username' => $username]);
            $user = $stmt->fetch();

            if ($user && password_verify($password, $user['password'])) {
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['login'] = $user['username'];

                header('Location: profile.php');
                exit();
            } else {
                $error = 'Неверный логин или пароль.';
            }
        } catch (PDOException $e) {
            $error = 'Ошибка базы данных.';
        }
    }
}
?>