<?php
define('DBSERVER', 'db'); // сервер с базой данных
define('DBUSERNAME', 'root'); // имя пользователя
define('DBPASSWORD', 'root_password'); // пароль
define('DBNAME', 'lamp_db'); // название базы
 
/* соединяемся с базой */
$db = mysqli_connect(DBSERVER, DBUSERNAME, DBPASSWORD, DBNAME);
 
// проверяем соединение
if($db === false){
    die("Ошибка соединения с базой. " . mysqli_connect_error());
}

ini_set('display_errors', 1);
error_reporting(E_ALL);
?>
