<head>
<meta charset="Shift_JIS">
<title>気ままに趣味活</title>
</head>
<body>
<p>ファイルをアップロードして下さい</p>
<form action="<?php echo($_SERVER['PHP_SELF']) ?>" method="post" enctype="multipart/form-data">
  ファイル：<br />
  <input type="file" name="image" size="30"><br>
  <input type="hidden" name="max_file_size" value="2097152">
  <input type="submit" name="save" value="アップロード"><br>
  削除キー：<input type="gpassword" name="delkey" value="<?php print $delkey ?>"><br>
</form>

<?php
$username = "ユーザー名";
$dbpassword = "パスワード";
$dbname = "データベース名";
$dsn = 'mysql:host=localhost;$dbname;charset=Shift_JIS';
if(isset($_POST["save"])){ 
if (is_uploaded_file($_FILES["image"]["tmp_name"])) {
  // ファイルが選択されている場合拡張子チェック
  $fileType = pathinfo($_FILES["image"]["name"], PATHINFO_EXTENSION);
  if ($fileType == 'pdf' || $fileType == 'jpg' || $fileType == 'png'|| $fileType == 'jpeg'|| $fileType == 'JPG') {
    // 拡張子がpdfまたはjpgまたはpngの場合ファイルサイズチェック
    if ($_FILES['image']['size'] < 2097152) {
// バイナリデータ
$upfile = $_FILES["image"]["tmp_name"];
$imgdat = base64_encode($upfile);
$imgdat = quotemeta($imgdat);

// 拡張子
$dat = pathinfo($_FILES["image"]["name"], PATHINFO_EXTENSION);

// MIMEタイプ
if ( $dat == "jpg" || $dat == "jpeg" || $dat == "JPG" ){
$mime = "image/jpeg";
}else if( $dat == "gif" ) {
$mime = "image/gif";
}else if( $dat == "png" ) {
$mime = "image/png";
}// MySQL登録

echo $mime;
$image = base64_decode($imgdat); 
print $image;

} else { 
      echo 'ファイルサイズが大きすぎます！';
    }
} else {
    // pdf jpg png 以外の場合
    echo "拡張子はpdf,jpg,jpeg,png,JPGです！";
  }
} else {
  // ファイルが選択されていない場合
  echo "ファイルが選択されていません。";
 }
}
?>

<a href="display.php">画像一覧はこちら</a>