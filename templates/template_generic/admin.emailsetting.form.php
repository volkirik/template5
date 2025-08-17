<?php

	$smarty->assign ('content_title', constant("TEMPLATE_0015"));
	//$smarty->assign ('content_tip', 'Please input the user name and the domain name');
	$smarty->assign ('content_warning', $message);
    $smarty->assign ('php_self', $_SERVER["PHP_SELF"]);

    if ($rs->RecordCount() == 0){
	    $rs->fields[1] = $rs->fields[2] = $rs->fields[6] = 
		$rs->fields[8] = $rs->fields[9] = $rs->fields[10] = $rs->fields[11] = '';
	    $rs->fields[3] = $rs->fields[4] = $rs->fields[5] = $rs->fields[7] = 1;
	}
	
	$smarty->assign ('from_name', $rs->fields[1]);
	$smarty->assign ('from_email', $rs->fields[2]);
	if ($rs->fields[3] == 1)  $status = 'checked';
	else                      $status = '';  
	$smarty->assign ('register_status', $status);
	
	if ($rs->fields[4] == 1)  $status = 'checked';
	else                      $status = ''; 
	$smarty->assign ('renew_status', $status);
	
	if ($rs->fields[5] == 1)  $status = 'checked';
	else                      $status = ''; 
	
	$smarty->assign ('password_status', $status);
	
	if ($rs->fields[6] == 'sendmail'){
 	   $smtp_status = '';
	   $sendmail_status = 'selected';
	   $display = 'none';
	}else{
	   $smtp_status = 'selected';
	   $sendmail_status = '';
	   $display = '';
	}
	$smarty->assign ('smtp_status', $smtp_status);
	$smarty->assign ('sendmail_status', $sendmail_status);
	$smarty->assign ('display', $display);

	if ($rs->fields[7] == 1)  $status = 'checked';
	else                      $status = ''; 
	$smarty->assign ('smtp_auth', $status);

	$smarty->assign ('smtp_server', $rs->fields[8]);
	
	$smarty->assign ('smtp_user', $rs->fields[9]);
	$smarty->assign ('smtp_port', $rs->fields[11]);

	
	$smarty->assign ('content_header', CURRENT_THEME.'/content.header.tpl');
	$smarty->assign ('content_body', CURRENT_THEME.'/admin.emailsetting.form.tpl');

?>
