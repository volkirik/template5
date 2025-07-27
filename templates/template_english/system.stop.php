<?php

    $smarty->assign ('content_title', 'System status');
    $smarty->assign ('content_warning', "Sorry, the system is in the maintenance");
	$smarty->assign ('content_header', CURRENT_THEME.'/content.header.tpl');
	$smarty->assign ('content_body', '');
?>
