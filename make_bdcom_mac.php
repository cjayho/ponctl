<?php
$mac = str_replace(":", "", $mac);
$mac = str_replace("-", "", $mac);
$mac = str_replace("A", "a", $mac);
$mac = str_replace("B", "b", $mac);
$mac = str_replace("C", "c", $mac);
$mac = str_replace("D", "d", $mac);
$mac = str_replace("E", "e", $mac);
$mac = str_replace("F", "f", $mac);
$bdcom_mac_1 = substr($mac, 0, 4);
$bdcom_mac_2 = substr($mac, 4, 4);
$bdcom_mac_3 = substr($mac, 8, 4);
$bdcom_mac = $bdcom_mac_1.".".$bdcom_mac_2.".".$bdcom_mac_3;
?>
