<?php
session_start();
header("Content-Type: text/html; charset=UTF-8");

if (!isset($_SESSION['user_id'])) {
    header("Location: /");
    exit;
}

require_once 'db.php';
$db = getDBConnection();

$userId = $_SESSION['user_id'];

// Получаем данные пользователя
$userStmt = $db->prepare("SELECT * FROM support_users WHERE id = ?");
$userStmt->execute([$userId]);
$user = $userStmt->fetch();

// Получаем все заявки пользователя
$requestsStmt = $db->prepare("SELECT * FROM support_requests WHERE user_id = ? ORDER BY submitted_at DESC");
$requestsStmt->execute([$userId]);
$requests = $requestsStmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Профиль пользователя</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container py-5">
        <div class="row">
            <div class="col-md-8 mx-auto">
                <div class="card shadow">
                    <div class="card-header bg-primary text-white">
                        <h1 class="card-title mb-0">Профиль пользователя</h1>
                    </div>
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <div>
                                <h3>Добро пожаловать, <strong><?= htmlspecialchars($user['username']) ?></strong></h3>
                                <p class="text-muted">Дата регистрации: <?= date('d.m.Y', strtotime($user['created_at'] ?? 'now')) ?></p>
                            </div>
                            <a href="logout.php" class="btn btn-danger">Выйти</a>
                        </div>

                        <div class="mb-4">
                            <h4>Ваши заявки на поддержку</h4>
                            <?php if (empty($requests)): ?>
                                <div class="alert alert-info">У вас пока нет заявок</div>
                            <?php else: ?>
                                <div class="list-group">
                                    <?php foreach ($requests as $request): ?>
                                        <div class="list-group-item mb-3">
                                            <div class="d-flex justify-content-between">
                                                <h5 class="mb-1">Заявка #<?= $request['id'] ?></h5>
                                                <small class="text-muted"><?= date('d.m.Y H:i', strtotime($request['submitted_at'])) ?></small>
                                            </div>
                                            <p class="mb-1"><strong>Имя:</strong> <?= htmlspecialchars($request['name']) ?></p>
                                            <p class="mb-1"><strong>Телефон:</strong> <?= htmlspecialchars($request['tel']) ?></p>
                                            <p class="mb-1"><strong>Email:</strong> <?= htmlspecialchars($request['email']) ?></p>
                                            <p class="mb-1"><strong>Сообщение:</strong></p>
                                            <p><?= nl2br(htmlspecialchars($request['message'])) ?></p>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            <?php endif; ?>
                        </div>

                        <a href="/" class="btn btn-primary">На главную</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>