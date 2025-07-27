<?php

	$smarty->assign ('content_title', 'Alan Adı Whois Senkronizasyonu');
	//$smarty->assign ('content_tip', 'Lütfen kullanıcı adını ve alan adını girin');
	$smarty->assign ('content_warning', $warning);
    $smarty->assign ('php_self', $_SERVER["PHP_SELF"]);
	
	$smarty->assign ('update_result', $update_result);
	
	$smarty->assign ('content_header', CURRENT_THEME.'/content.header.tpl');
	$smarty->assign ('content_body', CURRENT_THEME.'/admin.domainsync.result.tpl');

?>
