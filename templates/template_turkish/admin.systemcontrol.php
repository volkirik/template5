<?php

global $smarty;
	$smarty->assign ('content_title', 'Süper Yönetici Alanı &gt; Sistem Ayarı');
    $smarty->assign ('content_action', $_SERVER["PHP_SELF"]);
	
	$smarty->assign ('website_language', $website_language);
	$smarty->assign ('pagesize', $pagesize);
	$smarty->assign ('copyright', $copyright);
	$smarty->assign ('title', $title);
	$smarty->assign ('customer_id', $customer_id);
	$smarty->assign ('customer_password', isset($customer_password) ? $customer_password : '');
	$smarty->assign ('server_host', $server_host);
	$smarty->assign ('server_port', $server_port);
	$smarty->assign ('system_status', $system_status);
	$smarty->assign ('current_skin', $current_skin);
	$smarty->assign ('current_theme', $current_theme);
    $smarty->assign ('domain_lock', $domain_lock);
    $smarty->assign ('domain_renew', $domain_renew);
    $smarty->assign ('captcha_enable', $captcha_enable);
	
$arr = array();
$d = dir("../templates");
while($entry = $d->read())
{
	if (strstr($entry, "template_"))
	    array_push($arr, $entry);
}
    $smarty->assign ('entry', $arr);
	
	$arr = array();
	$d = dir("../themes");
	while ($theme = $d->read()){
        if (($theme != ".") && ($theme != "..") )	
		    array_push($arr, $theme);  
	}
    $smarty->assign ('themes', $arr);
		
	$smarty->assign ('content_header', CURRENT_THEME.'/content.header.tpl');
	$smarty->assign ('content_body', CURRENT_THEME.'/admin.systemcontrol.tpl');

?>
       
