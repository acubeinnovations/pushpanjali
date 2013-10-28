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
  $updateSQL = sprintf("UPDATE star SET starname=%s WHERE id=%s",
                       GetSQLValueString($_POST['starname'], "text"),
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
$query_r_select_star = "SELECT * FROM star WHERE id='".$_GET['id']."'";
$r_select_star = mysql_query($query_r_select_star, $pushpanjali) or die(mysql_error());
$row_r_select_star = mysql_fetch_assoc($r_select_star);
$totalRows_r_select_star = mysql_num_rows($r_select_star); 
?>
<br />
<br />
<style type="text/css">
<!--
.style1 {font-size: 14px}
-->
</style>
<body  bgcolor="#CCCCCC">
<form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
  <table width="80%" align="center" >
    <tr valign="baseline">
      <td height="30" colspan="2" align="left" nowrap="nowrap">&nbsp;</td>
    </tr>
    <tr valign="baseline">
      <td width="24%" height="30" align="left" nowrap="nowrap"><h2 class="style1">നക്ഷത്രം</h2></td>
      <td width="76%" height="30"><input type="text" name="starname" value="<?php echo $row_r_select_star['starname']; ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td height="30" align="right" nowrap="nowrap">&nbsp;</td>
      <td height="30"><input type="submit" value="Edit" /></td>
    </tr>
  </table>
  <input type="hidden" name="MM_update" value="form1" />
  <input type="hidden" name="id" value="<?php echo $row_r_select_star['id']; ?>" />
</form>
</body><?php
mysql_free_result($r_select_star);
?>
