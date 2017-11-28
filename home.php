<?php

session_start();

include_once 'dbconnect.php';

if(!isset($_SESSION['user'])) {

	header("Location: index2.php");

}



// ユーザーIDからユーザー名を取り出す

$query = "SELECT * FROM member WHERE id =".$_SESSION['user']."";

$result = $pdo->query($query);



$result = $pdo->query($query);

if (!$result) {

	print('クエリーが失敗しました。' . $pdo->error);

	$pdo->close();

	exit();

}



// ユーザー情報の取り出し

 foreach ($result as $row){

	$account = $row['account'];

	$mail = $row['mail'];

}



// データベースの切断





?>

<!DOCTYPE HTML>

<html>

<head>

<meta charset="Shift_JIS" />

<meta name="viewport" content="width=device-width, initial-scale=1">

<title>マイページ</title>

<link rel="stylesheet" href="style.css">

<!-- Bootstrap読み込み（スタイリングのため） -->

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css">

</head>

</head>

<body>

<div class="col-xs-6 col-xs-offset-3">



<h1>プロフィール</h1>

<ul>

	<li>名前：<?php echo "$account" ?></li>

	<li>メールアドレス：<?php echo "$mail" ?></li>

</ul>

<a href="logout.php?logout">ログアウト</a>



</div>

</body>

</html>