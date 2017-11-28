<html>
<head>
<meta charset="Shift_JIS">
<title></title>
</head>
<body>
<?php
$filename = "kadai2-2.txt";
//echo $filename;
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
</body>
</html>