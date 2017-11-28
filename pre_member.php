<?php

$username = "ユーザー名";
$dbpassword = "パスワード";
$dbname = "データベース名";
$dsn = 'mysql:host=localhost;$dbname;charset=Shift_JIS';
// データベースサーバへの接続
try{
$pdo = new PDO($dsn, $username, $password);
// テーブル作成用SQL文 
$sql = "CREATE TABLE IF NOT EXISTS `pre_member`"
."("
. "`id` INT(11) not null auto_increment primary key,"
. "`urltoken` VARCHAR(128) not null,"
. "`mail` VARCHAR(50) not null,"
. "`date` DATETIME not null,"
. "`flag` TINYINT(1) not null DEFAULT 0"
.");";
$stmt = $pdo -> prepare($sql);
$stmt -> execute();
}catch (PDOException $e) {
header('Content-Type: text/plain; charset=Shift_JIS', true, 500);
    exit($e->getMessage()); 
}
?>