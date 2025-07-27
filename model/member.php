<?php
	function getMemberInfo(member_id)
	{
		global $conn;
		
		$sql = "select * from members where member_id = " . $member_id;
		$rs = $conn->Execute($sql);
		if(!$rs)
		{
			return -1;
		}
		if($rs->EOF)
		{
			return -2;
		}
		$member_info = $rs->FetchRow();
		
		return $member_info;
	}
?>