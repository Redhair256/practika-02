<?php
$dsn = 'mysql:dbname=mytestdb;host=localhost';
$user = 'softAdmin';
$password = 'qwertyu';

echo "<html>";
echo "   <head>";
echo '      <meta charset="utf-8">';
echo "      <TITLE>Инициализация таблиц БД</TITLE>"; 
echo "   </head>";
echo "   <body> ";

try {
    $dbh = new PDO($dsn, $user, $password);
} catch (PDOException $e) {
    echo 'Подключение не удалось: ' . $e->getMessage();
}
/* Начало транзакции, отключение автоматической фиксации */
$dbh->beginTransaction();

/* Изменение схемы базы данных и данных */
$count = $dbh->exec("CREATE TABLE `mytestdb`.`links` ( `id` INT NOT NULL , `token` INT NOT NULL , `target_url` VARCHAR(255) NOT NULL , `created_ad` DATETIME NOT NULL , `link_id` INT NOT NULL , PRIMARY KEY (`1`)) ENGINE = InnoDB;") or die(print_r($db->errorInfo(), true));
$count =$count + $dbh->exec("CREATE TABLE `mytestdb`.`clicks` ( `id` INT NOT NULL , `user_id` INT NOT NULL , `link_id` INT NOT NULL , `3` DATETIME NOT NULL , PRIMARY KEY (`1`)) ENGINE = InnoDB;") or die(print_r($db->errorInfo(), true));
$count =$count + $dbh->exec("CREATE TABLE `mytestdb`.`users` ( `id` INT NOT NULL , `token` INT NOT NULL , `ip` VARCHAR(15) NOT NULL , `browser` VARCHAR(64) NOT NULL , `os` VARCHAR(32) NOT NULL , `create_at` DATETIME NOT NULL , `link_id` INT NOT NULL , PRIMARY KEY (`1`)) ENGINE = InnoDB;") or die(print_r($db->errorInfo(), true));

/* Распознаем ошибку и откатываем назад изменения */
if ($count < 3) {
  $dbh->rollBack();
} else {
  $dbh->commit()
  echo "Work Complite!"; 
}

/* Соединение с базой данных снова в режиме автоматической фиксации */

echo "   </body>"; 
echo "</html>";


?> 