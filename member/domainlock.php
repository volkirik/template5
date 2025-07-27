<?php
include("../server.inc.php");
include(ROOT_DIR . "common/db.inc.php");
include(ROOT_DIR . "init.inc.php");
include(ROOT_DIR . "common/func.inc.php");
include(ROOT_DIR . "common/domain.inc.php");
include(ROOT_DIR . "model/member.login.php");
include(ROOT_DIR . "model/member.domainlock.php");


$admin = new MemberLogin();
$member_info = $admin->checkLogin();

$sql = "select domain_lock from web_config";
$status = $conn->Execute ($sql);

if($member_info == -1 || $status->fields[0] != 1)
	$admin->showForm("");
checkSystemStatus();

/*
if($admin->checkAdminTask($admin_info[0], "Domain Lock") < 0)
{
	showAdminErrorMsg(ADMIN_0035);
}
*/
$domain = new DomainLock ();
$action = $_REQUEST["action"];

if($action == "listDomains")
{  
	$domain->listDomains("");
}else if($action == "lockDomainForm") {
	$domain->lockDomainForm("");
}else if($action == "lockDomains") {
	$domain->lockDomains();
}else {
	$domain->listDomains("");
}

?>
