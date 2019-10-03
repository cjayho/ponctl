<?php
include 'vars.php';
$extra = 'index.php';


$table = $_POST["olt"];
$ro = $_POST["ro"];
$rw = $_POST["rw"];
$place = $_POST["place"];
$numsfp = $_POST["numsfp"];

if ($ro == NULL) {
$ro = "public";
} else {
}

if ($rw == NULL) {
$rw = "private";
} else {
}





if (!filter_var($table, FILTER_VALIDATE_IP))
{
echo "wrong ip";
} else {
$ip = $table;
$table = str_replace (".", "_", $table);
$ip_sql = sprintf('%u', ip2long($ip));


$conn = mysqli_connect($mysql_host, $mysql_user, $mysql_pass);
mysqli_query($conn, "SET NAMES utf8");
mysqli_select_db($conn, $mysql_db);




$sql = "CREATE TABLE IF NOT EXISTS onus (`olt` INT UNSIGNED, `name` varchar(16) DEFAULT NULL,   `mac` varchar(18) UNIQUE,   `code` varchar(256) DEFAULT NULL, `dist` varchar(16) DEFAULT NULL, `pwr` varchar(16) DEFAULT NULL, `last_pwr` varchar(16) DEFAULT NULL, `last_activity` varchar(24) DEFAULT NULL, `lat` varchar(16) DEFAULT NULL, `lon` varchar(16) DEFAULT NULL, `comments` varchar(256) DEFAULT NULL, `type` varchar(10) DEFAULT NULL)";
$retval = mysqli_query( $conn, $sql );
if(! $retval )
{
  die('Could not enter data: ' . mysqli_error($conn));
}



$sql = "CREATE TABLE IF NOT EXISTS onus_s (`olt` INT UNSIGNED, `mac` varchar(18), `pwr` varchar(16), `datetime` varchar(21))";
$retval = mysqli_query($conn, $sql );
if(! $retval )
{
  die('Could not enter data: ' . mysqli_error($conn));
}




$sql = "INSERT INTO olts (ip, place, ro, rw, last_act, lat, lon, numsfp) VALUES ('$ip_sql', '$place', '$ro', '$rw', '01.01.2000 00:00:00', '0', '0', '$numsfp')";



$retval = mysqli_query( $conn, $sql );
if(! $retval )
{
  die('Could not enter data: ' . mysqli_error($conn));
}



include 'ping.php';


if ($ping == 0) {
echo "OLT $ip is not available";
} else {

$sql = "UPDATE olts SET last_act=\"$date\" WHERE ip='$ip_sql'";
$retval = mysqli_query( $conn, $sql );
if(! $retval )
{
  die('Could not enter data: ' . mysqli_error($conn));
}
}


mysqli_close($conn);
header("Location: http://$host$uri/$extra?page=olt_list");
}
?>
