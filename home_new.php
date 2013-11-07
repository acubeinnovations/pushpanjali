<?php
require_once('calendar/classes/tc_calendar.php');
if(isset($_POST["from_date"]) && trim($_POST["from_date"])!=""){
	$v_from = $_POST['from_date'];
}else{
	$v_from = date("Y-m-d");
	
}


if(isset($_POST["to_date"]) &&  trim($_POST["to_date"])!=""){
	$v_to = $_POST['to_date'];
}else{
	$v_to = date("Y-m-d");	
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
        <td width="75" height="41" align="center" valign="middle"><a href="report.php" class="menu">Report</a></td>
        <td width="171" align="center" valign="middle"><a href="report_summary.php"  class="menu">Report summary</a></td>
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
          <form id="form1" name="form1" method="post" action="home_new.php"><tr class="noprint">
            <td height="50" colspan="4" align="center" valign="middle" bgcolor="#FFFFFF" class="style1">Search&nbsp;&nbsp;&nbsp; From &nbsp;&nbsp;&nbsp;
            <select name="select" id="select">
                <option value="1">വരവ്</option>
                <option value="2">ചിലവ്</option>
                <option value="3">ഭോഗം</option>
              </select> &nbsp;&nbsp;&nbsp; From &nbsp;&nbsp;&nbsp;
<?php
	  $myCalendar = new tc_calendar("from_date", true, false);
	  $myCalendar->setIcon("calendar/images/iconCalendar.gif");
	  //$myCalendar->setDate(date('d'), date('m'), date('Y'));
	  $myCalendar->setDate(date('d',strtotime($v_from)), date('m',strtotime($v_from)), date('Y',strtotime($v_from)));
	  
	  $myCalendar->setPath("calendar/");
	  $myCalendar->setYearInterval(2000, 2015);
	  $myCalendar->dateAllow('2008-05-13', '2015-03-01');
	  $myCalendar->setDateFormat('j F Y');
	  $myCalendar->writeScript();
	  ?>
&nbsp;&nbsp;&nbsp;            To&nbsp;&nbsp;&nbsp;
<?php
	  $myCalendar = new tc_calendar("to_date", true, false);
	  $myCalendar->setIcon("calendar/images/iconCalendar.gif");
	  //$myCalendar->setDate(date('d'), date('m'), date('Y'));
	  $myCalendar->setDate(date('d',strtotime($v_to)), date('m',strtotime($v_to)), date('Y',strtotime($v_to)));
	  $myCalendar->setPath("calendar/");
	  $myCalendar->setYearInterval(2000, 2015);
	  $myCalendar->dateAllow('2008-05-13', '2015-03-01');
	  $myCalendar->setDateFormat('j F Y');
	  $myCalendar->writeScript();
	  ?>                          
              <label>
                 &nbsp;&nbsp;&nbsp;
                 <input type="submit" name="search" id="search" value="Submit" />
              </label>            </td>
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
     <?php if(isset($_POST['select']))
	 {
	 if($_POST['select']==1)
	 {
	 include('inc_varavu.php'); 
	 }
	 else if($_POST['select']==2)
	 {
	 include('chilavu.php'); 
	 }
	 else if($_POST['select']==3)
	 {
	 include('bhogam.php'); 
	 }
	 }
	 else
	 {
	 include('inc_varavu.php'); 

	 }?>
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
