<?php
include 'vars.php';
$ip = $_GET["olt"];
$mac = $_GET["mac"];
include 'get_rw.php';
$iface = $_GET["iface"];
$port = $_GET["port"];
$host  = $_SERVER['HTTP_HOST'];
$uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
$extra = "index.php?page=onu&olt=$ip&mac=$mac";
snmp2_set($ip, $rw, "1.3.6.1.4.1.3320.101.12.1.1.18.$iface.port", i, "0");
snmp2_set($ip, $rw, "1.3.6.1.4.1.3320.20.15.1.1.0", i, "1");
header("Location: http://$host$uri/$extra");
?>
