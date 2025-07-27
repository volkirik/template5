<?php 
class Autorenewal{

	function lockDomains($do='', $names=array()){
	    global $conn, $smarty;

		$lock_result = "";
        
        if (isset ($_REQUEST["lock_domains"]))
            $domains = $_REQUEST["lock_domains"];
        else
            $domains    = $names;    
	//	echo "<pre>"; print_r ($domains); echo "</pre>";


        if (isset ($_REQUEST['Submit']))
            $submit = $_REQUEST['Submit'];
        else 
            $submit     = $do;

                           
		if ($submit == 'Lock'){
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
			//$this->listDomains("Lock status: Could not connect to server.");
            //echo "Lock status: Could not connect to server.";
		}
		$result = onlinenicLogin($fp);
		if($result < 0)
		{
			$this->listDomains(DOMAIN_0056);
		}
		
		//echo $domains."tst";
        //echo $domains;
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
					
			 //echo  '<br>Lock<br> <textarea style="height: 300px; width: 500 px; border: none; ">'.$xml.'</textarea><br>';
			$lockresult = sendCommand($fp, $xml);
			if (!strstr($lockresult, "<result code=\"1000\">")){
			    //echo  'Lock Result<br> <textarea style="height: 300px; width: 500 px; border: none; ">'.$lockresult.'</textarea><br>';
			}else{
              $sql = "select domain_id from domains where domain_name='$domain_name'";
              $id = $conn->Execute ($sql);
				$sql = "update domain_lock set status='".$status."'  where domain_id=".$id->fields[0];    
				$conn->Execute ($sql);
				$lock_result .= "$domain_name ";
			}
		}
		
         if ($lock_result != ''){
            $lock_result = "Updated status of domains ".$lock_result;
            $status = 0;
		 }else {
            $lock_result = "Could not update status of domain(s)";
           $status = -1;
         }            
		$clTrid		= getClTrid();
		$checksum	= md5 (CUSTOMER_ID . PASSWORD . $clTrid . 'logout');

		$xml = '<?xml version="1.0" encoding="UTF-8" standalone="no"?>
			<epp><command><logout/><unspec/>
				<clTRID>'.$clTrid.'</clTRID>
				<chksum>'.$checksum.'</chksum>
			</command> </epp>';
		$result = sendCommand ($fp, $xml);
			
//		$this->listDomains($lock_result);
	    return $status;
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
                //$this->listDomain(DOMAIN_0076);
                //echo "Please select a domain to renew";
            }

            if($year < 1 || $year > 9)
            {
                //$this->listDomain(DOMAIN_0074);
                //echo "Please provide a valid value for year";
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
        //echo "<br>Renew ".$sql;
            $rs = $conn->Execute($sql);
            if(!$rs)
            {
                //$this->listDomain(ALL_0001);
                //echo  "Find data error ";
            }
            if($rs->RecordCount() != 1)
            {
                //$this->listDomain(ALL_0001);
            }
            if(($rs->fields[4] + $year) > 10)
            {
                //$this->listDomain(DOMAIN_0074);
                 //echo "Please provide a valid value for year ";
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
                //$this->listDomain(DOMAIN_0075);
                //echo "<br> &nbsp; Your balance is not sufficient to renew domain ";
                return -1;
            }

            if(connectRegServer($fp) < 0)
            {
                //$this->listDomain(DOMAIN_0056);
                //echo "<br> &nbsp; Connect server fail";
                return -1;
            }
            $result = onlinenicLogin($fp);
            if($result < 0)
            {
                //$this->listDomain(DOMAIN_0056);
                //echo "<br> &nbsp; login to server failed ";
                return -1;
            }
            //echo " <br> &nbsp; Renewing $domain ";
            
            $result = onlinenicRenewDomain(	$fp,		$domain_type,		$domain,
                            $year);
            if($result != 0)
            {
                if($result == 2303)
                {
                    $sql = "update domains set state = 1 where domain_id = " . $domain_id;
                    $rs = $conn->Execute($sql);
                    //echo "2303".$sql;
                    if(!$rs)
                    {
                        //$this->listDomain(DOMAIN_0077);
                        //echo " <br> Renew domain fail<br>";
                        return -1;
                    }
                }

            //    $this->listDomain(DOMAIN_0077);
                //echo "<br> Renew domain fail<br>";
                return -1;
            }

            $result = insertMoneyMode($member_id, 2, $mode_id, $product_price[$year], $domain);
            if($result < 0)
            {
                //$this->listDomain(DOMAIN_0078);
                //echo "<br> Renew domain successfully<br>";
            }else {
                if(updateFunds($member_id, 2, $product_price[$year]) < 0)
                {
                    //$this->listDomain(DOMAIN_0078);
                    //echo "<br> Renew domain successfully<br>";
                }
            }

            $sql = "update domains set domain_year = domain_year + ".$year." where domain_id=".$domain_id;
            //echo $sql;
            $rs = $conn->Execute($sql);
            if(!$rs)
            {
              //  $this->listDomain(DOMAIN_0078);
                //echo "<br> Renew domain successfully<br>";
            }
            //echo "<br> Renew domain successfully<br>";
            //$this->listDomain(DOMAIN_0078);
            return 0;
        }
        
}
?>
