<?php

$smarty->assign ('content_title', 'Hesap Bilgilerini Güncelle');
$smarty->assign ('content_tip', 'Lütfen yeni hesap bilgilerinizi doğrudan girin. 
    Şifreyi değiştirmek istiyorsanız, önce eski şifrenizi sonra yeni şifrenizi girin. 
    Şifreyi değiştirmek istemiyorsanız, şifre satırlarını boş bırakın.');

    $smarty->assign ('content_warning', $message);
	$smarty->assign ('php_self', $_SERVER["PHP_SELF"]);		
	
	global $conn;
	
	$sql = "select * from country";
	$rs = $conn->Execute($sql);
	
	if(!$rs)
	{
		//echo "Error selecting: " . $conn->ErrorMsg() . "<br>";
		die();
	}
    $arr = array();	
	while(!$rs->EOF)
	{   array_push ($arr, $rs->fields);
		$rs->MoveNext();
	}
	$smarty->assign ('rs', $arr);
	
	$smarty->assign ('r_name', $r_name);
	$smarty->assign ('r_org', $r_org);
	$smarty->assign ('r_address1', $r_address1);
	$smarty->assign ('r_address2', $r_address2);
	$smarty->assign ('r_address3', $r_address3);
	$smarty->assign ('r_city',  $r_city);
	$smarty->assign ('r_province', $r_province);
	$smarty->assign ('r_email', $r_email);
	$smarty->assign ('r_fax', $r_fax);
	$smarty->assign ('r_telephone', $r_telephone);
	$smarty->assign ('r_postalcode', $r_postalcode);
	$smarty->assign ('r_country', $r_country);
	
	
	$smarty->assign ('content_header', CURRENT_THEME.'/content.header.tpl');
	$smarty->assign ('content_body', CURRENT_THEME.'/member.updatecontact.form.tpl');
		
?>
