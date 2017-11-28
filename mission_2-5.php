<html>
<head>
<meta charset="Shift_JIS">
<title>気ままに趣味活</title>
</head>
<body>
<h1>気ままに趣味活</h1>
<section>
<h2>新規投稿</h2>
<form action="kadai2-5.php" method="post">
  名前：<br />
  <input type="text" name="name" size="30" value="" /><br />
  コメント：<br />
  <textarea name="comment" cols="30" rows="5"></textarea><br />
  <br />
  <input type="submit" name="toukou" value="投稿" />
</form>

<form action="kadai2-5.php" method="POST"> 
削除対象番号：<br /><input type="text" name="delete"> <?php echo $error_delete_no ?>
 <input type="submit" value="削除"> 
 </form>

<form action="kadai2-5.php" method="POST">
編集対象番号：<br/><input type="text" name="edit"> <?php echo $error_edit_no ?>
 <input type="submit" value="編集">
 </form>

</body>
</html>