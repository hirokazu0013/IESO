<?php

session_start();



// logout1.php?logout�ɃA�N�Z�X�������[�U�[�����O�A�E�g����

if(isset($_GET['logout'])) {

	session_destroy();

	unset($_SESSION['user']);

	header("Location: index2.php");

} else {

	header("Location: index2.php");

}
?>