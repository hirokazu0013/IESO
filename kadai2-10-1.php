<?php

$username = "���[�U�[��";
$dbpassword = "�p�X���[�h";
$dbname = "�f�[�^�x�[�X��";
$dsn = 'mysql:host=localhost;$dbname;charset=Shift_JIS';
// �f�[�^�x�[�X�T�[�o�ւ̐ڑ�
try{
$pdo = new PDO($dsn, $username, $dbpassword);
// �e�[�u���쐬�pSQL��
$sql = "SHOW CREATE TABLE test1";
$stmt =  $pdo->query($sql);
  foreach ($stmt as $row){
    print_r($row);
  }
}catch (PDOException $e) {
header('Content-Type: text/plain; charset=Shift_JIS', true, 500);
    exit($e->getMessage()); 
}
?>