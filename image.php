<?php
/**
 * image.php
 */
require 'common.php';

$id = filter_input(INPUT_GET, 'id');

// データベースからレコードを取得
$sql = 'SELECT `id`, `title`, `path` FROM `images` WHERE `id` = :id';
$arr = [];
$arr[':id'] = $id;
$rows = select($sql, $arr);
$row = reset($rows);
?>
<!DOCTYPE HTML>
<html>
    <head>
        <meta charset="Shift_JIS">
        <title></title>
    </head>
    <body>
        <div id="wrap">
            <p><?= h($row['title']); ?></p>
            <p>
                <img src="<?= h($row['path']); ?>" alt="<?= h($row['title']); ?>" />
            </p>
        </div>
    </body>
</html>