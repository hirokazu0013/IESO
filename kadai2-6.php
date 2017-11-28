<html>
<head>
<meta charset="Shift_JIS">
<title>気ままに趣味活</title>
</head>
<body>
    <?php

    /***** ファイル書き込み********/
    $dataFile = "keiji_2.txt";

    if(isset($_POST['make']))
    {
        $str = (sizeof(file($dataFile))+1) . '<>' . $_POST['name'] . '<>' . $_POST['comment'] . '<>' . date('m/d/H:i') . '<>' .$_POST['password'] . "\n";
        $fp = fopen('keiji_2.txt','a');
        fwrite($fp, $str);
        fclose($fp);
    }
    /***** ファイル消去********/
    if (isset($_POST['del']))
    {
        $file_make = file("keiji_2.txt");
        for($k = 0;$k <count($file_make); ++$k){
            $file_make[$k] = preg_replace("/\n/", "", $file_make[$k]);

            echo "fn: ".$file_make[$k]."<hr>";

            $delData = preg_split("/<>/", $file_make[$k]);

            echo "del: ".$delData[4]."<hr>";

            if(($delData[0] == $_POST['name2']) and ($delData[4] == $_POST['pass']))
            {
                echo 'in<hr>';
                array_splice($file_make, $k, 1);
                file_put_contents($dataFile, implode("", $file_make));
                echo ($_POST['pass']);echo ($delData[4]);
            }
        }

    }
    /***** ファイル編集 入力フォーム表示********/
    if (isset($_GET['edit']))
    {
        $file_edit = file("keiji_2.txt");
        for($l = 0;$l <count($file_edit); ++$l){
            $editData = explode("<>",$file_edit[$l]);
            if($editData[0] == ($_GET['name3'])) {
                $simEdit = $editData;
            }
        }

    }

    /***** ファイル編集 ファイル書き込み********/
    if (isset($_POST['make']) && isset($_POST['hidden1'])) {

        $file_edit = file("keiji_2.txt");
        for($m = 0;$m <count($file_edit); ++$m){
            $editData2 = explode("<>",$file_edit[$m]);
            if($editData2[0] == ($_POST['hidden1'])){
                $n = $_POST['hidden1'];
                $editData2[1] = $_POST['name'];
                $editData2[2] = $_POST['comment'];
                $file_edit[$m] = implode("<>", $editData2);
                file_put_contents($dataFile,implode("", $file_edit));
            }
        }#echo"hello";echo($_POST['hidden1']);
    }

    ?>

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

    <?php

    /***** txtの最終出力********/
    $data_File = "keiji_2.txt";
    $ret_array = file($data_File);
    for($i = 0;$i <count($ret_array); ++$i){
        $piece = explode("<>", $ret_array[$i]);
        for($j = 0; $j < 4; ++$j){
            echo ($piece[$j]);
        }
        echo "<br />\n";
    }
    ?>

</body>
</html>