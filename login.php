<?php
header('Content-Type: application/json');
require_once 'tokens.php';
require_once 'db.php';

session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $input = json_decode(file_get_contents('php://input'), true) ?? $_POST;
        
        if (empty($input['username']) || empty($input['password'])) {
            throw new Exception('Логин и пароль обязательны');
        }
        
        $pdo = getDBConnection();
        $stmt = $pdo->prepare("SELECT id, password FROM support_users WHERE username = ?");
        $stmt->execute([$input['username']]);
        $user = $stmt->fetch();
        
        if (!$user || !password_verify($input['password'], $user['password'])) {
            throw new Exception('Неверный логин или пароль');
        }
        
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $input['username'];
        
        echo json_encode([
            'success' => true,
            'message' => 'Авторизация успешна',
            'profile_url' => '/profile.php'
        ]);
    } catch (Exception $e) {
        http_response_code(401);
        echo json_encode(['success' => false, 'error' => $e->getMessage()]);
    }
} else {
    http_response_code(405);
    echo json_encode(['success' => false, 'error' => 'Метод не поддерживается']);
}
?>