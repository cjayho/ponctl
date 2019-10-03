<?php
include 'vars.php';
$ip = $_GET["olt"];
include 'get_rw.php';
$iface = $_GET["iface"];
$mac = $_GET["mac"];
$host  = $_SERVER['HTTP_HOST'];
$uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
$extra = "index.php?page=onu&olt=$ip&mac=$mac";
snmp2_set($ip, $rw, "1.3.6.1.4.1.3320.101.10.1.1.29.$iface", i, "0");
header("Location: http://$host$uri/$extra");
?>
