<?php
class DnsManage
{
	function listDns($message)
	{
		global $conn, $smarty;

	        $member_id = '%';
		
		if (($dns = handleData($_REQUEST["dns_name"])) == '')
		     $dns = '%';
	/*	
		$member_name = handleData($_REQUEST["member_name"]);	 
		if ($member_name != '')
		{
		    $sql = "select member_id from members where member_name='".$member_name."'";
			$rs = $conn->Execute ($sql);
			if ($rs)
				$member_id = $rs->fields[0];
		}
	*/	
        $admin = new MemberLogin();
        $id = $admin->checkLogin();

        $sql = "select * from dns where member_id=".$id[0]." and dns like '".$dns."'";
//	echo $sql ."<br>";
		$rs = $conn->Execute($sql);
		if(!$rs)
		{
			showAdminErrorMsg($conn->ErrorMsg());
		}

		$currentPage = $_GET["currentPage"];
		initPage($rs, PAGE_SIZE, $currentPage, $pageCount, $totalRecord);
		
        
		include(ROOT_DIR . "templates/" . CURRENT_SKIN . "/title.inc.php");
		include(ROOT_DIR . "templates/" . CURRENT_SKIN . "/admin.dnslist.php");
		include(ROOT_DIR . "templates/" . CURRENT_SKIN . "/tail.inc.php");
		
		$smarty->display(CURRENT_THEME.'/page.structure.tpl');
		//showAlertMsg($message);
		die();
	}
	
	function registerDnsForm(){
	    global $conn, $smarty;
		
		include(ROOT_DIR . "templates/" . CURRENT_SKIN . "/title.inc.php");
		include(ROOT_DIR . "templates/" . CURRENT_SKIN . "/admin.registerdns.form.php");
		include(ROOT_DIR . "templates/" . CURRENT_SKIN . "/tail.inc.php");
		
		$smarty->display(CURRENT_THEME.'/page.structure.tpl');
		//showAlertMsg($message);
		die();
	
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
		$checksum	= md5(CUSTOMER_ID.PASSWORD.$clTrid."crthost".$type->fields[0].$dns.$ipaddr);

		$xml = '<?xml version="1.0" encoding="UTF-8" standalone="no"?>
			<epp xmlns="urn:iana:xml:ns:epp-1.0"
			xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
			xsi:schemaLocation="urn:iana:xml:ns:epp-1.0 epp-1.0.xsd">
				<command>
					<create>
					<host:create xmlns:host="urn:iana:xml:ns:host-1.0"
					xsi:schemaLocation="urn:iana:xml:ns:host-1.0 host-1.0.xsd">
						<host:domaintype>'.$type->fields[0].'</host:domaintype>
							<host:name>'.$dns.'</host:name>
							<host:addr ip="v4">'.$ipaddr.'</host:addr>
						</host:create>
					</create>
					<unspec/>
					<clTRID>'.$clTrid.'</clTRID>
					<chksum>'.$checksum.'</chksum>
				</command>
			</epp>';

	/*	echo "<br>Reg DNS<br>
			<textarea style='height: 235px; width: 500 px; border: none; '>$xml</textarea><br>";
*/
		$regresult = sendCommand($fp, $xml);
	/*	echo '<br>Reg DNS result <br>
				<textarea style="height: 300px; width: 500 px; border: none; ">'.$regresult.'</textarea><br><br>';
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



		$sql_member = "select
                                member_id
                        from    sessions
                        where   session_id = " . $_SESSION["sessionID"] . "
                                and login_type = 1";
                $rs = $conn->Execute($sql_member);
		
	       if($rs->RecordCount() != 1)
                {
			$this->listDns ("Register DNS failed");                
                }

		
		    $sql = "insert into dns (member_id, dns, ip, regtime) values (".
			       $rs->fields[0]." , '".$dns."' , '".$ipaddr."', now())";    
		
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
		$checksum   =  md5(CUSTOMER_ID.PASSWORD.$clTrid."testupdhost".$type->fields[0].$dns.$newip.$oldip);
		$xml = '<?xml version="1.0" encoding="UTF-8" standalone="no"?>
		<epp xmlns="urn:iana:xml:ns:epp-1.0"
		 xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
		 xsi:schemaLocation="urn:iana:xml:ns:epp-1.0 epp-1.0.xsd">
		<command>
			<update>
				<host:update xmlns:host="urn:iana:xml:ns:host-1.0"
				 xsi:schemaLocation="urn:iana:xml:ns:host-1.0 host-1.0.xsd">
					<host:domaintype>'.$type->fields[0].'</host:domaintype>
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
			<clTRID>'.$clTrid.'test</clTRID>
			<chksum>'.$checksum.'</chksum>
		</command>
		</epp>';
		
		
	/*	echo "<br>Modify DNS<br>
			<textarea style='height: 235px; width: 500 px; border: none; '>$xml</textarea><br>";
*/
		$modifyresult = sendCommand($fp, $xml);
	/*	echo '<br>Modify DNS result <br>
				<textarea style="height: 300px; width: 500 px; border: none; ">'.$modifyresult.'</textarea><br><br>';
		
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
			        $_SESSION["sessionID"]." , '".$dns."' , '".$ipaddr."', curtime())"; */
			$sql = "update dns set ip='".$newip."' where dns='".$dns."'"; 
			$conn->Execute ($sql);
			$this->listDns ("Edited DNS Successfully");
		}		    		
	}

}
?>
