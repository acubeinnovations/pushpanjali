<?php 
header('Content-type: text/html; charset=utf-8');
require_once('Connections/pushpanjali.php'); ?>
<?php require_once('Connections/pushpanjali.php'); ?>
<?php 
 header('Content-type: text/html; charset=utf-8');
 require_once('Connections/pushpanjali.php');
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
 $v_print=0;
  mysql_query("SET NAMES utf8");
mysql_select_db($database_pushpanjali, $pushpanjali);
$query_r_view_voucher = "SELECT * FROM voucher WHERE status='0'";
$r_view_voucher = mysql_query($query_r_view_voucher, $pushpanjali) or die(mysql_error());
$row_r_view_voucher = mysql_fetch_assoc($r_view_voucher);
$totalRows_r_view_voucher = mysql_num_rows($r_view_voucher);

mysql_select_db($database_pushpanjali, $pushpanjali);
$query_r_vou_hd = "SELECT * FROM voucher_head";
$r_vou_hd = mysql_query($query_r_vou_hd, $pushpanjali) or die(mysql_error());
$row_r_vou_hd = mysql_fetch_assoc($r_vou_hd);
$totalRows_r_vou_hd = mysql_num_rows($r_vou_hd);


mysql_select_db($database_pushpanjali, $pushpanjali);
$query_voucher = "SELECT * FROM voucher ORDER BY id DESC";
$voucher = mysql_query($query_voucher, $pushpanjali) or die(mysql_error());
$row_voucher = mysql_fetch_assoc($voucher);
$totalRows_voucher = mysql_num_rows($voucher);
$vid=$row_voucher['id']+1;

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
   mysql_query("SET NAMES utf8");
  
  $insertSQL = sprintf("INSERT INTO voucher (voucher_date, name, address, purpose, description, amount) VALUES (%s, %s, %s, %s,%s, %s)",
                       GetSQLValueString($_POST['date'], "date"),
                       GetSQLValueString($_POST['name'], "text"),
                       GetSQLValueString($_POST['address'], "text"),
                       GetSQLValueString($_POST['purpose'], "text"),
                       GetSQLValueString($_POST['description'], "text"),
                       GetSQLValueString($_POST['amount'], "int"));

  mysql_select_db($database_pushpanjali, $pushpanjali);
  $Result1 = mysql_query($insertSQL, $pushpanjali) or die(mysql_error());
  $v_type_id=mysql_insert_id();
  
  $insertSQL1 = "INSERT INTO master (type, type_id, `date`, dr) VALUES ('voucher','$v_type_id' , '".$_POST['date']."', '".$_POST['amount']."')";
  mysql_select_db($database_pushpanjali, $pushpanjali);
  $Result11 = mysql_query($insertSQL1, $pushpanjali) or die(mysql_error());
   $v_print=1;
  
}

function echotomysql($f_MySqlDate2){
$f_date_array = explode("-",$f_MySqlDate2); 
$f_var_day = $f_date_array[0];
$f_var_month = $f_date_array[1];
$f_var_year = $f_date_array[2];
$f_var_timestamp =$f_var_year.'-'.$f_var_month.'-'.$f_var_day ;
return($f_var_timestamp);
}

?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
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
<link href="calendar/calendar.css" rel="stylesheet" type="text/css" />
<script language="javascript" src="calendar/calendar.js"></script>
<script type="text/javascript">     
        function PrintDiv() {    
           var divToPrint = document.getElementById('divToPrint');
           var popupWin = window.open('', '_blank', 'width=500,height=400');
           popupWin.document.open();
           popupWin.document.write('<html><body onload="window.print()">' + divToPrint.innerHTML + '</html>');
            popupWin.document.close();
                }
 </script>
 <script type="text/javascript">
<!--

//-->
function validateForm()
{
if(document.getElementById("name").value=="")

              {
			  //alert(x);
                document.getElementById("d_name").innerHTML="Enter name !";
                document.getElementById("name").focus();
                return false;
              }
			  else
			  {
			  	document.getElementById("d_name").innerHTML="";	
			  }
if(document.getElementById("address").value=="")
              {
			  //alert('hai');
                document.getElementById("d_address").innerHTML="Enter address !";
                document.getElementById("address").focus();
                return false;
              }
			  else
			  {
			  	document.getElementById("d_address").innerHTML="";	
			  }
if(document.getElementById("purpose").value=="")
              {
			  //alert('hai');
                document.getElementById("d_purpose").innerHTML="Enter purpose !";
                document.getElementById("purpose").focus();
                return false;
              }
			  else
			  {
			  	document.getElementById("d_purpose").innerHTML="";	
			  }
				
if(document.getElementById("amount").value=="")
              {
			  //alert('hai');
                document.getElementById("d_amount").innerHTML="Enter amount !";
                document.getElementById("amount").focus();
                return false;
              }
			  else
			  {
			  	document.getElementById("d_amount").innerHTML="";	
			  }
			  
}
function MM_openBrWindow(theURL,winName,features) { //v2.0
  window.open(theURL,winName,features);
}
 </script>
</head>
<?php 
if($v_print==1)
{ ?>
<body onLoad="PrintDiv()" marginheight="0" marginwidth="0" topmargin="0" bottommargin="0" rightmargin="0" leftmargin="0"> 
<?php } else { ?>
<body marginheight="0" marginwidth="0" topmargin="0" bottommargin="0" rightmargin="0" leftmargin="0">
<?php }?>






  <div id="divToPrint" style="display:none;" >
  <style type="text/css">
.letter {
font-family:"kartika";
font-size:8px;
letter-spacing:2px;
line-height:20px;
}
@font-face
{
font-family: "kartika";
src: url('fonts/kartika.ttf');
}
.english
{
font-family:"Arial";
font-size:6px;
letter-spacing:2px;
line-height:20px;
}
	</style>
  
  
  <table width="500" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td width="275" height="110">&nbsp;</td>
    <td width="125">&nbsp;</td>
    <td width="100">&nbsp;</td>
  </tr>
  <tr>
    <td width="275" height="65" align="left" valign="top" class="letter">
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Voucher </br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;	
	<?php if (isset($_REQUEST['purpose'])) {$v_vou_id=$_REQUEST['purpose'];include('inc_voucher.php');  echo $v_voucher_name; } ?>        </td>
    <td width="125" height="65">&nbsp;</td>
    <td width="100" height="65" class="letter" align="left" valign="top" ><?php if (isset($_REQUEST['date'])) {echo echotomysql($_POST['date']);}?><br />
<br />
<?php if (isset($_POST['vid'])) {echo $_POST['vid'];}  ?></td>
  </tr>
  <tr>
    <td height="120" colspan="3" align="left" valign="middle">
    <table width="500" border="0" cellpadding="0" cellspacing="0">
    <tr>
    <td width="300" height="25" align="left" valign="middle" class="letter">
	<?php if (isset($_POST['name'])) {echo $_POST['name'];}?><br />
    <?php if (isset($_POST['address'])) {echo $_POST['address'];}?><br />
	<?php if (isset($_POST['description'])) {echo $_POST['description'];}?>
</td>
    <td width="100" height="25" align="middle" valign="top" class="letter">
     <?php if (isset($_POST['amount'])) {echo $_REQUEST['amount'];} ?>
    </td>
  </tr>
</table>
	</td>
  </tr>
<?php if (isset($_REQUEST['amount'])) {?>
  <tr>
    <td height="60">&nbsp;</td>
    <td height="60">&nbsp;</td>
    <td height="60" align="middle" valign="bottom" class="letter"><?php if (isset($_POST['amount'])) {echo $_REQUEST['amount'];} ?></td>
  </tr>
  <?php }?>
</table>
    </div>
    
    
    
    
    
    
    
    
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td height="53" align="left" valign="top" background="images/bg.PNG"><table width="842" border="0" align="left" cellpadding="0" cellspacing="1">
       <tr class="menu">
        <td width="86" height="41" align="center" valign="middle"><a href="home.php" class="menu">Home</a></td>
        <td width="85" height="41" align="center" valign="middle"><a href="star.php" class="menu">Star</a></td>
        <td width="87" height="41" align="center" valign="middle"><a href="pooja.php" class="menu">Pooja</a></td>
        <td width="97" height="41" align="center" valign="middle"><a href="vazhipadu.php" class="menu">Vazhipadu</a></td>
        <td width="99" height="41" align="center" valign="middle"><a href="voucher.php" class="menu_active">Vouchers</a></td>
        <td width="75" height="41" align="center" valign="middle"><a href="report_sumup.php" class="menu">Report</a></td>
        <td width="123" height="41" align="center" valign="middle"><a href="logout.php" class="menu">Logout</a></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td height="400" align="left" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="70%" height="600" align="left" valign="top">
    <table width="850" border="0" align="right" cellpadding="0" cellspacing="0">
        <tr>
          <td height="60" align="center" valign="middle"><h1 class="pus">പുത്തന്‍കാവ് ചാരംപറമ്പ്‌ ഭഗവതി ക്ഷേത്രം</h1></td>
        </tr>
        <tr>
          <td height="60" align="right" valign="middle">
            
              <form id="form1" name="form1" method="post" action="voucher.php">
                <table width="855" border="0" align="right" cellpadding="0" cellspacing="0" style="border:1px solid #999999;">
                  <tr>
                    <td width="22%">&nbsp;</td>
                    <td width="20%" height="30">&nbsp;</td>
                    <td width="41%" height="30" colspan="2">&nbsp;</td>
                    <td width="17%">&nbsp;</td>
                    </tr>
                  <tr>
                    <td>&nbsp;</td>
                    <td height="30" align="left" valign="middle" class="style1">Date</td>
                    <td height="30" colspan="2" align="left" valign="middle" class="style1"><?php
			  $myCalendar = new tc_calendar("date", true, false);
			  $myCalendar->setIcon("calendar/images/iconCalendar.gif");
			  $myCalendar->setDate(date('d'), date('m'), date('Y'));
			  $myCalendar->setPath("calendar/");
			  $myCalendar->setYearInterval(date('Y'), 2020);
			  $myCalendar->dateAllow(date('Y-m-d'), '2015-03-01');
			  $myCalendar->setDateFormat('j F Y');
			  $myCalendar->writeScript();
	  ?></td>
                    <td align="left" valign="middle" class="style1">&nbsp;</td>
                    </tr>
                  <tr>
                    <td>&nbsp;</td>
                    <td height="30" align="left" valign="middle" class="style1">Name</td>
                    <td height="30" colspan="2" align="left" valign="middle" class="style1">
                      <label>
                        <input name="name" type="text" id="name" value="" size="32" />
                        </label>
                      <span id="d_name" class="error"></span></td>
                    <td align="left" valign="middle" class="style1">&nbsp;</td>
                    </tr>
                  <tr>
                    <td>&nbsp;</td>
                    <td height="30" align="left" valign="middle" class="style1">Address</td>
                    <td height="30" colspan="2" align="left" valign="middle" class="style1"><textarea name="address" cols="32" id="address"></textarea>                      <span id="d_address" class="error"></span></td>
                    <td align="left" valign="middle" class="style1">&nbsp;</td>
                    </tr>
                  <tr>
                    <td>&nbsp;</td>
                    <td height="30" align="left" valign="middle" class="style1">Select Head</td>
                    <td height="30" align="left" valign="middle" class="style1"><label>
                      <select name="purpose" id="purpose">
                        <?php
do {  
?>
                        <option value="<?php echo $row_r_vou_hd['vou_hd_id']?>"<?php if (!(strcmp($row_r_vou_hd['vou_hd_id'], $row_r_vou_hd['vou_hd_id']))) {echo "selected=\"selected\"";} ?>><?php echo $row_r_vou_hd['vou_head']?></option>
                        <?php
} while ($row_r_vou_hd = mysql_fetch_assoc($r_vou_hd));
  $rows = mysql_num_rows($r_vou_hd);
  if($rows > 0) {
      mysql_data_seek($r_vou_hd, 0);
	  $row_r_vou_hd = mysql_fetch_assoc($r_vou_hd);
  }
?>
                      </select>
                    </label>
                      
                      <span id="d_purpose" class="error"></span></td>
                    <td align="center" valign="middle" class="style1"><a href="new_head.php">NEW</a></td>
                    <td align="left" valign="middle" class="style1">&nbsp;</td>
                    </tr>
                  <tr>
                    <td>&nbsp;</td>
                    <td height="30" align="left" valign="middle" class="style1">Description</td>
                    <td height="30" align="left" valign="middle" class="style1"><label>
                      <textarea name="description" id="description" cols="45" rows="5"></textarea>
                    </label></td>
                    <td align="center" valign="middle" class="style1">&nbsp;</td>
                    <td align="left" valign="middle" class="style1">&nbsp;</td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                    <td height="30" align="left" valign="middle" class="style1">Amount</td>
                    <td height="30" colspan="2" align="left" valign="middle" class="style1">
                      <input name="amount" type="text" id="amount" value="" size="32" />
                      
                      <span id="d_amount" class="error"></span></td>
                    <td align="left" valign="middle" class="style1">&nbsp;</td>
                    </tr>
                  <tr>
                    <td>&nbsp;</td>
                    <td height="30" align="left" valign="middle" class="style1">&nbsp;</td>
                    <td height="30" colspan="2" align="left" valign="middle" class="style1"><label>
                      <input type="hidden" name="MM_insert" value="form1" />
                      <input name="vid" type="hidden" value="<?php echo $vid; ?>" />
                      <input type="submit" name="submit" id="button" value="  Submit  " onclick="return validateForm();"/>
                      </label></td>
                    <td align="left" valign="middle" class="style1">&nbsp;</td>
                    </tr>
                  <tr>
                    <td>&nbsp;</td>
                    <td height="30">&nbsp;</td>
                    <td height="30" colspan="2">&nbsp;</td>
                    <td>&nbsp;</td>
                    </tr>
                  </table>
              </form>
           
          </td>
    </tr>
        <tr>
          <td height="60" align="right" valign="middle">&nbsp;</td>
        </tr>
    </table>
    </td>
    <td width="326" align="center" valign="top">
	
	
	
      </td>
  </tr>
</table></td>
  </tr>
</table>
<div align="center" style="display: block; position:absolute; text-align:center; bottom: 0; width: 100.00%; color: #CCC; clear: both; height:40px; background-repeat: repeat-x; border-right-width: 100px;  background-color:#333333; filter:alpha(opacity=75); opacity:0.90;"><br />
<span class="footer">All rights reserved. ® Acube Innovations Pvt Ltd. Phone: 0484 6066060.  Copyright © 2013. </span></div>

</body>
</html>
<?php
mysql_free_result($r_view_voucher);

mysql_free_result($r_vou_hd);

mysql_free_result($voucher);
?>
