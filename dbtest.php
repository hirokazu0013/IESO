<?php

$username = "ユーザー名";
$dbpassword = "パスワード";
$dbname = "データベース名";
$dsn = 'mysql:host=localhost;$dbname;charset=Shift_JIS';
// データベースサーバへの接続
try{
$pdo = new PDO($dsn, $username, $password);
// テーブル作成用SQL文 
$sql = "CREATE TABLE IF NOT EXISTS `users`"
."("
. "`user_id` INT(5) auto_increment primary key,"
. "`user_name` VARCHAR(25),"
. "`user_email` VARCHAR(35) unique key,"
. "`user_pass` CHAR(255),"
. "`comment` TEXT,"
. "`date` DATETIME"
.");";
$stmt = $pdo -> prepare($sql);
$stmt -> execute();
}catch (PDOException $e) {
header('Content-Type: text/plain; charset=Shift_JIS', true, 500);
    exit($e->getMessage()); 
}
?>