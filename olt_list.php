<font size="5">
Список OLT
</font>
<br/>
<br/>
<font size="4">
<?php
include 'vars.php';
$extra = 'index.php';

$conn = new mysqli($mysql_host, $mysql_user, $mysql_pass);

mysqli_query( $conn, "SET NAMES utf8");


$retval = mysqli_query( $conn, "create database if not exists $mysql_db  default charset utf8" );

if(! $retval )
{
  die('Could not enter data: ' . $conn->error);
}



mysqli_select_db($conn, $mysql_db);


$sql = "CREATE TABLE IF NOT EXISTS olts (   `ip` INT UNSIGNED UNIQUE,   `place` varchar(256) DEFAULT NULL,   `ro` varchar(64) DEFAULT NULL,  `rw` varchar(64) DEFAULT NULL, `last_act` varchar(64) DEFAULT NULL, `lat` varchar(16) DEFAULT NULL, `lon` varchar(16) DEFAULT NULL, `olt_comments` varchar(256) DEFAULT NULL, `numsfp` varchar(16) DEFAULT NULL, `sfp1` varchar(256) DEFAULT NULL, `sfp2` varchar(256) DEFAULT NULL, `sfp3` varchar(256) DEFAULT NULL, `sfp4` varchar(256) DEFAULT NULL, `sfp5` varchar(256) DEFAULT NULL, `sfp6` varchar(256) DEFAULT NULL, `sfp7` varchar(256) DEFAULT NULL, `sfp8` varchar(256) DEFAULT NULL, `sfp9` varchar(256) DEFAULT NULL, `sfp10` varchar(256) DEFAULT NULL, `sfp11` varchar(256) DEFAULT NULL, `sfp12` varchar(256) DEFAULT NULL, `sfp13` varchar(256) DEFAULT NULL, `sfp14` varchar(256) DEFAULT NULL, `sfp15` varchar(256) DEFAULT NULL, `sfp16` varchar(256) DEFAULT NULL)";

$retval = mysqli_query( $conn, $sql );
if(! $retval )
{
  die('Could not enter data: ' . mysqli_error($conn));
}



$sql = "select * from olts order by ip";
$retval = mysqli_query( $conn, $sql );
if(! $retval )
{
  die('Could not enter data: ' . mysqli_error($conn));
}
$number = mysqli_num_rows($retval);
?>
<div align="center">
<table>



<?php
if ($number == 0) {
echo "<a href=\"?page=addolt\">Чтобы начать работу ДОБАВЬТЕ OLT</a>";
} else {
$count = 0;
  while ($row=mysqli_fetch_array($retval)) {


$count = $count + 1;
$ip_sql = $row['ip'];
$ip = long2ip($ip_sql);
$place = $row['place'];
$numsfp = $row['numsfp'];
$last_act = $row['last_act'];
$ro = $row['ro'];
$olt = str_replace (".", "_", $ip);
include 'ping.php';
if ($ping == 0) {
$color = "red";
$cell_color = "#FF0000";
}
else {
$color = "normal";
$cell_color = "#00FF00";
}
echo "<tr class=\"container\" onclick=\"document.location = '?page=olt&olt=$ip';\">";
echo "<td style=\"width: 8px; padding: 0px; background: $cell_color;\"></td>";
echo "<td style=\"text-align:center; padding: 5px;\" >$count</td><td><a href=\"?page=olt&olt=$olt\">".$ip."</a></td>";
echo "<td style=\"font-size: 18px; padding-left: 30px; min-width: 400px;\"><ul id=\"nav\"><li>";
echo "<a href=\"index.php?page=olt&olt=$ip\">";
echo $place;
echo "</a>";

echo "<ul>";
echo "<span style=\"font-size: 11px;\">";
$count_sfp = 1;
while ($count_sfp <= $numsfp) {
echo "<li><a href=\"index.php?page=olt&olt=$ip&sfp=$count_sfp\">SFP $count_sfp</a></li>";
$count_sfp = $count_sfp + 1;
}


echo "</span>";
echo "</ul>";

echo "</li></ul>";
echo "</td>";

echo "<td>".$last_act."</td></tr>";


}


mysqli_close($conn);
}
?>
</table>
</font>
</div>
<font size=3>
<div align=right>
<br/>
<a href="index.php?page=addolt">Добавить новый OLT</a>
<br/>
<a href="index.php?page=ping_all">Опросить все OLT и ONU</a>
</div>
</font>
