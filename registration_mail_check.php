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
}else{
	//POSTされたデータを変数に入れる
	$mail = isset($_POST['mail']) ? $_POST['mail'] : NULL;

//メール入力判定
	if ($mail == ''){
		 echo "メールが入力されていません。";
	}else{

	
	$urltoken = hash('sha256',uniqid(rand(),1));
	$url = "http://co-735.it.99sv-coco.com/registration_form.php"."?urltoken=".$urltoken;
	$date    = date('Y/m/d H:i:s');
	//ここでデータベースに登録する
	try{
// データベースサーバへの接続
$pdo = new PDO($dsn, $username, $password);
$sql = "INSERT INTO pre_member (urltoken,mail,date) VALUES ('$urltoken','$mail','$date')";
$stmt = $pdo->query($sql);
}catch (PDOException $e){
		print('Error:'.$e->getMessage());
		die();
	}

$to = $mail;
$subject = 'e-mail confirm';
$header = "From:";
$body = <<< EOM
24時間以内に下記のURLからご登録下さい。
{$url}
EOM;
mb_language('ja');
mb_internal_encoding('Shift_JIS');
if(mb_send_mail($to, $subject, $body, $header)){
echo 'メールをお送りしました。24時間以内にメールに記載されたURLからご登録下さい。';
}else{
echo 'メール送信に失敗致しました。';
 }
}
}
?>