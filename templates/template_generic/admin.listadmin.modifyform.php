<?php
global $admin_info;
global $smarty;

    $smarty->assign ('content_title', constant("TEMPLATE_0020"));
    $smarty->assign ('content_action', $_SERVER["PHP_SELF"]);
    $smarty->assign ('message', $message);
    $smarty->assign ('admin_name', $admin_name);
    $smarty->assign ('admin_password', $admin_password);
	$smarty->assign ('admin_dept', $admin_dept);
	$smarty->assign ('admin_password1', $admin_password1);
	$smarty->assign ('init_admin_flag', intval($admin_flag));
	$smarty->assign ('admin_id', $admin_id);
	$smarty->assign ('current_page', $_REQUEST["currentPage"]);
	
	$smarty->assign ('content_header', CURRENT_THEME.'/content.header.tpl');
	$smarty->assign ('content_body', CURRENT_THEME.'/admin.listadmin.modifyform.tpl');
?>
