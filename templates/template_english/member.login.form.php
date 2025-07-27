<?php
    global $smarty;

	$smarty->assign ('content_title', 'Member login');
	$smarty->assign ('content_tip', 'Please input your username and password to login.');
	$smarty->assign ('content_warning', $message);

    $smarty->assign ('content_action', RELA_DIR.'member/login.php');
	$smarty->assign ('getpassword', RELA_DIR.'member/getpassword.php');
	$smarty->assign ('signup', RELA_DIR.'member/signup.php'); 

	$smarty->assign ('content_header', CURRENT_THEME.'/content.header.tpl');
	$smarty->assign ('content_body', CURRENT_THEME.'/member.login.form.tpl');

?>
