<?php

ob_start();

// ここから、register.phpと同様

session_start();

if( isset($_SESSION['user']) != "") {

	header("Location: home.php");

}

include_once 'dbconnect.php';

// ここまで、register.phpと同様

?>



<?php

if(isset($_POST['login'])) {



	$mail = $_POST['mail'];

	$password = $_POST['password'];



	// クエリの実行

	$query = "SELECT * FROM member WHERE mail='$mail'";

	$result = $pdo->query($query);

	if (!$result) {

		print('クエリーが失敗しました。' . $pdo->error);

		$pdo->close();

		exit();

	}



	// パスワード(暗号化済み）とユーザーIDの取り出し

	foreach ($result as $row){

		$db_hashed_pwd = $row['password'];

		$id = $row['id'];

	}



	// データベースの切断




	// ハッシュ化されたパスワードがマッチするかどうかを確認

	if ($password == $db_hashed_pwd) {

		$_SESSION['user'] = $id;

		header("Location: home.php");

		exit;

	} else { ?>

		<div class="alert alert-danger" role="alert">メールアドレスとパスワードが一致しません。</div>

	<?php }

} ?>



<!DOCTYPE HTML>

<html>

<head>

<meta charset="Shift_JIS" />

<meta name="viewport" content="width=device-width, initial-scale=1">

<title>ログイン</title>

<link rel="stylesheet" href="style.css">

<!-- Bootstrap読み込み（スタイリングのため） -->

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css">

</head>

</head>

<body>

<div class="col-xs-6 col-xs-offset-3">



<form method="post">

	<h1>会員情報ページログイン</h1>

	<div class="form-group">

		<input type="mail"  class="form-control" name="mail" placeholder="メールアドレス" required />

	</div>

	<div class="form-group">

		<input type="password" class="form-control" name="password" placeholder="パスワード" required />

	</div>

	<button type="submit" class="btn btn-default" name="login">ログインする</button>

	<a href="registration_form.php">会員登録はこちら</a>

        <a href="index.php">会員ページログインはこちら</a>

</form>



</div>

</body>

</html>