<?php

    include ("../server.inc.php");
    include (ROOT_DIR . "common/db.inc.php");
    include (ROOT_DIR . "init.inc.php");
    include (ROOT_DIR . "common/func.inc.php");
    include (ROOT_DIR . "model/member.signup.php");
    include (ROOT_DIR . "model/domain.domainsearch.php");
    include (ROOT_DIR . "model/member.login.php");

    $domain_obj     = new RegisterDomain();
    $currentuser    = new MemberLogin();
    
    checkSystemStatus();
    $member = new MemberSignup();
    if($_POST["Submit"] != "")
    {
        $member->addMember();
    }else {
        $member->showForm("");
    }
?>
