<?php

    $smarty->assign ('content_title', 'Sistem anasayfası');
    $smarty->assign ('content_warning', "Hoşgeldiniz");
	$smarty->assign ('content_header', CURRENT_THEME.'/content.header.tpl');
	$smarty->assign ('content_message', '<p>- ÜCRETSİZ ÜYELİK</p>'
.'<p>- PAYPAL veya KREDİ KARTIYLA ÖDEME YAPABİLİRSİNİZ</p>'
.'<p>- HESAP BAKİYENİZİN SON KULLANMA TARİHİ YOKTUR</p>'
.'<p>- İHTİYACINIZ OLAN KADAR BAKİYE YÜKLEYEBİLİRSİNİZ</p>'
.'<p>- KOLAY ve SADE YÖNETİM TASARIMI</p>');
	$smarty->assign ('content_body', CURRENT_THEME.'/system.index.tpl');

?>
