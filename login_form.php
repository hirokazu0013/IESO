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
<title>ログイン画面</title>
<meta charset="Shift_JIS">
</head>
<body>
<h1>ログイン画面</h1>
 
<form action="login_check.php" method="post">
 
<p>アカウント：<input type="text" name="account" size="50"></p>
<p>パスワード：<input type="text" name="password" size="50"></p>
 
<input type="hidden" name="token" value="<?=$token?>">
<input type="submit" value="ログインする">
 
</form>
 
</body>
</html>