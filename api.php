<?php
header('Content-Type: application/json; charset=UTF-8');
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

require_once 'tokens.php';
require_once 'db.php';

$method = $_SERVER['REQUEST_METHOD'];
$input = json_decode(file_get_contents('php://input'), true);

try {
    // Проверка CSRF-токена
    if (!isset($input['csrf_token']) || !validateCSRFToken($input['csrf_token'])) {
        throw new Exception('Недействительный CSRF-токен');
    }

    $pdo = getDBConnection();
    
    if ($method === 'POST') {
        // Проверка данных
        if (empty($input['name']) || empty($input['tel']) || empty($input['email']) || empty($input['message'])) {
            throw new Exception('Все поля обязательны для заполнения');
        }
        
        if (!filter_var($input['email'], FILTER_VALIDATE_EMAIL)) {
            throw new Exception('Некорректный email');
        }
        
        if (empty($input['contract'])) {
            throw new Exception('Необходимо согласие на обработку данных');
        }
        
        // Проверяем авторизацию пользователя
        $userId = $_SESSION['user_id'] ?? null;
        
        if ($userId) {
            // Для авторизованного пользователя - создаем новую заявку
            $stmt = $pdo->prepare("INSERT INTO support_requests (user_id, name, tel, email, message) VALUES (?, ?, ?, ?, ?)");
            $stmt->execute([$userId, $input['name'], $input['tel'], $input['email'], $input['message']]);
            
            echo json_encode(['success' => true, 'message' => 'Заявка успешно создана']);
        } else {
            // Для неавторизованного - создаем нового пользователя и запись
            $username = 'user_' . uniqid();
            $password = bin2hex(random_bytes(4));
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
            
            // Создаем пользователя
            $stmt = $pdo->prepare("INSERT INTO support_users (username, password) VALUES (?, ?)");
            $stmt->execute([$username, $hashedPassword]);
            $userId = $pdo->lastInsertId();
            
            // Создаем запрос
            $stmt = $pdo->prepare("INSERT INTO support_requests (user_id, name, tel, email, message) VALUES (?, ?, ?, ?, ?)");
            $stmt->execute([$userId, $input['name'], $input['tel'], $input['email'], $input['message']]);
            
            // Устанавливаем сессию для нового пользователя
            $_SESSION['user_id'] = $userId;
            $_SESSION['username'] = $username;
            
            echo json_encode([
                'success' => true,
                'message' => 'Форма успешно отправлена! Ваши данные для входа:',
                'username' => $username,
                'password' => $password,
                'redirect' => '/profile.php'
            ]);
        }
    } else {
        throw new Exception('Метод не поддерживается');
    }
} catch (Exception $e) {
    http_response_code(400);
    echo json_encode(['success' => false, 'error' => $e->getMessage()]);
}
?>