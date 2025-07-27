<?php

	$smarty->assign ('content_title', 'Alan Adlarını Kaydet');
	$smarty->assign ('content_tip', 'Lütfen yıl sayısını seçin');
	$smarty->assign ('content_warning', $message);
    $smarty->assign ('php_self', $_SERVER["PHP_SELF"]);
    
    
    
    $user_info = $currentuser->checkAdminLogin();  
    $domains = array(); 
    
    if($user_info == -1){
        $user_info = $currentuser->checkLogin();
        $user = $user_info[1];
        $_SESSION['selected_user'] = $user;
        $level = $user_info[4];
    }else{
        $user = $_SESSION['selected_user'];
        $query = "select member_level from members where member_name='$user'";
        $rs = $conn->Execute ($query);
        $level = $rs->fields[0];
    }
    
    if (!isset($_SESSION['regdomains'])){                 //if ($_SESSION['regdomains'] == ''){
       //echo " session_regdomains not set";
        $_SESSION['regdomains'] = array();

        if (!isset($_SESSION['domain_list'])){
                $domains = array (array ('testing1981.us', 2, 55, 0), array ('ping-pongdog.cn',1 , 24, 0));

            $_SESSION['regdomains'] = $domains;
        }else{
            foreach ($_SESSION['domain_list'] as $key => $val){
                array_push ($_SESSION['regdomains'], array ($val, 1, 1, 0));
            }
        }
    }
  //  else echo "session_regdomains is set! ";
        
   
    $domains = array();    
    $list = $_SESSION['regdomains'];
    $total = 0;
    foreach ($list as $key => $val){
        
        $pid         = getProductId ($val[0]);
        $domain_gtld = getGtld ($val[0]);
    /*    if ($domain_gtld == '.us' && $val[1] < 2)       // .us domains should be registered for at least 2yrs.
            $this->addDomains (MEMBER_0036);
      */  
        if ($domain_gtld == '.cn')
            $val[3] = 1;
            
        $sql = "select price from member_price where product_id=$pid and i_year=$val[1]
                        and type=1 and member_level=$level";
        $rs = $conn->Execute ($sql);

        array_push ($domains, array ($val[0], $val[1], $rs->fields[0], $val[3]));
        $total += $rs->fields[0];
        $item_name .= " ".$val[0];
    }   

    $_SESSION['regdomains'] = $domains;
    $_SESSION['total_price'] = $total;

   $id = getMemberid ($_SESSION['selected_user']);
   $sql = "replace into domains_list  values ($id, '$item_name', $total, '')";   ////add member id
   $rs_list = $conn->Execute($sql);
   
    //echo "<pre>addDomain: after "; print_r($_SESSION);echo "end1</pre>";
    $smarty->assign ('domains', $_SESSION['regdomains']);
    $smarty->assign ('total', $total);
    
    $smarty->assign ('content_header', CURRENT_THEME.'/content.header.tpl');
    $smarty->assign ('content_body', CURRENT_THEME.'/domain.adddomain.list.tpl');

	
?>
