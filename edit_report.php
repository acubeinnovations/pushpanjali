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
  $updateSQL = sprintf("UPDATE vazhipadu SET name=%s, star=%s, amount=%s, pooja=%s, vazhipadu_date=%s WHERE id=%s",
                       GetSQLValueString($_POST['name'], "text"),
                       GetSQLValueString($_POST['star'], "text"),
                       GetSQLValueString($_POST['amount'], "int"),
                       GetSQLValueString($_POST['pooja'], "text"),
                       GetSQLValueString($_POST['vazhipadu_date'], "date"),
                       GetSQLValueString($_POST['id'], "int"));

  mysql_select_db($database_pushpanjali, $pushpanjali);
  $Result1 = mysql_query($updateSQL, $pushpanjali) or die(mysql_error());
  
  $updateSQL1 = sprintf("UPDATE master SET `date`=%s, cr=%s WHERE type_id=%s AND type=%s",
                       GetSQLValueString($_POST['vazhipadu_date'], "date"),
                       GetSQLValueString($_POST['amount'], "int"),
                       GetSQLValueString($_POST['id'], "int"),
					   GetSQLValueString('vazhipadu', "text"));

  mysql_select_db($database_pushpanjali, $pushpanjali);
  $Result1 = mysql_query($updateSQL1, $pushpanjali) or die(mysql_error()); 
  
  $updateGoTo = "close.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $updateGoTo));
}
mysql_query("SET NAMES utf8");
mysql_select_db($database_pushpanjali, $pushpanjali);
$query_r_edit_report = "SELECT * FROM vazhipadu  WHERE id='".$_GET['id']."'";
$r_edit_report = mysql_query($query_r_edit_report, $pushpanjali) or die(mysql_error());
$row_r_edit_report = mysql_fetch_assoc($r_edit_report);
$totalRows_r_edit_report = mysql_num_rows($r_edit_report);

?>
<style type="text/css">
<!--
.style1 {font-size: 14px}
-->
</style>
<script type="text/javascript">
var XMLHttpRequestObject = false; 

      if (window.XMLHttpRequest) {
        XMLHttpRequestObject = new XMLHttpRequest();
      } else if (window.ActiveXObject) {
        XMLHttpRequestObject = new ActiveXObject("Microsoft.XMLHTTP");
      }

function getData(dataSource,tdiv)
{
if(XMLHttpRequestObject) {
	XMLHttpRequestObject.open("GET", dataSource);
	XMLHttpRequestObject.onreadystatechange = function()
	{
		if (XMLHttpRequestObject.readyState == 4 &&
		XMLHttpRequestObject.status == 200) {
				var targetDiv = document.getElementById(tdiv);
				targetDiv.innerHTML = XMLHttpRequestObject.responseText;
			}
	}
XMLHttpRequestObject.send(null);
}
}

function loadtodiv(keyEvent,apage,tdiv)
{
//alert(keyEvent);
	keyEvent = (keyEvent) ? keyEvent: window.event;
	input = (keyEvent.target) ? keyEvent.target :
		keyEvent.srcElement;
	if (keyEvent.type == "change") {
		var targetDiv = document.getElementById(tdiv);
		targetDiv.innerHTML = "<div></div>";
		if (input.value) {
			getData( apage +"?q=" + input.value,tdiv);
		}
	}
}
function loadtodiv1(keyEvent,apage,tdiv)
{
//alert(keyEvent);
	keyEvent = (keyEvent) ? keyEvent: window.event;
	input = (keyEvent.target) ? keyEvent.target :
		keyEvent.srcElement;
	if (keyEvent.type == "change") {
		var targetDiv = document.getElementById(tdiv);
		targetDiv.innerHTML = "<div></div>";
		if (input.value) {
			getData( apage +"?q=" + input.value,tdiv);
		}
	}

}
</script>
<body  bgcolor="#CCCCCC">
<form method="post" name="form1" action="<?php echo $editFormAction; ?>">
  <p><br>
    <br>
  </p>
  <table width="80%" align="center">
    <tr valign="baseline">
      <td height="30" align="left" valign="middle" nowrap><span class="style1">&#3370;&#3399;&#3376;&#3405;</span></td>
      <td height="30"><input type="text" name="name" value="<?php echo $row_r_edit_report['name']; ?>" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td height="30" align="left" valign="middle" nowrap><span class="style1">&#3368;&#3349;&#3405;&#3383;&#3364;&#3405;&#3376;&#3330;</span></td>
      <td height="30">
      	<div id="star" name="star">
        	<input type="text" name="star" value="<?php echo $row_r_edit_report['star']; ?>" size="32" onChange="loadtodiv(event,'load_star.php','star')">
         </div>
      </td>
    </tr>
    <tr valign="baseline">
      <td height="30" align="left" valign="middle" nowrap><span class="style1">&#3370;&#3394;&#3356;</span></td>
      <td height="30"><input type="text" name="pooja" value="<?php echo $row_r_edit_report['pooja']; ?>" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td height="30" align="left" valign="middle" nowrap><span class="style1">&#3376;&#3394;&#3370;</span></td>
      <td height="30"><input type="text" name="amount" value="<?php echo $row_r_edit_report['amount']; ?>" size="32"></td>
    </tr>
   <!-- <tr valign="baseline">
      <td nowrap align="right">Vazhipadu_date:</td>
      <td></td>
    </tr>--><input type="hidden" name="vazhipadu_date" value="<?php echo $row_r_edit_report['vazhipadu_date']; ?>" size="32">
    <tr valign="baseline">
      <td height="30" align="left" valign="middle" nowrap><span class="style1"></span></td>
      <td height="30"><input type="submit" value="Update"></td>
    </tr>
  </table>
  <input type="hidden" name="MM_update" value="form1">
  <input type="hidden" name="id" value="<?php echo $row_r_edit_report['id']; ?>">
</form>
<p>&nbsp;</p>
</body><?php 
mysql_free_result($r_edit_report);

?>
