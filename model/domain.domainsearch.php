<?php
class RegisterDomain
{
	function showCheckForm($message=""){
		global $conn, $smarty,  $currentuser;
		
		$sql = "select * from products where flag = 0 and product_type = 1";
		$rs = $conn->Execute($sql);
		
		if(!$rs)
		{  
			flagErrorMsg($conn->ErrorMsg());
		}
       unset ($_SESSION['regdomains']);
   
       $user_info = $currentuser->checkAdminLogin();
       $smarty->assign('RELA_DIR', RELA_DIR);
       $smarty->assign('CAPTCHA_ENABLE', CAPTCHA_ENABLE);
        if($user_info == -1) {
            include(ROOT_DIR . "templates/" . CURRENT_SKIN . "/title.inc.php");
        } else {
            include(ROOT_DIR . "templates/" . CURRENT_SKIN . "/admin.title.inc.php");
            $smarty->assign('IS_ADMIN', true);
	}
		include(ROOT_DIR . "templates/" . CURRENT_SKIN . "/domain.searchdomains.form.php");
		include(ROOT_DIR . "templates/" . CURRENT_SKIN . "/admin.tail.inc.php");
		$smarty->display(CURRENT_THEME.'/page.structure.tpl');
		die();
	}

    function checkDomain(){
       global $conn, $smarty, $currentuser;
       
        $user_info = $currentuser->checkAdminLogin();
//	print_r($_REQUEST);       
       $domains = array();
       $domains = split ("[\n,]", $_REQUEST['domains_list']);

       foreach ($domains as $key => $val)
            $domains[$key]  =   strtolower(handleData($val));
		 
                
       $gtlds = $_REQUEST['gtlds'];
//	echo "<br> test " .$gtlds;
//	echo "<br> test domains ";print_r($domains);
       $keystring = isset($_REQUEST['keystring']) ? $_REQUEST["keystring"] : '';
       if($gtlds == 0)
		{
			$this->showCheckForm(DOMAIN_0068);
		}
		if($domains == "")
		{
			$this->showCheckForm(DOMAIN_0069);
		}
		if(CAPTCHA_ENABLE===1 && $user_info == -1 && (!isset($_SESSION['OSOLmulticaptcha_keystring']) || $_SESSION['OSOLmulticaptcha_keystring'] !== $keystring)){
			$this->showCheckForm(ALL_0006);
		}
       $sql = "select product_id, domain_type, product_name from products where flag = 0 and product_type = 1";
		$rs = $conn->Execute ($sql);
       $search_res = array();
       $failed_domains = array();
		if(!$rs)
			flagErrorMsg ($conn->ErrorMsg());
       
        
        foreach ($domains as $key => $val){
            
            if (strlen ($val) > 63)
                continue;
            
            if(onlinenicValidateDomain ($val))
                continue;
           
            while ($ids = $rs->FetchRow()){

                $real_domain	= $val . $ids[2];
                $domain_type	= $ids[1];
  ////////////////       
                if(connectRegServer($fp) < 0)
                    $this->showCheckForm(DOMAIN_0056);

                $result = onlinenicLogin($fp);
                if($result < 0)
                {
                   array_push ($failed_domains, array ($real_domain,0));
                   continue;
                }
 /////////////////           
                $result = onlinenicCheckDomain ($fp, $real_domain, $domain_type);
                
                if($result < 0){
                   array_push ($failed_domains, array ($real_domain, $result ));
                }else if ($result == 1){
                 
                    if ((array_search ($ids[0], $gtlds) != FALSE) || ($ids[0] == $gtlds[0]))
                       array_push ($failed_domains, array ($real_domain, 1));
                }else if ($result == 0){
                  
                    if ((array_search ($ids[0], $gtlds) == FALSE) && ($ids[0] != $gtlds[0]))
                        $recommended = 1;
                    else 
                        $recommended = 0;
                    array_push ($search_res, array ($real_domain, $recommended));
                }
            }
            $rs->MoveFirst();
        }

       $sql = "select * from products where flag = 0 and product_type = 1";
		$rs = $conn->Execute($sql);
		 
		if(!$rs)
			flagErrorMsg($conn->ErrorMsg());
        
        if($user_info == -1)
            include(ROOT_DIR . "templates/" . CURRENT_SKIN . "/title.inc.php");
        else
            include(ROOT_DIR . "templates/" . CURRENT_SKIN . "/admin.title.inc.php");
        
        include(ROOT_DIR . "templates/" . CURRENT_SKIN . "/domain.searchdomains.result.php"); 
		include(ROOT_DIR . "templates/" . CURRENT_SKIN . "/admin.tail.inc.php");
		$smarty->display(CURRENT_THEME.'/page.structure.tpl');
		die();
	}

    function selectMember($message=""){
        global $conn, $smarty, $currentuser;
    
        $user_info = $currentuser->checkAdminLogin();
        
        if (!isset($_SESSION['domain_list'])){
             $_SESSION['domain_list'] = $_REQUEST['domains'];
        }     

        
        if($user_info == -1){ 
        //echo "admin not logged in..";
            $user_info = $currentuser->checkLogin();
            if ($user_info == -1){
                //login/new account page.. 
                //echo "user not logged in.."; 
                
                $_SESSION['newsignup'] = "newmember";
                //echo "select Member, session newsignup set:  ". $_SESSION['newsignup'];
                
                include(ROOT_DIR . "templates/" . CURRENT_SKIN . "/title.inc.php");
                include(ROOT_DIR . "templates/" . CURRENT_SKIN . "/member.showlogin.php");
                include(ROOT_DIR . "templates/" . CURRENT_SKIN . "/tail.inc.php");
                $smarty->display(CURRENT_THEME.'/page.structure.tpl');
            }else{    //user logged in
                //echo "user logged in..";
             
                $this->addDomains ("");   //price
             
            }
        }else{ // admin logged in
            //select user
            if (isset($_REQUEST['selectUser'])){
                $member_name	= handleData($_REQUEST["member_name"]);
                $sql = "select * from members where member_name ='" . handleSQLData($member_name) . "'";
                $rs = $conn->Execute($sql);
                
                if(!$rs)
                    $message = ALL_0001;
                else if($rs->RecordCount() != 1)
                    $message = ADMIN_0005;
                else{
                    $_SESSION['selected_user'] = $member_name;
                   
                    $this->addDomains ("");
                    return;
                }
            }
          
            include(ROOT_DIR . "templates/" . CURRENT_SKIN . "/admin.title.inc.php");
            include(ROOT_DIR . "templates/" . CURRENT_SKIN . "/admin.selectuser.php");
          
            include(ROOT_DIR . "templates/" . CURRENT_SKIN . "/admin.tail.inc.php");
            $smarty->display(CURRENT_THEME.'/page.structure.tpl');
            
        }
    
    }   
    
    function addDomains ($message=""){
        global $conn, $smarty, $currentuser;
         
         $user_info = $currentuser->checkAdminLogin();
        if($user_info == -1)
            include(ROOT_DIR . "templates/" . CURRENT_SKIN . "/title.inc.php");
        else
            include(ROOT_DIR . "templates/" . CURRENT_SKIN . "/admin.title.inc.php");  
            
        include(ROOT_DIR . "templates/" . CURRENT_SKIN . "/domain.adddomain.list.php"); 
        include(ROOT_DIR . "templates/" . CURRENT_SKIN . "/admin.tail.inc.php");
		$smarty->display(CURRENT_THEME.'/page.structure.tpl');
    }
    
    function remDomain (){
        global $conn, $smarty, $currentuser;
        
        $list = $_SESSION['regdomains'];
        $name = $_REQUEST['name'];
        $newlist = array();
        
        foreach ($list as $key => $val){
            if ($val[0] != $name)
                array_push ($newlist, $val);
        }
        $_SESSION['regdomains'] = $newlist;
        
        $user_info = $currentuser->checkAdminLogin();
        if($user_info == -1)
            include(ROOT_DIR . "templates/" . CURRENT_SKIN . "/title.inc.php");
        else
            include(ROOT_DIR . "templates/" . CURRENT_SKIN . "/admin.title.inc.php");  

                
        include(ROOT_DIR . "templates/" . CURRENT_SKIN . "/domain.adddomain.list.php"); 
        include(ROOT_DIR . "templates/" . CURRENT_SKIN . "/admin.tail.inc.php");
		$smarty->display(CURRENT_THEME.'/page.structure.tpl');
    }

    function recalculate(){
        global $conn, $smarty, $currentuser;
       
        $yrs = $_REQUEST['yrs'];
        
        //echo "<pre> Years: "; print_r ($yrs);  echo "</pre>"; 
        
        foreach ($yrs as $key => $val){
            $_SESSION['regdomains'][$key][1] = $val;
        }
        
        $user_info = $currentuser->checkAdminLogin();
        if($user_info == -1)
            include(ROOT_DIR . "templates/" . CURRENT_SKIN . "/title.inc.php");
        else
            include(ROOT_DIR . "templates/" . CURRENT_SKIN . "/admin.title.inc.php");  

        include(ROOT_DIR . "templates/" . CURRENT_SKIN . "/domain.adddomain.list.php"); 
        include(ROOT_DIR . "templates/" . CURRENT_SKIN . "/admin.tail.inc.php");
		$smarty->display(CURRENT_THEME.'/page.structure.tpl');    
    }
    
/*    function showResult ($search_res, $failed_domains){
        global $conn, $smarty;
        
    }
*/    
    function checkLogin(){
        global $conn, $smarty, $currentuser;
        
        //echo " checkLogin "; print_r($_SESSION); echo "end";
        $user = $_REQUEST['username'];
        $pass = $_REQUEST['password'];
        
        $result = $this->login ($user, $pass);
        if ($result != -1)
            $this->selectMember ('');
    }
    
    function login ($username, $password){
		global $conn;
		global $member_info, $currentuser;
		
		if($username == "" || strlen ($username) > 20 || checkAscii ($username)){
			$this->selectMember(MEMBER_0021);
            return -1;
        }  
         
		if ($password == "" || strlen($password) > 20  || checkAscii($password)){
			$this->selectMember(MEMBER_0022); 
            return -1;
        }
		
		if(checkNumeric($username))
		{
			$sql = "select
					member_id,		flag
				from	members
				where	member_name='" . $username . "'
					and member_password='" . handleSQLData(md5($password)) . "'";
			$rs = $conn->Execute($sql);
            
			if(!$rs)
			{
				$this->selectMember(ALL_0001);
                return -1;
			}

            if($rs->RecordCount() != 1)
			{
				$this->selectMember(MEMBER_0023);
                return -1;
			}
            
			if($rs->fields[1] != 0)
			{
				$this->selectMember(MEMBER_0024);
                return -1;
			}
	
			$sql = "insert into sessions(
					member_id,		login_type,		remote_addr,
					last_access_time
				)values(
					" . $rs->fields[0] . ", 1, '" .			$_SERVER["REMOTE_ADDR"] . "', '" .
					getDateTime() .
				"')";
			$rs = $conn->Execute($sql);
			if(!$rs)
			{
				$this->selectMember(ALL_0005);
                return -1;
			}
			$_SESSION["sessionID"] = $conn->Insert_ID();
            $_SESSION['selected_user'] = $username;
		}else {
			$sql = "select
					admin_id,		flag
				from	admins
				where	admin_id=" . $username . "
					and password='" . handleSQLData($password) . "'";
			$rs = $conn->Execute($sql);
			if(!$rs)
			{
				$this->selectMember(ALL_0001);
                return -1;
			}
            
			if($rs->RecordCount() != 1)
			{
				$this->selectMember(MEMBER_0023);
                return -1;
			}
            
			if($rs->fields[1] != 0)
			{
				$this->selectMember(MEMBER_0024);
                return -1;
			}
	
			$sql = "insert into sessions(member_id, login_type, remote_addr, last_access_time
					last_access_time )values(" . $rs->fields[0] . ", 2, '" .
				    $_SERVER["REMOTE_ADDR"] . "', '" . getDateTime() . "')";
			$rs = $conn->Execute($sql);
			if(!$rs)
			{
				$this->selectMember(ALL_0005);
                return -1;
			}
			$_SESSION["sessionID"] = $conn->Insert_ID();
			$_SESSION['user'] = 'admin';
			$_SESSION['login_name'] = $username;
            
		}
        return 0;
	}


    function showPaymentInfo($message=""){
        global $conn, $member_info, $currentuser;
        
        $user   =   $_SESSION['selected_user'];
   
        if ($message != ''){
        
            $method =   handleData($_REQUEST["payment_method"]);
            
            if ($method == 'paypal'){
                $pp_checked    = 'checked';
            }else{
                $cc_checked     = 'checked';
            }
            $pp_email      = handleData($_REQUEST["pp_email"]);
            
            $cc_name		= handleData($_REQUEST["cc_name"]);
            $cc_num	    	= handleData($_REQUEST["cc_num"]);
            $exp_date		= handleData($_REQUEST["exp_date"]);
            $exp_year		= handleData($_REQUEST["exp_year"]);
            $cc_user		= handleData($_REQUEST["cc_user"]);
            $cc_id	    	= handleData($_REQUEST["cc_id"]);
            $cc_email		= handleData($_REQUEST["cc_email"]);
            $cc_addr		= handleData($_REQUEST["cc_addr"]);
            $cc_city		= handleData($_REQUEST["cc_city"]);
            $cc_state		= handleData($_REQUEST["cc_state"]);
            $cc_zip     	= handleData($_REQUEST["cc_zip"]);
            $cc_country     = handleData($_REQUEST["cc_country"]);
            $cc_tel         = handleData($_REQUEST["cc_tel"]);
            $cc_fax         = handleData($_REQUEST["cc_fax"]); 
        }else{
            
            $sql = "select a.* from payment_info a, members b where b.member_name = '$user' 
                        and a.member_id = b.member_id";
            $rs = $conn->Execute ($sql);
            $fields = $rs->FetchRow();
          
            $method =   $fields[2];
            if ($method == 'paypal'){
                 $pp_checked    = 'checked';
                 $cc_checked    = '';
            }else{
                $cc_checked     = 'checked';
                $pp_checked    = '';
            }
            
            $pp_email      = $fields[3];
            
            $cc_name		= $fields[4];
            $cc_num	    	= $fields[5];
            $exp_date		= $fields[6];
            $exp_year		= $fields[7];
            $cc_user		= $fields[8];
            $cc_id	    	= $fields[9];
            $cc_email		= $fields[10];
            $cc_addr		= $fields[11];
            $cc_city		= $fields[12];
            $cc_state		= $fields[13];
            $cc_zip     	= $fields[14];
            $cc_country     = $fields[15];
            $cc_tel         = $fields[16];
            $cc_fax         = $fields[17];
        
        }
    //    print_r ($_SESSION);
        $user_info = $currentuser->checkAdminLogin();
        if($user_info == -1)
            include(ROOT_DIR . "templates/" . CURRENT_SKIN . "/title.inc.php");
        else
            include(ROOT_DIR . "templates/" . CURRENT_SKIN . "/admin.title.inc.php");
       
        include(ROOT_DIR . "templates/" . CURRENT_SKIN . "/member.payment.form.php");
        include(ROOT_DIR . "templates/" . CURRENT_SKIN . "/admin.tail.inc.php");
        $smarty->display(CURRENT_THEME.'/page.structure.tpl'); 
      //  die();
    }
    
    
    function updatePaymentInfo(){
        global $conn, $member_info, $currentuser;
        
//       echo "<pre>Info: "; print_r ($_REQUEST); print_r ($_SESSION);echo "</pre>";/////////
        
        $user   =   $_SESSION['selected_user'];
        $method =   handleData($_REQUEST["payment_method"]);
        
        $pp_email       = handleData($_REQUEST["pp_email"]);

        
        $cc_name	= handleData($_REQUEST["cc_name"]);
        $cc_num	   	= handleData($_REQUEST["cc_num"]);
        $exp_date	= handleData($_REQUEST["exp_date"]);
        $exp_year	= handleData($_REQUEST["exp_year"]);
        $cc_user	= handleData($_REQUEST["cc_user"]);
        $cc_id	    = handleData($_REQUEST["cc_id"]);
        $cc_email	= handleData($_REQUEST["cc_email"]);
        $cc_addr	= handleData($_REQUEST["cc_addr"]);
        $cc_city	= handleData($_REQUEST["cc_city"]);
        $cc_state	= handleData($_REQUEST["cc_state"]);
        $cc_zip	    = handleData($_REQUEST["cc_zip"]);
        $cc_country = handleData($_REQUEST["cc_country"]);
        $cc_tel     = handleData($_REQUEST["cc_tel"]);
        $cc_fax     = handleData($_REQUEST["cc_fax"]);
        
        if ($method == 'paypal'){
           
            if ($pp_email == "" ||  strlen($pp_email) > 128 ||  checkMail ($pp_email)){
                $this->showPaymentInfo(MEMBER_0014); 
                return;
            }
            $mem_id = getMemberid ($user);
            $sql = "select id from payment_info where member_id != $mem_id and pp_email='$pp_email'";
            $rs2 = $conn->Execute ($sql);
          // echo $sql. $rs2->fields[0];    
            if ($rs2->fields[0] != 0){
                $this->showPaymentInfo (MEMBER_0038);
                return -1;
            }
            
        }else{

            if ($cc_name == "" ||  strlen($cc_name) > 50 ||  checkAscii ($cc_name)){
                $this->showPaymentInfo(MEMBER_0031);
                return -1;
            }    
            if ($cc_num == ""    ||  strlen($cc_num) > 16 || checkNumeric ($cc_num)){
                $this->showPaymentInfo(MEMBER_0032);
                return -1;
            }
            if ($exp_date == "" ||  strlen($exp_date) > 2 || checkNumeric ($exp_date)){
                $this->showPaymentInfo(MEMBER_0033);
                return -1;
            }
            if ($exp_year == "" ||  strlen($exp_year) > 4 || checkNumeric ($exp_year)){
                $this->showPaymentInfo(MEMBER_0034);
                return -1;
            }
            if ($cc_user == "" ||  strlen($cc_user) > 128 ||  checkAscii($cc_user)){
                $this->showPaymentInfo(MEMBER_0035);
                return -1;
            }
            if ($cc_id == ""     ||  strlen($cc_id) > 4 || checkNumeric ($cc_id)){
                $this->showPaymentInfo(MEMBER_0029);
                return -1;
            }
            if ($cc_email == "" ||  strlen($cc_email) > 128 ||  checkMail ($cc_email)){
                $this->showPaymentInfo(MEMBER_0014);
                return -1;
            }
            if ($cc_addr == "" ||  strlen($cc_addr) > 41 ){
                $this->showPaymentInfo(MEMBER_0030);
                return -1;
            }
            if ($cc_city == "" ||  strlen($cc_city) > 30 ||  checkAscii($cc_city)){
                $this->showPaymentInfo(MEMBER_0008);
                return -1;
            }
            if ($cc_state == "" ||  strlen($cc_state) > 40 ||  checkAscii($cc_state)){
                $this->showPaymentInfo(MEMBER_0009);
                return -1;
            }
            if ($cc_zip == ""   ||  strlen($cc_zip) > 15 || checkNumeric ($cc_zip)){
                $this->showPaymentInfo(MEMBER_0011);
                return -1;
            }
            if ($cc_country == "" ||  strlen($cc_country) > 50 || checkAscii ($cc_country)){
                $this->showPaymentInfo(MEMBER_0010);
                return -1;
            }
            if ($cc_tel == "" ||  strlen($cc_tel) > 25 || checkAscii ($cc_tel)){
                $this->showPaymentInfo(MEMBER_0012);
                return -1;
            }
            if ($cc_fax == "" ||  strlen($cc_fax) > 25 || checkAscii ($cc_fax)){
                $this->showPaymentInfo(MEMBER_0013);
                return -1;
            }
            
        }
                 
        $sql = "select member_id from members where member_name='$user'";
        $rs = $conn->Execute ($sql);
        if (!$rs || $rs->RecordCount() != 1){
            $this->showPaymentInfo(ADMIN_0018);
                return -1;
        }
            
        $member_id = $rs->fields[0];
           
        $sql = "replace into payment_info (member_id, type, pp_email, cc_name, cc_num, exp_date, exp_year, 
               cc_user, cc_id, cc_email, cc_addr, cc_city, cc_state, cc_zip, cc_country, cc_tel, cc_fax) values 
               ($member_id, '$method', '$pp_email', '$cc_name', '$cc_num', '$exp_date', '$exp_year', '$cc_user',
               '$cc_id', '$cc_email', '$cc_addr', '$cc_city', '$cc_state', '$cc_zip', '$cc_country',
                '$cc_tel', '$cc_fax')";

        $rs = $conn->Execute ($sql);
        if (!$rs || $conn->Affected_Rows() <= 0){
             $this->showPaymentInfo(ALL_0004.": ".$sql);
             return -1;
        }
        
        return 0;
    }
    
// show payment confirmation page..
    function confirmPayment (){
        global $conn, $member_info, $currentuser, $register_domains;
    
        //print_r ($_SESSION['regdomains']);
        $user   =   $_SESSION['selected_user'];
        $regdomains = $_SESSION['regdomains'];
        
        if (isset ($_SESSION['fund_amount'])){
            $total = $_SESSION['fund_amount'];
            $item_name = "Fund transfer by user ";
            //echo "fund_amount is set";
        }else{ 
            $total = 0;
            foreach ($regdomains as $key => $val){
                $total     +=  $val[2];
                $item_name .=  ' ' . $val[0];
            }
        }
        $gw_info = array();
        $sql = "select * from gateway_info";
        $rs_g = $conn->Execute($sql);
        $gw_info =   $rs_g->FetchRow();
        
        $sql = "select a.* from payment_info a, members b 
                           where a.member_id=b.member_id and b.member_name='$user'";
        $rs = $conn->Execute($sql);
        $row = $rs->FetchRow();
        
        if ($row[2] == 'paypal'){
            
            $pp = '';
            $pp_email = $row[3];
            $cc = 'none';
            $pp_gw_email    = $gw_info['pp_email'];
            
            
            if ($gw_info['pptestmode'] == 'enabled'){
                $pphost =   "www.sandbox.paypal.com"; // action="https://www.paypal.com/cgi-bin/webscr" 
            }else{
                $pphost =   "www.paypal.com";
            }
            
            $pptestmode     = $gw_info['pptestmode'];
            
        }else if ($row[2] == 'creditcard'){
            $pp = 'none';
            $cc = '';
            
            $instId = $gw_info['instId'];       //
            
            if ($gw_info['wptestmode'] == 'enabled'){
                $wptestmode = 100;
            }else{
                $wptestmode = 0;
            }
            
            $cc_name = $row[4];
            $cc_num  = $row[5];
            $cc_user = $row[8];
            $cc_addr = $row['cc_addr'];
            $cc_state = $row['cc_state']; 
            $cc_city = $row['cc_city'];
            $cc_zip = $row['cc_zip'];
            $cc_country = $row['cc_country'];
            $cc_email = $row['cc_email'];
            $cc_tel   = $row['cc_tel'];
            $cc_fax   = $row['cc_fax'];
        }
        
        $user_info = $currentuser->checkAdminLogin();
        if($user_info == -1)
            include(ROOT_DIR . "templates/" . CURRENT_SKIN . "/title.inc.php");
        else
            include(ROOT_DIR . "templates/" . CURRENT_SKIN . "/admin.title.inc.php");
       
        include(ROOT_DIR . "templates/" . CURRENT_SKIN . "/member.confirmpayment.php");
        include(ROOT_DIR . "templates/" . CURRENT_SKIN . "/admin.tail.inc.php");
        $smarty->display(CURRENT_THEME.'/page.structure.tpl'); 
        die();
    }

    //show results of payment made and update local template db with amount payed.
    function paymentResult (){
        global $conn, $member_info, $currentuser, $register_domains;
        
        $id = getMemberid ($_SESSION['selected_user']);
        $sql = "select status from domains_list where id=$id";
        $rs = $conn->Execute ($sql);
        
       $_SESSION['paid'] = $rs->fields[0];
   //	echo $rs->fields[0]; 
        $sql = "update domains_list set status='status reset' where id=$id";
        $rs = $conn->Execute($sql);       ////
        
 //       echo "<pre>initDomainReg:  "; print_r($_SESSION); echo "end1</pre>";
//  add check for user fund transfer.
        if ($_SESSION['paid'] == 'paid'){
            
            $order_amount   =   0;
            $note           =   '';
            $order_type     =   1;
            $mode_id        =   1;
            if (isset ($_SESSION['regdomains'])) {
                foreach ($_SESSION['regdomains'] as $val){
                    $note           .=  $val[0] . ' ';         
                    $order_amount   +=  $val[2];
                }
                
                insertMoneyMode ($id, $order_type, $mode_id, $order_amount, $note);
                updateFunds     ($id, $order_type, $order_amount);
            }
        }
        
        
        $user_info = $currentuser->checkAdminLogin();
        if($user_info == -1)
            include(ROOT_DIR . "templates/" . CURRENT_SKIN . "/title.inc.php");
        else
            include(ROOT_DIR . "templates/" . CURRENT_SKIN . "/admin.title.inc.php");
       
        include(ROOT_DIR . "templates/" . CURRENT_SKIN . "/member.paymentresult.php");
        include(ROOT_DIR . "templates/" . CURRENT_SKIN . "/admin.tail.inc.php");
        $smarty->display(CURRENT_THEME.'/page.structure.tpl'); 
        die();
    }
    
    // set the current domain to be registered and display the registration form. 
    function initDomainRegistration (){
        global $conn, $member_info, $currentuser, $register_domains;
// 	echo "<br>test value".$_SESSION['paid']; 
        if ($_SESSION['paid'] == 'paid'){
            
            $_SESSION['curr_domain'] =  $_SESSION['regdomains'][0][0];
            $_SESSION['reg_year']   =   $_SESSION['regdomains'][0][1];
            $_SESSION['curr_domain_price'] =  $_SESSION['regdomains'][0][2];
      
            $register_domains->showRegisterForm("");                    // Register domain
        }else
            $this->showCheckForm("");

    }
    
    function makePayment (){
        global $conn, $member_info, $currentuser;
        
//       echo "<pre>";print_r($_SESSION); echo "end</pre>";
        
        $user   = $_SESSION['selected_user'];
        $total  = $_SESSION['total_price'];
        
        if (checkBalance (getMemberid ($user), $total) == -1)
            $this->showPaymentInfo("");
        else {
           /* $sql = "update domains_list set status='paid'";
            $rs = $conn->Execute($sql);*/
            $_SESSION['paid'] = 'paid';
            $this->initDomainRegistration ();
        }
        
    }
    
    function clearDetails(){
        
        unset ($_SESSION['paid']);
        unset ($_SESSION['curr_domain']);
        unset ($_SESSION['curr_domain_price']);
        unset ($_SESSION['reg_year']);        
        unset ($_SESSION['total_price']);
        unset ($_SESSION['fund_amount']);

    }
    
}

?>
