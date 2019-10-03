<?php
$conn = mysqli_connect($mysql_host, $mysql_user, $mysql_pass);
mysqli_query($conn, "SET NAMES utf8");
mysqli_select_db($conn, $mysql_db);
$sql = "select * from onus WHERE mac='$mac'";
$retval = mysqli_query( $conn, $sql );

if(! $retval )
{
	die('Could not enter data: ' . mysqli_error($conn));
}

while ( $row = mysqli_fetch_array( $retval ) )
{
	$lat = $row['lat'];
	$lon = $row['lon'];
}

mysqli_close($conn);

if ($lat == NULL)
{
	$lat = 0;
}

if ($lon == NULL)
{
	$lon = 0;
}


?>
