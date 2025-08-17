<?php

	$smarty->assign ('content_title', constant("TEMPLATE_0012"));
	//$smarty->assign ('content_tip', 'Please input the user name and the domain name');
	$smarty->assign ('content_warning', $warning);
    $smarty->assign ('php_self', $_SERVER["PHP_SELF"]);
	
	$smarty->assign ('update_result', $update_result);
	
	$smarty->assign ('content_header', CURRENT_THEME.'/content.header.tpl');
	$smarty->assign ('content_body', CURRENT_THEME.'/admin.domainsync.result.tpl');

?>
