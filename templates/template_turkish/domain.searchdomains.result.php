<?php

$smarty->assign ('content_title', 'Arama Sonucu');
$smarty->assign ('content_tip', '&nbsp; Kayıt edilecek alan adlarını seçin.');

    $smarty->assign ('content_warning', $message);
    $smarty->assign ('php_self', $_SERVER["PHP_SELF"]);
    
    
    
    $smarty->assign ('search_res', $search_res);
    $smarty->assign ('failed_domains', $failed_domains);
    
    $arr = array();
    while(!$rs->EOF){
    	array_push ($arr, array ($rs->fields[1], $rs->fields[3])) ;
	    $rs->MoveNext();
	}
	$smarty->assign ( 'rs', $arr);
    
    
	$smarty->assign ('content_header', CURRENT_THEME.'/content.header.tpl');
	$smarty->assign ('content_body', CURRENT_THEME.'/domain.searchdomains.result.tpl');
?>
