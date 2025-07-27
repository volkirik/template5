<?php
class MemberUpdateContact
{
	function showForm($message)
	{
		global $member_info;
		
		if($_REQUEST["Submit"] != "")
		{
			$r_name		= handleData($_REQUEST["r_name"]);
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
		}else {
			$r_name		= $member_info[8];
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
		}
		
		include(ROOT_DIR . "templates/" . CURRENT_SKIN . "/title.inc.php");
		include(ROOT_DIR . "templates/" . CURRENT_SKIN . "/member.updatecontact.form.php");
		include(ROOT_DIR . "templates/" . CURRENT_SKIN . "/tail.inc.php");
		$smarty->display(CURRENT_THEME.'/page.structure.tpl');
		die();
	}
	
	function update()
	{
		global $conn;
		global $member_info;
		
		$old_password		= handleData($_REQUEST["old_password"]);
		$new_password		= handleData($_REQUEST["member_password1"]);
		$new_password1		= handleData($_REQUEST["member_password2"]);
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
		
		if($new_password != "")
		{
			if(strlen($new_password) > 20 || checkAscii($new_password))
			{
				$this->showForm(MEMBER_0017);
			}
			if($new_password != $new_password1)
			{
				$this->showForm(MEMBER_0018);
			}
			if($old_password == ""
				|| strlen($old_password) > 20
				|| checkAscii($old_password)
				|| (md5($old_password) != $member_info[2])
			)
				$this->showForm(MEMBER_0019);
			$update_password = md5($new_password);
		}else {
			$update_password = $member_info[2];
		}
		
		if($r_name == ""
			|| strlen($r_name) > 64
			|| checkAscii($r_name)
		)
			$this->showForm(MEMBER_0003);
		if($r_org == ""
			|| strlen($r_org) > 64
			|| checkAscii($r_org)
		)
			$this->showForm(MEMBER_0004);
		if($r_address1 == ""
			|| strlen($r_address1) > 64
			|| checkAscii($r_address1)
		)
			$this->showForm(MEMBER_0005);
		if(strlen($r_address2) > 64
			|| (strlen($r_address2) > 0 && checkAscii($r_address2))
		)
			$this->showForm(MEMBER_0006);
		if(strlen($r_address3) > 64
			|| (strlen($r_address3) > 0 && checkAscii($r_address3))
		)
			$this->showForm(MEMBER_0007);
		if($r_city == ""
			|| strlen($r_city) > 64
			|| checkAscii($r_city)
		)
			$this->showForm(MEMBER_0008);
		if($r_city == ""
			|| strlen($r_province) > 64
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
		)
			$this->showForm(MEMBER_0011);
		if($r_telephone == ""
			|| strlen($r_telephone) > 20
			|| checkAscii($r_telephone)
		)
			$this->showForm(MEMBER_0012);
		if($r_fax == ""
			|| strlen($r_fax) > 64
			|| checkAscii($r_fax)
		)
			$this->showForm(MEMBER_0013);
		if($r_email == ""
			|| strlen($r_email) > 80
			|| checkMail($r_email)
		)
			$this->showForm(MEMBER_0014);

		$r_name		= handleSQLData($r_name);
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
		$sql = "update members
			set
				member_password	= '" . $update_password . "',
				r_name		= '" . $r_name . "', 
				r_org		= '" . $r_org . "', 
				r_address1	= '" . $r_address1 . "', 
				r_address2	= '" . $r_address2 . "', 
				r_address3	= '" . $r_address3 . "', 
				r_city		= '" . $r_city . "', 
				r_province	= '" . $r_province . "', 
				r_country	= '" . $r_country . "', 
				r_postalcode	= '" . $r_postalcode . "', 
				r_telephone	= '" . $r_telephone . "', 
				r_fax		= '" . $r_fax . "', 
				r_email		= '" . $r_email . "' 
			where	member_id = " . $member_info[0];
		$rs = $conn->Execute($sql);
		if(!$rs)
		{
			$this->showForm(ALL_0004);
		}else {
			$this->showForm(MEMBER_0020);
		}
	}
}
?>
