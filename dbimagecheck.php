<?php

$username = "���[�U�[��";
$dbpassword = "�p�X���[�h";
$dbname = "�f�[�^�x�[�X��";
$dsn = 'mysql:host=localhost;$dbname;charset=Shift_JIS';
// �f�[�^�x�[�X�T�[�o�ւ̐ڑ�
try {
$pdo = new PDO($dsn, $username, $dbpassword);
// �e�[�u���쐬�pSQL��
  $stmt = $pdo->query("SELECT * FROM post");
foreach ($stmt as $row){
$number=htmlspecialchars($row['ID']);
$image=htmlspecialchars($row['imgdat']);
$mime=htmlspecialchars($row['mime']);
    echo $number.':'.$image.':'.$mime.':';
    echo '<br>';
}

} catch (PDOException $e) {
header('Content-Type: text/plain; charset=Shift_JIS', true, 500);
    exit($e->getMessage()); 
}
?>