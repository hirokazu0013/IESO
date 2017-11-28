<?php

$username = "ユーザー名";
$dbpassword = "パスワード";
$dbname = "データベース名";
$dsn = 'mysql:host=localhost;$dbname;charset=Shift_JIS';
try{
// データベースサーバへの接続
$pdo = new PDO($dsn, $username, $password);
// テーブル作成用SQL文
$sql = "CREATE TABLE IF NOT EXISTS XXX" 
."("
. "`id` INT auto_increment primary key,"
. "`name` INT,"
. "`comment` INT,"
. "`opt` DATETIME"
.");";

$stmt = $pdo -> prepare($sql);
$stmt -> execute();
}catch (PDOException $e) {
header('Content-Type: text/plain; charset=Shift_JIS', true, 500);
    exit($e->getMessage()); 
}
?>