<?php
define("CAN_NOT_CONNECT_SERVER", "Can't connect to server");
require("../ApiClient.php");
/**
Domain registration Quick Start Guide

When registering a new domain via API, you need to do as the following steps:

Step 1 : Establish the connection with API server 

Step 2: Check domain availability, premium status & TMCH(Trademark Cliam) by executing action "CheckDomain" .
    1) The Parameter Premium returns 1 when the domain belongs to premium domain .
2) The Parameter LookupKey returns a value when 1 (one) or more claim(s) exist for the specified domain name and it is valid for up to 24 hours. Next, please invoke the action GetTmNotice using the Lookupkey from the last step to retrieve an itemized list of Trademark Clearinghouse (TMCH) Claims, we will return parameters as follows:  
noticeId (TMCH Claims Notification ID.)
notAfter (TMCH Claims expiration date (UTC).) 
noticeContent (TMCH Claims Notification Content.) 

Step 3: Get domain price in real time, you may be aware of the price of premium domain is much higher than normal one.

Step 4: Create contact 
If you don¡¯t have valid Contact ID , please create at least one contact , we will return you the contact ID. For more details Please refer to :
http://ote.onlinenic.com/api/demo/3.x/en/?_r=/domain/createDomain
 
Step 5: Submit registration request
**/

$api = new ApiClient();
$domainType = 2001;
$domain     = 'ccb.bike';
$password   = 'Aa654123!';

//login api
$cmd = $api->buildCommand('client', 'Login');
$rs  = $api->request($cmd);
if ($rs) {
	//something error happen
	$lastResult = $api->getLastResult();
	$error = getError(__LINE__, $rs, $lastResult);
	die($error);
}

//Check Domain Name
$checkDomainParams = array(
	'domaintype' => $domainType,
	'domain'     => $domain,
);
$cmd        = $api->buildCommand('domain', 'CheckDomain', $checkDomainParams);
$rs         = $api->request($cmd);
$lastResult = $api->getLastResult();
if ($rs) {
	$error = getError(__LINE__, $rs, $lastResult);
    die($error);
} else {
	$avail = $lastResult['resData']['avail'];
	if ($avail != 1) {
		die("Domain cannot be registered\n");
	}
	$isPremium = ($lastResult['resData']['premium']==true);
	$lookupkey = isset($lastResult['resData']['lookupkey']) ? $lastResult['resData']['lookupkey'] : '';
	$isTmch    = empty($lookupkey) ? false : true;
}

//Get Domain Price
$getDomainPriceParams = array(
    'domaintype' => $domainType,
    'domain'     => $domain,
	'op'         => 'reg',
	'period'     => 1,//1 year
);
$cmd        = $api->buildCommand('domain', 'GetDomainPrice', $getDomainPriceParams);
$rs         = $api->request($cmd);
$lastResult = $api->getLastResult();
if ($rs) {
    $error = getError(__LINE__, $rs, $lastResult);
    die($error);
} else {
    $price = $lastResult['resData']['price'];
	echo "price:$price\n";
	if ($isPremium) {
		//pay attention to premium domain price
	}
}

if ($isTmch) {
    //Retrieve an itemized list of Trademark Clearinghouse (TMCH) Claims for a Domain Type ID using a Lookup Key.
    $getTmNoticeParams = array(
        'domaintype' => $domainType,
        'lookupkey'  => $lookupkey,
    );
    $cmd        = $api->buildCommand('domain', 'GetTmNotice', $getTmNoticeParams);
    $rs         = $api->request($cmd);
    $lastResult = $api->getLastResult();
    if ($rs) {
        $error = getError(__LINE__, $rs, $lastResult);
        die($error);
    } else {
        $noticeId      = $lastResult['resData']['noticeId'];
        $notAfter      = $lastResult['resData']['notAfter'];
        $noticeContent = $lastResult['resData']['noticeContent'];
        //show $noticeContent to you client and accept it
    }
}

//Create Contact
/**
* You should create 4 types of contact person (Registrant, Administrator, Technician, and Billing contact) before domain registration. 
* The command may be represened in various ways for different domain type.
**/
$contactNum = 4;
$contactIdArr = array();
for($i=0; $i<$contactNum; $i++) {
    $createContactParams = array(
        'domaintype' => $domainType,
        'name'       => 'demo name',
        'org'        => 'demo org',
        'country'    => 'US',
        'province'   => 'demo province',
        'city'       => 'demo city',
        'street'     => 'demo street',
        'postalcode' => '361000',
        'voice'      => '+86.123456789',
        'fax'        => '+86.123456789',
        'email'      => 'demo@demo.com',
        'password'   => $password,
    );
    $cmd        = $api->buildCommand('domain', 'CreateContact', $createContactParams);
    $rs         = $api->request($cmd);
    $lastResult = $api->getLastResult();
    if ($rs) {
        $error = getError(__LINE__, $rs, $lastResult);
        die($error);
    } else {
        $contactIdArr[$i] = $lastResult['resData']['contactid'];
    }
}

$dnsList = array(
    0 => 'ns1.dns-diy.net',
    1 => 'ns2.dns-diy.net',
    2 => '',
    3 => '',
    4 => '',
    5 => '',
);
$domainDns = array();
for($i=0; $i<=5; $i++) {
    if (!empty($dnsList[$i])) {
        $domainDns[] = $dnsList[$i];
    }
}
//Create Domain Name
$createDomainParams = array(
    'domaintype' => $domainType,
    'mltype'     => 0,
    'domain'     => $domain,
    'period'     => 1,
    'dns'        => $domainDns,
    'registrant' => $contactIdArr[0],
    'admin'      => $contactIdArr[1],
    'tech'       => $contactIdArr[2],
    'billing'    => $contactIdArr[3],
    'password'   => $password,
);
if ($isPremium) {
    $createDomainParams['premium'] = 1;
}
if ($isTmch) {
    $createDomainParams['noticeId']  = $noticeId;
    $createDomainParams['notAfter']  = $notAfter;
    $createDomainParams['notAccept'] = gmdate("Y-m-d\TH:i:s\\.0\Z", strtotime("now"));
}
$cmd        = $api->buildCommand('domain', 'CreateDomain', $createDomainParams);
$rs         = $api->request($cmd);
$lastResult = $api->getLastResult();
if ($rs) {
    $error = getError(__LINE__, $rs, $lastResult);
    die($error);
} else {
    $reg_date    = $lastResult['resData']['crDate'];
    $expire_date = $lastResult['resData']['exDate'];
	echo "registry successfully, expire_date:$expire_date\n";
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
