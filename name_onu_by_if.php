<?php
$nameint=exec("snmpwalk -v2c $ip -c $ro 1.3.6.1.4.1.3320.9.183.1.1.2.$iface -O v");
$nameint=substr($nameint,-11,-1);
$nameint = str_replace ("\"", "", $nameint);
?>
