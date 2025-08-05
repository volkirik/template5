<?php
	$smarty->assign ('content_title', 'İşlem Geçmişi');
    $smarty->assign ('php_self', $_SERVER["PHP_SELF"]);
    $smarty->assign ('member_info', $member_info);

	$iyr = array();
	for($i_year = 1970; $i_year <= intval(date("Y")); $i_year ++)
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
	
	$sql = "select * from products";
	$rs2 = $conn->Execute($sql);
	if(!$rs2)
	{
		showErrorMsg($conn->ErrorMsg());
    }
	
	$arr_rs2 = array();
	while(!$rs2->EOF){
		array_push ($arr_rs2, array($rs2->fields[1], $rs2->fields[3]));
		$rs2->MoveNext();
	}
	$smarty->assign ('rs2', $arr_rs2);
	$smarty->assign('product_id', $product_id);
	$smarty->assign('transation', $transation);
	
	$smarty->assign('member_name', $member_name);
	
	if(!$rs->EOF)
{
    $rs_arr = array();
	$rs1_arr = array();
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
		array_push ($rs_arr, array($rs->fields, $color));
		$mode_id = $rs->fields[4];
		$sql = "select * from ordermode where mode_id = " . $mode_id . " and mode_lan = ". WEBSITE_LANGUAGE;
		$rs1 = $conn->Execute($sql);
		if(!$rs1)
		{
			showErrorMsg($conn->ErrorMsg());
		}
		array_push ($rs1_arr, $rs1->fields[3]);
		
		$i ++;
		$rs->MoveNext();
	}//echo '<pre>';print_r ($rs_arr);echo '</pre>';
	    $smarty->assign('rs', $rs_arr);
		$smarty->assign('rs1', $rs1_arr);
		$webaddress = $_SERVER["PHP_SELF"] . "?transation=" . $transation . "&startYear=" . $startYear . "&startMonth=" . $startMonth . "&startDay=" . $startDay . "&toYear=" . $toYear . "&toMonth=" . $toMonth . "&toDay=" . $toDay . "&product_id=" . $product_id . "&member_name=" . $member_name;
	    $pagebutton = showPageButton($currentPage, $pageCount, $totalRecord, $webaddress);
        $smarty->assign('pagebutton', $pagebutton );
}
		$smarty->assign('transation', $transation);
	
	
	$smarty->assign ('content_header', CURRENT_THEME.'/content.header.tpl');
	$smarty->assign ('content_body', CURRENT_THEME.'/admin.queryorder.form.tpl');

?>
