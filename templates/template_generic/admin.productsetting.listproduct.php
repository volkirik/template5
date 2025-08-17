<?php
global $admin_info, $smarty;
	$smarty->assign ('content_title', constant('TEMPLATE_0032'));

	$smarty->assign ('php_self', $php_self);
	$smarty->assign ('currentPage', $currentPage);
	$smarty->assign ('content_warning', $message);	
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
		array_push ($arr, array ($rs->fields, $color)) ;
		$i ++;
		$rs->MoveNext();
	}
	$smarty->assign('rs', $arr);
	$webaddress = $_SERVER["PHP_SELF"] . "?action=listProduct";
	$smarty->assign('pagebutton', showPageButton($currentPage, $pageCount, $totalRecord, $webaddress));
}
	$smarty->assign ('content_header', CURRENT_THEME.'/content.header.tpl');
	$smarty->assign ('content_body', CURRENT_THEME.'/admin.productsetting.listproduct.tpl');	

?>
  
