<?php
if(!$_SESSION['email']) {
	header('Location: login/index.php');
	exit();
}