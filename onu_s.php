История сигналов
<br/>
<br/>
<?php



echo "<br/><font size=\"2\">Показать последние&nbsp;&nbsp;";
echo "<a href=\"?page=onu&olt=$ip&mac=$mac&show=onu_s&count=50\">50</a> &nbsp;&nbsp;";
echo "<a href=\"?page=onu&olt=$ip&mac=$mac&show=onu_s&count=100\">100</a> &nbsp;&nbsp;";
echo "<a href=\"?page=onu&olt=$ip&mac=$mac&show=onu_s&count=500\">500</a> &nbsp;&nbsp;";
echo "<a href=\"?page=onu&olt=$ip&mac=$mac&show=onu_s&count=1000\">1000</a> &nbsp;&nbsp;";
echo "измерений</font><br/><br/><div align=\"center\">";


if ($count==NULL) {
$count=50;
}

$conn = mysqli_connect($mysql_host, $mysql_user, $mysql_pass);
mysqli_query($conn, "SET NAMES utf8");
mysqli_select_db($conn, $mysql_db);
$sql = "select * from ( select * from onus_s where mac=\"$mac\" order by datetime desc limit $count ) sub order by datetime DESC;";
$retval = mysqli_query( $conn, $sql );
if(! $retval )
{
  die('Could not enter data: ' . mysqli_error($conn));
}
$number = mysqli_num_rows($retval);

?>
<table border="0"  cellpadding="10" cellspacing="0">



<?php
if ($number == 0) {
echo "Onu not measured";
} else {

  while ($row=mysqli_fetch_array($retval)) {



$pwr = $row['pwr'];
$datetime = $row['datetime'];


echo "<tr class=\"rx\"><td class=\"rx\">$datetime</td><td class=\"rx\">&nbsp;&nbsp;&nbsp;&nbsp;<font color=\"orange\">$pwr</font></td></tr>";


}

}
mysqli_close($conn);
echo "</table></div>";
//echo "<img src=\"graph_test.php?olt=$tables&iface=$iface\">";
?>

