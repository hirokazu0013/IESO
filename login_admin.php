<?php
session_start();

header("Content-type: text/html; charset=Shift_JIS");

// ���O�C����Ԃ̃`�F�b�N
if (!isset($_SESSION["account"])) {
	header("Location: login_form.php");
	exit();
}

$account = $_SESSION['account'];
echo "<p>".htmlspecialchars($account,ENT_QUOTES)."����A����ɂ��́I</p>";

echo "<a href='logout.php'>���O�A�E�g����</a>";