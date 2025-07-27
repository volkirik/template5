<?php
    global $smarty;

$smarty->assign ('content_title', 'Whois');
$smarty->assign ('content_tip', 'Lütfen alan adını girin ve whois bilgilerini arayın.');
	$smarty->assign ('content_warning', $message);
	
	$smarty->assign ('content_action', $_SERVER["PHP_SELF"]);
	while(!$rs->EOF){
		$domain_details[] = array ($rs->fields[1], trim($rs->fields[3]));
		$rs->MoveNext();
    }

	$smarty->assign ('domain_details', $domain_details);

	$smarty->assign ('content_header', CURRENT_THEME.'/content.header.tpl');
	$smarty->assign ('content_body', CURRENT_THEME.'/domain.whois.form.tpl');

?>
