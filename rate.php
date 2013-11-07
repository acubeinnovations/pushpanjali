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
mysql_select_db($database_pushpanjali, $pushpanjali);
$query_r_view_rate = "SELECT * FROM pooja WHERE id ='$v_q'";
$r_view_rate = mysql_query($query_r_view_rate, $pushpanjali) or die(mysql_error());
$row_r_view_rate = mysql_fetch_assoc($r_view_rate);
$totalRows_r_view_rate = mysql_num_rows($r_view_rate);
if($row_r_view_rate['rate']==0)
{
 ?><table width="200" border="0">
  <tr>
    <td><input name="amount" type="text" id="amount" value="<?php echo $row_r_view_rate['rate']; ?>" size="18"/></td>
    <td><span class="error">**editable</span></td>
  </tr>
</table><?php
}
else
{
 ?><table width="200" border="0">
  <tr>
    <td><input name="amount" type="text" id="amount" value="<?php echo $row_r_view_rate['rate']; ?>" size="18" readonly="readonly"/></td>
    <td><span class="error">**uneditable</span></td>
  </tr>
</table>  
<?php } mysql_free_result($r_view_rate);
?>

