<?php
define("CAN_NOT_CONNECT_SERVER", "Can't connect to server");
require("../ApiClient.php");
/**
SSL Certificates Quick Start Guide

Step 1: Generate CSR
You need to generate a CSR from your server, if you don¡¯t know how, please refer to : 
https://www.geotrust.com/support/generate-csr/index.html

Step 2: Parse CSR 
Obtain the domain name in CSR and go the next step

Step 3: GetApproverEmailList
Retrieve a list of valid Approver Email List with commend GetApproverEmailList
**/

$api = new ApiClient();

$postParams = array(
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
-----END CERTIFICATE REQUEST-----',//this is a demo for demo.com
	'productCode'       => 'RapidSSL',
	'validityPeriod'    => 12,//12 monthes
	'webServerType'     => 'apachessl',
	'aFirstName'        => 'demo firstname',
	'aLastName'         => 'demo lastname',
	'aPhone'            => '+86.123456789',
	'aEmail'            => 'demo@onlinenic.com',
	'tFirstName'        => 'demo firstname',
	'tLastName'         => 'demo lastname',
	'tPhone'            => '+86.123456789',
    'tEmail'            => 'demo@onlinenic.com',
	'specialInstructions' => '',
	/* 
	'organizationName'  => '',//when productCode=TrueBizIDEV, not null
	'oFax'              => '',//when productCode=TrueBizIDEV, not null
	'oPhone'            => '',//when productCode=TrueBizIDEV, not null
	'oCountry'          => '',//when productCode=TrueBizIDEV, not null
	'oPostalCode'       => '',//when productCode=TrueBizIDEV, not null
	'oRegion'           => '',//when productCode=TrueBizIDEV, not null
	'oCity'             => '',//when productCode=TrueBizIDEV, not null
	'oAddressLine1'     => '',//when productCode=TrueBizIDEV, not null
	'oAddressLine2'     => '',//when productCode=TrueBizIDEV, not null
	'oAddressLine3'     => '',//when productCode=TrueBizIDEV, not null
	'DUNS'              => '',//when productCode=TrueBizIDEV, not null
	*/
	'DNSNames'          => '',//Additional domains
	'renewalIndicator'  => 'false',//true = renew order, false = initiate order
);
//login api
$cmd = $api->buildCommand('client', 'Login');
$rs  = $api->request($cmd);
if ($rs) {
	//something error happen
	$lastResult = $api->getLastResult();
	$error = getError(__LINE__, $rs, $lastResult);
	die($error);
}

//Parse CSR 
$parseCsrParams = array(
    'productCode' => $postParams['productCode'],
    'CSR'         => $postParams['CSR'],
);
$cmd        = $api->buildCommand('ssl', 'ParseCSR', $parseCsrParams);
$rs         = $api->request($cmd);
$lastResult = $api->getLastResult();
if ($rs) {
	$error = getError(__LINE__, $rs, $lastResult);
    die($error);
} else {
	$domain           = $lastResult['resData']['DomainName'];
}

//GetApproverEmailList
$getApproverEmailListParams = array(
    'domain' => $domain,
);
$cmd        = $api->buildCommand('ssl', 'GetApproverEmailList', $getApproverEmailListParams);
$rs         = $api->request($cmd);
$lastResult = $api->getLastResult();
if ($rs) {
    $error = getError(__LINE__, $rs, $lastResult);
    die($error);
} else {
    $approverEmailList = $lastResult['resData']['email'];
}

//OrderSSL
$orderSslParams = array(
    'productCode' => $postParams['productCode'],
    'validityPeriod' => $postParams['validityPeriod'],
    'webServerType'  => $postParams['webServerType'],
    'aFirstName'     => $postParams['aFirstName'],
    'aLastName'      => $postParams['aLastName'],
    'aPhone'         => $postParams['aPhone'],
    'aEmail'         => $postParams['aEmail'],
    'tFirstName'     => $postParams['tFirstName'],
    'tLastName'      => $postParams['tLastName'],
    'tPhone'         => $postParams['tPhone'],
    'tEmail'          => $postParams['tEmail'],
    'specialInstructions' => $postParams['specialInstructions'],
    'approverEmail'  => $approverEmailList[0],
    'CSR'            => $postParams['CSR'],
	//'organizationName'  => $postParams['organizationName'],
	//'oFax'              => $postParams['oFax'],
	//'oPhone'            => $postParams['oPhone'],
	//'oCountry'          => $postParams['oCountry'],
	//'oPostalCode'       => $postParams['oPostalCode'],
	//'oRegion'           => $postParams['oRegion'],
	//'oCity'             => $postParams['oCity'],
	//'oAddressLine1'     => $postParams['oAddressLine1'],
	//'oAddressLine2'     => $postParams['oAddressLine2'],
	//'oAddressLine3'     => $postParams['oAddressLine3'],
	//'DNSNames'          => $postParams['DNSNames'],
    //'DUNS'              => $postParams['DUNS'],
	'renewalIndicator'  => $postParams['renewalIndicator'],
);
$cmd        = $api->buildCommand('ssl', 'Order', $orderSslParams);
$rs         = $api->request($cmd);
$lastResult = $api->getLastResult();
if ($rs) {
    $error = getError(__LINE__, $rs, $lastResult);
    die($error);
} else {
    $orderId = $lastResult['resData']['orderId'];
    $price   = $lastResult['resData']['price'];
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
