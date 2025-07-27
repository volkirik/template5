<?php
	function onlinenicLogin($fp)
	{
		$clTrid		= getClTrid();
		$checksum	= md5(CUSTOMER_ID . PASSWORD . $clTrid . "login");
		
		$xml = "<?xml version=\"1.0\" encoding=\"UTF-8\" standalone=\"no\"?>
<epp>
	<command>
        	<creds>
        		<clID>" . CUSTOMER_ID . "</clID>
        		<options>
        			<version>1.0</version>
        			<lang>en</lang>
        		</options>
		</creds>
		<clTRID>". $clTrid . "</clTRID>
		<login>
			<chksum>" .$checksum . "</chksum>
		</login>
	</command>
</epp>";
		$result = sendCommand($fp, $xml);
		
		if(!strstr($result, "<result code=\"1000\">"))
		{  
		   // echo "<br><textarea style='height: 330px;width: 700px;'>$result</textarea><br>";
			return -1;
		}else {
		 //	echo "<textarea style='height: 330px; width: 700 px;'>$xml</textarea>";
			return 0;
		}
	}

	function onlinenicCheckDomain($fp, $domain, $domain_type)
	{
		$clTrid		= getClTrid();
		$checksum	= md5(CUSTOMER_ID . PASSWORD . $clTrid . "chkdomain" . $domain_type . $domain);
		//echo $fp;
//		echo "<br>".$domain_type;	
		$xml = "<?xml version=\"1.0\" encoding=\"UTF-8\" standalone=\"no\"?>
<epp>
	<command>
		<check>
			<domain:check>
				<domain:type>" . $domain_type . "</domain:type>
				<domain:name>" . $domain . "</domain:name>
			</domain:check>
		</check>
		<clTRID>" . $clTrid . "</clTRID>
		<chksum>" . $checksum . "</chksum>
	</command>
</epp>";

   
		$result = sendCommand($fp, $xml);
//		echo "<br> test result ...".$result;
//	  echo "<br><textarea style='height: 290px;width: 700px;'>$xml</textarea><br>"; 
		if(!strstr($result, "<result code=\"1000\">"))
		{
  //      echo "<br><textarea style='height: 290px;width: 700px;'>$xml</textarea><br>"; 
    //    echo "&nbsp;<textarea style='height: 330px; width: 500 px; border: none; '>$result</textarea><br>";
			return -1;
		}
//		echo "<br><textarea style='height: 290px;width: 700px;'>$xml</textarea><br>";
//		echo "&nbsp;<textarea style='height: 330px; width: 500 px; border: none; '>$result</textarea><br>";
		if(strstr($result, "<domain:cd x=\"+\">"))
		{//echo "&nbsp;<textarea style='height: 330px; width: 500 px; border: none; '>$result</textarea><br>";
			return 1;
		}else if(strstr($result, "<domain:cd x=\"-\">")) {
			return 0;
		}else {
		   // echo "<br>other<br>";
			return -1;
		}
	}
	
	function onlinenicRegisterDomain($fp, $domain_type, $domain, $year, $dns1, $dns2, $registrant, $admin, $tech, $billing, $password)
	{
		$clTrid		= getClTrid();
		$checksum	= md5(CUSTOMER_ID . PASSWORD . $clTrid . "crtdomain" . $domain_type . $domain . $year . $dns1 . $dns2 . $registrant . $admin . $tech . $billing . $password);

		$xml = "<?xml version=\"1.0\" encoding=\"UTF-8\" standalone=\"no\"?>
<epp>
	<command>
		<create>
			<domain:create>
				<domain:type>" . $domain_type . "</domain:type>
				<domain:name>" . $domain . "</domain:name>
				<domain:period>" . $year . "</domain:period>
				<domain:ns1>" . $dns1 . "</domain:ns1>
				<domain:ns2>" . $dns2 . "</domain:ns2>
				<domain:registrant>" . $registrant . "</domain:registrant>
				<domain:contact type=\"admin\">" . $admin . "</domain:contact>
				<domain:contact type=\"tech\">" . $tech . "</domain:contact>
				<domain:contact type=\"billing\">" . $billing . "</domain:contact>
				<domain:authInfo type=\"pw\">" . $password . "</domain:authInfo>
			</domain:create>
		</create>
		<clTRID>" . $clTrid . "</clTRID>
		<chksum>" . $checksum . "</chksum>
	</command>
</epp>";
		$result = sendCommand($fp, $xml);
/*		 echo  '<br>Result<br> <textarea style="height: 300px; width: 500 px; border: none; ">'.$xml.'</textarea><br>';
         echo  '<br>Result<br> <textarea style="height: 300px; width: 500 px; border: none; ">'.$result.'</textarea><br>';
*/
		if(!strstr($result, "<result code=\"1000\">"))
		{
			return getResultCode($result);
		}
		
		return 0;
	}
	
	function onlinenicRegisterContact($fp, $domain_type, $name, $org, $address1, $address2, $address3, $city, $province, $country, $postalcode, $telephone, $fax, $email, $password, &$contact_id, $unspec)
	{
		$clTrid		= getClTrid();
		$checksum	= md5(CUSTOMER_ID . PASSWORD . $clTrid . "crtcontact" . $name . $org . $email);

		$xml = "<?xml version=\"1.0\" encoding=\"UTF-8\" standalone=\"no\"?>
<epp>
	<command>
		<create>
			<contact:create>
				<contact:domaintype>" . $domain_type . "</contact:domaintype>
				<contact:ascii>
					<contact:name>" . $name . "</contact:name>
					<contact:org>" . $org . "</contact:org>
					<contact:addr>
						<contact:street1>" . $address1 . "</contact:street1>\n";
if($address2 != "")
{
	$xml .= "<contact:street2>" . $address2 . "</contact:street2>\n";
	if($address3 != "")
	{
		$xml .= "<contact:street3>" . $address2 . "</contact:street3>\n";
	}
}
						$xml .= "<contact:city>" . $city . "</contact:city>
						<contact:sp>" . $province . "</contact:sp>
						<contact:pc>" . $postalcode . "</contact:pc>
						<contact:cc>" . $country . "</contact:cc>
					</contact:addr>
				</contact:ascii>
				<contact:voice>" . $telephone . "</contact:voice>
				<contact:fax>" . $fax . "</contact:fax>
				<contact:email>" . $email . "</contact:email>
				<contact:pw>" . $password . "</contact:pw>
			</contact:create>
		</create>\n";
		if($unspec != "")
		{
			$xml .= "		<unspec>" . $unspec . "</unspec>\n";
		}
		$xml .= "		<clTRID>" . $clTrid . "</clTRID>
		<chksum>" . $checksum . "</chksum>
	</command>
</epp>";
		$result = sendCommand($fp, $xml);
/*      echo  '<br>Result<br> <textarea style="height: 340px; width: 700 px; border: none; ">'.$xml.'</textarea><br>';
      echo  '<br>Result<br> <textarea style="height: 340px; width: 700 px; border: none; ">'.$result.'</textarea><br>';
*/
        if(!strstr($result, "<result code=\"1000\">"))
		{
			return getResultCode($result);
		}
		$contact_id = onlinenicGetValue($result, "<contact:id>", "</contact:id>");
		
		return 0;
	}
	
	function onlinenicModifyDomainPassword($fp, $domain_type, $domain, $password)
	{
		$clTrid		= getClTrid();
		$checksum	= md5(CUSTOMER_ID . PASSWORD . $clTrid . "upddomain" . $domain_type . $domain . $password);
		
		$xml = "<?xml version=\"1.0\" encoding=\"UTF-8\" standalone=\"no\"?>
<epp>
	<command>
		<update>
			<domain:update>
				<domain:type>" . $domain_type . "</domain:type>
				<domain:name>" . $domain . "</domain:name>
				<domain:rep>
					<domain:authInfo type=\"pw\">" . $password . "</domain:authInfo>
				</domain:rep>
			</domain:update>
		</update>
		<clTRID>" . $clTrid . "</clTRID>
		<chksum>" . $checksum . "</chksum>
	</command>
</epp>";
		$result = sendCommand($fp, $xml);
/*	
   echo "<br><textarea style='height: 290px;width: 700px;'>$xml</textarea><br>";
    echo "<br><textarea style='height: 290px;width: 700px;'>$result</textarea><br>"; 
*/  
		if(!strstr($result, "<result code=\"1000\">"))
		{
			return getResultCode($result);
		}
		
		return 0;
	}
	
	function onlinenicModifyContact($fp, $domain_type, $domain, $contact_type, $name, $org, $address1, $address2, $address3, $city, $province, $country, $postalcode, $telephone, $fax, $email)
	{
		$clTrid		= getClTrid();
		$checksum	= md5(CUSTOMER_ID . PASSWORD . $clTrid . "updcontact" . $domain_type . $domain . $contact_type . $name . $org . $email);
		
		$xml = "<?xml version=\"1.0\" encoding=\"UTF-8\" standalone=\"no\"?>
<epp>
	<command>
		<update>
			<contact:update>
				<contact:domaintype>" . $domain_type . "</contact:domaintype>
				<contact:domain>" . $domain . "</contact:domain>
				<contact:contacttype>". $contact_type . "</contact:contacttype>
				<contact:ascii>";
		if($name != "")
		{
			$xml .= "<contact:name>" . $name . "</contact:name>";
		}
			$xml .= "<contact:org>" . $org . "</contact:org>
					<contact:addr>
						<contact:street1>" . $address1 . "</contact:street1>\n";
if($address2 != "")
{
	$xml .= "<contact:street2>" . $address2 . "</contact:street2>\n";
	if($address3 != "")
	{
		$xml .= "<contact:street3>" . $address3 . "</contact:street3>\n";
	}
}
						$xml .= "<contact:city>" . $city . "</contact:city>
						<contact:sp>" . $province . "</contact:sp>
						<contact:pc>" . $postalcode . "</contact:pc>
						<contact:cc>" . $country . "</contact:cc>
					</contact:addr>
				</contact:ascii>
				<contact:voice>" . $telephone . "</contact:voice>
				<contact:fax>" . $fax . "</contact:fax>
				<contact:email>" . $email . "</contact:email>
			</contact:update>
		</update>
		<clTRID>" . $clTrid . "</clTRID>
		<chksum>" . $checksum . "</chksum>
	</command>
</epp>";
		$result = sendCommand($fp, $xml);
/*		  echo "<br><textarea style='height: 290px;width: 700px;'>$xml</textarea><br>";
         echo "<br><textarea style='height: 290px;width: 700px;'>$result</textarea><br>";
*/
		if(!strstr($result, "<result code=\"1000\">"))
		{
			return getResultCode($result);
		}
		
		return 0;
	}
	
	function onlinenicModifyDomainNS($fp, $domain_type, $domain, $dns1, $dns2)
	{
		$clTrid		= getClTrid();
		$checksum	= md5(CUSTOMER_ID . PASSWORD . $clTrid . "upddomain" . $domain_type . $domain . $dns1 . $dns2);
		
		$xml = "<?xml version=\"1.0\" encoding=\"UTF-8\" standalone=\"no\"?>
<epp>
	<command>
		<update>
			<domain:update>
				<domain:type>" . $domain_type . "</domain:type>
				<domain:name>" . $domain . "</domain:name>
				<domain:rep>
					<domain:ns1>" . $dns1 . "</domain:ns1>
					<domain:ns2>" . $dns2 . "</domain:ns2>
				</domain:rep>
			</domain:update>
		</update>
		<clTRID>" . $clTrid . "</clTRID>
		<chksum>" . $checksum . "</chksum>
	</command>
</epp>";
		$result = sendCommand($fp, $xml);
		
   /*      echo "<br><textarea style='height: 290px;width: 700px;'>$xml</textarea><br>";
         echo "<br><textarea style='height: 290px;width: 700px;'>$result</textarea><br>";
     */   
		if(!strstr($result, "<result code=\"1000\">"))
		{
			return getResultCode($result);
		}
		
		return 0;
	}
	
	function onlinenicDeleteDomain($fp, $domain_type, $domain)
	{
		$clTrid		= getClTrid();
		$checksum	= md5(CUSTOMER_ID . PASSWORD . $clTrid . "deldomain" . $domain_type . $domain);
		
		$xml = "<?xml version=\"1.0\" encoding=\"UTF-8\" standalone=\"no\"?>
<epp>
	<command>
		<delete>
			<domain:delete>
				<domain:type>" . $domain_type . "</domain:type>
				<domain:name>" . $domain . "</domain:name>
			</domain:delete>
		</delete>
		<clTRID>" . $clTrid . "</clTRID>
		<chksum>" . $checksum . "</chksum>
	</command>
</epp>";
		$result = sendCommand($fp, $xml);
/*        
        echo "<br><textarea style='height: 280px;width: 600px;font-size: 14px;'>$xml</textarea><br>";
		echo "<br><textarea style='height: 280px;width: 600px;font-size: 14px;'>$result</textarea><br>";
    */    
		if(!strstr($result, "<result code=\"1000\">"))
		{
			return getResultCode($result);
		}
		
		return 0;
	}
	
	function onlinenicRenewDomain($fp, $domain_type, $domain, $year)
	{
		$clTrid		= getClTrid();
   //    $clTrid  = "asdfasdfasdfasdfasdfasdf";
		$checksum	= md5(CUSTOMER_ID . PASSWORD . $clTrid . "renewdomain" . $domain_type . $domain. $year);
		
		$xml = "<?xml version=\"1.0\" encoding=\"UTF-8\" standalone=\"no\"?>
<epp>
	<command>
		<renew>
			<domain:renew>
				<domain:type>" . $domain_type . "</domain:type>
				<domain:name>" . $domain . "</domain:name>
				<domain:period>" . $year . "</domain:period>
			</domain:renew>
		</renew>
		<clTRID>" . $clTrid . "</clTRID>
		<chksum>" . $checksum . "</chksum>
	</command>
</epp>";
      //  echo "<br><textarea style='height: 280px;width: 600px; font-size: 14px;'>$xml</textarea><br>";
		$result = sendCommand($fp, $xml);
		//echo "<br><textarea style='height: 280px;width: 600px;font-size: 14px;'>$result</textarea><br>";
		if(!strstr($result, "<result code=\"1000\">"))
		{
			return getResultCode($result);
		}
		
		return 0;
	}
?>
