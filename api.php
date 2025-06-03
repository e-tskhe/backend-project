<?php
header("Content-Type: application/json");
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

require_once 'db.php';
require_once 'tokens.php';
generateCSRFToken();

if ($_SERVER['REQUEST_METHOD'] == 'GET')
{
    $messages = array();

    if (!empty($_COOKIE['save']))
    {
        setcookie('save', '', 100000);

        $messages[] = 'Спасибо, результаты сохранены.';
        if (!empty($_COOKIE['password']) && !empty($_COOKIE['username']))
        {
            $messages[] = sprintf('Вы можете <a href="login.php">войти</a> с логином <strong>%s</strong>
        и паролем <strong>%s</strong> для изменения данных.', strip_tags($_COOKIE['username']) , strip_tags($_COOKIE['password']));
        }
    }

    $errors = array();
    $errors['name'] = !empty($_COOKIE['name_error']);
    $errors['tel'] = !empty($_COOKIE['tel_error']);
    $errors['email'] = !empty($_COOKIE['email_error']);
    $errors['message'] = !empty($_COOKIE['message_error']);
    $errors['contract'] = !empty($_COOKIE['contract_error']);

    if ($errors['name'])
    {
        setcookie('name_error', '', 100000);
        $messages['name'] = 'Заполните имя. Допустимы только буквы и пробелы.';
    }
    if ($errors['tel'])
    {
        setcookie('tel_error', '', 100000);
        $messages['tel'] = 'Заполните телефон в формате +7/7/8 и 10 цифр.';
    }
    if ($errors['email'])
    {
        setcookie('email_error', '', 100000);
        $messages['email'] = 'Заполните email в правильном формате.';
    }
    if ($errors['message'])
    {
        setcookie('message_error', '', 100000);
        $messages['message'] = 'Заполните биографию. Допустимы буквы, цифры и знаки препинания.';
    }
    if ($errors['contract'])
    {
        setcookie('contract_error', '', 100000);
        $messages['contract'] = 'Необходимо ваше согласие.';
    }

    $values = array();
    $values['name'] = empty($_COOKIE['name_value']) ? '' : strip_tags($_COOKIE['name_value']);
    $values['tel'] = empty($_COOKIE['tel_value']) ? '' : strip_tags($_COOKIE['tel_value']);
    $values['email'] = empty($_COOKIE['email_value']) ? '' : strip_tags($_COOKIE['email_value']);
    $values['message'] = empty($_COOKIE['message_value']) ? '' : strip_tags($_COOKIE['message_value']);
    $values['contract'] = empty($_COOKIE['contract_value']) ? '' : strip_tags($_COOKIE['contract_value']);

    if (!empty($_SESSION['username']))
    {
        try
        {
            $pdo = getDBConnection();
            $stmt = $pdo->prepare("SELECT * FROM support_requests WHERE user_id = ?");
            $stmt->execute([$_SESSION['user_id']]);
            $data = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($data)
            {
                $values['name'] = $data['name'];
                $values['tel'] = $data['tel'];
                $values['email'] = $data['email'];
                $values['message'] = $data['message'];
            }
        }
        catch(PDOException $e)
        {
            $messages[] = 'Ошибка при загрузке данных.';
        }
    }
}
else {
        verifyCSRFToken();
    $errors = false;
    if (empty($_POST['name']))
    {
        setcookie('name_error', '1', time() + 24 * 60 * 60);
        $errors = true;
    }
    else
    {
        setcookie('name_value', $_POST['name'], time() + 30 * 24 * 60 * 60);
    }
    if (empty($_POST['tel']))
    {
        setcookie('tel_error', '1', time() + 24 * 60 * 60);
        $errors = true;
    }
    elseif (!preg_match('/^(\+7|7|8)\d{10}$/', $_POST['tel']))
    {
        setcookie('tel_error', '1', time() + 24 * 60 * 60);
        $errors = true;
    }
    else
    {
        setcookie('tel_value', $_POST['tel'], time() + 30 * 24 * 60 * 60);
    }

    if (empty($_POST['email']))
    {
        setcookie('email_error', '1', time() + 24 * 60 * 60);
        $errors = true;
    }
    elseif (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL))
    {
        setcookie('email_error', '1', time() + 24 * 60 * 60);
        $errors = true;
    }
    else
    {
        setcookie('email_value', $_POST['email'], time() + 30 * 24 * 60 * 60);
    }
    if (empty($_POST['message']))
    {
        setcookie('message_error', '1', time() + 24 * 60 * 60);
        $errors = true;
    }
    elseif (!preg_match('/^[а-яёa-z0-9\s.,!?-]+$/iu', $_POST['bio']))
    {
        setcookie('message_error', '1', time() + 24 * 60 * 60);
        $errors = true;
    }
    else
    {
        setcookie('message_value', $_POST['message'], time() + 30 * 24 * 60 * 60);
    }

    if (empty($_POST['contract']))
    {
        setcookie('contract_error', '1', time() + 24 * 60 * 60);
        $errors = true;
    }
    else
    {
        setcookie('contract_value', $_POST['contract'], time() + 30 * 24 * 60 * 60);
    }

    if ($errors)
    {
        header('Location: index.php');
        exit();
    }
    else
    {
        setcookie('name_error', '', 100000);
        setcookie('tel_error', '', 100000);
        setcookie('email_error', '', 100000);
        setcookie('message_error', '', 100000);
        setcookie('contract_error', '', 100000);
    }

    try {
        $db = getDBConnection();

        if (!empty($_SESSION['username'])) {
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
        } else {
            // Создание нового пользователя и записи
            $username = 'user_' . uniqid();
            $password = bin2hex(random_bytes(4));
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            setcookie('username', $username, time() + 30 * 24 * 60 * 60);
            setcookie('password', $password, time() + 30 * 24 * 60 * 60);

            
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
            setcookie('save', '1');
            header('Location: index.php');
            exit();
        }
    } 
    catch(PDOException $e)
    {
        $messages = array();
        $messages[] = 'Ошибка базы данных.';
        include ($page);
    }
} 
?>