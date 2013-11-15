<?php require_once('Connections/pushpanjali.php');
 require_once('calendar/classes/tc_calendar.php'); 
 date_default_timezone_set('Asia/Calcutta');
 
 header("Content-type: application/vnd.ms-excel");
	header("Content-Disposition: attachment; filename=daily_expense_report.xls");
	header("Cache-Control: cache, must-revalidate");
	header("Pragma: public"); 
 
 ?>
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
if(isset($_GET["date"]) && trim($_GET["date"])!=""){
	$v_date = $_GET['date'];
}else{
	$v_date = date("Y-m-d");
	
}
  mysql_query("SET NAMES utf8");
mysql_select_db($database_pushpanjali, $pushpanjali);
$query_r_view_voucher = "SELECT * FROM voucher WHERE voucher_date='$v_date'";
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


ob_start();

$v_amt=array();

?>
      <table width="833" border="0" align="right" cellpadding="0" cellspacing="0" style="border:1px solid #999999;">
          <tr>
            <td width="54" height="30" class="style1" style="border-bottom:1px solid #999999;">No</td>
            <td width="100" height="30" style="border-bottom:1px solid #999999;"><span class="style1"><strong>Date</strong></span></td>
              <td width="170" height="30" style="border-bottom:1px solid #999999;"><span class="style1"><strong>Name</strong></span></td>
              <td width="300" height="30" style="border-bottom:1px solid #999999;"><span class="style1"><strong>Purpose</strong></span></td>
              <td width="90" height="30" style="border-bottom:1px solid #999999;"><span class="style1"><strong>Amount</strong></span></td>
              <td width="90" height="30" style="border-bottom:1px solid #999999;"><span class="style1"><strong>Status</strong></span></td>
          </tr>
          <?php do { ?>
            <tr>
              <td height="30" class="style1" style="border-bottom:1px solid #999999;"><?php echo $row_r_view_voucher['id']; ?></td>
              <td width="100" height="30" style="border-bottom:1px solid #999999;"><span class="style1"><?php echo echotomysql($row_r_view_voucher['voucher_date']); ?></span></td>
              <td width="200" height="30" style="border-bottom:1px solid #999999;"><span class="style1"><?php echo $row_r_view_voucher['name']; ?></span></td>
              <td width="300" height="30" style="border-bottom:1px solid #999999;"><span class="style1">
			  <?php $v_vou=$row_r_view_voucher['purpose']; include('vou_head.php'); ?></span></td>
              <td width="90" height="30" style="border-bottom:1px solid #999999;"><span class="style1">
			  <?php if($row_r_view_voucher['status']==1) { echo $row_r_view_voucher['amount']; } else {?>
			  <?php  $v_amt[]=$row_r_view_voucher['amount']; echo $row_r_view_voucher['amount']; }?></span></td>
              <td width="90" height="30" style="border-bottom:1px solid #999999;"><span class="style1">
              <?php if($row_r_view_voucher['status']==1) { echo "cancelled"; } else {?>&nbsp;
			  <?php   }?>
              </span></td>
            </tr> <?php } while ($row_r_view_voucher = mysql_fetch_assoc($r_view_voucher)); ?>
            <tr bgcolor="#F0C6C6">
              <td height="30" >&nbsp;</td>
              <td height="30" class="style1"><strong>Total</strong></td>
              <td height="30">&nbsp;</td>
              <td height="30">&nbsp;</td>
              <td width="90" height="30" class="style1"><strong><?php echo array_sum($v_amt); ?></strong></td>
              <td width="90" height="30" style="border-bottom:1px solid #999999;"><span class="style1"><strong>Amount</strong></span></td>
            </tr>
           
          </table>
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
    <td height="400" align="left" valign="top">
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
  		<tr>
   		  <td height="600" align="left" valign="top">
   			<table width="100%" border="0" cellspacing="0" cellpadding="0">
			  <tr>
          				<td height="60" colspan="7" align="left" valign="middle">
                        <h1 class="pus noprint">പുത്തന്‍കാവ് ചാരപറമ്പ്‌ ഭഗവതി ക്ഷേത്രം</h1>
            			</td> 
   			  </tr>

  <tr>
    <td align="left" valign="middle">
	<?php if($totalRows_r_view_voucher>0) { ?>
    <div class="overflow_scroll" style="height:400px; width:858px" id="report_div" >
      <?php echo $report; ?>
    </div>
      <?php } ?>
      
     </td>
  </tr>  
</table>
      </td>
    </tr>
</table></td>
  </tr>
</table>
