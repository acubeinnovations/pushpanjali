<?php require_once('Connections/pushpanjali.php'); 
set_time_limit(0);
header("Content-type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=Consolidated.Report.xls");
header("Cache-Control: cache, must-revalidate");
header("Pragma: public");
session_start();
// php code here
?>
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
if(isset($_GET['from']))
{
$v_from=$_GET['from'];
$v_to=$_GET['to'];
}

mysql_query("SET NAMES utf8");
mysql_select_db($database_pushpanjali, $pushpanjali);
$query_r_report = "SELECT DISTINCT pooja FROM vazhipadu WHERE vazhipadu_date BETWEEN '$v_from' AND '$v_to' AND status='0' ";
$r_report = mysql_query($query_r_report, $pushpanjali) or die(mysql_error());
$row_r_report = mysql_fetch_assoc($r_report);
$totalRows_r_report = mysql_num_rows($r_report);

?>

         
           <?php if ($totalRows_r_report > 0) { // Show if recordset not empty ?>
             <table width="100%" border="1" cellspacing="0">
               <tr>
                 <td width="39%" height="50" align="center" valign="middle"><strong>പൂജ</strong></td>
                <td width="11%" height="50" align="center" valign="middle"><strong>തുക</strong></td>
                <td width="10%" height="50" align="center" valign="middle"><strong>ഏണ്ണം</strong></td>
                <td width="13%" height="50" align="center" valign="middle"><strong>ആകെ തുക</strong></td>
                <td width="16%" height="50" align="center" valign="middle"><strong>ഭോഗം മേല്‍ശാന്തി</strong></td>
                <td width="11%" align="center" valign="middle"><strong>ഭോഗം കഴകം</strong></td>
              </tr>
               <?php do { ?>
               <tr>
                <td height="50" ><?php echo $row_r_report['pooja'];				
					mysql_select_db($database_pushpanjali, $pushpanjali);
					$query_r_view_pooja = "SELECT pooja.rate, pooja.bhogam_melsanthi, pooja.bhogam_kazakam,COUNT(vazhipadu.pooja) FROM pooja,vazhipadu WHERE pooja.pooja='".$row_r_report['pooja']."' AND vazhipadu.pooja='".$row_r_report['pooja']."' AND vazhipadu.vazhipadu_date BETWEEN '$v_from' AND '$v_to' AND vazhipadu.status='0' ";
					$r_view_pooja = mysql_query($query_r_view_pooja, $pushpanjali) or die(mysql_error());
					$row_r_view_pooja = mysql_fetch_assoc($r_view_pooja);
					$totalRows_r_view_pooja = mysql_num_rows($r_view_pooja);

				 ?></td>
               <td height="50" ><?php echo $v_pooja_rate[]=$row_r_view_pooja['rate']; ?></td>
                <td height="50" ><?php echo $v_count[]=$row_r_view_pooja['COUNT(vazhipadu.pooja)']; ?></td>
                <td height="50" ><?php echo $v_total_amt[]=$row_r_view_pooja['rate']*$row_r_view_pooja['COUNT(vazhipadu.pooja)'];?></td>
                <td height="50" ><?php echo $v_mel_bhogam[]= $row_r_view_pooja['COUNT(vazhipadu.pooja)']*$row_r_view_pooja['bhogam_melsanthi']?></td>
                <td height="50" ><?php echo $v_bhogam_kazhakam[]=$row_r_view_pooja['COUNT(vazhipadu.pooja)']*$row_r_view_pooja['bhogam_kazakam']; ?></td>
              </tr>
              <?php } while ($row_r_report = mysql_fetch_assoc($r_report)); ?>
            
              <tr>
                <td height="50" align="right" ><strong>ആകെ </strong></td>
                <td height="50" >&nbsp;</td>
                <td height="50" ><?php echo array_sum($v_count); ?></td>
                <td height="50" ><?php echo array_sum($v_total_amt); ?></td>
                <td height="50" ><?php echo array_sum($v_mel_bhogam); ?></td>
                <td height="50" ><?php echo array_sum($v_bhogam_kazhakam); ?></td>
              </tr> <?php } // Show if recordset not empty ?>
               </table>

       
<?php
mysql_free_result($r_report);

mysql_free_result($r_view_pooja);
?>
