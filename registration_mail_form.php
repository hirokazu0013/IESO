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
<title>���[�����o�^���</title>
<meta charset="Shift_JIS">
</head>
<body>
<h1>���[�����o�^���</h1>
 
<form action="registration_mail_check.php" method="post">
 
<p>���[���A�h���X�F<input type="text" name="mail" size"50"></p>
<input type="hidden" name="token" value="<?=$token?>">
<input type="submit" value="�o�^����">
<a href="index.php">����y�[�W���O�C���͂�����</a>

</form>
 
</body>
</html>