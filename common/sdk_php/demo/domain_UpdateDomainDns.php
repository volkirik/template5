<?php
define("CAN_NOT_CONNECT_SERVER", "Can't connect to server");
require("../ApiClient.php");

$api = new ApiClient();
$domainType = 2001;
$domain     = 'ccb.bike';

//login api
$cmd = $api->buildCommand('client', 'Login');
$rs  = $api->request($cmd);
if ($rs) {
	//something error happen
	$lastResult = $api->getLastResult();
	$error = getError(__LINE__, $rs, $lastResult);
	die($error);
}

//UpdateDomainDns
$params = array(
	'domaintype' => $domainType,
	'domain'     => $domain,
	'nameserver' => array('ns1.dns-diy.net','ns2.dns-diy.net','ns3.dns-diy.net'),//input new dns
);
$cmd        = $api->buildCommand('domain', 'UpdateDomainDns', $params);
$rs         = $api->request($cmd);
$lastResult = $api->getLastResult();
if ($rs) {
	$error = getError(__LINE__, $rs, $lastResult);
    die($error);
} else {
	var_dump($lastResult);
}

//logout api
$cmd = $api->buildCommand('client', 'Logout');
$rs  = $api->request($cmd);

function getError($line, $rs, $lastResult) {
	switch($rs) {
        case 1:
            $error = CAN_NOT_CONNECT_SERVER;
            break;
        case 2:
            $error = '[description]:' . $lastResult['msg'] . '[additional]:' . $lastResult['value'];
            break;
        default:
            $error = 'unknow error';
            break;
    }
	return "Line:".$line."|".$error."\n";
}
