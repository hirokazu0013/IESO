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
?>

<h1>�C�܂܂Ɏ��</h1>
<section>
<h2>�V�K���e</h2>
<form action="kadai2-3.php" method="post">
  ���O�F<br />
  <input type="text" name="name" size="30" value="" /><br />
  �R�����g�F<br />
  <textarea name="comment" cols="30" rows="5"></textarea><br />
  <br />
  <input type="submit" name="toukou" value="���e" />
</form>

<?php
    $data_File = "kadai2-2.txt";
    $ret_array = file($data_File);
    for($i = 0;$i <count($ret_array); ++$i){
        $piece = explode("<>", $ret_array[$i]);
                    for($j = 0; $j < 4; ++$j){
            echo ($piece[$j]);
            }
        echo "<br />\n";    
    }
?>
</body>
</html>