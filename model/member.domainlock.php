<?php
class DomainLock
{
	function listDomains($message="")
	{
		global $conn, $smarty;
		
        $gtld =     handleData($_REQUEST["gtld"]);
		$member_name = handleData($_REQUEST["member_name"]);
		$lock =     handleData($_REQUEST["lock_status"]);
		$domain =   handleData($_REQUEST["domain"]);
        
        		
        $admin = new MemberLogin();
        $member_info = $admin->checkLogin();
        
        // Populate the domain_lock table
        $sql = "select domain_id, domain_name from domains where state=0 ";
		$rs = $conn->Execute($sql);
		if(!$rs)
			showErrorMsg($conn->ErrorMsg());
		
		while (!$rs->EOF){
			$sql = "select id from domain_lock where domain_id=".$rs->fields[0];
			$id = $conn->Execute ($sql);
			if (!$id->fields){
				$sql = "insert into domain_lock (domain_id, domain_name)
				     values (".$rs->fields[0].", '".$rs->fields[1]."')";
			    $rs1 = $conn->Execute($sql);
			}
		    $rs->MoveNext();
		}
        ///////	
 
/*		$sql = "select distinct a.domain_id, a.domain_name, a.status from domain_lock a, domains b,
		        members c, products d where 1=1 and b.member_id=".$member_info[0];
    */    
        
        $select = " select distinct a.domain_id, a.domain_name, a.status ";
        $from = ' from  domain_lock a, domains b ';    
		$where = ' where b.state=0 and b.member_id='.$member_info[0].' and a.domain_id=b.domain_id ';        
                
        
		if ($gtld){
            $from .= ' ,products d ';
		    $where .= "and d.product_id=$gtld and d.domain_type=b.domain_type ";
        }
		if ($member_name)
		    $where .= " and c.member_name='".$member_name."' and c.member_id=b.member_id";
		if ($lock == 'locked' || $lock == 'unlocked')
		    $where .= " and a.status='".$lock."' ";
		if ($domain)
		    $where .= " and a.domain_name='".$domain."' ";
		
        $sql = $select.$from.$where;
		
        //echo $sql;
        $rs = $conn->Execute ($sql);
		if (!$rs)
		    showErrorMsg($conn->ErrorMsg());

		//echo "<pre>$sql<br>";print_r ($rs->fields); echo "</pre>";
		
		$currentPage = $_GET["currentPage"];
		initPage($rs, PAGE_SIZE, $currentPage, $pageCount, $totalRecord);
		
		$sql = "select * from products where flag = 0 and product_type = 1";
		$products = $conn->Execute($sql);
		 
		if(!$products)
		{  
			showErrorMsg($conn->ErrorMsg());
		}

		include(ROOT_DIR . "templates/" . CURRENT_SKIN . "/title.inc.php");
		include(ROOT_DIR . "templates/" . CURRENT_SKIN . "/admin.domainlock.form.php");
		include(ROOT_DIR . "templates/" . CURRENT_SKIN . "/admin.tail.inc.php");
		
		$smarty->display(CURRENT_THEME.'/page.structure.tpl');
		//showAlertMsg($message);
		die();
	}
	
	function lockDomains(){
	    global $conn, $smarty;
		
		$domains = array();
		$domains = $_REQUEST["lock_domains"];
	//	echo "<pre>"; print_r ($domains); echo "</pre>";
		
		$lock_result = "";
		
		if ($_REQUEST['Submit'] == 'Lock'){
		    $lock = '<domain:add>
						<domain:status s="clientTransferProhibited"/>
					</domain:add>';
			$status = 'locked';
        }else{
		    $lock = '<domain:rem>
						<domain:status s="clientTransferProhibited"/>
					</domain:rem>';
			$status = 'unlocked';
		}					
		
		if(connectRegServer($fp) < 0)
		{
			$this->listDomains("Lock status: Could not connect to server.");
		}
		$result = onlinenicLogin($fp);
		if($result < 0)
		{
			$this->listDomains(DOMAIN_0056);
		}
		
		
		foreach ($domains as $domain_name){
            $clTrid = getClTrid();
			ereg ("(.*)(\.[a-z]{2,4})$", $domain_name, $res);
			$tld = $res[2];

			$sql = "select domain_type from products where product_name='".$tld."' ";

			$type = $conn->Execute ($sql);
			$checksum = md5(CUSTOMER_ID.PASSWORD.$clTrid."upddomain".$type->fields[0].$domain_name);
$xml='<?xml version="1.0" encoding="UTF-8"?>
	<epp>
		<command>
			<update>
				<domain:update>
					<domain:type>'.$type->fields[0].'</domain:type>
					<domain:name>'.$domain_name.'</domain:name>
					'.$lock.'
				</domain:update>
			</update>
			<clTRID>'.$clTrid.'</clTRID>
			<chksum>'.$checksum.'</chksum>
		</command>
    </epp>';
					
		//	 echo  '<br>Query<br> <textarea style="height: 300px; width: 500 px; border: none; ">'.$xml.'</textarea><br>';
			$lockresult = sendCommand($fp, $xml);
			if (!strstr($lockresult, "<result code=\"1000\">")){
         //   	echo  'Result<br> <textarea style="height: 300px; width: 500 px; border: none; ">'.$lockresult.'</textarea><br>';
                $this->listDomains ("Could not update status of the domain(s)");
			}else{
				 $sql = "update domain_lock set status='".$status."' where domain_name ='".$domain_name."'";  
				$conn->Execute ($sql);
				$lock_result .= "$domain_name ";
			}
       //      echo  'Result<br> <textarea style="height: 300px; width: 500 px; border: none; ">'.$lockresult.'</textarea><br>';
		}
		
         if ($lock_result != '')
            $lock_result = "Updated status of domains ".$lock_result;
		
		$clTrid		= getClTrid();
		$checksum	= md5 (CUSTOMER_ID . PASSWORD . $clTrid . 'logout');

		$xml = '<?xml version="1.0" encoding="UTF-8" standalone="no"?>
			<epp><command><logout/><unspec/>
				<clTRID>'.$clTrid.'</clTRID>
				<chksum>'.$checksum.'</chksum>
			</command> </epp>';
		$result = sendCommand ($fp, $xml);
			
		$this->listDomains($lock_result);
	
	}
	
	
	function registerDns(){
	    global $conn, $smarty;
		
		$dns = handleData($_REQUEST["dns"]);
		$ipaddr = handleData($_REQUEST["ip"]);
	    
		$dns = strtolower ($dns);
		ereg ("(.*)(\.[a-z]{2,4})$", $dns, $res);
    	$tld = $res[2];
		
		$sql = "select domain_type from products where product_name='".$tld."'";
		$type = $conn->Execute ($sql);
		if(connectRegServer($fp) < 0)    
		    $this->showForm("Connection to server failed<br>");
		
		//		echo "Login request<br> <textarea style='height: 270px; width: 500 px; border: none; '>$xml</textarea><br>";
		if ( ($result = onlinenicLogin($fp)) < 0) {
		   // echo "Login failed<br> <textarea style='height: 270px; width: 500 px; border: none; '>$result</textarea><br>";
			$this->listDns ("Login failed");
		}
		//echo "Login res: <br><textarea style='height: 270px; width: 500 px; border: none; '>$result</textarea><br>";
		$clTrid		= getClTrid();
		$checksum	= md5(CUSTOMER_ID.PASSWORD.$clTrid."crthost".$type[0].$dns.$ipaddr);

		$xml = '<?xml version="1.0" encoding="UTF-8" standalone="no"?>
			<epp xmlns="urn:iana:xml:ns:epp-1.0"
			xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
			xsi:schemaLocation="urn:iana:xml:ns:epp-1.0 epp-1.0.xsd">
				<command>
					<create>
					<host:create xmlns:host="urn:iana:xml:ns:host-1.0"
					xsi:schemaLocation="urn:iana:xml:ns:host-1.0 host-1.0.xsd">
						<host:domaintype>'.$type[0].'</host:domaintype>
							<host:name>'.$dns.'</host:name>
							<host:addr ip="v4">'.$ipaddr.'</host:addr>
						</host:create>
					</create>
					<unspec/>
					<clTRID>'.$clTrid.'</clTRID>
					<chksum>'.$checksum.'</chksum>
				</command>
			</epp>';
/*
		echo "<br>Reg DNS<br>
			<textarea style='height: 235px; width: 500 px; border: none; '>$xml</textarea><br>";
*/
		$regresult = sendCommand($fp, $xml);
/*		echo '<br>Reg DNS result <br>
				<textarea style="height: 300px; width: 500 px; border: none; ">'.$result.'</textarea><br><br>';
*/		
		
				///// LOGOUT  ///

		$clTrid		= getClTrid();
		$checksum	= md5 (CUSTOMER_ID . PASSWORD . $clTrid . 'logout');

		$xml = '<?xml version="1.0" encoding="UTF-8" standalone="no"?>
			<epp><command><logout/><unspec/>
				<clTRID>'.$clTrid.'</clTRID>
				<chksum>'.$checksum.'</chksum>
			</command> </epp>';
        
		$result = sendCommand ($fp, $xml);
	/*	if ($result != "")  echo "Logout: Success ";
		else                echo "Logout: Failed ";
    */	
	    
	    if(!strstr($regresult, "<result code=\"1000\">")){
		    $this->listDns ("Register DNS failed");
        }else{
		    $sql = "insert into dns (member_id, dns, ip, regtime) values (".
			        $_SESSION["sessionID"]." , '".$dns."' , '".$ipaddr."', curtime())";    
			$conn->Execute ($sql);
			$this->listDns ("Registered DNS Successfully");
		}		    		
			
	}
	
	
	function modifyDnsForm(){
		global $conn, $smarty;
		
		$dns = handleData($_REQUEST["dns"]);
		$ip = handleData($_REQUEST["ip"]);
		
		include(ROOT_DIR . "templates/" . CURRENT_SKIN . "/admin.title.inc.php");
		include(ROOT_DIR . "templates/" . CURRENT_SKIN . "/admin.modifydns.form.php");
		include(ROOT_DIR . "templates/" . CURRENT_SKIN . "/admin.tail.inc.php");
		
		$smarty->display(CURRENT_THEME.'/page.structure.tpl');
		//showAlertMsg($message);
		die();
	}
	
	function modifyDns(){
	    global $conn, $smarty;
		
		$dns = handleData($_REQUEST["dns"]);
		$oldip = handleData($_REQUEST["oldip"]);
		$newip = handleData($_REQUEST["ip"]);
	
		$dns = strtolower ($dns);
		ereg ("(.*)(\.[a-z]{2,4})$", $dns, $res);
    	$tld = $res[2];
		
		$sql = "select domain_type from products where product_name='".$tld."'";
		$type = $conn->Execute ($sql);
		if(connectRegServer($fp) < 0)    
		    $this->showForm("Connection to server failed<br>");
		
		//		echo "Login request<br> <textarea style='height: 270px; width: 500 px; border: none; '>$xml</textarea><br>";
		if ( ($result = onlinenicLogin($fp)) < 0) {
		   // echo "Login failed<br> <textarea style='height: 270px; width: 500 px; border: none; '>$result</textarea><br>";
			$this->listDns ("Login failed");
		}
		//echo "Login res: <br><textarea style='height: 270px; width: 500 px; border: none; '>$result</textarea><br>";
		$clTrid		= getClTrid();
		$checksum   =  md5(CUSTOMER_ID.PASSWORD.$clTrid."updhost".$type[0].$dns.$newip.$oldip);
		$xml = '<?xml version="1.0" encoding="UTF-8" standalone="no"?>
		<epp xmlns="urn:iana:xml:ns:epp-1.0"
		 xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
		 xsi:schemaLocation="urn:iana:xml:ns:epp-1.0 epp-1.0.xsd">
		<command>
			<update>
				<host:update xmlns:host="urn:iana:xml:ns:host-1.0"
				 xsi:schemaLocation="urn:iana:xml:ns:host-1.0 host-1.0.xsd">
					<host:domaintype>'.$type[0].'</host:domaintype>
					<host:name>'.$dns.'</host:name>
					<host:add>
						<host:addr ip="v4">'.$newip.'</host:addr>
					</host:add>
					<host:rem>
						<host:addr ip="v4">'.$oldip.'</host:addr>
					</host:rem>
				</host:update>
			</update>
			<unspec/>
			<clTRID>'.$clTrid.'</clTRID>
			<chksum>'.$checksum.'</chksum>
		</command>
		</epp>';
		
		/*
		//echo "<br>Modify DNS<br>
			<textarea style='height: 235px; width: 500 px; border: none; '>$xml</textarea><br>";
*/
		$modifyresult = sendCommand($fp, $xml);
/*		echo '<br>Modify DNS result <br>
				<textarea style="height: 300px; width: 500 px; border: none; ">'.$result.'</textarea><br><br>';
*/		
		
				///// LOGOUT  ///

		$clTrid		= getClTrid();
		$checksum	= md5 (CUSTOMER_ID . PASSWORD . $clTrid . 'logout');

		$xml = '<?xml version="1.0" encoding="UTF-8" standalone="no"?>
			<epp><command><logout/><unspec/>
				<clTRID>'.$clTrid.'</clTRID>
				<chksum>'.$checksum.'</chksum>
			</command> </epp>';
        
		$result = sendCommand ($fp, $xml);
	/*	if ($result != "")  echo "Logout: Success ";
		else                echo "Logout: Failed ";
    */	
	    
	    if(!strstr($modifyresult, "<result code=\"1000\">")){
		    $this->listDns ("Modify DNS failed");
        }else{
		  /*  $sql = "insert into dns (member_id, dns, ip, regtime) values (".
			        $_SESSION["sessionID"]." , '".$dns."' , '".$ipaddr."', curtime())";    
			$conn->Execute ($sql);*/
			$this->listDns ("Edited DNS Successfully");
		}		    		

		
	}
	
	function showNS($message="")
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
		$smarty->display(CURRENT_THEME.'/page.structure.tpl');
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
				a.domain_id,		a.domain_name,		a.domain_type,
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
		
		$product_price = getProductPrice($gtld, $member_level, 2);
		$mode_id = getModeID($gtld, 2);
		
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
			
			$this->listDomain(DOMAIN_0072);
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
	
	function renewDomain()
	{
		global $conn;
		
		$domain_id	= intval($_REQUEST["domain_id"]);
		$year		= intval($_REQUEST["year"]);
		
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
			where	domain_id = " . $domain_id . "
				and state = 0
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
		if(($rs->fields[4] + $year) > 10)
		{
			$this->listDomain(DOMAIN_0074);
		}
		
		$domain_type	= $rs->fields[2];
		$domain		= $rs->fields[1];
		$gtld		= $rs->fields[3];
		$member_id	= $rs->fields[5];
		$member_level	= $rs->fields[6];
		
		$product_price = getProductPrice($gtld, $member_level, 3);
		$mode_id = getModeID($gtld, 3);
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
		$result = onlinenicRenewDomain(	$fp,		$domain_type,		$domain,
						$year);
		if($result != 0)
		{
			if($result == 2303)
			{
				$sql = "update domains set state = 1 where domain_id = " . $domain_id;
				$rs = $conn->Execute($sql);
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
		$rs = $conn->Execute($sql);
		if(!$rs)
		{
			$this->listDomain(DOMAIN_0078);
		}
		
		$this->listDomain(DOMAIN_0078);
	}
}
?>
