<?php

global $smarty;

$smarty->assign ('content_title', constant('TEMPLATE_0118'));
$smarty->assign ('content_message', $msg);

	$smarty->assign ('content_header', CURRENT_THEME.'/content.header.tpl');
	$smarty->assign ('content_body', CURRENT_THEME.'/system.error.tpl');
?>
