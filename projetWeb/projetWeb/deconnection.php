<?php
	session_start();
	unset($_SESSION["login"]);
	session_destroy();
	include("identification.php");
?>