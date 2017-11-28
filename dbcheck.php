<?php

$username = "ユーザー名";
$dbpassword = "パスワード";
$dbname = "データベース名";
$dsn = 'mysql:host=localhost;$dbname;charset=Shift_JIS';
// データベースサーバへの接続
try {
$pdo = new PDO($dsn, $username, $dbpassword);
// テーブル作成用SQL文
  $stmt = $pdo->query("SELECT * FROM users");
foreach ($stmt as $row){
$number=htmlspecialchars($row['user_id']);
$name=htmlspecialchars($row['user_name']);
$password=htmlspecialchars($row['user_pass']);
$email=htmlspecialchars($row['user_email']);
$date=htmlspecialchars($row['date']);
    echo $number.':'.$name.':'.$password.':'.$email.':'.$date.':';
    echo '<br>';
}

} catch (PDOException $e) {
header('Content-Type: text/plain; charset=Shift_JIS', true, 500);
    exit($e->getMessage()); 
}
?>