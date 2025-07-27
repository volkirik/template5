<?php

$smarty->assign ('content_title', 'Ödeme Sonucu');
$smarty->assign ('content_tip', '&nbsp;&nbsp; Yapılan ödemenin sonuçları.');
	$smarty->assign ('content_warning', $message);
    $smarty->assign ('php_self', $_SERVER["PHP_SELF"]);
    
    $smarty->assign ('paid_status', $_SESSION['paid']);
    
    $smarty->assign ('content_header', CURRENT_THEME.'/content.header.tpl');
	$smarty->assign ('content_body', CURRENT_THEME.'/member.paymentresult.tpl');

	
?>
