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

//UpdateDomainStatus
$params = array(
	'domaintype' => $domainType,
	'domain'     => $domain,
	'addstatus'  => 'clientTransferProhibited', //Add the status of clientTransferProhibited to the domain name.
	//'remstatus'  => 'clientTransferProhibited', //remove the status of clientTransferProhibited from the domain name.
);
$cmd        = $api->buildCommand('domain', 'UpdateDomainStatus', $params);
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
