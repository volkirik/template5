<?php
 global $smarty;
 global $conn;
 global $member_info;

 $banner_links = array ( array (RELA_DIR, 'Home'),
                        array (RELA_DIR.'member/myaccount.php', 'My Account')
                );
	
if(isset($member_info) && $member_info != -1){

    array_push ($banner_links, array (RELA_DIR.'member/logout.php', 'Logout'));
    
	$side_links = array( array ("Business Tools", "title"), 
			    	array ('<a href='.RELA_DIR.'domain/whois.php>Whois Search </a>', "link"),
			    	array('<a href='.RELA_DIR.'domain/domainsearch.php>Register Domain</a>','link'),
					array('<a href='.RELA_DIR.'domain/domainmanage.php>Manage Domain </a>','link'),
					array ("Member Tools",'title'),
					array('<a href='.RELA_DIR.'member/updatecontact.php>Modify Account Info</a>','link'),
					array('<a href='.RELA_DIR.'member/getpassword.php>Forgot Password</a>','link'),
					array('<a href='.RELA_DIR.'member/orderlist.php>Transaction History</a>','link'),
				    array('Product Management', 'title'),
                    array('<a href='.RELA_DIR.'member/dnsmanage.php>Manage DNS</a>', 'link'),
                );
                
    $domainrenewal = array('<a href='.RELA_DIR.'member/domainrenewal.php>Domain AutoRenewal</a>', 'link');
    $domainlock  = array('<a href='.RELA_DIR.'member/domainlock.php>Domain Lock</a>', 'link');
    
    $sql = "select domain_lock, domain_renewal from web_config";
    $status = $conn->Execute ($sql);
    
    if (!$status)
        $this->showForm("");
        
    if ($status->fields[0] == 1)
        array_push ($side_links, $domainlock);
        
    if ($status->fields[1] == 1)
        array_push ($side_links, $domainrenewal);
    
    array_push ($side_links, array('Fund Management', 'title'));
    array_push ($side_links,  array('<a href='.RELA_DIR.'member/managefunds.php>Manage Funds</a>', 'link'));
                
}else {
	$side_links = array( array('<a href='.RELA_DIR.'member/myaccount.php>Member  Login</a>','link'),
					array('<a href='.RELA_DIR.'domain/whois.php>Whois Search</a>','link'),
					array('<a href='.RELA_DIR.'member/signup.php>Sign Up</a>','link'),
                  array('<a href='.RELA_DIR.'domain/domainsearch.php>Register Domain</a>','link'),  
					array('<a href='.RELA_DIR.'member/getpassword.php>Forgot Password </a>','link')
					);
    array_push ($banner_links, array (RELA_DIR.'member/myaccount.php', 'Login'));
}

	$smarty->assign('title', TITLE );
	$smarty->assign('logo', RELA_DIR.'themes/'.CURRENT_THEME.'/images/header1_08.gif');
	$smarty->assign('left_menu', $side_links);
	$smarty->assign('banner_links', $banner_links);

?>
