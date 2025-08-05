<?php
define("CAN_NOT_CONNECT_SERVER", "Can't connect to server");
require("../ApiClient.php");

$api = new ApiClient();
$orderId = 111581;

//login api
$cmd = $api->buildCommand('client', 'Login');
$rs  = $api->request($cmd);
if ($rs) {
	//something error happen
	$lastResult = $api->getLastResult();
	$error = getError(__LINE__, $rs, $lastResult);
	die($error);
}

$reissueParams = array(
    'orderId' => $orderId,
	'CSR' => '-----BEGIN CERTIFICATE REQUEST-----
MIICmjCCAYICAQAwVTELMAkGA1UEBhMCR0IxEjAQBgNVBAgTCUJlcmtzaGlyZTEQ
MA4GA1UEBxMHTmV3YnVyeTENMAsGA1UEChMEZGVtbzERMA8GA1UEAxMIZGVtby5j
b20wggEiMA0GCSqGSIb3DQEBAQUAA4IBDwAwggEKAoIBAQDOCLpdIOk3VAFAN/cl
8SDOeCZsEgts2CG5SLUrUs/rbRJdRHi6fZC1zhLHkoVUZ46aEF9GX+A7CJaD9LyK
D27yc2cNkGGBHrgZ1Y5h1CK/IDUFfVZHz6O1dachi0HodS/9FDxM0fAJGv5pX/tR
35TPWAldIc99YHY4VhsSLAA01p6v7yU2ANScYfr+gT+Db8mIvWWGCtlUTEytehMZ
ne56k6CC5/rWntiw1sb0xWNDY+myQVkQtWldJu5x+s+kwgwOF8BZ3r540v97ukHA
gFTMVotCXS9AEw+aujDUB/1hS4l55PANzPPo4p1BV0rOi83LCa/yQSITS8ihco4n
ujSlAgMBAAGgADANBgkqhkiG9w0BAQQFAAOCAQEAKPoB4zvLyxggB24EUZf1tgmy
2Ne/mSKaC2dY1gm1yglpWdhcXxLhCFd2j9vKs00qJ6HLbpSIEaiS8QeFEfQvAaK8
7DFEmcbD9Kt5fYtpvGo5JgwO6NZUWAjyYXsNLC90N8vJHRDxj3me3p2ERTfXyg4m
iWLi+9fKwHMJiDp+hDmmXInTJJ7hRd1rzxB0k6AHl2oN8bCDZ4B9gvaSSwfimIVm
yiwhx/S0EZxVaP3mn311PodmO5kAjdS9Ku6Idxz8kxQQCeGcsQhSoIqJC+7zQcgH
wN0YCJr/GrDzt2qzGKf8G75FZgS9BzNVTg+F8VgAeOkwq2elvLON9TDIcFPkDw==
-----END CERTIFICATE REQUEST-----',
	'DNSNames' => '',
);
$cmd        = $api->buildCommand('ssl', 'Reissue', $reissueParams);
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
