<?php

	$smarty->assign ('content_title', 'Check domain');
	$smarty->assign ('content_tip', 'Please input your desired domain name 
	    to check its availability');
	$smarty->assign ('content_warning', $message);
    $smarty->assign ('php_self', $_SERVER["PHP_SELF"]);
    
    echo "<pre>"; print_r ($_REQUEST['domains']); echo "</pre>";
    /*
    
    
    $smarty->assign ('content_header', CURRENT_THEME.'/content.header.tpl');
	$smarty->assign ('content_body', CURRENT_THEME.'/domain.searchdomains.form.tpl');
*/
	
?>