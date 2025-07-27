<?php
 global $smarty;
 global $conn;
 global $member_info;

 $banner_links = array ( array (RELA_DIR, 'Anasayfa'),
                        array (RELA_DIR.'member/myaccount.php', 'Hesabım')
                );
	
if(isset($member_info) && $member_info != -1){

    array_push ($banner_links, array (RELA_DIR.'member/logout.php', 'Çıkış Yap'));
    
	$side_links = array( array ("İş Araçları", "title"), 
			    	array ('<a href='.RELA_DIR.'domain/whois.php>Whois Arama</a>', "link"),
			    	array('<a href='.RELA_DIR.'domain/domainsearch.php>Alan Adı Kaydet</a>','link'),
					array('<a href='.RELA_DIR.'domain/domainmanage.php>Alan Adı Yönetimi</a>','link'),
					array ("Üye Araçları",'title'),
					array('<a href='.RELA_DIR.'member/updatecontact.php>Hesap Bilgilerini Düzenle</a>','link'),
					array('<a href='.RELA_DIR.'member/getpassword.php>Şifremi Unuttum</a>','link'),
					array('<a href='.RELA_DIR.'member/orderlist.php>İşlem Geçmişi</a>','link'),
				    array('Ürün Yönetimi', 'title'),
                    array('<a href='.RELA_DIR.'member/dnsmanage.php>DNS Yönetimi</a>', 'link'),
                );
                
    $domainrenewal = array('<a href='.RELA_DIR.'member/domainrenewal.php>Alan Adı Otomatik Yenileme</a>', 'link');
    $domainlock  = array('<a href='.RELA_DIR.'member/domainlock.php>Alan Adı Kilitleme</a>', 'link');
    
    
    $sql = "select domain_lock, domain_renewal from web_config";
    $status = $conn->Execute ($sql);
    
    if (!$status)
        $this->showForm("");
        
    if ($status->fields[0] == 1)
        array_push ($side_links, $domainlock);
        
    if ($status->fields[1] == 1)
        array_push ($side_links, $domainrenewal);
    
    array_push ($side_links, array('Fon Yönetimi', 'title'));
    array_push ($side_links,  array('<a href='.RELA_DIR.'member/managefunds.php>Fonları Yönet</a>', 'link'));
                
}else {
	$side_links = array( array('<a href='.RELA_DIR.'member/myaccount.php>Üye Girişi</a>','link'),
					array('<a href='.RELA_DIR.'domain/whois.php>Whois Arama</a>','link'),
					array('<a href='.RELA_DIR.'member/signup.php>Kayıt Ol</a>','link'),
                  array('<a href='.RELA_DIR.'domain/domainsearch.php>Alan Adı Kaydet</a>','link'),  
					array('<a href='.RELA_DIR.'member/getpassword.php>Şifremi Unuttum</a>','link')
					);
    array_push ($banner_links, array (RELA_DIR.'member/myaccount.php', 'Giriş Yap'));
}

	$smarty->assign('title', TITLE );
	$smarty->assign('logo', RELA_DIR.'themes/'.CURRENT_THEME.'/images/header1_08.gif');
	$smarty->assign('left_menu', $side_links);
	$smarty->assign('banner_links', $banner_links);

?>
