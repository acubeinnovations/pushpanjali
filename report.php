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
if(isset($_POST['from_date']))
{
mysql_query("SET NAMES utf8");
$v_from=$_POST['from_date'];
$v_to=$_POST['to_date'];
mysql_select_db($database_pushpanjali, $pushpanjali);
$query_r_report = "SELECT * FROM vazhipadu WHERE vazhipadu_date BETWEEN '$v_from' AND '$v_to' AND status='0' ";
$r_report = mysql_query($query_r_report, $pushpanjali) or die(mysql_error());
$row_r_report = mysql_fetch_assoc($r_report);
$totalRows_r_report = mysql_num_rows($r_report);

//header("Location:print_report.php");
}
else
{
$v_from="0";
$v_to="0";
mysql_query("SET NAMES utf8");
mysql_select_db($database_pushpanjali, $pushpanjali);
$query_r_report = "SELECT * FROM vazhipadu WHERE status='0' ORDER BY vazhipadu_date DESC";
$r_report = mysql_query($query_r_report, $pushpanjali) or die(mysql_error());
$row_r_report = mysql_fetch_assoc($r_report);
$totalRows_r_report = mysql_num_rows($r_report);
}
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
<style type="text/css">
<!--
.style1 {font-size: 14px}
.style3 {font-family: Arial, Helvetica, sans-serif; font-size: 14px; }
.style5 {font-family: Arial, Helvetica, sans-serif; font-size: 14px; font-weight: bold; }
-->
</style>
</head>

<body marginheight="0" marginwidth="0" topmargin="0" bottommargin="0" rightmargin="0" leftmargin="0">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td height="53" align="left" valign="top" background="images/bg.PNG"><table width="852" border="0" align="left" cellpadding="0" cellspacing="1">
       <tr class="menu">
        <td width="88" height="41" align="center" valign="middle"><a href="home.php" class="menu">Home</a></td>
        <td width="87" height="41" align="center" valign="middle"><a href="star.php" class="menu">Star</a></td>
        <td width="89" height="41" align="center" valign="middle"><a href="pooja.php" class="menu">Pooja</a></td>
        <td width="97" height="41" align="center" valign="middle"><a href="vazhipadu.php" class="menu">Vazhipadu</a></td>
        <td width="87" height="41" align="center" valign="middle"><a href="voucher.php" class="menu">Vouchers</a></td>
        <td width="98" height="41" align="center" valign="middle"><a href="report.php" class="menu_active">Report</a></td>
        <td width="171" align="center" valign="middle"><a href="report_summary.php"  class="menu">Report summary</a></td>
        <td width="126" height="41" align="center" valign="middle"><a href="logout.php" class="menu">Logout</a></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td height="400" align="left" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="70%" height="600" align="left" valign="top">
   <table width="80%" border="0" align="center" cellpadding="0" cellspacing="0">
      <tr>
          <td height="50" colspan="7" align="center" valign="middle"><h1 class="pus">പുത്തന്‍കാവ് ചാരംപറമ്പ്‌ ഭഗവതി ക്ഷേത്രം</h1>
            </td>
        </tr>
      <tr>
        <td height="50" colspan="7" align="center" valign="middle" bgcolor="#FFFFFF" >
        <table width="100%" border="0" cellspacing="0" style="border:1px solid #999999;">
          <form id="form1" name="form1" method="post" action="report.php"><tr>
            <td width="150" height="50" align="center" valign="middle" bgcolor="#FFFFFF"><span class="style5">SEARCH</span></td>
            <td width="200" height="50" align="center" valign="middle" bgcolor="#FFFFFF"><span class="style3">From 
              <?php
	  $myCalendar = new tc_calendar("from_date", true, false);
	  $myCalendar->setIcon("calendar/images/iconCalendar.gif");
	  $myCalendar->setDate(date('d'), date('m'), date('Y'));
	  $myCalendar->setPath("calendar/");
	  $myCalendar->setYearInterval(2000, 2015);
	  $myCalendar->dateAllow('2008-05-13', '2015-03-01');
	  $myCalendar->setDateFormat('j F Y');
	  $myCalendar->writeScript();
	  ?>
            </span></td>
            <td width="200" height="50" align="center" valign="middle" bgcolor="#FFFFFF"><span class="style3">To 
              <?php
	  $myCalendar = new tc_calendar("to_date", true, false);
	  $myCalendar->setIcon("calendar/images/iconCalendar.gif");
	  $myCalendar->setDate(date('d'), date('m'), date('Y'));
	  $myCalendar->setPath("calendar/");
	  $myCalendar->setYearInterval(2000, 2015);
	  $myCalendar->dateAllow('2008-05-13', '2015-03-01');
	  $myCalendar->setDateFormat('j F Y');
	  $myCalendar->writeScript();
	  ?>
            </span></td>
            <td width="100" align="center" valign="middle" bgcolor="#FFFFFF"><label>
              <select name="select" id="select">
                <option value="1">വരവ്</option>
                <option value="2">ചിലവ്</option>
                <option value="3">ഭോഗം</option>
              </select>
            </label></td>
            <td width="100" height="50" align="center" valign="middle" bgcolor="#FFFFFF">              <span class="style3">
                <label>
                  <input type="submit" name="search" id="search" value="Submit" />
                  </label>
                </span>            </td>
          </form>
            <td width="150" height="50" align="center" valign="middle" bgcolor="#FFFFFF">
              <label>
                <form name="form3" action="print_report.php?from=<?php echo $v_from; ?>&to=<?php echo $v_to; ?>" method="post">
                	<input type="submit" name="Print" id="Print" value="Print" />
                </form>
                </label>                      </td>
            </tr>       

            </table>
         <div style="overflow:scroll; height:350px; width:850px">
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
                   <td height="30" align="center" valign="middle"><span class="style1"><?php echo $row_r_report['pooja']; ?></span></td>
                   <td height="30" align="center" valign="middle"><span class="style1"><?php echo $row_r_report['star']; ?></span></td>
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
      <div align="center" style="display: block; position:absolute; text-align:center; bottom: 0; width: 100.00%; color: #CCC; clear: both; height:40px; background-repeat: repeat-x; border-right-width: 100px;  background-color:#333333; filter:alpha(opacity=75); opacity:0.90;"><br />
<span class="footer">All rights reserved. ® Acube Innovations Pvt Ltd. Phone: 0484 6066060.  Copyright © 2013. </span></div>
    </td>
    <td width="326" align="center" valign="top" bgcolor="#FFFFFF">&nbsp;</td>
  </tr>
</table></td>
  </tr>
</table>
<div align="center" style="display: block; position:absolute; text-align:center; bottom: 0; width: 100.00%; color: #CCC; clear: both; height:40px; background-repeat: repeat-x; border-right-width: 100px;  background-color:#333333; filter:alpha(opacity=75); opacity:0.90;"><br />
<span class="footer">All rights reserved. ® Acube Innovations Pvt Ltd. Phone: 0484 6066060.  Copyright © 2013. </span></div>

</body>
</html>
<?php
mysql_free_result($r_report);
?>
