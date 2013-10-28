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
$query_r_report = "SELECT DISTINCT pooja FROM vazhipadu WHERE vazhipadu_date BETWEEN '$v_from' AND '$v_to' AND status='0' ";
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
        <td width="126" height="41" align="center" valign="middle"><a href="logout.php" class="menu">Logout</a></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td height="400" align="left" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="70%" height="600" align="left" valign="top" bgcolor="#CCCCCC">
   <table width="80%" border="0" align="center" cellpadding="0" cellspacing="0">
      <tr>
          <td height="50" colspan="7" align="center" valign="middle"><h1 class="pus">പുഷ്പാഞ്ജലി ബില്ലിംഗ് സോഫ്റ്റ്‌വെയര്‍</h1>
            </td>
        </tr>
      <tr>
        <td height="50" colspan="7" align="center" valign="middle">
        <table width="100%" border="0" cellspacing="0" style="border:1px solid #999999;">
          <form id="form1" name="form1" method="post" action="report_summary.php"><tr>
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
                 <td width="39%" height="50" align="center" valign="middle"><span class="style5">പൂജ</span></td>
                <td width="11%" height="50" align="center" valign="middle"><span class="style5">തുക</span></td>
                <td width="10%" height="50" align="center" valign="middle"><span class="style5">ഏണ്ണം</span></td>
                <td width="13%" height="50" align="center" valign="middle"><span class="style5">ആകെ തുക</span></td>
                <td width="16%" height="50" align="center" valign="middle"><span class="style5">ഭോഗം മേല്‍ശാന്തി</span></td>
                <td width="11%" align="center" valign="middle"><span class="style5">ഭോഗം കഴകം</span></td>
              </tr>
               <?php do { ?>
               <tr>
                <td height="50" ><span class="style3"><?php echo $v_pooja_id=$row_r_report['pooja'];	
				include('inc_pooja.php');			
					mysql_select_db($database_pushpanjali, $pushpanjali);
					$query_r_view_pooja = "SELECT pooja.rate, pooja.bhogam_melsanthi, pooja.bhogam_kazakam,COUNT(vazhipadu.pooja) FROM pooja,vazhipadu WHERE pooja.pooja='".$row_r_report['pooja']."' AND vazhipadu.pooja='".$row_r_report['pooja']."' AND vazhipadu.vazhipadu_date BETWEEN '$v_from' AND '$v_to' AND vazhipadu.status='0' ";
					$r_view_pooja = mysql_query($query_r_view_pooja, $pushpanjali) or die(mysql_error());
					$row_r_view_pooja = mysql_fetch_assoc($r_view_pooja);
					$totalRows_r_view_pooja = mysql_num_rows($r_view_pooja);

				 ?></span></td>
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

mysql_free_result($r_view_pooja);
?>
