<?php
	session_start();
	unset($_SESSION["qwerty"]);

	header("Location: login.php");

?>