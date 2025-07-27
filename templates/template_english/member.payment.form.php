<?php

	$smarty->assign ('content_title', 'Billing info');
	$smarty->assign ('content_tip', '&nbsp;&nbsp; Please update the payment method and details.');
    $smarty->assign ('content_warning', $message);
    $smarty->assign ('php_self', $_SERVER["PHP_SELF"]);
    
    //echo "self: " . $_SERVER["PHP_SELF"];
    //if ($method == 'paypal'){

        $smarty->assign ('pp_email', $pp_email);
    //}else{
        $smarty->assign ('cc_name', $cc_name);
        $smarty->assign ('cc_num', $cc_num);
        $smarty->assign ('exp_date', $exp_date);
        $smarty->assign ('exp_year', $exp_year);
        $smarty->assign ('cc_user', $cc_user);
        $smarty->assign ('cc_id', $cc_id);
        $smarty->assign ('cc_email', $cc_email);
        $smarty->assign ('cc_addr', $cc_addr);
        $smarty->assign ('cc_city', $cc_city);
        $smarty->assign ('cc_state', $cc_state);
        $smarty->assign ('cc_zip', $cc_zip);
        $smarty->assign ('cc_country', $cc_country);
        $smarty->assign ('cc_tel', $cc_tel);
        $smarty->assign ('cc_fax', $cc_fax);
   // }
    
    $smarty->assign ('pp_checked', $pp_checked);
    $smarty->assign ('cc_checked', $cc_checked);
    
    $smarty->assign ('content_header', CURRENT_THEME.'/content.header.tpl');
    $smarty->assign ('content_body', CURRENT_THEME.'/member.payment.form.tpl');

	
?>
