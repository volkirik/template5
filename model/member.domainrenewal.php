<?php
class DomainRenewal
{
	function listDomains($message="")
	{
		global $conn, $smarty;
		
        $gtld =     handleData($_REQUEST["gtld"]);
		$member_name = handleData($_REQUEST["member_name"]);
		$renew =     handleData($_REQUEST["renew_status"]);
		$domain =   handleData($_REQUEST["domain"]);
		
        		
        $admin = new MemberLogin();
        $member_info = $admin->checkLogin();
                
        $sql = "select domain_id, domain_name from domains where state=0 ";
        
		$rs = $conn->Execute($sql);
		if(!$rs)
			showAdminErrorMsg($conn->ErrorMsg());
		
		while (!$rs->EOF){
			$sql = "select id from domain_autorenew where domain_id=".$rs->fields[0];
			$id = $conn->Execute ($sql);
			if (!$id->fields){
				$sql = "insert into domain_autorenew (domain_id)
				     values (".$rs->fields[0].")";
			    $rs1 = $conn->Execute($sql);
			}
		    $rs->MoveNext();
		}	

		$select = "select distinct  b.domain_name, a.renew_status, 
                     date_add(b.add_date, interval b.domain_year year) ";
        $from = ' from domain_autorenew a, domains b ';    
		$where = ' where b.state=0 and b.domain_id=a.domain_id and b.member_id='.$member_info[0];
		
        if ($gtld){
		    $where .= " and d.product_id=$gtld and d.domain_type=b.domain_type ";
            $from .= " , products d ";
        }
		if ($member_name){
		    $where .= " and c.member_name='".$member_name."' and c.member_id=b.member_id";
            $from .= " , members c ";
        }
		if ($renew == 'enabled' || $renew == 'disabled')
		    $where .= " and a.renew_status='".$renew."' ";
		if ($domain)
		    $where .= " and b.domain_name='".$domain."' and b.domain_id=a.domain_id";
            
		$sql = $select.$from.$where;
				
        $rs = $conn->Execute ($sql);
       // echo "<pre>$sql<br>";print_r ($rs->fields); echo "</pre>";
		if (!$rs)
		    showAdminErrorMsg($conn->ErrorMsg());

//		echo "<pre>$sql<br>";print_r ($rs->fields); echo "</pre>";
		
		$currentPage = $_GET["currentPage"];
		initPage($rs, PAGE_SIZE, $currentPage, $pageCount, $totalRecord);
		
		$sql = "select * from products where flag = 0 and product_type = 1";
		$products = $conn->Execute($sql);

		if(!$products)
			showErrorMsg($conn->ErrorMsg());
		
		$tld = array();
		while(!$products->EOF)
		{   array_push ($tld, array ($products->fields[1], $products->fields[3])) ;
			$products->MoveNext();
		}
	
		include(ROOT_DIR . "templates/" . CURRENT_SKIN . "/title.inc.php");
		include(ROOT_DIR . "templates/" . CURRENT_SKIN . "/admin.domainrenewal.form.php");
		include(ROOT_DIR . "templates/" . CURRENT_SKIN . "/admin.tail.inc.php");
		
		$smarty->display(CURRENT_THEME.'/page.structure.tpl');
		//showAlertMsg($message);
		die();
	}
	
	function renewDomains(){
	    global $conn, $smarty;
		
		$domains = array();
		$domains = $_REQUEST["renew_domains"];
	
		
		$lock_result = "";
		
		if ($_REQUEST['submit1']){
		    $renew = '<domain:add>
						<domain:status s="autoRenew"/>
					</domain:add>';
			$status = 'enabled';
        }else if($_REQUEST['submit2']){
		    $renew = '<domain:rem>
						<domain:status s="autoRenew"/>
					</domain:rem>';
			$status = 'disabled';
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
		
	    if(is_array($domains)){		
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
					'.$renew.'
				</domain:update>
			</update>
			<clTRID>'.$clTrid.'</clTRID>
			<chksum>'.$checksum.'</chksum>
		</command>
    </epp>';
					
			 //echo  '<br>Query<br> <textarea style="height: 300px; width: 500 px; border: none; ">'.$xml.'</textarea><br>';
			$renewresult = sendCommand($fp, $xml);
			if (!strstr($renewresult, "<result code=\"1000\">")){
			    //echo  '<br>Result<br> <textarea style="height: 300px; width: 500 px; border: none; ">'.$renewresult.'</textarea><br>';
			}else{
                $sql = "select domain_id from domains where domain_name='$domain_name'";
                $id = $conn->Execute ($sql);
				$sql = "update domain_autorenew set renew_status='".$status."' where domain_id=".$id->fields[0];    
/*				echo $sql;*/
         //        echo  '<br>Result<br> <textarea style="height: 300px; width: 500 px; border: none; ">'.$renewresult.'</textarea><br>';
                $conn->Execute ($sql);
				$renew_result .= "$domain_name ";
			}
		}
	     }  	
		
        if ($renew_result != '')
            $renew_result = "Updated status of domain(s) ".$renew_result;
		else
            $renew_result = "Could not update status of the domains";
            
		$clTrid		= getClTrid();
		$checksum	= md5 (CUSTOMER_ID . PASSWORD . $clTrid . 'logout');

		$xml = '<?xml version="1.0" encoding="UTF-8" standalone="no"?>
			<epp><command><logout/><unspec/>
				<clTRID>'.$clTrid.'</clTRID>
				<chksum>'.$checksum.'</chksum>
			</command> </epp>';
		$result = sendCommand ($fp, $xml);
			//echo "<pre>"; print_r ($domains); echo "$renew_result</pre>";
		$this->listDomains($renew_result);
	
	}
	
	
}
?>
