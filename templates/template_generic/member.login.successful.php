<?php
global $member_info;
global $smarty;

	$smarty->assign ('content_title', constant('TEMPLATE_0103'));

    $smarty->assign ('member_info', $member_info);
    	
    $smarty->assign ('content_header', CURRENT_THEME.'/content.header.tpl');
	$smarty->assign ('content_body', CURRENT_THEME.'/member.login.successful.tpl');
                  
?>
