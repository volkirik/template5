<?php

include ("../server.inc.php");
include (ROOT_DIR . "common/db.inc.php");
include (ROOT_DIR . "init.inc.php");
include (ROOT_DIR . "common/func.inc.php");
include (ROOT_DIR . "model/member.login.php");
include (ROOT_DIR . "model/domain.domainsearch.php");
//include (ROOT_DIR . "model/admin.registerdomain.php");
include (ROOT_DIR . "model/member.fundmanager.php");


    $currentuser    = new MemberLogin();
    $fund           = new FundManager();
    $domain         = new RegisterDomain();
    
    $member_info    = $currentuser->checkLogin();
    
    if ($member_info == -1){
        $currentuser->showForm ("");
        return;
    }

checkSystemStatus();

    $action    = $_REQUEST['action'];
    
    if($action == 'showFundManager'){
    
        $domain->clearDetails();
        $fund->showForm("");
    
    }else if ($action == 'selectGateway')
        
        $fund->selectGateway ("");
    
    else if($action == "updatePaymentInfo"){ 
        
        $fund->updatePaymentInfo("");

    }else if ($action == 'paymentResult'){
        //echo "members: paymentresult ";
        $fund->paymentResult ("");
    
    }else if ($action == "initDomainRegistration") {
        $fund->addFunds("");
   
    }
    else {

        $fund->showForm("");
        $domain->clearDetails();
    }
    
?>
