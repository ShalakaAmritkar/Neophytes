<?php 
    require("config.php"); 
    unset($_SESSION['id']);
	header("Location: home.php"); 
    die("Redirecting to: home.php");
?>