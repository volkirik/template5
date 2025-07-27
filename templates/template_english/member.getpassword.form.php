<?php

    global $smarty;

	$smarty->assign ('content_title', 'Forgot password');
	$smarty->assign ('content_tip', 'Please input your correct username and 
	    E-mail address to retrieve the password. Once you complete inputting 
	    the correct information, an E-mail with your password 
	    will be automatically sent to you.');
	$smarty->assign ('content_warning', $message);

	$smarty->assign ('content_action', RELA_DIR.'member/getpassword.php');
    $smarty->assign ('content_user',  StripSlashes($_POST["username"]));
	$smarty->assign ('content_email', StripSlashes($_POST["email"]));
	$smarty->assign ('content_signup', RELA_DIR."member/signup.php");
	
	$smarty->assign ('content_header', CURRENT_THEME.'/content.header.tpl');
	$smarty->assign ('content_body', CURRENT_THEME.'/member.getpassword.form.tpl');
	
?>