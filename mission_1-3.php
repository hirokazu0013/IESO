<?php
$filename = 'kadai2.txt';
//echo $filename;

$fp = fopen($filename, 'w');

fwrite($fp, 'test');

fclose($fp);

?>

<?php
/*?yitem.txtz‚Ì“à—e
<?
$apple?=?"ƒŠƒ“ƒS";
$banana?=?"ƒoƒiƒi";
*/

include("kadai2.txt");
//echo $filename;
?>