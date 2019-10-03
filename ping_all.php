<?php
include 'vars.php';
$extra = 'index.php';



$conn = mysqli_connect($mysql_host, $mysql_user, $mysql_pass);
mysqli_query($conn, "SET NAMES utf8");
mysqli_select_db($conn, $mysql_db);
$psql = "select * from olts order by ip";
$pretval = mysqli_query( $conn, $psql );
if(! $pretval )
{
  die('Could not enter data: ' . mysqli_error($conn));
}

  while ($row=mysqli_fetch_array($pretval)) {



$sql_ip = $row['ip'];
$ro = $row['ro'];
$ip = long2ip($sql_ip);
include 'ping.php';

if ($ping == 0) {
} else {

$sql_req = "UPDATE olts SET last_act=\"$date\" WHERE ip='$sql_ip'";
$retval_ping = mysqli_query( $conn, $sql_req );
if(! $retval_ping )
{
  die('Could not enter data: ' . mysqli_error($conn));
}


$table = str_replace (".", "_", $ip);
include 'get_snmp.php';



}



}
mysqli_close($conn);
header("Location: http://$host$uri/$extra?page=olt_list");

?>
