<?php header('Content-type: text/html; charset=utf-8');
require_once('Connections/pushpanjali.php'); 
  require_once('calendar/classes/tc_calendar.php');

 $v_print=0;
 
mysql_select_db($database_pushpanjali, $pushpanjali);
$query_r_view_receipt_no = "SELECT MAX(receipt_number) FROM vazhipadu";
$r_view_receipt_no = mysql_query($query_r_view_receipt_no, $pushpanjali) or die(mysql_error());
$row_r_view_receipt_no = mysql_fetch_assoc($r_view_receipt_no);
$totalRows_r_view_receipt_no = mysql_num_rows($r_view_receipt_no);
$v_receipt_no=$row_r_view_receipt_no['MAX(receipt_number)']+1;

 mysql_query("SET NAMES utf8");
mysql_select_db($database_pushpanjali, $pushpanjali);
$query_r_select_pooja = "SELECT * FROM pooja";
$r_select_pooja = mysql_query($query_r_select_pooja, $pushpanjali) or die(mysql_error());
$row_r_select_pooja = mysql_fetch_assoc($r_select_pooja);
$totalRows_r_select_pooja = mysql_num_rows($r_select_pooja);

mysql_select_db($database_pushpanjali, $pushpanjali);
$query_r_view_star = "SELECT * FROM star";
$r_view_star = mysql_query($query_r_view_star, $pushpanjali) or die(mysql_error());
$row_r_view_star = mysql_fetch_assoc($r_view_star);
$totalRows_r_view_star = mysql_num_rows($r_view_star);
if(isset($_POST['submit'])&& $_POST['name']!="") {

	 date_default_timezone_set("Asia/Calcutta");
  //INSERT Operation
   $date=date('Y-m-d');
   
   if($_POST['bck_date']!=$date)
   {
   $v_book_date=$_POST['bck_date'];
   }
   else
   {
   $v_book_date=NULL;
   }
    mysql_query("SET NAMES utf8");
	$v_name=$_POST['name'];
	$v_star=$_POST['star'];	
	if(isset($_POST['pooja'])&& isset($_POST['amount'])&& isset($_POST['name']))
	{
	
  $insertSQL = "INSERT INTO vazhipadu (name, star, amount, pooja, vazhipadu_date,booking_date,receipt_number) VALUES" ;
  $v_q_string=array();
  for($i=0;$i<count($v_name);$i++)
	{
	if($v_name[$i]!="" && $v_star[$i]!="")
	{
  $v_q_string[]="('$v_name[$i]', '$v_star[$i]', '".$_POST['amount']."', '".$_POST['pooja']."', '".$_POST['date']."',' $v_book_date', '$v_receipt_no')";
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
  $v_q_string1[]="('vazhipadu','$v_type_id' , '".$_POST['date']."', '".$_POST['amount']."')";
  $v_type_id=$v_type_id+1;
  }
  }
  $insertSQL1 =$insertSQL1 .''.implode(",", $v_q_string1);
  mysql_select_db($database_pushpanjali, $pushpanjali);
  $Result11 = mysql_query($insertSQL1, $pushpanjali) or die(mysql_error());
   $v_print=1;
 
	
}
	 else
	 {
	 header("Location:vazhipadu.php?emsg=Selelct pooja");
	 }  
 	}
  ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<style type="text/css">
<!--
.pus {
	color: #C00;
}
-->
</style>
<title>Puthankavu Charaparambu Bhagavathi Kshetram</title>
<script src="AIRAliases.js" type="text/javascript"></script>
<script src="printing-air.js" type="text/javascript">
<script type="text/javascript">
<!--
function MM_openBrWindow(theURL,winName,features) { //v2.0
  window.open(theURL,winName,features);
}
//-->
function ValidateForm()
{
if(document.getElementById("amount").value=="")

              {
			 
                document.getElementById("d_pooja").innerHTML="select pooja !";
                return false;
              }
			 
if(document.getElementById("name1").value=="")

              {
			 
                document.getElementById("d_name").innerHTML="Enter name !";
                document.getElementById("name").focus();
                return false;
              }
			 

else if(document.getElementById("star").value<=0 )
              {
			 document.getElementById("d_name").innerHTML="";	
				document.getElementById("d_pooja1").innerHTML="";
                document.getElementById("d_star").innerHTML="Enter star !";
                document.getElementById("star").focus();
                return false;
              }
			 
				else
				{
			  	document.getElementById("d_star").innerHTML="";
				}
			   
}
</script>
<script type="text/javascript">     
        function PrintDiv() {    
           var divToPrint = document.getElementById('divToPrint');
           var popupWin = window.open('', '_blank', 'width=770,height=400');
           popupWin.document.open();
           popupWin.document.write('<html><body onload="window.print()">' + divToPrint.innerHTML + '</html>');
            popupWin.document.close();
                }
</script>
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
</script>

<link href="*.css" rel="stylesheet" type="text/css" />
<link href="style.css" rel="stylesheet" type="text/css" />
<link href="print.css" rel="stylesheet" type="text/css" />

<link href="calendar/calendar.css" rel="stylesheet" type="text/css" />
<script language="javascript" src="calendar/calendar.js"></script>

<style type="text/css">
<!--
.style51 {font-size: 14px; font-family: Arial, Helvetica, sans-serif; }
.style11 {font-size: 14px}
-->
</style>
</head>
<?php 
if($v_print==1)
{ ?>
<body onLoad="PrintDiv()">
<?php } else { ?>
<body marginheight="0" marginwidth="0" topmargin="0" bottommargin="0" rightmargin="0" leftmargin="0">
<?php }?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td height="53" align="left" valign="top" background="images/bg.PNG"><table width="238" border="0" align="left" cellpadding="0" cellspacing="1">
      <tr class="menu">
        <td width="124" height="41" align="center" valign="middle"><a href="vazhipadu.php" class="menu_active">Vazhipadu</a></td>
        <td width="111" height="41" align="center" valign="middle"><a href="logout.php" class="menu">Logout</a></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td height="400" align="left" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="70%" height="280" align="left" valign="top">
    <form id="form1" name="form1" method="post" action="vazhipadu.php">
   
      <table width="850" border="0" align="right" cellpadding="0" cellspacing="0">
        <tr>
          <td height="60" align="center" valign="middle"><h1 class="pus">പുത്തന്‍കാവ് ചാരംപറമ്പ്‌ ഭഗവതി ക്ഷേത്രം</h1></td>
        </tr>
        <tr>
          <td height="60" align="center" valign="middle">
          
          
          <table width="850" border="0" align="right" cellpadding="0" cellspacing="0" style="border:1px solid #999999;">
            <tr>
              <td height="30" align="left" valign="middle">&nbsp;</td>
              <td height="30" colspan="2" align="left" valign="middle" class="style11"><span id="d_name" class="error"><?php if(isset($_GET['emsg']))
			{
			echo $_GET['emsg'];
			}?></span></td>
              <td width="71" height="30" align="left" valign="middle" class="style11">&nbsp;</td>
              <td align="left" valign="middle" class="style11">&nbsp;</td>
              <td align="left" valign="middle" class="style11">&nbsp;</td>
              <td align="left" valign="middle" class="style11">&nbsp;</td>
            </tr>
            <tr>
              <td width="48" height="30" align="left" valign="middle">&nbsp;</td>
              <td height="30" align="left" valign="middle" class="style1">പൂജ</td>
              <td width="262" height="30" align="left" valign="middle" class="style1"><select name="pooja" id="pooja" onchange="loadtodiv1(event,'rate.php','rate')">
                <option value="0">Select</option>
                <?php
				do {  
				?>
                <option value="<?php echo $row_r_select_pooja['id']?>"><?php echo $row_r_select_pooja['pooja']?></option>
                <?php
				} while ($row_r_select_pooja = mysql_fetch_assoc($r_select_pooja));
				  $rows = mysql_num_rows($r_select_pooja);
				  if($rows > 0) {
					  mysql_data_seek($r_select_pooja, 0);
					  $row_r_select_pooja = mysql_fetch_assoc($r_select_pooja);
				  }
				?>
              </select>
             <span id="d_pooja" class="error">                </span>
                </td>
              <td width="71" height="30" align="left" valign="middle" class="style1">&nbsp;</td>
              <td width="164" align="left" valign="middle" class="style1">Booking</td>
              <td width="140" align="left" valign="middle" class="style1"><input type="checkbox" name="booking" id="booking"  onclick="showMe();" />               </td>
              <td width="52" align="left" valign="middle" class="style1">&nbsp;</td>
            </tr>
            <tr>
              <td width="48" height="30" align="left" valign="middle">&nbsp;</td>
              <td height="30" align="left" valign="middle" class="style1">രൂപ</td>
              <td height="30" align="left" valign="middle" class="style1"><div id="rate">
                <input name="amount" type="text" id="amount" size="25" value="" />
              </div></td>
              <td width="71" height="30" align="left" valign="middle" class="style1">&nbsp;</td>
              <td width="164" align="left" valign="middle" class="style1">തീയതി</td>
              <td width="140" align="left" valign="middle" class="style1"><label><div id="div1" style="display:none"> <?php
			  $myCalendar = new tc_calendar("bck_date", true, false);
			  $myCalendar->setIcon("calendar/images/iconCalendar.gif");
			  $myCalendar->setDate(date('d'), date('m'), date('Y'));
			  $myCalendar->setPath("calendar/");
			  $myCalendar->setYearInterval(2000, 2015);
			  $myCalendar->dateAllow('2008-05-13', '2015-03-01');
			  $myCalendar->setDateFormat('j F Y');
			  $myCalendar->writeScript();
		  ?>
          </div>
         </label> <div id="div2" >
                <input name="date" type="text" id="date" value="<?php echo date("Y-m-d"); ?>" size="10" readonly="readonly" />
                </div></td>
              <td width="52" align="left" valign="middle" class="style1">&nbsp;</td>
            </tr>
            <tr>
              <td width="48" height="30" align="left" valign="middle">&nbsp;</td>
              <td height="30" align="left" valign="middle" class="style1">പേര്</td>
              <td height="30" align="left" valign="middle" class="style1"><label>
                <input name="name[]" type="text" class="pus" id="name1" size="25" />
                </label>
                </td>
              <td width="71" height="30" align="left" valign="middle" class="style1">&nbsp;</td>
              <td width="164" align="left" valign="middle" class="style1">നക്ഷത്രം</td>
              <td width="140" align="left" valign="middle" class="style1"><select name="star[]" id="star[]">
                <option value="0">Select</option>
                <?php
				do {  
				?>
                <option value="<?php echo $row_r_view_star['id']?>"><?php echo $row_r_view_star['starname']?></option>
                <?php
				} while ($row_r_view_star = mysql_fetch_assoc($r_view_star));
				  $rows = mysql_num_rows($r_view_star);
				  if($rows > 0) {
					  mysql_data_seek($r_view_star, 0);
					  $row_r_view_star = mysql_fetch_assoc($r_view_star);
				  }
				?>
                </select>                <span id="d_star" class="error"></span></td>
              <td width="52" align="left" valign="middle" class="style1">&nbsp;</td>
            </tr>
            <tr>
              <td height="30" align="left" valign="middle">&nbsp;</td>
              <td height="30" align="left" valign="middle" class="style1">പേര്</td>
              <td height="30" align="left" valign="middle" class="style1"><label>
                <input name="name[]" type="text" class="pus" id="name[]" size="25" />
              </label>
                <span id="d_name2" class="error"></span></td>
              <td height="30" align="left" valign="middle" class="style1">&nbsp;</td>
              <td align="left" valign="middle" class="style1">നക്ഷത്രം</td>
              <td align="left" valign="middle" class="style1"><select name="star[]" id="star[]">
                <option value="0">Select</option>
                <?php
				do {  
				?>
                <option value="<?php echo $row_r_view_star['id']?>"><?php echo $row_r_view_star['starname']?></option>
                <?php
				} while ($row_r_view_star = mysql_fetch_assoc($r_view_star));
				  $rows = mysql_num_rows($r_view_star);
				  if($rows > 0) {
					  mysql_data_seek($r_view_star, 0);
					  $row_r_view_star = mysql_fetch_assoc($r_view_star);
				  }
				?>
              </select>
                <span id="d_star2" class="error"></span></td>
              <td align="left" valign="middle" class="style1">&nbsp;</td>
            </tr>
            <tr>
              <td height="30" align="left" valign="middle">&nbsp;</td>
              <td height="30" align="left" valign="middle" class="style1">പേര്</td>
              <td height="30" align="left" valign="middle" class="style1"><label>
                <input name="name[]" type="text" class="pus" id="name[]" size="25" />
              </label>
                <span id="d_name" class="error"></span></td>
              <td width="71" height="30" align="left" valign="middle" class="style1">&nbsp;</td>
              <td width="164" align="left" valign="middle" class="style1">നക്ഷത്രം</td>
              <td width="140" align="left" valign="middle" class="style1"><select name="star[]" id="star[]">
                <option value="0">Select</option>
                <?php
				do {  
				?>
                <option value="<?php echo $row_r_view_star['id']?>"><?php echo $row_r_view_star['starname']?></option>
                <?php
				} while ($row_r_view_star = mysql_fetch_assoc($r_view_star));
				  $rows = mysql_num_rows($r_view_star);
				  if($rows > 0) {
					  mysql_data_seek($r_view_star, 0);
					  $row_r_view_star = mysql_fetch_assoc($r_view_star);
				  }
				?>
              </select>
                <span id="d_star" class="error"></span></td>
              <td align="left" valign="middle" class="style1">&nbsp;</td>
            </tr>
            <tr>
              <td height="30" align="left" valign="middle">&nbsp;</td>
              <td height="30" align="left" valign="middle" class="style1">പേര്</td>
              <td height="30" align="left" valign="middle" class="style1"><label>
                <input name="name[]" type="text" class="pus" id="name[]" size="25" />
              </label>
                <span id="d_name2" class="error"></span></td>
              <td height="30" align="left" valign="middle" class="style1">&nbsp;</td>
              <td align="left" valign="middle" class="style1">നക്ഷത്രം</td>
              <td align="left" valign="middle" class="style1"><select name="star[]" id="star[]">
                <option value="0">Select</option>
                <?php
				do {  
				?>
                <option value="<?php echo $row_r_view_star['id']?>"><?php echo $row_r_view_star['starname']?></option>
                <?php
				} while ($row_r_view_star = mysql_fetch_assoc($r_view_star));
				  $rows = mysql_num_rows($r_view_star);
				  if($rows > 0) {
					  mysql_data_seek($r_view_star, 0);
					  $row_r_view_star = mysql_fetch_assoc($r_view_star);
				  }
				?>
              </select>
                <span id="d_star2" class="error"></span></td>
              <td align="left" valign="middle" class="style1">&nbsp;</td>
            </tr>
            <tr>
              <td width="48" height="60" align="left" valign="middle"></td>
              <td height="30" align="left" valign="middle" class="style11"></td>
              <td height="30" align="left" valign="middle" class="style11"><label>
                <input name="submit" type="submit" class="style11" id="button" onclick="return ValidateForm();" value="  Submit  " />
                </label></td>
              <td width="71" height="30" align="left" valign="middle" class="style11">&nbsp;</td>
              <td width="164" align="left" valign="middle" class="style11">&nbsp;</td>
              <td width="140" align="left" valign="middle" class="style11">&nbsp;</td>
              <td width="52" align="left" valign="middle" class="style11">&nbsp;</td>
            </tr>
          </table></td>
        </tr>
      </table>

    </form>
   
    </td>
    <td width="326" align="right" valign="top" bgcolor="#FFFFFF">
    
      

     <div id="divToPrint" style="display:none" >
     <style type="text/css">
		.style1 {font-size: 12px}
	</style>
     <table width="750" border="0" align="center" cellpadding="0" cellspacing="0" style="border:1px solid #999999;">
      <tr>
        <td align="left">&nbsp;</td>
        <td height="40" align="left"><span class="style1"><strong>പൂജ : </strong>          
          <?php if (isset($_REQUEST['pooja'])) {$v_pooja_id=$_REQUEST['pooja'];include('inc_pooja.php'); 
		  echo $v_pooja_name;
} ?>        
        </span></td>
        <td height="40" colspan="2" align="right"><span class="style1">തീയതി : 
          <?php if (isset($_REQUEST['pooja'])) {echo $_POST['date'];}?>        
        </span></td>
        <td align="right">&nbsp;</td>
        </tr>
      <tr>
        <td width="17" align="left" bgcolor="#F4F4F4">&nbsp;</td>
        <td width="399" height="40" align="left" bgcolor="#F4F4F4"><span class="style1"><strong>പേര്</strong></span></td>
        <td width="174" height="40" bgcolor="#F4F4F4"><span class="style1"><strong>നക്ഷത്രം </strong></span></td>
        <td width="235" bgcolor="#F4F4F4"><span class="style1"><strong>രൂപ</strong></span></td>
        <td width="23" bgcolor="#F4F4F4">&nbsp;</td>
        </tr>
        <?php $v_total_amount=array(); for($i=0;$i<count($v_name);$i++)
	{
	if($v_name[$i]!="" && $v_star[$i]!="")
	{ ?>
      <tr>
        <td align="left">&nbsp;</td>
        <td height="40" align="left"><span class="style1"><strong>
          <?php if (isset($_REQUEST['name'])) {echo $v_name[$i];}?>
        </strong></span></td>
        <td height="40">
          <span class="style1">
          <?php if (isset($_REQUEST['pooja'])) {include('inc_star_name.php'); echo $v_starname; }?>        
          </span></td>
        <td>          <span class="style1">
          <?php if (isset($_REQUEST['amount'])) {echo $_REQUEST['amount']; $v_total_amount[]=$_REQUEST['amount'];} ?>        
          </span></td>
        <td>&nbsp;</td>
        </tr><?php }}?>
      <tr>
        <td align="left" bgcolor="#F4F4F4">&nbsp;</td>
        <td height="40" align="left" bgcolor="#F4F4F4">&nbsp;</td>
        <td height="40" bgcolor="#F4F4F4" class="style1"><strong>Total</strong></td>
        <td bgcolor="#F4F4F4"><?php if (isset($v_name)) { echo array_sum($v_total_amount); }?>&nbsp;</td>
        <td bgcolor="#F4F4F4">&nbsp;</td>
      </tr>
      
    </table>
    </div>
      </td>
  </tr>
  <tr>
    <td height="600" align="left" valign="top">
    <br />
    <?php if (isset($_REQUEST['pooja'])) { ?>
     <div class="overflow_scroll" style="height:400px; width:858px" id="report_div" >
    <table width="850" border="0" align="right" cellpadding="0" cellspacing="0" style="border:1px solid #999999;">
      <tr>
        <td align="left">&nbsp;</td>
        <td height="40" align="left"><span class="style1"><strong>പൂജ : </strong>          
          <?php if (isset($_REQUEST['pooja'])) { $v_pooja_id=$_REQUEST['pooja']; echo $v_pooja_name;} ?>        
        </span></td>
        <td height="40" colspan="2" align="right"><span class="style1">തീയതി : 
          <?php if (isset($_REQUEST['pooja'])) {echo $_POST['date'];}?>        
        </span></td>
        <td align="right">&nbsp;</td>
        </tr>
      <tr>
        <td width="17" align="left" bgcolor="#F4F4F4">&nbsp;</td>
        <td width="407" height="40" align="left" bgcolor="#F4F4F4"><span class="style1"><strong>പേര്</strong></span></td>
        <td width="166" height="40" bgcolor="#F4F4F4"><span class="style1"><strong>നക്ഷത്രം </strong></span></td>
        <td width="235" bgcolor="#F4F4F4"><span class="style1"><strong>രൂപ</strong></span></td>
        <td width="23" bgcolor="#F4F4F4">&nbsp;</td>
        </tr>
        <?php for($i=0;$i<count($v_name);$i++)
	{
	if($v_name[$i]!="" && $v_star[$i]!="")
	{ ?>
      <tr>
        <td align="left">&nbsp;</td>
        <td height="40" align="left"><span class="style1"><strong>
          <?php if (isset($_REQUEST['name'])) {echo $v_name[$i];}?>
        </strong></span></td>
        <td height="40">
          <span class="style1">
          <?php if (isset($_REQUEST['pooja'])) { include('inc_star_name.php'); 
echo $v_starname; }?>        
          </span></td>
        <td>          <span class="style1">
          <?php if (isset($_REQUEST['amount'])) { echo $_REQUEST['amount']; } ?>        
          </span></td>
        <td>&nbsp;</td>
        </tr><?php }}?>
      <tr>
        <td align="left" bgcolor="#F4F4F4">&nbsp;</td>
        <td height="40" align="left" bgcolor="#F4F4F4">&nbsp;</td>
        <td height="40" bgcolor="#F4F4F4" class="style1"><strong>Total</strong></td>
        <td bgcolor="#F4F4F4"><?php if (isset($_REQUEST['name'])) { echo array_sum($v_total_amount); }?>&nbsp;</td>
        <td bgcolor="#F4F4F4">&nbsp;</td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td height="40">&nbsp;</td>
        <td height="40">
          <span class="style1">
          <label>
            <?php if (isset($_REQUEST['rate'])) {?>
            <input name="button2" type="submit" id="button2" onclick="MM_openBrWindow('print_vazhipadu.php?name=<?php echo $name; ?>&star=<?php echo $star; ?>&pooja=<?php echo $pooja; ?>&amount=<?php echo $amount; ?>&date=<?php echo $_POST['date']; ?>','','width=400,height=400')" value="  Print  " />
            
            <?php }?>
          </label>
          </span></td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
    </table>
    </div>
    <?php } ?>
    </td>
    <td align="right" valign="top" bgcolor="#FFFFFF">&nbsp;</td>
  </tr>
    </table></td>
  </tr>
</table>
<!--<div align="center" style="display: block; position:absolute; text-align:center; bottom: 0; width: 100.00%; color: #CCC; clear: both; height:40px; background-repeat: repeat-x; border-right-width: 100px;  background-color:#333333; filter:alpha(opacity=75); opacity:0.90;"><br />
<span class="footer">All rights reserved. ® Acube Innovations Pvt Ltd. Phone: 0484 6066060.  Copyright © 2013. </span></div>-->
    
</body>
</html>
<?php
mysql_free_result($r_select_pooja);

mysql_free_result($r_view_star);
?>
