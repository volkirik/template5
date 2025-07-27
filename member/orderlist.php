<?php
include("../server.inc.php");
include(ROOT_DIR . "common/db.inc.php");
include(ROOT_DIR . "init.inc.php");
include(ROOT_DIR . "common/func.inc.php");
include(ROOT_DIR . "model/member.login.php");
include(ROOT_DIR . "model/member.orderlist.php");

$member = new MemberLogin();
$member_info = $member->checkLogin();
if($member_info == -1)
{
	$member->showForm("");
}

checkSystemStatus();

$member = new MemberOrderList();
$member->listOrder("");
?>
