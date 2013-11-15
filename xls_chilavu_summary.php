<?php 
 header('Content-type: text/html; charset=utf-8');
 require_once('Connections/pushpanjali.php'); 
require_once('calendar/classes/tc_calendar.php');?>
<?php

 header("Content-type: application/vnd.ms-excel");
	header("Content-Disposition: attachment; filename=monthly_expense_report.xls");
	header("Cache-Control: cache, must-revalidate");
	header("Pragma: public"); 

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
if(isset($_REQUEST["from_date"]) && trim($_REQUEST["from_date"])!=""){
	$v_from = $_REQUEST['from_date'];
}else{
	$v_from = date("Y-m-1");
	
}


if(isset($_REQUEST["to_date"]) &&  trim($_REQUEST["to_date"])!=""){
	$v_to = $_REQUEST['to_date'];
}else{
	$v_to = date("Y-m-d");	
}
  mysql_query("SET NAMES utf8");
mysql_select_db($database_pushpanjali, $pushpanjali);
$query_r_view_voucher = "SELECT purpose, SUM(amount) FROM voucher WHERE voucher_date BETWEEN '$v_from' AND '$v_to' AND status='0' GROUP BY purpose";
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
      
<?php

$report = ob_get_contents();
ob_end_clean();
?>
<style type="text/css">
<!--
.pus {
	color: #C00;
}
-->
</style>




<style type="text/css">
<!--
.style8 {font-size: 14px}
.style9 {color: #585858}
-->
</style>
   			<table width="100%" border="0" cellspacing="0" cellpadding="0">
			  <tr>
          				<td height="60" colspan="7" align="center" valign="middle">
                        <h1 class="pus noprint">പുത്തന്‍കാവ് ചാരപറമ്പ്‌ ഭഗവതി ക്ഷേത്രം</h1>
            			</td> 
   			  </tr>
  <tr>
    <td align="right" valign="middle">
      <div class="overflow_scroll" style="height:400px; width:858px" id="report_div" >
      <table width="833" border="0" align="right" cellpadding="0" cellspacing="0" style="border:1px solid #999999;">
          <tr>
            <td width="35" height="30" style="border-bottom:1px solid #999999;">&nbsp;</td>
            <td width="513" height="30" style="border-bottom:1px solid #999999;"><span class="style1"><strong>Purpose</strong></span></td>
              <td width="117" height="30" style="border-bottom:1px solid #999999;"><span class="style1"><strong>Amount</strong></span></td>
              <td width="57" height="30" align="center" valign="middle" style="border-bottom:1px solid #999999;">&nbsp;</td>
              <td width="59" height="30" align="center" valign="middle" style="border-bottom:1px solid #999999;">&nbsp;</td>
              <td width="50" height="30" align="center" valign="middle" style="border-bottom:1px solid #999999;"><span class="style1"><strong><!--Print--></strong></span></td>
          </tr>
          <?php do { ?>
            <tr>
              <td height="30" style="border-bottom:1px solid #999999;">&nbsp;</td>
              <td width="513" height="30" style="border-bottom:1px solid #999999;"><span class="style1">
                <?php $v_vou=$row_r_view_voucher['purpose']; include('vou_head.php'); ?></span></td>
              <td width="117" height="30" style="border-bottom:1px solid #999999;"><span class="style1"><?php echo $v_amt[]=$row_r_view_voucher['SUM(amount)']; ?></span></td>
              <td width="57" height="30" align="center" valign="middle" style="border-bottom:1px solid #999999;">&nbsp;</td>
              <td width="59" height="30" align="center" valign="middle" style="border-bottom:1px solid #999999;">&nbsp;</td>
              <td width="50" height="30" align="center" valign="middle" style="border-bottom:1px solid #999999;">&nbsp;
                </td>
            </tr> <?php } while ($row_r_view_voucher = mysql_fetch_assoc($r_view_voucher)); ?>
            <tr bgcolor="#F0C6C6">
              <td height="30" >&nbsp;</td>
              <td height="30" class="style1">Total</td>
              <td width="117" height="30" class="style1"><strong><?php echo array_sum($v_amt); ?></strong></td>
              <td height="30" align="center" valign="middle">&nbsp;</td>
              <td height="30" align="center" valign="middle">&nbsp;</td>
              <td height="30" align="center" valign="middle">&nbsp;</td>
            </tr>
           
          </table>
    </div>
      
      </td>
  </tr>  
</table>