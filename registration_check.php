<?php
session_start();

header("Content-type: text/html; charset=Shift_JIS");

//�N���X�T�C�g���N�G�X�g�t�H�[�W�F���iCSRF�j�΍�̃g�[�N������
if ($_POST['token'] != $_SESSION['token']){
	echo "�s���A�N�Z�X�̉\������";
	exit();
}

//�O��ɂ��锼�p�S�p�X�y�[�X���폜����֐�
function spaceTrim ($str) {
	// �s��
	$str = preg_replace('/^[ �@]+/s', '', $str);
	// ����
	$str = preg_replace('/[ �@]+$/s', '', $str);
	return $str;
}

//�G���[���b�Z�[�W�̏�����
$errors = array();

if(empty($_POST)) {
	header("Location: registration_mail_form.php");
	exit();
}else{
	//POST���ꂽ�f�[�^���e�ϐ��ɓ����
	$account = isset($_POST['account']) ? $_POST['account'] : NULL;
	$password = isset($_POST['password']) ? $_POST['password'] : NULL;
	
	//�O��ɂ��锼�p�S�p�X�y�[�X���폜
	$account = spaceTrim($account);
	$password = spaceTrim($password);

	//�A�J�E���g���͔���
	if ($account == ''){
		$errors['account'] = "�A�J�E���g�����͂���Ă��܂���B";
		echo '�A�J�E���g�����͂���Ă��܂���B';
	}elseif(mb_strlen($account)>10){
		$errors['account_length'] = "�A�J�E���g��10�����ȓ��œ��͂��ĉ������B";
		echo '�A�J�E���g��10�����ȓ��œ��͂��ĉ������B';
	}
	
	//�p�X���[�h���͔���
	if ($password == ''){
		$errors['password'] = "�p�X���[�h�����͂���Ă��܂���B";
		echo '�p�X���[�h�����͂���Ă��܂���B';
	}elseif(!preg_match('/^[0-9a-zA-Z]{5,30}$/', $_POST["password"])){
		$errors['password_length'] = "�p�X���[�h�͔��p�p������5�����ȏ�30�����ȉ��œ��͂��ĉ������B";
		echo '�p�X���[�h�͔��p�p������5�����ȏ�30�����ȉ��œ��͂��ĉ������B';
	}else{
		$password_hide = str_repeat('*', strlen($password));
	}
	
}

//�G���[��������΃Z�b�V�����ɓo�^
if(count($errors) === 0){
	$_SESSION['account'] = $account;
	$_SESSION['password'] = $password;
}

?>

<!DOCTYPE html>
<html>
<head>
<title>����o�^�m�F���</title>
<meta charset="Shift_JIS">
</head>
<body>
<h1>����o�^�m�F���</h1>

<form action="registration_insert.php" method="post">

<p>���[���A�h���X�F<?=htmlspecialchars($_SESSION['mail'], ENT_QUOTES)?></p>
<p>�A�J�E���g���F<?=htmlspecialchars($account, ENT_QUOTES)?></p>
<p>�p�X���[�h�F<?=$password_hide?></p>

<input type="button" value="�߂�" onClick="history.back()">
<input type="hidden" name="token" value="<?=$_POST['token']?>">
<input type="submit" value="�o�^����">

</form>

</body>
</html>