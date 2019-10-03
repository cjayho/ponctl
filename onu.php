<div align="left" style="padding: 10px"><a href="?page=olt&olt=<?php echo $ip; ?>"><img width="16" src="images/back.png"> Карточка OLT</a></div>
<?php
echo "<div style=\"padding: 10px\">";
include 'onu_sensors.php';
?>
</div>
</div>
<div align="center">
<?php


$olt = $ip;

if ($include == NULL) {
if ($fdb == "show") {
$self = $_SERVER['PHP_SELF'];
include 'get_fdb_by_telnet.php';
} else {
if ($lat == 0) {
echo "Onu не указана на карте";
} else {
echo "<a href=\"index.php?page=onu&olt=$olt&mac=$mac&maptype=heremap\">Here Map</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
echo "<a href=\"index.php?page=onu&olt=$olt&mac=$mac&maptype=heresat\">Here Sat</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
echo "<a href=\"index.php?page=onu&olt=$olt&mac=$mac&maptype=osm\">OpenStreet</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
echo "<a href=\"index.php?page=onu&olt=$olt&mac=$mac\">Yandex Maps</a>";
echo "<div align=\"center\">";
echo "<div id=\"map\" style=\"width:600px; height:400px\"></div>";
echo "</div>";
}
echo "<br/><a href=\"index.php?page=location&olt=$olt&mac=$mac\">Указать координаты</a><br/><br/>";
}
} else {
include "$include";
}






?>
</div>
