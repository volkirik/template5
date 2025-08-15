<?php
class SystemControl
{
	function showStatus($message)
	{
		global $conn, $smarty;
		
		$sql = "select * from web_config";
		$rs = $conn->Execute($sql);
		if(!$rs)
		{
			showAdminErrorMsg($conn->ErrorMsg());
		}
		
		$current_skin		= $rs->fields[0];
		$website_language	= $rs->fields[1];
		$title			    = $rs->fields[2];
		$copyright		    = $rs->fields[3];
		$pagesize		    = $rs->fields[4];
		$system_status		= $rs->fields[5];
		$customer_id		= $rs->fields[7];
		$server_host		= $rs->fields[9];
		$server_port		= $rs->fields[10];
		$current_theme      = $rs->fields[16];
		
		if ($rs->fields[17] == 1)
		    $domain_lock        = 'checked';
		else
		     $domain_lock       = '';
        
        if ($rs->fields[18] == 1)
		    $domain_renew        = 'checked';
		else
		     $domain_renew       = '';
			 
        if ($rs->fields["captcha_enable"] == 1)
		    $captcha_enable        = 'checked';
		else
		     $captcha_enable       = '';

		include(ROOT_DIR . "templates/" . CURRENT_SKIN . "/admin.title.inc.php");
		include(ROOT_DIR . "templates/" . CURRENT_SKIN . "/admin.systemcontrol.php");
		include(ROOT_DIR . "templates/" . CURRENT_SKIN . "/admin.tail.inc.php");
		
        $smarty->display(CURRENT_THEME.'/page.structure.tpl');
		showAlertMsg($message);
		die();
	}
	
	function setStatus()
	{
		global $conn;
		
		$current_skin		= handleData($_REQUEST["current_skin"]);
		$website_language	= intval(handleData($_REQUEST["website_language"]));
		$title			= handleData($_REQUEST["title"]);
		$copyright		= handleData($_REQUEST["copyright"]);
		$pagesize		= intval(handleData($_REQUEST["pagesize"]));
		$status			= intval(handleData($_REQUEST["status"]));
		$customer_id		= intval(handleData($_REQUEST["customer_id"]));
		$customer_password	= handleData($_REQUEST["customer_password"]);
		$server_host		= handleData($_REQUEST["server_host"]);
		$server_port		= intval(handleData($_REQUEST["server_port"]));
		$current_theme      = handleData($_REQUEST["current_theme"]);
		$lock_status        = handleData($_REQUEST["domain_lock"]);
        $renew_status        = handleData($_REQUEST["domain_renew"]);
        $captcha_status        = handleData($_REQUEST["captcha_enable"]);
		
		if($website_language != 1 && $website_language != 2)
		{
			$website_language = 1;
		}
		if ($current_skin == ''){
			$current_skin = 'template_english';
		}
	/*	$d = dir("../templates");
		while($entry = $d->read())
		{
			if($entry == $current_skin)
			{
				$flag = 1;
				break;
			}
		}
		if($flag != 1)
		{
			$this->showStatus(ADMIN_0029);
		}
	*/
		if($title == ""
			|| strlen($title) > 100
			|| checkAscii($title)
		)
			$this->showStatus(ADMIN_0030);
		if($copyright == ""
			|| strlen($copyright) > 100
		)
			$this->showStatus(ADMIN_0031);
		if($pagesize < 1 || $pagesize > 50)
		{
			$this->showStatus(ADMIN_0032);
		}
		if($status != 0 && $status != 1)
		{
			$this->showStatus(ADMIN_0033);
		}
		if($customer_id < 10000 || $customer_id > 1000000)
		{
			$this->showStatus(ADMIN_0036);
		}
		if($customer_password != ""
			&& strlen($customer_password) > 20)
		{
			$this->showStatus(ADMIN_0037);
		}
		if($server_host == ""
			|| strlen($server_host) > 50
			|| checkAscii($server_host))
		{
			$this->showStatus(ADMIN_0038);
		}
		if($server_port == 0
			|| $server_port > 100000)
		{
			$this->showStatus(ADMIN_0039);
		}
		
		$d = dir("../themes");
		while($entry = $d->read())
		{
			if($entry == $current_theme)
			{
				$flag = 1;
				break;
			}
		}
		if($flag != 1)
		{
			$this->showStatus(ADMIN_0029);
		}
		
		$title			= handleSQLData($title);
		$copyright		= handleSQLData($copyright);
		$server_host		= handleSQLData($server_host);
        
		if ($lock_status == 'Enabled')
		    $domain_lock = 1;
		else 
		    $domain_lock = 0;
        
        if ($renew_status == 'Enabled')
		    $domain_renew = 1;
		else 
		    $domain_renew = 0;
		
        if ($captcha_status == 'Enabled')
		    $captcha_enable = 1;
		else 
		    $captcha_enable = 0;
		
		if($customer_password != "")
		{
			$customer_password	= md5($customer_password);
			$sql = "update web_config set
					current_skin = '" . $current_skin . "',
					website_language = " . $website_language . ",
					title = '" . $title . "',
					copyright = '" . $copyright . "',
					pagesize = " . $pagesize . ",
					system_status = " . $status . ",
					customer_id = " . $customer_id . ",
					password = '" . $customer_password . "',
					reg_host = '" . $server_host . "',
					reg_port = " . $server_port.",
					current_theme = '". $current_theme."',
					domain_lock     =   ".$domain_lock.",
                    domain_renewal     =   ".$domain_renew.",
                    captcha_enable     =   ".$captcha_enable;
		}else {
			$sql = "update web_config set
					current_skin = '" . $current_skin . "',
					website_language = " . $website_language . ",
					title = '" . $title . "',
					copyright = '" . $copyright . "',
					pagesize = " . $pagesize . ",
					system_status = " . $status . ",
					customer_id = " . $customer_id . ",
					reg_host = '" . $server_host . "',
					reg_port = " . $server_port.",
					current_theme = '". $current_theme."',
					domain_lock     =   ".$domain_lock.",
                    domain_renewal     =   ".$domain_renew.",
                    captcha_enable     =   ".$captcha_enable;
		}
		$rs = $conn->Execute($sql);
		if(!$rs)
		{
			showAdminErrorMsg($conn->ErrorMsg());
		}
		$this->showStatus(ADMIN_0034);
	
		die();
	}
}
?>
