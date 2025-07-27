<?php
//error_reporting(E_ALL);
$lines = file("server.inc.php");

if(count($lines)>1){
	include("server.inc.php");
	include("common/func.inc.php");
	include("common/db.inc.php");
	include("init.inc.php");
	include(ROOT_DIR . "model/member.login.php");

	$member = new MemberLogin();
	$member_info = $member->checkLogin();

	include("templates/" . CURRENT_SKIN . "/title.inc.php");
	include("templates/" . CURRENT_SKIN . "/tail.inc.php");

	$smarty->display(CURRENT_THEME.'/page.structure.tpl');
}else{
	include("redirect.html");
}

?>
