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
　　<tr><td>パスワード：</td>
    <td><input type="text" name="pass"></td></tr>
    <tr><td>コメント：</td>
    <td><textarea name="comment" cols="50" rows="5"></textarea></td></tr>
    <tr><td><input type="submit" name="toukou" value="投稿"></td></tr></table>
</form>

<form action="<?php echo($_SERVER['PHP_SELF']) ?>" method="POST">
削除対象番号<input type="text" name="delete" placeholder="例)1">
パスワード：<input type="text" name="password2">
<input type="submit" name="deleteNo" value="削除">
</form>
<h2>投稿一覧</h2>

<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

date_default_timezone_set('Asia/Tokyo');

$err_msg1 = "";
$err_msg2 = "";
$err_msg3 = "";
$message  = "";
$name     = (isset($_POST["name"]) === true) ? $_POST["name"] : "";
$comment  = (isset($_POST["comment"]) === true) ? trim($_POST["comment"]) : "";
$password     = (isset($_POST["pass"]) === true) ? $_POST["pass"] : "";

if (isset($_POST["toukou"]) === true) {
    if ($name === "")
        $err_msg1 = "名前を入力してください。";

    if ($comment === "")
        $err_msg2 = "コメントを入力してください。";

    if ($password === "")
        $err_msg3 = "パスワードを入力してください。";

    if ($err_msg1 === "" && $err_msg2 === "") {
        $message = "書き込みに成功しました。";
    }

}

// データ新規追加 (idがない場合)
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
//パス書き込み
$number  = (int)file_get_contents("counter1.txt");
$writepas = $password . "<>" . $number;
if (!empty($password)) {
$fp = fopen ("testpas.txt","a");
fputs ($fp, $writepas."\n");
fclose ($fp);
}

// 消去（idは関係なし）
// 削除が押された時
if (isset($_POST["delete"])) {
// 関数をそれぞれ定義（fileは読み込み、POSTは送信）
    $delete = $_POST["delete"];
    $delCon = file("kadai2-5.txt");
    $pasCon = file("testpas.txt");
    $pas2 = $_POST["password2"];
// 配列の数だけループさせる
    for ($r = 0; $r < count($pasCon) ; $r++) {
// testpas.txtからそれぞれの値を取得する
    $pasDate = explode("<>", $pasCon[$r]);
// 番号とパスワードが一致していれば消去する
if ($pasDate[0] == $pas2) { 
    $a = fopen("kadai2-5.txt", "w");
    @fwrite($a, "");
    fclose($a);
// 配列の数だけループさせる  
    for ($j = 0; $j < count($delCon); $j++) {
// kadai2-5.txtからそれぞれの値を取得する
    $delDate = explode("<>", $delCon[$j]);
// それぞれの配列の値を取得
    array_splice($delDate,1);
// 各投稿番号と削除番号を比較して違うもの
    if ($delDate[0] != $delete) {
// kadai2-5.txtに上書き
            $b = fopen("kadai2-5.txt", "a");
// kadai2-5.txtに同じ内容を書き込む
            @fwrite($b, $delCon[$j]);
// kadai2-5.txtを閉じる
            fclose($b);
// 各投稿番号と削除番号を比較して一致するもの
        } elseif ($delDate[0] == $delete) {
// kadai2-5.txtに上書き
            $c = fopen("kadai2-5.txt", "a");
// kadai2-5.txtに消去しました。という内容をを書き込む
            @fwrite($c, "消去しました。\n");
// kadai2-5.txtを閉じる
            fclose($c);
// testpas.txtに文字列を書き込む
        }
    }
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
編集対象番号<input type="text" name="edit_num" placeholder="例)1" value="<?= isset($_POST['edit_num']) ? $_POST['edit_num'] : null ?>">
  パスワード：<input type="text" name="password3">
　<input type="submit"  name="edit_btn" value="編集">
  <input type="hidden"  name="edit" value="hensyu">
</form>

<?php
  if(isset($_POST["edit_btn"])){ 
 //編集ボタンが押されたら
  $pasCon = file("testpas.txt");
    $pas3 = $_POST["password3"];
// 配列の数だけループさせる
    for ($s = 0; $s < count($pasCon) ; $s++) {
// testpas.txtからそれぞれの値を取得する
    $pasDate = explode("<>", $pasCon[$s]);
// 番号とパスワードが一致していれば消去する
if ($pasDate[0] == $pas3) {
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
}
}