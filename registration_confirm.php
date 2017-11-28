<?php
$username = "ユーザー名";
$dbpassword = "パスワード";
$dbname = "データベース名";
$dsn = 'mysql:host=localhost;$dbname;charset=Shift_JIS';
// データベースサーバへの接続

$pdo = new PDO($dsn, $username, $password);

$username = $_GET['username'];
$reg_key = $_GET['reg_key'];

$sql = "SELECT * FROM interim_registration WHERE username = '$username' AND reg_key = '$reg_key'";
$stmt = $pdo->query($sql);
foreach ($stmt as $row){
$reg_key = $_GET['reg_key'];
$susername=htmlspecialchars($row['username']);
$sreg_key=htmlspecialchars($row['reg_key']);
$userdata = $sreg_key;
if($userdata === $reg_key){
echo "キーが一致しません。";
}else{
echo "正規ユーザー登録処理を行います。";
}
}
?>