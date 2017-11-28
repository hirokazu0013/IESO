<?php
session_start();

$db['host'] = "localhost";  // DB�T�[�o��URL
$db['user'] = "root";  // ���[�U�[��
$db['pass'] = "pass";  // ���[�U�[���̃p�X���[�h
$db['dbname'] = "loginManagement";  // �f�[�^�x�[�X��

// �G���[���b�Z�[�W�A�o�^�������b�Z�[�W�̏�����
$errorMessage = "";
$SignUpMessage = "";

// ���O�C���{�^���������ꂽ�ꍇ
if (isset($_POST["signUp"])) {
    // 1. ���[�UID�̓��̓`�F�b�N
    if (empty($_POST["mailaddress"])) {  // �l����̂Ƃ�
        $errorMessage = 'mailaddress�������͂ł��B';
    } else if (empty($_POST["password"])) {
        $errorMessage = '�p�X���[�h�������͂ł��B';
    } else if (empty($_POST["password2"])) {
        $errorMessage = '�p�X���[�h�������͂ł��B';
    }

    if (!empty($_POST["mailaddress"]) && !empty($_POST["password"]) && !empty($_POST["password2"]) && $_POST["password"] == $_POST["password2"] && filter_var($_POST['mailaddress'], FILTER_VALIDATE_EMAIL)) {
        // ���͂������[�UID�ƃp�X���[�h���i�[
        $mailaddress = $_POST["mailaddress"];
        $password = $_POST["password"];

        // 2. ���[�UID�ƃp�X���[�h�����͂���Ă�����F�؂���
        $dsn = sprintf('mysql: host=%s; dbname=%s; charset=utf8', $db['host'], $db['dbname']);

        // 3. �G���[����
        try {
            $pdo = new PDO($dsn, $db['user'], $db['pass'], array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));

            $stmt = $pdo->prepare("INSERT INTO userData(mailaddress, password) VALUES (?, ?)");

            $stmt->execute(array($mailaddress, password_hash($password, PASSWORD_DEFAULT)));  // �p�X���[�h�̃n�b�V�������s���i����͕�����݂̂Ȃ̂�bindValue(�ϐ��̓��e���ς��Ȃ�)���g�p�����A����excute�ɓn���Ă����Ȃ��j
            $userid = $pdo->lastinsertid();  // �o�^����(DB����auto_increment����)ID��$userid�ɓ����

            $SignUpMessage = '�o�^���������܂����B���Ȃ��̓o�^���[�UID�� ' . $userid . ' �ł��B�p�X���[�h�� ' . $password . ' �ł��B';  // ���O�C�����Ɏg�p����ID�ƃp�X���[�h
        } catch (PDOException $e) {
            $errorMessage = '�f�[�^�x�[�X�G���[';
            // $e->getMessage() �ŃG���[���e���Q�Ɖ\�i�f�o�b�N���̂ݕ\���j
            // echo $e->getMessage();
        }
    } elseif ($_POST["password"] != $_POST["password2"]) {
        $errorMessage = '�p�X���[�h�Ɍ�肪����܂��B';
    } elseif (filter_var($_POST['mailaddress'], FILTER_VALIDATE_EMAIL) == false) {
        $errorMessage = '���[���A�h���X�̏������Ԉ���Ă��܂��B';
    }
}
?>

<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <title>�V�K�o�^</title>
</head>
<body>
<h1>�V�K�o�^���</h1>
<!-- $_SERVER['PHP_SELF']��XSS�̊댯��������̂ŁAaction�͋�ɂ��Ă��� -->
<!-- <form id="loginForm" name="loginForm" action="<?php print($_SERVER['PHP_SELF']) ?>" method="POST"> -->
<form id="loginForm" name="loginForm" action="" method="POST">
    <fieldset>
        <legend>�V�K�o�^�t�H�[��</legend>
        <div><font color="#ff0000"><?php echo $errorMessage ?></font></div>
        <div><font color="#0000ff"><?php echo $SignUpMessage ?></font></div>
        <label for="mailaddress">���[�U�[��</label><input type="text" id="mailaddress" name="mailaddress"
                                                     placeholder="���[�U�[�������"
                                                     value="<?php if (!empty($_POST["mailaddress"])) {
                                                         echo htmlspecialchars($_POST["mailaddress"], ENT_QUOTES);
                                                     } ?>">
        <br>
        <label for="password">�p�X���[�h</label><input type="password" id="password" name="password" value=""
                                                  placeholder="�p�X���[�h�����">
        <br>
        <label for="password2">�p�X���[�h(�m�F�p)</label><input type="password" id="password2" name="password2" value=""
                                                        placeholder="�ēx�p�X���[�h�����">
        <br>
        <input type="submit" id="signUp" name="signUp" value="�V�K�o�^">
    </fieldset>
</form>
<br>
<form action="Login.php">
    <input type="submit" value="�߂�">
</form>
</body>
</html>