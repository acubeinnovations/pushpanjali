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

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if (isset($_GET['id'])) {
  $updateSQL = sprintf("UPDATE vazhipadu SET status=%s WHERE id=%s",
                       GetSQLValueString(1, "int"),
                       GetSQLValueString($_GET['id'], "int"));

  mysql_select_db($database_pushpanjali, $pushpanjali);
  $Result1 = mysql_query($updateSQL, $pushpanjali) or die(mysql_error());
  
  $updateSQL1 = sprintf("UPDATE master SET status=%s WHERE type_id=%s AND type=%s",
                       GetSQLValueString(1, "int"),
                       GetSQLValueString($_GET['id'], "int"),
					   GetSQLValueString('vazhipadu', "text"));

  mysql_select_db($database_pushpanjali, $pushpanjali);
  $Result1 = mysql_query($updateSQL1, $pushpanjali) or die(mysql_error()); 


  $updateGoTo = "report_sumup.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $updateGoTo));
}

?>
