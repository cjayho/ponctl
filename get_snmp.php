<?php
include 'vars.php';
$extra = 'index.php';
if ($table == NULL) {
$table = $_GET["olt"];
} else {
}



$ip = str_replace ("_", ".", $table);

include 'get_ro.php';
include 'get_rw.php';
include_once 'function_lib.php';


$sql_ip = ip2longfixed($ip);

$conn = mysqli_connect($mysql_host, $mysql_user, $mysql_pass);
mysqli_query($conn, "SET NAMES utf8");
mysqli_select_db($conn, $mysql_db);
UpdateOltLastAct($conn, $sql_ip, $date);

$Array_descr = snmprealwalk($ip, $ro, ".1.3.6.1.4.1.3320.101.10.1.1.26");


 if(count($Array_descr)>0)
 {
 foreach($Array_descr as $key => $type)
 {

$key = end(explode('10.1.1.26.', $key));

$type = NameById($ip, $ro, $key);

 $olt = strtok($type, ":");

 if(preg_match("#:#", $type))
 {
$rx = RxById($ip, $ro, $key);
$nameint = NameIntAddZero(NameById($ip, $ro, $key));
$mac = MacById($ip, $ro, $key);
UpdateOnu($conn, $sql_ip, $date, $nameint, $mac, $rx);


}
}

}




header("Location: http://$host$uri/$extra?page=olt&olt=$table");
?>
