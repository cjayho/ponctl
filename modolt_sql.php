<?php
include 'vars.php';
$extra = 'index.php';

$ip = $_GET["olt"];
$ip_new = $_POST["ip"];
$ro = $_POST["ro"];
$rw = $_POST["rw"];
$place = $_POST["place"];
$numsfp = $_POST["numsfp"];


if ($ro == NULL) {
$ro = "public";
}

if ($rw == NULL) {
$rw = "private";
}


if ($place == NULL) {
$place = " ";
}

if ($comm == NULL) {
$comm = " ";
}




if (!filter_var($ip_new, FILTER_VALIDATE_IP))
{
echo "wrong ip";
} else {

$ip_sql = sprintf('%u', ip2long($ip));
$ip_sql_new = sprintf('%u', ip2long($ip_new));

$conn = mysqli_connect($mysql_host, $mysql_user, $mysql_pass);
mysqli_query($conn, "SET NAMES utf8");
mysqli_select_db($conn, $mysql_db);



$sql = "UPDATE olts SET ip='$ip_sql_new', place='$place', ro='$ro', rw='$rw', numsfp='$numsfp' WHERE ip='$ip_sql'";
$retval = mysqli_query( $conn, $sql );

if(! $retval )
{
  die('Could not enter data: ' . mysqli_error($conn));
}


$sql = "UPDATE onus SET olt='$ip_sql_new' WHERE olt='$ip_sql'";
$retval = mysqli_query( $conn, $sql );
if(! $retval )
{
  die('Could not enter data: ' . mysqli_error($conn));
}



mysqli_close($conn);
header("Location: http://$host$uri/$extra?page=olt&olt=$ip_new");
}
?>
