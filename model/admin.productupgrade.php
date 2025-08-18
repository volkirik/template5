<?php
class ProductUpgrade
{
	function showNewDomain($message="")
	{
		global $conn;
		global $smarty;
			
		$sql = "select * from products where product_type = 1";
		$rs = $conn->Execute($sql);
		if(!$rs)
		{
			showAdminErrorMsg($conn->ErrorMsg());
		}
		
		$result = getServerDomainList();
		if($result == -1)
		{
			showAdminErrorMsg(All_0002);
		}
		$start_pos = strpos($result, "Content-Type: text/plain");
		$result = substr($result, $start_pos + 28);
		
		$lines = split("\n", $result);
		$l_count = count($lines);
		$i = 0;
		$k = 0;
		while(!$rs->EOF)
		{
			$datas[$i] = $rs->fields[1];
			$i ++;
			$rs->MoveNext();
		}
		$rs->Close();
		$d_count = count($datas);
		for($i = 0; $i < $l_count; $i ++)
		{
			for($j = 0; $j < $d_count; $j ++)
			{
				if($datas[$j] == substr($lines[$i], 0, 4))
				{
					$l_flag[$i] = 0;
					break;
				}else {
					$l_flag[$i] = 1;
				}
			}
			if($l_flag[$i] == 1)
			{
				$results[$k] = $lines[$i];
				$k ++;
			}
		}
		
		include(ROOT_DIR . "templates/" . CURRENT_SKIN . "/admin.title.inc.php");
		include(ROOT_DIR . "templates/" . CURRENT_SKIN . "/admin.productupgrade.shownewdomain.php");
		include(ROOT_DIR . "templates/" . CURRENT_SKIN . "/admin.tail.inc.php");
		
		$smarty->display(CURRENT_THEME.'/page.structure.tpl');
		showAlertMsg($message);
		die();
	}
	
	function upgradeDomain()
	{
		global $conn, $smarty;
		
		$product_id = intval($_REQUEST["product_id"]);
		if($product_id == 0)
		{
			$this->showNewDomain(DOMAIN_0066);
		}
		
		$result = getServerDomainDetail($product_id);
		if($result == -1)
		{
			$this->showNewDomain(All_0002);
		}
		if(!($start_pos = strpos($result, "Content-Type: text/plain")))
		{
			$this->showNewDomain(All_0002);
		}
		$result = substr($result, $start_pos + 28);
		$lines = split("\n", $result);
		if(count($lines) != 9)
		{
			$this->showNewDomain(All_0003);
		}
		$domainDetails = split("\|\|", $lines[0]);
		for($i = 1; $i < 9; $i ++)
		{
			$orderModes[$i] = split("\|\|", $lines[$i]);
			if(count($orderModes[$i]) != 5)
			{
				$this->showNewDomain(All_0003);
			}
		}
		
		if($domainDetails[0] != strval($product_id))
		{
			$this->showNewDomain(All_0003);
		}
		
		$sql = "select *
			from	products
			where	product_id = " . $product_id;
		$rs = $conn->Execute($sql);
		if(!$rs)
		{
			$this->showNewDomain(ALL_0001);
		}
		if($rs->RecordCount() > 0)
		{
			$sql = "update products
				set	domain_type	= " . $domainDetails[1] . ",
					product_name	= '" . $domainDetails[2] . "',
					product_type	= " . $domainDetails[3] ."
				where	product_id = " . $product_id;
			$rs = $conn->Execute($sql);
			if(!$rs)
			{
				$this->showNewDomain(ALL_0004);
			}
		}else {
			$sql = "insert into products(
					product_id,		domain_type,		product_name,
					product_type,		flag
				)values(" .
					$domainDetails[0] . ", " . $domainDetails[1]. ", '" . $domainDetails[2] . "', " .
					$domainDetails[3] . ", " . "1" .
				")";
			$rs = $conn->Execute($sql);
			if(!$rs)
			{
				$this->showNewDomain(ALL_0005);
			}
		}
		
		for($i = 1; $i < 9; $i ++)
		{
			$sql = "select *
				from	ordermode
				where	product_id	= " . $product_id . "
					and mode_lan	= " . $orderModes[$i][1] . "
					and mode_type	= " . $orderModes[$i][4];
			$rs = $conn->Execute($sql);
			if(!$rs)
			{
				$this->showNewDomain(ALL_0001);
			}
			if($rs->RecordCount() > 0)
			{
				$sql = "update ordermode
					set	mode_id		= " . $orderModes[$i][0] . ",
						mode_name	= '" . $orderModes[$i][2] . "'
					where	product_id	= " . $product_id . "
						and mode_lan	= " . $orderModes[$i][1] . "
						and mode_type	= " . $orderModes[$i][4];
				$rs = $conn->Execute($sql);
				if(!$rs)
				{
					$this->showNewDomain(ALL_0001);
				}
			}else {
				$sql = "insert into ordermode(
						mode_id,		mode_lan,		mode_name,
						product_id,		mode_type
					)values(" .
						$orderModes[$i][0] . ", " . $orderModes[$i][1] . ", '" . $orderModes[$i][2] . "', " .
						$product_id . ", " .	$orderModes[$i][4] .
					")";
				$rs = $conn->Execute($sql);
				if(!$rs)
				{
					$this->showNewDomain(ALL_0005);
				}
			}
		}

		include(ROOT_DIR . "templates/" . CURRENT_SKIN . "/admin.title.inc.php");
		include(ROOT_DIR . "templates/" . CURRENT_SKIN . "/admin.productupgrade.upgradesuccess.php");
		include(ROOT_DIR . "templates/" . CURRENT_SKIN . "/admin.tail.inc.php");
		$smarty->display(CURRENT_THEME.'/page.structure.tpl');
		die();
	}
}
?>
