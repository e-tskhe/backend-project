<?php
ob_start();

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

header('Content-Type: application/json; charset=UTF-8');
header("X-Frame-Options: DENY");
header("X-Content-Type-Options: nosniff");
header("X-XSS-Protection: 1; mode=block");
header("Referrer-Policy: no-referrer-when-downgrade");

require_once 'tokens.php';
require_once 'db.php';

$method = $_SERVER['REQUEST_METHOD'];

try {
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        throw new Exception('Разрешен только метод POST');
    }

    $input = json_decode(file_get_contents('php://input'), true);
    if (json_last_error() !== JSON_ERROR_NONE) {
        throw new Exception('Неверный JSON');
    }

    // Проверка CSRF-токена только для POST-запросов
    if ($method === 'POST') {
        if (!isset($input['csrf_token']) || !validateCSRFToken($input['csrf_token'])) {
            throw new Exception('Недействительный CSRF-токен');
        }
    }

    $required = ['name', 'tel', 'email', 'message', 'contract'];
    foreach ($required as $field) {
        if (empty($input[$field])) {
            throw new Exception("Поле $field обязательно для заполнения");
        }
    }

    if (!filter_var($input['email'], FILTER_VALIDATE_EMAIL)) {
        throw new Exception('Неверный формат email');
    }


    $pdo = getDBConnection();
    
    if (isset($_SESSION['user_id'])) {
        $stmt = $pdo->prepare("INSERT INTO support_requests (user_id, name, tel, email, message) VALUES (?, ?, ?, ?, ?)");
        $stmt->execute([$_SESSION['user_id'], $input['name'], $input['tel'], $input['email'], $input['message']]);
        
        $response = ['success' => true, 'message' => 'Заявка успешно создана'];
    } else {
        $username = 'user_' . uniqid();
        $password = bin2hex(random_bytes(4));
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        
        $stmt = $pdo->prepare("INSERT INTO support_users (username, password) VALUES (?, ?)");
        $stmt->execute([$username, $hashedPassword]);
        $userId = $pdo->lastInsertId();
        
        $stmt = $pdo->prepare("INSERT INTO support_requests (user_id, name, tel, email, message) VALUES (?, ?, ?, ?, ?)");
        $stmt->execute([$userId, $input['name'], $input['tel'], $input['email'], $input['message']]);
        
        $_SESSION['user_id'] = $userId;
        $_SESSION['username'] = $username;
        
        $response = [
            'success' => true,
            'message' => 'Аккаунт создан',
            'credentials' => [
                'username' => $username,
                'password' => $password
            ],
            'redirect' => '/profile.php'
        ];
    }

    ob_end_clean();
    echo json_encode($response);
    
} catch (Exception $e) {
    ob_end_clean();
    
    http_response_code(400);
    echo json_encode([
        'success' => false,
        'error' => $e->getMessage()
    ]);
}
?>