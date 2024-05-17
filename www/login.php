<?php

require_once "config.php";
require_once "session.php";

$error = '';
$qq = '';
// если нажата кнопка входа
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {

    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    // если не указана почта
    if (empty($email)) {
        $error .= '<p class="error">Введите адрес электронной почты.</p>';
    }

    // если не указан пароль
    if (empty($password)) {
        $error .= '<p class="error">Введите пароль.</p>';
    }

    // если ошибок нет
    if (empty($error)) {
        // берём данные пользователя
        if($query = $db->prepare("SELECT * FROM users WHERE email = ?")) {
            $query->bind_param('s', $email);
            $query->execute();
            $row = $query->get_result()->fetch_assoc();
            // смотрим, есть ли такой пользователь в базе
            if ($row) {
                // если пароль правильный
                if (password_verify($password, $row['password'])) {
                    // начинаем новую сессию
                    $_SESSION["userid"] = $row['id'];
                    $_SESSION["user"] = $row;
                    // перенаправляем пользователя на внутреннюю страницу
                    header("location: welcome.php");
                    exit();
                // если пароль не подходит
                } else {
                    $error .= '<p class="error">Введён неверный пароль.</p>';
                }
            // если пользователя нет в базе
            } else {
                $error .= '<p class="error">Нет пользователя с таким адресом электронной почты.</p>';
            }
        }
    }
    // закрываем соединение с базой данных
    mysqli_close($db);
}
?>


<!DOCTYPE html>
<html lang="ru">
    <head>
        <meta charset="UTF-8">
        <title>Вход</title>
        <!-- подключаем бутстрап -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    </head>
    <body>
        <!-- создаём контейнер -->
        <div class="container">
            <div class="row">
                <!-- указываем стиль адаптивной вёрстки -->
                <div class="col-md-12">
                    <!-- пишем заголовок и пояснительный текст -->
                    <h2>Вход</h2>
                    <p>Введите свою почту и пароль.</p>
                    <?php echo $error; ?>
                    <!-- метод, которым будем работать с формой, — отправлять на сервер -->
                    <form action="" method="post">
                        <!-- поле ввода электронной почты -->
                        <div class="form-group">
                            <label>Электронная почта</label>
                            <input type="email" name="email" class="form-control" required />
                        </div>    
                        <!-- поле ввода пароля -->
                        <div class="form-group">
                            <label>Пароль</label>
                            <input type="password" name="password" class="form-control" required>
                        </div>
                        <!-- кнопка отправки данных на сервер -->
                        <div class="form-group">
                            <input type="submit" name="submit" class="btn btn-primary" value="Войти">
                        </div>
                        <!-- ссылка для тех, у кого ещё нет аккаунта -->
                        <p>Нет аккаунта? <a href="register.php">Создайте его за минуту</a>.</p>
                    </form>
                </div>
            </div>
        </div>    
    </body>
</html>
