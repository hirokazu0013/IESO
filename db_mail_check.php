<?php

$username = "ユーザー名";
$dbpassword = "パスワード";
$dbname = "データベース名";
$dsn = 'mysql:host=localhost;$dbname;charset=Shift_JIS';
// データベースサーバへの接続
try {
$pdo = new PDO($dsn, $username, $dbpassword);
// テーブル作成用SQL文
$stmt = $pdo->query("SELECT * FROM member");
foreach ($stmt as $row){
$number=htmlspecialchars($row['id']);
$name=htmlspecialchars($row['account']);
$password=htmlspecialchars($row['password']);
$email=htmlspecialchars($row['mail']);
$date=htmlspecialchars($row['flag']);
    echo $number.':'.$name.':'.$password.':'.$email.':'.$date.':';
    echo '<br>';
}

} catch (PDOException $e) {
header('Content-Type: text/plain; charset=Shift_JIS', true, 500);
    exit($e->getMessage()); 
}
?>