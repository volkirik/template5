<?php
class DomainManage
{
	function listDomain($message)
	{
		global $conn, $smarty;
		
		if(isset($_REQUEST["Submit"]) && $_REQUEST["Submit"] != ""){
			$startYear	= intval($_REQUEST["startYear"]);
			$startMonth	= intval($_REQUEST["startMonth"]);
			$startDay	= intval($_REQUEST["startDay"]);
			$toYear		= intval($_REQUEST["toYear"]);
			$toMonth	= intval($_REQUEST["toMonth"]);
			$toDay		= intval($_REQUEST["toDay"]);
			$product_id	= $_REQUEST["product_id"];
			$domain_name	= handleData($_REQUEST["domain_name"]);
			$member_name	= handleData($_REQUEST["member_name"]);
		} else {
			$startYear	= 0;
			$startMonth	= 0;
			$startDay	= 0;
			$toYear		= 0;
			$toMonth	= 0;
			$toDay		= 0;
			$product_id	= 0;
			$domain_name	= '';
			$member_name	= '';
			$searchDate = 0;
		}
		
		if ($startYear > 0 || $startMonth > 0 || $startDay > 0 || $toYear > 0 || $toMonth > 0 || $toDay > 0) {
			$searchDate = 1;
			if(DB_TYPE == "mysql")
			{
				$startDate	= $startYear . "-" . $startMonth . "-" . $startDay;
				$toDate		= $toYear . "-" . $toMonth . "-" . $toDay;
			}else {
				$startDate	= $startMonth . "/" . $startDay . "/" . $startYear;
				$toDate		= $toMonth . "/" . $toDay . "/" . $toYear;
			}
		} else {
			$searchDate =0;
		}

		if(DB_TYPE == "mysql")
		{
			$sql = "select distinct
					a.domain_id,
					a.domain_name,
					a.domain_type,
					a.product_type,
					a.add_date,
					a.domain_year,
					a.domain_dns1,
					a.domain_dns2,
					b.member_name
				from	domains	a,
					members b,
                    products c
				where	state = 0
					and a.member_id = b.member_id";
		}else {
			$sql = "select distinct
					a.domain_id,
					a.domain_name,
					a.domain_type,
					a.product_type,
					convert(varchar(20), a.add_date, 120),
					a.domain_year,
					a.domain_dns1,
					a.domain_dns2,
					b.member_name
				from	domains a,
					members b,
                    products c
				where	state = 0
					and a.member_id = b.member_id";
		}
		if($product_id != '')
		{
			//$sql .= " and c.product_id = " . $product_id. " and a.domain_name like '%"."c.product_name'";
           $sql .= " and a.domain_name like '%".$product_id."' "; 
		}
		if($searchDate == 1)
		{
			if(DB_TYPE == "mysql")
			{
				$sql .= " and to_days(a.add_date) >= to_days('" . $startDate . "')" .
				 	" and to_days(a.add_date) <= to_days('" . $toDate . "')";
			}else {
				$sql .= " and a.add_date > '" . $startDate . "'" .
				 	" and a.add_date-1 < '" . $toDate . "'";
			}
		}
		if($domain_name != "")
		{
			$sql .= " and a.domain_name = '" . handleSQLData($domain_name) . "'";
		}
		if($member_name != "")
		{
			$sql .= " and b.member_name = '" . handleSQLData($member_name) . "'";
		}
		$sql .= " order by add_date desc";
		 //echo "<br>".$sql."<br>";

		$rs = $conn->Execute($sql);
		if(!$rs)
		{
			showAdminErrorMsg($conn->ErrorMsg());
		}
		$currentPage = $_GET["currentPage"];
		initPage($rs, PAGE_SIZE, $currentPage, $pageCount, $totalRecord);
		
		$sql = "select * from products where product_type = 1";
		$rs2 = $conn->Execute($sql);
		if(!$rs2)
		{
			showAdminErrorMsg($conn->ErrorMsg());
		}

		include(ROOT_DIR . "templates/" . CURRENT_SKIN . "/admin.title.inc.php");
		include(ROOT_DIR . "templates/" . CURRENT_SKIN . "/admin.domainlist.php");
		include(ROOT_DIR . "templates/" . CURRENT_SKIN . "/admin.tail.inc.php");
		
		$smarty->display(CURRENT_THEME.'/page.structure.tpl');
		showAlertMsg($message);
		die();
	}
	
	function showContact($message)
	{
		global $conn, $smarty;
		
		$domain_id = intval($_REQUEST["domain_id"]);
		
		$sql = "select
				domain_id,		domain_name,		domain_type,
				product_type,		registrant,		admin,
				tech,			billing
			from	domains
			where	domain_id = " . $domain_id . "
				and state = 0";
				
		$rs = $conn->Execute($sql);
	//	echo "<pre>"; print_r ($rs->fields); echo "</pre>";
		
		if(!$rs)
		{
			$this->listDomain(ALL_0001);
		}
		if($rs->RecordCount() != 1)
		{  
			$this->listDomain(ALL_0001);
		}
		
		if($_REQUEST["Submit"] != "")
		{
			$password1	= handleData($_REQUEST["password1"]);
			$password2	= handleData($_REQUEST["password2"]);
			$registrant	= handleData($_REQUEST["registrant"]);
			$r_org		= handleData($_REQUEST["r_org"]);
			$r_address1	= handleData($_REQUEST["r_address1"]);
			$r_address2	= handleData($_REQUEST["r_address2"]);
			$r_address3	= handleData($_REQUEST["r_address3"]);
			$r_city		= handleData($_REQUEST["r_city"]);
			$r_province	= handleData($_REQUEST["r_province"]);
			$r_country	= handleData($_REQUEST["r_country"]);
			$r_postalcode	= handleData($_REQUEST["r_postalcode"]);
			$r_telephone	= handleData($_REQUEST["r_telephone"]);
			$r_fax		= handleData($_REQUEST["r_fax"]);
			$r_email	= handleData($_REQUEST["r_email"]);
			$administrator	= handleData($_REQUEST["administrator"]);
			$a_org		= handleData($_REQUEST["a_org"]);
			$a_address1	= handleData($_REQUEST["a_address1"]);
			$a_address2	= handleData($_REQUEST["a_address2"]);
			$a_address3	= handleData($_REQUEST["a_address3"]);
			$a_city		= handleData($_REQUEST["a_city"]);
			$a_province	= handleData($_REQUEST["a_province"]);
			$a_country	= handleData($_REQUEST["a_country"]);
			$a_postalcode	= handleData($_REQUEST["a_postalcode"]);
			$a_telephone	= handleData($_REQUEST["a_telephone"]);
			$a_fax		= handleData($_REQUEST["a_fax"]);
			$a_email	= handleData($_REQUEST["a_email"]);
			$technical	= handleData($_REQUEST["technical"]);
			$t_org		= handleData($_REQUEST["t_org"]);
			$t_address1	= handleData($_REQUEST["t_address1"]);
			$t_address2	= handleData($_REQUEST["t_address2"]);
			$t_address3	= handleData($_REQUEST["t_address3"]);
			$t_city		= handleData($_REQUEST["t_city"]);
			$t_province	= handleData($_REQUEST["t_province"]);
			$t_country	= handleData($_REQUEST["t_country"]);
			$t_postalcode	= handleData($_REQUEST["t_postalcode"]);
			$t_telephone	= handleData($_REQUEST["t_telephone"]);
			$t_fax		= handleData($_REQUEST["t_fax"]);
			$t_email	= handleData($_REQUEST["t_email"]);
			$billing	= handleData($_REQUEST["billing"]);
			$b_org		= handleData($_REQUEST["b_org"]);
			$b_address1	= handleData($_REQUEST["b_address1"]);
			$b_address2	= handleData($_REQUEST["b_address2"]);
			$b_address3	= handleData($_REQUEST["b_address3"]);
			$b_city		= handleData($_REQUEST["b_city"]);
			$b_province	= handleData($_REQUEST["b_province"]);
			$b_country	= handleData($_REQUEST["b_country"]);
			$b_postalcode	= handleData($_REQUEST["b_postalcode"]);
			$b_telephone	= handleData($_REQUEST["b_telephone"]);
			$b_fax		= handleData($_REQUEST["b_fax"]);
			$b_email	= handleData($_REQUEST["b_email"]);
		}else {
			$sql = "select *
				from	contacts
				where	contact_id = " . $rs->fields[4];
			$rs1 = $conn->Execute($sql);
			if(!$rs1)
			{
				$this->listDomain(ALL_0001);
			}
			if($rs1->RecordCount() != 1)
			{
				$this->listDomain(ALL_0001);
			}
			$registrant	= $rs1->fields[2];
			$r_org		= $rs1->fields[3];
			$r_address1	= $rs1->fields[4];
			$r_address2	= $rs1->fields[5];
			$r_address3	= $rs1->fields[6];
			$r_city		= $rs1->fields[7];
			$r_province	= $rs1->fields[8];
			$r_country	= $rs1->fields[9];
			$r_postalcode	= $rs1->fields[10];
			$r_telephone	= $rs1->fields[11];
			$r_fax		= $rs1->fields[12];
			$r_email	= $rs1->fields[13];
			$rs->Close();
			
			$sql = "select *
				from	contacts
				where	contact_id = " . $rs->fields[5];
			$rs1 = $conn->Execute($sql);
			if(!$rs1)
			{
				$this->listDomain(ALL_0001);
			}
			if($rs1->RecordCount() != 1)
			{
				$this->listDomain(ALL_0001);
			}
			$administrator	= $rs1->fields[2];
			$a_org		= $rs1->fields[3];
			$a_address1	= $rs1->fields[4];
			$a_address2	= $rs1->fields[5];
			$a_address3	= $rs1->fields[6];
			$a_city		= $rs1->fields[7];
			$a_province	= $rs1->fields[8];
			$a_country	= $rs1->fields[9];
			$a_postalcode	= $rs1->fields[10];
			$a_telephone	= $rs1->fields[11];
			$a_fax		= $rs1->fields[12];
			$a_email	= $rs1->fields[13];
			$rs->Close();
			
			$sql = "select *
				from	contacts
				where	contact_id = " . $rs->fields[6];
			$rs1 = $conn->Execute($sql);
			if(!$rs1)
			{
				$this->listDomain(ALL_0001);
			}
			if($rs1->RecordCount() != 1)
			{
				$this->listDomain(ALL_0001);
			}
			$technical	= $rs1->fields[2];
			$t_org		= $rs1->fields[3];
			$t_address1	= $rs1->fields[4];
			$t_address2	= $rs1->fields[5];
			$t_address3	= $rs1->fields[6];
			$t_city		= $rs1->fields[7];
			$t_province	= $rs1->fields[8];
			$t_country	= $rs1->fields[9];
			$t_postalcode	= $rs1->fields[10];
			$t_telephone	= $rs1->fields[11];
			$t_fax		= $rs1->fields[12];
			$t_email	= $rs1->fields[13];
			$rs->Close();
			
			$sql = "select *
				from	contacts
				where	contact_id = " . $rs->fields[7];
			$rs1 = $conn->Execute($sql);
			if(!$rs1)
			{
				$this->listDomain(ALL_0001);
			}
			if($rs1->RecordCount() != 1)
			{
				//$this->listDomain(ALL_0001);
			}
			$billing	= $rs1->fields[2];
			$b_org		= $rs1->fields[3];
			$b_address1	= $rs1->fields[4];
			$b_address2	= $rs1->fields[5];
			$b_address3	= $rs1->fields[6];
			$b_city		= $rs1->fields[7];
			$b_province	= $rs1->fields[8];
			$b_country	= $rs1->fields[9];
			$b_postalcode	= $rs1->fields[10];
			$b_telephone	= $rs1->fields[11];
			$b_fax		= $rs1->fields[12];
			$b_email	= $rs1->fields[13];
			$rs1->Close();
		}
		$countries = getCountryInfo();
		
		include(ROOT_DIR . "templates/" . CURRENT_SKIN . "/admin.title.inc.php");
		include(ROOT_DIR . "templates/" . CURRENT_SKIN . "/domain.showcontact.php");
		include(ROOT_DIR . "templates/" . CURRENT_SKIN . "/admin.tail.inc.php");
		$smarty->display(CURRENT_THEME.'/page.structure.tpl');
		die();
	}
	
	function modifyContact()
	{
		global $conn, $smarty;
		
		$domain_id = intval($_REQUEST["domain_id"]);
		
		$sql = "select
				domain_id,		domain_name,		domain_type,
				product_type,		registrant,		admin,
				tech,			billing
			from	domains
			where	domain_id = " . $domain_id . "
				and state = 0";
		$rs = $conn->Execute($sql);
		if(!$rs)
		{
			$this->listDomain(ALL_0001);
		}
		if($rs->RecordCount() != 1)
		{
			$this->listDomain(ALL_0001);
		}
		
		$domain		= $rs->fields[1];
		$domain_type	= $rs->fields[2];
		$registrant_id	= $rs->fields[4];
		$admin_id	= $rs->fields[5];
		$tech_id	= $rs->fields[6];
		$billing_id	= $rs->fields[7];
		$rs->Close();
		
		$password1	= handleData($_REQUEST["password1"]);
		$password2	= handleData($_REQUEST["password2"]);
		$r_org		= handleData($_REQUEST["r_org"]);
		$r_address1	= handleData($_REQUEST["r_address1"]);
		$r_address2	= handleData($_REQUEST["r_address2"]);
		$r_address3	= handleData($_REQUEST["r_address3"]);
		$r_city		= handleData($_REQUEST["r_city"]);
		$r_province	= handleData($_REQUEST["r_province"]);
		$r_country	= handleData($_REQUEST["r_country"]);
		$r_postalcode	= handleData($_REQUEST["r_postalcode"]);
		$r_telephone	= handleData($_REQUEST["r_telephone"]);
		$r_fax		= handleData($_REQUEST["r_fax"]);
		$r_email	= handleData($_REQUEST["r_email"]);
		$administrator	= handleData($_REQUEST["administrator"]);
		$a_org		= handleData($_REQUEST["a_org"]);
		$a_address1	= handleData($_REQUEST["a_address1"]);
		$a_address2	= handleData($_REQUEST["a_address2"]);
		$a_address3	= handleData($_REQUEST["a_address3"]);
		$a_city		= handleData($_REQUEST["a_city"]);
		$a_province	= handleData($_REQUEST["a_province"]);
		$a_country	= handleData($_REQUEST["a_country"]);
		$a_postalcode	= handleData($_REQUEST["a_postalcode"]);
		$a_telephone	= handleData($_REQUEST["a_telephone"]);
		$a_fax		= handleData($_REQUEST["a_fax"]);
		$a_email	= handleData($_REQUEST["a_email"]);
		$technical	= handleData($_REQUEST["technical"]);
		$t_org		= handleData($_REQUEST["t_org"]);
		$t_address1	= handleData($_REQUEST["t_address1"]);
		$t_address2	= handleData($_REQUEST["t_address2"]);
		$t_address3	= handleData($_REQUEST["t_address3"]);
		$t_city		= handleData($_REQUEST["t_city"]);
		$t_province	= handleData($_REQUEST["t_province"]);
		$t_country	= handleData($_REQUEST["t_country"]);
		$t_postalcode	= handleData($_REQUEST["t_postalcode"]);
		$t_telephone	= handleData($_REQUEST["t_telephone"]);
		$t_fax		= handleData($_REQUEST["t_fax"]);
		$t_email	= handleData($_REQUEST["t_email"]);
		$billing	= handleData($_REQUEST["billing"]);
		$b_org		= handleData($_REQUEST["b_org"]);
		$b_address1	= handleData($_REQUEST["b_address1"]);
		$b_address2	= handleData($_REQUEST["b_address2"]);
		$b_address3	= handleData($_REQUEST["b_address3"]);
		$b_city		= handleData($_REQUEST["b_city"]);
		$b_province	= handleData($_REQUEST["b_province"]);
		$b_country	= handleData($_REQUEST["b_country"]);
		$b_postalcode	= handleData($_REQUEST["b_postalcode"]);
		$b_telephone	= handleData($_REQUEST["b_telephone"]);
		$b_fax		= handleData($_REQUEST["b_fax"]);
		$b_email	= handleData($_REQUEST["b_email"]);
		
		if($password1 != "")
		{
			if(strlen($password1) > 20 ||
				checkAscii($password1))
				$this->showContact(DOMAIN_0050);
			if($password1 != $password2)
				$this->showContact(DOMAIN_0051);
		}
		if($r_org == "" ||
			strlen($r_org) > 60 ||
			checkAscii($r_org))
			$this->showContact(DOMAIN_0002);
		if($r_address1 == "" ||
			strlen($r_address1) > 60 ||
			checkAscii($r_address1))
			$this->showContact(DOMAIN_0002);
		if($r_address2 <> "" &&
			(strlen($r_address2) > 60 ||
			checkAscii($r_address2)))
			$this->showContact(DOMAIN_0004);
		if($r_address3 <> "" &&
			(strlen($r_address3) > 60 ||
			checkAscii($r_address3)))
			$this->showContact(DOMAIN_0005);
		if($r_city == "" ||
			strlen($r_city) > 60 ||
			checkAscii($r_city))
			$this->showContact(DOMAIN_0006);
		if($r_province == "" ||
			strlen($r_province) > 60 ||
			checkAscii($r_province))
			$this->showContact(DOMAIN_0007);
		if($r_country == "" ||
			strlen($r_country) > 2 ||
			checkAscii($r_country))
			$this->showContact(DOMAIN_0008);
		if($r_postalcode == "" ||
			strlen($r_postalcode) > 20 ||
			checkAscii($r_postalcode))
			$this->showContact(DOMAIN_0009);
		if($r_telephone == "" ||
			strlen($r_telephone) > 20 ||
			checkAscii($r_telephone))
			$this->showContact(DOMAIN_0010);
		if($r_fax == "" ||
			strlen($r_fax) > 20 ||
			checkAscii($r_fax))
			$this->showContact(DOMAIN_0011);
		if($r_email == "" ||
			strlen($r_email) > 80 ||
			checkMail($r_email))
			$this->showContact(DOMAIN_0012);
		if($administrator == "" ||
			strlen($administrator) > 60 ||
			checkAscii($administrator))
			$this->showContact(DOMAIN_0013);
		if($a_org == "" ||
			strlen($a_org) > 60 ||
			checkAscii($a_org))
			$this->showContact(DOMAIN_0014);
		if($a_address1 == "" ||
			strlen($a_address1) > 60 ||
			checkAscii($a_address1))
			$this->showContact(DOMAIN_0015);
		if($a_address2 <> "" &&
			(strlen($a_address2) > 60 ||
			checkAscii($a_address2)))
			$this->showContact(DOMAIN_0016);
		if($a_address3 <> "" &&
			(strlen($a_address3) > 60 ||
			checkAscii($a_address3)))
			$this->showContact(DOMAIN_0017);
		if($a_city == "" ||
			strlen($a_city) > 60 ||
			checkAscii($a_city))
			$this->showContact(DOMAIN_0018);
		if($a_province == "" ||
			strlen($a_province) > 60 ||
			checkAscii($a_province))
			$this->showContact(DOMAIN_0019);
		if($a_country == "" ||
			strlen($a_country) > 2 ||
			checkAscii($a_country))
			$this->showContact(DOMAIN_0020);
		if($a_postalcode == "" ||
			strlen($a_postalcode) > 20 ||
			checkAscii($a_postalcode))
			$this->showContact(DOMAIN_0021);
		if($a_telephone == "" ||
			strlen($a_telephone) > 20 ||
			checkAscii($a_telephone))
			$this->showContact(DOMAIN_0022);
		if($a_fax == "" ||
			strlen($a_fax) > 20 ||
			checkAscii($a_fax))
			$this->showContact(DOMAIN_0023);
		if($a_email == "" ||
			strlen($a_email) > 80 ||
			checkMail($a_email))
			$this->showContact(DOMAIN_0024);
		if($technical == "" ||
			strlen($technical) > 60 ||
			checkAscii($technical))
			$this->showContact(DOMAIN_0025);
		if($t_org == "" ||
			strlen($t_org) > 60 ||
			checkAscii($t_org))
			$this->showContact(DOMAIN_0026);
		if($t_address1 == "" ||
			strlen($t_address1) > 60 ||
			checkAscii($t_address1))
			$this->showContact(DOMAIN_0027);
		if($t_address2 <> "" &&
			(strlen($t_address2) > 60 ||
			checkAscii($t_address2)))
			$this->showContact(DOMAIN_0028);
		if($t_address3 <> "" &&
			(strlen($t_address3) > 60 ||
			checkAscii($t_address3)))
			$this->showContact(DOMAIN_0029);
		if($t_city == "" ||
			strlen($t_city) > 60 ||
			checkAscii($t_city))
			$this->showContact(DOMAIN_0030);
		if($t_province == "" ||
			strlen($t_province) > 60 ||
			checkAscii($t_province))
			$this->showContact(DOMAIN_0031);
		if($t_country == "" ||
			strlen($t_country) > 2 ||
			checkAscii($t_country))
			$this->showContact(DOMAIN_0032);
		if($t_postalcode == "" ||
			strlen($t_postalcode) > 20 ||
			checkAscii($t_postalcode))
			$this->showContact(DOMAIN_0033);
		if($t_telephone == "" ||
			strlen($t_telephone) > 20 ||
			checkAscii($t_telephone))
			$this->showContact(DOMAIN_0034);
		if($t_fax == "" ||
			strlen($t_fax) > 20 ||
			checkAscii($t_fax))
			$this->showContact(DOMAIN_0035);
		if($t_email == "" ||
			strlen($t_email) > 80 ||
			checkMail($t_email))
			$this->showContact(DOMAIN_0036);
		if($billing == "" ||
			strlen($billing) > 60 ||
			checkAscii($billing))
			$this->showContact(DOMAIN_0037);
		if($b_org == "" ||
			strlen($b_org) > 60 ||
			checkAscii($b_org))
			$this->showContact(DOMAIN_0038);
		if($b_address1 == "" ||
			strlen($b_address1) > 60 ||
			checkAscii($b_address1))
			$this->showContact(DOMAIN_0039);
		if($b_address2 <> "" &&
			(strlen($b_address2) > 60 ||
			checkAscii($b_address2)))
			$this->showContact(DOMAIN_0040);
		if($b_address3 <> "" &&
			(strlen($b_address3) > 60 ||
			checkAscii($b_address3)))
			$this->showContact(DOMAIN_0041);
		if($b_city == "" ||
			strlen($b_city) > 60 ||
			checkAscii($b_city))
			$this->showContact(DOMAIN_0042);
		if($b_province == "" ||
			strlen($b_province) > 60 ||
			checkAscii($b_province))
			$this->showContact(DOMAIN_0043);
		if($b_country == "" ||
			strlen($b_country) > 2 ||
			checkAscii($b_country))
			$this->showContact(DOMAIN_0044);
		if($b_postalcode == "" ||
			strlen($b_postalcode) > 20 ||
			checkAscii($b_postalcode))
			$this->showContact(DOMAIN_0045);
		if($b_telephone == "" ||
			strlen($b_telephone) > 20 ||
			checkAscii($b_telephone))
			$this->showContact(DOMAIN_0046);
		if($b_fax == "" ||
			strlen($b_fax) > 20 ||
			checkAscii($b_fax))
			$this->showContact(DOMAIN_0047);
		if($b_email == "" ||
			strlen($b_email) > 80 ||
			checkMail($b_email))
			$this->showContact(DOMAIN_0048);

		if(connectRegServer($fp) < 0)
		{
			$this->showContact(DOMAIN_0056);
		}
		$result = onlinenicLogin($fp);
		if($result < 0)
		{
			$this->showContact(DOMAIN_0056);
		}
		if($password1 != "")
		{
			$result = onlinenicModifyDomainPassword(	$fp,		$domain_type,		$domain,
									$password1);
			if($result != 0)
			{
				$this->showContact(DOMAIN_0060);
			}
			$sql = "update domains
					set	domain_password = '" . handleSQLData($password1) . "'
					where	domain_id = " . $domain_id . "
						and state = 0";
			$rs = $conn->Execute($sql);
			if(!$rs)
			{
				$this->showContact(DOMAIN_0060);
			}
		}
		
		$result = onlinenicModifyContact(	$fp,		$domain_type,		$domain,
							4,		"",			$r_org,
							$r_address1,	$r_address2,		$r_address3,
							$r_city,	$r_province,		$r_country,
							$r_postalcode,	$r_telephone,		$r_fax,
							$r_email);
		if($result != 0)
		{
			$this->showContact(DOMAIN_0061);
		}
		$r_org		= handleSQLData($r_org);
		$r_address1	= handleSQLData($r_address1);
		$r_address2	= handleSQLData($r_address2);
		$r_address3	= handleSQLData($r_address3);
		$r_city		= handleSQLData($r_city);
		$r_province	= handleSQLData($r_province);
		$r_country	= handleSQLData($r_country);
		$r_postalcode	= handleSQLData($r_postalcode);
		$r_telephone	= handleSQLData($r_telephone);
		$r_fax		= handleSQLData($r_fax);
		$r_email	= handleSQLData($r_email);
		$sql = "update contacts set
				org		= '" . $r_org . "',
				address1	= '" . $r_address1 . "',
				address2	= '" . $r_address2 . "',
				address3	= '" . $r_address3 . "',
				city		= '" . $r_city . "',
				province	= '" . $r_province . "',
				country		= '" . $r_country . "',
				postalcode	= '" . $r_postalcode . "',
				telephone	= '" . $r_telephone . "',
				fax		= '" . $r_fax . "',
				email		= '" . $r_email . "'
			where	contact_id = " . $registrant_id;
		$rs = $conn->Execute($sql);
		if(!$rs)
		{
			$this->showContact(DOMAIN_0061);
		}
		$result = onlinenicModifyContact(	$fp,		$domain_type,		$domain,
							1,		$administrator,		$a_org,
							$a_address1,	$a_address2,		$a_address3,
							$a_city,	$a_province,		$a_country,
							$a_postalcode,	$a_telephone,		$a_fax,
							$a_email);
		if($result != 0)
		{
			$this->showContact(DOMAIN_0061);
		}
		$administrator	= handleSQLData($administrator);
		$a_org		= handleSQLData($a_org);
		$a_address1	= handleSQLData($a_address1);
		$a_address2	= handleSQLData($a_address2);
		$a_address3	= handleSQLData($a_address3);
		$a_city		= handleSQLData($a_city);
		$a_province	= handleSQLData($a_province);
		$a_country	= handleSQLData($a_country);
		$a_postalcode	= handleSQLData($a_postalcode);
		$a_telephone	= handleSQLData($a_telephone);
		$a_fax		= handleSQLData($a_fax);
		$a_email	= handleSQLData($a_email);
		$sql = "update contacts set
				reg_name	= '" . $administrator . "',
				org		= '" . $a_org . "',
				address1	= '" . $a_address1 . "',
				address2	= '" . $a_address2 . "',
				address3	= '" . $a_address3 . "',
				city		= '" . $a_city . "',
				province	= '" . $a_province . "',
				country		= '" . $a_country . "',
				postalcode	= '" . $a_postalcode . "',
				telephone	= '" . $a_telephone . "',
				fax		= '" . $a_fax . "',
				email		= '" . $a_email . "'
			where	contact_id = " . $admin_id;
		$rs = $conn->Execute($sql);
		if(!$rs)
		{
			$this->showContact(DOMAIN_0061);
		}
		$result = onlinenicModifyContact(	$fp,		$domain_type,		$domain,
							2,		$technical,		$t_org,
							$t_address1,	$t_address2,		$t_address3,
							$t_city,	$t_province,		$t_country,
							$t_postalcode,	$t_telephone,		$t_fax,
							$t_email);
		if($result != 0)
		{
			$this->showContact(DOMAIN_0061);
		}
		$technical	= handleSQLData($technical);
		$t_org		= handleSQLData($t_org);
		$t_address1	= handleSQLData($t_address1);
		$t_address2	= handleSQLData($t_address2);
		$t_address3	= handleSQLData($t_address3);
		$t_city		= handleSQLData($t_city);
		$t_province	= handleSQLData($t_province);
		$t_country	= handleSQLData($t_country);
		$t_postalcode	= handleSQLData($t_postalcode);
		$t_telephone	= handleSQLData($t_telephone);
		$t_fax		= handleSQLData($t_fax);
		$t_email	= handleSQLData($t_email);
		$sql = "update contacts set
				reg_name	= '" . $technical . "',
				org		= '" . $t_org . "',
				address1	= '" . $t_address1 . "',
				address2	= '" . $t_address2 . "',
				address3	= '" . $t_address3 . "',
				city		= '" . $t_city . "',
				province	= '" . $t_province . "',
				country		= '" . $t_country . "',
				postalcode	= '" . $t_postalcode . "',
				telephone	= '" . $t_telephone . "',
				fax		= '" . $t_fax . "',
				email		= '" . $t_email . "'
			where	contact_id = " . $tech_id;
		$rs = $conn->Execute($sql);
		if(!$rs)
		{
			$this->showContact(DOMAIN_0061);
		}
		$result = onlinenicModifyContact(	$fp,		$domain_type,		$domain,
							3,		$billing_id,		$b_org,
							$b_address1,	$b_address2,		$b_address3,
							$b_city,	$b_province,		$b_country,
							$b_postalcode,	$b_telephone,		$b_fax,
							$b_email);
		if($result != 0)
		{
			$this->showContact(DOMAIN_0061);
		}
		$billing	= handleSQLData($billing);
		$b_org		= handleSQLData($b_org);
		$b_address1	= handleSQLData($b_address1);
		$b_address2	= handleSQLData($b_address2);
		$b_address3	= handleSQLData($b_address3);
		$b_city		= handleSQLData($b_city);
		$b_province	= handleSQLData($b_province);
		$b_country	= handleSQLData($b_country);
		$b_postalcode	= handleSQLData($b_postalcode);
		$b_telephone	= handleSQLData($b_telephone);
		$b_fax		= handleSQLData($b_fax);
		$b_email	= handleSQLData($b_email);
		$sql = "update contacts set
				reg_name	= '" . $billing . "',
				org		= '" . $b_org . "',
				address1	= '" . $b_address1 . "',
				address2	= '" . $b_address2 . "',
				address3	= '" . $b_address3 . "',
				city		= '" . $b_city . "',
				province	= '" . $b_province . "',
				country		= '" . $b_country . "',
				postalcode	= '" . $b_postalcode . "',
				telephone	= '" . $b_telephone . "',
				fax		= '" . $b_fax . "',
				email		= '" . $b_email . "'
			where	contact_id = " . $billing_id;
		$rs = $conn->Execute($sql);
		if(!$rs)
		{
			$this->showContact(DOMAIN_0061);
		}

		$this->listDomain(DOMAIN_0062);
	}
	
	function showNS($message)
	{
		global $conn, $smarty;
		
		$domain_id	= intval($_REQUEST["domain_id"]);
	
		$sql = "select
				domain_id,		domain_name,		domain_type,
				product_type,		domain_dns1,		domain_dns2
			from	domains
			where	domain_id = " . $domain_id . "
				and state = 0";
		$rs = $conn->Execute($sql);
		if(!$rs)
		{
			$this->listDomain(ALL_0001);
		}
		if($rs->RecordCount() != 1)
		{
			$this->listDomain(ALL_0001);
		}
		
		if($_REQUEST["Submit"] != "")
		{
			$dns1		= handleData($_REQUEST["dns1"]);
			$dns2		= handleData($_REQUEST["dns2"]);
		}else {
			$dns1		= $rs->fields[4];
			$dns2		= $rs->fields[5];
		}
		$rs->Close();
		
		include(ROOT_DIR . "templates/" . CURRENT_SKIN . "/admin.title.inc.php");
		include(ROOT_DIR . "templates/" . CURRENT_SKIN . "/domain.showns.php");
		include(ROOT_DIR . "templates/" . CURRENT_SKIN . "/admin.tail.inc.php");
		$smarty->display (CURRENT_THEME.'/page.structure.tpl');
		die();
	}
	
	function modifyNS()
	{
		global $conn;
		
		$domain_id	= intval($_REQUEST["domain_id"]);
	
		$sql = "select
				domain_id,		domain_name,		domain_type,
				product_type,		domain_dns1,		domain_dns2
			from	domains
			where	domain_id = " . $domain_id . "
				and state = 0";
		$rs = $conn->Execute($sql);
		if(!$rs)
		{
			$this->listDomain(ALL_0001);
		}
		if($rs->RecordCount() != 1)
		{
			$this->listDomain(ALL_0001);
		}
		$domain_type	= $rs->fields[2];
		$domain		= $rs->fields[1];
		
		$dns1		= handleData($_REQUEST["dns1"]);
		$dns2		= handleData($_REQUEST["dns2"]);
		
		if($dns1 == "" ||
			strlen($dns1) > 100 ||
			checkDns($dns1))
			$this->showNS(DOMAIN_0052);
		if($dns2 == "" ||
			strlen($dns2) > 100 ||
			checkDns($dns2))
			$this->showNS(DOMAIN_0053);
		if($dns1 == $dns2)
			$this->showNS(DOMAIN_0054);
		
		if(connectRegServer($fp) < 0)
		{
			$this->showNS(DOMAIN_0056);
		}
		$result = onlinenicLogin($fp);
		if($result < 0)
		{
			$this->showNS(DOMAIN_0056);
		}
		$result = onlinenicModifyDomainNS(	$fp,		$domain_type,		$domain,
							$dns1,		$dns2);
		if($result != 0)
		{
			$this->showNS(DOMAIN_0063);
		}
		$dns1		= handleSQLData($dns1);
		$dns2		= handleSQLData($dns2);
		$sql = "update domains
			set	domain_dns1	= '" . $dns1 . "',
				domain_dns2	= '" . $dns2 . "'
			where	domain_id = " . $domain_id;
		$rs = $conn->Execute($sql);
		if(!$rs)
		{
			$this->showNS(DOMAIN_0063);
		}
		
		$this->listDomain(DOMAIN_0064);
	}
	
	function deleteDomain()
	{
		global $conn;
		
		$domain_id	= intval($_REQUEST["domain_id"]);
		
		if($domain_id == 0)
		{
			$this->listDomain(DOMAIN_0065);
		}

		$sql = "select
				a.domain_id,		a.domain_name,	a.domain_type,
				a.product_type,		a.amount,		a.member_id,
				b.member_level
			from	domains	a,
				members b
			where	a.domain_id = " . $domain_id . "
				and a.state = 0
				and a.member_id = b.member_id";
                
		$rs = $conn->Execute($sql);
		if(!$rs)
		{
			$this->listDomain(ALL_0001);
		}
		if($rs->RecordCount() != 1)
		{
			$this->listDomain(ALL_0001);
		}
		$domain_type	= $rs->fields[2];
		$domain		= $rs->fields[1];
		$gtld		= $rs->fields[3];
		$domain_price	= $rs->fields[4];
		$member_id	= $rs->fields[5];
		$member_level	= $rs->fields[6];
		$rs->Close();
		
        ereg ("(.*)(\.[a-z]{2,4})$", $domain, $res1);
        $query = "select product_id from products where product_name='".$res1[2]."'";
        $res2 = $conn->Execute ($query);
	    $gtld = $res2->fields[0];
    
        
		$product_price = getProductPrice($gtld, $member_level, 2);
		$mode_id = getModeID($gtld, 2);
       
        $amt = checkBalance ($member_id, $product_price[1]);
        if ($amt == -1)
            $this->listDomain(MEMBER_0037. ' $ '. $product_price[1] . ' required.');
		
		if(connectRegServer($fp) < 0)
		{
			$this->listDomain(DOMAIN_0056);
		}
		$result = onlinenicLogin($fp);
		if($result < 0)
		{
			$this->listDomain(DOMAIN_0056);
		}
		$result = onlinenicDeleteDomain(	$fp,		$domain_type,		$domain);
    //echo "<br> Delresult ".$result;
		if($result != 0)
		{
			if($result == 2303)
			{
				$sql = "update domains set state = 1 where domain_id = " . $domain_id;
				$rs = $conn->Execute($sql);
				
                		if(!$rs)
				{
					$this->listDomain(DOMAIN_0072);
				}
			}
			
			//$this->listDomain(DOMAIN_0072);
		}
		
		$result = insertMoneyMode($member_id, 2, $mode_id, $product_price[1], $domain);
		if($result < 0)
		{
			$this->listDomain(DOMAIN_0073);
		}else {
			if(updateFunds($member_id, 2, $product_price[1]) < 0)
			{
				$this->listDomain(DOMAIN_0073);
			}
		}
      //////  refund fee
		$mode_id = getModeID($gtld, 4);
		$result = insertMoneyMode($member_id, 1, $mode_id, $domain_price, $domain);
		if($result < 0)
		{
			$this->listDomain(DOMAIN_0073);
		}else {
			if(updateFunds($member_id, 1, $domain_price) < 0)
			{
				$this->listDomain(DOMAIN_0073);
			}
		}
		
		$sql = "update domains set state = 1 where domain_id = " . $domain_id;
		$rs = $conn->Execute($sql);
		if(!$rs)
		{
			$this->listDomain(DOMAIN_0072);
		}
		
		$this->listDomain(DOMAIN_0073);
	}
	
	function renewDomain($id=0, $yr=0)
	{
		global $conn;
		
        if (isset ($_REQUEST["domain_id"]))
            $domain_id	= intval($_REQUEST["domain_id"]);
        else
            $domain_id	= $id;
        
		if (isset ($_REQUEST["year"]))
		    $year	= intval($_REQUEST["year"]);
        else
            $year	= $yr;
            
		if($domain_id == 0)
		{
			$this->listDomain(DOMAIN_0076);
		}

		if($year < 1 || $year > 9)
		{
			$this->listDomain(DOMAIN_0074);
		}

		$sql = "select
				a.domain_id,		a.domain_name,		a.domain_type,
				a.product_type,		a.domain_year,		b.member_id,
				b.member_level
			from	domains	a,
				members	b
			where	a.domain_id = " . $domain_id . "
				and state = 0
				and a.member_id = b.member_id";
       //echo $sql;
		$rs = $conn->Execute($sql);
		if(!$rs)
		{
			$this->listDomain(ALL_0001);
		}
		if($rs->RecordCount() != 1)
		{
			$this->listDomain(ALL_0001);
		}
		if(($rs->fields[4] + $year) > 10)
		{
			$this->listDomain(DOMAIN_0074);
		}
		
		$domain_type	= $rs->fields[2];
		$domain		= $rs->fields[1];
		$gtld		= $rs->fields[3];
		$member_id	= $rs->fields[5];
		$member_level	= $rs->fields[6];
		
        ereg ("(.*)(\.[a-z]{2,4})$", $domain, $res1);
        $query = "select product_id from products where product_name='".$res1[2]."'";
        $res2 = $conn->Execute ($query);
	    $gtld = $res2->fields[0];
        
		$product_price = getProductPrice($gtld, $member_level, 3);
		$mode_id = getModeID($gtld, 3);
        //echo "mode_id ".$mode_id." gtld ".$gtld;
		$balance = getBalance($member_id);
		if($product_price[$year] > $balance)
		{
			$this->listDomain(DOMAIN_0075);
		}
		
		if(connectRegServer($fp) < 0)
		{
			$this->listDomain(DOMAIN_0056);
		}
		$result = onlinenicLogin($fp);
		if($result < 0)
		{
			$this->listDomain(DOMAIN_0056);
		}
        //echo " renew ";
		$result = onlinenicRenewDomain(	$fp,		$domain_type,		$domain,
						$year);
		if($result != 0)
		{
			if($result == 2303)
			{
				$sql = "update domains set state = 1 where domain_id = " . $domain_id;
				$rs = $conn->Execute($sql);
                //echo $sql;
				if(!$rs)
				{
					$this->listDomain(DOMAIN_0077);
				}
			}
			
			$this->listDomain(DOMAIN_0077);
		}
		
		$result = insertMoneyMode($member_id, 2, $mode_id, $product_price[$year], $domain);
		if($result < 0)
		{
			$this->listDomain(DOMAIN_0078);
		}else {
			if(updateFunds($member_id, 2, $product_price[$year]) < 0)
			{
				$this->listDomain(DOMAIN_0078);
			}
		}

		$sql = "update domains set domain_year = domain_year + " . $year . " where domain_id = " . $domain_id;
        //echo $sql;
		$rs = $conn->Execute($sql);
		if(!$rs)
		{
			$this->listDomain(DOMAIN_0078);
		}
		
		$this->listDomain(DOMAIN_0078);
	}
}
?>
