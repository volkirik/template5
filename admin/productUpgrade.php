<?php
include("../server.inc.php");
include(ROOT_DIR . "common/db.inc.php");
include(ROOT_DIR . "init.inc.php");
include(ROOT_DIR . "common/func.inc.php");
include(ROOT_DIR . "model/member.login.php");
include(ROOT_DIR . "model/admin.productupgrade.php");

$admin = new MemberLogin();
$admin_info = $admin->checkAdminLogin();
if($admin_info == -1)
{
	$admin->showForm("");
}

if($admin->checkAdminTask($admin_info[0], "Domain Upgrade") < 0)
{
	showAdminErrorMsg(ADMIN_0035);
}

$product = new ProductUpgrade();
$action = $_REQUEST["action"];
if($action == "showNewDomain")
{
	$product->showNewDomain("");
}else if($action == "upgradeDomain") {
	$product->upgradeDomain();
}else {
	$product->showNewDomain("");
}
?>
