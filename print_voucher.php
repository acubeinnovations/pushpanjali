<?php require_once('Connections/pushpanjali.php'); ?>
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

function echotomysql($f_MySqlDate2){
$f_date_array = explode("-",$f_MySqlDate2); 
$f_var_day = $f_date_array[0];
$f_var_month = $f_date_array[1];
$f_var_year = $f_date_array[2];
$f_var_timestamp =$f_var_year.'-'.$f_var_month.'-'.$f_var_day ;
return($f_var_timestamp);
}
mysql_select_db($database_pushpanjali, $pushpanjali);
$query_r_view_voucher = "SELECT * FROM voucher WHERE id='".$_GET['id']."'";
$r_view_voucher = mysql_query($query_r_view_voucher, $pushpanjali) or die(mysql_error());
$row_r_view_voucher = mysql_fetch_assoc($r_view_voucher);
$totalRows_r_view_voucher = mysql_num_rows($r_view_voucher);
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<style type="text/css">
<!--
.style3 {font-size: 14px; font-family: Arial, Helvetica, sans-serif; }
-->
</style>
</head>

<body  onLoad="window.print();">
<p>&nbsp;</p>
<p><br />
  <br />
</p>
<table width="80%" border="1" align="center" cellspacing="0">
  <tr>
    <td><span class="style3">തിയതി</span></td>
    <td><span class="style3"><?php echo echotomysql($row_r_view_voucher['voucher_date']);  ?></span></td>
  </tr>
 
    <tr>
      <td><span class="style3">പേര്</span></td>
      <td><span class="style3"><?php echo $row_r_view_voucher['name']; ?></span></td>
  </tr>
    <tr>
      <td><span class="style3">വിലാസം</span></td>
      <td><span class="style3"><?php echo $row_r_view_voucher['address']; ?></span></td>
  </tr>
    <tr>
      <td><span class="style3">ആവശ്യം</span></td>
      <td><span class="style3"><?php echo $row_r_view_voucher['purpose']; ?></span></td>
  </tr>
    <tr>
      <td><span class="style3">രൂപ</span></td>
      <td><span class="style3"><?php echo $row_r_view_voucher['amount']; ?></span></td>
  </tr>
</table>
</body>
</html>
<?php
mysql_free_result($r_view_voucher);
?>
