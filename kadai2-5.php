<html>
<head>
<meta charset="Shift_JIS">
<title>�C�܂܂Ɏ��</title>
</head>
<body>

<?php
if (isset($_POST['toukou']))
{
    $filename = "kadai2-2.txt";
    //echo $filename;
    $num = file_exists($filename) ? 1+count(file($filename)) : 1;
    $str = $num ."<>".$_POST['name']."<>".$_POST['comment']."<>".date('Y/m/d H:i:s'). "\r\n";
    $fp = fopen('kadai2-2.txt','a');
    fwrite($fp, $str);
    fclose($fp); 
}
if (isset($_POST['delete'])) {

$delete = $_POST['deleteNo'];
$delCon = file("kadai2-2.txt");
for ($j = 0; $j < count($delCon) ; $j++){ 
$delData = explode("<>", $delCon[$j]);
if ($delData[0] == "{".$delete."}") { 
array_splice($delCon, $j, 1);
file_put_contents($filename, $delCon);
  }
 }
}
if (!empty($edit)) {
$ediCon = file("kadai2-2.txt");
for ($k = 0; $k < count($ediCon) ; $k++) {
$ediData = explode("<>", $ediCon[$k]);
if ($ediData[0] == "{".$edit."}") {
//$simEdit = explode("}<>{", $ediCon[$k]);
for($h = 0; $h < count($ediData); $h++){
$simEdit[$h] = mb_substr(trim($ediData[$h]), 1, -1);
   }
  }
 }
}

?>

<h1>�C�܂܂Ɏ��</h1>
<section>
<h2>�V�K���e</h2>
<form action="kadai2-5.php" method="post">
  ���O�F<br />
  <input type="text" name="name" size="30" value="" /><br />
  �R�����g�F<br />
  <textarea name="comment" cols="30" rows="5"></textarea><br />
  <br />
  <input type="submit" name="toukou" value="���e" />
</form>

<form action="kadai2-5.php" method="POST"> 
�폜�Ώ۔ԍ��F<br /><input type="text" name="deleteNo"> <?php echo $error_delete_no ?>
 <input type="submit" name="delete" value="�폜"> 
</form>

<form action="kadai2-5.php" method="POST">
�ҏW�Ώ۔ԍ��F<br/><input type="text" name="edit"> <?php echo $error_edit_no ?>
 <input type="submit" value="�ҏW">
 </form>

<?php

    $data_File = "kadai2-2.txt";
    $ret_array = file($data_File);
    for($i = 0;$i <count($ret_array); ++$i){
        $piece = explode("<>", $ret_array[$i]);
                    for($j = 0; $j < 4; ++$j){
            echo ($piece[$j]);
            }
        echo "<br />\r\n";    
    }
?>

</body>
</html>