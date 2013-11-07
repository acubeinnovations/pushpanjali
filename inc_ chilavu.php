<?php require_once('Connections/pushpanjali.php');
 require_once('calendar/classes/tc_calendar.php'); 
 date_default_timezone_set('Asia/Calcutta');?>
<?php
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }

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
      $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
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
 $v_print=0;
  mysql_query("SET NAMES utf8");
mysql_select_db($database_pushpanjali, $pushpanjali);
$query_r_view_voucher = "SELECT * FROM voucher WHERE status='0'";
$r_view_voucher = mysql_query($query_r_view_voucher, $pushpanjali) or die(mysql_error());
$row_r_view_voucher = mysql_fetch_assoc($r_view_voucher);
$totalRows_r_view_voucher = mysql_num_rows($r_view_voucher);
function echotomysql($f_MySqlDate2){
$f_date_array = explode("-",$f_MySqlDate2); 
$f_var_day = $f_date_array[0];
$f_var_month = $f_date_array[1];
$f_var_year = $f_date_array[2];
$f_var_timestamp =$f_var_year.'-'.$f_var_month.'-'.$f_var_day ;
return($f_var_timestamp);
}
?>
<table width="838" border="0" align="right" cellpadding="0" cellspacing="0" style="border:1px solid #999999;">
          <tr>
            <td width="24" bgcolor="#F4F4F4">&nbsp;</td>
            <td width="170" height="40" bgcolor="#F4F4F4"><span class="style1"><strong>തിയതി</strong></span></td>
              <td width="191" height="40" bgcolor="#F4F4F4"><span class="style1"><strong>പേര്</strong></span></td>
              <td width="200" height="40" bgcolor="#F4F4F4"><span class="style1"><strong>ആവശ്യം</strong></span></td>
              <td width="75" height="40" bgcolor="#F4F4F4"><span class="style1"><strong>രൂപ</strong></span></td>
              <td width="49" height="40" align="center" valign="middle" bgcolor="#F4F4F4"><span class="style1"><strong>Edit</strong></span></td>
              <td width="49" height="40" align="center" valign="middle" bgcolor="#F4F4F4"><span class="style1"><strong>Delete</strong></span></td>
               <td width="55" height="40" align="center" valign="middle" bgcolor="#F4F4F4"><span class="style1"><strong>Print</strong></span></td>
          </tr>
          <?php do { ?>
            <tr class="style1">
              <td>&nbsp;</td>
              <td height="30"><?php echo echotomysql($row_r_view_voucher['voucher_date']); ?></td>
              <td width="191" height="30"><?php echo $row_r_view_voucher['name']; ?></td>
              <td width="160" height="30"><?php echo $row_r_view_voucher['purpose']; ?></td>
              <td width="138" height="30"><?php echo $row_r_view_voucher['amount']; ?></td>
              <td width="49" height="30" align="center" valign="middle"><a href="#" onclick="MM_openBrWindow('edit_voucher.php?id=<?php echo $row_r_view_voucher['id']; ?>','','width=400,height=400')"><img src="images/edit.png" width="20" border="0" /></a></td>
              <td width="49" height="30" align="center" valign="middle"><a href="delete_voucher.php?id=<?php echo $row_r_view_voucher['id']; ?>"><img src="images/delete.png" width="20" border="0" /></a></td>
               <td width="55" height="30" align="center" valign="middle"><a href="#" onclick="MM_openBrWindow('print_voucher.php?id=<?php echo $row_r_view_voucher['id']; ?>','','width=400,height=400')">print</a></td>
            </tr>
            <?php } while ($row_r_view_voucher = mysql_fetch_assoc($r_view_voucher)); ?>
          </table>