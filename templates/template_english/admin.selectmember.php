<?php

    $smarty->assign ('content_title', 'Select username');
    $smarty->assign ('content_tip', "Please input user name, which you are going to
	         register this domain for.");
    $smarty->assign ('content_warning', $message);
	
	$smarty->assign ('php_self', $_SERVER["PHP_SELF"]);
    $smarty->assign ('domain', $domain);
	$smarty->assign ('gtld', $gtld);
	
	$smarty->assign ('content_header', CURRENT_THEME.'/content.header.tpl');
	$smarty->assign ('content_body', CURRENT_THEME.'/admin.selectmember.tpl');

?>
 