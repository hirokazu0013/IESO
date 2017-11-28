<?php

$username = "ユーザー名";
$dbpassword = "パスワード";
$dbname = "データベース名";
$dsn = 'mysql:host=localhost;$dbname;charset=Shift_JIS';
// データベースサーバへの接続
try{
$pdo = new PDO($dsn, $username, $password);
// テーブル作成用SQL文
$stmt =  $pdo->prepare("DESCRIBE test1");
$stmt -> execute();
  foreach ($stmt as $row) {
    echo "$row[0]";
    echo "<br>";
  }
}catch (PDOException $e) {
header('Content-Type: text/plain; charset=Shift_JIS', true, 500);
    exit($e->getMessage()); 
}
?>