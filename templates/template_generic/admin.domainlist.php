<?php

	$smarty->assign ('content_title', constant("TEMPLATE_0004"));
    $smarty->assign ('content_tip', constant("TEMPLATE_0005"));

	$smarty->assign ('php_self', $_SERVER["PHP_SELF"]);
		
	$iyr = array();
	for($i_year = 2002; $i_year < 2006; $i_year ++)
	   array_push ($iyr, $i_year);
	$smarty->assign ('iyr', $iyr);
	$smarty->assign ('startYear', $startYear);
	
	$imonth = array();
	for($i_month = 1; $i_month < 13; $i_month ++)
	    array_push ($imonth, $i_month);
	$smarty->assign ('imonth',  $imonth);
	$smarty->assign ('startMonth', $startMonth);

	$iday = array();
	for($i_day = 1; $i_day < 32; $i_day ++)
    	array_push ($iday, $i_day);
	$smarty->assign('iday', $iday);
	$smarty->assign('startDay', $startDay);
	
	$smarty->assign('toYear', $toYear);
	$smarty->assign('toMonth', $toMonth );
	$smarty->assign('toDay', $toDay );  
	
	$arr_rs2 = array();
	while(!$rs2->EOF){
		array_push ($arr_rs2, array($rs2->fields[1], $rs2->fields[3]));
		$rs2->MoveNext();
	}
	$smarty->assign ('rs2', $arr_rs2);
	$smarty->assign('product_id', $product_id);
	
	$smarty->assign ('member_name', $member_name);
	$smarty->assign('domain_name', $domain_name);
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
	

	
	$webaddress = $_SERVER["PHP_SELF"] . "?startYear=" . $startYear . "&startMonth=" . $startMonth . "&startDay=" . $startDay . "&toYear=" . $toYear . "&toMonth=" . $toMonth . "&toDay=" . $toDay . "&domain_name=" . $domain_name . "&member_name=" . $member_name;
	
    $smarty->assign ('pagebutton', showPageButton($currentPage, $pageCount, $totalRecord, $webaddress));
   }	
    	$smarty->assign('rs', $arr);
	$smarty->assign ('transation', $transation);
	$smarty->assign ('content_header', CURRENT_THEME.'/content.header.tpl');
	$smarty->assign ('content_body', CURRENT_THEME.'/admin.domainlist.tpl');
	
?>
