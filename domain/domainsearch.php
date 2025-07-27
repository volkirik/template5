<?php
    
    include ("../server.inc.php"); 
    include (ROOT_DIR . "common/db.inc.php");
    include (ROOT_DIR . "init.inc.php");
    include (ROOT_DIR . "common/func.inc.php");
    include (ROOT_DIR . "common/domain.inc.php");
    include (ROOT_DIR . "model/member.login.php");
    include (ROOT_DIR . "model/domain.domainsearch.php");
    include (ROOT_DIR . "model/admin.registerdomain.php");
    include(ROOT_DIR . "model/class.smtp.inc");


    $register_domains   =   new DomainRegistration();
    
    $currentuser    = new MemberLogin();
    $member_info = $currentuser->checkLogin();
    
    $admin_info = $currentuser->checkAdminLogin();
    
    if ($admin_info == -1){
        checkSystemStatus();
    
    }else if ($currentuser->checkAdminTask($admin_info[0], "Register Domain") < 0){
	    showAdminErrorMsg(ADMIN_0035);
    }

    $domain = new RegisterDomain();
    $action = $_REQUEST["action"];
    
    
       //// For testing..COMMENT THIS before going live
   // if (!isset($action)){   $domain->clearDetails();   $action = "selectMember"; }

     
    if ($action == "checkDomains")
    {
        $domain->checkDomain();
    }else if ($action == "addDomains") { 
    
        $domain->addDomains("");
    }else if ($action == "remDomain") { 
    
        $domain->remDomain();
        
    }else if ($action == "selectMember") {
    
            $domain->selectMember("");
        
    }else if ($action == "Login") {

        $domain->checkLogin();

    }else if ($action == "fromAddDomain") {
    
        if (isset ($_REQUEST['proceed']))
            $domain->makePayment();
        else if (isset ($_REQUEST['recalculate'])) 
            $domain->recalculate();
     
    }else if ($action == "updatePaymentInfo") {
    
        $res = $domain->updatePaymentInfo ();
        if ($res != -1)
            $domain->confirmPayment();
    
    }else if ($action == "paymentResult") {
         //echo "Domainsearch: paymentResult..";
        $domain->paymentResult();  
              
    }else if ($action == "initDomainRegistration") {
        //echo "Domainsearch: initdomain..";
        $domain->initDomainRegistration("");
       
    
    }else if ($action == "showRegisterForm") {
        $register_domains->showRegisterForm("");
        
    }else if ($action == "registerDomain") {
        $register_domains->registerDomain();
        
    }else {
        $domain->clearDetails();
        $domain->showCheckForm("");
      
    }

?>
