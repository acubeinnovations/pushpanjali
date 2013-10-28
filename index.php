<?php require_once('Connections/pushpanjali.php'); 
$msg="";
if(isset($_POST['username']) && isset($_POST['password'])){
$un=$_POST['username'];
$ps=$_POST['password'];

if ($un=="admin" && $ps=="admin")
	{ 
	header("Location: home.php");
	exit();
	}elseif ($un=="user" && $ps=="user")
	{
	header("Location: user.php");
	exit();
	}else{
	$msg = "Username / Password is Incorrect";
		//header("Location: login.php");
	}

}
?>

<html> 
<head> 
<style>
body{
 font-family:Arial, Helvetica, sans-serif;
}
.style1 {
	font-size: 18px;
	color: #ed1b24;
	font-weight: bold;
}
.style2 {
	color: #FF0000;
	font-size: 12px;
}
</style>
</head>
<body>
<form name="form1" method="post" action="">
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="38%" rowspan="4" align="center"><img src="images/logo.png"></td>
    <td height="100" colspan="4" align="left"><span class="style1">Puthankavu (Charaparambu) Devi Temple</span></td>
    </tr>
  
  <tr>
    <td width="6%">&nbsp;</td>
    <td width="15%" height="50">User name:</td>
    <td width="41%" height="50" colspan="2"><input type="text" name="username"></td>
    </tr>
  <tr>
    <td>&nbsp;</td>
    <td height="50">Password:</td>
    <td height="50" colspan="2"><input type="password" name="password"></td>
    </tr>
  <tr>
    <td height="30" colspan="4" align="center" valign="top"><input type="submit" name="Login" value="Login"></td>
    </tr>
  <tr>
    <td align="center">&nbsp;</td>
    <td height="30" colspan="4" align="center" valign="top"><span class="style2"><?php echo $msg; ?></span></td>
  </tr>

</table>
</form>

</body>
</html>