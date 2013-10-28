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
if(isset($_GET["date"]) && trim($_GET["date"])!=""){
	$v_date = $_GET['date'];
}else{
	$v_date = date("Y-m-d");
	
}


mysql_query("SET NAMES utf8");
mysql_select_db($database_pushpanjali, $pushpanjali);
$query_r_report = "SELECT * FROM vazhipadu WHERE vazhipadu_date='$v_date' AND status='0' ";
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
<title>Puthenkavu Kshetram</title>
<link href="*.css" rel="stylesheet" type="text/css" />
<link href="style.css" rel="stylesheet" type="text/css" />
<link href="calendar/calendar.css" rel="stylesheet" type="text/css" />
<script language="javascript" src="calendar/calendar.js"></script>

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
                        <h1 class="pus noprint">പുത്തന്‍കാവ് ചാരംപറമ്പ്‌ ഭഗവതി ക്ഷേത്രം</h1>
            			</td> 
   			  </tr>
        <tr>
        	<td align="right"> 
            <table width="855" border="0" align="right" cellpadding="0" cellspacing="0" style="border:1px solid #999999;">
          <form id="form1" name="form1" method="post" action="home.php">
          </form>
            <td height="50" align="center" valign="middle" bgcolor="#FFFFFF">
              <label><input type="button" class="style1" onclick="window.print();"  value="Print"/>
                </label>                      </td>
            </tr>       
            </table>
            </td>
        </tr>
  <tr>
    <td align="right" valign="middle">
    <div class="overflow_scroll" style="height:400px; width:858px" id="report_div" >
      <?php if ($totalRows_r_report > 0) { // Show if recordset not empty ?>
             <table width="100%" border="1" cellpadding="0" cellspacing="0" style="border:1px solid #999999;">
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
