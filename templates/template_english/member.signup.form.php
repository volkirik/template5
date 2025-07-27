<?php
    global $smarty;

	$smarty->assign ('content_title', 'Sign Up');
	$smarty->assign ('content_tip', 'Welcome to become our member! 
	The line with asterisk(*) should be filled out completely.');
	$smarty->assign ('content_warning', $message);
	$smarty->assign ('content_action', $_SERVER["PHP_SELF"]);
	$smarty->assign ('member_name', $member_name);
	$smarty->assign ('member_password1', $member_password1);
	$smarty->assign ('member_password2', $member_password2);
	$smarty->assign ('r_name', $r_name);
	$smarty->assign ('r_org', $r_org);
	$smarty->assign ('$r_address1', $r_address1);
	$smarty->assign ('$r_address2', $r_address2);
	$smarty->assign ('$r_address3', $r_address3);
	$smarty->assign ('r_city', $r_city);
	$smarty->assign ('r_province', $r_province);
	$smarty->assign ('r_country', $r_country);
	$smarty->assign ('countries', $countries);
	
	$smarty->assign ('content_header', CURRENT_THEME.'/content.header.tpl');
	$smarty->assign ('content_body', CURRENT_THEME.'/member.signup.form.tpl');

?>

