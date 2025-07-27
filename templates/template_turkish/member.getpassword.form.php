<?php

    global $smarty;

$smarty->assign ('content_title', 'Şifreyi Unuttum');
$smarty->assign ('content_tip', 'Lütfen doğru kullanıcı adınızı ve 
    E-posta adresinizi girin. Doğru bilgileri girdikten sonra, şifrenizle 
    ilgili bir e-posta otomatik olarak size gönderilecektir.');
	$smarty->assign ('content_warning', $message);

	$smarty->assign ('content_action', RELA_DIR.'member/getpassword.php');
    $smarty->assign ('content_user',  StripSlashes($_POST["username"]));
	$smarty->assign ('content_email', StripSlashes($_POST["email"]));
	$smarty->assign ('content_signup', RELA_DIR."member/signup.php");
	
	$smarty->assign ('content_header', CURRENT_THEME.'/content.header.tpl');
	$smarty->assign ('content_body', CURRENT_THEME.'/member.getpassword.form.tpl');
	
?>
