<html>
<head>
<meta charset="Shift_JIS">
<title>�C�܂܂Ɏ��</title>
</head>
<body>
<h1>�C�܂܂Ɏ��</h1>
<section>
<h2>�V�K���e</h2>
<form action="kadai2-4.php" method="post">
  ���O�F<br />
  <input type="text" name="name" size="30" value="" /><br />
  �R�����g�F<br />
  <textarea name="comment" cols="30" rows="5"></textarea><br />
  <br />
  <input type="submit" name="toukou" value="���e" />
</form>
<form action="kadai2-4.php" method="POST"> 
�폜�Ώ۔ԍ��F<br /><input type="text" name="deleteNo"> <?php echo $error_delete_no ?>
 <input type="submit" name="delete" value="�폜"> 
 </form>
</body>
</html>