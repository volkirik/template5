<?php
class Whois
{
	function showCheckForm($message)
	{
		global $conn, $smarty;
		
		$sql = "select * from products where flag = 0 and product_type = 1 order by id";
		$rs = $conn->Execute($sql);
		if(!$rs)
		{
			showAdminErrorMsg($conn->ErrorMsg());
		}
		
		include(ROOT_DIR . "templates/" . CURRENT_SKIN . "/admin.title.inc.php");
		include(ROOT_DIR . "templates/" . CURRENT_SKIN . "/domain.whois.form.php");
		include(ROOT_DIR . "templates/" . CURRENT_SKIN . "/admin.tail.inc.php");
		$smarty->display(CURRENT_THEME.'/page.structure.tpl');
		die();
	}
	
	function getWhois()
	{
		global $conn, $smarty;
		
		$domain		= strtolower($_REQUEST["domain"]);
		$gtld		= intval($_REQUEST["gtld"]);
		
		if($gtld == 0)
		{
			$this->showCheckForm("Please provide a valid value for your domain type");
		}
		
		if($domain == "")
		{
			$this->showCheckForm("Please provide a valid value for your domain");
		}
		$sql = "select * from products where product_id=" . $gtld;
		$rs = $conn->Execute($sql);
		if(!$rs)
		{
			showAdminErrorMsg($conn->ErrorMsg());
		}
		if($rs->RecordCount() != 1)
		{
			$this->showCheckForm("Please provide a valid value for your domain type");
		}
		
		$domain .= $rs->fields[3];
		$result = onlinenicWhois($domain);
		if($result < 0)
		{
			$this->showCheckForm("Error");
		}
		$parts = preg_split('/(\[[^\]]+\])/', $result, 3, PREG_SPLIT_DELIM_CAPTURE);
		$avail_msg=$parts[0];
		$whois_srv=$parts[1];
		$result=$parts[2];
	
		include(ROOT_DIR . "templates/" . CURRENT_SKIN . "/admin.title.inc.php");
		include(ROOT_DIR . "templates/" . CURRENT_SKIN . "/domain.whois.result.php");
		include(ROOT_DIR . "templates/" . CURRENT_SKIN . "/admin.tail.inc.php");
		$smarty->display(CURRENT_THEME.'/page.structure.tpl');
	}
}
?>
