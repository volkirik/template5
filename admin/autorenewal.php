<?php
include("../server.inc.php");
include(ROOT_DIR . "common/db.inc.php");
include(ROOT_DIR . "init.inc.php");
include(ROOT_DIR . "common/func.inc.php");
include(ROOT_DIR . "common/domain.inc.php");
include(ROOT_DIR . "model/class.smtp.inc");
//include(ROOT_DIR . "model/admin.domainlock.php");
//include(ROOT_DIR . "model/admin.domainmanage.php");
include(ROOT_DIR . "model/cron.autorenewal.php");

/*$lock   =   new DomainLock();
$renew  =   new DomainManage();
*/

$autorenew  =   new Autorenewal();


$sql = "select a.domain_id, a.domain_name, a.domain_type, a.add_date, a.domain_year, b.status, a.member_id
         from domains a, domain_lock b, domain_autorenew c where a.domain_name=b.domain_name and a.state=0 and
            a.domain_id=c.domain_id and c.renew_status='enabled'";

$rs = $conn->Execute ($sql);
//echo "<br> autorenewal ".$sql;
if (!$rs) 
   die();
   
   //echo "<br>Auto-renewal is enabled for:<br>";flush();
  
while ($arr = $rs->FetchRow()){
    $sql = "select to_days(date_add('".$arr[3]."', interval ".$arr[4 ]." year)) - to_days(curdate())";
	$res = $conn->Execute ($sql);
  //echo "<br><br><br>"; print_r ($arr); echo "&nbsp; &nbsp; ";
    //echo "<br><br> &nbsp; ".$arr[1];flush();
    //echo " ".$sql." ".$res->fields[0];
     if ($res->fields[0] > 0)            /// change < to > for testing. changing this will renew all
    {                                   /// domains which autorenewal is enabled and have not expired.
        if ($arr[5] == 'locked'){
            //unlock
            //echo "<br> Unlocking.. ";
            $status = $autorenew->lockDomains ('Unlock', array($arr[1]));
            if ($status == -1)
                continue;
        }
        //echo "<br>Renewing domain.. ";

        $status = $autorenew->renewDomain($arr[0], 1);
        if ($status == -1)
            continue;
        
        if ($arr[5] == 'locked'){
            //lock
            //echo "<br> Locking.. ";
            $status = $autorenew->lockDomains ('Lock', array("$arr[1]"));
            if ($status == -1)
                continue;
        }
        else {/*echo "<br> Already unlocked.. ";*/}
        // log transaction
        $sql = "select member_level from members where member_id=".$arr[6];
        $res2 = $conn->Execute ($sql);
        
        //echo "<br>start.. "; flush();
        $product_id = getProductId ($arr[1]);
        //echo "<br>P_id ".$product_id; flush();
        $product_price = getProductPrice ($product_id, $res2->fields[0], 3);
		 //echo "<br> Product price ".$product_price[1];flush();
        $mode_id = getModeID($product_id, 3);
         //echo "<br> Mode_id ".$mode_id;flush();
        $result = insertMoneyMode ($arr[6], 2, $mode_id, $product_price[1], $arr[1]);
        //echo "<br>Finished ";
        
		if($result < 0)
		{
			//echo " logging failed ";
		}else {
			if (updateFunds ($arr[6], 2, $product_price[1]) < 0)
			{
				//$this->showForm(DOMAIN_0073);
			}
		}
      
    } 
    
}



?>
