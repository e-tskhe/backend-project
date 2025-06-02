<?php
require_once 'tokens.php';
require_once 'db.php';

session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: /index.html');
    exit;
}

$pdo = getDBConnection();
$userId = $_SESSION['user_id'];

// Получаем данные пользователя
$stmt = $pdo->prepare("SELECT username FROM support_users WHERE id = ?");
$stmt->execute([$userId]);
$user = $stmt->fetch();

// Получаем данные формы
$stmt = $pdo->prepare("SELECT name, tel, email, message FROM support_requests WHERE user_id = ?");
$stmt->execute([$userId]);
$formData = $stmt->fetch();

?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Профиль пользователя</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1>Профиль пользователя</h1>
        <p>Логин: <?= htmlspecialchars($user['username']) ?></p>
        
        <form id="profileForm" method="POST" action="/api.php">
            <input type="hidden" name="csrf_token" value="<?= generateCSRFToken() ?>">
            
            <div class="mb-3">
                <label for="name" class="form-label">Имя</label>
                <input type="text" class="form-control" id="name" name="name" 
                       value="<?= htmlspecialchars($formData['name'] ?? '') ?>" required>
            </div>
            
            <div class="mb-3">
                <label for="tel" class="form-label">Телефон</label>
                <input type="tel" class="form-control" id="tel" name="tel" 
                       value="<?= htmlspecialchars($formData['tel'] ?? '') ?>" required>
            </div>
            
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" 
                       value="<?= htmlspecialchars($formData['email'] ?? '') ?>" required>
            </div>
            
            <div class="mb-3">
                <label for="message" class="form-label">Сообщение</label>
                <textarea class="form-control" id="message" name="message" rows="3" required><?= 
                    htmlspecialchars($formData['message'] ?? '') ?></textarea>
            </div>
            
            <div class="mb-3 form-check">
                <input type="checkbox" class="form-check-input" id="contract" name="contract" required checked>
                <label class="form-check-label" for="contract">Согласен на обработку данных</label>
            </div>
            
            <button type="submit" class="btn btn-primary">Обновить данные</button>
            <a href="/logout.php" class="btn btn-danger">Выйти</a>
        </form>
        
        <div id="response-message" class="mt-3"></div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="js/form.js"></script>
</body>
</html>