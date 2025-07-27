<?php
include("../server.inc.php");
include(ROOT_DIR . "common/db.inc.php");
include(ROOT_DIR . "init.inc.php");
include(ROOT_DIR . "common/func.inc.php");
include(ROOT_DIR . "model/member.login.php");

$member = new MemberLogin();
$member_info = $member->checkLogin();
if($member_info == -1)
{
	$member->showForm("");
}else {
	$member->showMemberPanel();
}
?>
