<?php
include("../server.inc.php");
include(ROOT_DIR . "common/db.inc.php");
include(ROOT_DIR . "init.inc.php");
include(ROOT_DIR . "common/func.inc.php");
include(ROOT_DIR . "model/admin.signup.php");

checkSystemStatus();
$member = new MemberSignup();
if($_POST["Submit"] != "")
{
	$member->addMember();
}else {
	$member->showForm("");
}
?>
