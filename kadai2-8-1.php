<?php

$username = "���[�U�[��";
$dbpassword = "�p�X���[�h";
$dbname = "�f�[�^�x�[�X��";
$dsn = 'mysql:host=localhost;$dbname;charset=Shift_JIS';
// �f�[�^�x�[�X�T�[�o�ւ̐ڑ�
try{
$pdo = new PDO($dsn, $username, $password);
// �e�[�u���쐬�pSQL�� 
$sql = "CREATE TABLE IF NOT EXISTS `test1`"
."("
. "`id` INT auto_increment primary key,"
. "`name` VARCHAR(255),"
. "`pass` CHAR(255),"
. "`comment` TEXT,"
. "`date` DATETIME"
.");";
$stmt = $pdo -> prepare($sql);
$stmt -> execute();
}catch (PDOException $e) {
header('Content-Type: text/plain; charset=Shift_JIS', true, 500);
    exit($e->getMessage()); 
}
?>