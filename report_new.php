<?php require_once('Connections/pushpanjali.php'); ?><?php require_once('Connections/pushpanjali.php'); 
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
$v_from=$_POST['from_date'];
$v_to=$_POST['to_date'];
}
else
{
$v_from=date('Y-m-01');;
$v_to=date('Y-m-d');
}
mysql_query("SET NAMES utf8");
mysql_select_db($database_pushpanjali, $pushpanjali);
$query_r_report = "SELECT DISTINCT date FROM `master` WHERE date >='$v_from' AND date <='$v_to' AND status='0' ORDER BY date ASC";
$r_report = mysql_query($query_r_report, $pushpanjali) or die(mysql_error());
$row_r_report = mysql_fetch_assoc($r_report);
$totalRows_r_report = mysql_num_rows($r_report);

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<style type="text/css">
<!--
body {
	background-color: #999;
}
.pus {
	color: #C00;
}
-->
</style>
<title>Puthenkavu Kshetram</title>
<link href="*.css" rel="stylesheet" type="text/css" />
<link href="style.css" rel="stylesheet" type="text/css" />
<link href="calendar/calendar.css" rel="stylesheet" type="text/css" />
<script language="javascript" src="calendar/calendar.js"></script>
<style type="text/css">
<!--
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
        <td width="84" height="41" align="center" valign="middle"><a href="home.php" class="menu">Home</a></td>
        <td width="83" height="41" align="center" valign="middle"><a href="star.php" class="menu">Star</a></td>
        <td width="85" height="41" align="center" valign="middle"><a href="pooja.php" class="menu">Pooja</a></td>
        <td width="93" height="41" align="center" valign="middle"><a href="vazhipadu.php" class="menu">Vazhipadu</a></td>
        <td width="91" height="41" align="center" valign="middle"><a href="voucher.php" class="menu">Vouchers</a></td>
        <td width="110" height="41" align="center" valign="middle"><a href="report.php" class="menu">Report</a></td>
        <td width="130" align="center" valign="middle"><a href="report_summary.php" class="menu_active" >Report summary</a></td>
        <td width="126" height="41" align="center" valign="middle"><a href="logout.php" class="menu">Logout</a></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td height="400" align="left" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="70%" height="600" align="left" valign="top" >
   <table width="80%" border="0" align="center" cellpadding="0" cellspacing="0">
      <tr>
          <td height="50" colspan="7" align="center" valign="middle"><h1 class="pus">പുഷ്പാഞ്ജലി ബില്ലിംഗ് സോഫ്റ്റ്‌വെയര്‍</h1>
            </td>
        </tr>
      <tr>
        <td height="50" colspan="7" align="center" valign="middle">
        <table width="100%" border="0" cellspacing="0" style="border:1px solid #999999;">
          <form id="form1" name="form1" method="post" action="report_new.php"><tr>
            <td height="50" align="center" valign="middle" bgcolor="#E4E4E4"><span class="style5">Search</span></td>
            <td height="50" align="center" valign="middle" bgcolor="#FFFFFF"><span class="style3">From 
              <?php
	  $myCalendar = new tc_calendar("from_date", true, false);
	  $myCalendar->setIcon("calendar/images/iconCalendar.gif");
	  $myCalendar->setDate(1, date('m'), date('Y'));
	  $myCalendar->setPath("calendar/");
	  $myCalendar->setYearInterval(2000, 2015);
	  $myCalendar->dateAllow('2008-05-13', '2015-03-01');
	  $myCalendar->setDateFormat('j F Y');
	  $myCalendar->writeScript();
	  ?>
            </span></td>
            <td height="50" align="center" valign="middle" bgcolor="#FFFFFF"><span class="style3">To 
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
            <td height="50" align="center" valign="middle" bgcolor="#FFFFFF">              <span class="style3">
                <label>
                  <input type="submit" name="search" id="search" value="Submit" />
                  </label>
                </span>            </td>
          </form>
            <td height="50" align="center" valign="middle" bgcolor="#FFFFFF">
              <label>
                <form name="form3" action="print_report_summary.php?from=<?php echo $v_from; ?>&to=<?php echo $v_to; ?>" method="post">
                	<input type="submit" name="Print" id="Print" value="Print" />
                </form>
                </label>                      </td>
            </tr>       

            </table>
         <div style="overflow:scroll; height:350px; width:850px">
           <?php if ($totalRows_r_report > 0) { // Show if recordset not empty ?>
             <table width="100%" border="1" cellspacing="0">
               <tr>
                 <td width="39%" align="center" valign="middle"><span class="style3">date</span></td>
                 <td width="39%" height="50" align="center" valign="middle"><span class="style3">ഇനം</span></td>
                <td width="11%" height="50" align="center" valign="middle"><span class="style3">ഏണ്ണം</span></td>
                <td width="10%" height="50" align="center" valign="middle"><span class="style3">തുക</span></td>
                <td width="13%" height="50" align="center" valign="middle"><span class="style3">ആകെ തുക(Cr)</span></td>
                <td width="13%" align="center" valign="middle"><span class="style3">ആകെ തുക(Dr)</span></td>
                <td width="16%" height="50" align="center" valign="middle"><span class="style3">ഭോഗം മേല്‍ശാന്തി</span></td>
                <td width="11%" align="center" valign="middle"><span class="style3">ഭോഗം കഴകം</span></td>
              </tr>
               <?php do {
			   $v_date=$row_r_report['date'];
			   mysql_query("SET NAMES utf8");
				mysql_select_db($database_pushpanjali, $pushpanjali);
				$query_r_report1 = "SELECT DISTINCT type FROM `master`  WHERE date='$v_date' AND status='0'";
				$r_report1 = mysql_query($query_r_report1, $pushpanjali) or die(mysql_error());
				$row_r_report1 = mysql_fetch_assoc($r_report1);
				$totalRows_r_report1 = mysql_num_rows($r_report1);
					do {
					if($row_r_report1['type']=="vazhipadu")
					{
					mysql_select_db($database_pushpanjali, $pushpanjali);
					$query_r_vazhipadu = "SELECT COUNT(id),SUM(amount) FROM vazhipadu WHERE vazhipadu_date='$v_date'";
					$r_vazhipadu = mysql_query($query_r_vazhipadu, $pushpanjali) or die(mysql_error());
					$row_r_vazhipadu = mysql_fetch_assoc($r_vazhipadu);
					$totalRows_r_vazhipadu = mysql_num_rows($r_vazhipadu);
					}
					else
					{
					mysql_select_db($database_pushpanjali, $pushpanjali);
					$query_r_vazhipadu = "SELECT COUNT(id),SUM(amount) FROM voucher WHERE voucher_date='$v_date'";
					$r_vazhipadu = mysql_query($query_r_vazhipadu, $pushpanjali) or die(mysql_error());
					$row_r_vazhipadu = mysql_fetch_assoc($r_vazhipadu);
					$totalRows_r_vazhipadu = mysql_num_rows($r_vazhipadu);
					}
		
					?>
               <tr>
                 <td ><?php echo $v_date; ?></td>
                <td height="50" ><?php echo $row_r_report1['type']; ?></td>
               <td height="50" ><?php echo $row_r_vazhipadu['COUNT(id)']; ?></td>
                <td height="50" ><?php echo $row_r_vazhipadu['SUM(amount)']; ?></td>
                <td height="50" ><?php if($row_r_report1['type']=="vazhipadu")
					{ echo $row_r_vazhipadu['SUM(amount)']; } ?></td>
                <td ><?php if($row_r_report1['type']=="voucher")
					{ echo $row_r_vazhipadu['SUM(amount)']; }?>&nbsp;</td>
                <td height="50" ><?php  include('inc_bhogam.php'); 
				 echo  array_sum($v_amount_bhogam); ?>&nbsp;</td>
                <td height="50" ><?php echo array_sum($v_amounr_kahakam); ?>&nbsp;</td>
              </tr>
              <?php } while ($row_r_report1 = mysql_fetch_assoc($r_report1)); ?>
              <?php } while ($row_r_report = mysql_fetch_assoc($r_report)); ?>
            
              <tr>
                <td align="right" >&nbsp;</td>
                <td height="50" align="right" ><strong>ആകെ </strong></td>
                <td height="50" >&nbsp;</td>
                <td height="50" >&nbsp;</td>
                <td height="50" >&nbsp;</td>
                <td >&nbsp;</td>
                <td height="50" >&nbsp;</td>
                <td height="50" >&nbsp;</td>
              </tr> <?php } // Show if recordset not empty ?>
               </table>
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

</body>
</html>
<?php
mysql_free_result($r_report);

mysql_free_result($r_vazhipadu);
?>
