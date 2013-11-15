<?php 
 header('Content-type: text/html; charset=utf-8');
 require_once('Connections/pushpanjali.php'); 
require_once('calendar/classes/tc_calendar.php');


header("Content-type: application/vnd.ms-excel");
	header("Content-Disposition: attachment; filename=daily_varuvu.xls");
	header("Cache-Control: cache, must-revalidate");
	header("Pragma: public"); 

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
if(isset($_GET["date"]) && trim($_GET["date"])!=""){
	$v_date = $_GET['date'];
}else{
	$v_date = date("Y-m-d");
	
}


mysql_query("SET NAMES utf8");
mysql_select_db($database_pushpanjali, $pushpanjali);
$query_r_report = "SELECT * FROM vazhipadu WHERE vazhipadu_date='$v_date'";
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


ob_start();
if (isset($_GET["excel"]) ){
	header("Content-type: application/vnd.ms-excel");
	header("Content-Disposition: attachment; filename=daily_income_report_".date("d-m-Y",strtotime($v_date)).".xls");
	header("Cache-Control: cache, must-revalidate");
	header("Pragma: public"); 
	
}
$v_amts=array();
?>
      <?php if ($totalRows_r_report > 0) { // Show if recordset not empty ?>
             <table width="825" border="0" align="right" cellpadding="0" cellspacing="0" style="border:1px solid #999999;">
               <tr class="style1">
                 <td width="50" align="centre" valign="middle" style="border-bottom:1px solid #999999;"><strong>No</strong></td>
                 <td width="200" height="30" align="left" valign="middle" style="border-bottom:1px solid #999999;">&nbsp;&nbsp;<strong><span class="style1">Name</span></strong></td>
                <td width="150" height="30" align="left" valign="middle" style="border-bottom:1px solid #999999;"><strong><span class="style1">Pooja</span></strong></td>
                <td width="200" height="30" align="left" valign="middle" style="border-bottom:1px solid #999999;"><strong><span class="style1">Star</span></strong></td>
                <td width="100" height="30" align="left" valign="middle" style="border-bottom:1px solid #999999;"><strong><span class="style1">Amount</span></strong></td>
                <td width="75" height="30" align="left" valign="middle" style="border-bottom:1px solid #999999;">Status</td>
                </tr>
               <?php do { ?>
                 <tr class="style1">
                   <td width="50" align="centre" valign="middle"><?php echo $row_r_report['receipt_number']; ?>  </td>
                   <td width="200" height="30" align="left" valign="middle">&nbsp;&nbsp;<?php echo $row_r_report['name']; ?></td>
                   <td width="200" height="30" align="left" valign="middle"><?php $v_pooja_id=$row_r_report['pooja'];
				   include('inc_pooja.php'); echo $v_pooja_name; ?></td>
                   <td width="100" height="30" align="left" valign="middle"><?php $v_star=$row_r_report['star'];
				  include('star_name.php'); echo $v_starname; ?></td>
                   <td width="100" height="30" align="left" valign="middle"><?php  if($row_r_report['status']==1) { echo $row_r_report['amount'];} else {   $v_amts[]=$row_r_report['amount']; echo $row_r_report['amount']; }?></td>
                   <td width="75" height="30" align="left" valign="middle">
                    <?php if($row_r_report['status']==1) { echo "Cancelled";} else { ?>&nbsp;
                   <?php }?></td>
                   </tr><?php } while ($row_r_report = mysql_fetch_assoc($r_report)); ?>
                 <tr class="style1">
                   <td align="left" valign="middle" bgcolor="#C2F29F" style="border-top:1px solid #999999;">&nbsp;</td>
                   <td height="30" align="left" valign="middle" bgcolor="#C2F29F" style="border-top:1px solid #999999;">&nbsp;&nbsp;<strong>Total</strong></td>
                   <td height="30" align="left" valign="middle" bgcolor="#C2F29F" style="border-top:1px solid #999999;">&nbsp;</td>
                   <td height="30" align="left" valign="middle" bgcolor="#C2F29F" style="border-top:1px solid #999999;">&nbsp;</td>
                   <td height="30" align="left" valign="middle" bgcolor="#C2F29F" style="border-top:1px solid #999999;"><strong>
				 
				   <?php echo array_sum($v_amts); ?>
                  
                   &nbsp;</strong></td>
                   <td height="30" align="left" valign="middle" bgcolor="#C2F29F" style="border-top:1px solid #999999;">&nbsp;</td>
                 </tr>
                 
                </table>
             <?php } // Show if recordset not empty ?>
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
    <div class="overflow_scroll" style="height:400px; width:855px" id="report_div" >

		<?php echo $report; ?>

    </div>
      
     </td>
  </tr>  
</table>
      </td>
    </tr>
</table></td>
  </tr>
</table>
