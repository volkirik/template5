<?php

 class DomainSync{

    function showForm($message){
	    global $conn, $smarty;
		
		$sql = "select * from products where flag = 0 and product_type = 1";
		$rs = $conn->Execute($sql);
		if(!$rs)
			showAdminErrorMsg($conn->ErrorMsg());

		include(ROOT_DIR . "templates/" . CURRENT_SKIN . "/admin.title.inc.php");
		include(ROOT_DIR . "templates/" . CURRENT_SKIN . "/admin.domainsync.form.php");
		include(ROOT_DIR . "templates/" . CURRENT_SKIN . "/admin.tail.inc.php");
		
		$smarty->display (CURRENT_THEME.'/page.structure.tpl');
		die();	
    } 
 
    function syncWhois (){
	    global $conn, $smarty;
		
		$user_name = $_REQUEST["username"];
		$domain    = $_REQUEST["domain"];
		$gtld      = $_REQUEST["gtld"];
		//echo "<br> test ";print_r($_REQUEST);	
		if ($user_name == '' || $domain == '' || $gtld == ''){
		    $this->showForm("Please input valid username and domain name");
		}
		$sql = "select member_id, member_name from members where member_name='".$user_name."'";
		$rs = $conn->Execute ($sql);
		//echo "<br> sql ".$sql; 
		$rows =  $conn->Affected_Rows( );
		//echo "<br>rows".$rows;
					
		if ($rows){
    		$info = getProductInfo ($gtld);
			//print_r($info);
			$real_domain = $_REQUEST['domain'].$info[3];

    		$result = $this->getWhois ($real_domain, $gtld);
	//	 echo '<br>Test result<textarea style="height: 300px; width: 500 px; border: none; ">'.$result.'</textarea><br><br>';

// 		echo "<br> test result ..."; print_r($result);
//    	    	echo "<br> test code ...";print_r($code);
		ereg ("(<result code=\")([0-9]{4})(\">)", $result, $code);
           //  echo "<br> test code 2 ...".$code[2];			
			if ($code[2] == 1000){
				$this->getFields ($result, $contacts);
				$update_result = $this->updateDB ($contacts);
	//			echo "<br> test result updated ...";print_r($update_result);
			}else if ($code[2] == 2400){
				 $this->showForm ("Could not find the specified domain under the reseller");
			}else {
 		 //       echo '<br>Whois failed<br><textarea style="height: 300px; width: 500 px; border: none; ">'.$result.'</textarea><br><br>';
				$this->showForm ("Could not get the specified information from the server");
			}
	    }else {
			$warning = "Could not find the specified user in the database";
			$update_result = "Domain sync failed";
	    }

		include(ROOT_DIR . "templates/" . CURRENT_SKIN . "/admin.title.inc.php");
		include(ROOT_DIR . "templates/" . CURRENT_SKIN . "/admin.domainsync.result.php");
		include(ROOT_DIR . "templates/" . CURRENT_SKIN . "/admin.tail.inc.php");

		$smarty->display(CURRENT_THEME.'/page.structure.tpl');
		die();	
	
	}
	
	function getWhois ($domain_name, $gtld){
	    global $conn, $smarty;
		
		if(connectRegServer($fp) < 0)    
		    $this->showForm("Connection to server failed<br>");
	
		$clTrid		= getClTrid();
		$checksum	= md5(CUSTOMER_ID . PASSWORD . $clTrid . "login");
        
		$info = getProductInfo ($gtld);
		
		$xml = '<?xml version="1.0" encoding="UTF-8" standalone="no"?>
			<epp>
			<command>
			<creds>
				<clID>' . CUSTOMER_ID . '</clID>
				<options>
					<version>1.0</version>
				</options>
			</creds>
			<clTRID>'. $clTrid . '</clTRID>
				<login>
					<chksum>' .$checksum . '</chksum>
				</login>
				</command>
			</epp>'; 

		//		echo "Login request<br> <textarea style='height: 270px; width: 500 px; border: none; '>$xml</textarea><br>";
		if ( ($result = onlinenicLogin($fp)) < 0) {
		   // echo "Login failed<br> <textarea style='height: 270px; width: 500 px; border: none; '>$result</textarea><br>";
			$this->showForm ("Login failed");
		}
		//else  echo "Login: Success<br>";

		///// domain WHOIS

		$clTrid		= getClTrid();
		$checksum	= md5(CUSTOMER_ID . PASSWORD . $clTrid . "getdomaininfo");

		$xml = '<?xml version="1.0" encoding="UTF-8" standalone="no"?>
		    <epp><command>
				<getdomaininfo>
					<clID>'.CUSTOMER_ID.'</clID>
					<domain>'.$domain_name.'</domain>
					<domain:type>'.$info[2].'</domain:type>
					<options>
						<version>1.0</version>
						<lang>en</lang>
					</options>
				</getdomaininfo>
				<clTRID>'.$clTrid.'</clTRID><chksum>'.$checksum.'</chksum></command></epp>';

	/*	echo "<br>WHOIS<br>
			<textarea style='height: 235px; width: 500 px; border: none; '>$xml</textarea><br>";
*/
		$whois_result = sendCommand($fp, $xml);
	/*	echo '<br>Whois Result <br>
				<textarea style="height: 300px; width: 500 px; border: none; ">'.$whois_result.'</textarea><br><br>';
*/
		if ($whois_result == ""){ 
		   $this->showForm ("Whois failed");
		}

		///// LOGOUT  ///

		$clTrid		= getClTrid();
		$checksum	= md5 (CUSTOMER_ID . PASSWORD . $clTrid . 'logout');

		$xml = '<?xml version="1.0" encoding="UTF-8" standalone="no"?>
			<epp><command><logout/><unspec/>
				<clTRID>'.$clTrid.'</clTRID>
				<chksum>'.$checksum.'</chksum>
			</command> </epp>';
			
        $result = sendCommand ($fp, $xml);
	/*	if ($result != "")
            echo "Logout: Success ";
		else
            echo "Logout: Failed ";
    */
	    return $whois_result;
	}
 
	function getFields ($result, &$c){
	    global $conn, $smarty;
		
		ereg ("(<regdate>)(.*)(</regdate>)", $result, $val);
	    	$c[0]['regdate'] = $val[2];
		ereg ("(<expdate>)(.*)(</expdate>)", $result, $val);
	    	$c[0]['expdate'] = $val[2];
		ereg ("(<dns1>)(.*)(</dns1>)", $result, $val);
		    $c[0]['dns1'] = $val[2]; 
		ereg ("(<dns2>)(.*)(</dns2>)", $result, $val);
		    $c[0]['dns2'] = $val[2];
		ereg ("(<pwd>)(.*)(</pwd>)", $result, $val);
		    $c[0]['pwd'] = $val[2];
		
		ereg ("(<r_name>)(.*)(</r_name>)", $result, $val);
	    	$c[1][] = $val[2];
		ereg ("(<r_org>)(.*)(</r_org>)", $result, $val);
	    	$c[1][] = $val[2];
        ereg ("(<r_cc>)(.*)(</r_cc>)", $result, $val);
		    $c[1][] = $val[2];
		ereg ("(<r_sp>)(.*)(</r_sp>)", $result, $val);
		    $c[1][] = $val[2];
		ereg ("(<r_city>)(.*)(</r_city>)", $result, $val);
		    $c[1][] = $val[2];
		ereg ("(<r_addr>)(.*)(</r_addr>)", $result, $val);
		    $c[1][] = $val[2];
		ereg ("(<r_pc>)(.*)(</r_pc>)", $result, $val);
		    $c[1][] = $val[2];
		ereg ("(<r_phone>)(.*)(</r_phone>)", $result, $val);
		    $c[1][] = $val[2];
		ereg ("(<r_fax>)(.*)(</r_fax>)", $result, $val);
		    $c[1][] = $val[2];
		ereg ("(<r_email>)(.*)(</r_email>)", $result, $val);
		    $c[1][] = $val[2];
		
		
		ereg ("(<a_name>)(.*)(</a_name>)", $result, $val);
	    	$c[2][] = $val[2];
		ereg ("(<a_org>)(.*)(</a_org>)", $result, $val);
	    	$c[2][] = $val[2];
        ereg ("(<a_cc>)(.*)(</a_cc>)", $result, $val);
		    $c[2][] = $val[2];
		ereg ("(<a_sp>)(.*)(</a_sp>)", $result, $val);
		    $c[2][] = $val[2];
		ereg ("(<a_city>)(.*)(</a_city>)", $result, $val);
		    $c[2][] = $val[2];
		ereg ("(<a_addr>)(.*)(</a_addr>)", $result, $val);
		    $c[2][] = $val[2];
		ereg ("(<a_pc>)(.*)(</a_pc>)", $result, $val);
		    $c[2][] = $val[2];
		ereg ("(<a_phone>)(.*)(</a_phone>)", $result, $val);
		    $c[2][] = $val[2];
		ereg ("(<a_fax>)(.*)(</a_fax>)", $result, $val);
		    $c[2][] = $val[2];
		ereg ("(<a_email>)(.*)(</a_email>)", $result, $val);
		    $c[2][] = $val[2];
		
		ereg ("(<t_name>)(.*)(</t_name>)", $result, $val);
	    	$c[3][] = $val[2];
		ereg ("(<t_org>)(.*)(</t_org>)", $result, $val);
	    	$c[3][] = $val[2];
        ereg ("(<t_cc>)(.*)(</t_cc>)", $result, $val);
		    $c[3][] = $val[2];
		ereg ("(<t_sp>)(.*)(</t_sp>)", $result, $val);
		    $c[3][] = $val[2];
		ereg ("(<t_city>)(.*)(</t_city>)", $result, $val);
		    $c[3][] = $val[2];
		ereg ("(<t_addr>)(.*)(</t_addr>)", $result, $val);
		    $c[3][] = $val[2];
		ereg ("(<t_pc>)(.*)(</t_pc>)", $result, $val);
		    $c[3][] = $val[2];
		ereg ("(<t_phone>)(.*)(</t_phone>)", $result, $val);
		    $c[3][] = $val[2];
		ereg ("(<t_fax>)(.*)(</t_fax>)", $result, $val);
		    $c[3][] = $val[2];
		ereg ("(<t_email>)(.*)(</t_email>)", $result, $val);
		    $c[3][] = $val[2];
			
		ereg ("(<b_name>)(.*)(</b_name>)", $result, $val);
	    	$c[4][] = $val[2];
		ereg ("(<b_org>)(.*)(</b_org>)", $result, $val);
		    $c[4][] = $val[2];
        ereg ("(<b_cc>)(.*)(</b_cc>)", $result, $val); //2
		    $c[4][] = $val[2];
		ereg ("(<b_sp>)(.*)(</b_sp>)", $result, $val);
		    $c[4][] = $val[2];
		ereg ("(<b_city>)(.*)(</b_city>)", $result, $val);
		    $c[4][] = $val[2];                //4
		ereg ("(<b_addr>)(.*)(</b_addr>)", $result, $val);
		    $c[4][] = $val[2];
		ereg ("(<b_pc>)(.*)(</b_pc>)", $result, $val);
		    $c[4][] = $val[2];
		ereg ("(<b_phone>)(.*)(</b_phone>)", $result, $val);
		    $c[4][] = $val[2];
		ereg ("(<b_fax>)(.*)(</b_fax>)", $result, $val);    //8
		    $c[4][] = $val[2];
		ereg ("(<b_email>)(.*)(</b_email>)", $result, $val);
	    	$c[4][] = $val[2];
	//echo "<pre>"; print_r ($c); echo "</pre>";
	}
	
	function updateDB ($c){
	    global $conn, $smarty, $update_result;
		
		$info = getProductInfo ($_REQUEST['gtld']);
		$domain_name = $_REQUEST['domain'].$info[3];
		$sql = "select * from domains where domain_name='".$domain_name."'";
		//echo $sql.'<br>';
		$rs = $conn->Execute ($sql);
		$rows =  $conn->Affected_Rows ();
	
		$sql = "select member_id, member_level from members where member_name='".$_REQUEST['username']."'";
		$res_id = $conn->Execute($sql);
		$member_id = $res_id->fields[0];
		$member_level = $res_id->fields[1];
		ereg ("([0-9/]{6})([0-9]{4})", $c[0]['regdate'], $year1);
		ereg ("([0-9/]{6})([0-9]{4})", $c[0]['expdate'], $year2);
		$year = $year2[2] - $year1[2];
//		echo "<br>domain year".$year." <br>";	
		$sql = "select price from member_price where member_level=$member_level and 
		        i_year=$year and product_id=$info[1]";
 
		$res = $conn->Execute($sql);
		$price = $res->fields[0];
	//	echo "<br> sql ".$sql."**price **".$price;		
       /* $rs_price = getProductPrice ($info[1], $member_level, 5);
        $price = $rs_price[$year];
	*/	//echo $sql."<br>".$price." price".$rows;
        if(!$rows){
		//echo "<br> testing phase 1";
            for ($i=1; $i <= 4; $i++){
				$sql = "insert into contacts (password, reg_name, org, address1,
				        address2, address3, city, province, country, postalcode,
						 telephone, fax, email) values
				   ('".$c[0]['pwd']."', '".$c[$i][0]."','".$c[$i][1]."', '".$c[$i][5]
				   ."', '', '', '".$c[$i][4]."','".$c[$i][3]."', '".$c[$i][2]."', '".
				    $c[$i][6]."', '".$c[$i][7]."', '".$c[$i][8]."', '".$c[$i][9]."')";
				
				$res = $conn->Execute($sql);
				if (!$res) $this->showForm (" Could not update contacts table<br>");
				$id[$i-1] = $conn->Insert_ID();
			}
			ereg ("([0-9]{2})/([0-9]{2})/([0-9]{4})", $c[0]['regdate'], $res);
		    $add_date = "$res[3]-$res[1]-$res[2] 00:00:00";
			
			$sql = "insert into domains 
			            (member_id, domain_name, domain_type, product_type, domain_password,
						add_date, domain_year, domain_dns1, domain_dns2,
						registrant, admin, tech, billing, state, amount)
    			values (".$member_id.",'".$domain_name."', '". $info[2]."', '".
				$info[1]."', '".$c[0]['pwd']."', '".$add_date."', '".$year."', '".$c[0]['dns1']."', '".
				$c[0]['dns2']."', '".$id[0]."', '".$id[1]."', '".$id[2]."', '".$id[3]."', '".
				"0"."','".$price."')";

				$res = $conn->Execute($sql);
                //echo $sql." insert into ";
				if (!$res) 
				    $this->showForm (" Could not update domains table .<br>");
               $update_result = "<b>Domain sync completed for domain ".$domain_name.'<b>';
		}else {
	/*		echo "<br> testing phase 2";
			echo "<br>";
			print_r($c);
			echo "<br>";			*/
			for ($i=1, $j=10; $i <= 4; $i++, $j++){
			
				$sql = "update contacts set password='".$c[0]['pwd']."', reg_name='".$c[$i][0]."',
				 org='".$c[$i][1]."', address1='".$c[$i][5]."', address1='', address2='', 
				 city='".$c[$i][4]."', province='".$c[$i][3]."', country='".$c[$i][2]
				 ."', postalcode='".$c[$i][6]."', telephone='".$c[$i][7]."',fax='".
				 $c[$i][8]."', email='".$c[$i][9]."' where contact_id='".$rs->fields[$j]."'";
				//echo $sql;
				//echo "<br>";	
				$res = $conn->Execute($sql);
				if (!$res) 
				    $this->showForm (" Could not update contacts table<br>");
		    }
			//echo "<br> reg date".$c[0]['regdate'];
			ereg ("([0-9]{2})/([0-9]{2})/([0-9]{4})", $c[0]['regdate'], $res);
		    $add_date = "$res[3]-$res[1]-$res[2] 00:00:00";
			//echo "<br>".$add_date;	
			$sql ="update domains set member_id='".$member_id."', domain_name='". $domain_name."', 
			        domain_type='".$info[2]."', product_type='".$info[1]."', 
					domain_password='".$c[0]['pwd']."', add_date='".$add_date."', 
					domain_year='".$year."', domain_dns1='".$c[0]['dns1']."', 
					domain_dns2='".$c[0]['dns2']."', state=0, amount='".$price."' 
					where domain_name='".$domain_name."'";
					
                   //echo "<br>".$sql." update domains ";
			$res = $conn->Execute($sql);
			if (!$res)
			     $this->showForm (" Could not update domains table<br>");
            $update_result = "<b>Domain sync completed for domain ".$domain_name.'<b>';
		}
        
                
		$product_price = getProductPrice($info[1], $member_level, 4);
//		echo "<br> product_price ***" .$product_price."<br>";
		 //echo "Started";
        $mode_id = getModeID($info[1], 5);
	//echo "<br>mode_id  ***" .$mode_id."<br>";
         //echo "Almost Finished";
//	echo "<br>product_price array******<br>";print_r($product_price);echo "<br>product_price array******<br>";
        $result = insertMoneyMode($member_id, 2, $mode_id, $product_price[1], $domain_name);
        //echo "Finished";
		if($result < 0)
		{
			$this->showForm(DOMAIN_0073);
		}else {
			if(updateFunds($member_id, 2, $product_price[1]) < 0)
			{
				$this->showForm(DOMAIN_0073);
			}
		}
        
	    return $update_result;
    }                               //End of updateDB
 
 }

?>
