<?php
$filename = 'kadai2.txt';
//echo $filename;

$fp = fopen($filename, 'w');

fwrite($fp, 'test');

fclose($fp);

?>

<?php
/*?�yitem.txt�z�̓��e
<?
$apple?=?"�����S";
$banana?=?"�o�i�i";
*/

include("kadai2.txt");
//echo $filename;
?>