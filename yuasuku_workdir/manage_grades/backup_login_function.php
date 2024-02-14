<?php
session_start();

if (isset($_SESSION['login_id']) && $_SESSION['time'] + 3600 > time()) {
	//login状態
	$_SESSION['time'] = time();
} else {
	header('Location: ../login/login.php'); exit();
}
?>
