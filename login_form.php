<?php
session_start();
 
header("Content-type: text/html; charset=Shift_JIS");
 
//�N���X�T�C�g���N�G�X�g�t�H�[�W�F���iCSRF�j�΍�
$_SESSION['token'] = sha1(uniqid(mt_rand(), true));
$token = $_SESSION['token'];
 
 
?>
 
<!DOCTYPE html>
<html>
<head>
<title>���O�C�����</title>
<meta charset="Shift_JIS">
</head>
<body>
<h1>���O�C�����</h1>
 
<form action="login_check.php" method="post">
 
<p>�A�J�E���g�F<input type="text" name="account" size="50"></p>
<p>�p�X���[�h�F<input type="text" name="password" size="50"></p>
 
<input type="hidden" name="token" value="<?=$token?>">
<input type="submit" value="���O�C������">
 
</form>
 
</body>
</html>