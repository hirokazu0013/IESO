<HTML>
<HEAD>
	<meta http-equiv="Content-Type" content="text/html; charset=Shift_JIS" />
	<title>�摜�\��</title>
</HEAD>
<BODY>
<FORM method="POST" action="view.php">
	<P>�摜�̕\��</P>
	ID�F<INPUT type="text" name="id">
	<INPUT type="submit" name="submit" value="���M">
	<BR><BR>
</FORM>

<?php
if (isset($_POST["submit"])){
	$id = $_POST["id"];
	if ($id==""){
		print("ID�����͂���Ă��܂���B<BR>\n");
	} else {
$username = "���[�U�[��";
$dbpassword = "�p�X���[�h";
$dbname = "�f�[�^�x�[�X��";
$dsn = 'mysql:host=localhost;$dbname;charset=Shift_JIS';

try{
// �f�[�^�x�[�X�T�[�o�ւ̐ڑ�
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