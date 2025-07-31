<?php

include("../server.inc.php");
include(ROOT_DIR . "common/db.inc.php");
include(ROOT_DIR . "init.inc.php");
include(ROOT_DIR . "common/func.inc.php");
include(ROOT_DIR . "common/domain.inc.php");

include(ROOT_DIR . "model/member.login.php");
include(ROOT_DIR . "model/admin.emailsetting.php");
include(ROOT_DIR . "model/class.smtp.inc");

$admin = new MemberLogin();
$admin_info = $admin->checkAdminLogin();
if($admin_info == -1)
{
	$admin->showForm("");
}

if ($admin->checkAdminTask ($admin_info[0], "Email settings") < 0)
{
	showAdminErrorMsg(ADMIN_0035);
}

$mail = new EmailSetting ();
$action = isset($_REQUEST["action"]) ? $_REQUEST["action"] : '';
$show   = isset($_REQUEST["show"]) ? $_REQUEST["show"] : '';
$test_email = isset($_REQUEST["test_email"]) ? $_REQUEST["test_email"] : '';
$type = isset($_REQUEST['type']) ? $_REQUEST['type'] : '';
//echo "<pre>"; print_r ($_REQUEST); echo "</pre>";
  
if ($action == "saveSettings")
{  
	$mail->saveSettings();
}else if ($show ==  'register' || $show == 'renew' || $show == 'password'){
	$mail->showEmail('');
}else if (isset ($test_email) && ($type == 'register' || $type == 'renew' || $type == 'password')){
    $mail->testEmail();
}else if ($type == 'register' || $type == 'renew' || $type == 'password'){
    $mail->saveEmail();
}else 
	$mail->showForm("");

	
?>
