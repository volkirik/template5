<?php
include("../server.inc.php");
include(ROOT_DIR . "common/db.inc.php");
include(ROOT_DIR . "init.inc.php");
include(ROOT_DIR . "common/func.inc.php");
include(ROOT_DIR . "model/member.login.php");
include(ROOT_DIR . "model/member.getpassword.php");
include(ROOT_DIR . "model/class.smtp.inc");


$member = new MemberLogin();
$member_info = $member->checkLogin();
checkSystemStatus();

$member = new MemberGetPassword();


if($_POST["Submit"] != "")
{
	$member->getPassword();
}else {
	$member->showForm("");
}
?>
