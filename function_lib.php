<?php


// ---------- Correct function ip2long for work on 32bit systems

function ip2longfixed($ip) {
$sql_ip = sprintf('%u', ip2long($ip));
return $sql_ip;
}

// END ----------



// ----------Get PVID on port ----------

function GetPVID($ip, $ro, $iface, $port) {
$pvid = snmp2_get($ip, $ro, "1.3.6.1.4.1.3320.101.12.1.1.3.$iface.$port");
$tmp = explode('INTEGER: ', $pvid);
$pvid = end($tmp);
return $pvid;
}


// ----------Get num ports on ONU ----------

function GetNumPorts($ip, $ro, $iface) {

$Array_num_ports = snmprealwalk($ip, $ro, "1.3.6.1.4.1.3320.101.12.1.1.8.$iface");
if(count($Array_num_ports)>0)
 foreach($Array_num_ports as $oid => $result)
 {
   $num_ports = $oid;
 }

$tmp = explode("12.1.1.8.$iface.", $num_ports);
$num_ports = end($tmp);
return $num_ports;
}

// END ----------






// ----------Get copper port state on ONU ----------

function OnuCopperPortState($ip, $ro, $iface, $port) {
$port_state = snmp2_get($ip, $ro, "1.3.6.1.4.1.3320.101.12.1.1.7.$iface.$port");
$tmp = explode('INTEGER: ', $port_state);
$port_state = end($tmp);
// 1 - Enabled, 2 - Disabled
return $port_state;
}

// END ----------


// ----------Get copper link state on ONU ----------

function OnuCopperLinkState($ip, $ro, $iface, $port) {
$link_state = snmp2_get($ip, $ro, "1.3.6.1.4.1.3320.101.12.1.1.8.$iface.$port");
$tmp = explode('INTEGER: ', $link_state);
$link_state = end($tmp);
// 1 - Link down, 2 - Link up
return $link_state;
}

// END ----------





// ---------- Get iface number on OLT by MAC ONU ----------
function IfaceByMac($ip, $ro, $mac) {
$mac_spaced = str_replace(':',' ',$mac);
$mac_spaced = str_replace('a','A',$mac_spaced);
$mac_spaced = str_replace('b','B',$mac_spaced);
$mac_spaced = str_replace('c','C',$mac_spaced);
$mac_spaced = str_replace('d','D',$mac_spaced);
$mac_spaced = str_replace('e','E',$mac_spaced);
$mac_spaced = str_replace('f','F',$mac_spaced);

$Array_descr = snmprealwalk($ip, $ro, ".1.3.6.1.4.1.3320.101.10.1.1.3");

if(count($Array_descr)>0)
{
	foreach($Array_descr as $key => $type)
	{

$tmp = explode('10.1.1.3.', $key);
$key = end($tmp);

$tmp = explode('STRING: ', $type);
$real_mac_spaced = trim(end($tmp));
if ($real_mac_spaced == $mac_spaced) {
$iface = $key;
}

}

}
return $iface;
}
// END ----------



// ----------Get distance to ONU by Iface----------

function DistById($ip, $ro, $iface) {
$dist = snmp2_get($ip, $ro, ".1.3.6.1.4.1.3320.101.10.1.1.27.$iface");
$tmp = explode('INTEGER: ', $dist);
$dist = end($tmp);
return $dist;
}

// END ----------



// ----------Get RX level by Interface ID----------

function RxById($ip, $ro, $iface) {
// Get RX level with "INTEGER: "
  $rx = snmp2_get($ip, $ro, ".1.3.6.1.4.1.3320.101.10.5.1.5.$iface");

// Get CLEAN RX level
$tmp = explode('INTEGER: ', $rx);
$rx = end($tmp);
$tmp = explode('OID', $rx);
$rx = end($tmp);
if ($rx == 0 OR !$rx OR $rx == NULL OR $rx == -65536) {
$rx = "Offline";
} else {
$rx=($rx/10);

$rx=sprintf("%.1f", $rx);
}
return $rx;
}

// END ----------Get RX level by Interface ID----------






// ----------Get PON interface name by Interface ID----------


function NameById($ip, $ro, $iface) {
$iface_name = snmp2_get($ip, $ro, "1.3.6.1.2.1.2.2.1.2.$iface");

//Get CLEAN name
$tmp = explode(' ', $iface_name);
$iface_name = end($tmp);
$iface_name = str_replace("\"", "", $iface_name);


return $iface_name;
}

// END ----------Get PON interface name by Interface ID----------





// ----------Get MAC ADDRESS of ONU by nterface ID----------
function MacById($ip, $ro, $iface) {
$mac = snmp2_get($ip, $ro, "1.3.6.1.4.1.3320.101.10.1.1.3.$iface");
$mac = trim(end(explode(':', $mac)));
$mac = str_replace (" ", ":", $mac);
return $mac;
}

// END ----------

// ----------Get TEMPERATURE of ONU by nterface ID----------
function TempById($ip, $ro, $iface) {
$temp = snmp2_get($ip, $ro, "1.3.6.1.4.1.3320.101.10.5.1.2.$iface");
$temp = end(explode(' ', $temp));
$temp = $temp/256;
return $temp;
}

// END ----------


// ---------- Delete zero from interface name for correct sorting ----------

function NameIntDelZero($nameint) {
$nameint = str_replace (":0", ":", $nameint);
return $nameint;
}

// END ----------


// ---------- Add zero to interface name for correct sorting ----------

function NameIntAddZero($nameint) {
$end = end(explode(':', $nameint));
$count = strlen($end);
if ($count == 1){
$nameint = str_replace (":1", ":01", $nameint);
$nameint = str_replace (":2", ":02", $nameint);
$nameint = str_replace (":3", ":03", $nameint);
$nameint = str_replace (":4", ":04", $nameint);
$nameint = str_replace (":5", ":05", $nameint);
$nameint = str_replace (":6", ":06", $nameint);
$nameint = str_replace (":7", ":07", $nameint);
$nameint = str_replace (":8", ":08", $nameint);
$nameint = str_replace (":9", ":09", $nameint);

}
return $nameint;
}

// END ----------




// ---------- MYSQL update last activity of OLT ----------
function UpdateOltLastAct($conn, $sql_ip, $date) {
$sql = "UPDATE olts SET last_act='$date' WHERE ip='$sql_ip'";
$retval = mysqli_query( $conn, $sql );
if(! $retval )
{
  die('Could not enter data: ' . mysqli_error($conn));
}
}

// END ----------





// ---------- MYSQL Update/Add ONU ----------
function UpdateOnu($conn, $sql_ip, $date, $nameint, $mac, $rx) {


$sql = "INSERT INTO onus (olt,name,mac,pwr) VALUES ('$sql_ip','$nameint','$mac','$rx') ON DUPLICATE KEY UPDATE name=VALUES(name), olt=VALUES(olt),pwr=VALUES(pwr)";
$retval = mysqli_query( $conn, $sql );
if(! $retval )
{
}

if ($rx == "Offline") {
$rx = 0;
} else {



$sql = "UPDATE onus SET olt='$sql_ip',last_pwr='$rx',last_activity='$date' WHERE mac='$mac'";
$retval = mysqli_query( $conn, $sql );
if(! $retval )
{
  die('Could not enter data: ' . mysqli_error($conn));
}

}



$sql = "INSERT INTO onus_s (olt,mac,pwr,datetime) VALUES ('$sql_ip','$mac','$rx','$date')";
$retval = mysqli_query( $conn, $sql );
if(! $retval )
{
  die('Could not enter data: ' . mysqli_error($conn));
}




}

// END ----------




?>

