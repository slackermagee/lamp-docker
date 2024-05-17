<?php
// начинаем сессию
session_start();

// если пользователь не авторизован, то перенаправляем его на страницу входа
if (!isset($_SESSION["userid"]) || empty($_SESSION['userid'])) {
    header("location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="ru">
    <head>
        <meta charset="UTF-8">
        <title>Добро пожаловать</title>
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
                    <h2>Привет! Добро пожаловать на сайт.</h2>
                    <p>Внутри сайта может быть любое наполнение — можно оформлять как угодно и добавлять любой контент</p>
                    <p>
                    <!-- кнопка для выхода -->
                    <a href="logout.php" class="btn btn-primary btn-lg active" role="button" aria-pressed="true">Выход</a>
                </p>
                </div>
            </div>
        </div>
    </body>
</html>
