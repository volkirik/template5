<?php

    $smarty->assign ('content_title', constant('TEMPLATE_0047'));
    $smarty->assign ('content_tip', constant('TEMPLATE_0048'));
    $smarty->assign ('content_warning', $message);
	
	$smarty->assign ('php_self', $_SERVER["PHP_SELF"]);
    $smarty->assign ('domain', $domain);
	$smarty->assign ('gtld', $gtld);
	
	$smarty->assign ('content_header', CURRENT_THEME.'/content.header.tpl');
	$smarty->assign ('content_body', CURRENT_THEME.'/admin.selectmember.tpl');

?>
 
