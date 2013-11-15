<?php 
 header('Content-type: text/html; charset=utf-8');
 require_once('Connections/pushpanjali.php'); 
require_once('calendar/classes/tc_calendar.php');?>
<?php

 header("Content-type: application/vnd.ms-excel");
	header("Content-Disposition: attachment; filename=monthly_income_report.xls");
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
if(isset($_POST["from_date"]) && trim($_POST["from_date"])!=""){
	$v_from = $_POST['from_date'];
}else{
	$v_from = date("Y-m-1");
	
}


if(isset($_POST["to_date"]) &&  trim($_POST["to_date"])!=""){
	$v_to = $_POST['to_date'];
}else{
	$v_to = date("Y-m-d");	
} 


mysql_query("SET NAMES utf8");
mysql_select_db($database_pushpanjali, $pushpanjali);
$query_r_report = "SELECT pooja, SUM(quantity), SUM(amount*quantity) FROM vazhipadu WHERE vazhipadu_date BETWEEN '$v_from' AND '$v_to' AND status='0' GROUP BY pooja ";
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

$v_amts=array();
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
        <?php if ($totalRows_r_report > 0) { // Show if recordset not empty ?>
          <table width="838" border="0" cellpadding="0" cellspacing="0" style="border:1px solid #999999;">
            <tr>
              <td height="50" colspan="6" align="center" valign="middle" style="border-bottom:1px solid #999999;">വരവ്  :  <?php echo date("d/m/Y",strtotime($v_from))." to ".date("d/m/Y",strtotime($v_to)); ?></td>
              </tr>
            <tr class="style1">
              <td height="30" align="left" valign="middle" style="border-bottom:1px solid #999999;">&nbsp;&nbsp;&nbsp;&nbsp;<strong>Pooja</strong></td>
              <td width="100" height="30" align="left" valign="middle" style="border-bottom:1px solid #999999;"><strong><span class="style3">Quantity</span></strong></td>
              <td width="100" height="30" align="left" valign="middle" style="border-bottom:1px solid #999999;"><strong><span class="style3">Unit Rate</span></strong></td>
              <td width="100" align="left" valign="middle" style="border-bottom:1px solid #999999;"><strong>Total Amount</strong></td>
              <td width="100" align="left" valign="middle" style="border-bottom:1px solid #999999;"><strong>Bhogam Melsanthi</strong></td>
              <td width="100" align="left" valign="middle" style="border-bottom:1px solid #999999;"><strong>Bhogam Kayakam</strong></td>
              </tr>
            <?php 
					$total_amount = 0;
					$total_amount_bhogam = 0;
					$total_amount_kazakam = 0;
				 do { ?>
              <tr>
                <td height="30" align="left" valign="middle" style="border-bottom:1px solid #999999;">&nbsp;&nbsp;
                  <span class="style1">
                    <?php $v_pooja_id=$row_r_report['pooja'];
				   include('inc_pooja.php'); echo $v_pooja_name; ?>
                    </span></td>
                <td width="100" height="30" align="left" valign="middle" style="border-bottom:1px solid #999999;" class="style1"><?php echo $row_r_report['SUM(quantity)']; ?></td>
                <td width="100" height="30" align="left" style="border-bottom:1px solid #999999;" valign="middle" class="style1"><?php echo $v_pooja_rate; ?>&nbsp;</td>
                <td width="100" align="left" valign="middle" style="border-bottom:1px solid #999999;" class="style1"><?php echo $row_r_report['SUM(amount*quantity)']; $total_amount = $total_amount + $row_r_report['SUM(amount*quantity)']; ?></td>
                <td width="100" align="left" valign="middle" style="border-bottom:1px solid #999999;" class="style1"><?php echo $v_pooja_bhogam_melsanthi*$row_r_report['SUM(quantity)']; $total_amount_bhogam = $total_amount_bhogam +($v_pooja_bhogam_melsanthi*$row_r_report['SUM(quantity)']) ;?></td>
                <td width="100" align="left" valign="middle" style="border-bottom:1px solid #999999;" class="style1"><?php echo $v_pooja_bhogam_kazakam*$row_r_report['SUM(quantity)']; $total_amount_kazakam = $total_amount_kazakam + ($v_pooja_bhogam_kazakam*$row_r_report['SUM(quantity)']); ?></td>
                </tr>
              <?php } while ($row_r_report = mysql_fetch_assoc($r_report)); ?>
			  <tr>
                <td height="30" align="left" valign="middle" style="border-bottom:1px solid #999999;" class="style1">&nbsp;&nbsp;&nbsp; Total </td>
                <td width="100" height="30" align="left" valign="middle" style="border-bottom:1px solid #999999;" class="style1">&nbsp;</td>
                <td width="100" height="30" align="left" style="border-bottom:1px solid #999999;" valign="middle" class="style1">&nbsp;</td>
                <td width="100" align="left" valign="middle" style="border-bottom:1px solid #999999;" class="style1"><?php echo $total_amount; ?></td>
                <td width="100" align="left" valign="middle" style="border-bottom:1px solid #999999;" class="style1"><?php echo $total_amount_bhogam; ?></td>
                <td width="100" align="left" valign="middle" style="border-bottom:1px solid #999999;" class="style1"><?php echo $total_amount_kazakam; ?></td>
                </tr>
            </table>
          <?php } // Show if recordset not empty ?>
        </div>
      
      </td>
  </tr>  
</table>