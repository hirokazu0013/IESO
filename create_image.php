<?php
$username = "ユーザー名";
$dbpassword = "パスワード";
$dbname = "データベース名";
$dsn = 'mysql:host=localhost;$dbname;charset=Shift_JIS';

$id = $_GET['id'];

try{
// データベースサーバへの接続
$pdo = new PDO($dsn, $username, $dbpassword);

$sql = "SELECT * FROM post WHERE ID = '$id'";
$result = $pdo->query($sql); 
foreach ($result as $row){
$mime = $row['mime'];
$imgdat = $row['imgdat'];
$image = base64_decode($imgdat);
header('Content-Type: $mime');
 echo $image;
 echo '<br>';
 }
} catch (PDOException $e) {
    exit($e->getMessage()); 
}
?>