<?php

	$smarty->assign ('content_title', constant('TEMPLATE_0097'));
	$smarty->assign ('content_tip', constant('TEMPLATE_0098'));
	$smarty->assign ('content_warning', $message);
    $smarty->assign ('php_self', $_SERVER["PHP_SELF"]);
    
    if ($_SESSION['updateuserfund'] == 'true'){
        $smarty->assign ('updateuserfund', 'none');
        unset ($_SESSION['updateuserfund']);
//        echo "update user fund is true";
    /*    $smarty->assign ('return', 'http://140.99.35.174/~develop/template3/member/managefunds.php?action=paymentResult');
        $smarty->assign ('cancel_return', 'http://140.99.35.174/~develop/template3/member/managefunds.php');
     */   
        $smarty->assign ('return', 'http://'.$_SERVER['SERVER_NAME'].RELA_DIR.'member/managefunds.php?action=paymentResult');
        $smarty->assign ('cancel_return', 'http://'.$_SERVER['SERVER_NAME'].RELA_DIR.'member/managefunds.php');
    }else {
        $smarty->assign ('domains', $regdomains);
        $smarty->assign ('item_name', $item_name);
        $smarty->assign ('updateuserfund', '');
   /*     $smarty->assign ('return', 'http://140.99.35.174/~develop/template3/domain/domainsearch.php?action=paymentResult');
        $smarty->assign ('cancel_return', 'http://140.99.35.174/~develop/template3/domain/domainsearch.php');
    */
        $smarty->assign ('return', 'http://'.$_SERVER['SERVER_NAME'].RELA_DIR.'domain/domainsearch.php?action=paymentResult');
        $smarty->assign ('cancel_return', 'http://'.$_SERVER['SERVER_NAME'].RELA_DIR.'domain/domainsearch.php');
    }
    $smarty->assign ('selected_user', $_SESSION['selected_user']);
    $smarty->assign ('total', $total);
    $smarty->assign ('pp_gw_email', $pp_gw_email);
    $smarty->assign ('notify_url', 'http://'.$_SERVER['SERVER_NAME'].RELA_DIR.'member/paypal_handler.php');
    $smarty->assign ('pphost', $pphost);
       
    
    $smarty->assign ('pp', $pp);
    $smarty->assign ('pp_email', $pp_email);
    
    $smarty->assign ('cc', $cc);
    $smarty->assign ('instId', $instId);
    $smarty->assign ('testmode', $wptestmode);
    $smarty->assign ('cc_user', $cc_user);
    $smarty->assign ('cc_name', $cc_name);
    $smarty->assign ('cc_num', $cc_num);
    $smarty->assign ('cc_addr', $cc_addr);
    $smarty->assign ('cc_city', $cc_city);
    $smarty->assign ('cc_state', $cc_state);
    $smarty->assign ('cc_zip', $cc_zip);
    $smarty->assign ('cc_tel', $cc_tel);
    $smarty->assign ('cc_fax', $cc_fax);
    $smarty->assign ('cc_country', $cc_country);
    $smarty->assign ('cc_email', $cc_email);
     
    $smarty->assign ('content_header', CURRENT_THEME.'/content.header.tpl');
	$smarty->assign ('content_body', CURRENT_THEME.'/member.confirmpayment.tpl');

?>
