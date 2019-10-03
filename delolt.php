<?php
include 'vars.php';
$extra = 'index.php';


$table = $_GET["olt"];
$ip = str_replace ("_", ".", $table);
$sql_ip = sprintf('%u', ip2long($ip));
$conn = mysqli_connect($mysql_host, $mysql_user, $mysql_pass);
mysqli_query($conn, "SET NAMES utf8");
mysqli_select_db($conn, $mysql_db);



$sql = "DELETE FROM olts WHERE ip='$sql_ip'";
$retval = mysqli_query( $conn, $sql );
if(! $retval )
{
  die('Could not enter data: ' . mysqli_error($conn));
}

$sql = "DELETE FROM onus WHERE olt='$sql_ip'";
$retval = mysqli_query( $conn, $sql );
if(! $retval )
{
  die('Could not enter data: ' . mysqli_error($conn));
}



$sql = "DELETE FROM onus_s WHERE olt='$sql_ip'";
$retval = mysqli_query( $conn, $sql );
if(! $retval )
{
  die('Could not enter data: ' . mysqli_error($conn));
}





mysqli_close($conn);
header("Location: http://$host$uri/$extra?page=olt_list");

?>
