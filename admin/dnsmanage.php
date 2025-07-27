<?php
include("../server.inc.php");
include(ROOT_DIR . "common/db.inc.php");
include(ROOT_DIR . "init.inc.php");
include(ROOT_DIR . "common/func.inc.php");
include(ROOT_DIR . "common/domain.inc.php");
include(ROOT_DIR . "model/member.login.php");
include(ROOT_DIR . "model/admin.dnsmanage.php");

$admin = new MemberLogin();
$admin_info = $admin->checkAdminLogin();
if($admin_info == -1)
{
	$admin->showForm("");
}

if($admin->checkAdminTask($admin_info[0], "Dns Manage") < 0)
{
	showAdminErrorMsg(ADMIN_0035);
}

$domain = new DnsManage();
$action = $_REQUEST["action"];

if($action == "listDns")
{  
	$domain->listDns("");
}else if($action == "registerDnsForm") {
	$domain->registerDnsForm("");
}else if($action == "registerDns") {
	$domain->registerDns();
}else if($action == "modifyDnsForm") {
	$domain->modifyDnsForm("");
}else if($action == "modifyDns") {
	$domain->modifyDns();
}else if($action == "deleteDns") {
	$domain->deleteDns();
}else {
	$domain->listDns("");
}
?>
