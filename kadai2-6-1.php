<html>
<head>
<meta charset="Shift_JIS">
<title>�C�܂܂Ɏ��</title>
</head>
<body>
<h1>�C�܂܂Ɏ��</h1>
<section>
<h2>�V�K���e</h2>
<form action="<?php echo($_SERVER['PHP_SELF']) ?>" method="post">
  <table>
    <tr><td>���O�F</td>
    <td><input type="text" name="name"></td></tr>
�@�@<tr><td>�p�X���[�h�F</td>
    <td><input type="text" name="pass"></td></tr>
    <tr><td>�R�����g�F</td>
    <td><textarea name="comment" cols="50" rows="5"></textarea></td></tr>
    <tr><td><input type="submit" name="toukou" value="���e"></td></tr></table>
</form>

<form action="<?php echo($_SERVER['PHP_SELF']) ?>" method="POST">
�폜�Ώ۔ԍ�<input type="text" name="delete" placeholder="��)1">
�p�X���[�h�F<input type="text" name="password2">
<input type="submit" name="deleteNo" value="�폜">
</form>
<h2>���e�ꗗ</h2>

<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

date_default_timezone_set('Asia/Tokyo');

$err_msg1 = "";
$err_msg2 = "";
$err_msg3 = "";
$message  = "";
$name     = (isset($_POST["name"]) === true) ? $_POST["name"] : "";
$comment  = (isset($_POST["comment"]) === true) ? trim($_POST["comment"]) : "";
$password     = (isset($_POST["pass"]) === true) ? $_POST["pass"] : "";

if (isset($_POST["toukou"]) === true) {
    if ($name === "")
        $err_msg1 = "���O����͂��Ă��������B";

    if ($comment === "")
        $err_msg2 = "�R�����g����͂��Ă��������B";

    if ($password === "")
        $err_msg3 = "�p�X���[�h����͂��Ă��������B";

    if ($err_msg1 === "" && $err_msg2 === "") {
        $message = "�������݂ɐ������܂����B";
    }

}

// �f�[�^�V�K�ǉ� (id���Ȃ��ꍇ)
if(isset($_POST["toukou"]) && !isset($_POST["id"])) {
if (null != filter_input_array(INPUT_POST)) {
    $name    = filter_input(INPUT_POST, 'name');
    $comment = filter_input(INPUT_POST, 'comment');

    if (!empty($name) && !empty($comment)) {
        $number  = (int)file_get_contents("counter1.txt");
        $name    = $_POST["name"];
        $comment = $_POST["comment"];
        $date    = date('Y/m/d H:i:s');
        $number++;
        $str = $number."<>".$name."<>".$comment."<>".$date. "\r\n";
        $fp = fopen("kadai2-5.txt", "a");
        fwrite($fp, $str);
        fclose($fp);
        file_put_contents("counter1.txt", $number);
    }

 }
}
//�p�X��������
$number  = (int)file_get_contents("counter1.txt");
$writepas = $password . "<>" . $number;
if (!empty($password)) {
$fp = fopen ("testpas.txt","a");
fputs ($fp, $writepas."\n");
fclose ($fp);
}

// �����iid�͊֌W�Ȃ��j
// �폜�������ꂽ��
if (isset($_POST["delete"])) {
// �֐������ꂼ���`�ifile�͓ǂݍ��݁APOST�͑��M�j
    $delete = $_POST["delete"];
    $delCon = file("kadai2-5.txt");
    $pasCon = file("testpas.txt");
    $pas2 = $_POST["password2"];
// �z��̐��������[�v������
    for ($r = 0; $r < count($pasCon) ; $r++) {
// testpas.txt���炻�ꂼ��̒l���擾����
    $pasDate = explode("<>", $pasCon[$r]);
// �ԍ��ƃp�X���[�h����v���Ă���Ώ�������
if ($pasDate[0] == $pas2) { 
    $a = fopen("kadai2-5.txt", "w");
    @fwrite($a, "");
    fclose($a);
// �z��̐��������[�v������  
    for ($j = 0; $j < count($delCon); $j++) {
// kadai2-5.txt���炻�ꂼ��̒l���擾����
    $delDate = explode("<>", $delCon[$j]);
// ���ꂼ��̔z��̒l���擾
    array_splice($delDate,1);
// �e���e�ԍ��ƍ폜�ԍ����r���ĈႤ����
    if ($delDate[0] != $delete) {
// kadai2-5.txt�ɏ㏑��
            $b = fopen("kadai2-5.txt", "a");
// kadai2-5.txt�ɓ������e����������
            @fwrite($b, $delCon[$j]);
// kadai2-5.txt�����
            fclose($b);
// �e���e�ԍ��ƍ폜�ԍ����r���Ĉ�v�������
        } elseif ($delDate[0] == $delete) {
// kadai2-5.txt�ɏ㏑��
            $c = fopen("kadai2-5.txt", "a");
// kadai2-5.txt�ɏ������܂����B�Ƃ������e������������
            @fwrite($c, "�������܂����B\n");
// kadai2-5.txt�����
            fclose($c);
// testpas.txt�ɕ��������������
        }
    }
  }
 }
}
// �ύX (id������ꍇ)
if(isset($_POST["toukou"]) && isset($_POST["id"])) {
  $contents = file("kadai2-5.txt");
  $fp1 = fopen('kadai2-5.txt','w');
  $edit_num =  $_POST["id"];
  foreach($contents as $content) {
    $parts = explode("<>", $content);
    if($parts[0] == $edit_num){
        $name    = $_POST["name"];
        $comment = $_POST["comment"];
        $date    = date('Y/m/d H:i:s');
        $str = $edit_num."<>".$name."<>".$comment."<>".$date. "\r\n";
        fwrite($fp1, $str);
    } else {
      fwrite($fp1, "$content");
    }
  }
  fclose($fp1);
  }
// �\��
$contents = file("kadai2-5.txt");
foreach ($contents as $content) {
  $parts = explode("<>", $content);
  foreach ($parts as $part) {
    echo "<table><tr>$part</tr></table>";
  }
}
?>

<p>-----------------------</p>
<p>�ҏW�������ԍ����A���p�����œ��͂��Ă�������</p>
<form method="post" action="<?php echo($_SERVER['PHP_SELF']) ?>">
�ҏW�Ώ۔ԍ�<input type="text" name="edit_num" placeholder="��)1" value="<?= isset($_POST['edit_num']) ? $_POST['edit_num'] : null ?>">
  �p�X���[�h�F<input type="text" name="password3">
�@<input type="submit"  name="edit_btn" value="�ҏW">
  <input type="hidden"  name="edit" value="hensyu">
</form>

<?php
  if(isset($_POST["edit_btn"])){ 
 //�ҏW�{�^���������ꂽ��
  $pasCon = file("testpas.txt");
    $pas3 = $_POST["password3"];
// �z��̐��������[�v������
    for ($s = 0; $s < count($pasCon) ; $s++) {
// testpas.txt���炻�ꂼ��̒l���擾����
    $pasDate = explode("<>", $pasCon[$s]);
// �ԍ��ƃp�X���[�h����v���Ă���Ώ�������
if ($pasDate[0] == $pas3) {
    if($_POST["edit_num"]){
      $edit_num =  $_POST["edit_num"];
      foreach ($contents as $content){
        $parts = explode("<>", $content);
        if($parts[0] == $edit_num){
?>
<form action="<?php echo($_SERVER['PHP_SELF']) ?>" method="post">
  <input type="hidden" name="id" value="<?= $parts[0] ?>">
  <table>
    <tr><td>���O�F</td>
    <td><input type="text" name="name" value="<?= $parts[1] ?>"></td></tr>
    <tr><td>�R�����g�F</td>
    <td><textarea name="comment" cols="50" rows="5"><?= $parts[2] ?></textarea></td></tr>
    <tr><td><input type="submit" name="toukou" value="���e"></td></tr>
  </table>
</form>
<?php
        }
      }
    } else {
      echo "�ҏW����ԍ�����͂��Ă��������I";
    }
  }
}
}