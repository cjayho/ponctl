<?php
include 'vars.php';
$mac = $_GET["mac"];
$ip = $_GET["ip"];
$sfp = $_GET["sfp"];
include 'get_rw.php';

if ($mac == NULL) {
echo "Ошибка: не указан MAC ONU";
} else if ($sfp == NULL) {
echo "Ошибка: не указан № интерфейса";
} else {

include 'make_bdcom_mac.php';

	$username = "$telnet_user";
	$password = "$telnet_pass";
    $con = pfsockopen($ip, 23, $errno, $errstr, 10);

    $login = $username."\r\n";
    fwrite($con, $login);
    $pass = $password."\r\n";
    fwrite($con, $pass);
    $command = "enable\r\n";
    sleep(1);


  if ($enable_pass != NULL){
    $enable_password = "$enable_pass";
    $en_pass = $enable_password."\r\n";
    fwrite($con, $en_pass);
    sleep(1);
}


    fwrite($con, $command);
    sleep(1);
    fwrite($con,"\r\n");
    sleep(1);
    fwrite($con, "conf\r\n");
    sleep(1);
    $command = "int epon0/".$sfp."\r\n";
    fwrite($con, $command);
    sleep(1);
    $command = "no epon bind-onu mac ".$bdcom_mac."\r\n";
    fwrite($con, $command);
    sleep(1);


fclose($con);

//Write
snmp2_set($ip, $rw, "1.3.6.1.4.1.3320.20.15.1.1.0", i, "1");

header("Location: http://$host$uri/$extra?page=olt&olt=$ip");

}
?>
