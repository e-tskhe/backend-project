<?php
header("X-Frame-Options: DENY");
header("X-Content-Type-Options: nosniff");
header("X-XSS-Protection: 1; mode=block");
header("Referrer-Policy: no-referrer-when-downgrade");
header('Content-Type: text/html; charset=UTF-8');


require_once 'db.php';
require_once 'tokens.php';
generateCSRFToken();
$_SESSION['csrf_token'] = generateCSRFToken();

if (!empty($_SESSION['login'])) {
    header('Location: profile.php');
    exit();
}

$error = '';


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    verifyCSRFToken();
    $username = trim($_POST['username'] ?? '');
    $password = trim($_POST['password'] ?? '');
    if (empty($_POST['username'])) {
        $error = 'Введите логин';
    }
    elseif (empty($_POST['password'])) {
        $error = 'Введите пароль';
    }
    if (!empty($error)) {
        http_response_code(400);
        echo json_encode(['error' => $error]);
        exit;
    }
    else {
        try {
            $db = getDBConnection();

            $stmt = $db->prepare("SELECT id, username, password FROM support_users WHERE username = :username");
            $stmt->execute([':username' => $username]);
            $user = $stmt->fetch();

            if ($user && password_verify($_POST['password'], $user['password'])) {               
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['login'] = $user['username'];

                echo json_encode([
                    'success' => true,
                    'message' => 'Авторизация успешна',
                    'profile_url' => '/profile.php'
                ]);

                exit;
            }
            else {
                http_response_code(401);
                echo json_encode(['error' => 'Неверное имя пользователя или пароль']);
            }
        } catch (PDOException $e) {
            http_response_code(500);
            $error = "Ошибка базы данных.";
        }
    }
}
?>

