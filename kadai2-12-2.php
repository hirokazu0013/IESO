<?php

$username = "���[�U�[��";
$dbpassword = "�p�X���[�h";
$dbname = "�f�[�^�x�[�X��";
$dsn = 'mysql:host=localhost;$dbname;charset=Shift_JIS';
// �f�[�^�x�[�X�T�[�o�ւ̐ڑ�
try {
$pdo = new PDO($dsn, $username, $dbpassword);
// �e�[�u���쐬�pSQL��
  $stmt = $pdo->query("SELECT * FROM test1");
foreach ($stmt as $row){
$number=htmlspecialchars($row['id']);
$name=htmlspecialchars($row['name']);
$password=htmlspecialchars($row['pass']);
$comment=htmlspecialchars($row['comment']);
$date=htmlspecialchars($row['date']);
    echo $number.':'.$name.':'.$password.':'.$comment.':'.$date.':';
    echo '<br>';
}

} catch (PDOException $e) {
header('Content-Type: text/plain; charset=Shift_JIS', true, 500);
    exit($e->getMessage()); 
}
?>