<?php require_once('Connections/pushpanjali.php'); 
require_once('calendar/classes/tc_calendar.php');?>
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

mysql_query("SET NAMES utf8");
mysql_select_db($database_pushpanjali, $pushpanjali);
$query_r_report = "SELECT * FROM vazhipadu WHERE vazhipadu_date BETWEEN '$v_from' AND '$v_to' AND status='0' ";
$r_report = mysql_query($query_r_report, $pushpanjali) or die(mysql_error());
$row_r_report = mysql_fetch_assoc($r_report);
$totalRows_r_report = mysql_num_rows($r_report);

function echotomysql($f_MySqlDate2){
$f_date_array = explode("-",$f_MySqlDate2); 
$f_var_day = $f_date_array[0];
$f_var_month = $f_date_array[1];
$f_var_year = $f_date_array[2];
$f_var_timestamp =$f_var_year.'-'.$f_var_month.'-'.$f_var_day ;
return($f_var_timestamp);
}
?>
<?php if ($totalRows_r_report > 0) { // Show if recordset not empty ?>
             <table width="100%" border="0" cellpadding="0" cellspacing="0" style="border:1px solid #999999;">
               <tr>
                 <td height="50" align="center" valign="middle"><span class="style3"><strong>Date</strong></span></td>
                <td height="50" align="center" valign="middle"><span class="style3"><strong>Name</strong></span></td>
                <td height="50" align="center" valign="middle"><span class="style3"><strong>Pooja</strong></span></td>
                <td height="50" align="center" valign="middle"><span class="style3"><strong>Star</strong></span></td>
                <td height="50" align="center" valign="middle"><span class="style3"><strong>Amount</strong></span></td>
                <td align="center" valign="middle"><span class="style3"><strong>Edit</strong></span></td>
                <td align="center" valign="middle"><span class="style3"><strong>Delete</strong></span></td>
              </tr>
               <?php do { ?>
                 <tr>
                   <td height="30" align="center" valign="middle"><span class="style3"><?php echo echotomysql($row_r_report['vazhipadu_date']); 
 ?></span></td>
                   <td height="30" align="center" valign="middle"><span class="style1"><?php echo $row_r_report['name']; ?></span></td>
                   <td height="30" align="center" valign="middle"><span class="style1"><?php $v_pooja_id=$row_r_report['pooja'];
				   include('inc_pooja.php'); echo $v_pooja_name; ?></span></td>
                   <td height="30" align="center" valign="middle"><span class="style1"><?php $v_star=$row_r_report['star'];
				  include('star_name.php'); echo $v_starname; ?></span></td>
                   <td height="30" align="center" valign="middle"><span class="style1"><?php echo $row_r_report['amount']; ?></span></td>
                   <td height="30" align="center" valign="middle"><a href="#" onclick="MM_openBrWindow('edit_report.php?id=<?php echo $row_r_report['id']; ?>','','width=400,height=400')"><img src="images/edit.png" width="20" border="0" /></a></td>
                   <td height="30" align="center" valign="middle"><a href="delete_report.php?id=<?php echo $row_r_report['id']; ?>"><img src="images/delete.png" width="20" border="0" /></a></td>
                 </tr>
                 <?php } while ($row_r_report = mysql_fetch_assoc($r_report)); ?>
                </table>
             <?php } // Show if recordset not empty ?>