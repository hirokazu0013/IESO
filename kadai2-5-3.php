<html>
<head>
<meta charset="Shift_JIS">
<title>気ままに趣味活</title>
</head>
<body>
<h1>気ままに趣味活</h1>
<section>
<h2>新規投稿</h2>
<form action="<?php echo($_SERVER['PHP_SELF']) ?>" method="post">
  <table>
    <tr><td>名前：</td>
    <td><input type="text" name="name"></td></tr>
    <tr><td>コメント：</td>
    <td><textarea name="comment" cols="50" rows="5"></textarea></td></tr>
    <tr><td><input type="submit" name="toukou" value="投稿"></td></tr></table>
</form>

<form action="<?php echo($_SERVER['PHP_SELF']) ?>" method="POST">
削除対象番号<input type="text" name="delete">
<input type="submit" name="deleteNo" value="削除">
</form>
<h2>投稿一覧</h2>

<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

date_default_timezone_set('Asia/Tokyo');

$err_msg1 = "";
$err_msg2 = "";
$message  = "";
$name     = (isset($_POST["name"]) === true) ? $_POST["name"] : "";
$comment  = (isset($_POST["comment"]) === true) ? trim($_POST["comment"]) : "";

if (isset($_POST["toukou"]) === true) {
    if ($name === "")
        $err_msg1 = "名前を入力してください";

    if ($comment === "")
        $err_msg2 = "コメントを入力してください";

    if ($err_msg1 === "" && $err_msg2 === "") {
        $message = "書き込みに成功しました。";
    }

}

// 新規追加 (idがない場合)
if(isset($_POST["toukou"]) && !isset($_POST["id"])) {
if (null != filter_input_array(INPUT_POST)) {
    $name    = filter_input(INPUT_POST, 'name');
    $comment = filter_input(INPUT_POST, 'comment');

    if (!empty($name) && !empty($comment)) {
        $number  = (int)file_get_contents("counter1.txt");
        $name    = $_POST["name"];
        $comment = $_POST["comment"];
        $date    = date('Y/m/d H:i:s');
        $number++;
        $str = $number."<>".$name."<>".$comment."<>".$date. "\r\n";
        $fp = fopen("kadai2-5.txt", "a");
        fwrite($fp, $str);
        fclose($fp);
        file_put_contents("counter1.txt", $number);
    }

 }
}
// 消去（idは関係なし）
if (isset($_POST["delete"])) {

    $delete = $_POST["delete"];
    $delCon = file("kadai2-5.txt");
    $a      = fopen("kadai2-5.txt", "w");
    @fwrite($a, "");
    fclose($a);
    for ($j = 0; $j < count($delCon); $j++) {
        $delDate = explode("<>", $delCon[$j]);
        array_splice($delDate,1);
        if ($delDate[0] != $delete) {
            $b = fopen("kadai2-5.txt", "a");
            @fwrite($b, $delCon[$j]);
            fclose($b);
        } elseif ($delDate[0] == $delete) {
            $c = fopen("kadai2-5.txt", "a");
            @fwrite($c, "消去しました。\n");
            fclose($c);
        }
    }
}

// 変更 (idがある場合)
if(isset($_POST["toukou"]) && isset($_POST["id"])) {
  $contents = file("kadai2-5.txt");
  $fp1 = fopen('kadai2-5.txt','w');
  $edit_num =  $_POST["id"];
  foreach($contents as $content) {
    $parts = explode("<>", $content);
    if($parts[0] == $edit_num){
        $name    = $_POST["name"];
        $comment = $_POST["comment"];
        $date    = date('Y/m/d H:i:s');
        $str = $edit_num."<>".$name."<>".$comment."<>".$date. "\r\n";
        fwrite($fp1, $str);
    } else {
      fwrite($fp1, "$content");
    }
  }
  fclose($fp1);
}

// 表示
$contents = file("kadai2-5.txt");
foreach ($contents as $content) {
  $parts = explode("<>", $content);
  foreach ($parts as $part) {
    echo "<table><tr>$part</tr></table>";
  }
}
?>

<p>-----------------------</p>
<p>編集したい番号を、半角数字で入力してください</p>
<form method="post" action="<?php echo($_SERVER['PHP_SELF']) ?>">
<input type="text" name="edit_num" placeholder="例)1" value="<?= isset($_POST['edit_num']) ? $_POST['edit_num'] : null ?>">
  <input type="submit"  name="edit_btn" value="編集する">
  <input type="hidden"  name="edit" value="hensyu">
</form>

<?php
  if(isset($_POST["edit_btn"])){  //編集ボタンが押されたら
    if($_POST["edit_num"]){
      $edit_num =  $_POST["edit_num"];
      foreach ($contents as $content){
        $parts = explode("<>", $content);
        if($parts[0] == $edit_num){
?>
<form action="<?php echo($_SERVER['PHP_SELF']) ?>" method="post">
  <input type="hidden" name="id" value="<?= $parts[0] ?>">
  <table>
    <tr><td>名前：</td>
    <td><input type="text" name="name" value="<?= $parts[1] ?>"></td></tr>
    <tr><td>コメント：</td>
    <td><textarea name="comment" cols="50" rows="5"><?= $parts[2] ?></textarea></td></tr>
    <tr><td><input type="submit" name="toukou" value="投稿"></td></tr>
  </table>
</form>
<?php
        }
      }
    } else {
      echo "編集する番号を入力してください！";
    }
  }