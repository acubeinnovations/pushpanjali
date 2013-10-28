<?php header('Content-type: text/html; charset=utf-8');
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

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {
mysql_query("SET NAMES utf8");
  $updateSQL = sprintf("UPDATE pooja SET pooja=%s, rate=%s, bhogam_melsanthi=%s, bhogam_kazakam=%s WHERE id=%s",
                       GetSQLValueString($_POST['pooja'], "text"),
                       GetSQLValueString($_POST['rate'], "int"),
                       GetSQLValueString($_POST['bhogam_melsanthi'], "double"),
                       GetSQLValueString($_POST['bhogam_kazakam'], "double"),
                       GetSQLValueString($_POST['id'], "int"));

  mysql_select_db($database_pushpanjali, $pushpanjali);
  $Result1 = mysql_query($updateSQL, $pushpanjali) or die(mysql_error());

  $updateGoTo = "close.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $updateGoTo));
}
mysql_query("SET NAMES utf8");
mysql_select_db($database_pushpanjali, $pushpanjali);
$query_r_view_pooja = "SELECT * FROM pooja WHERE id='".$_GET['id']."'";
$r_view_pooja = mysql_query($query_r_view_pooja, $pushpanjali) or die(mysql_error());
$row_r_view_pooja = mysql_fetch_assoc($r_view_pooja);
$totalRows_r_view_pooja = mysql_num_rows($r_view_pooja);
 ?>
<style type="text/css">
<!--
.style1 {
	font-size: 14px;
	font-weight: bold;
}
-->
</style>
<body  bgcolor="#CCCCCC">
<br />
<form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
  <table width="80%" align="center">
    <tr valign="baseline">
      <td width="21%" height="30" align="left" nowrap="nowrap"><span class="style1">&#3370;&#3394;&#3356;</span></td>
      <td width="79%" height="30"><input type="text" name="pooja" value="<?php echo $row_r_view_pooja['pooja']; ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td height="30" align="left" nowrap="nowrap"><span class="style1">&#3376;&#3394;&#3370;</span></td>
      <td height="30"><input type="text" name="rate" value="<?php echo htmlentities($row_r_view_pooja['rate'], ENT_COMPAT, ''); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td height="30" align="left" nowrap="nowrap"><span class="style1 style3">&#3373;&#3403;&#3351;&#3330; &#3374;&#3399;&#3378;&#3405;&zwj;&#3382;&#3390;&#3368;&#3405;&#3364;&#3391;</span></td>
      <td height="30"><input type="text" name="bhogam_melsanthi" value="<?php echo htmlentities($row_r_view_pooja['bhogam_melsanthi'], ENT_COMPAT, ''); ?>" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td height="30" align="left" nowrap="nowrap"><span class="style1 style3">&#3373;&#3403;&#3351;&#3330; &#3349;&#3380;&#3349;&#3330;</span></td>
      <td height="30"><input type="text" name="bhogam_kazakam" value="<?php echo htmlentities($row_r_view_pooja['bhogam_kazakam'], ENT_COMPAT, ''); ?>" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td height="30" align="left" nowrap="nowrap">&nbsp;</td>
      <td height="30"><input type="submit" value="Update " /></td>
    </tr>
  </table>
  <input type="hidden" name="MM_update" value="form1" />
  <input type="hidden" name="id" value="<?php echo $row_r_view_pooja['id']; ?>" />
</form>
<p>&nbsp;</p>
</body>
<?php mysql_free_result($r_view_pooja);
?>
