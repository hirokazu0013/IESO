<?php

ob_start();

// ��������Aregister.php�Ɠ��l

session_start();

if( isset($_SESSION['user']) != "") {

	header("Location: home.php");

}

include_once 'dbconnect.php';

// �����܂ŁAregister.php�Ɠ��l

?>



<?php

if(isset($_POST['login'])) {



	$mail = $_POST['mail'];

	$password = $_POST['password'];



	// �N�G���̎��s

	$query = "SELECT * FROM member WHERE mail='$mail'";

	$result = $pdo->query($query);

	if (!$result) {

		print('�N�G���[�����s���܂����B' . $pdo->error);

		$pdo->close();

		exit();

	}



	// �p�X���[�h(�Í����ς݁j�ƃ��[�U�[ID�̎��o��

	foreach ($result as $row){

		$db_hashed_pwd = $row['password'];

		$id = $row['id'];

	}



	// �f�[�^�x�[�X�̐ؒf




	// �n�b�V�������ꂽ�p�X���[�h���}�b�`���邩�ǂ������m�F

	if ($password == $db_hashed_pwd) {

		$_SESSION['user'] = $id;

		header("Location: home.php");

		exit;

	} else { ?>

		<div class="alert alert-danger" role="alert">���[���A�h���X�ƃp�X���[�h����v���܂���B</div>

	<?php }

} ?>



<!DOCTYPE HTML>

<html>

<head>

<meta charset="Shift_JIS" />

<meta name="viewport" content="width=device-width, initial-scale=1">

<title>���O�C��</title>

<link rel="stylesheet" href="style.css">

<!-- Bootstrap�ǂݍ��݁i�X�^�C�����O�̂��߁j -->

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css">

</head>

</head>

<body>

<div class="col-xs-6 col-xs-offset-3">



<form method="post">

	<h1>������y�[�W���O�C��</h1>

	<div class="form-group">

		<input type="mail"  class="form-control" name="mail" placeholder="���[���A�h���X" required />

	</div>

	<div class="form-group">

		<input type="password" class="form-control" name="password" placeholder="�p�X���[�h" required />

	</div>

	<button type="submit" class="btn btn-default" name="login">���O�C������</button>

	<a href="registration_form.php">����o�^�͂�����</a>

        <a href="index.php">����y�[�W���O�C���͂�����</a>

</form>



</div>

</body>

</html>