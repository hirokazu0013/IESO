<?php
$username = "���[�U�[��";
$dbpassword = "�p�X���[�h";
$dbname = "�f�[�^�x�[�X��";
$dsn = 'mysql:host=localhost;$dbname;charset=Shift_JIS';
try{
// �f�[�^�x�[�X�T�[�o�ւ̐ڑ�
$pdo = new PDO($dsn, $username, $password);
// �e�[�u���쐬�pSQL��
$sql = "CREATE TABLE IF NOT EXISTS `test`"
."("
. "`id` INT auto_increment primary key,"
. "`name` INT,"
. "`pass` INT,"
. "`comment` VARCHAR(255)"
.");";
$stmt = $pdo -> prepare($sql);
$stmt -> execute();
}catch (PDOException $e) {
header('Content-Type: text/plain; charset=Shift_JIS', true, 500);
    exit($e->getMessage()); 
}
?>