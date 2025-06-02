<?php
header("Content-Type: application/json");
header("X-Frame-Options: DENY");
header("X-Content-Type-Options: nosniff");
header("X-XSS-Protection: 1; mode=block");
header("Referrer-Policy: no-referrer-when-downgrade");

// Настройки сессии
session_set_cookie_params([
    'lifetime' => 86400,
    'path' => '/',
    'domain' => $_SERVER['HTTP_HOST'],
    'secure' => true,
    'httponly' => true,
    'samesite' => 'Strict'
]);

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once 'db.php';
require_once 'tokens.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['success' => false, 'error' => 'Method not allowed']);
    exit;
}

// Получаем данные из формы
$input = $_POST; // Изменено с json_decode на $_POST

// Проверка CSRF токена
if (empty($input['csrf_token']) || !hash_equals($_SESSION['csrf_token'] ?? '', $input['csrf_token'])) {
    http_response_code(403);
    echo json_encode(['success' => false, 'error' => 'Неверный CSRF токен']);
    exit;
}

// Валидация данных
$errors = [];

if (empty($input['name']) || !preg_match('/^[А-Яа-яЁё\s\-]+$/u', $input['name'])) {
    $errors['name'] = 'Некорректное имя (допустимы только русские буквы и пробелы)';
}

if (empty($input['tel']) || !preg_match('/^\+7 \(\d{3}\) \d{3}-\d{2}-\d{2}$/', $input['tel'])) {
    $errors['tel'] = 'Некорректный номер телефона (формат: +7 (XXX) XXX-XX-XX)';
}

if (empty($input['email']) || !filter_var($input['email'], FILTER_VALIDATE_EMAIL)) {
    $errors['email'] = 'Некорректный email';
}

if (empty($input['message']) || strlen($input['message']) > 1000) {
    $errors['message'] = 'Сообщение должно быть не длиннее 1000 символов';
}

if (empty($input['contract']) || $input['contract'] !== 'on') { // Изменено для стандартного чекбокса
    $errors['contract'] = 'Необходимо согласие на обработку данных';
}

if (!empty($errors)) {
    http_response_code(422);
    echo json_encode(['success' => false, 'errors' => $errors]);
    exit;
}

try {
    $db = getDBConnection();
    
    if (isset($_SESSION['user_id'])) {
        // Для авторизованных пользователей
        $stmt = $db->prepare("INSERT INTO support_requests 
            (user_id, name, tel, email, message) 
            VALUES (:user_id, :name, :tel, :email, :message)");
        
        $stmt->execute([
            ':user_id' => $_SESSION['user_id'],
            ':name' => htmlspecialchars($input['name'], ENT_QUOTES, 'UTF-8'),
            ':tel' => htmlspecialchars($input['tel'], ENT_QUOTES, 'UTF-8'),
            ':email' => htmlspecialchars($input['email'], ENT_QUOTES, 'UTF-8'),
            ':message' => htmlspecialchars($input['message'], ENT_QUOTES, 'UTF-8')
        ]);
        
        echo json_encode([
            'success' => true,
            'message' => 'Заявка успешно создана'
        ]);
    } else {
        // Для новых пользователей
        $username = 'user_' . bin2hex(random_bytes(4));
        $password = bin2hex(random_bytes(4));
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        
        // Создаем пользователя
        $stmt = $db->prepare("INSERT INTO support_users 
            (username, password) 
            VALUES (:username, :password)");
        $stmt->execute([
            ':username' => $username,
            ':password' => $hashedPassword
        ]);
        
        $userId = $db->lastInsertId();
        
        // Сохраняем заявку
        $stmt = $db->prepare("INSERT INTO support_requests 
            (user_id, name, tel, email, message) 
            VALUES (:user_id, :name, :tel, :email, :message)");
        
        $stmt->execute([
            ':user_id' => $userId,
            ':name' => htmlspecialchars($input['name'], ENT_QUOTES, 'UTF-8'),
            ':tel' => htmlspecialchars($input['tel'], ENT_QUOTES, 'UTF-8'),
            ':email' => htmlspecialchars($input['email'], ENT_QUOTES, 'UTF-8'),
            ':message' => htmlspecialchars($input['message'], ENT_QUOTES, 'UTF-8')
        ]);
        
        // Устанавливаем сессию
        $_SESSION['user_id'] = $userId;
        $_SESSION['login'] = $username;
        
        echo json_encode([
            'success' => true,
            'message' => 'Аккаунт создан',
            'username' => $username,
            'password' => $password,
            'profile_url' => '/profile.php'
        ]);
    }
} catch(PDOException $e) {
    error_log('Database error: ' . $e->getMessage());
    http_response_code(500);
    echo json_encode([
        'success' => false,
        'error' => 'Database error',
        'message' => 'Произошла ошибка при обработке запроса'
    ]);
}
?>