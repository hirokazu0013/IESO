<head>
<meta charset="Shift_JIS">
</head>
<body>
  <form method="POST" action="<?php echo $_SERVER['SCRIPT_NAME']; ?>">
  <input type="text" name="name" placeholder="名前"><br>
  <input type="text" name="comment" placeholder="コメント">
  <input type="hidden" name="otp" value="<?PHP print md5(microtime());?>">
  <input type="submit" value="投稿">
  </form>
<?php
ini_set( 'display_errors', 1 );
$username = "ユーザー名";
$dbpassword = "パスワード";
$dbname = "データベース名";
$dsn = 'mysql:host=localhost;$dbname;charset=Shift_JIS';

$otp = filter_input(INPUT_POST,"otp");
$name = filter_input(INPUT_POST,"name");
$comment = filter_input(INPUT_POST,"comment");
try {
  $pdo = new PDO($dsn, $user, $password);
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

$sql = "CREATE TABLE XXX(id int not null primary key auto_increment,name varchar(10),comment text,otp varchar(100) not null unique)";

$sql = $pdo->query('SHOW CREATE TABLE XXX');

$sql = "INSERT INTO XXX()

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
} catch (PDOException $e) {
header('Content-Type: text/plain; charset=Shift_JIS', true, 500);
    exit($e->getMessage()); 
}


?>
</body>
</html>