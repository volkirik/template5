<?php

include("../server.inc.php");
include(ROOT_DIR . "common/db.inc.php");
include(ROOT_DIR . "init.inc.php");
include(ROOT_DIR . "common/func.inc.php");
include(ROOT_DIR . "common/domain.inc.php");

include(ROOT_DIR . "model/member.login.php");
include(ROOT_DIR . "model/admin.domainsync.php");


$admin = new MemberLogin();
$admin_info = $admin->checkAdminLogin();
if($admin_info == -1)
{
	$admin->showForm("");
}

if ($admin->checkAdminTask ($admin_info[0], "Domain Sync") < 0)
{
	showAdminErrorMsg(ADMIN_0035);
}

$domain = new DomainSync ();
$action = $_REQUEST["action"];

//echo "<pre>"; print_r ($_REQUEST); echo "</pre>";

if ($action == "syncWhois"){
	$domain->syncWhois();
}else 
	$domain->showForm("");




?>