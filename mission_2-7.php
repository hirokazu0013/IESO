<?php
$username = '���[�U�[��';
$password = '�p�X���[�h';
$dbname = '�f�[�^�x�[�X';
$hostname = '�z�X�g';


$dsn = 'mysql:host={$hostname};dbname={$dbname};charset=shift_JIS';
try {
$pdo = new PDO($dsn, $username, $password);
}
?>