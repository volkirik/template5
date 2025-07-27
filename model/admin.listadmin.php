<?php
class AdminManage
{
	function listAdmin($message)
	{
		global $conn;
		global $smarty;
		$sql = "select * from admins where admin_id <> 100 order by admin_id desc";
		$rs = $conn->Execute($sql);
		if(!$rs)
		{
			showAdminErrorMsg($conn->ErrorMsg());
		}
		$currentPage = 1;
		if (isset($_REQUEST["currentPage"])) {
			$currentPage = $_REQUEST["currentPage"];
		}
		initPage($rs, PAGE_SIZE, $currentPage, $pageCount, $totalRecord);
		
		include(ROOT_DIR . "templates/" . CURRENT_SKIN . "/admin.title.inc.php");
		include(ROOT_DIR . "templates/" . CURRENT_SKIN . "/admin.listadmin.php");
		include(ROOT_DIR . "templates/" . CURRENT_SKIN . "/admin.tail.inc.php");
		
		$smarty->display (CURRENT_THEME.'/page.structure.tpl');
		showAlertMsg($message);
		die();
	}
	
	function showAddForm($message)
	{   global $smarty;
	
		include(ROOT_DIR . "templates/" . CURRENT_SKIN . "/admin.title.inc.php");
		include(ROOT_DIR . "templates/" . CURRENT_SKIN . "/admin.listadmin.addform.php");
		include(ROOT_DIR . "templates/" . CURRENT_SKIN . "/admin.tail.inc.php");
	    
		$smarty->display(CURRENT_THEME.'/page.structure.tpl');	
		
		die();
	}

	function addAdmin()
	{
		global $conn;
		
		$admin_name		= handleData($_REQUEST["admin_name"]);
		$admin_dept		= handleData($_REQUEST["admin_dept"]);
		$admin_password		= handleData($_REQUEST["admin_password"]);
		$admin_password1	= handleData($_REQUEST["admin_password1"]);
		$admin_flag		= handleData($_REQUEST["admin_flag"]);
		
		if($admin_name == ""
			|| strlen($admin_name) > 80
		)
			$this->showAddForm(ADMIN_0008);
		if($admin_dept == ""
			|| strlen($admin_dept) > 80
		)
			$this->showAddForm(ADMIN_0009);
		if($admin_password == ""
			|| strlen($admin_password) > 20
			|| checkAscii($admin_password)
		)
			$this->showAddForm(ADMIN_0010);
		if($admin_password != $admin_password1)
			$this->showAddForm(ADMIN_0011);
		$admin_flag = intval($admin_flag);
		
		$admin_name		= handleSQLData($admin_name);
		$admin_dept		= handleSQLData($admin_dept);
		$admin_password		= handleSQLData($admin_password);
		$sql = "insert into admins(
			name,		dept,		password,
			add_time,	flag
		)values(
			'" . $admin_name . "', '" . $admin_dept . "', '" . $admin_password .
			"', '" . getDatetime() . "', " . $admin_flag .
		")";
		$rs = $conn->Execute($sql);
		if(!$rs)
		{
			showAdminErrorMsg($conn->ErrorMsg());
		}else {
			$this->listAdmin(ADMIN_0012);
		}
		
		die();
	}

	function showModifyForm($message)
	{
		global $conn, $smarty;
		
		$admin_id = $_REQUEST["admin_id"];
		$admin_id = intval($admin_id);
		if($admin_id == 0)
		{
			$this->listAdmin(ADMIN_0013);
		}
		if($admin_id == 100)
		{
			$this->listAdmin(ADMIN_0014);
		}
		
		$sql = "select * from admins where admin_id=" . $admin_id;
		$rs = $conn->Execute($sql);
		if(!$rs)
		{
			showAdminErrorMsg($conn->ErrorMsg());
		}
		if($rs->RecordCount() != 1)
		{
			$this->listAdmin(ADMIN_0013);
		}

		if($message != "")
		{
			$admin_name		= handleData($_REQUEST["admin_name"]);
			$admin_dept		= handleData($_REQUEST["admin_dept"]);
			$admin_password		= handleData($_REQUEST["admin_password"]);
			$admin_password1	= handleData($_REQUEST["admin_password1"]);
			$admin_flag		= handleData($_REQUEST["admin_flag"]);
		}else {
			$admin_name		= $rs->fields(1);
			$admin_dept		= $rs->fields(2);
			$admin_flag		= $rs->fields(5);
		}
	
		include(ROOT_DIR . "templates/" . CURRENT_SKIN . "/admin.title.inc.php");
		include(ROOT_DIR . "templates/" . CURRENT_SKIN . "/admin.listadmin.modifyform.php");
		include(ROOT_DIR . "templates/" . CURRENT_SKIN . "/admin.tail.inc.php");
        
		$smarty->display(CURRENT_THEME.'/page.structure.tpl');
		die();
	}

	function modifyAdmin()
	{
		global $conn;
		
		$admin_id	= handleData($_REQUEST["admin_id"]);
		$admin_name	= handleData($_REQUEST["admin_name"]);
		$admin_dept	= handleData($_REQUEST["admin_dept"]);
		$admin_password	= handleData($_REQUEST["admin_password"]);
		$admin_password1= handleData($_REQUEST["admin_password1"]);
		$admin_flag	= handleData($_REQUEST["admin_flag"]);

		$admin_id	= intval($admin_id);
		if($admin_id == 0)
		{
			$this->listAdmin(ADMIN_0013);
		}
		if($admin_id == 100)
		{
			$this->listAdmin(ADMIN_0014);
		}
		
		if($admin_name == ""
			|| strlen($admin_name) > 80
		)
			$this->showModifyForm(ADMIN_0008);
		if($admin_dept == ""
			|| strlen($admin_dept) > 80
		)
			$this->showModifyForm(ADMIN_0009);
		if($admin_password != "")
		{
			if(strlen($admin_password) > 20 || checkAscii($admin_password))
				$this->showModifyForm(ADMIN_0010);
			if($admin_password != $admin_password1)
				$this->showModifyForm(ADMIN_0011);
		}
		$admin_flag = intval($admin_flag);
		
		$sql = "select * from admins where admin_id = " . $admin_id;
		$rs = $conn->Execute($sql);
		if(!$rs)
		{
			showAdminErrorMsg($conn->ErrorMsg());
		}
		if($rs->RecordCount() != 1)
		{
			$this->listAdmin(ADMIN_0013);
		}

		$admin_name		= handleSQLData($admin_name);
		$admin_dept		= handleSQLData($admin_dept);
		$admin_password		= handleSQLData($admin_password);
		if($admin_password != "")
		{
			$sql = "update admins set
					name = '" . $admin_name . "', 
					dept = '" . $admin_dept . "', 
					password = '" . $admin_password . "', 
					flag = " . $admin_flag . "
				where	admin_id = " . $admin_id;			
		}else {
			$sql = "update admins set
					name = '" . $admin_name . "', 
					dept = '" . $admin_dept . "', 
					flag = " . $admin_flag . " 
				where	admin_id = " . $admin_id;
		}
		$rs = $conn->Execute($sql);
		if(!$rs)
		{
			showAdminErrorMsg($conn->ErrorMsg());
		}
		$this->listAdmin(ADMIN_0015);
		
		die();
	}
	
	function deleteAdmin()
	{
		global $conn;
		
		$admin_id = $_REQUEST["admin_id"];
		$admin_id = intval($admin_id);
		if($admin_id == 0)
		{
			$this->listAdmin(ADMIN_0013);
		}
		if($admin_id == 100)
		{
			$this->listAdmin(ADMIN_0014);
		}
		
		$sql = "select * from admins where admin_id=" . $admin_id;
		$rs = $conn->Execute($sql);
		if(!$rs)
		{
			showAdminErrorMsg($conn->ErrorMsg());
		}
		if($rs->RecordCount() != 1)
		{
			$this->listAdmin(ADMIN_0013);
		}
		
		$sql = "delete from admins where admin_id=" . $admin_id;
		$rs = $conn->Execute($sql);
		if(!$rs)
		{
			showAdminErrorMsg($conn->ErrorMsg());
		}
		$this->listAdmin(ADMIN_0016);
		
		die();
	}
	
	function showSetTask($message)
	{
		global $conn;
		global $smarty;
		
		$admin_id = $_REQUEST["admin_id"];
		$admin_id = intval($admin_id);
		if($admin_id == 0)
		{
			$this->listAdmin(ADMIN_0013);
		}
		if($admin_id == 100)
		{
			$this->listAdmin(ADMIN_0014);
		}
		
		if(DB_TYPE == "mysql")
		{
			$sql = "select name, dept, add_time from admins where admin_id=" . $admin_id;
		}else {
			$sql = "select name, dept, convert(varchar(20), add_time, 120) from admins where admin_id=" . $admin_id;
		}
		$rs = $conn->Execute($sql);
		if(!$rs)
		{
			showAdminErrorMsg($conn->ErrorMsg());
		}
		if($rs->RecordCount() != 1)
		{
			$this->listAdmin(ADMIN_0013);
		}
		
		$admin_name	= $rs->fields[0];
		$admin_dept	= $rs->fields[1];
		$add_time	= $rs->fields[2];
		
		$sql = "select * from tasks order by task_id desc";
		$rs = $conn->Execute($sql);
		if(!$rs)
		{
			showAdminErrorMsg($conn->ErrorMsg());
		}
		
		include(ROOT_DIR . "templates/" . CURRENT_SKIN . "/admin.title.inc.php");
		include(ROOT_DIR . "templates/" . CURRENT_SKIN . "/admin.listadmin.settask.php");
		include(ROOT_DIR . "templates/" . CURRENT_SKIN . "/admin.tail.inc.php");
		
		$smarty->display(CURRENT_THEME.'/page.structure.tpl');
		die();
	}
	
	function setAdminTask()
	{
		global $conn;
		
		$admin_id = $_REQUEST["admin_id"];
		$admin_id = intval($admin_id);
		if($admin_id == 0)
		{
			$this->listAdmin(ADMIN_0013);
		}
		if($admin_id == 100)
		{
			$this->listAdmin(ADMIN_0014);
		}
		
		$taskids = $_REQUEST["task_id"];
		$len = count($taskids);
		
		$sql = "delete from admintask where admin_id = " . $admin_id;
		$rs = $conn->Execute($sql);
		if(!$rs)
		{
			showAdminErrorMsg($conn->ErrorMsg());
		}
		
		for($i = 0; $i < $len; $i ++)
		{
			$sql = "insert into admintask(
					admin_id,	task_id
				)values(
					" . $admin_id . ", " . $taskids[$i] .
				")";
			$rs = $conn->Execute($sql);
			if(!$rs)
			{
				showAdminErrorMsg($conn->ErrorMsg());
			}
		}
		$this->listAdmin(ADMIN_0017);
		
		die();
	}
}
?>
