<?php
header("Content-Type: application/json");
header("X-Frame-Options: DENY");
header("X-Content-Type-Options: nosniff");
header("X-XSS-Protection: 1; mode=block");
header("Referrer-Policy: no-referrer-when-downgrade");

session_start();

require_once 'tokens.php';
// verifyCSRFToken();

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
    try {
        if (isset($_SESSION['user_id'])) {
            // Обновление данных для авторизованного пользователя
            $stmt = $db->prepare("UPDATE support_requests 
                SET name = :name, tel = :tel, email = :email, message = :message 
                WHERE user_id = :user_id 
                ORDER BY submitted_at DESC 
                LIMIT 1");
            $stmt->execute([
                ':name' => $input['name'],
                ':tel' => $input['tel'],
                ':email' => $input['email'],
                ':message' => $input['message'],
                ':user_id' => $_SESSION['user_id']
            ]);
            
            echo json_encode(['success' => true, 'message' => 'Данные обновлены']);
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