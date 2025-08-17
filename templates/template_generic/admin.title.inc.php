<?php
    global $smarty;

    $smarty->assign('title', TITLE );
    $smarty->assign('logo', RELA_DIR.'themes/'.CURRENT_THEME.'/images/header1_08.gif');

    $banner_links = array ( array (RELA_DIR.'admin/logout.php', constant('TEMPLATE_0052')),
                        array (RELA_DIR.'help/super_admin.html', constant('TEMPLATE_0053'))
                );
	
	$side_links = array( array (constant('TEMPLATE_0054'), "title"),
	                array ('<a href='.RELA_DIR.'admin/adminList.php>'.constant('TEMPLATE_0055').'</a>', 'link'),
				    array ('<a href='.RELA_DIR.'admin/systemControl.php>'.constant('TEMPLATE_0056').'</a>', 'link'),
					array ('<a href='.RELA_DIR.'admin/emailsetting.php>'.constant('TEMPLATE_0057').'</a>', 'link'),
                    array ('<a href='.RELA_DIR.'admin/paymentgateway.php>'.constant('TEMPLATE_0058').'</a>', 'link'),
                    
                    array (constant('TEMPLATE_0059'), 'title'),
					array ('<a href='.RELA_DIR.'admin/productSetting.php>'.constant('TEMPLATE_0060').'</a>', 'link'),
                    array ('<a href='.RELA_DIR.'admin/productUpdate.php>'.constant('TEMPLATE_0061').'</a>', 'link'),
					array ('<a href='.RELA_DIR.'admin/domainmanage.php>'.constant('TEMPLATE_0062').'</a>', 'link'),
					array ('<a href='.RELA_DIR.'admin/dnsmanage.php>'.constant('TEMPLATE_0063').'</a>', 'link'),
					array ('<a href='.RELA_DIR.'domain/domainsearch.php>'.constant('TEMPLATE_0064').'</a>', 'link'),
					array ('<a href='.RELA_DIR.'admin/domainsync.php>'.constant('TEMPLATE_0065').'</a>', 'link'),
					array ('<a href='.RELA_DIR.'admin/domainlock.php>'.constant('TEMPLATE_0066').'</a>', 'link'),
					array ('<a href='.RELA_DIR.'admin/domainrenewal.php>'.constant('TEMPLATE_0067').'</a>', 'link'),
					
					array (constant('TEMPLATE_0068'), 'title'),
					array ('<a href='.RELA_DIR.'admin/memberList.php>'.constant('TEMPLATE_0069').'</a>', 'link'),
                    
					array (constant('TEMPLATE_0070'), 'title'),
					array ('<a href='.RELA_DIR.'admin/fundsManage.php>'.constant('TEMPLATE_0071').'</a>', 'link'),
					array ('<a href='.RELA_DIR.'admin/queryOrder.php>'.constant('TEMPLATE_0072').'</a>', 'link'),
                    
					array (constant('TEMPLATE_0147'), 'title'),
					array ('<a href='.RELA_DIR.'admin/whois.php>'.constant('TEMPLATE_0073').'</a>', 'link')
				);

	$smarty->assign('left_menu', $side_links);
	$smarty->assign('banner_links', $banner_links);
?>	
