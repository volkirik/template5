<?php
    global $smarty;

    $smarty->assign('title', TITLE );
    $smarty->assign('logo', RELA_DIR.'themes/'.CURRENT_THEME.'/images/header1_08.gif');

$banner_links = array ( array (RELA_DIR.'admin/logout.php', 'Çıkış Yap'),
                        array (RELA_DIR.'help/super_admin.html', 'Yardım')
                );

$side_links = array( array ("Süper Yönetici Alanı", "title"),
	                array ('<a href='.RELA_DIR.'admin/adminList.php>Yönetici Listesi</a>', 'link'),
				    array ('<a href='.RELA_DIR.'admin/systemControl.php>Sistem Ayarı</a>', 'link'),
					array ('<a href='.RELA_DIR.'admin/emailsetting.php>E-posta Ayarları</a>', 'link'),
                    array ('<a href='.RELA_DIR.'admin/paymentgateway.php>Geçit Yapılandırma</a>', 'link'),
                    
                    array ('Ürün Yönetimi', 'title'),
					array ('<a href='.RELA_DIR.'admin/productSetting.php>Alan Adı Ayarı</a>', 'link'),
                    array ('<a href='.RELA_DIR.'admin/productUpdate.php>Alan Adı Yükseltme</a>', 'link'),
					array ('<a href='.RELA_DIR.'admin/domainmanage.php>Alan Adı Yönetimi</a>', 'link'),
					array ('<a href='.RELA_DIR.'admin/dnsmanage.php>DNS Yönetimi</a>', 'link'),
					array ('<a href='.RELA_DIR.'domain/domainsearch.php>Alan Adı Kaydet</a>', 'link'),
					array ('<a href='.RELA_DIR.'admin/domainsync.php>Alan Adı Senkronizasyonu</a>', 'link'),
					array ('<a href='.RELA_DIR.'admin/domainlock.php>Alan Adı Kilitleme</a>', 'link'),
					array ('<a href='.RELA_DIR.'admin/domainrenewal.php>Alan Adı Otomatik Yenileme</a>', 'link'),
					
					array ('Üye Yönetimi', 'title'),
					array ('<a href='.RELA_DIR.'admin/memberList.php>Üye Listesi</a>', 'link'),
                    
					array ('Hesap Yönetimi', 'title'),
					array ('<a href='.RELA_DIR.'admin/fundsManage.php>Fon Yönetimi</a>', 'link'),
					array ('<a href='.RELA_DIR.'admin/queryOrder.php>İşlem Sorgulama</a>', 'link'),
                    
					array ('Diğer İşlemler', 'title'),
					array ('<a href='.RELA_DIR.'admin/whois.php>Whois Arama</a>', 'link')
				);

	$smarty->assign('left_menu', $side_links);
	$smarty->assign('banner_links', $banner_links);
?>	
