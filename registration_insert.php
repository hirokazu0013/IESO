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

//エラーメッセージの初期化
$errors = array();

if(empty($_POST)) {
	header("Location: registration_mail_form.php");
	exit();
}
//ここでデータベースに登録する
$mail = addslashes($_SESSION['mail']);
$account = addslashes($_SESSION['account']);
$password_hash = addslashes($_SESSION['password']);

try{
	//memberテーブルに本登録する
        $pdo = new PDO($dsn, $username, $password);
	$sql = "INSERT INTO member (account,mail,password) VALUES ('$account','$mail','$password_hash')";
	$stmt = $pdo->query($sql);
		
	//pre_memberのflagを1にする
	$sql = "UPDATE pre_member SET flag=1 WHERE mail= '$mail'";
	$stmt = $pdo->query($sql);
		
	//データベース接続切断
	$pdo = null;
	
	//セッション変数を全て解除
	$_SESSION = array();
	
	//セッションクッキーの削除・sessionidとの関係を探れ。つまりはじめのsesssionidを名前でやる
	if (isset($_COOKIE["PHPSESSID"])) {
		setcookie("PHPSESSID", '', time() - 1800, '/');
	}
	
 	//セッションを破棄する
 	session_destroy();
 	
 	/*
 	登録完了のメールを送信
 	*/
	
}catch (PDOException $e){
	$errors['error'] = "もう一度やりなおして下さい。";
	print('Error:'.$e->getMessage());
}

?>

<!DOCTYPE html>
<html>
<head>
<title>会員登録完了画面</title>
<meta charset="Shift_JIS">
</head>
<body>

<h1>会員登録完了画面</h1>
<p>登録完了いたしました。ログイン画面からどうぞ。</p>
<p><a href="login_form.php">ログイン画面</a></p>
<p>echo "htmlspecialchars($_SESSION['mail'], ENT_QUOTES)"</p>
echo "htmlspecialchars($_SESSION['account'], ENT_QUOTES)"</p>
echo "htmlspecialchars($_SESSION['password'], ENT_QUOTES)"</p>
</body>
</html>