<?php

$username = "���[�U�[��";
$dbpassword = "�p�X���[�h";
$dbname = "�f�[�^�x�[�X��";
$dsn = 'mysql:host=localhost;$dbname;charset=Shift_JIS';
// �f�[�^�x�[�X�T�[�o�ւ̐ڑ�
try{
$pdo = new PDO($dsn, $username, $password);
// �e�[�u���쐬�pSQL�� 
$sql = "CREATE TABLE IF NOT EXISTS `post`"
."("
. "`ID` bigint(20) not null auto_increment primary key,"
. "`imgdat` MEDIUMBLOB not null,"
. "`mime` VARCHAR(64) not null"
.");";
$stmt = $pdo -> prepare($sql);
$stmt -> execute();
}catch (PDOException $e) {
header('Content-Type: text/plain; charset=Shift_JIS', true, 500);
    exit($e->getMessage()); 
}
?>