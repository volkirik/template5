<?php
showTitle("Register domain");
	$smarty->assign ('content_title', constant('TEMPLATE_0083'));
	$smarty->assign ('content_tip', constant('TEMPLATE_0084'));
	$smarty->assign ('content_warning', $message);
	$smarty->assign ('php_self', $_SERVER["PHP_SELF"]);
    $smarty->assign ('domain', $domain);
	$smarty->assign ('gtld', $gtld);
	$smarty->assign ('product_info', $product_info);
	
	$smarty->assign ('dns1', $dns1);
	$smarty->assign ('dns2', $dns2);
	$smarty->assign ('password1', $password1);
	$smarty->assign ('password2', $password2);

	    $smarty->assign ('countries', $countries);
		
	$smarty->assign ('registrant', $registrant);
	$smarty->assign ('r_org', $r_org);
	$smarty->assign ('r_address1', $r_address1);
	$smarty->assign ('r_address2', $r_address2);
	$smarty->assign ('r_address3', $r_address3);
	$smarty->assign ('r_city',  $r_city);
	$smarty->assign ('r_province', $r_province);
	$smarty->assign ('r_email', $r_email);
	$smarty->assign ('r_fax', $r_fax);
	$smarty->assign ('r_telephone', $r_telephone);
	$smarty->assign ('r_postalcode', $r_postalcode);
	$smarty->assign ('r_country', $r_country);
	
	$smarty->assign ('administrator', $administrator);
	$smarty->assign ('a_address1', $a_address1);
	$smarty->assign ('a_address2', $a_address2); 
	$smarty->assign ('a_address3', $a_address3);
	$smarty->assign ('a_province', $a_province);
	$smarty->assign ('a_org', $a_org);
	$smarty->assign ('a_city', $a_city);
	$smarty->assign ('a_country', $a_country);
	$smarty->assign ('a_email', $a_email);
	$smarty->assign ('a_fax', $a_fax);
	$smarty->assign ('a_telephone', $a_telephone);
	$smarty->assign ('a_postalcode', $a_postalcode);
	
	$smarty->assign ('b_country', $b_country);
	$smarty->assign ('b_province', $b_province);
	$smarty->assign ('b_city', $b_city);
	$smarty->assign ('b_org',  $b_org);
	$smarty->assign ('billing', $billing);
	$smarty->assign ('b_telephone', $b_telephone);
	$smarty->assign ('b_email', $b_email);
	$smarty->assign ('b_postalcode', $b_postalcode);
	$smarty->assign ('b_fax', $b_fax);
	$smarty->assign ('b_address1', $b_address2);
	$smarty->assign ('b_address2', $b_address3);
	$smarty->assign ('b_address3', $b_address3);
	
	
	$smarty->assign ('t_country', $t_country);
	$smarty->assign ('t_province', $t_province);
	$smarty->assign ('t_city', $t_city);
	$smarty->assign ('t_address1', $t_address1);
	$smarty->assign ('t_address2', $t_address2);
	$smarty->assign ('t_address3', $t_address3);
	$smarty->assign ('t_org', $t_org);
	$smarty->assign ('technical', $technical);
	$smarty->assign ('t_email', $t_email);
	$smarty->assign ('t_fax', $t_fax);
	$smarty->assign ('t_telephone', $t_telephone);
	$smarty->assign ('t_postalcode', $t_postalcode);
	
	$smarty->assign ('content_header', CURRENT_THEME.'/content.header.tpl');
	$smarty->assign ('content_body', CURRENT_THEME.'/domain.regdomain.form.tpl');

	?>

