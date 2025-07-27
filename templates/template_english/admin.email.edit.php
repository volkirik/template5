<?php
	
	$smarty->assign ('content_title', 'Email Customization');
	$smarty->assign ('content_tip', '&nbsp; Please enter details of the email to be sent.');
	$smarty->assign ('content_warning', $message);
    $smarty->assign ('php_self', $_SERVER["PHP_SELF"]);
	
	$smarty->assign ('email_subject', $subject);
	$smarty->assign ('email_body', $body);
	
	$smarty->assign ('days', $display);
	$smarty->assign ('day1', $day1);
	$smarty->assign ('day2', $day2);
	$smarty->assign ('day3', $day3);
	
	$smarty->assign ('email_macros', $macros);
	
	$smarty->assign ('type', $show);
	
	$smarty->assign ('content_header', CURRENT_THEME.'/content.header.tpl');
	$smarty->assign ('content_body', CURRENT_THEME.'/admin.email.edit.tpl');

?>
