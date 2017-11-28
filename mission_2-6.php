<html>
<head>
<meta charset="Shift_JIS">
<title>気ままに趣味活</title>
</head>
<body>
    <!-- 書き込み用フォーム -->
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
        name:<br/>
        <input type="text" name="name" size="30" value="" /><br >
        password:<br/>
        <input type="text" name="password" size="30" value=""/><br />
        comment:<br/>
        <input type="text" name="comment" size="30" value=""/><br />

        <br />
        <input type="submit" name="make">
    </form>

    <!-- 削除用フォーム -->
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
        delete number:<br/>
        <input type="text" name="name2" size="30" value=""/><br />
        password:<br><br/>
        <input type="text" name="pass" size ="30" placeholder="fill in password"/><br/>
        <input type="submit" name="del">
    </form>

    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="get">
        <input type="hidden" name="hidden" value="<?php echo($_GET['name3']);?>">
        edit number:<br/><br/>
        <input type="text" name="name3" size="30" value="<?php echo($_GET['name3']);?> "/><br />
        <input type="submit" name="edit">

    </form>
</body>
</html>