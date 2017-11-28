<?php
session_start();

header("Content-type: text/html; charset=Shift_JIS");

//クロスサイトリクエストフォージェリ（CSRF）対策のトークン判定
if ($_POST['token'] != $_SESSION['token']){
	echo "不正アクセスの可能性あり";
	exit();
}

//前後にある半角全角スペースを削除する関数
function spaceTrim ($str) {
	// 行頭
	$str = preg_replace('/^[ 　]+/s', '', $str);
	// 末尾
	$str = preg_replace('/[ 　]+$/s', '', $str);
	return $str;
}

//エラーメッセージの初期化
$errors = array();

if(empty($_POST)) {
	header("Location: registration_mail_form.php");
	exit();
}else{
	//POSTされたデータを各変数に入れる
	$account = isset($_POST['account']) ? $_POST['account'] : NULL;
	$password = isset($_POST['password']) ? $_POST['password'] : NULL;
	
	//前後にある半角全角スペースを削除
	$account = spaceTrim($account);
	$password = spaceTrim($password);

	//アカウント入力判定
	if ($account == ''){
		$errors['account'] = "アカウントが入力されていません。";
		echo 'アカウントが入力されていません。';
	}elseif(mb_strlen($account)>10){
		$errors['account_length'] = "アカウントは10文字以内で入力して下さい。";
		echo 'アカウントは10文字以内で入力して下さい。';
	}
	
	//パスワード入力判定
	if ($password == ''){
		$errors['password'] = "パスワードが入力されていません。";
		echo 'パスワードが入力されていません。';
	}elseif(!preg_match('/^[0-9a-zA-Z]{5,30}$/', $_POST["password"])){
		$errors['password_length'] = "パスワードは半角英数字の5文字以上30文字以下で入力して下さい。";
		echo 'パスワードは半角英数字の5文字以上30文字以下で入力して下さい。';
	}else{
		$password_hide = str_repeat('*', strlen($password));
	}
	
}

//エラーが無ければセッションに登録
if(count($errors) === 0){
	$_SESSION['account'] = $account;
	$_SESSION['password'] = $password;
}

?>

<!DOCTYPE html>
<html>
<head>
<title>会員登録確認画面</title>
<meta charset="Shift_JIS">
</head>
<body>
<h1>会員登録確認画面</h1>

<form action="registration_insert.php" method="post">

<p>メールアドレス：<?=htmlspecialchars($_SESSION['mail'], ENT_QUOTES)?></p>
<p>アカウント名：<?=htmlspecialchars($account, ENT_QUOTES)?></p>
<p>パスワード：<?=$password_hide?></p>

<input type="button" value="戻る" onClick="history.back()">
<input type="hidden" name="token" value="<?=$_POST['token']?>">
<input type="submit" value="登録する">

</form>

</body>
</html>