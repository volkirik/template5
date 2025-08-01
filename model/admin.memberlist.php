<?php
class MemberList
{
	function listMember($message)
	{
		global $conn, $smarty;
		
		$startYear	= intval($_REQUEST["startYear"]);
		$startMonth	= intval($_REQUEST["startMonth"]);
		$startDay	= intval($_REQUEST["startDay"]);
		$toYear		= intval($_REQUEST["toYear"]);
		$toMonth	= intval($_REQUEST["toMonth"]);
		$toDay		= intval($_REQUEST["toDay"]);
		$member_name	= StripSlashes($_REQUEST["member_name"]);
		$orders		= intval($_REQUEST["orders"]);

		if($startYear == 0 || $startMonth == 0 || $startDay == 0 || $toYear == 0 || $toMonth == 0 || $toDay == 0)
		{
			$searchDate = 0;
		}else {
			$searchDate = 1;
			if(DB_TYPE == "mysql")
			{
				$startDate	= $startYear . "-" . $startMonth . "-" . $startDay;
				$toDate		= $toYear . "-" . $toMonth . "-" . $toDay;
			}else {
				$startDate	= $startMonth . "/" . $startDay . "/" . $startYear;
				$toDate		= $toMonth . "/" . $toDay . "/" . $toYear;
			}
		}

		$sql = "select * from members where flag in(0, 1)";
		if($member_name != "")
		{
			$sql .= " and member_name like '%" . handleSQLData($member_name) . "%'";
		}
		if($searchDate == 1)
		{
			if(DB_TYPE == "mysql")
			{
				$sql .= " and to_days(reg_time) >= to_days('" . $startDate . "')" .
				 	" and to_days(reg_time) <= to_days( '" . $toDate . "')";
			}else {
				$sql .= " and reg_time > '" . $startDate . "'" .
				 	" and reg_time-1 < '" . $toDate . "'";
			}
		}
		if($orders == 1)
		{
			$sql .= " order by member_level desc";
		}else if($orders == 2) {
			$sql .= " order by member_name";
		}else if($orders == 3) {
			$sql .= " order by reg_time desc";
		}else {
			$sql .= " order by member_level desc";
		}
		
		$rs = $conn->Execute($sql);
		if(!$rs)
		{
			showAdminErrorMsg($conn->ErrorMsg());
		}
		$currentPage = $_REQUEST["currentPage"];
		initPage($rs, PAGE_SIZE, $currentPage, $pageCount, $totalRecord);
		
		include(ROOT_DIR . "templates/" . CURRENT_SKIN . "/admin.title.inc.php");
		include(ROOT_DIR . "templates/" . CURRENT_SKIN . "/admin.listmember.php");
		include(ROOT_DIR . "templates/" . CURRENT_SKIN . "/admin.tail.inc.php");
	
		$smarty->display(CURRENT_THEME.'/page.structure.tpl');
		showAlertMsg($message);
		die();
	}
	
	function viewMemberInfo()
	{
		global $conn, $smarty;
		
		$member_id = intval($_REQUEST["member_id"]);
		if($member_id == 0)
		{
			$this->listProduct(ADMIN_0018);
		}
		
		if(DB_TYPE == "mysql")
		{
			$sql = "select 
					member_id,		member_name,				flag,
					member_level,		reg_time,				account,
					message,		r_name,					r_org,
					r_address1,		r_address2,				r_address3,
					r_city,			r_province,				r_country,
					r_postalcode,		r_telephone,				r_fax,
					r_email				
				from members where member_id=" . $member_id;
		}else {
			$sql = "select 
					member_id,		member_name,				flag,
					member_level,		convert(char(20), reg_time, 120),	account,
					message,		r_name,					r_org,
					r_address1,		r_address2,				r_address3,
					r_city,			r_province,				r_country,
					r_postalcode,		r_telephone,				r_fax,
					r_email				
				from members where member_id=" . $member_id;
		}
		$rs = $conn->Execute($sql);
		if(!$rs)
		{
			showAdminErrorMsg($conn->ErrorMsg());
		}
		if($rs->RecordCount() != 1)
		{
			$this->listMember(ADMIN_0018);
		}
		
		$member_id		= $rs->fields[0];
		$member_name		= $rs->fields[1];
		$flag			= $rs->fields[2];
		$member_level		= $rs->fields[3];
		$reg_time		= $rs->fields[4];
		$account		= $rs->fields[5];
		$member_message		= $rs->fields[6];
		$r_name			= $rs->fields[7];
		$r_org			= $rs->fields[8];
		$r_address1		= $rs->fields[9];
		$r_address2		= $rs->fields[10];
		$r_address3		= $rs->fields[11];
		$r_city			= $rs->fields[12];
		$r_province		= $rs->fields[13];
		$r_country		= $rs->fields[14];
		$r_postalcode		= $rs->fields[15];
		$r_telephone		= $rs->fields[16];
		$r_fax			= $rs->fields[17];
		$r_email		= $rs->fields[18];
		
		if($flag == 0)
		{
			$status = ADMIN_0019;
		}else {
			$status = ADMIN_0020;
		}
		
		include(ROOT_DIR . "templates/" . CURRENT_SKIN . "/admin.title.inc.php");
		include(ROOT_DIR . "templates/" . CURRENT_SKIN . "/admin.listmember.viewmemberinfo.php");
		include(ROOT_DIR . "templates/" . CURRENT_SKIN . "/admin.tail.inc.php");
		$smarty->display(CURRENT_THEME.'/page.structure.tpl');
		die();
	}

	function showModifyForm($message)
	{
		global $conn, $smarty;
		
		$member_id = intval($_REQUEST["member_id"]);
		if($member_id == 0)
		{
			$this->listProduct(ADMIN_0018);
		}
		
		if(DB_TYPE == "mysql")
		{
			$sql = "select 
					member_id,		member_name,				flag,
					member_level,		reg_time,				account,
					message,		r_name,					r_org,
					r_address1,		r_address2,				r_address3,
					r_city,			r_province,				r_country,
					r_postalcode,		r_telephone,				r_fax,
					r_email				
				from members where member_id=" . $member_id;
		}else {
			$sql = "select 
					member_id,		member_name,				flag,
					member_level,		convert(char(20), reg_time, 120),	account,
					message,		r_name,					r_org,
					r_address1,		r_address2,				r_address3,
					r_city,			r_province,				r_country,
					r_postalcode,		r_telephone,				r_fax,
					r_email				
				from members where member_id=" . $member_id;
		}
		$rs = $conn->Execute($sql);
      //  echo $sql;
		if(!$rs)
		{
			showAdminErrorMsg($conn->ErrorMsg());
		}
		if($rs->RecordCount() != 1)
		{
			$this->listMember(ADMIN_0018);
		}
		
		$member_id		= $rs->fields[0];
		$member_name		= $rs->fields[1];
		$reg_time		= $rs->fields[4];
		$account		= $rs->fields[5];
		$member_message		= $rs->fields[6];
		
		if($message == "")
		{
			$flag			= $rs->fields[2];
			$member_level		= $rs->fields[3];
			$r_name			= $rs->fields[7];
			$r_org			= $rs->fields[8];
			$r_address1		= $rs->fields[9];
			$r_address2		= $rs->fields[10];
			$r_address3		= $rs->fields[11];
			$r_city			= $rs->fields[12];
			$r_province		= $rs->fields[13];
			$r_country		= $rs->fields[14];
			$r_postalcode		= $rs->fields[15];
			$r_telephone		= $rs->fields[16];
			$r_fax			= $rs->fields[17];
			$r_email		= $rs->fields[18];
		}else {
			$flag			= handleData($_REQUEST["flag"]);
			$member_level		= handleData($_REQUEST["member_level"]);
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
		}

		$sql = "select * from country";
		$rs = $conn->Execute($sql);
		if(!$rs)
		{
			showAdminErrorMsg($conn->ErrorMsg());
		}

		include(ROOT_DIR . "templates/" . CURRENT_SKIN . "/admin.title.inc.php");
		include(ROOT_DIR . "templates/" . CURRENT_SKIN . "/admin.listmember.showmodifymemberinfo.php");
		include(ROOT_DIR . "templates/" . CURRENT_SKIN . "/admin.tail.inc.php");
		$smarty->display(CURRENT_THEME.'/page.structure.tpl');
		die();
	}

	function modifyMemberInfo()
	{
		global $conn;
		
		$member_id		= handleData($_REQUEST["member_id"]);
		$flag			= handleData($_REQUEST["flag"]);
		$member_level	= handleData($_REQUEST["member_level"]);
		$r_password     = handleData($_REQUEST["r_password"]);
		$r_name			= handleData($_REQUEST["r_name"]);
		$r_org			= handleData($_REQUEST["r_org"]);
		$r_address1		= handleData($_REQUEST["r_address1"]);
		$r_address2		= handleData($_REQUEST["r_address2"]);
		$r_address3		= handleData($_REQUEST["r_address3"]);
		$r_city			= handleData($_REQUEST["r_city"]);
		$r_province		= handleData($_REQUEST["r_province"]);
		$r_country		= handleData($_REQUEST["r_country"]);
		$r_postalcode	= handleData($_REQUEST["r_postalcode"]);
		$r_telephone	= handleData($_REQUEST["r_telephone"]);
		$r_fax			= handleData($_REQUEST["r_fax"]);
		$r_email		= handleData($_REQUEST["r_email"]);
		
	/*	if($r_name == ""
			|| strlen($r_name) > 64
			|| checkAscii($r_name)
		)
			$this->showModifyForm(MEMBER_0003); */
		if($r_org == ""
			|| strlen($r_org) > 64
			|| checkAscii($r_org)
		)
			$this->showModifyForm(MEMBER_0004);
		if($r_address1 == ""
			|| strlen($r_address1) > 64
			|| checkAscii($r_address1)
		)
			$this->showModifyForm(MEMBER_0005);
		if(strlen($r_address2) > 64
			|| (strlen($s_address2) > 0 && checkAscii($r_address2))
		)
			$this->showModifyForm(MEMBER_0006);
		if(strlen($r_address3) > 64
			|| (strlen($s_address3) > 0 && checkAscii($r_address3))
		)
			$this->showModifyForm(MEMBER_0007);
		if($r_city == ""
			|| strlen($r_city) > 64
			|| checkAscii($r_city)
		)
			$this->showModifyForm(MEMBER_0008);
		if($r_city == ""
			|| strlen($r_province) > 64
			|| checkAscii($r_province)
		)
			$this->showModifyForm(MEMBER_0009);
		if($r_country == ""
			|| strlen($r_country) > 2
			|| checkAscii($r_country)
		)
			$this->showModifyForm(MEMBER_0010);
		if($r_postalcode == ""
			|| strlen($r_postalcode) > 10
			|| checkAscii($r_postalcode)
		)
			$this->showModifyForm(MEMBER_0011);
		if($r_telephone == ""
			|| strlen($r_telephone) > 20
			|| checkAscii($r_telephone)
		)
			$this->showModifyForm(MEMBER_0012);
		if($r_fax == ""
			|| strlen($r_fax) > 64
			|| checkAscii($r_fax)
		)
			$this->showModifyForm(MEMBER_0013);
		if($r_email == ""
			|| strlen($r_email) > 80
			|| checkMail($r_email)
		)
			$this->showModifyForm(MEMBER_0014);
			
		$flag		= intval($flag);
		$member_level	= intval($member_level);
		if($flag != 0 && $flag != 1)
		{
			$flag = 1;
		}
		if($member_level < 0 || $member_level > 4)
		{
			$member_level = 0;
		}
		
		$sql = "select * from members where member_id = " . $member_id;
		$rs = $conn->Execute($sql);
		if(!$rs)
		{
			showAdminErrorMsg($conn->ErrorMsg());
		}
		if($rs->RecordCount() != 1)
		{
			$this->listMember(ADMIN_0018);
		}
		
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
/*		$sql = "update members set
				flag		= " . $flag . ",
				member_level	= " . $member_level . ",
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
			where	member_id = " . $member_id;
*/
		if($r_password!=""){
			$sql = "update members set
				flag		= " . $flag . ",
				member_level	= " . $member_level . ",
				member_password = '". handleSQLData (md5($r_password))."', 
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
			where	member_id = " . $member_id;	
		}else{
			
                        $sql = "update members set
                                flag            = " . $flag . ",
                                member_level    = " . $member_level . ",
                                r_org           = '" . $r_org . "',
                                r_address1      = '" . $r_address1 . "',
                                r_address2      = '" . $r_address2 . "',
                                r_address3      = '" . $r_address3 . "',
                                r_city          = '" . $r_city . "',
                                r_province      = '" . $r_province . "',
                                r_country       = '" . $r_country . "',
                                r_postalcode    = '" . $r_postalcode . "',
                                r_telephone     = '" . $r_telephone . "',
                                r_fax           = '" . $r_fax . "',
                                r_email         = '" . $r_email . "'
                        where   member_id = " . $member_id;
			
		}
		//echo $sql;
			
		$rs = $conn->Execute($sql);
		if(!$rs)
		{
			showAdminErrorMsg($conn->ErrorMsg());
		}
		$this->listMember(MEMBER_0020);
		
		die();
	}
	
	function deleteMember()
	{
		global $conn;
		
		$member_id = intval($_REQUEST["member_id"]);
		if($member_id == 0)
		{
			$this->listProduct(ADMIN_0018);
		}
		$sql = "select * from members where member_id = " . $member_id;
		$rs = $conn->Execute($sql);
		if(!$rs)
		{
			showAdminErrorMsg($conn->ErrorMsg());
		}
		if($rs->RecordCount() != 1)
		{
			$this->listMember(ADMIN_0018);
		}
		
		$sql = "update members set flag = 2 where member_id = " . $member_id;
		$rs = $conn->Execute($sql);
		if(!$rs)
		{
			showAdminErrorMsg($conn->ErrorMsg());
		}
		$this->listMember(ADMIN_0021);
		
		die();
	}
}
?>
