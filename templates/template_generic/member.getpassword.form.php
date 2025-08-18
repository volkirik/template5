<?php

    global $smarty;

	$smarty->assign ('content_title', constant('TEMPLATE_0099'));
	$smarty->assign ('content_tip', constant('TEMPLATE_0100'));
	$smarty->assign ('content_warning', $message);

	$smarty->assign ('content_action', RELA_DIR.'member/getpassword.php');
    $smarty->assign ('content_user', isset($_POST["username"]) ? StripSlashes($_POST["username"]) : '');
	$smarty->assign ('content_email', isset($_POST["email"]) ? StripSlashes($_POST["email"]) : '');
	$smarty->assign ('content_signup', RELA_DIR."member/signup.php");
	
	$smarty->assign ('content_header', CURRENT_THEME.'/content.header.tpl');
	$smarty->assign ('content_body', CURRENT_THEME.'/member.getpassword.form.tpl');
	
?>
