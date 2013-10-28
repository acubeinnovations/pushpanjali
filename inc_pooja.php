
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
$query_r_view_inc_pooja = "SELECT pooja FROM pooja WHERE id='$v_pooja_id'";
$r_view_inc_pooja = mysql_query($query_r_view_inc_pooja, $pushpanjali) or die(mysql_error());
$row_r_view_inc_pooja = mysql_fetch_assoc($r_view_inc_pooja);
$totalRows_r_view_inc_pooja = mysql_num_rows($r_view_inc_pooja);
$v_pooja_name=$row_r_view_inc_pooja['pooja'];
mysql_free_result($r_view_inc_pooja);
?>