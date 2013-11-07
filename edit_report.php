<?php header('Content-type: text/html; charset=utf-8');
require_once('Connections/pushpanjali.php');
require_once('calendar/classes/tc_calendar.php'); ?>
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
echo $deleteSQL = "DELETE FROM vazhipadu WHERE receipt_number='".$_POST['receipt_number']."'";

  mysql_select_db($database_pushpanjali, $pushpanjali);
  $Result1 = mysql_query($deleteSQL, $pushpanjali) or die(mysql_error());
  
echo $deleteSQL = "DELETE FROM master WHERE type_id='".$_POST['receipt_number']."'";

  mysql_select_db($database_pushpanjali, $pushpanjali);
  $Result1 = mysql_query($deleteSQL, $pushpanjali) or die(mysql_error());

mysql_query("SET NAMES utf8");
	$v_name=$_POST['name'];
	$v_star=$_POST['star'];	
	$v_amount=$_POST['amount'];
	$v_total_amt=$v_amount*$v_numbr;
  $insertSQL = "INSERT INTO vazhipadu (name, star, amount, quantity, pooja, vazhipadu_date,booking_date,booking_to,receipt_number) VALUES" ;
  $v_q_string=array();
  for($i=0;$i<count($v_name);$i++)
	{
	if($v_name[$i]!="" && $v_star[$i]!="")
	{
  $v_q_string[]="('$v_name[$i]', '$v_star[$i]', '".$_POST['amount']."','$v_numbr', '".$_POST['pooja']."', '".$_POST['date']."',' $v_book_date',  '$v_book_to', '".$_POST['receipt_number']."')";
  }
 }
 	$insertSQL =$insertSQL .''.implode(",", $v_q_string);
	//echo $insertSQL;
 	mysql_select_db($database_pushpanjali, $pushpanjali);
  	$Result1 = mysql_query($insertSQL, $pushpanjali) or die(mysql_error());
  	$v_type_id=mysql_insert_id();
  	//print_r($v_type_id);
  	$v_q_string1=array();
  	mysql_query("SET NAMES utf8");
  	$insertSQL1 = "INSERT INTO master (type, type_id, `date`, cr) VALUES ";
  	for($j=0;$j<count($v_name);$j++)
	{
	if($v_name[$j]!="" && $v_star[$j]!="")
	{
  $v_q_string1[]="('vazhipadu','$v_receipt_no' , '".$_POST['date']."', '$v_total_amt')";
  $v_type_id=$v_type_id+1;
  }
  }
  $insertSQL1 =$insertSQL1 .''.implode(",", $v_q_string1);
  mysql_select_db($database_pushpanjali, $pushpanjali);
  $Result11 = mysql_query($insertSQL1, $pushpanjali) or die(mysql_error());

  $updateGoTo = "close.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }
  //header(sprintf("Location: %s", $updateGoTo));
}
mysql_query("SET NAMES utf8");
mysql_select_db($database_pushpanjali, $pushpanjali);
$query_r_view_pooja = "SELECT * FROM pooja";
$r_view_pooja = mysql_query($query_r_view_pooja, $pushpanjali) or die(mysql_error());
$row_r_view_pooja = mysql_fetch_assoc($r_view_pooja);
$totalRows_r_view_pooja = mysql_num_rows($r_view_pooja);

mysql_query("SET NAMES utf8");
mysql_select_db($database_pushpanjali, $pushpanjali);
$query_r_edit_report = "SELECT * FROM vazhipadu  WHERE  receipt_number='".$_GET['r_no']."'";
$r_edit_report = mysql_query($query_r_edit_report, $pushpanjali) or die(mysql_error());
$row_r_edit_report = mysql_fetch_assoc($r_edit_report);
$totalRows_r_edit_report = mysql_num_rows($r_edit_report);
mysql_query("SET NAMES utf8");
mysql_select_db($database_pushpanjali, $pushpanjali);
$query_r_view_star = "SELECT * FROM star";
$r_view_star = mysql_query($query_r_view_star, $pushpanjali) or die(mysql_error());
$row_r_view_star = mysql_fetch_assoc($r_view_star);
$totalRows_r_view_star = mysql_num_rows($r_view_star);

?>
<link href="*.css" rel="stylesheet" type="text/css" />
<link href="style.css" rel="stylesheet" type="text/css" />
<link href="print.css" rel="stylesheet" type="text/css" />

<link href="calendar/calendar.css" rel="stylesheet" type="text/css" />
<script language="javascript" src="calendar/calendar.js"></script>
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
			getData( apage +"?q=" + input.value+"&r=" +tdiv,tdiv);
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


function showMe () {
if(document.getElementById("booking").checked == true)
{
document.getElementById("div2").style.display = "none";
document.getElementById("div1").style.display = "";;
}
else
{
document.getElementById("div2").style.display = "";
document.getElementById("div1").style.display = "none";
}
    
}
</script><br>
<br>
<br>

<form method="post" name="form1" action="<?php echo $editFormAction; ?>">

<table width="700" border="0" align="center" cellpadding="0" cellspacing="0" style="border:1px solid #999999;">
  <tr>
    <td width="48" height="30" align="left" valign="middle">&nbsp;</td>
    <td width="111" height="30" align="left" valign="middle" class="style1">പൂജ</td>
    <td width="186" height="30" align="left" valign="middle" class="style1"><span class="error">
      <select name="pooja" id="pooja"  onchange="loadtodiv1(event,'rate.php','rate')">
        <?php
do {  
?>
        <option value="<?php echo $row_r_view_pooja['id']?>"<?php if (!(strcmp($row_r_view_pooja['id'], $row_r_edit_report['pooja']))) {echo "selected=\"selected\"";} ?>><?php echo $row_r_view_pooja['pooja']?></option>
        <?php
} while ($row_r_view_pooja = mysql_fetch_assoc($r_view_pooja));
  $rows = mysql_num_rows($r_view_pooja);
  if($rows > 0) {
      mysql_data_seek($r_view_pooja, 0);
	  $row_r_view_pooja = mysql_fetch_assoc($r_view_pooja);
  }
?>
      </select>
    </span></td>
    <td width="147" height="30" align="left" valign="middle" class="style1"><span class="error" id="error1">
      <label></label>
    </span></td>
    <td width="91" align="left" valign="middle" class="style1">Booking</td>
    <td width="90" align="left" valign="middle" class="style1"><input name="booking" type="checkbox" id="booking"  onclick="showMe();" value="1" />    </td>
    <td width="175" align="left" valign="middle" class="style1">&nbsp;</td>
  </tr>
  <tr>
    <td width="48" height="30" align="left" valign="middle">&nbsp;</td>
    <td height="30" align="left" valign="middle" class="style1">രൂപാ</td>
    <td height="30" align="left" valign="middle" class="style1"><div id="rate"><input type="text" name="amount" value="<?php echo htmlentities($row_r_edit_report['amount'], ENT_COMPAT, ''); ?>" size="32" ></div></td>
    <td width="147" height="30" align="left" valign="middle" class="style1">&nbsp;</td>
    <td width="91" align="left" valign="middle" class="style1">തിയതി</td>
    <td colspan="2" align="left" valign="middle" class="style1">
    <div id="div1" style="display:none">From &nbsp;&nbsp;&nbsp;<?php
			  $myCalendar = new tc_calendar("bck_date", true, false);
			  $myCalendar->setIcon("calendar/images/iconCalendar.gif");
			  $myCalendar->setDate(date('d'), date('m'), date('Y'));
			  $myCalendar->setPath("calendar/");
			  $myCalendar->setYearInterval(date('Y'), 2020);
			  $myCalendar->dateAllow(date('Y-m-d'), '2015-03-01');
			  $myCalendar->setDateFormat('j F Y');
			  $myCalendar->writeScript();
		  ?></br><br />

          To&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php
			  $myCalendar = new tc_calendar("bck_to_date", true, false);
			  $myCalendar->setIcon("calendar/images/iconCalendar.gif");
			  $myCalendar->setDate(date('d'), date('m'), date('Y'));
			  $myCalendar->setPath("calendar/");
			  $myCalendar->setYearInterval(date('Y'), 2020);
			  $myCalendar->dateAllow(date('Y-m-d'), '2015-03-01');
			  $myCalendar->setDateFormat('j F Y');
			  $myCalendar->writeScript();
		  ?><br />
          </div>
    <div id="div2" ><?php if($row_r_edit_report['booking_date']=="0000-00-00") {?><input name="date" type="text" id="date" value="<?php echo htmlentities($row_r_edit_report['vazhipadu_date'], ENT_COMPAT, ''); ?>" size="32">
    <?php } else {?>
	<input name="bck_date" type="text" value="<?php echo $row_r_edit_report['booking_date']; ?>"><br>
<input name="bck_to_date" type="text" value="<?php echo $row_r_edit_report['booking_to']; ?>"><?php }?></div>  </td>
  </tr>
  <?php do { ?>
  <tr>
    <td width="48" height="30" align="left" valign="middle">&nbsp;</td>
    <td height="30" align="left" valign="middle" class="style1">പേര്</td>
    <td height="30" align="left" valign="middle" class="style1"><label></label>    <input type="text" name="name[]" value="<?php echo $row_r_edit_report['name']; ?>" size="32"></td>
    <td width="147" height="30" align="left" valign="middle" class="style1"><span class="error" id="error2"></span></td>
    <td width="91" align="left" valign="middle" class="style1">നക്ഷത്രം</td>
    <td align="left" valign="middle" class="style1"><span class="error">
      <select name="star[]" id="star">
        <?php
do {  
?>
        <option value="<?php echo $row_r_view_star['id']?>"<?php if (!(strcmp($row_r_view_star['id'], $row_r_edit_report['star']))) {echo "selected=\"selected\"";} ?>><?php echo $row_r_view_star['starname']?></option>
        <?php
} while ($row_r_view_star = mysql_fetch_assoc($r_view_star));
  $rows = mysql_num_rows($r_view_star);
  if($rows > 0) {
      mysql_data_seek($r_view_star, 0);
	  $row_r_view_star = mysql_fetch_assoc($r_view_star);
  }
?>
      </select>
    </span></td>
    <td align="left" valign="middle" class="style1"><span class="error" id="error3">
      <label></label>
    </span></td>
  </tr><input type="text" name="receipt_number" id="receipt_number" value="<?php echo $row_r_edit_report['receipt_number']; ?>"><?php } while ($row_r_edit_report = mysql_fetch_assoc($r_edit_report));?>
  <tr>
    <td width="48" height="60" align="left" valign="middle"></td>
    <td height="30" align="left" valign="middle" class="style1"></td>
    <td height="30" align="left" valign="middle" class="style1"><label>
      <input name="submit" type="submit" class="style1" id="button" value="  Submit  "  onclick="return ValidateForm();" tabindex="10"/>
    </label></td>
    <td width="147" height="30" align="left" valign="middle" class="style1">&nbsp;</td>
    <td width="91" align="left" valign="middle" class="style1">&nbsp;</td>
    <td width="90" align="left" valign="middle" class="style1">&nbsp;</td>
    <td width="175" align="left" valign="middle" class="style1">&nbsp;</td>
  </tr>
</table>  
<input type="hidden" name="MM_update" value="form1">
  <input type="hidden" name="receipt_number" value="<?php echo $row_r_edit_report['receipt_number']; ?>">
</form>
<p>&nbsp;</p>
</body>
<?php 
mysql_free_result($r_edit_report);

mysql_free_result($r_view_star);


mysql_free_result($r_view_pooja);
?>
