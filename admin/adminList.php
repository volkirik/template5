<?php
include("../server.inc.php");
include(ROOT_DIR . "common/db.inc.php");
include(ROOT_DIR . "init.inc.php");
include(ROOT_DIR . "common/func.inc.php");
include(ROOT_DIR . "model/member.login.php");
include(ROOT_DIR . "model/admin.listadmin.php");

$admin = new MemberLogin();
$admin_info = $admin->checkAdminLogin();
if($admin_info == -1)
{
	$admin->showForm("");
}

if($admin->checkAdminTask($admin_info[0], "Admin List") < 0)
{
	showAdminErrorMsg(ADMIN_0035);
}

$adminManage = new AdminManage();
$action = '';
if (isset($_REQUEST["action"])) {
	$action = $_REQUEST["action"];
}
if($action == "listAdmin")
{
	$adminManage->listAdmin("");
}else if($action == "showAddForm") {
	$adminManage->showAddForm("");
}else if($action == "addAdmin") {
	$adminManage->addAdmin();
}else if($action == "showModifyForm") {
	$adminManage->showModifyForm("");
}else if($action == "modifyAdmin") {
	$adminManage->modifyAdmin("");
}else if($action == "deleteAdmin") {
	$adminManage->deleteAdmin();
}else if($action == "showSetTask") {
	$adminManage->showSetTask("");
}else if($action == "setAdminTask") {
	$adminManage->setAdminTask();
}else {
	$adminManage->listAdmin("");
}
?>