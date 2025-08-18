<?php
class ProductSetting
{
	function listProduct($message="")
	{
		global $conn, $smarty;
		//echo "<br>message : ".$message;		
		$sql = "select * from products where product_type = 1 order by product_id desc";
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
		include(ROOT_DIR . "templates/" . CURRENT_SKIN . "/admin.productsetting.listproduct.php");
		include(ROOT_DIR . "templates/" . CURRENT_SKIN . "/admin.tail.inc.php");
		
		$smarty->display(CURRENT_THEME.'/page.structure.tpl');
	//	showAlertMsg($message);
		die();
	}
	
	function startProduct()
	{
		global $conn;
		
		$product_id = $_REQUEST["product_id"];
		$product_id = intval($product_id);
		if($product_id == 0)
		{
			$this->listProduct(ADMIN_0022);
		}
		
		$sql = "select * from products where product_id=" . $product_id;
		$rs = $conn->Execute($sql);
		if(!$rs)
		{
			showAdminErrorMsg($conn->ErrorMsg());
		}
		if($rs->RecordCount() != 1)
		{
			$this->listProduct(ADMIN_0022);
		}
		
		$sql = "update products set
				flag = 0
			where	product_id = " . $product_id;
		$rs = $conn->Execute($sql);
		if(!$rs)
		{
			showAdminErrorMsg($conn->ErrorMsg());
		}
		$this->listProduct(ADMIN_0023);
		
		die();
	}

	function stopProduct()
	{
		global $conn;
		
		$product_id = $_REQUEST["product_id"];
		$product_id = intval($product_id);
		if($product_id == 0)
		{
			$this->listProduct(ADMIN_0022);
		}
		
		$sql = "select * from products where product_id=" . $product_id;
		$rs = $conn->Execute($sql);
		if(!$rs)
		{
			showAdminErrorMsg($conn->ErrorMsg());
		}
		if($rs->RecordCount() != 1)
		{
			$this->listProduct(ADMIN_0022);
		}
		
		$sql = "update products set
				flag = 1
			where	product_id = " . $product_id;
		$rs = $conn->Execute($sql);
		if(!$rs)
		{
			showAdminErrorMsg($conn->ErrorMsg());
		}
		$this->listProduct(ADMIN_0024);
		
		die();
	}

	function showModifyDNS($message="")
	{
		global $conn, $smarty;
		
		$product_id = $_REQUEST["product_id"];
		$product_id = intval($product_id);
		if($product_id == 0)
		{
			$this->listProduct(ADMIN_0022);
		}
		
		$sql = "select * from products where product_id=" . $product_id;
		$rs = $conn->Execute($sql);
		if(!$rs)
		{
			showAdminErrorMsg($conn->ErrorMsg());
		}
		if($rs->RecordCount() != 1)
		{
			$this->listProduct(ADMIN_0022);
		}
		
		$sql = "select * from default_dns where product_id=" . $product_id;
		$rs1 = $conn->Execute($sql);
		if(!$rs1)
		{
			showAdminErrorMsg($conn->ErrorMsg());
		}
		if($rs1->RecordCount() != 2)
		{
			$sql = "delete from default_dns where product_id=" . $product_id;
			$rs1 = $conn->Execute($sql);
			if(!$rs1)
			{
				showAdminErrorMsg($conn->ErrorMsg());
			}
			
			$default_dns1 = "ns1.onlinenic.com";
			$default_dns2 = "ns2.onlinenic.com";
		}else {
			$default_dns1 = $rs1->fields[2];
			$rs1->MoveNext();
			$default_dns2 = $rs1->fields[2];
		}
		
		$product_name	= $rs->fields[3];
		$product_type	= $rs->fields[4];
		
		include(ROOT_DIR . "templates/" . CURRENT_SKIN . "/admin.title.inc.php");
		include(ROOT_DIR . "templates/" . CURRENT_SKIN . "/admin.productsetting.modifydns.php");
		include(ROOT_DIR . "templates/" . CURRENT_SKIN . "/admin.tail.inc.php");
		$smarty->display(CURRENT_THEME.'/page.structure.tpl');
		die();
	}

	function modifyDNS()
	{
		global $conn;
		
		$dns1	= $_REQUEST["dns1"];
		$dns2	= $_REQUEST["dns2"];
		if($dns1 == "" || strlen($dns1) > 100 || checkDns($dns1))
		{
			$this->showModifyDNS(ADMIN_0025);
		}
		if($dns2 == "" || strlen($dns2) > 100 || checkDns($dns2))
		{
			$this->showModifyDNS(ADMIN_0026);
		}

		$product_id = $_REQUEST["product_id"];
		$product_id = intval($product_id);
		if($product_id == 0)
		{
			$this->listProduct(ADMIN_0022);
		}
		
		$sql = "select * from products where product_id=" . $product_id;
		//echo "<br>".$sql;
		//print_r($_REQUEST);
		$rs = $conn->Execute($sql);
		if(!$rs)
		{
			showAdminErrorMsg($conn->ErrorMsg());
		}
		if($rs->RecordCount() != 1)
		{
			$this->listProduct(ADMIN_0022);
		}
		
		$sql = "delete from default_dns where product_id = " . $product_id;
		$rs = $conn->Execute($sql);
		if(!$rs)
		{
			showAdminErrorMsg($conn->ErrorMsg());
		}
		
		$sql = "insert into default_dns(
				product_id,		dns_name
			)values(
				" . $product_id . ", '" . $dns1 .
			"')";
		$rs = $conn->Execute($sql);
		//echo "<br>sql2".$sql;
		if(!$rs)
		{
			showAdminErrorMsg($conn->ErrorMsg());
		}
		$sql = "insert into default_dns(
				product_id,		dns_name
			)values(
				" . $product_id . ", '" . $dns2 .
			"')";
		 //echo "<br>sql3".$sql;
		$rs = $conn->Execute($sql);
		if(!$rs)
		{
			showAdminErrorMsg($conn->ErrorMsg());
		}
		$this->listProduct(ADMIN_0027);
		
		die();
	}

	function showModifyPrice($message="")
	{
		global $conn, $smarty;
		
		$product_id = $_REQUEST["product_id"];
		$product_id = intval($product_id);
		if($product_id == 0)
		{
			$this->listProduct(ADMIN_0022);
		}
		
		$sql = "select * from products where product_id=" . $product_id;
		$rs = $conn->Execute($sql);
		if(!$rs)
		{
			showAdminErrorMsg($conn->ErrorMsg());
		}
		if($rs->RecordCount() != 1)
		{
			$this->listProduct(ADMIN_0022);
		}

		$product_name	= $rs->fields[3];
		$product_type	= $rs->fields[4];
		
		$sql = "select * from default_dns where product_id=" . $product_id;
		$rs1 = $conn->Execute($sql);
		if(!$rs1)
		{
			showAdminErrorMsg($conn->ErrorMsg());
		}
		if($rs1->RecordCount() != 2)
		{
			$sql = "delete from default_dns where product_id=" . $product_id;
			$rs1 = $conn->Execute($sql);
			if(!$rs1)
			{
				showAdminErrorMsg($conn->ErrorMsg());
			}
			
			$default_dns1 = "ns1.onlinenic.com";
			$default_dns2 = "ns2.onlinenic.com";
		}else {
			$default_dns1 = $rs1->fields[2];
			$rs1->MoveNext();
			$default_dns2 = $rs1->fields[2];
		}
		
		$sql = "select * from member_price where product_id=" . $product_id . " and type = 1 order by i_year, member_level";
		$rs = $conn->Execute($sql);
		if(!$rs)
		{
			showAdminErrorMsg($conn->ErrorMsg());
		}
		for($i = 1; $i < 11; $i ++)
		{
			for($j = 0; $j < 5; $j ++)
			{
				$reg_prices[$i][$j] = 0.0;
			}
		}
		while(!$rs->EOF)
		{
			$i_year		= $rs->fields[4];
			$i_member_level	= $rs->fields[2];
			$d_price	= $rs->fields[5];
			
			$reg_prices[$i_year][$i_member_level]	= $d_price;
			$rs->MoveNext();
		}

		$sql = "select * from member_price where product_id=" . $product_id . " and type = 2 and i_year = 1";
		$rs = $conn->Execute($sql);
		if(!$rs)
		{
			showAdminErrorMsg($conn->ErrorMsg());
		}
		for($j = 0; $j < 5; $j ++)
		{
			$del_prices[$j] = 0.0;
		}
		while(!$rs->EOF)
		{
			$i_member_level	= $rs->fields[2];
			$d_price	= $rs->fields[5];
			
			$del_prices[$i_member_level]	= $d_price;
			$rs->MoveNext();
		}

		$sql = "select * from member_price where product_id=" . $product_id . " and type = 3 order by i_year, member_level";
		$rs = $conn->Execute($sql);
		if(!$rs)
		{
			showAdminErrorMsg($conn->ErrorMsg());
		}
		for($i = 1; $i < 11; $i ++)
		{
			for($j = 0; $j < 5; $j ++)
			{
				$rew_prices[$i][$j] = 0.0;
			}
		}
		while(!$rs->EOF)
		{
			$i_year		= $rs->fields[4];
			$i_member_level	= $rs->fields[2];
			$d_price	= $rs->fields[5];
			
			$rew_prices[$i_year][$i_member_level]	= $d_price;
			$rs->MoveNext();
		}

        $sql = "select * from member_price where product_id=" . $product_id . " and type = 4 and i_year = 1";
		$rs = $conn->Execute($sql);
		if(!$rs)
		{
			showAdminErrorMsg($conn->ErrorMsg());
		}
		for($j = 0; $j < 5; $j ++)
		{
			$sync_prices[$j] = 0.0;
		}
		while(!$rs->EOF)
		{
			$i_member_level = $rs->fields[2];
			$s_price	= $rs->fields[5];
			
			$sync_prices[$i_member_level]	= $s_price;
			$rs->MoveNext();
		}
        
        
		include(ROOT_DIR . "templates/" . CURRENT_SKIN . "/admin.title.inc.php");
		include(ROOT_DIR . "templates/" . CURRENT_SKIN . "/admin.productsetting.modifyprice.php");
		include(ROOT_DIR . "templates/" . CURRENT_SKIN . "/admin.tail.inc.php");
		$smarty->display(CURRENT_THEME.'/page.structure.tpl');
		die();
	}
	
	function modifyPrice()
	{
		global $conn;

		$product_id = $_REQUEST["product_id"];
		$product_id = intval($product_id);
		if($product_id == 0)
		{
			$this->listProduct(ADMIN_0022);
		}
		
		$sql = "select * from products where product_id=" . $product_id;
		$rs = $conn->Execute($sql);
		if(!$rs)
		{
			showAdminErrorMsg($conn->ErrorMsg());
		}
		if($rs->RecordCount() != 1)
		{
			$this->listProduct(ADMIN_0022);
		}

		for($i = 1; $i < 11; $i ++)
		{
			for($j = 0; $j < 5; $j ++)
			{
				$reg_prices[$i][$j] = doubleval($_POST["reg_prices" . $i . $j]);
				$rew_prices[$i][$j] = doubleval($_POST["rew_prices" . $i . $j]);
				
				$sql = "select * from member_price where product_id=" . $product_id . " and type = 1 and member_level = " . $j . " and i_year = " . $i;
//				//echo "<br> ".$sql;
				$rs = $conn->Execute($sql);
				if(!$rs)
				{
					showAdminErrorMsg($conn->ErrorMsg());
				}
				$rs_count = $rs->RecordCount();
				if($rs_count == 1)
				{
					$sql = "update member_price set price=" . $reg_prices[$i][$j] . " where product_id=" . $product_id . " and type = 1 and member_level = " . $j . " and i_year = " . $i;
//					//echo "<br> testing *** ".$sql;
					$rs = $conn->Execute($sql);
					if(!$rs)
					{
						showAdminErrorMsg($conn->ErrorMsg());
					}
				}else if($rs_count == 0) {
					$sql = "insert into member_price(
							product_id,	member_level,		type,
							i_year,		price,			add_time,
							mod_time
						)values(
							" . $product_id . ", " . $j . ", 	1, " .
							$i . ", "	. $reg_prices[$i][$j] . ", '" . getDatetime() . "', '" .
							getDatetime() .
						"')";
					$rs = $conn->Execute($sql);
					if(!$rs)
					{
						showAdminErrorMsg($conn->ErrorMsg());
					}
				}else {
					$sql = "delete from member_price where product_id=" . $product_id . " and type = 1 and member_level = " . $j . " and i_year = " . $i;
					$rs = $conn->Execute($sql);
					if(!$rs)
					{
						showAdminErrorMsg($conn->ErrorMsg());
					}
					
					$sql = "insert into member_price(
							product_id,	member_level,		type,
							i_year,		price,			add_time,
							mod_time
						)values(
							" . $product_id . ", " . $j . ", 	1, " .
							$i . ", "	. $reg_prices[$i][$j] . ", '" . getDatetime() . "', '" .
							getDatetime() .
						"')";
					$rs = $conn->Execute($sql);
					if(!$rs)
					{
						showAdminErrorMsg($conn->ErrorMsg());
					}
				}
				
				$sql = "select * from member_price where product_id=" . $product_id . " and type = 3 and member_level = " . $j . " and i_year = " . $i;
				//echo "<br> ".$sql;
				$rs = $conn->Execute($sql);
				if(!$rs)
				{
					showAdminErrorMsg($conn->ErrorMsg());
				}
				$rs_count = $rs->RecordCount();
				if($rs_count == 1)
				{
					$sql = "update member_price set price=" . $rew_prices[$i][$j] . " where product_id=" . $product_id . " and type = 3 and member_level = " . $j . " and i_year = " . $i;
					$rs = $conn->Execute($sql);
					if(!$rs)
					{
						showAdminErrorMsg($conn->ErrorMsg());
					}
				}else if($rs_count == 0) {
					$sql = "insert into member_price(
							product_id,	member_level,		type,
							i_year,		price,			add_time,
							mod_time
						)values(
							" . $product_id . ", " . $j . ", 	3, " .
							$i . ", "	. $rew_prices[$i][$j] . ", '" . getDatetime() . "', '" .
							getDatetime() .
						"')";
					$rs = $conn->Execute($sql);
					if(!$rs)
					{
						showAdminErrorMsg($conn->ErrorMsg());
					}
				}else {
					$sql = "delete from member_price where product_id=" . $product_id . " and type = 3 and member_level = " . $j . " and i_year = " . $i;
					$rs = $conn->Execute($sql);
					if(!$rs)
					{
						showAdminErrorMsg($conn->ErrorMsg());
					}
					
					$sql = "insert into member_price(
							product_id,	member_level,		type,
							i_year,		price,			add_time,
							mod_time
						)values(
							" . $product_id . ", " . $j . ", 	3, " .
							$i . ", "	. $rew_prices[$i][$j] . ", '" . getDatetime() . "', '" .
							getDatetime() .
						"')";
					$rs = $conn->Execute($sql);
					if(!$rs)
					{
						showAdminErrorMsg($conn->ErrorMsg());
					}
				}			
			}
		}
		
		for($i = 0; $i < 5; $i ++)
		{
			$del_prices[$i] = doubleval($_POST["del_prices" . $i]);

			$sql = "select * from member_price where product_id=" . $product_id . " and type = 2 and member_level = " . $i . " and i_year = 1";
			$rs = $conn->Execute($sql);
			if(!$rs)
			{
				showAdminErrorMsg($conn->ErrorMsg());
			}
			$rs_count = $rs->RecordCount();
			if($rs_count == 1)
			{
				$sql = "update member_price set price=" . $del_prices[$i] . " where product_id=" . $product_id . " and type = 2 and member_level = " . $i . " and i_year = 1";
				$rs = $conn->Execute($sql);
				if(!$rs)
				{
					showAdminErrorMsg($conn->ErrorMsg());
				}
			}else if($rs_count == 0) {
				$sql = "insert into member_price(
						product_id,	member_level,		type,
						i_year,		price,			add_time,
						mod_time
					)values(
						" . $product_id . ", " . $i . ", 	2, " .
						"1, "		. $del_prices[$i] . ", '" . getDatetime() . "', '" .
						getDatetime() .
					"')";
				$rs = $conn->Execute($sql);
				if(!$rs)
				{
					showAdminErrorMsg($conn->ErrorMsg());
				}
			}else {
				$sql = "delete from member_price where product_id=" . $product_id . " and type = 2 and member_level = " . $i . " and i_year = 1";
				$rs = $conn->Execute($sql);
				if(!$rs)
				{
					showAdminErrorMsg($conn->ErrorMsg());
				}
			
				$sql = "insert into member_price(
						product_id,	member_level,		type,
						i_year,		price,			add_time,
						mod_time
					)values(
						" . $product_id . ", " . $i . ", 	2, " .
						$i . ", "	. $del_prices[$i] . ", '" . getDatetime() . "', '" .
						getDatetime() .
					"')";
				$rs = $conn->Execute($sql);
				if(!$rs)
				{
					showAdminErrorMsg($conn->ErrorMsg());
				}
			}
		}
        
        for($i = 0; $i < 5; $i ++)
		{
			$sync_prices[$i] = doubleval($_POST["sync_prices" . $i]);

			$sql = "select * from member_price where product_id=" . $product_id . " and type = 4 and member_level = " . $i . " and i_year = 1";
			$rs = $conn->Execute($sql);
			if(!$rs)
			{
				showAdminErrorMsg($conn->ErrorMsg());
			}
			$rs_count = $rs->RecordCount();
			if($rs_count == 1)
			{
				$sql = "update member_price set price=" . $sync_prices[$i] . " where product_id=" . $product_id . " and type = 4 and member_level = " . $i . " and i_year = 1";
				$rs = $conn->Execute($sql);
				if(!$rs)
				{
					showAdminErrorMsg($conn->ErrorMsg());
				}
			}else if($rs_count == 0) {
				$sql = "insert into member_price(
						product_id,	member_level,		type,
						i_year,		price,			add_time,
						mod_time
					)values(
						" . $product_id . ", " . $i . ", 	4, " .
						"1, "		. $sync_prices[$i] . ", '" . getDatetime() . "', '" .
						getDatetime() .
					"')";
				$rs = $conn->Execute($sql);
				if(!$rs)
				{
					showAdminErrorMsg($conn->ErrorMsg());
				}
			}else {
				$sql = "delete from member_price where product_id=" . $product_id . " and type = 4 and member_level = " . $i . " and i_year = 1";
				$rs = $conn->Execute($sql);
				if(!$rs)
				{
					showAdminErrorMsg($conn->ErrorMsg());
				}
			
				$sql = "insert into member_price(
						product_id,	member_level,		type,
						i_year,		price,			add_time,
						mod_time
					)values(
						" . $product_id . ", " . $i . ", 	4, " .
						$i . ", "	. $sync_prices[$i] . ", '" . getDatetime() . "', '" .
						getDatetime() .
					"')";
				$rs = $conn->Execute($sql);
				if(!$rs)
				{
					showAdminErrorMsg($conn->ErrorMsg());
				}
			}
		}
        
        
		$this->listProduct(ADMIN_0028);
		
		die();
	}
}
?>
