<?php
global $admin_info, $smarty;
	
	$smarty->assign ('content_title', constant("TEMPLATE_0023"));

	$smarty->assign ('add_time', $add_time);
	$smarty->assign ('admin_dept', $admin_dept);
	$smarty->assign ('admin_name', $admin_name);
	$smarty->assign ('message', $message);
	$smarty->assign ('content_action', $_SERVER["PHP_SELF"]);
	$smarty->assign ('content_header', CURRENT_THEME.'/content.header.tpl');
	$smarty->assign ('content_body', CURRENT_THEME.'/admin.listadmin.settask.tpl');
    $smarty->assign ('admin_id', $admin_id);
	$smarty->assign ('current_page', isset($_REQUEST["currentPage"]) ? $_REQUEST["currentPage"] : 1);
 
    $arr = array();
while(!$rs->EOF)
{   
	$sql = "select * from admintask where admin_id=" . $admin_id . " and task_id=" . $rs->fields[0];
	$rs1 = $conn->Execute($sql);
	if(!$rs1)
	{
		showErrorMsg($conn->ErrorMsg());
	}
	if($rs1->RecordCount() == 1)
	{
		$check_status = "checked";
	}else {
		$check_status = "";
	}
	array_push ($arr, array ($rs->fields, $check_status));
	
	$rs->MoveNext();
}
	$smarty->assign ('rs', $arr);
	$smarty->assign ('content_header', CURRENT_THEME.'/content.header.tpl');
	$smarty->assign ('content_body', CURRENT_THEME.'/admin.listadmin.settask.tpl');
 
?>
