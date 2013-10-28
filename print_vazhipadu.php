<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<style type="text/css">
<!--
.style1 {
	font-size: 14px;
	font-weight: bold;
}
.style2 {font-size: 14px}
.style4 {font-size: 12px}
-->
</style>
</head>

<body onLoad="window.print();">
<table width="275" border="0" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <td height="93" colspan="2" align="center"><p class="style4">പുത്തന്‍കാവ് ചാരപറമ്പ് ഭഗവതി ക്ഷേത്രം,</p>
          <p class="style4"><span class="style7 ">പുത്തന്‍കുരിശ്</span><br />        
          </p></td>
  </tr>
      <tr>
        <td width="90" height="40" align="left"><span class="style1">പേര്</span></td>
        <td width="185" height="40"><span class="style2">
        <?php if (isset($_GET['name'])) {echo $_GET['name'];} ?>
        </span></td>
  </tr>
      <tr>
        <td height="40" align="left"><span class="style3">തീയതി</span></td>
        <td height="40">
        	<span class="style3">
				<?php if (isset($_GET['date'])) {echo $_GET['date'];}?>
            </span>
        </td>
      </tr>
      <tr>
        <td height="40" align="left"><span class="style1">നക്ഷത്രം</span></td>
        <td height="40"><span class="style2">
        <?php if (isset($_GET['star'])) {echo $_GET['star'];} ?>
        </span></td>
      </tr>
      <tr>
        <td height="40" align="left"><span class="style1">പൂജ</span></td>
        <td height="40"><span class="style2">
        <?php if (isset($_GET['pooja'])) {echo $_GET['pooja'];} ?>
        </span></td>
      </tr>
      <tr>
        <td height="40" align="left"><span class="style1">രൂപ</span></td>
        <td height="40"><span class="style2">
        <?php if (isset($_GET['amount'])) {echo $_GET['amount'];} ?>
        </span></td>
      </tr>
     </table>
</body>
</html>
