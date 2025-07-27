<?php

	$smarty->assign ('content_title', 'Register New DNS');
    $smarty->assign ('content_tip', '&nbsp;Enter the name server name and the IP');

	$smarty->assign ('php_self', $_SERVER["PHP_SELF"]);
	
	$smarty->assign ('content_header', CURRENT_THEME.'/content.header.tpl');
	$smarty->assign ('content_body', CURRENT_THEME.'/admin.registerdns.form.tpl');
	
?>
