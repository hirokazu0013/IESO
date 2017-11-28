<?php
session_start();

header("Content-type: text/html; charset=Shift_JIS");

//クロスサイトリクエストフォージェリ（CSRF）対策
$_SESSION['token'] = sha1(uniqid(mt_rand(), true));
$token = $_SESSION['token'];

?>
<!DOCTYPE html>
<html>
<head>
<title>メール仮登録画面</title>
<meta charset="Shift_JIS">
</head>
<body>
<h1>メール仮登録画面</h1>
 
<form action="registration_mail_check.php" method="post">
 
<p>メールアドレス：<input type="text" name="mail" size"50"></p>
<input type="hidden" name="token" value="<?=$token?>">
<input type="submit" value="登録する">
<a href="index.php">会員ページログインはこちら</a>

</form>
 
</body>
</html>