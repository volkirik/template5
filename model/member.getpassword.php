<?php
class MemberGetPassword
{
	function showForm($message="")
	{   global $smarty;
		include(ROOT_DIR . "templates/" . CURRENT_SKIN . "/title.inc.php");
		include(ROOT_DIR . "templates/" . CURRENT_SKIN . "/member.getpassword.form.php");
		include(ROOT_DIR . "templates/" . CURRENT_SKIN . "/tail.inc.php");
	$smarty->assign ('RELA_DIR', RELA_DIR);
	$smarty->assign ('CAPTCHA_ENABLE', CAPTCHA_ENABLE);
        $smarty->display(CURRENT_THEME.'/page.structure.tpl');
		
		die();
	}
	
	function getPassword()
	{
		global $conn;
		
		$username		= isset($_REQUEST["username"]) ? handleData($_REQUEST["username"]) : '';
		$email			= isset($_REQUEST["email"]) ? handleData($_REQUEST["email"]) : '';
		$keystring 	= isset($_REQUEST["keystring"]) ? handleData($_REQUEST["keystring"]) : '';
		if($username == ""
			|| strlen($username) > 20
			|| checkAscii($username)
		)
			$this->showForm(MEMBER_0001);
		if($email == ""
			|| strlen($email) > 80
			|| checkMail($email)
		)
			$this->showForm(MEMBER_0014);
		if(CAPTCHA_ENABLE===1 && (!isset($_SESSION['OSOLmulticaptcha_keystring']) || $_SESSION['OSOLmulticaptcha_keystring'] !== $keystring)){
			$this->showForm(ALL_0006);
		}
		if(CAPTCHA_ENABLE===1 && isset($_SESSION['OSOLmulticaptcha_keystring'])){
			unset($_SESSION['OSOLmulticaptcha_keystring']);
		}

		$sql = "select	*
			from	members
			where	member_name	= '" . handleSQLData($username) . "' and
				r_email		= '" . handleSQLData($email) . "'";
		$rs = $conn->Execute($sql);
        
		if(!$rs)
		{
			$this->showForm(ALL_0001);
		}else {
			if($rs->RecordCount() == 1)
			{
				$new_password = generate_password();
				/*mail($email, MEMBER_0028, "Your password is " . $new_password, "From: " . SUPPORT_EMAIL);*/
				
				fetch_mailtemplate('password', $macros, $subject, $body);

				$subject = ereg_replace ("%user%", $username, $subject);
				$body = ereg_replace ("%user%", $username, $body);
				$subject = ereg_replace ("%password%", $new_password, $subject);
				$body = ereg_replace ("%password%", $new_password, $body);
				
				mail_user ($email, $subject, $body);
				
				$sql = "update	members
					set	member_password = '" . handleSQLData(md5($new_password)) . "'
					where	member_name	= '" . handleSQLData($username) . "' and
						r_email		= '" . handleSQLData($email) . "'";
				$rs = $conn->Execute($sql);
				if(!$rs)
				{
					$this->showForm(ALL_0004);
				}else {
					$this->showForm(MEMBER_0025);
				}
			}else {
				$this->showForm(MEMBER_0026);
			}
		}
	}
}
?>
