<?php


// ---------- Get iface number on OLT by MAC ONU ----------
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

$key = end(explode('10.1.1.3.', $key));

$real_mac_spaced = trim(end(explode('STRING: ', $type)));
if ($real_mac_spaced == $mac_spaced) {
$iface = $key;
}

}

}

// END ----------


?>
