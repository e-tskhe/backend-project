<?php
header('Content-Type: application/json');
require_once 'tokens.php';
require_once 'db.php';

verifyCSRFToken();

$method = $_SERVER['REQUEST_METHOD'];
$input = json_decode(file_get_contents('php://input'), true);

try {
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
        session_start();
        $userId = $_SESSION['user_id'] ?? null;
        
        if ($userId) {
            // Для авторизованного пользователя - обновляем данные
            $stmt = $pdo->prepare("UPDATE support_requests SET name = ?, tel = ?, email = ?, message = ? WHERE user_id = ?");
            $stmt->execute([$input['name'], $input['tel'], $input['email'], $input['message'], $userId]);
            
            echo json_encode(['success' => true, 'message' => 'Данные успешно обновлены']);
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
            
            echo json_encode([
                'success' => true,
                'message' => 'Форма успешно отправлена!',
                'username' => $username,
                'password' => $password,
                'profile_url' => '/profile.php'
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