<?php

	$smarty->assign ('content_title', 'Check domain');
	$smarty->assign ('content_tip', 'Please input your desired domain name 
	    to check its availability');
	$smarty->assign ('content_warning', $message);
    $smarty->assign ('php_self', $_SERVER["PHP_SELF"]);
	
    $arr = array();
	
	while(!$rs->EOF)
	{
		array_push ($arr, array ($rs->fields[1], $rs->fields[3])) ;
		$rs->MoveNext();
	}
	$smarty->assign ( 'rs', $arr);
    
 /*  if (isset($_SESSION['regdomains']))      
             $_SESSION['regdomains'] = '';
   */ unset ($_SESSION['regdomains']);
    unset ($_SESSION['domain_list']);
         //echo "Searchform: "; print_r ($_SESSION['regdomains']);echo "end";
         
	$smarty->assign ('content_header', CURRENT_THEME.'/content.header.tpl');
	$smarty->assign ('content_body', CURRENT_THEME.'/domain.searchdomains.form.tpl');

	
?>
