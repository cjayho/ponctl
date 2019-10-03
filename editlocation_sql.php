<?php
$dbhost = 'localhost';
$dbuser = 'root';
$dbpass = 'lfgj[eqnfrbcnfdm';
$host  = $_SERVER['HTTP_HOST'];
$uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
$olt = $_GET["olt"];
$mac = $_GET["mac"];
$extra = "index.php?page=onu&olt=$olt&mac=$mac";
include 'vars.php';


$conn = mysqli_connect($mysql_host, $mysql_user, $mysql_pass);
mysqli_query($conn, "SET NAMES utf8");
if(! $conn )
{
  die('Could not connect: ' . mysqli_error($conn));
}

if(! get_magic_quotes_gpc() )
{
   $latlongmet = addslashes ($_POST['latlongmet']);

}
else
{
   $latlongmet = $_POST['latlongmet'];

}
$lat = substr($latlongmet, 0, -8);
$lon = substr($latlongmet, 8);



$sql = "UPDATE onus ".
       "SET lat=\"$lat\", lon=\"$lon\" WHERE mac=\"$mac\"";
mysqli_select_db($conn, $mysql_db);
$retval = mysqli_query( $conn, $sql );
if(! $retval )
{
  die('Could not enter data: ' . mysqli_error($conn));
}

header("Location: http://$host$uri/$extra");
mysqli_close($conn);

?>
