<?php 
 header('Content-type: text/html; charset=utf-8');
require_once('Connections/pushpanjali.php'); ?>
<?php
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;

  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? "'" . doubleval($theValue) . "'" : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
}

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

 if(isset($_POST['submit'])&& $_POST['star']!="") {
 mysql_query("SET NAMES utf8");

	 $insertSQL = sprintf("INSERT INTO star (starname) VALUES (%s)",
                       GetSQLValueString($_POST['star'], "text"));

  mysql_select_db($database_pushpanjali, $pushpanjali);
  $Result1 = mysql_query($insertSQL, $pushpanjali) or die(mysql_error());
   } 
   mysql_query("SET NAMES utf8");
   
mysql_select_db($database_pushpanjali, $pushpanjali);
$query_r_view_star = "SELECT * FROM star";
$r_view_star = mysql_query($query_r_view_star, $pushpanjali) or die(mysql_error());
$row_r_view_star = mysql_fetch_assoc($r_view_star);
$totalRows_r_view_star = mysql_num_rows($r_view_star);
 ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<style type="text/css">
<!--
.pus {
	color: #C00;
}
-->
</style>
<title>Puthenkavu Kshetram</title>
<link href="*.css" rel="stylesheet" type="text/css" />
<link href="style.css" rel="stylesheet" type="text/css" />
<script type="text/javascript">
<!--
function MM_openBrWindow(theURL,winName,features) { //v2.0
  window.open(theURL,winName,features);
}
//-->
function validateForm()
{
if(document.getElementById("star").value=="")
              {
			  //alert('hai');
                document.getElementById("d_star").innerHTML="Enter star !";
                document.getElementById("star").focus();
                return false;
              }
			  else
			  {
			  	document.getElementById("d_star").innerHTML="";	
			  }
}
</script>

</head>

<body marginheight="0" marginwidth="0" topmargin="0" bottommargin="0" rightmargin="0" leftmargin="0">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td height="53" align="left" valign="top" background="images/bg.PNG"><table width="851" border="0" align="left" cellpadding="0" cellspacing="1">
       <tr class="menu">
        <td width="81" height="41" align="center" valign="middle"><a href="home.php" class="menu">Home</a></td>
        <td width="82" height="41" align="center" valign="middle"><a href="star.php" class="menu_active">Star</a></td>
        <td width="83" height="41" align="center" valign="middle"><a href="pooja.php" class="menu">Pooja</a></td>
        <td width="93" height="41" align="center" valign="middle"><a href="vazhipadu.php" class="menu">Vazhipadu</a></td>
        <td width="91" height="41" align="center" valign="middle"><a href="voucher.php" class="menu">Vouchers</a></td>
        <td width="75" height="41" align="center" valign="middle"><a href="report_sumup.php" class="menu">Report</a></td>
        <td width="124" height="41" align="center" valign="middle"><a href="logout.php" class="menu">Logout</a></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td height="400" align="left" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="70%" height="600" align="left" valign="top"><form id="form1" name="form1" method="post" action="star.php">
      <table width="855" border="0" align="right" cellpadding="0" cellspacing="0">
       <tr>
          <td height="60" colspan="6" align="center" valign="middle"><h1 class="pus">പുത്തന്‍കാവ് ചാരംപറമ്പ്‌ ഭഗവതി ക്ഷേത്രം</h1>            </td>
        </tr>
       <tr>
          <td width="20%" height="50" align="right" style="border:1px solid #999999;"><span class="style1">നക്ഷത്രം</span> &nbsp;&nbsp;&nbsp;</td>
          <td height="50" colspan="3" align="center" valign="middle" style="border:1px solid #999999;">
            <input name="star" type="text" id="star" size="32" />            <span id="d_star" class="error"></span></td>
          <td width="20%" height="50" align="left" valign="middle" style="border:1px solid #999999;">
&nbsp;&nbsp;&nbsp;
<input name="submit" type="submit" class="style1" id="button"  onclick="return validateForm();" value="  Submit  "  />
          </td>
        </tr>
       <tr>
         <td height="50" colspan="5" align="right">
         <div style="overflow:scroll; height:400px;" id="report_div">
    <?php if ($totalRows_r_view_star > 0) { // Show if recordset not empty ?>
      <table width="855" border="0" align="right" cellpadding="0" cellspacing="0" style="border:1px solid #999999;">
        <tr class="style1">
          <td width="50" height="35" bgcolor="#F5F5F5">&nbsp;</td>
              <td width="240" height="35" bgcolor="#F5F5F5"><strong><span class="style4">നക്ഷത്രം</span></strong></td>
              <td width="60" align="center" bgcolor="#F5F5F5"><strong><span class="style4">Edit</span></strong></td>
              <td width="60" align="center" bgcolor="#F5F5F5"><strong><span class="style4">Delete</span></strong></td>
          </tr>
        <?php do { ?>
          <tr class="style1">
            <td width="50" height="30" align="center" valign="middle"  style="border-top:1px solid #999999;"><span class="style1"><?php echo $row_r_view_star['id']; ?></span></td>
            <td width="200" height="25" align="left" valign="middle"  style="border-top:1px solid #999999;"><span class="style1"><?php echo $row_r_view_star['starname']; ?></span></td>
            <td width="60" height="25" align="center" valign="middle"  style="border-top:1px solid #999999;"><a href="#" onclick="MM_openBrWindow('edit_star.php?id=<?php echo $row_r_view_star['id']; ?>','','width=450,height=300')"><img src="images/edit.png" width="20" border="0" /></a></td>
            <td width="60" height="25" align="center" valign="middle"  style="border-top:1px solid #999999;"><a href="delete_star.php?id=<?php echo $row_r_view_star['id']; ?>"><img src="images/delete.png" width="20" border="0" /></a></td>
          </tr>
          <?php } while ($row_r_view_star = mysql_fetch_assoc($r_view_star)); ?>
      </table>
      <br />
      <br />
<?php } // Show if recordset not empty ?><div>  
         </td>
         </tr>
      </table>
    </form>
    
</td>
    <td width="30%" align="center" valign="top" bgcolor="#FFFFFF">
        </td>
  </tr>
</table></td>
  </tr>
</table>
<div align="center" style="display: block; position:absolute; text-align:center; bottom: 0; width: 100.00%; color: #CCC; clear: both; height:40px; background-repeat: repeat-x; border-right-width: 100px;  background-color:#333333; filter:alpha(opacity=75); opacity:0.90;"><br />
<span class="footer">All rights reserved. ® Acube Innovations Pvt Ltd. Phone: 0484 6066060.  Copyright © 2013. </span></div>
</body>
</html>
<?php
mysql_free_result($r_view_star);
?>