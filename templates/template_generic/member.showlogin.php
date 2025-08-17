<?php
    global $smarty;

	$smarty->assign ('content_title', constant('TEMPLATE_0111'));
	$smarty->assign ('content_tip', constant('TEMPLATE_0112'));
	$smarty->assign ('content_warning', $message);

    $smarty->assign ('content_action', $_SERVER["PHP_SELF"]);
	$smarty->assign ('getpassword', RELA_DIR.'member/getpassword.php');
	$smarty->assign ('signup', RELA_DIR.'member/signup.php'); 
    
    
	$smarty->assign ('content_header', CURRENT_THEME.'/content.header.tpl');
	$smarty->assign ('content_body', CURRENT_THEME.'/member.showlogin.tpl');

?>
