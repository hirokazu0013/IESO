<html>
<head></head>
<body>
        <?php 

$array = file('kadai5.txt', FILE_IGNORE_NEW_LINES);
        //echo $filename;
        
$kadai7 = $array;
$count = count($kadai7);

for ($i = 0; $i < $count; $i++)
 {echo "$kadai7[$i]<br />\r\n";}

?>
</body>
</html>