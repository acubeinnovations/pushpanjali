<?php require_once('Connections/pushpanjali.php'); ?>
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

mysql_select_db($database_pushpanjali, $pushpanjali);
$query_r_view_report = "SELECT DISTINCT date FROM master";
$r_view_report = mysql_query($query_r_view_report, $pushpanjali) or die(mysql_error());
$row_r_view_report = mysql_fetch_assoc($r_view_report);
$totalRows_r_view_report = mysql_num_rows($r_view_report);
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
<table width="80%" border="1">
  <tr>
    <td>Date</td>
    <td>type</td>
    <td>type_id</td>
    <td>date</td>
    <td>cr</td>
    <td>dr</td>
    <td>status</td>
  </tr>
  <?php do { ?>
    <tr>
      <td><?php echo $row_r_view_report['date']; ?></td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <?php } while ($row_r_view_report = mysql_fetch_assoc($r_view_report)); ?>
</table>
</body>
</html>
<?php
mysql_free_result($r_view_report);
?>
