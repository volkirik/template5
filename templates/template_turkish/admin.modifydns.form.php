<?php

	$smarty->assign ('content_title', 'DNS Düzenle');
	$smarty->assign ('content_tip', '&nbsp;Alanadı sunucusuna karşılık gelen IP adresini giriniz.');
	$smarty->assign ('content_warning', $message);

    $smarty->assign ('php_self', $_SERVER["PHP_SELF"]);
	$smarty->assign ('dns', $dns);
    $smarty->assign ('ip', $ip);
	
	$smarty->assign ('content_header', CURRENT_THEME.'/content.header.tpl');
	$smarty->assign ('content_body', CURRENT_THEME.'/admin.modifydns.form.tpl');


?>
              
