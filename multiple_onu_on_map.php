<?php
include 'vars.php';
$conn = mysqli_connect($mysql_host, $mysql_user, $mysql_pass);
mysqli_query($conn, "SET NAMES utf8");
mysqli_select_db($conn, $mysql_db);
if(! $conn )
{
  die('Could not connect: ' . mysqli_error($conn));
}
$ip_sql = sprintf('%u', ip2long($ip));
$sql = "SELECT * FROM onus WHERE name LIKE \"EPON0/$sfp%\" AND olt=\"$ip_sql\"";
$res = mysqli_query($conn, $sql) or die(mysqli_error($conn));

 while ($row=mysqli_fetch_array($res)) {

$lon = $row['lon'];
$lat = $row['lat'];
$mac = $row['mac'];
$nameint = $row['name'];
$pwr = $row['pwr'];
$comments = $row['comments'];
include 'nameint_del_zero.php';
if ($pwr == "Offline") {
$twirl_color = "red";
} else {
$twirl_color = "green";
}

if ($lat == 0) {
} else {
include 'addmark2.php';
}

}
?>
