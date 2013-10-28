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
$query_r_view_inc_star = "SELECT starname FROM star WHERE id='$v_star'";
$r_view_inc_star = mysql_query($query_r_view_inc_star, $pushpanjali) or die(mysql_error());
$row_r_view_inc_star = mysql_fetch_assoc($r_view_inc_star);
$totalRows_r_view_inc_star = mysql_num_rows($r_view_inc_star);
$v_starname=$row_r_view_inc_star['starname'];
mysql_free_result($r_view_inc_star);
?>