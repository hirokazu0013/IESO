<head>
<meta charset="Shift_JIS">
<title>�C�܂܂Ɏ��</title>
</head>
<body>
<p>�t�@�C�����A�b�v���[�h���ĉ�����</p>
<form action="<?php echo($_SERVER['PHP_SELF']) ?>" method="post" enctype="multipart/form-data">
  �t�@�C���F<br />
  <input type="file" name="image" size="30"><br>
  <input type="hidden" name="max_file_size" value="2097152">
  <input type="submit" name="save" value="�A�b�v���[�h"><br>
  �폜�L�[�F<input type="gpassword" name="delkey" value="<?php print $delkey ?>"><br>
</form>

<?php
$username = "���[�U�[��";
$dbpassword = "�p�X���[�h";
$dbname = "�f�[�^�x�[�X��";
$dsn = 'mysql:host=localhost;$dbname;charset=Shift_JIS';
if(isset($_POST["save"])){ 
if (is_uploaded_file($_FILES["image"]["tmp_name"])) {
  // �t�@�C�����I������Ă���ꍇ�g���q�`�F�b�N
  $fileType = pathinfo($_FILES["image"]["name"], PATHINFO_EXTENSION);
  if ($fileType == 'pdf' || $fileType == 'jpg' || $fileType == 'png'|| $fileType == 'jpeg'|| $fileType == 'JPG') {
    // �g���q��pdf�܂���jpg�܂���png�̏ꍇ�t�@�C���T�C�Y�`�F�b�N
    if ($_FILES['image']['size'] < 2097152) {
// �o�C�i���f�[�^
$upfile = $_FILES["image"]["tmp_name"];
$imgdat = base64_encode($upfile);
$imgdat = quotemeta($imgdat);

// �g���q
$dat = pathinfo($_FILES["image"]["name"], PATHINFO_EXTENSION);

// MIME�^�C�v
if ( $dat == "jpg" || $dat == "jpeg" || $dat == "JPG" ){
$mime = "image/jpeg";
}else if( $dat == "gif" ) {
$mime = "image/gif";
}else if( $dat == "png" ) {
$mime = "image/png";
}// MySQL�o�^

echo $mime;
$image = base64_decode($imgdat); 
print $image;

} else { 
      echo '�t�@�C���T�C�Y���傫�����܂��I';
    }
} else {
    // pdf jpg png �ȊO�̏ꍇ
    echo "�g���q��pdf,jpg,jpeg,png,JPG�ł��I";
  }
} else {
  // �t�@�C�����I������Ă��Ȃ��ꍇ
  echo "�t�@�C�����I������Ă��܂���B";
 }
}
?>

<a href="display.php">�摜�ꗗ�͂�����</a>