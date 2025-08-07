<?php

    $smarty->assign ('content_title', 'System homepage');
    $smarty->assign ('content_warning', "Welcome");
	$smarty->assign ('content_header', CURRENT_THEME.'/content.header.tpl');
	$smarty->assign ('content_message', '<p>- FREE MEMBERSHIP</p>'
.'<p>- PAY WITH PAYPAL, OR CREDIT CARD</p>'
.'<p>- NO FUNDS EXPIRY</p>'
.'<p>- ADD AS MUCH FUNDS AS YOU NEED</p>'
.'<p>- EASY and SIMPLE MANAGEMENT</p>');
	$smarty->assign ('content_body', CURRENT_THEME.'/system.index.tpl');
?>
