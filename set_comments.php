<?php
include 'vars.php';
$ip = $_GET["olt"];
$mac = $_GET["mac"];
$comments = $_POST['comments'];
$host  = $_SERVER['HTTP_HOST'];
$uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
$extra = "index.php?page=onu&olt=$ip&mac=$mac";

$conn = mysqli_connect($mysql_host, $mysql_user, $mysql_pass);
mysqli_query($conn, "SET NAMES utf8");
mysqli_select_db($conn, $mysql_db);
$sql = "UPDATE onus SET comments='$comments' WHERE mac='$mac'";
$retval = mysqli_query( $conn, $sql );
if(! $retval )
{
  die('Could not enter data: ' . mysqli_error($conn));
}

mysqli_close($conn);


header("Location: http://$host$uri/$extra");
?>
