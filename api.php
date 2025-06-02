<?php
header("Content-Type: application/json");
header("X-Frame-Options: DENY");
header("X-Content-Type-Options: nosniff");
header("X-XSS-Protection: 1; mode=block");
header("Referrer-Policy: no-referrer-when-downgrade");

session_set_cookie_params([
    'lifetime' => 86400,
    'path' => '/',
    'domain' => $_SERVER['HTTP_HOST'],
    'secure' => true,
    'httponly' => true,
    'samesite' => 'Strict'
]);
session_start();

require_once 'db.php';
require_once 'tokens.php';
verifyCSRFToken();

require_once 'db.php';
$db = getDBConnection();

$input = json_decode(file_get_contents('php://input'), true);
if (json_last_error() !== JSON_ERROR_NONE) {
    http_response_code(400);
    echo json_encode(['error' => 'Неверный формат JSON']);
    exit;
}

$errors = [];

if (empty($input['name']) || !preg_match('/^[А-Яа-яЁё\s\-]+$/u', $input['name'])) {
    $errors['name'] = 'Некорректное имя (допустимы только русские буквы и пробелы)';
}

if (empty($input['tel']) || !preg_match('/^[\d\+\-\(\)\s]{10,20}$/', $input['tel'])) {
    $errors['tel'] = 'Некорректный номер телефона';
}

if (empty($input['email']) || !filter_var($input['email'], FILTER_VALIDATE_EMAIL)) {
    $errors['email'] = 'Некорректный email';
}

if (empty($input['message']) || strlen($input['message']) > 1000) {
    $errors['message'] = 'Сообщение должно быть не длиннее 1000 символов';
}

if (empty($input['contract']) || $input['contract'] !== true) {
    $errors['contract'] = 'Необходимо согласие на обработку данных';
}

if (!empty($errors)) {
    http_response_code(422);
    echo json_encode(['error' => 'Ошибки валидации', 'details' => $errors]);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    verifyCSRFToken();
    $errors = false;

    if (empty($input['name']) || !preg_match('/^[А-Яа-яЁё\s\-]+$/u', $input['name'])) {
        setcookie('name_error', '1', time() + 24 * 60 * 60);
        $errors = true;
    }
    else {
        setcookie('name_value', $input['name'], time() + 30 * 24 * 60 * 60);
    }
    if (empty($input['tel']) || !preg_match('/^(\+7|7|8)\d{10}$/', $input['tel'])) {
        setcookie('tel_error', '1', time() + 24 * 60 * 60);
        $errors = true;
    }
    else {
        setcookie('tel_value', $input['tel'], time() + 30 * 24 * 60 * 60);
    }
    if (empty($input['email']) || !filter_var($input['email'], FILTER_VALIDATE_EMAIL)) {
        setcookie('email_error', '1', time() + 24 * 60 * 60);
        $errors = true;
    }
    else {
        setcookie('email_value', $input['email'], time() + 30 * 24 * 60 * 60);
    }

    if (empty($input['message']) || strlen($input['message']) > 1000) {
        setcookie('message_error', '1', time() + 24 * 60 * 60);
        $errors = true;
    }
    else {
        setcookie('message_value', $input['message'], time() + 30 * 24 * 60 * 60);
    }

    if (empty($input['contract']) || $input['contract'] !== true) {
        setcookie('contract_error', '1', time() + 24 * 60 * 60);
        $errors = true;
    }
    else {
        setcookie('contract_value', $input['contract'], time() + 30 * 24 * 60 * 60);
    }

    if ($errors) {
        header('Location: index.html');
        exit();
    }
    else {
        setcookie('name_error', '', 100000);
        setcookie('tel_error', '', 100000);
        setcookie('email_error', '', 100000);
        setcookie('message_error', '', 100000);
        setcookie('contract_error', '', 100000);
    }


    try {
        if (isset($_SESSION['user_id'])) {
            // Для авторизованных пользователей - просто добавляем заявку
            $stmt = $db->prepare("INSERT INTO support_requests 
                (user_id, name, tel, email, message) 
                VALUES (:user_id, :name, :tel, :email, :message)");
            $stmt->execute([
                ':user_id' => $_SESSION['user_id'],
                ':name' => $input['name'],
                ':tel' => $input['tel'],
                ':email' => $input['email'],
                ':message' => $input['message']
            ]);
            
            echo json_encode(['success' => true, 'message' => 'Заявка успешно создана']);
        } else {
             // Создание нового пользователя и записи
            $username = 'user_' . uniqid();
            $password = bin2hex(random_bytes(4));
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
            
            // Создаем пользователя
            $stmt = $db->prepare("INSERT INTO support_users (username, password) VALUES (:username, :password)");
            $stmt->execute([':username' => $username, ':password' => $hashedPassword]);
            $userId = $db->lastInsertId();
            
            // Сохраняем данные формы
            $stmt = $db->prepare("INSERT INTO support_requests 
                (user_id, name, tel, email, message) 
                VALUES (:user_id, :name, :tel, :email, :message)");
            $stmt->execute([
                ':user_id' => $userId,
                ':name' => $input['name'],
                ':tel' => $input['tel'],
                ':email' => $input['email'],
                ':message' => $input['message']
            ]);

            // Авторизуем пользователя
            $_SESSION['user_id'] = $userId;
            $_SESSION['login'] = $username;
            
            // Возвращаем данные нового пользователя
            echo json_encode([
                'success' => true,
                'message' => 'Аккаунт создан',
                'username' => $username,
                'password' => $password,
                'profile_url' => '/profile.php?user='.$userId
            ]);
        }
    } catch(PDOException $e) {
        http_response_code(500);
        echo json_encode(['error' => 'Database error: ' . $e->getMessage()]);
    }
} else {
    http_response_code(405);
    echo json_encode(['error' => 'Method not allowed']);
}
?>