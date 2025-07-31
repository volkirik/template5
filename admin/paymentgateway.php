<?php
    
    include ("../server.inc.php"); 
    include (ROOT_DIR . "common/db.inc.php");
    include (ROOT_DIR . "init.inc.php");
    include (ROOT_DIR . "common/func.inc.php");
    include (ROOT_DIR . "common/domain.inc.php");
    include (ROOT_DIR . "model/member.login.php");
    include (ROOT_DIR . "model/admin.paymentgateway.php");
//    include (ROOT_DIR . "model/domain.domainsearch.php");
//    include (ROOT_DIR . "model/admin.registerdomain.php");
    
    
//    $register_domains   =   new DomainRegistration();
    
    $currentuser    = new MemberLogin();
    $member_info    = $currentuser->checkAdminLogin();
    
    if ($member_info == -1){
        $currentuser->showForm ("");
    }

    if ($currentuser->checkAdminTask ($member_info[0], "Configure Gateway") < 0){
	    showAdminErrorMsg (ADMIN_0035);
    }
        
    $gw  =   new PaymentGateway ();
    
    $action = isset($_REQUEST["action"]) ? $_REQUEST["action"] : '';
    
    if ($action == 'showForm'){
        
        $gw->showForm ('');
    
    }else if ($action == 'updateSettings'){
        
        $res = $gw->updateSettings ();
        if ($res == 0)
            $gw->showForm (ADMIN_0042);

    }else{
        $gw->showForm ('');
    }
    
?>



 











