<?php
    global $smarty;

    $smarty->assign('title', TITLE );
    $smarty->assign('logo', RELA_DIR.'themes/'.CURRENT_THEME.'/images/header1_08.gif');

    $banner_links = array ( array (RELA_DIR.'admin/logout.php', 'Logout'),
                        array (RELA_DIR.'help/super_admin.html', 'Help')
                );
	
	$side_links = array( array ("Super-admin Area", "title"),
	                array ('<a href='.RELA_DIR.'admin/adminList.php>Administrator List</a>', 'link'),
				    array ('<a href='.RELA_DIR.'admin/systemControl.php>System Setting</a>', 'link'),
					array ('<a href='.RELA_DIR.'admin/emailsetting.php>Email settings</a>', 'link'),
                    array ('<a href='.RELA_DIR.'admin/paymentgateway.php>Configure gateway</a>', 'link'),
                    
                    array ('Product Management', 'title'),
					array ('<a href='.RELA_DIR.'admin/productSetting.php>Domain Setting</a>', 'link'),
                    array ('<a href='.RELA_DIR.'admin/productUpdate.php>Domain Upgrade</a>', 'link'),
					array ('<a href='.RELA_DIR.'admin/domainmanage.php>Manage Domain </a>', 'link'),
					array ('<a href='.RELA_DIR.'admin/dnsmanage.php>Manage DNS </a>', 'link'),
					array ('<a href='.RELA_DIR.'domain/domainsearch.php>Register Domain</a>', 'link'),
					array ('<a href='.RELA_DIR.'admin/domainsync.php>Domain Sync</a>', 'link'),
					array ('<a href='.RELA_DIR.'admin/domainlock.php>Domain Lock</a>', 'link'),
					array ('<a href='.RELA_DIR.'admin/domainrenewal.php>Domain Autorenewal</a>', 'link'),
					
					array ('Member Management', 'title'),
					array ('<a href='.RELA_DIR.'admin/memberList.php>Member List</a>', 'link'),
                    
					array ('Account Management', 'title'),
					array ('<a href='.RELA_DIR.'admin/fundsManage.php>Funds Management</a>', 'link'),
					array ('<a href='.RELA_DIR.'admin/queryOrder.php>Query Transaction</a>', 'link'),
                    
					array ('Other operation', 'title'),
					array ('<a href='.RELA_DIR.'admin/whois.php>Whois Search</a>', 'link')
				);

	$smarty->assign('left_menu', $side_links);
	$smarty->assign('banner_links', $banner_links);
?>	
