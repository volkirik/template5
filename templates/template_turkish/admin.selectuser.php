<?php

    $smarty->assign ('content_title', 'Kullanıcı Adı Seç');
    $smarty->assign ('content_tip', "Lütfen bu alan ad(lar)ını kimin için kaydedecekseniz
    kullanıcı adını girin.");
    $smarty->assign ('content_warning', $message);
	
	$smarty->assign ('php_self', $_SERVER["PHP_SELF"]);
    
    
    if (!isset($_SESSION['domain_list']))
	    $_SESSION['domain_list'] = $_REQUEST['domains'];
        
  
    $smarty->assign ('content_header', CURRENT_THEME.'/content.header.tpl');
	$smarty->assign ('content_body', CURRENT_THEME.'/admin.selectuser.tpl');
	//$smarty->assign ('content_body', 'default/admin.selectuser.tpl');
    //$smarty->assign ('content_body', 'simpleGreen/admin.selectuser.tpl.new');
?>
 
