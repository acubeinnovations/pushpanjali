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
$v_q=$_GET['q'];
$v_tdiv=$_GET['r'];
mysql_select_db($database_pushpanjali, $pushpanjali);
$query_r_load_star = "SELECT * FROM star WHERE   id ='$v_q'";
$r_load_star = mysql_query($query_r_load_star, $pushpanjali) or die(mysql_error());
$row_r_load_star = mysql_fetch_assoc($r_load_star);
$totalRows_r_load_star = mysql_num_rows($r_load_star);
 
?>
<input type="hidden" name="star[]" id="<?php echo $v_tdiv; ?>" value="<?php echo $row_r_load_star['id']; ?>" />
<input type="text" name="<?php echo $v_tdiv; ?>" id="star" value="<?php echo $row_r_load_star['starname']; ?>" onChange="loadtodiv(event,'load_star.php','<?php echo $v_tdiv; ?>');" />
<?php    
mysql_free_result($r_load_star);
?>
