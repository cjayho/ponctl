<?php
echo "<div style=\"display: table; text-align: left; white-space: nowrap; width: 100%;\">";
echo "<h1>".$comments."</h1>";

if ($edit == "true" OR (!isset($code) AND !isset($comments))) {
echo "<br/>";
                                                                 if ($use_userside == "yes") {
                                                                 include 'onu_code.php';
                                                                } else {
                                                                include 'onu_comments.php';
                                                                }

} else {
echo "<span style=\"font-size: 10px;\"><a href=\"index.php?page=onu&olt=$ip&mac=$mac&edit=true\">[редактировать описание]</a></span><br/>";
}

echo "<br/><br/><br/>";
echo "<div style=\"float: left; display: table-cell; vertical-align: middle; top: 50%;\">";
echo "<b>";
echo "<a href=\"?page=onu&olt=$ip&mac=$mac\">$nameint</a>";
echo "</b><br/>";
echo "<b>";
echo "<a href=\"".(isset($search_string)?$search_string:'').$mac."\" target=\"_blank\">";
echo $mac;
echo "</a>";
echo "</b><br/>";

if ($rx == "Offline") {

include 'get_lastact_onu.php';
echo "<span style=\"color:#FF0000; font-size: 12px;\";>";
echo "<b>Последняя активность:</b>";
echo "<br/>";
echo $last_act;
echo "<br/>";
echo $last_pwr;
echo " dB</span><br/><br/><br/>";
echo "<font size=\"4\">";
echo "<a href=\"?page=onu&olt=$ip&mac=$mac&show=onu_s\"><img width=\"32\" src=\"images/optic.png\"> История сигналов</a>";
echo "<br/>";
echo "<a href=\"?page=reboot_onu&olt=$ip&iface=$iface\"><img width=\"32\" src=\"images/reboot.png\"> Перезагрузка ONU</a>";
echo "</font>";
echo "</div>";
echo "<div style=\"float: left; position:relative; left: 100px;\">";
echo "ONU OFFLINE";
} else {

echo "<span class=\"rx\">$rx";
echo " dB</span><br/>";
echo "<b>";
echo $dist;
echo "</b><font size=2>m</font><br/><br/><br/>";
echo "<font size=\"4\">";
echo "<a href=\"?page=onu&olt=$ip&mac=$mac&fdb=show\"><img width=\"32\" src=\"images/fdb.png\"> FDB-таблица</a>";
echo "<br/>";
echo "<a href=\"?page=onu&olt=$ip&mac=$mac&show=onu_s\"><img width=\"32\" src=\"images/optic.png\"> История сигналов</a>";
echo "<br/>";
echo "<a href=\"?page=reboot_onu&olt=$ip&iface=$iface\"><img width=\"32\" src=\"images/reboot.png\"> Перезагрузка ONU</a>";
echo "</font>";
echo "</div>";
echo "<div style=\"float: left; position: relative; padding-left: 100px; white-space: nowrap; line-height: 50px; display: inline; vertical-align: middle; top: 50%;\">";
include 'get_ports.php';
}
echo "</div>";
echo "</div>";
echo "</div>";
?>
