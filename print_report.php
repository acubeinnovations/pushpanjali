<?php require_once('Connections/pushpanjali.php'); 
set_time_limit(0);
header("Content-type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=Consolidated.Report.xls");
header("Cache-Control: cache, must-revalidate");
header("Pragma: public");
session_start();
// php code here
?>
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

if(isset($_GET['from']))
{
$v_from=$_GET['from'];
$v_to=$_GET['to'];
mysql_query("SET NAMES utf8");
if($v_from==0 && $v_to==0)
{
mysql_select_db($database_pushpanjali, $pushpanjali);
$query_r_report = "SELECT * FROM vazhipadu WHERE status='0'";
$r_report = mysql_query($query_r_report, $pushpanjali) or die(mysql_error());
$row_r_report = mysql_fetch_assoc($r_report);
$totalRows_r_report = mysql_num_rows($r_report);
}
else
{
mysql_select_db($database_pushpanjali, $pushpanjali);
$query_r_report = "SELECT * FROM vazhipadu WHERE vazhipadu_date BETWEEN '$v_from' AND '$v_to' AND status='0' ";
$r_report = mysql_query($query_r_report, $pushpanjali) or die(mysql_error());
$row_r_report = mysql_fetch_assoc($r_report);
$totalRows_r_report = mysql_num_rows($r_report);
}
}
?>

        <table width="100%" border="1" cellspacing="0">
        <tr>
          <td height="50" align="center" valign="middle"><span class="style1"><strong>Date</strong></span></td>
          <td height="50" align="center" valign="middle"><span class="style1"><strong>Name</strong></span></td>
          <td height="50" align="center" valign="middle"><span class="style1"><strong>Star</strong></span></td>
          <td height="50" align="center" valign="middle"><span class="style1"><strong>Pooja</strong></span></td>
          <td height="50" align="center" valign="middle"><span class="style1"><strong>Amount</strong></span></td>
          </tr>
        <?php do { ?>
          <tr>
            <td height="30" align="center" valign="middle"><span class="style1"><?php echo echotomysql($row_r_report['vazhipadu_date']); ?></span></td>
            <td height="30" align="center" valign="middle"><span class="style1"><?php echo $row_r_report['name']; ?></span></td>
            <td height="30" align="center" valign="middle"><span class="style1"><?php echo $row_r_report['star']; ?></span></td>
            <td height="30" align="center" valign="middle"><span class="style1"><?php echo $row_r_report['pooja']; ?></span></td>
            <td height="30" align="center" valign="middle"><span class="style1"><?php echo $row_r_report['amount']; ?></span></td>
            </tr>
          <?php } while ($row_r_report = mysql_fetch_assoc($r_report)); ?>
        </table>
        
<?php
mysql_free_result($r_report);
?>
