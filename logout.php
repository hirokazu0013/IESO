<?php

session_start();



// logout.php?logout�ɃA�N�Z�X�������[�U�[�����O�A�E�g����

if(isset($_GET['logout'])) {

	session_destroy();

	unset($_SESSION['user']);

	header("Location: index.php");

} else {

	header("Location: index.php");

}
?>