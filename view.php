<HTML>
<HEAD>
	<meta http-equiv="Content-Type" content="text/html; charset=Shift_JIS" />
	<title>画像表示</title>
</HEAD>
<BODY>
<FORM method="POST" action="view.php">
	<P>画像の表示</P>
	ID：<INPUT type="text" name="id">
	<INPUT type="submit" name="submit" value="送信">
	<BR><BR>
</FORM>

<?php
if (isset($_POST["submit"])){
	$id = $_POST["id"];
	if ($id==""){
		print("IDが入力されていません。<BR>\n");
	} else {
$username = "ユーザー名";
$dbpassword = "パスワード";
$dbname = "データベース名";
$dsn = 'mysql:host=localhost;$dbname;charset=Shift_JIS';

try{
// データベースサーバへの接続
$pdo = new PDO($dsn, $username, $dbpassword);

$sql = "SELECT * FROM posts";
$result = $pdo->query($sql); 

foreach ($result as $row){

print("<img src= create_image.php?id=".$id." >");
 }
} catch (PDOException $e) {
    exit($e->getMessage()); 
  }
 }
}
?>
</BODY>
</HTML>