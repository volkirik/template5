<?php
global $admin_info;
    global $smarty;
	$smarty->assign ('content_title', 'Domain upgrade');
    $smarty->assign ('content_tip', 'This section is used to add the new domain into your domain business scope.
	    If you find any new domains below you are interested in,
	    please feel free to choose them. ');
	  
	$smarty->assign ('php_self', ' $_SERVER["PHP_SELF"]');
	$smarty->assign ('results', $results);
	
	$r_count = count($results);
	
	$smarty->assign ('r_count', $r_count);
	
	$arr = array();
	for($i = 0; $i < $r_count; $i ++)
	{
	 array_push ($arr, array(substr($results[$i], 0, 4), substr($results[$i], 6)));
    }
	
	$smarty->assign ('content_header', CURRENT_THEME.'/content.header.tpl');
	$smarty->assign ('content_body', CURRENT_THEME.'/admin.productupgrade.shownewdomain.tpl');
	
?>
