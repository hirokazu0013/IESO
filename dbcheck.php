<?php

$username = "���[�U�[��";
$dbpassword = "�p�X���[�h";
$dbname = "�f�[�^�x�[�X��";
$dsn = 'mysql:host=localhost;$dbname;charset=Shift_JIS';
// �f�[�^�x�[�X�T�[�o�ւ̐ڑ�
try {
$pdo = new PDO($dsn, $username, $dbpassword);
// �e�[�u���쐬�pSQL��
  $stmt = $pdo->query("SELECT * FROM users");
foreach ($stmt as $row){
$number=htmlspecialchars($row['user_id']);
$name=htmlspecialchars($row['user_name']);
$password=htmlspecialchars($row['user_pass']);
$email=htmlspecialchars($row['user_email']);
$date=htmlspecialchars($row['date']);
    echo $number.':'.$name.':'.$password.':'.$email.':'.$date.':';
    echo '<br>';
}

} catch (PDOException $e) {
header('Content-Type: text/plain; charset=Shift_JIS', true, 500);
    exit($e->getMessage()); 
}
?>