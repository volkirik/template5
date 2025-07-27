<?php
global $admin_info;
    global $smarty;
	
	$smarty->assign ('content_title', 'Administrator List');
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

	$smarty->assign ( 'rs', $arr);
    $smarty->assign ('php_self', $_SERVER["PHP_SELF"]);
    $smarty->assign ('currentPage', $currentPage);
    $smarty->assign ('transation', $transation);
	
	$webaddress = $_SERVER["PHP_SELF"] . "?action=listAdmin";
	$smarty->assign ('pageCount', $pageCount);
	$smarty->assign ('totalRecord', $totalRecord);
	$smarty->assign ('webaddress', $webaddress);
		
	$smarty->assign ('pagebutton', showPageButton($currentPage, $pageCount, $totalRecord, $webaddress));
// table close

}
    $doDelete = 'function doDelete(){
	                if(confirm("Are you sure to delete this Administrator?")){
		                return true;
	                }else{  return false;  }
                  }';
	
    $smarty->assign ('function_doDelete', $doDelete);
	$smarty->assign ('content_header', CURRENT_THEME.'/content.header.tpl');
	$smarty->assign ('content_body', CURRENT_THEME.'/admin.listadmin.tpl');
