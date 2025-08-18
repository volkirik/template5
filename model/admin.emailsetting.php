<?php

 class EmailSetting{

    function showForm($message=""){
	    global $conn, $smarty;
		
		$sql = "select * from mail_settings";
		$rs = $conn->Execute($sql);
		if(!$rs)
			showErrorMsg($conn->ErrorMsg());
			
		include(ROOT_DIR . "templates/" . CURRENT_SKIN . "/admin.title.inc.php");
		include(ROOT_DIR . "templates/" . CURRENT_SKIN . "/admin.emailsetting.form.php");
		include(ROOT_DIR . "templates/" . CURRENT_SKIN . "/admin.tail.inc.php");
		
		$smarty->display (CURRENT_THEME.'/page.structure.tpl');
		die();	
    } 
	
	function saveSettings(){
        global $conn, $smarty;
        
		$from_name = addslashes ($_REQUEST['from_name']);
		$from_email = addslashes ($_REQUEST['from_email']);
        $mta        = addslashes ($_REQUEST['mta']);
        
		$smtp_server =  addslashes ($_REQUEST['smtp_server']);
		$smtp_user  =   addslashes ($_REQUEST['smtp_user']);
		$smtp_port  =   addslashes ($_REQUEST['smtp_port']);
		$smtp_pass  =   addslashes ($_REQUEST['smtp_pass']);   
		
		
		if ($from_name == '' || $from_email == '')
		    $this->showForm ('Please input the From Name and Address');
			
				
		if (isset($_REQUEST['reg_domain']))
		    $reg_domain = 1;
		else
	        $reg_domain = 0;
			
		if (isset($_REQUEST['renew_domain']))
		    $renew_domain = 1;
		else
		    $renew_domain = 0;
			
		if (isset($_REQUEST['reset_pass']))
		    $reset_pass = 1;
		else
		    $reset_pass = 0;
			
    	if (isset($_REQUEST['smtp_auth']))
		    $smtp_auth = 1;
		else 
		    $smtp_auth = 0;
	    
		if ($mta == 'smtp'){
		    if ($smtp_server == '' || $smtp_user == '' || $smtp_port == '')
			    $this->showForm ('Please input the smtp server details');
		}
		
		$sql = "select id from mail_settings";
		
		$rs = $conn->Execute ($sql);
		if(!$rs)
			showErrorMsg($conn->ErrorMsg());
		
			
		if ($rs->RecordCount() == 0){
		    //if (!isset ($smtp_pass)) $smtp_pass = ' ';
			
		    $sql = "insert into mail_settings (name, email, register_notify, renew_notify, reset_pass, mta,
			        smtp_auth, server, user, pass, port) values('', '', 1, 1, 1, 'smtp', 1,
					 '', '', '', 25)";
			$rs = $conn->Execute($sql);
			/*		.
					$from_name."', '".$from_email."', ".$reg_domain.", ".$renew_domain.", ".$reset_pass
					.",'".$mta."',".$smtp_auth.",'".$smtp_server."','".$smtp_user."','".$smtp_pass."',".$smtp_port.")";
					*/
		}

		if ($mta == 'sendmail'){
		    $sql = "update mail_settings set name='".$from_name."', email='".$from_email."', register_notify="
			        .$reg_domain.", renew_notify=".$renew_domain.", reset_pass=".$reset_pass.", mta='".$mta."'";
		}else{
		    if (isset($smtp_pass) && $smtp_pass != '')  $password = "pass='".$smtp_pass."',";
			else             $password = '';
			
		    $sql = "update mail_settings set name='".$from_name."', email='".$from_email."', register_notify="
			        .$reg_domain.", renew_notify=".$renew_domain.", reset_pass=".$reset_pass.", mta='".$mta."', 
					smtp_auth=".$smtp_auth.", server='".$smtp_server."', user='".$smtp_user."', ".$password
					." port=".$smtp_port;
		}
		
		$rs = $conn->Execute($sql);
		if(!$rs){
		//	showErrorMsg($conn->ErrorMsg());
	    }
		
        $this->showForm('Email Settings successfully saved.');
	} 
 
	function showEmail ($message=""){
	    global $conn, $smarty;
		
		if (isset($_REQUEST['show'])){
		    $show = $_REQUEST["show"];
		}else if (isset ($_REQUEST['type'])){
		    $show = $_REQUEST["type"];
		}
		
		$sql = "select * from mail_data where type='".$show."'";
		$rs = $conn->Execute ($sql);
		
		if ( $rs->RecordCount() == 0){
		    $subject = $body = $macros = '';
			$day1 = $day2 = $day3 = 0;
		}else {
			$subject =  $rs->fields[2];
			$body   =   $rs->fields[3];
			$macros =   $rs->fields[4];
			$day1   =   $rs->fields[5];
			$day2   =   $rs->fields[6];
			$day3   =   $rs->fields[7];
		}
		
		if ($show == 'register'){
		    $display = 'hide';
		}else if ($show == 'renew'){
		    $display = 'show';
		}else if ($show == 'password') {
		    $display = 'hide';
		}
		
		include(ROOT_DIR . "templates/" . CURRENT_SKIN . "/admin.title.inc.php");
		include(ROOT_DIR . "templates/" . CURRENT_SKIN . "/admin.email.edit.php");
		include(ROOT_DIR . "templates/" . CURRENT_SKIN . "/admin.tail.inc.php");
		
		$smarty->display (CURRENT_THEME.'/page.structure.tpl');
		die();
		
	}
	
	
	function saveEmail (){
	    global $conn, $smarty;
		//echo "saveemail";
		$subject =  addslashes ($_REQUEST['email_subject']);
		$body   =   addslashes ($_REQUEST['email_body']);
		$type =   $_REQUEST['type'];
		
		$sql = "select id from mail_data";
		$rs = $conn->Execute ($sql);
		if(!$rs)
			showErrorMsg($conn->ErrorMsg());
		if ($rs->RecordCount() == 0){  // should add fields in install script
            $sql = "insert into mail_data (type, subject, body, macros, day1, day2, day3) values (
			        'register', '', '', '%domains%,%user%', 0, 0, 0)";
			$rs = $conn->Execute ($sql);
			$sql = "insert into mail_data (type, subject, body, macros, day1, day2, day3) values (
			        'renew', '%domains%,%user%', '', '', 0, 0, 0)";
			$rs = $conn->Execute ($sql);
			$sql = "insert into mail_data (type, subject, body, macros, day1, day2, day3) values (
			        'password', '', '', '%user%,%password%', 0, 0, 0)";
			$rs = $conn->Execute ($sql);
	    }
		if ($type == 'renew'){
		    $day1 = $_REQUEST['days_count1'];
			$day2 = $_REQUEST['days_count2'];
			$day3 = $_REQUEST['days_count3'];
		
		    $days = '';
			if (isset($day1)) $days .= ", day1=".$day1;
			if (isset($day2)) $days .= ", day2=".$day2;
			if (isset($day3)) $days .= ", day3=".$day3;
			$sql = "update mail_data set subject='".$subject."', body='".$body."' ".$days." where type='".$type."'";
		}else{
		    $sql = "update mail_data set subject='".$subject."', body='".$body
			."' where type='".$type."'";
		}
		
		$rs = $conn->Execute ($sql);
	
		//$this->showForm ($sql);
		$this->showForm ("&nbsp; Settings successfully updated.");
	}
	
	function testEmail(){
        global $conn, $smarty;
        
  //      $email  = $_REQUEST['admin_email'];
    //    $type   = $_REQUEST['type'];
        $email = handleData($_REQUEST["admin_email"]);
        $type   = $_REQUEST['type'];
        if($email == ""
                        || strlen($email) > 80
                        || checkMail($email)
       )
        {

                 $this->showEmail(MEMBER_0014);
        }
 
        fetch_mailtemplate($type, $macros, $subject, $body);
       
		$subject = ereg_replace ("%user%",      'LOGGEDIN_USER', $subject);
        $subject = ereg_replace ("%domains%",   'DOMAINS',      $subject);
		$subject = ereg_replace ("%adddate%",   'ADD_DATE',     $subject);
        $subject = ereg_replace ("%years%",     'YEARS',        $subject);
        $subject = ereg_replace ("%password%",  'PASSWORD',     $subject);
        $subject = ereg_replace ("%expdate%",   'EXPDATE',      $subject);
                
        $body = ereg_replace ("%user%", 'LOGGEDIN_USER', $body);
		$body = ereg_replace ("%domains%", 'DOMAINS', $body);
        $body = ereg_replace ("%adddate%", 'ADD_DATE', $body);
        $body = ereg_replace ("%years%",    'YEARS', $body);
		$body = ereg_replace ("%password%", 'PASSWORD', $body);
        $body = ereg_replace ("%expdate%", 'EXPDATE', $body);
        
		$result = mail_user ($email, $subject, $body);

        if (!$result)
            $this->showForm (ADMIN_0043);
        else
            $this->showForm (ADMIN_0044);
    }
 }
?>	
