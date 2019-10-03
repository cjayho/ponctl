<?php

echo "<div align=\"center\">Порты/VLAN</div>";
$num_ports = GetNumPorts($ip, $ro, $iface);
$port = 1;
while ($port <= $num_ports) {

$port_state = OnuCopperPortState($ip, $ro, $iface, $port);
$link_state = OnuCopperLinkState($ip, $ro, $iface, $port);
echo "<div class=\"vlans\">";
echo "<div style=\"white-space: nowrap; float: left; position: relative; width: 40px; text-align: center; \">";
echo $port;
echo "</div>";
echo "<div style=\"white-space: nowrap; float: left; vertical-align: middle; tpo: 50%; position: relative; margin: 0px; padding: 0px; overflow: hidden; display: table-cell; height: 50px; line-height: 50px;\">";
if ($port_state == 2) {
echo "<img src=\"img/ports/disabled.jpg\">";
} else if ($link_state == 1) {
echo "<img src=\"img/ports/linkup.jpg\">";
} else if ($link_state == 2) {
echo "<img src=\"img/ports/linkdown.jpg\">";
}
echo "</div><div style=\"white-space: nowrap; float: left; position: relative; text-align: center; width: 80px; padding-left: 10px;\">";
$vlan_edit = "vlan".$port;
include 'vlan_by_id.php';
echo "</div></div><br/>";
$port = $port + 1;
}
?>
