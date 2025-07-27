<?php

	$smarty->assign ('content_title', 'Yeni DNS Kaydet');
    $smarty->assign ('content_tip', '&nbsp;Ad sunucu adını ve IP adresini girin');

	$smarty->assign ('php_self', $_SERVER["PHP_SELF"]);
	
	$smarty->assign ('content_header', CURRENT_THEME.'/content.header.tpl');
	$smarty->assign ('content_body', CURRENT_THEME.'/admin.registerdns.form.tpl');
	
?>
