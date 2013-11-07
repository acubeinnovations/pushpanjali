<?php 
 header('Content-type: text/html; charset=utf-8');
require_once('Connections/pushpanjali.php'); ?>
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
mysql_query("SET NAMES utf8");
mysql_select_db($database_pushpanjali, $pushpanjali);
$query_r_view_pooja = "SELECT * FROM pooja";
$r_view_pooja = mysql_query($query_r_view_pooja, $pushpanjali) or die(mysql_error());
$row_r_view_pooja = mysql_fetch_assoc($r_view_pooja);
$totalRows_r_view_pooja = mysql_num_rows($r_view_pooja);

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}
 if(isset($_POST['submit'])&& $_POST['pooja']!="") {
 if($_POST['rate']=="")
 {
 $_POST['rate']=0;
 }
 if($_POST['bhogam_melsanthi']=="")
 {
 $_POST['bhogam_melsanthi']=0;
 }
if($_POST['bhogam_kazakam']=="")
 {
 $_POST['bhogam_kazakam']=0;
 } 
  mysql_query("SET NAMES utf8");
	$insertSQL = sprintf("INSERT INTO pooja ( pooja, rate, bhogam_melsanthi, bhogam_kazakam) VALUES ( %s, %s, %s, %s)",
                       GetSQLValueString($_POST['pooja'], "text"),
                       GetSQLValueString($_POST['rate'], "int"),
                       GetSQLValueString($_POST['bhogam_melsanthi'], "double"),
                       GetSQLValueString($_POST['bhogam_kazakam'], "double"));


  mysql_select_db($database_pushpanjali, $pushpanjali);
  $Result1 = mysql_query($insertSQL, $pushpanjali) or die(mysql_error());
  header('Location:pooja.php');
    } ?>
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
/*function validateForm()
{
if(document.getElementById("pooja").value=="")
              {
			  //alert('hai');
                document.getElementById("d_pooja").innerHTML="Enter pooja !";
                document.getElementById("pooja").focus();
                return false;
              }
			  else
			  {
			  	document.getElementById("d_pooja").innerHTML="";	
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
			  
}*/
</script>


</head>

<body marginheight="0" marginwidth="0" topmargin="0" bottommargin="0" rightmargin="0" leftmargin="0">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td height="53" align="left" valign="top" background="images/bg.PNG"><table width="854" border="0" align="left" cellpadding="0" cellspacing="1">
      <tr class="menu">
        <td width="78" height="41" align="center" valign="middle"><a href="home.php" class="menu">Home</a></td>
        <td width="77" height="41" align="center" valign="middle"><a href="star.php" class="menu">Star</a></td>
        <td width="82" height="41" align="center" valign="middle"><a href="pooja.php" class="menu_active">Pooja</a></td>
        <td width="90" height="41" align="center" valign="middle"><a href="vazhipadu.php" class="menu">Vazhipadu</a></td>
        <td width="93" height="41" align="center" valign="middle"><a href="voucher.php" class="menu">Vouchers</a></td>
        <td width="75" height="41" align="center" valign="middle"><a href="report_sumup.php" class="menu">Report</a></td>
        <td width="127" height="41" align="center" valign="middle"><a href="logout.php" class="menu">Logout</a></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td height="400" align="left" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="70%" height="600" align="left" valign="top">
    <table width="855" border="0" align="right" cellpadding="0" cellspacing="0">
        <tr>
          <td width="489" height="60" align="center" valign="middle"><h1 class="pus">പുത്തന്‍കാവ് ചാരംപറമ്പ്‌ ഭഗവതി ക്ഷേത്രം</h1>            </td>
        </tr>
        <form id="form1" name="form1" method="post" action="pooja.php">
        <tr>
          <td height="30">
            
            
            <table width="855" border="0" align="right" cellpadding="0" cellspacing="0" style="border:1px solid #999999;">
              <tr>
                <td width="135" height="30" class="style2">&nbsp;</td>
                <td width="115" height="30" class="style2"><strong><span class="style1">പൂജ</span></strong></td>
                <td width="187" height="30" class="style2"><span class="style1">
                  <input type="text" name="pooja" id="pooja" />
                  </span></td>
                <td width="124" class="style2"><span class="style1">ഭോഗം മേല്‍ശാന്തി</span></td>
                <td width="149" class="style2"><span class="style1">
                  <input type="text" name="bhogam_melsanthi" />
                  </span></td>
                <td width="143" class="style2">&nbsp;</td>
                </tr>
              
              <tr>
                <td width="135" height="30" class="style2">&nbsp;</td>
                <td width="115" height="30" class="style2"><strong><span class="style1">രൂപ</span></strong></td>
                <td width="187" height="30" class="style2"><span class="style1">
                  <input name="rate" type="text" id="rate" />
                  </span></td>
                <td width="124" class="style2"><span class="style1">ഭോഗം കഴകം</span></td>
                <td width="149" class="style2"><span class="style1">
                <input type="text" name="bhogam_kazakam" />
                  </span></td>
                <td width="143" align="center" class="style2"><span class="style1">
                  <input name="submit" type="submit" class="style1" id="button" value="  Submit  "/>
                  </span></td>
                </tr>
              
              </table>
            
            
            </td>
        </tr> </form>
        <tr>
          <td height="30">
          <div id="report_div" style="overflow:scroll; height:400px;">
      <?php if ($totalRows_r_view_pooja > 0) { // Show if recordset not empty ?>
         
            <table width="838" border="0" align="right" cellpadding="0" cellspacing="0" style="border:1px solid #999999;">
              <tr>
                <td width="20" bgcolor="#F5F5F5" class="style2">&nbsp;</td>
                <td width="200" height="40" bgcolor="#F5F5F5" class="style2"><strong><span class="style1">പൂജ</span></strong></td>
                <td width="172" height="40" bgcolor="#F5F5F5" class="style2"><strong><span class="style1">രൂപ</span></strong></td>
                <td width="60" align="center" valign="middle" bgcolor="#F5F5F5" class="style2"><strong><span class="style1"> Edit</span></strong></td>
                <td width="60" align="center" valign="middle" bgcolor="#F5F5F5" class="style2"><strong><span class="style1">Delete</span></strong></td>
              </tr>
              <?php do { ?>
              <tr>
                <td width="20" class="style2">&nbsp;</td>
                <td width="200" height="30" class="style2"><span class="style1"><?php echo $row_r_view_pooja['pooja']; ?></span></td>
                <td width="172" height="30" class="style2"><span class="style1"><?php echo $row_r_view_pooja['rate']; ?></span></td>
                <td width="60" height="30" align="center" valign="middle" class="style2"><span class="style1"><a href="#" onclick="MM_openBrWindow('edit_pooja.php?id=<?php echo $row_r_view_pooja['id']; ?>','','width=450,height=300')"><img src="images/edit.png" width="20" border="0" /></a></span></td>
                <td width="60" height="30" align="center" valign="middle" class="style2"><span class="style1"><a href="delete_pooja.php?id=<?php echo $row_r_view_pooja['id']; ?>"><img src="images/delete.png" width="20" border="0" /></a></span></td>
              </tr>
              <?php } while ($row_r_view_pooja = mysql_fetch_assoc($r_view_pooja)); ?>
            </table>
          
          <?php } // Show if recordset not empty ?></div>
          </td>
          </tr>
      </table>
     
      </td>
    <td width="326" align="center" valign="top" bgcolor="#FFFFFF">&nbsp; 
    </td>
  </tr>
</table></td>
  </tr>
</table><div align="center" style="display: block; position:absolute; text-align:center; bottom: 0; width: 100.00%; color: #CCC; clear: both; height:40px; background-repeat: repeat-x; border-right-width: 100px;  background-color:#333333; filter:alpha(opacity=75); opacity:0.90;"><br />
<span class="footer">All rights reserved. ® Acube Innovations Pvt Ltd. Phone: 0484 6066060.  Copyright © 2013. </span></div>
</body>
</html>
<?php
mysql_free_result($r_view_pooja);
?>