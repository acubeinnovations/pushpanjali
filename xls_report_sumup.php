<?php  header('Content-type: text/html; charset=utf-8');
require_once('Connections/pushpanjali.php');
require_once('calendar/classes/tc_calendar.php');

	header("Content-type: application/vnd.ms-excel");
	header("Content-Disposition: attachment; filename=monthly_summary.xls");
	header("Cache-Control: cache, must-revalidate");
	header("Pragma: public"); 

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
if(isset($_POST["from_date"]) && trim($_POST["from_date"])!=""){
	$v_from = $_POST['from_date'];
}else{
	$v_from = date("Y-m-1");
	
}


if(isset($_POST["to_date"]) &&  trim($_POST["to_date"])!=""){
	$v_to = $_POST['to_date'];
}else{
	$v_to = date("Y-m-d");	
} 



mysql_select_db($database_pushpanjali, $pushpanjali);
$query_r_opng_balance = "SELECT SUM(cr),SUM(dr) FROM master WHERE date<'$v_from' AND status='0'";
$r_opng_balance = mysql_query($query_r_opng_balance, $pushpanjali) or die(mysql_error());
$row_r_opng_balance = mysql_fetch_assoc($r_opng_balance);
$totalRows_r_opng_balance = mysql_num_rows($r_opng_balance);
$v_opng_bal=$row_r_opng_balance['SUM(cr)']-$row_r_opng_balance['SUM(dr)'];

mysql_select_db($database_pushpanjali, $pushpanjali);
$query_r_view_summary = "SELECT DISTINCT date FROM master WHERE date BETWEEN '$v_from' AND '$v_to' AND status='0' ORDER BY date ASC";
$r_view_summary = mysql_query($query_r_view_summary, $pushpanjali) or die(mysql_error());
$row_r_view_summary = mysql_fetch_assoc($r_view_summary);
$totalRows_r_view_summary = mysql_num_rows($r_view_summary);

function echotomysql($f_MySqlDate2){
$f_date_array = explode("-",$f_MySqlDate2); 
$f_var_day = $f_date_array[0];
$f_var_month = $f_date_array[1];
$f_var_year = $f_date_array[2];
$f_var_timestamp =$f_var_year.'-'.$f_var_month.'-'.$f_var_day ;
return($f_var_timestamp);
}

ob_start();


?>

    <table width="838" border="0" align="right" cellpadding="0" cellspacing="0" style="border:1px solid #999999;">
        <tr>
          <td width="129" height="40" align="center" style="border-bottom:1px solid #999999;"><span class="style5">Date</span></td>
          <td width="469" height="40" align="left" style="padding-left:8px; border-bottom:1px solid #999999;"><span class="style5">Particulars</span></td>
          <td width="113" height="40" align="right" valign="middle" style="border-bottom:1px solid #999999;"><span class="style5">Credit&nbsp;&nbsp;&nbsp;&nbsp;</span></td>
          <td width="125" height="40" align="right" valign="middle" style="border-bottom:1px solid #999999;"><span class="style5">Debit&nbsp;&nbsp;&nbsp;&nbsp;</span></td>
        </tr>
        
        <?php do {
		if($row_r_view_summary['date']!="") { ?>
          <tr>
            <td width="129" height="0" align="center" class="style1"><?php echo echotomysql($row_r_view_summary['date']); 
				?></td>
            <td width="469" height="30" align="left" valign="middle" class="style1">വരവ് - വഴിപാടുകള്‍</td>
            <td width="113" height="15" align="right" valign="middle" class="style1"><a href="varavu.php?date=<?php echo $row_r_view_summary['date']; ?>">
<?php
				 mysql_select_db($database_pushpanjali, $pushpanjali);
				$query_r_view_vazhipadu = "SELECT SUM(amount) FROM vazhipadu WHERE vazhipadu_date='".$row_r_view_summary['date']."' AND status='0'";
				$r_view_vazhipadu = mysql_query($query_r_view_vazhipadu, $pushpanjali) or die(mysql_error());
				$row_r_view_vazhipadu = mysql_fetch_assoc($r_view_vazhipadu);
				$totalRows_r_view_vazhipadu = mysql_num_rows($r_view_vazhipadu);
				if($row_r_view_vazhipadu['SUM(amount)']!="")
				{ 
				echo $row_r_view_vazhipadu['SUM(amount)'].'.00';
				$v_cr[]=$row_r_view_vazhipadu['SUM(amount)']; }
				else
				{ echo "0.00"; $v_cr[]=0; }?>&nbsp;&nbsp;&nbsp;&nbsp;
                </a>
                </td>
            <td width="125" height="15" align="right" valign="middle" class="style1">0.00&nbsp;&nbsp;&nbsp;&nbsp;</td>
          </tr>
          <tr>
            <td width="129" height="30" align="center" class="style1" style="border-bottom:1px solid #999999;">&nbsp;</td>
            <td width="469" height="30" align="left" valign="middle" class="style1" style="border-bottom:1px solid #999999;">
            ചിലവ് - വൌച്ചറുകള്‍</td>
            <td width="113" height="15" align="right" valign="middle" class="style1" style="border-bottom:1px solid #999999;">
			<?php 
			mysql_select_db($database_pushpanjali, $pushpanjali);
			$query_r_view_voucher = "SELECT SUM(amount) FROM voucher WHERE voucher_date='".$row_r_view_summary['date']."' AND status='0'";
			$r_view_voucher = mysql_query($query_r_view_voucher, $pushpanjali) or die(mysql_error());
			$row_r_view_voucher = mysql_fetch_assoc($r_view_voucher);
			$totalRows_r_view_voucher = mysql_num_rows($r_view_voucher);?>0.00&nbsp;&nbsp;&nbsp;&nbsp;</td>
            <td width="125" height="15" align="right" valign="middle" class="style1" style="border-bottom:1px solid #999999;">
            <a href="chilavu.php?from_date=<?php echo $row_r_view_summary['date']; ?>&to_date=<?php echo $row_r_view_summary['date']; ?>"> 
			<?php if($row_r_view_voucher['SUM(amount)']!="") { 
			$v_dr[]=$row_r_view_voucher['SUM(amount)'];
			echo $row_r_view_voucher['SUM(amount)'].'.00'; } else{ echo "0.00"; $v_dr[]=0;} ?>&nbsp;&nbsp;&nbsp;&nbsp;</a></td>
          </tr>
          <?php } else {?>
          <tr>
            <td height="30" rowspan="2" align="center" style="border-bottom:1px solid #999999;" class="style1"><?php echo date('d-m-Y'); ?></td>
            <td height="30" align="left" valign="middle" class="style1" style="padding-left:8px; font-family: Arial, Helvetica, sans-serif;"><span class="style1">വരവ് - വഴിപാടുകള്‍ </span></td>
            <td height="15" align="right" valign="middle" class="style1"><?php echo $v_cr[]="0.00"; ?>&nbsp;&nbsp;&nbsp;&nbsp;</td>
            <td height="15" align="right" valign="middle" class="style1">0.00&nbsp;&nbsp;&nbsp;&nbsp;</td>
          </tr>
          <tr>
            <td height="30" align="left" valign="middle" class="style1" style="padding-left:8px; border-bottom:1px solid #999999; font-family: Arial, Helvetica, sans-serif;"><span class="style1">ചിലവ് - വൌച്ചറുകള്‍</span></td>
            <td height="15" align="right" valign="middle" class="style1" style="border-bottom:1px solid #999999;">0.00&nbsp;&nbsp;&nbsp;&nbsp;</td>
            <td height="15" align="right" valign="middle" class="style1" style="border-bottom:1px solid #999999;">
            
			<?php echo $v_dr[]="0.00"; ?> &nbsp;&nbsp;&nbsp;&nbsp;
            </td>
          </tr><?php } } while ($row_r_view_summary = mysql_fetch_assoc($r_view_summary));?>
          <tr>
            <td height="30" align="center" bgcolor="#FEFEFE" style="border-bottom:1px solid #999999;">&nbsp;</td>
            <td height="30" align="left" bgcolor="#FEFEFE" class="style1" style="padding-left:8px;border-bottom:1px solid #999999;">അകെ തുക വരവ്</td>
            <td height="30" align="right" valign="middle" bgcolor="#FEFEFE" class="style1" style="border-bottom:1px solid #999999;">
			<a href="varavu_summary.php">
			<?php echo array_sum($v_cr); ?>.00 </a>&nbsp;&nbsp;&nbsp;&nbsp;</td>
            <td height="30" align="right" valign="middle" bgcolor="#FEFEFE" class="style1" style="border-bottom:1px solid #999999;">&nbsp;
			</td>
          </tr>
          <tr>
            <td height="30" align="center" bgcolor="#FEFEFE" style="border-bottom:1px solid #999999;">&nbsp;</td>
            <td height="30" align="left" bgcolor="#FEFEFE" class="style1" style="padding-left:8px;border-bottom:1px solid #999999;">ആകെ തുക ചിലവ്</td>
            <td height="30" align="right" valign="middle" bgcolor="#FEFEFE" class="style1" style="border-bottom:1px solid #999999;">&nbsp;</td>
            <td height="30" align="right" valign="middle" bgcolor="#FEFEFE" class="style1" style="border-bottom:1px solid #999999;">
            <a href="chilavu_sumup.php?date=<?php echo $row_r_view_summary['date']; ?>"><?php echo array_sum($v_dr); ?>.00</a>
            &nbsp;&nbsp;&nbsp;&nbsp;</td>
          </tr>
          <tr>
            <td height="30" align="center" bgcolor="#FEFEFE" style="border-bottom:1px solid #999999;">&nbsp;</td>
            <td height="30" align="left" bgcolor="#FEFEFE" class="style1" style="padding-left:8px;border-bottom:1px solid #999999;">
            <strong>തന്‍ മാസ നീക്കിയിരിപ്പ്</strong> <?php $aay=array_sum($v_cr)-array_sum($v_dr);?></td>
            <td height="30" align="right" valign="middle" bgcolor="#FEFEFE" class="style1" style="border-bottom:1px solid #999999;"><?php if($aay>0) { echo $aay; } else { echo "0"; }  ?>.00&nbsp;&nbsp;&nbsp;&nbsp;</td>
            <td height="30" align="right" valign="middle" bgcolor="#FEFEFE" class="style1" style="border-bottom:1px solid #999999;"><?php if($aay<0) { echo $aay*-1; }?>.00&nbsp;&nbsp;&nbsp;&nbsp;</td>
          </tr>
          <tr>
          <td width="129" height="30" align="center" style="border-bottom:1px solid #999999;">&nbsp;</td>
          <td height="30" align="left" class="style1" style="padding-left:8px;border-bottom:1px solid #999999;">
          <strong>മുന്‍ മാസ നീക്കിയിരിപ്പ്</strong></td>
          <td height="30" align="right" valign="middle" class="style1" style="border-bottom:1px solid #999999;"><span class="style1"> <strong><?php if($v_opng_bal>0){ echo $v_opn_cr=$v_opng_bal; } else { echo $v_opn_cr ="0";}?>.00&nbsp;&nbsp;&nbsp;&nbsp;</strong></span></td>
          <td height="30" align="right" valign="middle" class="style1" style="border-bottom:1px solid #999999;"><span class="style1"><strong><?php if($v_opng_bal<0){ echo $v_opn_dr=abs($v_opng_bal); } else { echo $v_opn_dr="0.00";}?>&nbsp;&nbsp;&nbsp;&nbsp;</strong></span></td>
        </tr>
          <tr>
            <td width="129" height="40" align="center"><span class="style3"></span></td>
            <td height="40" align="left" class="style5" style="padding-left:8px;">Closing Balance<?php $v_cr_amount=array_sum($v_cr)+$v_opn_cr;
			$v_dr_amount=array_sum($v_dr)+$v_opn_dr; $v_clsng_bal=$v_cr_amount-$v_dr_amount?></td>
            <td height="40" align="right" valign="middle" class="style1"> <strong>
			<?php if($v_clsng_bal>0) { echo $v_clsng_bal.'.00'; } else { echo '0.00'; } ?>&nbsp;&nbsp;&nbsp;</strong></td>
            <td height="40" align="right" valign="middle" class="style1"><strong>
			<?php if($v_clsng_bal<0) { echo abs($v_clsng_bal).'.00'; } else { echo '0.00'; }?>&nbsp;&nbsp;&nbsp;&nbsp;</strong></td>
          </tr>
      </table>
     

<?php
$report = ob_get_contents();
ob_end_clean();

?>
<style type="text/css">
<!--
.pus {
	color: #C00;
}
-->
</style>




<style type="text/css">
<!--
.style8 {font-size: 14px}
.style9 {color: #585858}
-->
</style>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td height="400" align="left" valign="top">
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
  		<tr>
   		  <td height="600" align="left" valign="top">
   			<table width="100%" border="0" cellspacing="0" cellpadding="0">
			  <tr>
          				<td height="60" colspan="7" align="left" valign="middle">
                        <h1 class="pus noprint">പുത്തന്‍കാവ് ചാരപറമ്പ്‌ ഭഗവതി ക്ഷേത്രം</h1>
            			</td> 
   			  </tr>

  <tr>
    <td align="left" valign="middle">
    <div class="overflow_scroll" style="height:400px; width:855px" id="report_div" >

		<?php echo $report; ?>

    </div>
      
     </td>
  </tr>  
</table>
      </td>
    </tr>
</table></td>
  </tr>
</table>
