<?php
session_start();

header("Content-type: text/html; charset=Shift_JIS");

//クロスサイトリクエストフォージェリ（CSRF）対策
$_SESSION['token'] = sha1(uniqid(mt_rand(), true));
$token = $_SESSION['token'];

//データベース接続
$username = "co-735.it.3919.c";
$password = "Mbiu8rt";
$dbname = "co_735_it_3919_com";
$dsn = 'mysql:host=localhost;dbname=co_735_it_3919_com;charset=Shift_JIS';
$pdo = new PDO($dsn, $username, $password);
//エラーメッセージの初期化
$errors = array();

if(empty($_GET)) {
	header("Location: registration_mail_form.php");
	exit();
}else{
	//GETデータを変数に入れる
	$urltoken = isset($_GET[urltoken]) ? $_GET[urltoken] : NULL;
	//メール入力判定
	if ($urltoken == ''){
		echo "もう一度登録をやりなおして下さい。";
	}else{
		try{
			//flagが0の未登録者・仮登録日から24時間以内
			$pdo = new PDO($dsn, $username, $password);
			$sql = "SELECT mail FROM pre_member WHERE urltoken= '$urltoken' AND flag =0 AND date > now() - interval 24 hour";
			$stmt = $pdo->query($sql);
			
			//レコード件数取得
			$row_count = $stmt->rowCount();
			//24時間以内に仮登録され、本登録されていないトークンの場合
			if($row_count ==1){
				foreach ($stmt as $row){
                        	$mail = htmlspecialchars($row['mail']);
				$_SESSION['mail'] = $mail;
                          }
			}else{
				 echo "このURLはご利用できません。有効期限が過ぎた等の問題があります。もう一度登録をやりなおして下さい。";
			 }
			
			//データベース接続切断
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
<title>会員登録画面</title>
<link rel="stylesheet" href="style.css">
<!-- Bootstrap読み込み（スタイリングのため） -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css">
</head>
<body>
<div class="col-xs-6 col-xs-offset-3">
<h1>会員登録画面</h1>

<form action="registration_check.php" method="post">
<div class="form-group">
<?=htmlspecialchars($mail, ENT_QUOTES, 'Shift_JIS')?><class="form-control" placeholder="メールアドレス" required />
</div>
<div class="form-group">
<input type="text" class="form-control" name="account" placeholder="アカウント名" required />
</div>
<div class="form-group">
<input type="text" class="form-control" name="password" placeholder="パスワード" required />
</div>
<input type="hidden" name="token" value="<?=$token?>">
<button type="submit" class="btn btn-default" name="signup">会員登録する</button>
<a href="login_form.php">会員ページログインはこちら</a> 
</form>

</body>
</html>