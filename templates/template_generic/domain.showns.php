<?php

	$smarty->assign ('content_title', constant('TEMPLATE_0092'));
	$smarty->assign ('content_tip', constant('TEMPLATE_0093'));
	$smarty->assign ('content_warning', $message);

    $smarty->assign ('php_self', $_SERVER["PHP_SELF"]);
    $smarty->assign ('domain_id', $domain_id);
	$smarty->assign ('dns1', $dns1);
    $smarty->assign ('dns2', $dns2);
	
	$smarty->assign ('content_header', CURRENT_THEME.'/content.header.tpl');
	$smarty->assign ('content_body', CURRENT_THEME.'/domain.showns.tpl');


?>
              
