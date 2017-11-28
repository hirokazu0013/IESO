<?php

$username = "ユーザー名";
$dbpassword = "パスワード";
$dbname = "データベース名";
$dsn = 'mysql:host=localhost;$dbname;charset=Shift_JIS';
// データベースサーバへの接続
try{
$pdo = new PDO($dsn, $username, $dbpassword);
// テーブル作成用SQL文
$sql = "SHOW CREATE TABLE test1";
$stmt =  $pdo->query($sql);
  foreach ($stmt as $row){
    print_r($row);
  }
}catch (PDOException $e) {
header('Content-Type: text/plain; charset=Shift_JIS', true, 500);
    exit($e->getMessage()); 
}
?>