<?php

	$smarty->assign ('content_title', constant('TEMPLATE_0043'));
    $smarty->assign ('content_tip', constant('TEMPLATE_0044'));

	$smarty->assign ('php_self', $_SERVER["PHP_SELF"]);
	
	$smarty->assign ('content_header', CURRENT_THEME.'/content.header.tpl');
	$smarty->assign ('content_body', CURRENT_THEME.'/admin.registerdns.form.tpl');
	
?>
