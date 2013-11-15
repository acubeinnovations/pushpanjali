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
$query_r_view_voucher = "SELECT * FROM voucher WHERE voucher_date BETWEEN '$v_from' AND '$v_to'";
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
if (isset($_GET["excel"]) ){
	header("Content-type: application/vnd.ms-excel");
	header("Content-Disposition: attachment; filename=daily_expense_report_".date("d-m-Y",strtotime($v_from)).".xls");
	header("Cache-Control: cache, must-revalidate");
	header("Pragma: public"); 
	
}

$v_amt=array();
?>


<table width="833" border="0" align="right" cellpadding="0" cellspacing="0" style="border:1px solid #999999;">
          <tr>
            <td width="54" height="30" class="style1" style="border-bottom:1px solid #999999;">No</td>
            <td width="100" height="30" style="border-bottom:1px solid #999999;"><span class="style1"><strong>Date</strong></span></td>
              <td width="170" height="30" style="border-bottom:1px solid #999999;"><span class="style1"><strong>Name</strong></span></td>
              <td width="300" height="30" style="border-bottom:1px solid #999999;"><span class="style1"><strong>Purpose</strong></span></td>
              <td width="90" height="30" style="border-bottom:1px solid #999999;"><span class="style1"><strong>Amount</strong></span></td>
              <td width="49" height="30" align="center" valign="middle" style="border-bottom:1px solid #999999;"><span class="style1"><strong>Edit</strong></span></td>
              <td width="49" height="30" align="center" valign="middle" style="border-bottom:1px solid #999999;"><span class="style1"><strong>Delete</strong></span></td>
              <td width="55" height="30" align="center" valign="middle" style="border-bottom:1px solid #999999;"><span class="style1"><strong><!--Print--></strong></span></td>
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
              <td width="49" height="30" align="center" valign="middle" style="border-bottom:1px solid #999999;">
                <span class="style1"><a href="#" onClick="MM_openBrWindow('edit_voucher.php?id=<?php echo $row_r_view_voucher['id']; ?>','','width=400,height=400')">
              <img src="images/edit.png" width="20" border="0" /></a></span></td>
              <td width="49" height="30" align="center" valign="middle" style="border-bottom:1px solid #999999;">
                <span class="style1">  <?php if($row_r_view_voucher['status']==0) {?><a href="delete_voucher.php?id=<?php echo $row_r_view_voucher['id']; ?>">
              <img src="images/delete.png" width="20" border="0" /></a><?php } else { echo "Cancelled"; }?></span></td>
              <td width="55" height="30" align="center" valign="middle" style="border-bottom:1px solid #999999;">
                
                
                <span class="style1">
              
                <a href="#" onClick="MM_openBrWindow('print_voucher.php?id=<?php echo $row_r_view_voucher['id']; ?>','','width=400,height=400')">
              Print</a>
              
              </span></td>
            </tr> <?php } while ($row_r_view_voucher = mysql_fetch_assoc($r_view_voucher)); ?>
            <tr bgcolor="#F0C6C6">
              <td height="30" >&nbsp;</td>
              <td height="30" class="style1"><strong>Total</strong></td>
              <td height="30">&nbsp;</td>
              <td height="30">&nbsp;</td>
              <td width="90" height="30" class="style1"><strong><?php echo array_sum($v_amt); ?></strong></td>
              <td height="30" align="center" valign="middle">&nbsp;</td>
              <td height="30" align="center" valign="middle">&nbsp;</td>
              <td height="30" align="center" valign="middle">&nbsp;</td>
            </tr>
           
          </table>


<?php

$report = ob_get_contents();
ob_end_clean();



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
<title>Puthenkavu Kshetram</title>
<link href="*.css" rel="stylesheet" type="text/css" />
<link href="style.css" rel="stylesheet" type="text/css" />


<script type="text/javascript">
<!--
function MM_openBrWindow(theURL,winName,features) { //v2.0
  window.open(theURL,winName,features);
}
//-->
</script>
<link href="calendar/calendar.css" rel="stylesheet" type="text/css" />
<script language="javascript" src="calendar/calendar.js"></script>

</head>

<body marginheight="0" marginwidth="0" topmargin="0" bottommargin="0" rightmargin="0" leftmargin="0">
<table width="100%" border="0" align="right" cellpadding="0" cellspacing="0">
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
        	<td align="right"> 
            <table width="850px" border="0" align="right" cellpadding="0" cellspacing="0" style="border:1px solid #999999;">
            <td height="50" align="center" valign="middle" bgcolor="#FFFFFF" class="style1">
            <form id="form1" name="form1" method="get" action="report_sumup.php">
              <span class="style5">Daily Report as on <?php echo $v_from; ?> &nbsp;&nbsp;&nbsp;</span>      
              <!--<label><input type="button" class="style1" onClick="window.print();"  value="Print"/> </label>
				<input type="submit" name="excel" id="excel" value="Print to Excel" />-->
                <a href="xls_chilavu.php?<?php echo $v_from; ?>">Print to Excel</a>
				<input type="hidden" name="from_date" value="2013-11-05" /> 
				<input type="hidden" name="to_date" value="2013-11-05" /> 
				</form>
			</td>
            </tr>       
            </table>
            </td>
        </tr>
  <tr>
    <td align="right" valign="middle">
	<?php if($totalRows_r_view_voucher>0) { ?>
    <div class="overflow_scroll" style="height:400px; width:858px" id="report_div" >
      <?php echo $report; ?>
    </div>
      <?php } ?>
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

