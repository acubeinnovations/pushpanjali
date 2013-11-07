<?php require_once('Connections/pushpanjali.php');
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

mysql_select_db($database_pushpanjali, $pushpanjali);
$query_r_item = "SELECT * FROM voucher_head WHERE vou_hd_id='$v_vou'";
$r_item = mysql_query($query_r_item, $pushpanjali) or die(mysql_error());
$row_r_item = mysql_fetch_assoc($r_item);
$totalRows_r_item = mysql_num_rows($r_item);
echo $row_r_item['vou_head'];
mysql_free_result($r_item);
?>
