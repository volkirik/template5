<?php
$smarty->assign ('content_title', 'Fonları Yönet');
$smarty->assign ('content_tip', '&nbsp;&nbsp; Hesabınıza fon ekleyin.');
    $smarty->assign ('content_warning', $message);
    
    $smarty->assign ('member_info', $member_info);
    $smarty->assign ('php_self', $_SERVER["PHP_SELF"]);
    
    $smarty->assign ('content_header', CURRENT_THEME.'/content.header.tpl');
	$smarty->assign ('content_body', CURRENT_THEME.'/member.showfunds.tpl');
?>
