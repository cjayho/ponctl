<?php
include 'ping.php';
include 'vars.php';
$extra = 'index.php';
include_once 'function_lib.php';

if ($table == NULL)
{
	$table = $_REQUEST["olt"];
} 

if (!isset($_REQUEST["sort"]))
{
	$sort = "name";
}
else
{
	$sort = $_REQUEST["sort"];
}

$sfp = isset($_REQUEST["sfp"]) ? $_REQUEST["sfp"] : '';

$sort_sfp = '';

if (isset($_REQUEST["sfp"]))
{ 
	$sort_sfp = "&sfp=" . $sfp;
}

if ($search != NULL)
{
	$search_sql ="AND name LIKE \"%$search%\" OR mac LIKE \"%$search%\" OR comments LIKE \"%$search%\"";
}
else
{
	$search_sql = '';
}

$ip = str_replace ("_", ".", $table);

include 'get_ro.php';
$date = date('d.m.Y H:i:s');
$tables = $table."s";

$conn = mysqli_connect($mysql_host, $mysql_user, $mysql_pass);
mysqli_query($conn, "SET NAMES utf8");
mysqli_select_db($conn, $mysql_db);

echo "<font size=\"3\"><table cellspacing=\"0\"><thead>";
echo "<tr><th style=\"width: 8px; padding: 0px;\"></th><th><a href=\"index.php?page=olt&olt=$ip&sort=name".$sort_sfp."\"></a></th><th><a href=\"index.php?page=olt&olt=$ip&sort=mac".$sort_sfp."\">Интерфейс/MAC ONU</a></th><th><a 
href=\"index.php?page=olt&olt=$ip&sort=comments".$sort_sfp."\">Описание</a></th><th><a href=\"index.php?page=olt&olt=$ip&sort=pwr".$sort_sfp."\">Бюджет</a></th><th><a href=\"index.php?page=olt&olt=$ip&sort=last_activity".$sort_sfp."\">Посл. активность</a></th><th>Unbind ONU</th></tr></thead>";


if ($sort == "pwr")
{
	$sort="CAST(last_pwr AS DECIMAL(3,1)) DESC";
}

$ip_sql = sprintf('%u', ip2long($ip));

$sql = "select * from onus WHERE olt=\"$sql_ip\" AND name LIKE \"EPON0/$sfp%\" $search_sql ORDER BY $sort";
$retval = mysqli_query( $conn, $sql );

if(! $retval )
{
  die('Could not enter data: ' . mysqli_error($conn));
}

while ($row=mysqli_fetch_array($retval))
{


$nameint = $row['name'];
$mac = $row['mac'];

if ($use_userside == "yes") {
$code = $row['code'];
$type = $row['type'];
if ($code == NULL) {
$comments = $row['comments'];
} else {
include 'get_us_data.php';
include 'make_comments_by_us.php';
}
} else {
$comments = $row['comments'];
}


$pwr = $row['pwr'];
$last_pwr = $row['last_pwr'];
$last_act = $row['last_activity'];
$lat = $row['lat'];

if ($lat == NULL) {
$lat = 0;
}

$nameint = NameIntDelZero($nameint);

if ($pwr == "Offline" or $ping == 0) {
$color="red";
$cell_color = "#FF0000";
} else {
$cell_color = "#66FF11";
$color="#333333";
}

echo "<tr class=\"container\" onclick=\"document.location = '?page=onu&olt=$ip&mac=$mac';\">";
echo "<td style=\"width: 8px; padding: 0px; background: $cell_color;\"></td>";
echo "<td class=\"container\" style=\"white-space:nowrap; width: 5px; margin: 0px; padding: 0px;\">";
if ($lat == 0) {
echo "<img width=\"16\" src=\"images/marker_red.png\" title=\"Not placed on map\">";
}
else {
echo "<img width=\"16\" src=\"images/marker_green.png\" title=\"Placed on map\">";
}
echo "</td><td><div align=\"left\"><font size=\"2\"><b>$nameint</b></font><br/>$mac</div></td><td class=\"abon_name\">$comments</td>";

if ($pwr == "Offline" or $ping == 0) {
echo "<td style=\"padding:0px;\"><font color=\"red\">$last_pwr</font></td><td style=\"padding:0px;\">$last_act</td>";
} else {
echo "<td style=\"padding:0px;\">";
echo $pwr;
echo "</td><td style=\"padding:0px;\"></td>";
}

$tmp = explode('/', $nameint);
$epon_sfp = end($tmp);
$epon_sfp = explode(':', $epon_sfp);
$epon_sfp = $epon_sfp[0];


echo "<td style=\"width: 12px; padding:0px;\"><a href=\"index.php?page=unbind_onu&ip=$ip&mac=$mac&sfp=$epon_sfp\"  onclick=\"return confirm('Отвязать ONU от OLT? ONU будет оставаться в списке этого OLT пока не будет заново обнаружена на любом изестном 
OLTе')\">X</a></td></tr>";
}


?>
</table>
