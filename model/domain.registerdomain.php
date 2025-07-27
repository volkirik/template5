<?php
class DomainRegistration
{
	function showCheckForm($message)
	{
		global $conn, $smarty;
		
		$sql = "select * from products where flag = 0 and product_type = 1";
		$rs = $conn->Execute($sql);
		if(!$rs)
		{
			showErrorMsg($conn->ErrorMsg());
		}
		include(ROOT_DIR . "templates/" . CURRENT_SKIN . "/title.inc.php");
		include(ROOT_DIR . "templates/" . CURRENT_SKIN . "/domain.checkdomain.form.php");
		include(ROOT_DIR . "templates/" . CURRENT_SKIN . "/tail.inc.php");
		$smarty->display(CURRENT_THEME.'/page.structure.tpl');
		die();
	}
	
	function checkDomain()
	{
		global $conn, $smarty;
		
		$domain	= strtolower(handleData($_REQUEST["domain"]));
		$gtld	= intval(handleData($_REQUEST["gtld"]));

		if($gtld == 0)
		{
			$this->showCheckForm(DOMAIN_0068);
		}
		if($domain == "")
		{
			$this->showCheckForm(DOMAIN_0069);
		}
		if(strlen($domain) > 63)
		{
			$this->showCheckForm(DOMAIN_0070);
		}
		if(onlinenicValidateDomain($domain))
		{
			$this->showCheckForm(DOMAIN_0071);
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
			showErrorMsg($conn->ErrorMsg());
		}
		
		include(ROOT_DIR . "templates/" . CURRENT_SKIN . "/title.inc.php");
		include(ROOT_DIR . "templates/" . CURRENT_SKIN . "/domain.checkresult.php");
		include(ROOT_DIR . "templates/" . CURRENT_SKIN . "/tail.inc.php");
		$smarty->display(CURRENT_THEME.'/page.structure.tpl');
		die();
	}
	
	function showRegisterForm($message)
	{
		global $conn;
		global $member_info;
		global $smarty;
		
		$domain	= strtolower(handleData($_REQUEST["domain"]));
		$gtld	= intval(handleData($_REQUEST["gtld"]));
		
		$product_info = getProductInfo($gtld);
		$default_dns = getDefaultDns($gtld);
		$product_price = getProductPrice($gtld, $member_info[4], 1);
		
		if($message != "")
		{
			$year		= intval(handleData($_REQUEST["year"]));
			$dns1		= handleData($_REQUEST["dns1"]);
			$dns2		= handleData($_REQUEST["dns2"]);
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
			$registrant	= $member_info[8];
			$r_org		= $member_info[9];
			$r_address1	= $member_info[10];
			$r_address2	= $member_info[11];
			$r_address3	= $member_info[12];
			$r_city		= $member_info[13];
			$r_province	= $member_info[14];
			$r_country	= $member_info[15];
			$r_postalcode	= $member_info[16];
			$r_telephone	= $member_info[17];
			$r_fax		= $member_info[19];
			$r_email	= $member_info[21];
			$administrator	= $member_info[8];
			$a_org		= $member_info[9];
			$a_address1	= $member_info[10];
			$a_address2	= $member_info[11];
			$a_address3	= $member_info[12];
			$a_city		= $member_info[13];
			$a_province	= $member_info[14];
			$a_country	= $member_info[15];
			$a_postalcode	= $member_info[16];
			$a_telephone	= $member_info[17];
			$a_fax		= $member_info[19];
			$a_email	= $member_info[21];
			$technical	= $member_info[8];
			$t_org		= $member_info[9];
			$t_address1	= $member_info[10];
			$t_address2	= $member_info[11];
			$t_address3	= $member_info[12];
			$t_city		= $member_info[13];
			$t_province	= $member_info[14];
			$t_country	= $member_info[15];
			$t_postalcode	= $member_info[16];
			$t_telephone	= $member_info[17];
			$t_fax		= $member_info[19];
			$t_email	= $member_info[21];
			$billing	= $member_info[8];
			$b_org		= $member_info[9];
			$b_address1	= $member_info[10];
			$b_address2	= $member_info[11];
			$b_address3	= $member_info[12];
			$b_city		= $member_info[13];
			$b_province	= $member_info[14];
			$b_country	= $member_info[15];
			$b_postalcode	= $member_info[16];
			$b_telephone	= $member_info[17];
			$b_fax		= $member_info[19];
			$b_email	= $member_info[21];
			$dns1		= $default_dns[0];
			$dns2		= $default_dns[1];
		}
		$countries = getCountryInfo();
		
		include(ROOT_DIR . "templates/" . CURRENT_SKIN . "/title.inc.php");
		include(ROOT_DIR . "templates/" . CURRENT_SKIN . "/domain.regdomain.form.php");
		include(ROOT_DIR . "templates/" . CURRENT_SKIN . "/tail.inc.php");
		$smarty->display(CURRENT_THEME.'/page.structure.tpl');
		die();
	}
	
	function registerDomain()
	{
		global $conn;
		global $member_info;
		global $smarty;
		
		$domain		= handleData($_REQUEST["domain"]);
		$gtld		= intval(handleData($_REQUEST["gtld"]));
		$year		= intval(handleData($_REQUEST["year"]));
		$dns1		= handleData($_REQUEST["dns1"]);
		$dns2		= handleData($_REQUEST["dns2"]);
		$password1	= handleData($_REQUEST["password1"]);
		$password2	= handleData($_REQUEST["password2"]);
		$product_info	= getProductInfo($gtld);
		
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
		
		$category	= handleData($_REQUEST["category"]);
		$validator	= handleData($_REQUEST["validator"]);
		$apppurpose	= handleData($_REQUEST["apppurpose"]);
		
		$unspec = "AppPurpose=" . $apppurpose . " NexusCategory=" . $category;
		if($category == "C31" || $category == "C32")
		{
			$unspec .= "/" . $validator;
		}
		
		if($registrant == "" ||
			strlen($registrant) > 60 ||
			checkAscii($registrant))
			$this->showRegisterForm(DOMAIN_0001);
		if($r_org == "" ||
			strlen($r_org) > 60 ||
			checkAscii($r_org))
			$this->showRegisterForm(DOMAIN_0002);
		if($r_address1 == "" ||
			strlen($r_address1) > 60 ||
			checkAscii($r_address1))
			$this->showRegisterForm(DOMAIN_0003);
		if($r_address2 <> "" &&
			(strlen($r_address2) > 60 ||
			checkAscii($r_address2)))
			$this->showRegisterForm(DOMAIN_0004);
		if($r_address3 <> "" &&
			(strlen($r_address3) > 60 ||
			checkAscii($r_address3)))
			$this->showRegisterForm(DOMAIN_0005);
		if($r_city == "" ||
			strlen($r_city) > 60 ||
			checkAscii($r_city))
			$this->showRegisterForm(DOMAIN_0006);
		if($r_province == "" ||
			strlen($r_province) > 60 ||
			checkAscii($r_province))
			$this->showRegisterForm(DOMAIN_0007);
		if($r_country == "" ||
			strlen($r_country) > 2 ||
			checkAscii($r_country))
			$this->showRegisterForm(DOMAIN_0008);
		if($r_postalcode == "" ||
			strlen($r_postalcode) > 20 ||
			checkAscii($r_postalcode))
			$this->showRegisterForm(DOMAIN_0009);
		if($r_telephone == "" ||
			strlen($r_telephone) > 20 ||
			checkAscii($r_telephone))
			$this->showRegisterForm(DOMAIN_0010);
		if($r_fax == "" ||
			strlen($r_fax) > 20 ||
			checkAscii($r_fax))
			$this->showRegisterForm(DOMAIN_0011);
		if($r_email == "" ||
			strlen($r_email) > 80 ||
			checkMail($r_email))
			$this->showRegisterForm(DOMAIN_0012);
		if($administrator == "" ||
			strlen($administrator) > 60 ||
			checkAscii($administrator))
			$this->showRegisterForm(DOMAIN_0013);
		if($a_org == "" ||
			strlen($a_org) > 60 ||
			checkAscii($a_org))
			$this->showRegisterForm(DOMAIN_0014);
		if($a_address1 == "" ||
			strlen($a_address1) > 60 ||
			checkAscii($a_address1))
			$this->showRegisterForm(DOMAIN_0015);
		if($a_address2 <> "" &&
			(strlen($a_address2) > 60 ||
			checkAscii($a_address2)))
			$this->showRegisterForm(DOMAIN_0016);
		if($a_address3 <> "" &&
			(strlen($a_address3) > 60 ||
			checkAscii($a_address3)))
			$this->showRegisterForm(DOMAIN_0017);
		if($a_city == "" ||
			strlen($a_city) > 60 ||
			checkAscii($a_city))
			$this->showRegisterForm(DOMAIN_0018);
		if($a_province == "" ||
			strlen($a_province) > 60 ||
			checkAscii($a_province))
			$this->showRegisterForm(DOMAIN_0019);
		if($a_country == "" ||
			strlen($a_country) > 2 ||
			checkAscii($a_country))
			$this->showRegisterForm(DOMAIN_0020);
		if($a_postalcode == "" ||
			strlen($a_postalcode) > 20 ||
			checkAscii($a_postalcode))
			$this->showRegisterForm(DOMAIN_0021);
		if($a_telephone == "" ||
			strlen($a_telephone) > 20 ||
			checkAscii($a_telephone))
			$this->showRegisterForm(DOMAIN_0022);
		if($a_fax == "" ||
			strlen($a_fax) > 20 ||
			checkAscii($a_fax))
			$this->showRegisterForm(DOMAIN_0023);
		if($a_email == "" ||
			strlen($a_email) > 80 ||
			checkMail($a_email))
			$this->showRegisterForm(DOMAIN_0024);
		if($technical == "" ||
			strlen($technical) > 60 ||
			checkAscii($technical))
			$this->showRegisterForm(DOMAIN_0025);
		if($t_org == "" ||
			strlen($t_org) > 60 ||
			checkAscii($t_org))
			$this->showRegisterForm(DOMAIN_0026);
		if($t_address1 == "" ||
			strlen($t_address1) > 60 ||
			checkAscii($t_address1))
			$this->showRegisterForm(DOMAIN_0027);
		if($t_address2 <> "" &&
			(strlen($t_address2) > 60 ||
			checkAscii($t_address2)))
			$this->showRegisterForm(DOMAIN_0028);
		if($t_address3 <> "" &&
			(strlen($t_address3) > 60 ||
			checkAscii($t_address3)))
			$this->showRegisterForm(DOMAIN_0029);
		if($t_city == "" ||
			strlen($t_city) > 60 ||
			checkAscii($t_city))
			$this->showRegisterForm(DOMAIN_0030);
		if($t_province == "" ||
			strlen($t_province) > 60 ||
			checkAscii($t_province))
			$this->showRegisterForm(DOMAIN_0031);
		if($t_country == "" ||
			strlen($t_country) > 2 ||
			checkAscii($t_country))
			$this->showRegisterForm(DOMAIN_0032);
		if($t_postalcode == "" ||
			strlen($t_postalcode) > 20 ||
			checkAscii($t_postalcode))
			$this->showRegisterForm(DOMAIN_0033);
		if($t_telephone == "" ||
			strlen($t_telephone) > 20 ||
			checkAscii($t_telephone))
			$this->showRegisterForm(DOMAIN_0034);
		if($t_fax == "" ||
			strlen($t_fax) > 20 ||
			checkAscii($t_fax))
			$this->showRegisterForm(DOMAIN_0035);
		if($t_email == "" ||
			strlen($t_email) > 80 ||
			checkMail($t_email))
			$this->showRegisterForm(DOMAIN_0036);
		if($billing == "" ||
			strlen($billing) > 60 ||
			checkAscii($billing))
			$this->showRegisterForm(DOMAIN_0037);
		if($b_org == "" ||
			strlen($b_org) > 60 ||
			checkAscii($b_org))
			$this->showRegisterForm(DOMAIN_0038);
		if($b_address1 == "" ||
			strlen($b_address1) > 60 ||
			checkAscii($b_address1))
			$this->showRegisterForm(DOMAIN_0039);
		if($b_address2 <> "" &&
			(strlen($b_address2) > 60 ||
			checkAscii($b_address2)))
			$this->showRegisterForm(DOMAIN_0040);
		if($b_address3 <> "" &&
			(strlen($b_address3) > 60 ||
			checkAscii($b_address3)))
			$this->showRegisterForm(DOMAIN_0041);
		if($b_city == "" ||
			strlen($b_city) > 60 ||
			checkAscii($b_city))
			$this->showRegisterForm(DOMAIN_0042);
		if($b_province == "" ||
			strlen($b_province) > 60 ||
			checkAscii($b_province))
			$this->showRegisterForm(DOMAIN_0043);
		if($b_country == "" ||
			strlen($b_country) > 2 ||
			checkAscii($b_country))
			$this->showRegisterForm(DOMAIN_0044);
		if($b_postalcode == "" ||
			strlen($b_postalcode) > 20 ||
			checkAscii($b_postalcode))
			$this->showRegisterForm(DOMAIN_0045);
		if($b_telephone == "" ||
			strlen($b_telephone) > 20 ||
			checkAscii($b_telephone))
			$this->showRegisterForm(DOMAIN_0046);
		if($b_fax == "" ||
			strlen($b_fax) > 20 ||
			checkAscii($b_fax))
			$this->showRegisterForm(DOMAIN_0047);
		if($b_email == "" ||
			strlen($b_email) > 80 ||
			checkMail($b_email))
			$this->showRegisterForm(DOMAIN_0048);
		
		if($year < 1 || $year > 10)
			$this->showRegisterForm(DOMAIN_0049);
		if($password1 == "" ||
			strlen($password1) > 20 ||
			checkAscii($password1))
			$this->showRegisterForm(DOMAIN_0050);
		if($password1 != $password2)
			$this->showRegisterForm(DOMAIN_0051);
		if($dns1 == "" ||
			strlen($dns1) > 100 ||
			checkDns($dns1))
			$this->showRegisterForm(DOMAIN_0052);
		if($dns2 == "" ||
			strlen($dns2) > 100 ||
			checkDns($dns2))
			$this->showRegisterForm(DOMAIN_0053);
		if($dns1 == $dns2)
			$this->showRegisterForm(DOMAIN_0054);
			
		$domain_type = $product_info[2];
		$balance = getBalance($member_info[0]);
		$product_price = getProductPrice($gtld, $member_info[4], 1);
		if($product_price[$year] > $balance)
		{
			$this->showRegisterForm(DOMAIN_0055);
		}

		if(connectRegServer($fp) < 0)
		{
			$this->showCheckForm(DOMAIN_0056);
		}
		$result = onlinenicLogin($fp);
		if($result < 0)
		{
			$this->showCheckForm(DOMAIN_0056);
		}
		$result = onlinenicRegisterContact(	$fp,		$domain_type,		$registrant,
							$r_org,		$r_address1,		$r_address2,
							$r_address3,	$r_city,		$r_province,
							$r_country,	$r_postalcode,		$r_telephone,
							$r_fax,		$r_email,		$password1,
							&$registrant_id,$unspec);
		if($result != 0)
		{
			$this->showRegisterForm(DOMAIN_0058);
		}

		$registrant	= handleSQLData($registrant);
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
		$sql = "insert into contacts(
				password,		reg_name,		org,
				address1,		address2,		address3,
				city,			province,		country,
				postalcode,		telephone,		fax,
				email
			)values('" .
				$password1 . "', '" .	$registrant . "', '" .	$r_org . "', '" .
				$r_address1 . "', '" .	$r_address2 . "', '" .	$r_address3 . "', '" .
				$r_city . "', '" .	$r_province . "', '" .	$r_country . "', '" .
				$r_postalcode . "', '" .$r_telephone . "', '" .	$r_fax . "', '" .
				$r_email .
			"')";
		$rs = $conn->Execute($sql);
		if(!$rs)
		{
			$this->showRegisterForm(ALL_0005);
		}
		$registrant = $conn->Insert_ID();
		
		$result = onlinenicRegisterContact(	$fp,		$domain_type,		$administrator,
							$a_org,		$a_address1,		$a_address2,
							$a_address3,	$a_city,		$a_province,
							$a_country,	$a_postalcode,		$a_telephone,
							$a_fax,		$a_email,		$password1,
							&$admin_id,	"");
		if($result != 0)
		{
			$this->showRegisterForm(DOMAIN_0058);
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
		$sql = "insert into contacts(
				password,		reg_name,		org,
				address1,		address2,		address3,
				city,			province,		country,
				postalcode,		telephone,		fax,
				email
			)values('" .
				$password1 . "', '" .	$administrator . "', '" .$a_org . "', '" .
				$a_address1 . "', '" .	$a_address2 . "', '" .	$a_address3 . "', '" .
				$a_city . "', '" .	$a_province . "', '" .	$a_country . "', '" .
				$a_postalcode . "', '" .$a_telephone . "', '" .	$a_fax . "', '" .
				$a_email .
			"')";
		$rs = $conn->Execute($sql);
		if(!$rs)
		{
			$this->showRegisterForm(ALL_0005);
		}
		$admin = $conn->Insert_ID();
		
		$result = onlinenicRegisterContact(	$fp,		$domain_type,		$technical,
							$t_org,		$t_address1,		$t_address2,
							$t_address3,	$t_city,		$t_province,
							$t_country,	$t_postalcode,		$t_telephone,
							$t_fax,		$t_email,		$password1,
							&$tech_id,	"");
		if($result != 0)
		{
			$this->showRegisterForm(DOMAIN_0058);
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
		$sql = "insert into contacts(
				password,		reg_name,		org,
				address1,		address2,		address3,
				city,			province,		country,
				postalcode,		telephone,		fax,
				email
			)values('" .
				$password1 . "', '" .	$technical . "', '" .	$t_org . "', '" .
				$t_address1 . "', '" .	$t_address2 . "', '" .	$t_address3 . "', '" .
				$t_city . "', '" .	$t_province . "', '" .	$t_country . "', '" .
				$t_postalcode . "', '" .$t_telephone . "', '" .	$t_fax . "', '" .
				$t_email .
			"')";
		$rs = $conn->Execute($sql);
		if(!$rs)
		{
			$this->showRegisterForm(ALL_0005);
		}
		$tech = $conn->Insert_ID();
		
		$result = onlinenicRegisterContact(	$fp,		$domain_type,		$billing,
							$b_org,		$b_address1,		$b_address2,
							$b_address3,	$b_city,		$b_province,
							$b_country,	$b_postalcode,		$b_telephone,
							$b_fax,		$b_email,		$password1,
							&$billing_id,	"");
		if($result != 0)
		{
			$this->showRegisterForm(DOMAIN_0058);
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
		$sql = "insert into contacts(
				password,		reg_name,		org,
				address1,		address2,		address3,
				city,			province,		country,
				postalcode,		telephone,		fax,
				email
			)values('" .
				$password1 . "', '" .	$billing . "', '" .	$b_org . "', '" .
				$b_address1 . "', '" .	$b_address2 . "', '" .	$b_address3 . "', '" .
				$b_city . "', '" .	$b_province . "', '" .	$b_country . "', '" .
				$b_postalcode . "', '" .$b_telephone . "', '" .	$b_fax . "', '" .
				$b_email .
			"')";
		$rs = $conn->Execute($sql);
		if(!$rs)
		{
			$this->showRegisterForm(ALL_0005);
		}
		$billing = $conn->Insert_ID();
		
		$domain_name = $domain . $product_info[3];
		$result = onlinenicRegisterDomain(	$fp,			$domain_type,		$domain_name,
							$year,			$dns1,			$dns2,
							$registrant_id,		$admin_id,		$tech_id,
							$billing_id,		$password1);
		if($result != 0)
		{
			$this->showRegisterForm(DOMAIN_0059);
		}
		$domain_name	= handleSQLData($domain_name);
		$password1	= handleSQLData($password1);
		$dns1		= handleSQLData($dns1);
		$dns2		= handleSQLData($dns2);
		$sql = "insert into domains(
				member_id,		domain_name,		domain_type,
				product_type,		domain_password,	add_date,
				domain_year,		domain_dns1,		domain_dns2,
				registrant,		admin,			tech,
				billing,		state,			amount
			)values(" .
				$member_info[0] . ", '" .$domain_name . "', " .	$product_info[2] . ", " .
				$gtld . ", '" .		$password1 . "', '" .	getDatetime() . "', " .
				$year . ", '" .		$dns1 . "', '" .	$dns2 . "', " .
				$registrant . ", " .	$admin . ", " .		$tech . ", " .
				$billing . ", " .	"0, " .			$product_price[$year] .
			")";
		$rs = $conn->Execute($sql);
		if(!$rs)
		{
			$this->showRegisterForm(ALL_0005);
		}
		
		$mode_id = getModeID($gtld, 1);
		$result = insertMoneyMode($member_info[0], 2, $mode_id, $product_price[$year], $domain_name);
		if($result < 0)
		{
			// TODO
		}else {
			if(updateFunds($member_info[0], 2, $product_price[$year]) < 0)
			{
				// TODO
			}
		}
		include(ROOT_DIR . "templates/" . CURRENT_SKIN . "/title.inc.php");
		include(ROOT_DIR . "templates/" . CURRENT_SKIN . "/domain.regresult.php");
		include(ROOT_DIR . "templates/" . CURRENT_SKIN . "/tail.inc.php");
		$smarty->display(CURRENT_THEME.'/page.structure.tpl');
		die();
	}
}
?>
