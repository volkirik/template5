<?php
	$smarty->assign ('content_title', constant('TEMPLATE_0109'));
    $smarty->assign ('content_tip', constant('TEMPLATE_0110'));
    $smarty->assign ('content_warning', $message);
    
    $smarty->assign ('member_info', $member_info);
    $smarty->assign ('php_self', $_SERVER["PHP_SELF"]);
    
    $smarty->assign ('content_header', CURRENT_THEME.'/content.header.tpl');
	$smarty->assign ('content_body', CURRENT_THEME.'/member.showfunds.tpl');
?>
