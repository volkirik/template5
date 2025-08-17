<?php
 global $smarty;
 global $conn;
 global $member_info;

 $banner_links = array ( array (RELA_DIR, constant('TEMPLATE_0124')),
                        array (RELA_DIR.'member/myaccount.php', constant('TEMPLATE_0125'))
                );
	
if(isset($member_info) && $member_info != -1){

    array_push ($banner_links, array (RELA_DIR.'member/logout.php', constant('TEMPLATE_0126')));
    
	$side_links = array( array (constant('TEMPLATE_0127'), "title"), 
			    	array ('<a href='.RELA_DIR.'domain/whois.php>'.constant('TEMPLATE_0128').'</a>', "link"),
			    	array('<a href='.RELA_DIR.'domain/domainsearch.php>'.constant('TEMPLATE_0129').'</a>','link'),
					array('<a href='.RELA_DIR.'domain/domainmanage.php>'.constant('TEMPLATE_0130').'</a>','link'),
					array (constant('TEMPLATE_0131'),'title'),
					array('<a href='.RELA_DIR.'member/updatecontact.php>'.constant('TEMPLATE_0132').'</a>','link'),
					array('<a href='.RELA_DIR.'member/getpassword.php>'.constant('TEMPLATE_0133').'</a>','link'),
					array('<a href='.RELA_DIR.'member/orderlist.php>'.constant('TEMPLATE_0134').'</a>','link'),
				    array(constant('TEMPLATE_0135'), 'title'),
                    array('<a href='.RELA_DIR.'member/dnsmanage.php>'.constant('TEMPLATE_0136').'</a>', 'link'),
                );
                
    $domainrenewal = array('<a href='.RELA_DIR.'member/domainrenewal.php>'.constant('TEMPLATE_0137').'</a>', 'link');
    $domainlock  = array('<a href='.RELA_DIR.'member/domainlock.php>'.constant('TEMPLATE_0138').'</a>', 'link');
    
    $sql = "select domain_lock, domain_renewal from web_config";
    $status = $conn->Execute ($sql);
    
    if (!$status)
        $this->showForm("");
        
    if ($status->fields[0] == 1)
        array_push ($side_links, $domainlock);
        
    if ($status->fields[1] == 1)
        array_push ($side_links, $domainrenewal);
    
    array_push ($side_links, array(constant('TEMPLATE_0139'), 'title'));
    array_push ($side_links,  array('<a href='.RELA_DIR.'member/managefunds.php>'.constant('TEMPLATE_0140').'</a>', 'link'));
                
}else {
	$side_links = array( array('<a href='.RELA_DIR.'member/myaccount.php>'.constant('TEMPLATE_0141').'</a>','link'),
		array('<a href='.RELA_DIR.'domain/whois.php>'.constant('TEMPLATE_0142').'</a>','link'),
		array('<a href='.RELA_DIR.'member/signup.php>'.constant('TEMPLATE_0143').'</a>','link'),
		array('<a href='.RELA_DIR.'domain/domainsearch.php>'.constant('TEMPLATE_0144').'</a>','link'),  
		array('<a href='.RELA_DIR.'member/getpassword.php>'.constant('TEMPLATE_0145').'</a>','link')
	);
    array_push ($banner_links, array (RELA_DIR.'member/myaccount.php', constant('TEMPLATE_0146')));
}

	$smarty->assign('title', TITLE );
	$smarty->assign('logo', RELA_DIR.'themes/'.CURRENT_THEME.'/images/header1_08.gif');
	$smarty->assign('left_menu', $side_links);
	$smarty->assign('banner_links', $banner_links);

?>
