<?php

$username = "���[�U�[��";
$dbpassword = "�p�X���[�h";
$dbname = "�f�[�^�x�[�X��";
$dsn = 'mysql:host=localhost;$dbname;charset=Shift_JIS';
// �f�[�^�x�[�X�T�[�o�ւ̐ڑ�
$pdo = new PDO($dsn, $username, $password);
// �e�[�u���쐬�pSQL��

$stmt = $pdo -> query("INSERT INTO XXX (dd, y, m) VALUES (11, 2017, 13)");

?>