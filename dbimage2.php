<?php

$username = "���[�U�[��";
$dbpassword = "�p�X���[�h";
$dbname = "�f�[�^�x�[�X��";
$dsn = 'mysql:host=localhost;$dbname;charset=Shift_JIS';
// �f�[�^�x�[�X�T�[�o�ւ̐ڑ�
try{
$pdo = new PDO($dsn, $username, $password);
// �e�[�u���쐬�pSQL�� 
$sql = "CREATE TABLE IF NOT EXISTS `images`"
."("
. "`id` int(11) unsigned not null auto_increment primary key,"
. "`title` VARCHAR(32) not null,"
. "`path` VARCHAR(255) not null"
.");";
$stmt = $pdo -> prepare($sql);
$stmt -> execute();
}catch (PDOException $e) {
header('Content-Type: text/plain; charset=Shift_JIS', true, 500);
    exit($e->getMessage()); 
}
?>