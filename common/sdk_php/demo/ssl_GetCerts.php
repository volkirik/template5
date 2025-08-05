<?php
define("CAN_NOT_CONNECT_SERVER", "Can't connect to server");
require("../ApiClient.php");

$api = new ApiClient();

//login api
$cmd = $api->buildCommand('client', 'Login');
$rs  = $api->request($cmd);
if ($rs) {
	//something error happen
	$lastResult = $api->getLastResult();
	$error = getError(__LINE__, $rs, $lastResult);
	die($error);
}

$getCertsParams = array(
	'fromDate' => date("Y-m-d", strtotime("-4 day")),
	'toDate'   => date("Y-m-d")
);
$cmd        = $api->buildCommand('ssl', 'GetCerts', $getCertsParams);
$rs         = $api->request($cmd);
$lastResult = $api->getLastResult();
if ($rs) {
	$error = getError(__LINE__, $rs, $lastResult);
    die($error);
} else {
	var_dump($lastResult['resData']);
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
