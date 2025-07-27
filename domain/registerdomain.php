<?php
include("../server.inc.php");
include(ROOT_DIR . "common/db.inc.php");
include(ROOT_DIR . "init.inc.php");
include(ROOT_DIR . "common/func.inc.php");
include(ROOT_DIR . "common/domain.inc.php");
include(ROOT_DIR . "model/member.login.php");
include(ROOT_DIR . "model/domain.registerdomain.php");

checkSystemStatus();
$member = new MemberLogin();
$member_info = $member->checkLogin();
if($member_info == -1)
{
	$member->showForm("");
}

$domain = new DomainRegistration();
$action = $_REQUEST["action"];

if($action == "checkDomain")
{
	$domain->checkDomain();
}else if($action == "showRegisterForm") {
	$domain->showRegisterForm("");
}else if($action == "registerDomain") {
	$domain->registerDomain();
}else {
	$domain->showCheckForm("");
}
?>