<?php
global $admin_info;
    global $smarty;
	
	$smarty->assign ('content_title', 'Member List &gt; View member information');
    $smarty->assign ('php_self', $_SERVER["PHP_SELF"]);
	$smarty->assign ('message', $message);
	$smarty->assign ('status', $status);

	$smarty->assign ('account', $account);
	$smarty->assign ('member_level', $member_level);
	$smarty->assign ('member_name', $member_name);
	$smarty->assign ('member_id', $member_id);

	$smarty->assign ('reg_time', $reg_time);
	
	$smarty->assign ('r_org', $r_org);
	$smarty->assign ('r_address1', $r_address1);
	$smarty->assign ('r_address2', $r_address2);
	$smarty->assign ('r_address3', $r_address3);
	$smarty->assign ('r_city',  $r_city);
	$smarty->assign ('r_province', $r_province);
    $smarty->assign ('r_email', $r_email);
	$smarty->assign ('r_fax', $r_fax);
	$smarty->assign ('r_telephone', $r_telephone);
	$smarty->assign ('r_postalcode', $r_postalcode);
	$smarty->assign ('r_name', $r_name);
	$smarty->assign ('r_country', $r_country);
	$smarty->assign ('currentPage', $_REQUEST["currentPage"]);
	
	$smarty->assign ('content_header', CURRENT_THEME.'/content.header.tpl');
	$smarty->assign ('content_body', CURRENT_THEME.'/admin.listmember.viewmemberinfo.tpl');

?>

