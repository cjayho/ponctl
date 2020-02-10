<div align="center">
<?php
	$username = "$telnet_user";
	$password = "$telnet_pass";
    $con = pfsockopen($ip, 23, $errno, $errstr, 10);

    $login = $username."\r\n";
    fwrite($con, $login);
    $pass = $password."\r\n";
    fwrite($con, $pass);
    $command = "enable\r\n";
    sleep(1);
    fwrite($con, $command);


  if ($enable_pass == NULL) {
} else {
    $enable_password = "$enable_pass";
    $en_pass = $enable_password."\r\n";
    fwrite($con, $en_pass);
    sleep(1);
}

    fwrite($con, "show mac address-table int $nameint \r\n");
    sleep(2);
$out = fread($con, 16536);
$out = end(explode(' -----', $out));
$arr_out = explode("\n", $out);
while (trim(array_pop($arr_out)) == "--More--") {
 fwrite($con, chr(32));
    sleep(2);
$arr_tmp = explode("\r\n", fread($con, 16536));
$arr_out = array_merge($arr_out,$arr_tmp);
}


fclose($con);
$count = 0;
echo "<table border=\"0\" cellspacing=\"5\">";
while ($count <= count($arr_out)) {
$out_mac = $arr_out[$count];

$out_mac = explode('DYN', $out_mac);
$out_mac = $out_mac[0];
$out_mac = ltrim($out_mac, "0..9");
$out_mac = trim($out_mac);
$out_mac = substr($out_mac, -14);
$us_mac = str_replace(".", "", "$out_mac");
$us_mac = str_replace("a", "A", "$us_mac");
$us_mac = str_replace("b", "B", "$us_mac");
$us_mac = str_replace("c", "C", "$us_mac");
$us_mac = str_replace("d", "D", "$us_mac");
$us_mac = str_replace("e", "E", "$us_mac");
$us_mac = str_replace("f", "F", "$us_mac");
if ($us_mac == NULL) {
} else {
echo "<tr><td><div style=\"display: table-cell; vertical-align: middle; \">";

$us_formatted_mac = preg_replace('~..(?!$)~', '\0:', $us_mac);

echo $us_formatted_mac;
echo "</div></td><td>";
if ($us_mac == NULL) {
} else if ($us_mac == str_replace(":", "", $mac)) {
echo "<font color=\"green\">ONU</font></td>";
if ($use_userside == "yes") {
echo "<td></td>";
} else {
}
} else if ($use_userside == "yes") {
include 'get_us_mac_data.php';
echo $us_mac_out;
echo "</td><td>";

if ($us_mac_type == 1) {
echo "<a href=\"fix_onu.php?olt=$ip&mac=$mac&code=$us_usercode\">Закрепить</a>";
}
else {
}


} else {
}
echo "</td></tr>";
}
$count = $count + 1;
}
echo "</table>";
?>
</div>
