<?php
global $admin_info;
   global $smarty;
	
	$smarty->assign ('content_title', 'Alan Adı Yükseltme');
    $smarty->assign ('php_self',  $_SERVER["PHP_SELF"]);
	$smarty->assign ('product_id', $product_id);
	$smarty->assign ('domainDetails', $domainDetails);
	
	$smarty->assign ('content_header', CURRENT_THEME.'/content.header.tpl');
	$smarty->assign ('content_body', CURRENT_THEME.'/admin.productupgrade.upgradesuccess.tpl');
?>
