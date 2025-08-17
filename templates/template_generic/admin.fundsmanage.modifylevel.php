<?php

	$smarty->assign ('content_title', constant("TEMPLATE_0017"));
	$smarty->assign ('content_tip', constant("TEMPLATE_0018"));
	$smarty->assign ('content_warning', $message);
	$smarty->assign ('member_name',  $member_name);
	$smarty->assign ('amount', $amount);
	$smarty->assign ('type', $type);
	$smarty->assign ('member_level', $member_level);
	
	$smarty->assign ('php_self', $_SERVER["PHP_SELF"]);
	
	
		
	$smarty->assign ('content_header', CURRENT_THEME.'/content.header.tpl');
	$smarty->assign ('content_body', CURRENT_THEME.'/admin.fundsmanage.modifylevel.tpl');

?>
