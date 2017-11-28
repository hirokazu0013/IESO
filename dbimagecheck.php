<?php

$username = "ユーザー名";
$dbpassword = "パスワード";
$dbname = "データベース名";
$dsn = 'mysql:host=localhost;$dbname;charset=Shift_JIS';
// データベースサーバへの接続
try {
$pdo = new PDO($dsn, $username, $dbpassword);
// テーブル作成用SQL文
  $stmt = $pdo->query("SELECT * FROM post");
foreach ($stmt as $row){
$number=htmlspecialchars($row['ID']);
$image=htmlspecialchars($row['imgdat']);
$mime=htmlspecialchars($row['mime']);
    echo $number.':'.$image.':'.$mime.':';
    echo '<br>';
}

} catch (PDOException $e) {
header('Content-Type: text/plain; charset=Shift_JIS', true, 500);
    exit($e->getMessage()); 
}
?>