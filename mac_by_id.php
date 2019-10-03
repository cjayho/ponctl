<?php
$mac=exec("snmpwalk -v2c $ip -c $ro 1.3.6.1.4.1.3320.101.10.1.1.3.$intface -O v | cut -c 13-");
$mac = str_replace (" ", ":", $mac);
?>
