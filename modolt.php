<?php
include 'vars.php';
$table = $_GET["olt"];
$ip = str_replace ("_", ".", $table);
$ip_sql = sprintf('%u', ip2long($ip));

$conn = mysqli_connect($mysql_host, $mysql_user, $mysql_pass);
mysqli_query($conn, "SET NAMES utf8");
mysqli_select_db($conn, $mysql_db);
$sql = "select * from olts where ip='$ip_sql'";
$retval = mysqli_query( $conn, $sql );

if(! $retval )
{
	die('Could not enter data: ' . mysqli_error($conn));
}

while ($row=mysqli_fetch_array($retval)) {
	$place = $row['place'];
	$numsfp = $row['numsfp'];
	$ro = $row['ro'];
	$rw = $row['rw'];
}

?>
<div align=center>
<h2>
Редактирование OLT
</h2>
<br/>
<br/>
<form method="post" action="modolt_sql.php?olt=<?=$ip?>">
IP адрес: <input required name="ip" size=13 type="text" id="ip" value="<?=$ip?>"><br/>
SNMP ro: <input name="ro" size=13 type="text" id="ro"  value="<?=$ro?>"><br/>
SNMP rw: <input name="rw" size=13 type="text" id="rw"  value="<?=$rw?>"><br/>
Место: <input name="place" size=13 type="text" id="place"  value="<?=$place?>"><br/>
Кол-во PON SFP: <input name="numsfp" size=13 type="text" id="numsfp"  value="<?=$numsfp?>"><br/>
<br/>
<input name="add" type="submit" id="add" value="Сохранить" style="width:80px">
</form>
</div>
