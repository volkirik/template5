<?php

    global $smarty;

	$smarty->assign ('content_title', 'Whois Result');

	$smarty->assign ('whois_result',$result);
	$smarty->assign ('content_header', CURRENT_THEME.'/content.header.tpl');
	$smarty->assign ('content_body', CURRENT_THEME.'/domain.whois.result.tpl');

?>