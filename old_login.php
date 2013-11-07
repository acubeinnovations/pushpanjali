<?php 
 header('Content-type: text/html; charset=utf-8');
require_once('Connections/pushpanjali.php'); 
session_start();
$un=$_POST['username'];
$ps=$_POST['password'];

if ($un=="admin" && $ps=="admin")
	{
	$_SESSION['login']='1';
	$_SESSION['user_name']=$un;
	$goto = "index.php";
	header(sprintf("Location: %s", $goto));
	}else{
		header("Location: login.php");
	}


?>
