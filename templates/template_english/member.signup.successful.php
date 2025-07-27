<?php
global	$member_name;
global	$member_password1;
global	$r_name;
global	$r_email;

    global $smarty;

	$smarty->assign ('content_title', 'Sign Up');

	$smarty->assign ('member_name', $member_name);
	$smarty->assign ('member_password1', $member_password1);
	$smarty->assign ('member_login', RELA_DIR.'member/login.php');
	
    //echo "<pre> success mess "; print_r ($_SESSION); echo "</pre>";
    
    if (isset ($_SESSION['newsignup'])){
        $smarty->assign ('signup_return', 'newmember');
       // echo "<br>success message, signup_return is set <br>";
    }//else 
      // echo "<br>success message, signup_return is not set <br>";

    unset ($_SESSION['newsignup']);
    
	$smarty->assign ('content_header', CURRENT_THEME.'/content.header.tpl');
	$smarty->assign ('content_body', CURRENT_THEME.'/member.signup.successful.tpl');
	
?>
