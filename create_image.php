<?php
$username = "���[�U�[��";
$dbpassword = "�p�X���[�h";
$dbname = "�f�[�^�x�[�X��";
$dsn = 'mysql:host=localhost;$dbname;charset=Shift_JIS';

$id = $_GET['id'];

try{
// �f�[�^�x�[�X�T�[�o�ւ̐ڑ�
$pdo = new PDO($dsn, $username, $dbpassword);

$sql = "SELECT * FROM post WHERE ID = '$id'";
$result = $pdo->query($sql); 
foreach ($result as $row){
$mime = $row['mime'];
$imgdat = $row['imgdat'];
$image = base64_decode($imgdat);
header('Content-Type: $mime');
 echo $image;
 echo '<br>';
 }
} catch (PDOException $e) {
    exit($e->getMessage()); 
}
?>