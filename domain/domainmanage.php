<?php
include("../server.inc.php");
include(ROOT_DIR . "common/db.inc.php");
include(ROOT_DIR . "init.inc.php");
include(ROOT_DIR . "common/func.inc.php");
include(ROOT_DIR . "common/domain.inc.php");
include(ROOT_DIR . "model/member.login.php");
include(ROOT_DIR . "model/domain.domainmanage.php");

$member = new MemberLogin();
$member_info = $member->checkLogin();
if($member_info == -1)
{
	$member->showForm("");
}

checkSystemStatus();

$domain = new DomainManage();
$action = $_REQUEST["action"];

if($action == "listDomain")
{
	$domain->listDomain("");
}else if($action == "showContact") {
	$domain->showContact("");
}else if($action == "modifyContact") {
	$domain->modifyContact();
}else if($action == "showNS") {
	$domain->showNS("");
}else if($action == "modifyNS") {
	$domain->modifyNS();
}else if($action == "deleteDomain") {
	$domain->deleteDomain();
}else if($action == "renewDomain") {
	$domain->renewDomain();
}else {
	$domain->listDomain("");
}
?>
