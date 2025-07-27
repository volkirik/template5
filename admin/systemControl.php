<?php
include("../server.inc.php");
include(ROOT_DIR . "common/db.inc.php");
include(ROOT_DIR . "init.inc.php");
include(ROOT_DIR . "common/func.inc.php");
include(ROOT_DIR . "model/member.login.php");
include(ROOT_DIR . "model/admin.systemcontrol.php");

$admin = new MemberLogin();
$admin_info = $admin->checkAdminLogin();

if($admin_info == -1)
{
	$admin->showForm("");
}

if($admin->checkAdminTask($admin_info[0], "System Control") < 0)
{
	showAdminErrorMsg(ADMIN_0035);
}

$systemControl = new SystemControl();
$action = '';
if (isset($_REQUEST["action"])) {
	$action = $_REQUEST["action"];
}
if($action == "showStatus")
{
	$systemControl->showStatus("");
}else if($action == "setStatus") {
	$systemControl->setStatus();
}else {
	$systemControl->showStatus("");
}
?>
