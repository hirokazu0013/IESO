<?php

session_start();

if( isset($_SESSION['user']) != "") {

	// ���O�C���ς݂̏ꍇ�̓��_�C���N�g

	header("Location: home.php");

}



// DB�Ƃ̐ڑ�

include_once 'dbconnect.php';

?>

<!DOCTYPE HTML>

<html>

<head>

<meta charset="Shift_JIS" />

<meta name="viewport" content="width=device-width, initial-scale=1">

<title>����o�^</title>

<link rel="stylesheet" href="style.css">



<!-- Bootstrap�ǂݍ��݁i�X�^�C�����O�̂��߁j -->

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css">

</head>

<body>

<div class="col-xs-6 col-xs-offset-3">



<?php

// signup��POST���ꂽ�Ƃ��ɉ��L�����s

if(isset($_POST['signup'])) {



	$username = $_POST['username'];

	$email = $_POST['email'];

	$password = $_POST['password'];

	// POST���ꂽ����DB�Ɋi�[����

	$query = "INSERT INTO users(user_name , user_email , user_pass) VALUES('$username', '$email', '$password')";



	if($pdo->query($query)) { ?>

		<div class="alert alert-success" role="alert">�o�^���܂���</div>

		<?php } else { ?>

		<div class="alert alert-danger" role="alert">�G���[���������܂����B</div>

		<?php

	}

} ?>



<form method="post">

	<h1>����o�^</h1>

	<div class="form-group">

		<input type="text" class="form-control" name="username" placeholder="���[�U�[��" required />

	</div>

	<div class="form-group">

		<input type="email"  class="form-control" name="email" placeholder="���[���A�h���X" required />

	</div>

	<div class="form-group">

		<input type="password" class="form-control" name="password" placeholder="�p�X���[�h" required />

	</div>

	<button type="submit" class="btn btn-default" name="signup">����o�^����</button>

	<a href="index.php">����y�[�W���O�C���͂�����</a>

</form>



</div>

</body>

</html>