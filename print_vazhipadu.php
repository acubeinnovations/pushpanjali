<?php  header('Content-type: text/html; charset=utf-8');
 require_once('Connections/pushpanjali.php'); 
$receipt_number = $_GET["receipt_number"] ;
$strsql = "select * from vazhipadu V, pooja P WHERE V.pooja = P.id and V.receipt_number ='".$receipt_number."'";
mysql_query("SET NAMES utf8");
mysql_select_db($database_pushpanjali, $pushpanjali);
$rs_pooja = mysql_query($strsql, $pushpanjali) or die(mysql_error());
$row_pooja = mysql_fetch_assoc($rs_pooja);
$count_pooja = mysql_num_rows($rs_pooja);  
$vazhipadu_date=$row_pooja['vazhipadu_date'];
$pooja_name=$row_pooja['pooja'];
$pooja_rate=$row_pooja['rate'];
$name=$row_pooja['name'];
$total_amount = 0;
?>

<html>
  <head>
  </head>
  <body>
     <style type="text/css">
.letter {
font-family:"kartika";
font-size:8px;
letter-spacing:5px;
line-height:20px;
}
@font-face
{
font-family: "kartika";
src: url('fonts/kartika.ttf');
}
.english
{
font-family:"Arial";
font-size:7px;
letter-spacing:5px;
line-height:20px;
}
  </style>
<table width="500" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td width="275" height="110">&nbsp;</td>
    <td width="125">&nbsp;</td>
    <td width="100">&nbsp;</td>
  </tr>
  <tr>
    <td width="400"  colspan="2" height="65" align="left" valign="middle" class="letter"> &nbsp;&nbsp;&nbsp;
  <?php echo $pooja_name;  ?>        </td>
    
    <td width="100" height="65" class="english" align="left" valign="middle"><?php echo $vazhipadu_date; ?>
  </br></br><?php echo $receipt_number; ?></td>
  </tr>
  <tr>
    <td height="120" colspan="3" align="left" valign="top">
    <table width="500" border="0" cellpadding="0" cellspacing="0">
    <tr>
    <td width="275" height="25" align="left" valign="middle" class="letter">&nbsp;</td>
    <td width="125" height="25" align="left" valign="middle" class="letter">&nbsp;</td>
    <td width="100" height="25" align="middle" valign="middle" class="letter">&nbsp;</td>
  </tr>
<?php do { ?>
    <tr>
    <td width="275" height="15" align="left" valign="middle" class="letter"><?php echo $row_pooja["name"];?></td>
    <td width="125" height="15" align="left" valign="middle" class="letter"><?php  echo $row_pooja["pooja"]; ?> </td>
    <td width="100" height="15" align="middle" valign="middle" class="english"><?php  echo $row_pooja["amount"];  ?></td>
  </tr>
<?php 

$total_amount= $total_amount + $row_pooja["amount"];
}while($row_pooja = mysql_fetch_assoc($rs_pooja)) ?>
</table>
  </td>
  </tr>

  <tr>
    <td height="80">&nbsp;</td>
    <td height="80">&nbsp;</td>
    <td height="80" align="middle" valign="bottom" class="english"><?php  echo $total_amount; ?></td>
  </tr>

</table>
<script language="VBScript">
	sub Print()
		OLECMDID_PRINT = 6
		OLECMDEXECOPT_DONTPROMPTUSER = 2
		OLECMDEXECOPT_PROMPTUSER = 1
		call WB.ExecWB(OLECMDID_PRINT, OLECMDEXECOPT_DONTPROMPTUSER,1)
	End Sub
	document.write "<object id='WB' width='0' height='0' classid='CLSID:8856F961-340A-11D0-A96B-00C04FD705A2'></object>"
</script>
<object id="WebBrowser1" width="0" height="0" classid="CLSID:8856F961-340A-11D0-A96B-00C04FD705A2"> </object>
<script type="text/javascript">
	Print();
window.close();
</script>
  </body>
</html>
