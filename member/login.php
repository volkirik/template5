<?php
include("../server.inc.php");
include(ROOT_DIR . "common/db.inc.php");
include(ROOT_DIR . "init.inc.php");
include(ROOT_DIR . "common/func.inc.php");
include(ROOT_DIR . "model/member.login.php");

$member = new MemberLogin();
if($_POST["Submit"] != "")
{
	$member->login();
}else {
	$member->showForm("");
}
?>
