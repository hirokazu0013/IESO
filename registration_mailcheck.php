<?php
$username = "���[�U�[��";
$dbpassword = "�p�X���[�h";
$dbname = "�f�[�^�x�[�X��";
$dsn = 'mysql:host=localhost;$dbname;charset=Shift_JIS';
// �f�[�^�x�[�X�T�[�o�ւ̐ڑ�

$pdo = new PDO($dsn, $username, $password);

$reg_username = $_POST['username'];
$reg_password = $_POST['password'];
$reg_mailadr = $_POST['mailadr'];
$reg_key = sha1(uniqid(mt_rand(), true));
// �����_��������̐���

$sql = "INSERT INTO interim_registration (username, password, mailadr, reg_key)VALUES('$reg_username', '$reg_password', '$reg_mailadr', '$reg_key')";
$stmt = $pdo->query($sql);

$to = $reg_mailadr;
$subject = 'e-mail confirm';
$message = 'http://co-735.it.99sv-coco.com/registration_confirm.php?username=$username&reg_key=$reg_key';
$headers = "From:";
if(mb_send_mail($to, $subject, $message, $headers)){
echo '���[�����M�ɐ����v���܂����B';
}else{
echo '���[�����M�Ɏ��s�v���܂����B';
}

?>