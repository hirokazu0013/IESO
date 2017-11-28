<?php

$username = "ユーザー名";
$dbpassword = "パスワード";
$dbname = "データベース名";
$dsn = 'mysql:host=localhost;$dbname;charset=Shift_JIS';
// データベースサーバへの接続
try {
$pdo = new PDO($dsn, $username, $password);
// テーブル作成用SQL文
  $stmt = $pdo->query("SELECT * FROM XXX");
foreach ($stmt as $row){
$dd=htmlspecialchars($row['dd']);
$year=htmlspecialchars($row['y']);
$month=htmlspecialchars($row['m']);
    echo $dd.':'.$year.':'.$month.':';
    echo '<br>';
 }
} catch (PDOException $e) {
header('Content-Type: text/plain; charset=Shift_JIS', true, 500);
    exit($e->getMessage()); 
}
?>