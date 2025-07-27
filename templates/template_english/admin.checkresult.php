<?php

	$smarty->assign ('content_title', 'Check result' );
    $smarty->assign ('php_self', $_SERVER["PHP_SELF"]);
	$smarty->assign ('gtld', $gtld);
	$smarty->assign ('domain', $domain);
	$smarty->assign ('result', $result);
	$smarty->assign ('real_domain',  $real_domain);
	
	$arr = array();
	while(!$rs->EOF)
	{   array_push ($arr, array ($rs->fields[1], $rs->fields[3])) ;
		$rs->MoveNext();
	}
	
    $smarty->assign ('rs', $arr);
	
    $smarty->assign ('content_header', CURRENT_THEME.'/content.header.tpl');
	$smarty->assign ('content_body', CURRENT_THEME.'/admin.checkresult.tpl');
?>
