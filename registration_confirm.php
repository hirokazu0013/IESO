<?php
$username = "���[�U�[��";
$dbpassword = "�p�X���[�h";
$dbname = "�f�[�^�x�[�X��";
$dsn = 'mysql:host=localhost;$dbname;charset=Shift_JIS';
// �f�[�^�x�[�X�T�[�o�ւ̐ڑ�

$pdo = new PDO($dsn, $username, $password);

$username = $_GET['username'];
$reg_key = $_GET['reg_key'];

$sql = "SELECT * FROM interim_registration WHERE username = '$username' AND reg_key = '$reg_key'";
$stmt = $pdo->query($sql);
foreach ($stmt as $row){
$reg_key = $_GET['reg_key'];
$susername=htmlspecialchars($row['username']);
$sreg_key=htmlspecialchars($row['reg_key']);
$userdata = $sreg_key;
if($userdata === $reg_key){
echo "�L�[����v���܂���B";
}else{
echo "���K���[�U�[�o�^�������s���܂��B";
}
}
?>