<?php
include("../server.inc.php");
include(ROOT_DIR . "common/db.inc.php");
include(ROOT_DIR . "init.inc.php");
include(ROOT_DIR . "common/func.inc.php");
include(ROOT_DIR . "model/member.login.php");
include(ROOT_DIR . "model/admin.whois.php");

$admin = new MemberLogin();
$admin_info = $admin->checkAdminLogin();
if($admin_info == -1)
{
	$admin->showForm("");
}

if($admin->checkAdminTask($admin_info[0], "Whois Search") < 0)
{
	showAdminErrorMsg(ADMIN_0035);
}

$whois = new Whois();
$action = isset($_REQUEST["action"]) ? $_REQUEST["action"] : '';

if($action == "getWhois")
{
	$whois->getWhois();
}else {
	$whois->showCheckForm("");
}
?>
