<?php

$username = "���[�U�[��";
$dbpassword = "�p�X���[�h";
$dbname = "�f�[�^�x�[�X��";
$dsn = 'mysql:host=localhost;$dbname;charset=Shift_JIS';
// �f�[�^�x�[�X�T�[�o�ւ̐ڑ�
try{
$pdo = new PDO($dsn, $username, $password);
// �e�[�u���쐬�pSQL��
$stmt =  $pdo->prepare("ALTER TABLE test1 ADD upfile ");
$stmt -> execute();

}catch (PDOException $e) {
header('Content-Type: text/plain; charset=Shift_JIS', true, 500);
    exit($e->getMessage()); 
}
?>