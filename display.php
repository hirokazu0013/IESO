<HTML>
<HEAD>
	<meta http-equiv="Content-Type" content="text/html; charset=shift_JIS" />
	<title>�摜�\��</title>
</HEAD>
<BODY>
<FORM method="POST" action="display.php">
	<P>�摜�̕\��</P>
	ID�F<INPUT type="text" name="id">
	<INPUT type="submit" name="submit" value="���M">
	<BR><BR>
</FORM>

<?php
if (isset($_POST["submit"])){
	$id = $_POST["id"];
	if ($id==""){
		print("ID�����͂���Ă��܂���B<BR>\n");
	} else {
		print("<img src=\"create_image.php?id=".$id."\">");
	}
}
?>
</BODY>
</HTML>