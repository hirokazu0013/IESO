<head>
<meta charset="Shift_JIS">
</head>
<body>
  <form method="POST" action="<?php echo $_SERVER['SCRIPT_NAME']; ?>">
  <input type="text" name="name" placeholder="���O"><br>
  <input type="text" name="comment" placeholder="�R�����g">
  <input type="hidden" name="otp" value="<?PHP print md5(microtime());?>">
  <input type="submit" value="���e">
  </form>

<?php
ini_set( 'display_errors', 1 );
$user = '���[�U��';
$password = '�p�X���[�h';
$dbName = '�f�[�^�x�[�X';
$host = '�z�X�g';
$dsn = "mysql:host={$host};dbname={$dbName};charset=Shift_JIS";

$otp = filter_input(INPUT_POST,"otp");
$name = filter_input(INPUT_POST,"name");
$comment = filter_input(INPUT_POST,"comment");
try {
  $pdo = new PDO($dsn, $user, $password);
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
  if(!is_null($otp)){
    $sql = "INSERT INTO XXX (name, comment,otp) VALUES (?,?,?)";
    $stm = $pdo->prepare($sql);
    $data=($name,$comment,$otp);
    $stm->execute($data);
  }
  $sql = "SELECT * FROM XXX ORDER BY id DESC LIMIT 10";
  $stm = $pdo->query($sql);
  $result = $stm->fetchAll();
  foreach ($result as $row) {
    echo "<div>";
    echo $row['id'].")";
    echo htmlspecialchars($row['name']);
    echo htmlspecialchars($row['comment']);
    echo "<form method='POST' action=''>
          <input type='submit' value''>
          </form>";
    echo "</div>";
  }
} catch (Exception $e) {
  echo '�G���[������܂����B<br>';
  echo $e->getMessage();
}
?>

</body>
</html>