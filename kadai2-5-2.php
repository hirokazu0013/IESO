<html>
<head>
<meta charset="Shift_JIS">
<title>�C�܂܂Ɏ��</title>
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
        $err_msg1 = "���O����͂��Ă�������";

    if ($comment === "")
        $err_msg2 = "�R�����g����͂��Ă�������";

    if ($err_msg1 === "" && $err_msg2 === "") {
        $message = "�������݂ɐ������܂����B";
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
            @fwrite($c, "�������܂����B\n");
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
            @fwrite($c, "�ҏW���܂����B\n");
            fclose($c);
        }
    }
}
?>



<?php
echo $message;
?>
<h1>�C�܂܂Ɏ��</h1>
<section>
<h2>�V�K���e</h2>
<form action="kadai2-5-1.php" method="post" >
���O����͂��Ă��������B<br/>
<input type="text" name="name" value="<?php
echo $name;
echo $err_msg1;
?>" /><br/>
�R�����g<br/>
<textarea name ="comment"cols="50" rows="5"><?php
echo $comment;
echo $err_msg2;
?></textarea>
<br>
<input type="submit" name="toukou" value="���e" />

</form>

<form action="" method="POST">
�폜�Ώ۔ԍ�<input type="text" name="delete">
<input type="submit" name="deleteNo" value="�폜">
</form>
<form action="" method="POST">
�ҏW�Ώ۔ԍ��F<br/><input type="text" name="edit"> <?php echo $error_edit_no ?>
 <input type="submit" name="editNo" value="�ҏW">
</form>
<h2>���e�ꗗ</h2>


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