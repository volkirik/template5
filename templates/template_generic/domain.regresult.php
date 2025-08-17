<?php

	$smarty->assign ('content_title', constant('TEMPLATE_0085'));
    $smarty->assign ('domain_name', $domain_name);
	$smarty->assign ('product_price', $product_price);
	$smarty->assign ('year', $year);	

        
//    echo "<pre>Regresult: "; print_r ($_SESSION); echo "end</pre>";
    
    $count = count ($_SESSION['regdomains']);
    $smarty->assign ('count', $count);
    
	$smarty->assign ('content_header', CURRENT_THEME.'/content.header.tpl');
	$smarty->assign ('content_body', CURRENT_THEME.'/domain.regresult.tpl');
?>

