<?php

$username = "ユーザー名";
$dbpassword = "パスワード";
$dbname = "データベース名";
$dsn = 'mysql:host=localhost;$dbname;charset=Shift_JIS';
// データベースサーバへの接続
$pdo = new PDO($dsn, $username, $password);
// テーブル作成用SQL文

$stmt = $pdo -> query("INSERT INTO XXX (dd, y, m) VALUES (11, 2017, 13)");

?>