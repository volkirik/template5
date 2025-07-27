<?php

	$smarty->assign ('content_title', 'Manage DNS');
    $smarty->assign ('content_tip', 'You can add new name servers or edit the existing nameservers.');
    $smarty->assign ('content_warning', $message);
	 
	$smarty->assign ('php_self', $_SERVER["PHP_SELF"]);

	$arr = array();
	if(!$rs->EOF)
    {
		$rs->Move(($currentPage - 1) * PAGE_SIZE);
		$i = 0;

		while(!$rs->EOF && $i < PAGE_SIZE)
		{
			if($i % 2)
			{
				$color = " bgcolor=\"#EFEFEF\"";
			}else {
				$color = "";
			}
			array_push($arr, array ($rs->fields, $color));

			$i ++;
			$rs->MoveNext();
		}
		
		$webaddress = $_SERVER["PHP_SELF"] . "?dns=" . $dns . "&member_name=" . $member_name;
		$smarty->assign ('pagebutton', showPageButton($currentPage, $pageCount, $totalRecord, $webaddress));
    }	
	
    $admin = new MemberLogin();
	$admin_info = $admin->checkAdminLogin();
	if($admin_info == -1)
		$smarty->assign ('show_query', 'none');
	else 
        $smarty->assign ('show_query', '');
    
    $smarty->assign('rs', $arr);
	$smarty->assign ('transation', $transation);
	$smarty->assign ('content_header', CURRENT_THEME.'/content.header.tpl');
	$smarty->assign ('content_body', CURRENT_THEME.'/admin.dnslist.tpl');
	
?>
