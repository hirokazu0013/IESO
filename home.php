<?php

session_start();

include_once 'dbconnect.php';

if(!isset($_SESSION['user'])) {

	header("Location: index2.php");

}



// ���[�U�[ID���烆�[�U�[�������o��

$query = "SELECT * FROM member WHERE id =".$_SESSION['user']."";

$result = $pdo->query($query);



$result = $pdo->query($query);

if (!$result) {

	print('�N�G���[�����s���܂����B' . $pdo->error);

	$pdo->close();

	exit();

}



// ���[�U�[���̎��o��

 foreach ($result as $row){

	$account = $row['account'];

	$mail = $row['mail'];

}



// �f�[�^�x�[�X�̐ؒf





?>

<!DOCTYPE HTML>

<html>

<head>

<meta charset="Shift_JIS" />

<meta name="viewport" content="width=device-width, initial-scale=1">

<title>�}�C�y�[�W</title>

<link rel="stylesheet" href="style.css">

<!-- Bootstrap�ǂݍ��݁i�X�^�C�����O�̂��߁j -->

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css">

</head>

</head>

<body>

<div class="col-xs-6 col-xs-offset-3">



<h1>�v���t�B�[��</h1>

<ul>

	<li>���O�F<?php echo "$account" ?></li>

	<li>���[���A�h���X�F<?php echo "$mail" ?></li>

</ul>

<a href="logout.php?logout">���O�A�E�g</a>



</div>

</body>

</html>