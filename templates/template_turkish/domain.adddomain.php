<?php

	$smarty->assign ('content_title', 'Alan Adını Kontrol Et');
	$smarty->assign ('content_tip', 'Lütfen istediğiniz alan adını girin 
    ve kullanılabilirliğini kontrol edin');
	$smarty->assign ('content_warning', $message);
    $smarty->assign ('php_self', $_SERVER["PHP_SELF"]);
    
    echo "<pre>"; print_r ($_REQUEST['domains']); echo "</pre>";
    /*
    
    
    $smarty->assign ('content_header', CURRENT_THEME.'/content.header.tpl');
	$smarty->assign ('content_body', CURRENT_THEME.'/domain.searchdomains.form.tpl');
*/
	
?>
