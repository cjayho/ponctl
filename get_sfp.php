<?php
include 'vars.php';
$ip_sql = sprintf('%u', ip2long($ip));
$conn = mysqli_connect($mysql_host, $mysql_user, $mysql_pass);
mysqli_query($conn, "SET NAMES utf8");
mysqli_select_db($conn, $mysql_db);
$sql = "select * from olts where ip='$sql_ip'";
$retval = mysqli_query( $conn, $sql );
if(! $retval )
{
  die('Could not enter data: ' . mysqli_error($conn));
}

  while ($row=mysqli_fetch_array($retval)) {

$numsfp = $row['numsfp'];
}


?>
