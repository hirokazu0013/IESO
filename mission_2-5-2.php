<html>
<head>
<meta charset="Shift_JIS">
<title>気ままに趣味活</title>
</head>
<body>
<h1>気ままに趣味活</h1>
<section>
<h2>新規投稿</h2>
<form action="kadai2-5-1.php" method="post" >
名前を入力してください。<br/>
<input type="text" name="name" value="<?php
echo $name;
echo $err_msg1;
?>" /><br/>
コメント<br/>
<textarea name ="comment"cols="50" rows="5"><?php
echo $comment;
echo $err_msg2;
?></textarea>
<br>
<input type="submit" name="toukou" value="投稿" />
</form>

<form action="" method="POST">
削除対象番号<input type="text" name="delete">
<input type="submit" name="deleteNo" value="削除">
</form>

<form action="" method="POST">
編集対象番号：<br/><input type="text" name="edit"> <?php echo $error_edit_no ?>
 <input type="submit" name="editNo" value="編集">
 </form>
</body>
</html>