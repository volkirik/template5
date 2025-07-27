<?php

	$smarty->assign ('content_title', 'Edit DNS');
	$smarty->assign ('content_tip', '&nbsp;Enter the IP corresponding to the nameserver.');
	$smarty->assign ('content_warning', $message);

    $smarty->assign ('php_self', $_SERVER["PHP_SELF"]);
	$smarty->assign ('dns', $dns);
    $smarty->assign ('ip', $ip);
	
	$smarty->assign ('content_header', CURRENT_THEME.'/content.header.tpl');
	$smarty->assign ('content_body', CURRENT_THEME.'/admin.modifydns.form.tpl');


?>
              
