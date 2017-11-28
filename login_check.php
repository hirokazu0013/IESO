<?php
session_start();

header("Content-type: text/html; charset=Shift_JIS");

//クロスサイトリクエストフォージェリ（CSRF）対策のトークン判定
if ($_POST['token'] != $_SESSION['token']){
	echo "不正アクセスの可能性あり";
	exit();
}
//データベース接続
$username = "ユーザー名";
$dbpassword = "パスワード";
$dbname = "データベース名";
$dsn = 'mysql:host=localhost;$dbname;charset=Shift_JIS';
$pdo = new PDO($dsn, $username, $password);

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
	header("Location: login_form.php");
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

//エラーが無ければ実行する
if(count($errors) === 0){
	try{
		
		//アカウントで検索
		$sql = "SELECT * FROM member WHERE account= '$account' AND flag =1";
		$stmt = $pdo->query($sql);

		//アカウントが一致
		foreach ($stmt as $row){

			$password_hash = $row[password];

			//パスワードが一致
			if ($password == $password_hash) {
				
				$_SESSION['account'] = $account;
				header("Location: login_admin.php");
				exit();
			}else{
				$errors['password'] = "アカウント及びパスワードが一致しません。";
				echo 'アカウント及びパスワードが一致しません。';
			}
		}
		//データベース接続切断
		$pdo = null;
		
	}catch (PDOException $e){
		print('Error:'.$e->getMessage());
		die();
	}
}

?>

<!DOCTYPE html>
<html>
<head>
<title>ログイン確認画面</title>
<meta charset="Shift_JIS">
</head>
<body>
<h1>ログイン確認画面</h1>
<p>アカウント名：<?=htmlspecialchars($account, ENT_QUOTES)?></p>
<p>パスワード：<?=$password_hide?></p>
<p><a href="login_admin.php">ログイン</a></p>
<input type="button" value="戻る" onClick="history.back()">
 
</body>
</html>