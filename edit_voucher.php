<?php header('Content-type: text/html; charset=utf-8');
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

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {
  $updateSQL = sprintf("UPDATE voucher SET voucher_date=%s, name=%s, address=%s, purpose=%s, amount=%s WHERE id=%s",
                       GetSQLValueString($_POST['date'], "date"),
                       GetSQLValueString($_POST['name'], "text"),
                       GetSQLValueString($_POST['address'], "text"),
                       GetSQLValueString($_POST['purpose'], "text"),
                       GetSQLValueString($_POST['amount'], "int"),
                       GetSQLValueString($_POST['id'], "int"));

  mysql_select_db($database_pushpanjali, $pushpanjali);
  $Result1 = mysql_query($updateSQL, $pushpanjali) or die(mysql_error());

  $updateSQL1 = sprintf("UPDATE master SET `date`=%s, dr=%s WHERE type_id=%s AND type=%s",
                       GetSQLValueString($_POST['date'], "date"),
                       GetSQLValueString($_POST['amount'], "int"),
                       GetSQLValueString($_POST['id'], "int"),
					   GetSQLValueString('voucher', "text"));

  mysql_select_db($database_pushpanjali, $pushpanjali);
  $Result1 = mysql_query($updateSQL1, $pushpanjali) or die(mysql_error()); 
  
  $updateGoTo = "close.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $updateGoTo));
}


 
  
mysql_query("SET NAMES utf8");
mysql_select_db($database_pushpanjali, $pushpanjali);
$query_r_view_voucher = "SELECT * FROM voucher WHERE id='".$_GET['id']."'";
$r_view_voucher = mysql_query($query_r_view_voucher, $pushpanjali) or die(mysql_error());
$row_r_view_voucher = mysql_fetch_assoc($r_view_voucher);
$totalRows_r_view_voucher = mysql_num_rows($r_view_voucher);

mysql_free_result($r_view_voucher);
?>

<link href="calendar/calendar.css" rel="stylesheet" type="text/css" />
<script language="javascript" src="calendar/calendar.js"></script>
<style type="text/css">
<!--
.style1 {font-size: 14px}
-->
</style>
<body  bgcolor="#CCCCCC">
<p>&nbsp;</p>
<p>&nbsp;</p>
<form method="post" name="form1" action="<?php echo $editFormAction; ?>">
  <table width="80%" align="center">
    <tr valign="baseline">
      <td height="30" align="left" valign="middle" nowrap><span class="style1">&#3364;&#3391;&#3375;&#3364;&#3391;</span></td>
      <td height="30"> 
      <?php $ad_date=$row_r_view_voucher['voucher_date'];
       $date=explode('-',$ad_date);
	  $myCalendar = new tc_calendar("date", true, false);
	  $myCalendar->setIcon("calendar/images/iconCalendar.gif");
	  $myCalendar->setDate($date[2],$date[1],$date[0]);
	  $myCalendar->setPath("calendar/");
	  $myCalendar->setYearInterval(2000, 2015);
	  $myCalendar->dateAllow('2008-05-13', '2015-03-01');
	  $myCalendar->setDateFormat('j F Y');
	  $myCalendar->writeScript();
	  ?></td>
    </tr>
    <tr valign="baseline">
      <td height="30" align="left" valign="middle" nowrap><span class="style1">&#3370;&#3399;&#3376;&#3405;</span></td>
      <td height="30"><input type="text" name="name" value="<?php echo $row_r_view_voucher['name']; ?>" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td height="30" align="left" valign="middle" nowrap><span class="style1">&#3381;&#3391;&#3378;&#3390;&#3384;&#3330;</span></td>
      <td height="30"><input type="text" name="address" value="<?php echo $row_r_view_voucher['address']; ?>" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td height="30" align="left" valign="middle" nowrap><span class="style1">&#3334;&#3381;&#3382;&#3405;&#3375;&#3330;</span></td>
      <td height="30"><input type="text" name="purpose" value="<?php echo $row_r_view_voucher['purpose']; ?>" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td height="30" align="left" valign="middle" nowrap><span class="style1">&#3376;&#3394;&#3370;</span></td>
      <td height="30"><input type="text" name="amount" value="<?php echo $row_r_view_voucher['amount']; ?>" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td height="30" align="left" valign="middle" nowrap>&nbsp;</td>
      <td height="30"><input type="submit" value="Update "></td>
    </tr>
  </table>
  <input type="hidden" name="MM_update" value="form1">
  <input type="hidden" name="id" value="<?php echo $row_r_view_voucher['id']; ?>">
</form>
<p>&nbsp;</p>
</body>