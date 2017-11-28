<?php

$username = "ユーザー名";
$dbpassword = "パスワード";
$dbname = "データベース名";
$dsn = 'mysql:host=localhost;$dbname;charset=Shift_JIS';
// データベースサーバへの接続
try{
$pdo = new PDO($dsn, $username, $password);
// テーブル作成用SQL文 
$sql = "CREATE TABLE IF NOT EXISTS `test1`"
."("
. "`id` INT auto_increment primary key,"
. "`name` VARCHAR(255),"
. "`pass` CHAR(255),"
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