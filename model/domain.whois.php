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
			showErrorMsg($conn->ErrorMsg());
		}
		
		include(ROOT_DIR . "templates/" . CURRENT_SKIN . "/title.inc.php");
		include(ROOT_DIR . "templates/" . CURRENT_SKIN . "/domain.whois.form.php");
		include(ROOT_DIR . "templates/" . CURRENT_SKIN . "/tail.inc.php");
		$smarty->display(CURRENT_THEME.'/page.structure.tpl');
		die();
	}
	
	function getWhois()
	{
		global $conn, $smarty;
		
		$domain		= strtolower(handleData($_REQUEST["domain"]));
		$gtld		= intval(handleData($_REQUEST["gtld"]));
		
		if($gtld == 0)
		{
			$this->showCheckForm(DOMAIN_0068);
		}
		if($domain == "")
		{
			$this->showCheckForm(DOMAIN_0069);
		}
		$sql = "select * from products where product_id=" . $gtld;
		$rs = $conn->Execute($sql);
		if(!$rs)
		{
			showErrorMsg($conn->ErrorMsg());
		}
		if($rs->RecordCount() != 1)
		{
			$this->showCheckForm(DOMAIN_0068);
		}
		
		$domain .= $rs->fields[3];
		$result = onlinenicWhois($domain);
		if($result < 0)
		{
			$this->showCheckForm(All_0002);
		}
		$parts = preg_split('/(\[[^\]]+\])/', $result, 3, PREG_SPLIT_DELIM_CAPTURE);
		$avail_msg=$parts[0];
		$whois_srv=$parts[1];
		$result=$parts[2];
		
		include(ROOT_DIR . "templates/" . CURRENT_SKIN . "/title.inc.php");
		include(ROOT_DIR . "templates/" . CURRENT_SKIN . "/domain.whois.result.php");
		include(ROOT_DIR . "templates/" . CURRENT_SKIN . "/tail.inc.php");
		$smarty->display(CURRENT_THEME.'/page.structure.tpl');
		die();
	}
}
?>
