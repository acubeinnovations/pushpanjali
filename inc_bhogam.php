
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
$v_amount_bhogam=array();
 $v_amounr_kahakam=array();
mysql_select_db($database_pushpanjali, $pushpanjali);
$query_r_view_bhogam = "SELECT DISTINCT pooja FROM vazhipadu WHERE vazhipadu_date='$v_date'";
$r_view_bhogam = mysql_query($query_r_view_bhogam, $pushpanjali) or die(mysql_error());
$row_r_view_bhogam = mysql_fetch_assoc($r_view_bhogam);
$totalRows_r_view_bhogam = mysql_num_rows($r_view_bhogam);


do {
mysql_select_db($database_pushpanjali, $pushpanjali);
$query_r_view_amt = "SELECT pooja.rate, pooja.bhogam_melsanthi, pooja.bhogam_kazakam,COUNT(vazhipadu.pooja) FROM pooja,vazhipadu  WHERE pooja.pooja='".$row_r_view_bhogam['pooja']."' AND vazhipadu.pooja='".$row_r_view_bhogam['pooja']."' AND vazhipadu.vazhipadu_date='$v_date'";
$r_view_amt = mysql_query($query_r_view_amt, $pushpanjali) or die(mysql_error());
$row_r_view_amt = mysql_fetch_assoc($r_view_amt);
$totalRows_r_view_amt = mysql_num_rows($r_view_amt);
} while ($row_r_view_bhogam = mysql_fetch_assoc($r_view_bhogam)); 
do { 
$v_pooja_rate=$row_r_view_amt['rate']; 
$v_bhogam=$row_r_view_amt['bhogam_melsanthi']; 
$v_kahakam=$row_r_view_amt['bhogam_kazakam']; 
 $v_count_pooja=$row_r_view_amt['COUNT(vazhipadu.pooja)'];
	  $v_amount_bhogam[]=$v_count_pooja*$v_bhogam;
	  $v_amounr_kahakam[]=$v_kahakam*$v_count_pooja;
	 
	   } while ($row_r_view_amt = mysql_fetch_assoc($r_view_amt));
	   
mysql_free_result($r_view_bhogam);

mysql_free_result($r_view_amt);
?>
