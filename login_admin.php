<?php
session_start();

header("Content-type: text/html; charset=Shift_JIS");

// ログイン状態のチェック
if (!isset($_SESSION["account"])) {
	header("Location: login_form.php");
	exit();
}

$account = $_SESSION['account'];
echo "<p>".htmlspecialchars($account,ENT_QUOTES)."さん、こんにちは！</p>";

echo "<a href='logout.php'>ログアウトする</a>";