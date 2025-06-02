<?php
session_start();
header("Content-Type: text/html; charset=UTF-8");

$config = require 'config.php';
require_once 'db.php';

$db = getDBConnection();

$userId = isset($_GET['user']) ? (int)$_GET['user'] : 0;

// Получаем данные пользователя
$userStmt = $db->prepare("SELECT * FROM users WHERE id = ?");
$userStmt->execute([$userId]);
$user = $userStmt->fetch();

// Получаем последнюю заявку пользователя
$requestStmt = $db->prepare("SELECT * FROM support_requests WHERE user_id = ? ORDER BY submitted_at DESC LIMIT 1");
$requestStmt->execute([$userId]);
$requestData = $requestStmt->fetch();

if (!$user || !$requestData) {
    die("Пользователь или данные не найдены");
}
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Профиль пользователя</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="profile-container">
        <h1>Профиль пользователя</h1>
        
        <?php if (isset($_SESSION['user_id']) && $_SESSION['user_id'] == $userId): ?>
            <div class="auth-info">
                Вы вошли как: <strong><?= htmlspecialchars($_SESSION['login']) ?></strong>
                <a href="logout.php" class="logout-btn">Выйти</a>
            </div>
        <?php endif; ?>
        
        <div class="request-details">
            <h2>Ваша заявка на поддержку</h2>
            <p><strong>Имя:</strong> <?= htmlspecialchars($requestData['name']) ?></p>
            <p><strong>Телефон:</strong> <?= htmlspecialchars($requestData['tel']) ?></p>
            <p><strong>Email:</strong> <?= htmlspecialchars($requestData['email']) ?></p>
            <p><strong>Сообщение:</strong> <?= nl2br(htmlspecialchars($requestData['message'])) ?></p>
            <p><strong>Дата отправки:</strong> <?= htmlspecialchars($requestData['submitted_at']) ?></p>
            
            <?php if (isset($_SESSION['user_id']) && $_SESSION['user_id'] == $userId): ?>
                <a href="/form.php" class="edit-btn">Редактировать заявку</a>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>