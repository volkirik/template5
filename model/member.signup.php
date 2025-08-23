<?php
class MemberSignup
{
	function showForm($message="")
	{   global $smarty;
		if($message || isset($_REQUEST["Submit"]))
		{
			$member_name	= isset($_REQUEST["member_name"]) ? handleData($_REQUEST["member_name"]) : '';
			$member_password1	= isset($_REQUEST["member_password1"]) ? handleData($_REQUEST["member_password1"]) : '';
			$member_password2	= isset($_REQUEST["member_password2"]) ? handleData($_REQUEST["member_password2"]) : '';
			$r_name		= isset($_REQUEST["r_name"]) ? handleData($_REQUEST["r_name"]) : '';
			$r_org		= isset($_REQUEST["r_org"]) ? handleData($_REQUEST["r_org"]) : '';
			$r_address1	= isset($_REQUEST["r_address1"]) ? handleData($_REQUEST["r_address1"]) : '';
			$r_address2	= isset($_REQUEST["r_address2"]) ? handleData($_REQUEST["r_address2"]) : '';
			$r_address3	= isset($_REQUEST["r_address3"]) ? handleData($_REQUEST["r_address3"]) : '';
			$r_city		= isset($_REQUEST["r_city"]) ? handleData($_REQUEST["r_city"]) : '';
			$r_province	= isset($_REQUEST["r_province"]) ? handleData($_REQUEST["r_province"]) : '';
			$r_country	= isset($_REQUEST["r_country"]) ? handleData($_REQUEST["r_country"]) : '';
			$r_postalcode	= isset($_REQUEST["r_postalcode"]) ? handleData($_REQUEST["r_postalcode"]) : '';
			$r_telephone	= isset($_REQUEST["r_telephone"]) ? handleData($_REQUEST["r_telephone"]) : '';
			$r_fax		= isset($_REQUEST["r_fax"]) ? handleData($_REQUEST["r_fax"]) : '';
			$r_email	= isset($_REQUEST["r_email"]) ? handleData($_REQUEST["r_email"]) : '';
		}
		$countries = getCountryInfo();
		//echo "showForm, session newsignup set:  ". $_SESSION['newsignup'];
		include(ROOT_DIR . "templates/" . CURRENT_SKIN . "/title.inc.php");
		include(ROOT_DIR . "templates/" . CURRENT_SKIN . "/member.signup.form.php");
		include(ROOT_DIR . "templates/" . CURRENT_SKIN . "/tail.inc.php");
		$smarty->assign ('RELA_DIR', RELA_DIR);
		$smarty->assign ('CAPTCHA_ENABLE', CAPTCHA_ENABLE);
	    $smarty->display(CURRENT_THEME.'/page.structure.tpl');
		
		die();
	}

	function addMember()
	{
		global $conn, $domain_obj, $member_name, $member_password1;
		
		$member_name		= handleData($_REQUEST["member_name"]);
		$member_password1	= handleData($_REQUEST["member_password1"]);
		$member_password2	= handleData($_REQUEST["member_password2"]);
		$r_name			= handleData($_REQUEST["r_name"]);
		$r_org			= handleData($_REQUEST["r_org"]);
		$r_address1		= handleData($_REQUEST["r_address1"]);
		$r_address2		= handleData($_REQUEST["r_address2"]);
		$r_address3		= handleData($_REQUEST["r_address3"]);
		$r_city			= handleData($_REQUEST["r_city"]);
		$r_province		= handleData($_REQUEST["r_province"]);
		$r_country		= handleData($_REQUEST["r_country"]);
		$r_postalcode		= handleData($_REQUEST["r_postalcode"]);
		$r_telephone		= handleData($_REQUEST["r_telephone"]);
		$r_fax			= handleData($_REQUEST["r_fax"]);
		$r_email		= handleData($_REQUEST["r_email"]);
		$keystring 	= isset($_REQUEST["keystring"]) ? handleData($_REQUEST["keystring"]) : '';
		
		if($member_name == ""
			|| strlen($member_name) > 20
			|| checkAlphaNum($member_name)
		)
			$this->showForm(MEMBER_0001);
		if($member_password1 == ""
			|| strlen($member_password1) > 20
			|| checkAscii($member_password1)
		)
			$this->showForm(MEMBER_0027);
		if($member_password1 <> $member_password2)
			$this->showForm(MEMBER_0002);
		if($r_name == ""
			|| strlen($r_name) > 60
			|| checkAscii($r_name)
		)
			$this->showForm(MEMBER_0003);
		if($r_org == ""
			|| strlen($r_org) > 60
			|| checkAscii($r_org)
		)
			$this->showForm(MEMBER_0004);
		if($r_address1 == ""
			|| strlen($r_address1) > 60
			|| checkAscii($r_address1)
		)
			$this->showForm(MEMBER_0005);
		if(strlen($r_address2) > 60
			|| (strlen($s_address2) > 0 && checkAscii($r_address2))
		)
			$this->showForm(MEMBER_0006);
		if(strlen($r_address3) > 60
			|| (strlen($s_address3) > 0 && checkAscii($r_address3))
		)
			$this->showForm(MEMBER_0007);
		if($r_city == ""
			|| strlen($r_city) > 60
			|| checkAscii($r_city)
		)
			$this->showForm(MEMBER_0008);
		if($r_city == ""
			|| strlen($r_province) > 60
			|| checkAscii($r_province)
		)
			$this->showForm(MEMBER_0009);
		if($r_country == ""
			|| strlen($r_country) > 2
			|| checkAscii($r_country)
		)
			$this->showForm(MEMBER_0010);
		if($r_postalcode == ""
			|| strlen($r_postalcode) > 10
			|| checkAscii($r_postalcode)
		)
			$this->showForm(MEMBER_0011);
		if($r_telephone == ""
			|| strlen($r_telephone) > 20
			|| checkAscii($r_telephone)
		)
			$this->showForm(MEMBER_0012);
		if($r_fax == ""
			|| strlen($r_fax) > 20
			|| checkAscii($r_fax)
		)
			$this->showForm(MEMBER_0013);
		if($r_email == ""
			|| strlen($r_email) > 80
			|| checkMail($r_email)
		)
			$this->showForm(MEMBER_0014);
		if(CAPTCHA_ENABLE===1 && (!isset($_SESSION['OSOLmulticaptcha_keystring']) || $_SESSION['OSOLmulticaptcha_keystring'] !== $keystring)){
			$this->showForm(ALL_0006);
		}
		if(CAPTCHA_ENABLE===1 && isset($_SESSION['OSOLmulticaptcha_keystring'])){
			unset($_SESSION['OSOLmulticaptcha_keystring']);
		}

		$sql = "select * from members where member_name='" . handleSQLData($member_name) . "'";
		$rs = $conn->Execute($sql);
		if(!$rs)
		{
			showErrorMsg($conn->ErrorMsg());
		}
		if($rs->RecordCount() > 0)
		{
			$this->showForm(MEMBER_0016);
		}
		$rs->Close();
		//echo $member_password1."<br>";
		$member_name		= handleSQLData($member_name);
		//echo $member_password1;
        $member_password_md5	= handleSQLData(md5($member_password1));
		$r_name			= handleSQLData($r_name);
		$r_org			= handleSQLData($r_org);
		$r_address1		= handleSQLData($r_address1);
		$r_address2		= handleSQLData($r_address2);
		$r_address3		= handleSQLData($r_address3);
		$r_city			= handleSQLData($r_city);
		$r_province		= handleSQLData($r_province);
		$r_country		= handleSQLData($r_country);
		$r_postalcode		= handleSQLData($r_postalcode);
		$r_telephone		= handleSQLData($r_telephone);
		$r_fax			= handleSQLData($r_fax);
		$r_email		= handleSQLData($r_email);
		 
		$sql = "insert into members(
				member_name,			member_password,	flag,
				member_level,			reg_time,		account,
				message,			r_name,			r_org,
				r_address1,			r_address2,		r_address3,
				r_city,				r_province,		r_country,
				r_postalcode,			r_telephone,		r_telephone_ext,
				r_fax,				r_fax_ext,		r_email
			)values('" .
				$member_name . "', '".$member_password_md5."',0," .
				"0, '" .			getDatetime() . "', 	0," .
				"'', '" .			$r_name . "', '" . 	$r_org . "', '" .
				$r_address1 . "', '" .		$r_address2 . "', '" .	$r_address3 . "', '" .
				$r_city . "', '" .		$r_province . "', '" .	$r_country . "', '" .
				$r_postalcode . "', '" . 	$r_telephone . "',	'', '" .
				$r_fax . "',			'', '" .		$r_email .
			"')";
		
		$rs = $conn->Execute($sql);
		if(!$rs)
		{
			showErrorMsg($conn->ErrorMsg());
		}else {
            $result = $domain_obj->login ($member_name, $member_password2);
			//if ($result != -1)
                $this->showSuccessfulInfo();
		}
	}
	
	function showSuccessfulInfo()
	{   global $smarty, $member_name, $member_password1;
	
		include(ROOT_DIR . "templates/" . CURRENT_SKIN . "/title.inc.php");
		include(ROOT_DIR . "templates/" . CURRENT_SKIN . "/member.signup.successful.php");
		include(ROOT_DIR . "templates/" . CURRENT_SKIN . "/tail.inc.php");
		
        $smarty->display(CURRENT_THEME.'/page.structure.tpl');
		die();
	}
}
?>
