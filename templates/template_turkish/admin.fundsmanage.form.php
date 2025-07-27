<?php
global $admin_info;
	$smarty->assign ('content_title', 'Fon Yönetimi');
    $smarty->assign ('php_self', $_SERVER["PHP_SELF"]);

		$smarty->assign ('content_header', CURRENT_THEME.'/content.header.tpl');
	$smarty->assign ('content_body', CURRENT_THEME.'/admin.fundsmanage.form.tpl');


?>
