<?php
global $admin_info;
    global $smarty;
	
	$smarty->assign ('content_title', constant('TEMPLATE_0033'));
    $smarty->assign ('php_self', $_SERVER["PHP_SELF"]);
    $smarty->assign ('message', $message);
	$smarty->assign ('product_id', $product_id);
	$smarty->assign ('product_name', $product_name);
	$smarty->assign ('product_type', $product_type);
	$smarty->assign ('currentPage', $_REQUEST["currentPage"]);
	$smarty->assign ('default_dns1', $default_dns1);
	$smarty->assign ('default_dns2', $default_dns2);
	
		$smarty->assign ('content_header', CURRENT_THEME.'/content.header.tpl');
	$smarty->assign ('content_body', CURRENT_THEME.'/admin.productsetting.modifydns.tpl');
	
?>
