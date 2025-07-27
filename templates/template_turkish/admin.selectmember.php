<?php

    $smarty->assign ('content_title', 'Kullanıcı Adı Seç');
    $smarty->assign ('content_tip', "Lütfen bu alan adını kimin için kaydedecekseniz
    kullanıcı adını girin.");
    $smarty->assign ('content_warning', $message);
	
	$smarty->assign ('php_self', $_SERVER["PHP_SELF"]);
    $smarty->assign ('domain', $domain);
	$smarty->assign ('gtld', $gtld);
	
	$smarty->assign ('content_header', CURRENT_THEME.'/content.header.tpl');
	$smarty->assign ('content_body', CURRENT_THEME.'/admin.selectmember.tpl');

?>
 
