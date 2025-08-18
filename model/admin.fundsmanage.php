<?php
class FundsManage
{
	function showForm($message="")
	{   global $smarty;
		include(ROOT_DIR . "templates/" . CURRENT_SKIN . "/admin.title.inc.php");
		include(ROOT_DIR . "templates/" . CURRENT_SKIN . "/admin.fundsmanage.form.php");
		include(ROOT_DIR . "templates/" . CURRENT_SKIN . "/admin.tail.inc.php");
		
		$smarty->display(CURRENT_THEME.'/page.structure.tpl');
		showAlertMsg($message);
		die();
	}
	
	function modifyFunds()
	{
		global $conn, $smarty;
		
		$member_name	= handleData($_REQUEST["member_name"]);
		$type		= intval(handleData($_REQUEST["type"]));
		$amount		= doubleval(handleData($_REQUEST["amount"]));
		$note		= handleData($_REQUEST["note"]);

		if($member_name == ""
			|| strlen($member_name) > 20
			|| checkAlphaNum($member_name)
		)
			$this->showForm(ADMIN_0001);
		if($type != 1 && $type != 2)
		{
			$this->showForm(ADMIN_0002);
		}
		if($amount < 0)
		{
			$this->showForm(ADMIN_0003);
		}

		if($note == ""
			|| strlen($note) > 177
			|| checkAscii($note)
		)
			$this->showForm(ADMIN_0004);
		
		$sql = "select member_id, member_level from members where member_name='" . handleSQLData($member_name) . "'";
		$rs = $conn->Execute($sql);
		if(!$rs)
		{
			showAdminErrorMsg($conn->ErrorMsg());
		}
		if($rs->RecordCount() != 1)
		{
			$this->showForm(ADMIN_0005);
		}
		$member_id = $rs->fields[0];
		$member_level = $rs->fields[1];
		$note = handleSQLData($note);
		if($type == 1)
		{
			if(insertMoneyMode($member_id, 1, 1, $amount, $note) < 0)
			{
				$this->showForm(ADMIN_0006);
			}
			if(updateFunds($member_id, 1, $amount) < 0)
			{
				$this->showForm(ADMIN_0006);
			}
		}else {
			if(insertMoneyMode($member_id, 2, 2, $amount, $note) < 0)
			{
				$this->showForm(ADMIN_0006);
			}
			if(updateFunds($member_id, 2, $amount) < 0)
			{
				$this->showForm(ADMIN_0006);
			}
		}
		
		include(ROOT_DIR . "templates/" . CURRENT_SKIN . "/admin.title.inc.php");
		include(ROOT_DIR . "templates/" . CURRENT_SKIN . "/admin.fundsmanage.modifylevel.php");
		include(ROOT_DIR . "templates/" . CURRENT_SKIN . "/admin.tail.inc.php");
		$smarty->display(CURRENT_THEME.'/page.structure.tpl');
		
		die();
	}
	
	function modifyLevel()
	{
		global $conn;
		
		$member_name	= handleData($_REQUEST["member_name"]);
		$member_level	= intval($_REQUEST["member_level"]);
		
		if($member_level < 0 || $member_level > 4)
		{
			$this->showForm(ALL_0001);
		}
		
		$sql = "select * from members where member_name='" . handleSQLData($member_name) . "'";
		$rs = $conn->Execute($sql);
		if(!$rs)
		{
			showAdminErrorMsg($conn->ErrorMsg());
		}
		if($rs->RecordCount() != 1)
		{
			$this->showForm(ADMIN_0005);
		}
		
		$sql = "update members set member_level = " . $member_level . " where member_name='" . handleSQLData($member_name) . "'";
		$rs = $conn->Execute($sql);
		if(!$rs)
		{
			showAdminErrorMsg($conn->ErrorMsg());
		}
		
		$this->showForm(ADMIN_0007);
	}
}
?>
