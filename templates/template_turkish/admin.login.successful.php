<?php
global $member_info;
global $smarty;

	$smarty->assign ('content_title', 'Hesabım');

	$smarty->assign ('member_info', $member_info);
	$smarty->assign ('content_logout', RELA_DIR.'/member/logout.php');

	$smarty->assign ('content_header', CURRENT_THEME.'/content.header.tpl');
	$smarty->assign ('content_body', CURRENT_THEME.'/admin.login.successful.tpl');

?>
