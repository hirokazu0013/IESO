<?php

$username = "���[�U�[��";
$dbpassword = "�p�X���[�h";
$dbname = "�f�[�^�x�[�X��";
$dsn = 'mysql:host=localhost;$dbname;charset=Shift_JIS';
// �f�[�^�x�[�X�T�[�o�ւ̐ڑ�
$pdo = new PDO($dsn, $username, $password);
// �e�[�u���쐬�pSQL��

$sql = "SELECT * FROM XXX ORDER BY id DESC LIMIT 10";
  $stm = $pdo->query($sql);
  $result = $stm->fetchAll();
  foreach ($result as $row) {
    echo "<div>";
    echo $row['id'].")";
    echo htmlspecialchars($row['name']);
    echo htmlspecialchars($row['comment']);
    echo "</div>";
}
?>