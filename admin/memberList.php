<?php
include("../server.inc.php");
include(ROOT_DIR . "common/db.inc.php");
include(ROOT_DIR . "init.inc.php");
include(ROOT_DIR . "common/func.inc.php");
include(ROOT_DIR . "model/member.login.php");
include(ROOT_DIR . "model/admin.memberlist.php");

$admin = new MemberLogin();
$admin_info = $admin->checkAdminLogin();
if($admin_info == -1)
{
	$admin->showForm("");
}

if($admin->checkAdminTask($admin_info[0], "Member List") < 0)
{
	showAdminErrorMsg(ADMIN_0035);
}

$memberList = new MemberList();
$action = isset($_REQUEST["action"]) ? $_REQUEST["action"] : '';
if($action == "listMember")
{
	$memberList->listMember("");
}else if($action == "viewMemberInfo") {
	$memberList->viewMemberInfo();
}else if($action == "showModifyForm") {
	$memberList->showModifyForm("");
}else if($action == "modifyMemberInfo") {
	$memberList->modifyMemberInfo();
}else if($action == "deleteMember") {
	$memberList->deleteMember();
}else {
	$memberList->listMember("");
}
?>
