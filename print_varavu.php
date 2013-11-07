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

mysql_select_db($database_pushpanjali, $pushpanjali);
$query_r_view_varavu = "SELECT * FROM vazhipadu WHERE receipt_number='".$_GET['r_no']."'";
$r_view_varavu = mysql_query($query_r_view_varavu, $pushpanjali) or die(mysql_error());
$row_r_view_varavu = mysql_fetch_assoc($r_view_varavu);
$totalRows_r_view_varavu = mysql_num_rows($r_view_varavu);

function echotomysql($f_MySqlDate2){
$f_date_array = explode("-",$f_MySqlDate2); 
$f_var_day = $f_date_array[0];
$f_var_month = $f_date_array[1];
$f_var_year = $f_date_array[2];
$f_var_timestamp =$f_var_year.'-'.$f_var_month.'-'.$f_var_day ;
return($f_var_timestamp);
}
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<style type="text/css">
<!--
.style1 {
	font-size: 14px;
	font-weight: bold;
}
.style2 {font-size: 14px}
.style4 {font-size: 12px}
-->
</style>
</head>

<body onLoad="window.print();">

<table width="680" border="0" align="left" cellpadding="0" cellspacing="0" style="border:1px solid #999999;">
      <tr>
        <td align="left">&nbsp;</td>
        <td height="40" align="left"><span class="style1"><strong>പൂജ : <?php $v_pooja_id=$row_r_view_varavu['pooja']; include('inc_pooja.php'); echo $v_pooja_name; ?></strong></span></td>
        <td height="40" colspan="4" align="right"><span class="style1">തീയതി :<?php echo echotomysql($row_r_view_varavu['vazhipadu_date']); ?> 
                  
        </span></td>
    </tr>
      <tr>
        <td width="12" align="left" bgcolor="#F4F4F4">&nbsp;</td>
        <td width="227" height="40" align="left" bgcolor="#F4F4F4"><span class="style1"><strong>പേര്</strong></span></td>
        <td width="151" height="40" align="center" valign="middle" bgcolor="#F4F4F4"><span class="style1"><strong>നക്ഷത്രം </strong></span></td>
        <td width="153" align="center" valign="middle" bgcolor="#F4F4F4"><span class="style1 style6 style11"><strong>രൂപ</strong></span></td>
        <td width="77" align="center" valign="middle" bgcolor="#F4F4F4"><span class="style1">എണ്ണം</span></td>
        <td width="78" align="center" valign="middle" bgcolor="#F4F4F4"><span class="style1">അകെ</span></td>
      </tr>
       <?php do { ?> 
      <tr>
        <td align="left">&nbsp;</td>
        <td height="40" align="left"><?php echo $row_r_view_varavu['name']; ?></td>
        <td width="151" height="40" align="center" valign="middle"><?php $v_star=$row_r_view_varavu['star']; include('star_name.php'); echo $v_starname;?></td>
        <td width="153" align="center" valign="middle"><?php echo $row_r_view_varavu['amount']; ?></td>
        <td align="center" valign="middle"><?php echo $row_r_view_varavu['quantity']; ?></td>
        <td align="center" valign="middle"><?php echo $v_amt[]=$row_r_view_varavu['quantity']*$row_r_view_varavu['amount'];?></td>
      </tr><?php } while ($row_r_view_varavu = mysql_fetch_assoc($r_view_varavu)); ?>

      <tr>
        <td align="left" bgcolor="#F4F4F4">&nbsp;</td>
        <td height="40" align="left" bgcolor="#F4F4F4">&nbsp;</td>
        <td height="40" bgcolor="#F4F4F4" class="style1"><strong>Total</strong></td>
        <td colspan="2" align="center" valign="middle" bgcolor="#F4F4F4">&nbsp;</td>
        <td align="center" valign="middle" bgcolor="#F4F4F4"><?php echo array_sum($v_amt); ?></td>
      </tr>
    </table>
</body>
</html>
<?php
mysql_free_result($r_view_varavu);
?>
