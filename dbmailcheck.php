<?php

$username = "ユーザー名";
$dbpassword = "パスワード";
$dbname = "データベース名";
$dsn = 'mysql:host=localhost;$dbname;charset=Shift_JIS';
// データベースサーバへの接続
try {
$pdo = new PDO($dsn, $username, $dbpassword);
// テーブル作成用SQL文
  $stmt = $pdo->query("SELECT * FROM pre_member");
foreach ($stmt as $row){
$number=htmlspecialchars($row['urltoken']);
$image=htmlspecialchars($row['mail']);
$mime=htmlspecialchars($row['date']);
$flag=htmlspecialchars($row['flag']);
    echo $number.':'.$image.':'.$mime.':'.$flag.':';
    echo '<br>';
}

} catch (PDOException $e) {
header('Content-Type: text/plain; charset=Shift_JIS', true, 500);
    exit($e->getMessage()); 
}
?>