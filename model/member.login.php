<?php
class MemberLogin
{
	function showForm($message="")
	{ global $smarty;
		include(ROOT_DIR . "templates/" . CURRENT_SKIN . "/title.inc.php");
		include(ROOT_DIR . "templates/" . CURRENT_SKIN . "/member.login.form.php");
		include(ROOT_DIR . "templates/" . CURRENT_SKIN . "/tail.inc.php");
		$smarty->assign ('RELA_DIR', RELA_DIR);
		$smarty->assign ('CAPTCHA_ENABLE', CAPTCHA_ENABLE);
		$smarty->display(CURRENT_THEME.'/page.structure.tpl');
		die();
	}

	function login()
	{
		global $conn;
		global $member_info;
		
		$username	= isset($_REQUEST["username"]) ? handleData($_REQUEST["username"]) : '';
		$password	= isset($_REQUEST["password"]) ? handleData($_REQUEST["password"]) : '';
		$keystring 	= isset($_REQUEST["keystring"]) ? handleData($_REQUEST["keystring"]) : '';
		
		if($username == ""
			|| strlen($username) > 20
			|| checkAscii($username)
		)
			$this->showForm(MEMBER_0021);
		if($password == ""
			|| strlen($password) > 20
			|| checkAscii($password)
		)
			$this->showForm(MEMBER_0022);
		if ( CAPTCHA_ENABLE ===1 && (!isset($_SESSION['OSOLmulticaptcha_keystring']) || $_SESSION['OSOLmulticaptcha_keystring'] !== $keystring)){
			$this->showForm(ALL_0006);
		}
		if(CAPTCHA_ENABLE===1 && isset($_SESSION['OSOLmulticaptcha_keystring'])){
			unset($_SESSION['OSOLmulticaptcha_keystring']);
		}

		if(checkNumeric($username))
		{
			$sql = "select
					member_id,		flag
				from	members
				where	member_name='" . $username . "'
					and member_password='" . handleSQLData(md5($password)) . "'";
			$rs = $conn->Execute($sql);
			if(!$rs)
			{
				$this->showForm(ALL_0001);
			}
			if($rs->RecordCount() != 1)
			{
				$this->showForm(MEMBER_0023);
			}
			if($rs->fields[1] != 0)
			{
				$this->showForm(MEMBER_0024);
			}
	
			$sql = "insert into sessions(
					member_id,		login_type,		remote_addr,
					last_access_time
				)values(
					" . $rs->fields[0] . ", 1, '" .			$_SERVER["REMOTE_ADDR"] . "', '" .
					getDateTime() .
				"')";
			$rs = $conn->Execute($sql);
			if(!$rs)
			{
				$this->showForm(ALL_0005);
			}
			$_SESSION["sessionID"] = $conn->Insert_ID();
			$member_info = $this->checkLogin();
			if($member_info == -1)
			{
				$this->showForm("");
			}
			$_SESSION['login_name'] = $username;
            $_SESSION['selected_user'] = $username;
			$this->showMemberPanel();
		}else {
			$sql = "select
					admin_id,		flag
				from	admins
				where	admin_id=" . $username . "
					and password='" . handleSQLData($password) . "'";
			$rs = $conn->Execute($sql);
			if(!$rs)
			{
				$this->showForm(ALL_0001);
			}
			if($rs->RecordCount() != 1)
			{
				$this->showForm(MEMBER_0023);
			}
			if($rs->fields[1] != 0)
			{
				$this->showForm(MEMBER_0024);
			}
	
			$sql = "insert into sessions(
					member_id,		login_type,		remote_addr,
					last_access_time
				)values(
					" . $rs->fields[0] . ", 2, '" . 		$_SERVER["REMOTE_ADDR"] . "', '" .
					getDateTime() .
				"')";
			$rs = $conn->Execute($sql);
			if(!$rs)
			{
				$this->showForm(ALL_0005);
			}
			$_SESSION["sessionID"] = $conn->Insert_ID();
			$admin_info = $this->checkAdminLogin();
			if($admin_info == -1)
			{
				$this->showForm("");
			}
			$_SESSION['user'] = 'admin';
			$_SESSION['login_name'] = $username;
			$this->showAdminPanel();
		}
	}
	
	function showMemberPanel()
	{   global $smarty;
        global $member_info;
		include(ROOT_DIR . "templates/" . CURRENT_SKIN . "/title.inc.php");
		include(ROOT_DIR . "templates/" . CURRENT_SKIN . "/member.login.successful.php");
		include(ROOT_DIR . "templates/" . CURRENT_SKIN . "/tail.inc.php");
		
		$smarty->display(CURRENT_THEME.'/page.structure.tpl');
		
		die();
	}

	function showAdminPanel()
	{   global $smarty;
	    global $member_info;
		include(ROOT_DIR . "templates/" . CURRENT_SKIN . "/admin.title.inc.php");
//		include(ROOT_DIR . "templates/" . CURRENT_SKIN . "/admin.login.successful.php");
		include(ROOT_DIR . "templates/" . CURRENT_SKIN . "/admin.tail.inc.php");
		
		$smarty->display(CURRENT_THEME.'/page.structure.tpl');
		die();
	}
	
	function checkLogin()
	{
		global $conn;
		
		if(!isset($_SESSION["sessionID"]))
		{
			return -1;
		}
		$sql = "select
				member_id
			from	sessions
			where	session_id = " . $_SESSION["sessionID"] . "
				and login_type = 1";
		$rs = $conn->Execute($sql);
		if(!$rs)
		{
			return -1;
		}
		if($rs->RecordCount() != 1)
		{
			return -1;
		}

		$sql = "select	*
			from	members
			where	member_id = " . $rs->fields[0];
		$rs = $conn->Execute($sql);
		if(!$rs)
		{
			return -1;
		}
		if($rs->EOF)
		{
			return -1;
		}
		$member_info = $rs->FetchRow();
		
		return $member_info;
	}

	function checkAdminLogin()
	{
		global $conn;
		
		if(!isset($_SESSION["sessionID"]))
		{
			return -1;
		}
		$sql = "select
				member_id
			from	sessions
			where	session_id = " . $_SESSION["sessionID"] . "
				and login_type = 2";
		$rs = $conn->Execute($sql);
		if(!$rs)
		{
			return -1;
		}
		if($rs->RecordCount() != 1)
		{
			return -1;
		}
		
		$sql = "select	*
			from	admins
			where	admin_id = " . $rs->fields[0];
		$rs = $conn->Execute($sql);
		if(!$rs)
		{
			return -1;
		}
		if($rs->EOF)
		{
			return -1;
		}
		$admin_info = $rs->FetchRow();
		
		return $admin_info;
	}
	
	function checkAdminTask($admin_id, $task_name)
	{
		global $conn;
		
		if($admin_id == 100)
		{
			return 0;
		}
		
		$sql = "select	*
			from	admintask	a,
				tasks		b
			where	a.admin_id = " . $admin_id . "
				and a.task_id = b.task_id
				and b.task_name = '" . $task_name . "'";
		$rs = $conn->Execute($sql);
		if(!$rs)
		{
			return -1;
		}
		if($rs->RecordCount() != 1)
		{
			return -2;
		}
		
		return 0;
	}
	
	function logout()
	{
		global $conn;

		if(isset($_SESSION["sessionID"]))		
		{
			$sql = "delete from sessions where session_id = " . $_SESSION["sessionID"];
			$rs = $conn->Execute($sql);
			if(!$rs)
			{
				showErrorMsg($conn->ErrorMsg());
			}
		}

		session_unset();
		header("Location:" . RELA_DIR);
	}
}
?>
