<?php
session_start();

header("Content-type: text/html; charset=Shift_JIS");

//�N���X�T�C�g���N�G�X�g�t�H�[�W�F���iCSRF�j�΍�
$_SESSION['token'] = sha1(uniqid(mt_rand(), true));
$token = $_SESSION['token'];

//�f�[�^�x�[�X�ڑ�
$username = "co-735.it.3919.c";
$password = "Mbiu8rt";
$dbname = "co_735_it_3919_com";
$dsn = 'mysql:host=localhost;dbname=co_735_it_3919_com;charset=Shift_JIS';
$pdo = new PDO($dsn, $username, $password);
//�G���[���b�Z�[�W�̏�����
$errors = array();

if(empty($_GET)) {
	header("Location: registration_mail_form.php");
	exit();
}else{
	//GET�f�[�^��ϐ��ɓ����
	$urltoken = isset($_GET[urltoken]) ? $_GET[urltoken] : NULL;
	//���[�����͔���
	if ($urltoken == ''){
		echo "������x�o�^�����Ȃ����ĉ������B";
	}else{
		try{
			//flag��0�̖��o�^�ҁE���o�^������24���Ԉȓ�
			$pdo = new PDO($dsn, $username, $password);
			$sql = "SELECT mail FROM pre_member WHERE urltoken= '$urltoken' AND flag =0 AND date > now() - interval 24 hour";
			$stmt = $pdo->query($sql);
			
			//���R�[�h�����擾
			$row_count = $stmt->rowCount();
			//24���Ԉȓ��ɉ��o�^����A�{�o�^����Ă��Ȃ��g�[�N���̏ꍇ
			if($row_count ==1){
				foreach ($stmt as $row){
                        	$mail = htmlspecialchars($row['mail']);
				$_SESSION['mail'] = $mail;
                          }
			}else{
				 echo "����URL�͂����p�ł��܂���B�L���������߂������̖�肪����܂��B������x�o�^�����Ȃ����ĉ������B";
			 }
			
			//�f�[�^�x�[�X�ڑ��ؒf
			$dbh = null;
			
		}catch (PDOException $e){
			print('Error:'.$e->getMessage());
			die();
		}
	}
}

?>

<!DOCTYPE html>
<html>
<head>
<meta charset="Shift_JIS">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>����o�^���</title>
<link rel="stylesheet" href="style.css">
<!-- Bootstrap�ǂݍ��݁i�X�^�C�����O�̂��߁j -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css">
</head>
<body>
<div class="col-xs-6 col-xs-offset-3">
<h1>����o�^���</h1>

<form action="registration_check.php" method="post">
<div class="form-group">
<?=htmlspecialchars($mail, ENT_QUOTES, 'Shift_JIS')?><class="form-control" placeholder="���[���A�h���X" required />
</div>
<div class="form-group">
<input type="text" class="form-control" name="account" placeholder="�A�J�E���g��" required />
</div>
<div class="form-group">
<input type="text" class="form-control" name="password" placeholder="�p�X���[�h" required />
</div>
<input type="hidden" name="token" value="<?=$token?>">
<button type="submit" class="btn btn-default" name="signup">����o�^����</button>
<a href="login_form.php">����y�[�W���O�C���͂�����</a> 
</form>

</body>
</html>