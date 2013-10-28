<?php require_once('Connections/pushpanjali.php'); ?>
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

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
  $insertSQL = sprintf("INSERT INTO voucher_head (vou_hd_id, vou_head) VALUES (%s, %s)",
                       GetSQLValueString($_POST['vou_hd_id'], "int"),
                       GetSQLValueString($_POST['vou_head'], "text"));

  mysql_select_db($database_pushpanjali, $pushpanjali);
  $Result1 = mysql_query($insertSQL, $pushpanjali) or die(mysql_error());

  $insertGoTo = "new_head.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
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
 </script>
</head>
<body marginheight="0" marginwidth="0" topmargin="0" bottommargin="0" rightmargin="0" leftmargin="0">
  <div id="divToPrint" style="display:none;" >
      <table width="275" border="0" align="center" cellpadding="0" cellspacing="0">
       <tr>
        <td height="40" align="left"><span class="style3"><strong>തിയതി</strong></span></td>
        <td height="40"><span class="style3">
          <?php if (isset($_POST['date'])) {echo $_POST['date']; }?>
        </span></td>
      </tr>
      <tr>
        <td width="102" height="40" align="left"><span class="style2">പേര്</span></td>
        <td width="173" height="40"><span class="style3">
          <?php if (isset($_POST['name'])) {echo $_POST['name'];}?>
        </span></td>
      </tr>
      <tr>
        <td height="40" align="left"><span class="style1">വിലാസം</span></td>
        <td height="40"><span class="style3">
          <?php if (isset($_POST['address'])) {echo $_REQUEST['address'];} ?>
        </span></td>
      </tr>
      <tr>
        <td height="40" align="left"><span class="style1">ആവശ്യം</span></td>
        <td height="40"><span class="style3">
          <?php if (isset($_POST['purpose'])) {echo $_REQUEST['purpose'];} ?>
        </span></td>
      </tr>
      <tr>
        <td height="40" align="left"><span class="style1">രൂപ</span></td>
        <td height="40"><span class="style3">
          <?php if (isset($_POST['amount'])) {echo $_REQUEST['amount'];} ?>
        </span></td>
      </tr>
      <tr>
        
      </tr>
    </table>
    </div>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td height="53" align="left" valign="top" background="images/bg.PNG"><table width="853" border="0" align="left" cellpadding="0" cellspacing="1">
       <tr class="menu">
        <td width="74" height="41" align="center" valign="middle"><a href="home.php" class="menu">Home</a></td>
        <td width="73" height="41" align="center" valign="middle"><a href="star.php" class="menu">Star</a></td>
        <td width="76" height="41" align="center" valign="middle"><a href="pooja.php" class="menu">Pooja</a></td>
        <td width="102" height="41" align="center" valign="middle"><a href="vazhipadu.php" class="menu">Vazhipadu</a></td>
        <td width="107" height="41" align="center" valign="middle"><a href="voucher.php" class="menu_active">Vouchers</a></td>
        <td width="112" height="41" align="center" valign="middle"><a href="report.php" class="menu">Report</a></td>
        <td width="173" align="center" valign="middle"><a href="report_summary.php"  class="menu">Report summary</a></td>
        <td width="127" height="41" align="center" valign="middle"><a href="logout.php" class="menu">Logout</a></td>
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
          <td height="60" align="right" valign="middle">&nbsp;
            <form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
              <table width="441" align="center">
                <tr valign="baseline">
                  <td width="182" height="30" align="left" valign="middle" nowrap="nowrap"><span class="style1">Voucher Head</span></td>
                  <td width="247" height="30" align="left" valign="middle"><span class="style1">
                    <input type="text" name="vou_head" value="" size="32" />
                  </span></td>
                </tr>
                <tr valign="baseline">
                  <td height="30" align="left" valign="middle" nowrap="nowrap">&nbsp;</td>
                  <td height="30" align="left" valign="middle"><span class="style1">
                    <input type="submit" value="Insert record" />
                  </span></td>
                </tr>
              </table>
              <input type="hidden" name="vou_hd_id" value="" />
              <input type="hidden" name="MM_insert" value="form1" />
            </form>
            <p>&nbsp;</p></td>
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
?>
