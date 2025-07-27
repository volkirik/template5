<?php

	$smarty->assign ('content_title', 'Payment Gateway info');
	$smarty->assign ('content_tip', '&nbsp;&nbsp; Please update the payment gateway details.');
    $smarty->assign ('content_warning', $message);
    $smarty->assign ('php_self', $_SERVER["PHP_SELF"]);
    
    $smarty->assign ('pp_email', $pp_email);
    $smarty->assign ('pptestmode', $pptestmode);
    
    $smarty->assign ('instId', $instId);
    $smarty->assign ('callbackPW', $callbackPW);
    $smarty->assign ('wptestmode', $wptestmode);
    
    
    $smarty->assign ('content_header', CURRENT_THEME.'/content.header.tpl');
    $smarty->assign ('content_body', CURRENT_THEME.'/admin.paymentgateway.form.tpl');

?>
