<?php
global $admin_info;
global $smarty;

    $smarty->assign ('content_title', constant("TEMPLATE_0019"));
    $smarty->assign ('content_action', $_SERVER["PHP_SELF"]);
    $smarty->assign ('message', $message);
    $smarty->assign ('admin_name', StripSlashes($_POST["admin_name"]));
    $smarty->assign ('admin_dept', StripSlashes($_POST["admin_name"]));
	$smarty->assign ('admin_password', StripSlashes($_POST["admin_password"]));
	$smarty->assign ('admin_password1', StripSlashes($_POST["admin_password1"]));
	$smarty->assign ('initval_admin_flag', intval(StripSlashes($_POST["admin_flag"])));
	
	$smarty->assign ('content_header', CURRENT_THEME.'/content.header.tpl');
	$smarty->assign ('content_body', CURRENT_THEME.'/admin.listadmin.addform.tpl');
	
?>

