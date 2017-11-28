<?php

$username = "ユーザー名";
$dbpassword = "パスワード";
$dbname = "データベース名";
$dsn = 'mysql:host=localhost;$dbname;charset=Shift_JIS';
// データベースサーバへの接続
try {
$pdo = new PDO($dsn, $username, $password);
// テーブル作成用SQL文
$stmt = $pdo -> prepare("INSERT INTO XXX VALUES (?, ?, ?, ?, ?)");
$stmt->execute(array("001", "2017", "10", "13", "1"));
} catch (PDOException $e) {
header('Content-Type: text/plain; charset=Shift_JIS', true, 500);
    exit($e->getMessage()); 
}
?>