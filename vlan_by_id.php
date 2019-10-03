<?php
$pvid = GetPVID($ip, $ro, $iface, $port);
if ($pvid == NULL) {
} else {

if ($pvid == 1) {
$pvid = "default";
} else {
}




if ($edit == $vlan_edit) {

echo "</div><div style=\"white-space: nowrap; float: left; position: relative; padding-left: 10px;\">";
?>
<form method="post" action="set_vlan.php?olt=<?php echo $ip; ?>&iface=<?php echo $iface; ?>&port=<?php echo $port; ?>&mac=<?php echo $mac; ?>">
<input required name="vlan" size=10 type="text" id="vlan" placeholder="VLAN">
<input name="add" type="submit" id="add" value="SET" style="padding: 2px;">
</form>
</div><div style="white-space: nowrap; padding-left: 10px; float: left; position: relative">
<form method="post" action="unset_vlan.php?olt=<?php echo $ip; ?>&iface=<?php echo $iface; ?>&port=<?php echo $port; ?>&mac=<?php echo $mac; ?>">
<input name="add" type="submit" id="add" value="RESET" style="padding: 2px;">
</form>


<?php
} else {
echo "<a href=\"index.php?page=onu&olt=$ip&mac=$mac&edit=$vlan_edit\">$pvid</a>";
}
}
?>
