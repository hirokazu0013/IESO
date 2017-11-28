<?php
$username = 'ユーザー名';
$password = 'パスワード';
$dbname = 'データベース';
$hostname = 'ホスト';


$dsn = 'mysql:host={$hostname};dbname={$dbname};charset=shift_JIS';
try {
$pdo = new PDO($dsn, $username, $password);
}
?>