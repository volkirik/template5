<?php

	$smarty->assign ('content_title', constant("TEMPLATE_0010"));
	$smarty->assign ('content_tip', constant("TEMPLATE_0011"));
	$smarty->assign ('content_warning', $message);
    $smarty->assign ('php_self', $_SERVER["PHP_SELF"]);
	
    $arr = array();
	
	while(!$rs->EOF)
	{

		array_push ($arr, array ($rs->fields[1], $rs->fields[3])) ;
		
		$rs->MoveNext();
	}
	$smarty->assign ( 'rs', $arr);
    
	$smarty->assign ('content_header', CURRENT_THEME.'/content.header.tpl');
	$smarty->assign ('content_body', CURRENT_THEME.'/admin.domainsync.form.tpl');

?>
