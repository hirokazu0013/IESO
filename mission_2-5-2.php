<html>
<head>
<meta charset="Shift_JIS">
<title>�C�܂܂Ɏ��</title>
</head>
<body>
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
</body>
</html>