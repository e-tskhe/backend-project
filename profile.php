<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
header("Content-Type: text/html; charset=UTF-8");

if (!isset($_SESSION['user_id'])) {
    header("Location: /");
    exit;
}

require_once 'db.php';
$db = getDBConnection();

$userId = $_SESSION['user_id'];

// Обработка редактирования заявки
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['edit_request'])) {
    $requestId = $_POST['request_id'];
    $name = $_POST['name'];
    $tel = $_POST['tel'];
    $email = $_POST['email'];
    $message = $_POST['message'];

    // Проверяем, принадлежит ли заявка текущему пользователю
    $checkStmt = $db->prepare("SELECT user_id FROM support_requests WHERE id = ?");
    $checkStmt->execute([$requestId]);
    $requestOwner = $checkStmt->fetchColumn();

    if ($requestOwner == $userId) {
        $updateStmt = $db->prepare("UPDATE support_requests SET name = ?, tel = ?, email = ?, message = ? WHERE id = ?");
        $updateStmt->execute([$name, $tel, $email, $message, $requestId]);
        $_SESSION['success_message'] = 'Заявка успешно обновлена';
        header("Location: profile.php");
        exit;
    } else {
        $_SESSION['error_message'] = 'Вы не можете редактировать эту заявку';
        header("Location: profile.php");
        exit;
    }
}

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
                <?php if (isset($_SESSION['success_message'])): ?>
                    <div class="alert alert-success"><?= $_SESSION['success_message'] ?></div>
                    <?php unset($_SESSION['success_message']); ?>
                <?php endif; ?>
                <?php if (isset($_SESSION['error_message'])): ?>
                    <div class="alert alert-danger"><?= $_SESSION['error_message'] ?></div>
                    <?php unset($_SESSION['error_message']); ?>
                <?php endif; ?>
                
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
                                            
                                            <div id="request-view-<?= $request['id'] ?>">
                                                <p class="mb-1"><strong>Имя:</strong> <?= htmlspecialchars($request['name']) ?></p>
                                                <p class="mb-1"><strong>Телефон:</strong> <?= htmlspecialchars($request['tel']) ?></p>
                                                <p class="mb-1"><strong>Email:</strong> <?= htmlspecialchars($request['email']) ?></p>
                                                <p class="mb-1"><strong>Сообщение:</strong></p>
                                                <p><?= nl2br(htmlspecialchars($request['message'])) ?></p>
                                                <button class="btn btn-sm btn-primary edit-btn" data-request-id="<?= $request['id'] ?>">Редактировать</button>
                                            </div>
                                            
                                            <div id="request-edit-<?= $request['id'] ?>" style="display: none;">
                                                <form method="POST" action="profile.php">
                                                    <input type="hidden" name="request_id" value="<?= $request['id'] ?>">
                                                    <div class="mb-3">
                                                        <label for="name-<?= $request['id'] ?>" class="form-label">Имя</label>
                                                        <input type="text" class="form-control" id="name-<?= $request['id'] ?>" name="name" value="<?= htmlspecialchars($request['name']) ?>" required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="tel-<?= $request['id'] ?>" class="form-label">Телефон</label>
                                                        <input type="text" class="form-control" id="tel-<?= $request['id'] ?>" name="tel" value="<?= htmlspecialchars($request['tel']) ?>" required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="email-<?= $request['id'] ?>" class="form-label">Email</label>
                                                        <input type="email" class="form-control" id="email-<?= $request['id'] ?>" name="email" value="<?= htmlspecialchars($request['email']) ?>" required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="message-<?= $request['id'] ?>" class="form-label">Сообщение</label>
                                                        <textarea class="form-control" id="message-<?= $request['id'] ?>" name="message" rows="3" required><?= htmlspecialchars($request['message']) ?></textarea>
                                                    </div>
                                                    <button type="submit" class="btn btn-success" name="edit_request">Сохранить</button>
                                                    <button type="button" class="btn btn-secondary cancel-edit" data-request-id="<?= $request['id'] ?>">Отмена</button>
                                                </form>
                                            </div>
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
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Обработка кнопки редактирования
            document.querySelectorAll('.edit-btn').forEach(button => {
                button.addEventListener('click', function() {
                    const requestId = this.getAttribute('data-request-id');
                    document.getElementById(`request-view-${requestId}`).style.display = 'none';
                    document.getElementById(`request-edit-${requestId}`).style.display = 'block';
                });
            });
            
            // Обработка кнопки отмены редактирования
            document.querySelectorAll('.cancel-edit').forEach(button => {
                button.addEventListener('click', function() {
                    const requestId = this.getAttribute('data-request-id');
                    document.getElementById(`request-edit-${requestId}`).style.display = 'none';
                    document.getElementById(`request-view-${requestId}`).style.display = 'block';
                });
            });
        });
    </script>
</body>
</html>