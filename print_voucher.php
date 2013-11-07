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
<style type="text/css">
.letter {
font-family:"kartika";
font-size:8px;
letter-spacing:2px;
line-height:20px;
}
@font-face
{
font-family: "kartika";
src: url('fonts/kartika.ttf');
}
.english
{
font-family:"Arial";
font-size:6px;
letter-spacing:2px;
line-height:20px;
}
	</style>
  
  
  <table width="500" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td width="275" height="110">&nbsp;</td>
    <td width="125">&nbsp;</td>
    <td width="100">&nbsp;</td>
  </tr>
  <tr>
    <td width="275" height="65" align="left" valign="middle" class="letter">
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Voucher </br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;	
	<?php $v_vou_id=$row_r_view_voucher['purpose']; include('inc_voucher.php');  echo $v_voucher_name;  ?>        </td>
    <td width="125" height="65">&nbsp;</td>
    <td width="100" height="65" class="letter"><?php echo echotomysql($row_r_view_voucher['voucher_date']);?><br />
<br />
<?php echo $row_r_view_voucher['id']; ?></td>
  </tr>
  <tr>
    <td height="120" colspan="3" align="left" valign="middle">
    <table width="500" border="0" cellpadding="0" cellspacing="0">
    <tr>
    <td width="300" height="25" align="left" valign="middle" class="letter">
	<?php echo $row_r_view_voucher['name']; ?><br />
    <?php echo $row_r_view_voucher['address']; ?><br />
	<?php echo $row_r_view_voucher['description'];?>
</td>
    <td width="100" height="25" align="middle" valign="top" class="letter">
     <?php  echo $row_r_view_voucher['amount']; ?>
    </td>
  </tr>
</table>
	</td>
  </tr>

  <tr>
    <td height="60">&nbsp;</td>
    <td height="60">&nbsp;</td>
    <td height="60" align="middle" valign="bottom" class="letter"><?php  echo $row_r_view_voucher['amount']; ?></td>
  </tr>
 
</table>
</body>
</html>
<?php
mysql_free_result($r_view_voucher);
?>
