<html>
<head></head>
<body>
        <?php $filename = 'kadai5.txt';
        //echo $filename;
        
        $fp = fopen($filename, 'a');
        fwrite($fp, $_POST["name"]."\r\n");
        fclose($fp);
        ?>

        <?php $filename = 'kadai5.txt';
        //echo $filename;
        
        $fp = fopen($filename, 'a');
        fwrite($fp, $_POST["mail"]."\r\n");
        fclose($fp);
        ?>

        <?php $filename = 'kadai5.txt';
        //echo $filename;
        
        $fp = fopen($filename, 'a');
        fwrite($fp, $_POST["comment"]."\r\n");
        fclose($fp);
        ?>
</body>
</html>