<?php

$banner_links='
	<a href='.RELA_DIR.' class=banner>Home</a> &nbsp;&nbsp; | &nbsp;&nbsp;
	<a href='.RELA_DIR.'member/myaccount.php class=banner>My Account</a> &nbsp;&nbsp; | &nbsp;&nbsp;
	<a href='.RELA_DIR.'member/logout.php class=banner>Logout</a> &nbsp;&nbsp;
';
if(isset($member_info) && $member_info != -1){

$side_links = array( array ("Business Tools", "title"), 
              array ('<a href='.RELA_DIR.'domain/whois.php>Whois Search </a>', "link"),
              array('<a href='.RELA_DIR.'domain/registerdomain.php>Register Domain</a>','link'),
				array('<a href='.RELA_DIR.'domain/domainmanage.php>Manage Domain </a>','link'),
				array ("Member Tools",'title'),
				array('<a href='.RELA_DIR.'member/updatecontact.php>Modify Account Info</a>','link'),
				array('<a href='.RELA_DIR.'member/getpassword.php>Forgot Password</a>','link'),
				array('<a href='.RELA_DIR.'member/orderlist.php>Transaction History</a>','link'),
			  );
}else {
 $side_links = array( array('<a href='.RELA_DIR.'member/myaccount.php>Member  Login</a>','link'),
                array('<a href='.RELA_DIR.'domain/whois.php>Whois Search</a>','link'),
				 array('<a href='.RELA_DIR.'member/signup.php>Sign Up</a>','link'),
				 array('<a href='.RELA_DIR.'member/getpassword.php>Forgot Password </a>','link')
				);
}

$smarty->assign('title', TITLE );
$smarty->assign('left_menu',$side_links);
$smarty->assign('banner_links',$banner_links);
$smarty->display(CURRENT_THEME.'/page.structure.tpl');

?>