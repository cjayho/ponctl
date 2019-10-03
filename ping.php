<?php

include 'vars.php';

$snmp_ping = snmp2_get($ip, $ro, "1.3.6.1.2.1.1.4.0");

if (!$snmp_ping)
{
	$ping = 0;
}
else
{
	$ping = 1;
	$sql_ip = sprintf('%u', ip2long($ip));
	$extra = 'index.php';
	$conn = mysqli_connect($mysql_host, $mysql_user, $mysql_pass);
	mysqli_query($conn, "SET NAMES utf8");
	mysqli_select_db($conn, $mysql_db);
	$sql_req = "UPDATE olts SET last_act=\"$date\" WHERE ip='$sql_ip'";
	$retval_ping = mysqli_query( $conn, $sql_req );

	if(! $retval_ping )
	{
	  die('Could not enter data: ' . mysqli_error($conn));
	}
}
?>
