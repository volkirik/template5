<?php
class DomainCheck
{
	function showCheckForm($message)
	{
		global $conn;
		global $smarty;
		
		$sql = "select * from products where flag = 0 and product_type = 1";
		$rs = $conn->Execute($sql);
		if(!$rs)
		{
			showAdminErrorMsg($conn->ErrorMsg());
		}
		include(ROOT_DIR . "templates/" . CURRENT_SKIN . "/admin.title.inc.php");
		include(ROOT_DIR . "templates/" . CURRENT_SKIN . "/domain.checkdomain.form.php");
		include(ROOT_DIR . "templates/" . CURRENT_SKIN . "/admin.tail.inc.php");
		$smarty->display(CURRENT_THEME.'/page.structure.tpl');
		die();
	}
	
	function checkDomain()
	{
		global $conn;
		global $smarty;
		
		$domain	= strtolower($_POST["domain"]);
		$gtld	= intval($_POST["gtld"]);

		if($gtld == 0)
		{
			$this->showCheckForm("Please provide a valid value for your gtld");
		}
		if($domain == "")
		{
			$this->showCheckForm("Please provide a valid value for your domain");
		}
		if(strlen($domain) > 63)
		{
			$this->showCheckForm("The domain you provided can't be more than 63 characters");
		}
		if(onlinenicValidateDomain($domain))
		{
			$this->showCheckForm("The domain you provided was not in the appropriate format");
		}

		$product_info	= getProductInfo($gtld);
		$real_domain	= $domain . $product_info[3];
		$domain_type	= $product_info[2];
		
		if(connectRegServer($fp) < 0)
		{
			$this->showCheckForm(DOMAIN_0056);
		}
		$result = onlinenicLogin($fp);
		if($result < 0)
		{
			$this->showCheckForm(DOMAIN_0056);
		}
		$result = onlinenicCheckDomain($fp, $real_domain, $domain_type);
		if($result < 0)
		{
			$this->showCheckForm(All_0002);
		}

		$sql = "select * from products where flag = 0 and product_type = 1";
		$rs = $conn->Execute($sql);
		if(!$rs)
		{
			showAdminErrorMsg($conn->ErrorMsg());
		}
		
		include(ROOT_DIR . "templates/" . CURRENT_SKIN . "/admin.title.inc.php");
		include(ROOT_DIR . "templates/" . CURRENT_SKIN . "/admin.checkresult.php");
		include(ROOT_DIR . "templates/" . CURRENT_SKIN . "/admin.tail.inc.php");
		$smarty->display(CURRENT_THEME.'/page.structure.tpl');
		die();
	}
}
?>
