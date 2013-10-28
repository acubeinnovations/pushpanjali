<?php
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"
$hostname_pushpanjali = "localhost";
$database_pushpanjali = "pushpanjali";
$username_pushpanjali = "root";
$password_pushpanjali = "";
$pushpanjali = mysql_pconnect($hostname_pushpanjali, $username_pushpanjali, $password_pushpanjali) or trigger_error(mysql_error(),E_USER_ERROR); 
?>
