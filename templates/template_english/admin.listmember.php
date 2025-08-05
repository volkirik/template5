<?php
global $admin_info;

	$smarty->assign ('content_title', 'Member List');

    $smarty->assign ('php_self', $_SERVER["PHP_SELF"]);

	$iyear = array();			
	for($i_year = 1970; $i_year <= date("Y"); $i_year ++)
	{   array_push ($iyear, $i_year);
	}
	$smarty->assign('startYear', $startYear);
	$smarty->assign('iyear', $iyear);
	
	$imonth = array();			
	for($i_month = 1; $i_month < 13; $i_month ++)
	{   array_push ($imonth, $i_month);
	}
	$smarty->assign('startMonth', $startMonth);
	$smarty->assign('imonth', $imonth);
	
	$iday  = array();			
	for($i_day = 1; $i_day < 32; $i_day ++)
	{   array_push ($iday, $i_day);
	}
	$smarty->assign('startDay', $startDay);
	$smarty->assign('iday', $iday);
	
	$smarty->assign('orders', $orders);
	$smarty->assign('member_name', $member_name);

	if(!$rs->EOF)
	{
		$rs->Move(($currentPage - 1) * PAGE_SIZE);
		$i = 0;
		$arr = array();
		while(!$rs->EOF && $i < PAGE_SIZE)
		{
			if($i % 2)
			{
				$color = " bgcolor=\"#EFEFEF\"";
			}else {
				$color = "";
			}
			array_push ($arr, array ($rs->fields, $color)) ;
			$i ++;
			$rs->MoveNext();
		}
		$smarty->assign('rs', $arr);
		$webaddress = $_SERVER["PHP_SELF"] . "?action=listMember";
		$pagebutton = showPageButton($currentPage, $pageCount, $totalRecord, $webaddress);
		$smarty->assign('pagebutton', $pagebutton);
	}	
    
	$smarty->assign ('content_header', CURRENT_THEME.'/content.header.tpl');
	$smarty->assign ('content_body', CURRENT_THEME.'/admin.listmember.tpl');

?>
