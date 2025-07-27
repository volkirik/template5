<?php
include("../server.inc.php");
include(ROOT_DIR . "common/db.inc.php");
include(ROOT_DIR . "init.inc.php");
include(ROOT_DIR . "common/func.inc.php");
include(ROOT_DIR . "common/domain.inc.php");
include(ROOT_DIR . "model/member.login.php");
include(ROOT_DIR . "model/admin.productsetting.php");

$admin = new MemberLogin();
$admin_info = $admin->checkAdminLogin();
if($admin_info == -1)
{
	$admin->showForm("");
}

if($admin->checkAdminTask($admin_info[0], "Domain Setting") < 0)
{
	showAdminErrorMsg(ADMIN_0035);
}

$productSetting = new ProductSetting();
$action = '';
if (isset($_REQUEST["action"])) {
	$action = $_REQUEST["action"];
}
if($action == "listProduct")
{
	$productSetting->listProduct("");
}else if($action == "startProduct") {
	$productSetting->startProduct();
}else if($action == "stopProduct") {
	$productSetting->stopProduct();
}else if($action == "showModifyDNS") {
	$productSetting->showModifyDNS("");
}else if($action == "modifyDNS") {
	$productSetting->modifyDNS();
}else if($action == "showModifyPrice") {
	$productSetting->showModifyPrice("");
}else if($action == "modifyPrice") {
	$productSetting->modifyPrice();
}else {
	$productSetting->listProduct("");
}
?>