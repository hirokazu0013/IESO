<?php
session_start();

header("Content-type: text/html; charset=Shift_JIS");

//�N���X�T�C�g���N�G�X�g�t�H�[�W�F���iCSRF�j�΍�̃g�[�N������
if ($_POST['token'] != $_SESSION['token']){
	echo "�s���A�N�Z�X�̉\������";
	exit();
}

//�f�[�^�x�[�X�ڑ�
$username = "���[�U�[��";
$dbpassword = "�p�X���[�h";
$dbname = "�f�[�^�x�[�X��";
$dsn = 'mysql:host=localhost;$dbname;charset=Shift_JIS';
$pdo = new PDO($dsn, $username, $password);

//�G���[���b�Z�[�W�̏�����
$errors = array();

if(empty($_POST)) {
	header("Location: registration_mail_form.php");
	exit();
}
//�����Ńf�[�^�x�[�X�ɓo�^����
$mail = addslashes($_SESSION['mail']);
$account = addslashes($_SESSION['account']);
$password_hash = addslashes($_SESSION['password']);

try{
	//member�e�[�u���ɖ{�o�^����
        $pdo = new PDO($dsn, $username, $password);
	$sql = "INSERT INTO member (account,mail,password) VALUES ('$account','$mail','$password_hash')";
	$stmt = $pdo->query($sql);
		
	//pre_member��flag��1�ɂ���
	$sql = "UPDATE pre_member SET flag=1 WHERE mail= '$mail'";
	$stmt = $pdo->query($sql);
		
	//�f�[�^�x�[�X�ڑ��ؒf
	$pdo = null;
	
	//�Z�b�V�����ϐ���S�ĉ���
	$_SESSION = array();
	
	//�Z�b�V�����N�b�L�[�̍폜�Esessionid�Ƃ̊֌W��T��B�܂�͂��߂�sesssionid�𖼑O�ł��
	if (isset($_COOKIE["PHPSESSID"])) {
		setcookie("PHPSESSID", '', time() - 1800, '/');
	}
	
 	//�Z�b�V������j������
 	session_destroy();
 	
 	/*
 	�o�^�����̃��[���𑗐M
 	*/
	
}catch (PDOException $e){
	$errors['error'] = "������x���Ȃ����ĉ������B";
	print('Error:'.$e->getMessage());
}

?>

<!DOCTYPE html>
<html>
<head>
<title>����o�^�������</title>
<meta charset="Shift_JIS">
</head>
<body>

<h1>����o�^�������</h1>
<p>�o�^�����������܂����B���O�C����ʂ���ǂ����B</p>
<p><a href="login_form.php">���O�C�����</a></p>
<p>echo "htmlspecialchars($_SESSION['mail'], ENT_QUOTES)"</p>
echo "htmlspecialchars($_SESSION['account'], ENT_QUOTES)"</p>
echo "htmlspecialchars($_SESSION['password'], ENT_QUOTES)"</p>
</body>
</html>