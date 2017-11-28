<?php

$username = "ユーザー名";
$dbpassword = "パスワード";
$dbname = "データベース名";
$dsn = 'mysql:host=localhost;$dbname;charset=Shift_JIS';
// データベースサーバへの接続
try{
$pdo = new PDO($dsn, $username, $password);
// テーブル作成用SQL文 
$sql = "CREATE TABLE IF NOT EXISTS `interim_registration`"
."("
. "`id` int(11) unsigned not null auto_increment primary key,"
. "`username` VARCHAR(32) not null,"
. "`password` VARCHAR(32) not null,"
. "`mailadr` VARCHAR(64) not null,"
. "`reg_key` VARCHAR(64) not null"
.");";
$stmt = $pdo -> prepare($sql);
$stmt -> execute();
}catch (PDOException $e) {
header('Content-Type: text/plain; charset=Shift_JIS', true, 500);
    exit($e->getMessage()); 
}
?>