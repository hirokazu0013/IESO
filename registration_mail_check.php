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
}else{
	//POST���ꂽ�f�[�^��ϐ��ɓ����
	$mail = isset($_POST['mail']) ? $_POST['mail'] : NULL;

//���[�����͔���
	if ($mail == ''){
		 echo "���[�������͂���Ă��܂���B";
	}else{

	
	$urltoken = hash('sha256',uniqid(rand(),1));
	$url = "http://co-735.it.99sv-coco.com/registration_form.php"."?urltoken=".$urltoken;
	$date    = date('Y/m/d H:i:s');
	//�����Ńf�[�^�x�[�X�ɓo�^����
	try{
// �f�[�^�x�[�X�T�[�o�ւ̐ڑ�
$pdo = new PDO($dsn, $username, $password);
$sql = "INSERT INTO pre_member (urltoken,mail,date) VALUES ('$urltoken','$mail','$date')";
$stmt = $pdo->query($sql);
}catch (PDOException $e){
		print('Error:'.$e->getMessage());
		die();
	}

$to = $mail;
$subject = 'e-mail confirm';
$header = "From:";
$body = <<< EOM
24���Ԉȓ��ɉ��L��URL���炲�o�^�������B
{$url}
EOM;
mb_language('ja');
mb_internal_encoding('Shift_JIS');
if(mb_send_mail($to, $subject, $body, $header)){
echo '���[���������肵�܂����B24���Ԉȓ��Ƀ��[���ɋL�ڂ��ꂽURL���炲�o�^�������B';
}else{
echo '���[�����M�Ɏ��s�v���܂����B';
 }
}
}
?>