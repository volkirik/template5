<?php
include("../server.inc.php");
include(ROOT_DIR . "common/db.inc.php");
include(ROOT_DIR . "init.inc.php");
include(ROOT_DIR . "common/func.inc.php");
include(ROOT_DIR . "model/domain.whois.php");
include(ROOT_DIR . "model/member.login.php");


$member = new MemberLogin();
$member_info = $member->checkLogin();

checkSystemStatus();

$whois = new Whois();
$action = $_REQUEST["action"];

if($action == "getWhois")
{
	$whois->getWhois();
}else {
	$whois->showCheckForm("");
}
?>
