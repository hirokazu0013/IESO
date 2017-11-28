<html>
<head>
<meta charset="Shift_JIS">
<title>気ままに趣味活</title>
</head>
<body>
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



if (null != filter_input_array(INPUT_POST)) {
    $name    = filter_input(INPUT_POST, 'name');
    $comment = filter_input(INPUT_POST, 'comment');

    if (!empty($name) && !empty($comment)) {
        $number  = (int)file_get_contents("counter.txt");
        $name    = $_POST["name"];
        $comment = $_POST["comment"];
        $date    = date('Y/m/d H:i:s');
        $number++;
        $str = $number."<>".$name."<>".$comment."<>".$date. "\r\n";
        $fp = fopen("kadai2-2.txt", "a");
        fwrite($fp, $str);
        fclose($fp);
        file_put_contents("counter.txt", $number);
    }


}
if (isset($_POST["delete"])) {

    $delete = $_POST["delete"];
    $delCon = file("kadai2-2.txt");
    $a      = fopen("kadai2-2.txt", "w");
    @fwrite($a, "");
    fclose($a);
    for ($j = 0; $j < count($delCon); $j++) {
        $delDate = explode("<>", $delCon[$j]);
        array_splice($delDate,1);
        if ($delDate[0] != $delete) {
            $b = fopen("kadai2-2.txt", "a");
            @fwrite($b, $delCon[$j]);
            fclose($b);
        } elseif ($delDate[0] == $delete) {
            $c = fopen("kadai2-2.txt", "a");
            @fwrite($c, "消去しました。\n");
            fclose($c);
        }
    }
}
if (isset($_POST["edit"])) {

    $edit = $_POST["edit"];
    $ediCon = file("kadai2-2.txt");
    $a      = fopen("kadai2-2.txt", "w");
    @fwrite($a, "");
    fclose($a);
    for ($k = 0; $k < count($ediCon); $k++) {
        $ediDate = explode("<>", $ediCon[$k]);
        array_splice($ediDate,1);
        if ($ediDate[0] != $edit) {
            $b = fopen("kadai2-2.txt", "a");
            @fwrite($b, $ediCon[$j]);
            fclose($b);
        } elseif ($ediDate[0] == $edit) {
            $c = fopen("kadai2-2.txt", "a");
            @fwrite($c, "編集しました。\n");
            fclose($c);
        }
    }
}
?>



<?php
echo $message;
?>
<h1>気ままに趣味活</h1>
<section>
<h2>新規投稿</h2>
<form action="kadai2-5-1.php" method="post" >
名前を入力してください。<br/>
<input type="text" name="name" value="<?php
echo $name;
echo $err_msg1;
?>" /><br/>
コメント<br/>
<textarea name ="comment"cols="50" rows="5"><?php
echo $comment;
echo $err_msg2;
?></textarea>
<br>
<input type="submit" name="toukou" value="投稿" />

</form>

<form action="" method="POST">
削除対象番号<input type="text" name="delete">
<input type="submit" name="deleteNo" value="削除">
</form>
<form action="" method="POST">
編集対象番号：<br/><input type="text" name="edit"> <?php echo $error_edit_no ?>
 <input type="submit" name="editNo" value="編集">
</form>
<h2>投稿一覧</h2>


<?php

$file_name = "kadai2-2.txt";

$ret_array = file($file_name);


for ($i = 0; $i < count($ret_array); ++$i) {
    $line = explode("<>", $ret_array[$i]);
    echo ($ret_array[$i] . "<br />\n");
}


?>
</body>
</html>