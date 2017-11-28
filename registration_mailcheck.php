<?php
$username = "ユーザー名";
$dbpassword = "パスワード";
$dbname = "データベース名";
$dsn = 'mysql:host=localhost;$dbname;charset=Shift_JIS';
// データベースサーバへの接続

$pdo = new PDO($dsn, $username, $password);

$reg_username = $_POST['username'];
$reg_password = $_POST['password'];
$reg_mailadr = $_POST['mailadr'];
$reg_key = sha1(uniqid(mt_rand(), true));
// ランダム文字列の生成

$sql = "INSERT INTO interim_registration (username, password, mailadr, reg_key)VALUES('$reg_username', '$reg_password', '$reg_mailadr', '$reg_key')";
$stmt = $pdo->query($sql);

$to = $reg_mailadr;
$subject = 'e-mail confirm';
$message = 'http://co-735.it.99sv-coco.com/registration_confirm.php?username=$username&reg_key=$reg_key';
$headers = "From:";
if(mb_send_mail($to, $subject, $message, $headers)){
echo 'メール送信に成功致しました。';
}else{
echo 'メール送信に失敗致しました。';
}

?>