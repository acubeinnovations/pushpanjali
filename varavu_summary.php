<?php 
 header('Content-type: text/html; charset=utf-8');
 require_once('Connections/pushpanjali.php'); 
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
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<style type="text/css">
<!--
.pus {
	color: #C00;
}
-->
</style>
<link type="text/css" href="css/print.css" rel="stylesheet" media="print" />
<style type="text/css" media="screen">

  #divToPrint{
    display:none;
  }
  
</style>

<style type="text/css" media="print">

  #divnoprint{
    display:none;
  }

</style>
<title>Puthenkavu Kshetram</title>
<link href="*.css" rel="stylesheet" type="text/css" />
<link href="style.css" rel="stylesheet" type="text/css" />
<link href="calendar/calendar.css" rel="stylesheet" type="text/css" />
<script language="javascript" src="calendar/calendar.js"></script>
<script >
function printxl(){

       document.form1.action="xls_varavu.php";

}
</script>
</head>

<body marginheight="0" marginwidth="0" topmargin="0" bottommargin="0" rightmargin="0" leftmargin="0">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td height="53" align="left" valign="top" background="images/bg.PNG">
    <table width="852" border="0" align="left" cellpadding="0" cellspacing="1">
      <tr class="menu noprint" >
        <td width="81" height="41" align="center" valign="middle"><a href="home.php" class="menu_active">Home</a></td>
        <td width="78" height="41" align="center" valign="middle"><a href="star.php" class="menu">Star</a></td>
        <td width="81" height="41" align="center" valign="middle"><a href="pooja.php" class="menu">Pooja</a></td>
        <td width="127" height="41" align="center" valign="middle"><a href="vazhipadu.php" class="menu">Vazhipadu</a></td>
        <td width="97" height="41" align="center" valign="middle"><a href="voucher.php" class="menu">Vouchers</a></td>
        <td width="75" height="41" align="center" valign="middle"><a href="report_sumup.php" class="menu">Report</a></td>
        <td width="114" height="41" align="center" valign="middle"><a href="logout.php" class="menu">Logout</a></td>
      </tr>
    </table>
    </td>
  </tr>
  <tr>
    <td height="400" align="left" valign="top">
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
  		<tr>
   		  <td width="70%" height="600" align="left" valign="top">
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
              <td height="50" colspan="6" align="center" valign="middle" style="border-bottom:1px solid #999999;">വരവ്  :  <?php echo date("d/m/Y",strtotime($v_from))." to ".date("d/m/Y",strtotime($v_to)); ?><span id="divnoprint" >
              <!--<label><input type="button" class="style1" onclick="window.print();"  value="Print"/> -->
             &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <a href="xls_varavu_summary.php?<?php echo $v_from; ?>">Print to Excel</a>
                </label>
              </td>
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
    </td>
    <td width="326" align="center" valign="top">&nbsp;
      </td>
  </tr>
</table></td>
  </tr>
</table>
<div align="center" style="display: block; position:absolute; text-align:center; bottom: 0; width: 100.00%; color: #CCC; clear: both; height:40px; background-repeat: repeat-x; border-right-width: 100px;  background-color:#333333; filter:alpha(opacity=75); opacity:0.90;"><br />
<span class="footer">All rights reserved. ® Acube Innovations Pvt Ltd. Phone: 0484 6066060.  Copyright © 2013. </span></div>
</body>
</html>
