<?php

class PaymentGateway{

 function showForm ($message=""){
    global $conn, $member_info, $currentuser;
        
    $sql = "select * from gateway_info";
	$rs = $conn->Execute($sql);
	
    if(!$rs)
		flagErrorMsg ($conn->ErrorMsg());
        
    $info = $rs->FetchRow();
    
    $pp_email   = $info['pp_email'];
    $pptestmode = $info['pptestmode'];
    
    $instId     = $info['instId'];
    $callbackPW = $info['callbackPW'];
    $wptestmode = $info['wptestmode'];
    
    if ($pptestmode == 'enabled')
        $pptestmode = 'checked';
    
    if ($wptestmode == 'enabled')
        $wptestmode = 'checked';
    
    include (ROOT_DIR . "templates/" . CURRENT_SKIN . "/admin.title.inc.php");
    include (ROOT_DIR . "templates/" . CURRENT_SKIN . "/admin.paymentgateway.form.php");
	include (ROOT_DIR . "templates/" . CURRENT_SKIN . "/admin.tail.inc.php");
	
    $smarty->display (CURRENT_THEME.'/page.structure.tpl');
    
 }
 
 function updateSettings(){
    global $conn, $member_info, $currentuser;
    
    $pp_email   = handleData ($_REQUEST["pp_email"]);
    $instId     = handleData ($_REQUEST["instId"]);
    $callbackPW = handleData ($_REQUEST["callbackPW"]);
    
    
    if (isset ($_REQUEST["pptestmode"])){
        $pptestmode = 'enabled';
    }else{
        $pptestmode = '';
    }
    
    if (isset ($_REQUEST["wptestmode"])){
        $wptestmode = 'enabled';
    }else{
        $wptestmode = '';
    }
        
    if ($pp_email == "" ||  strlen($pp_email) > 128 ||  checkMail ($pp_email)){
        $this->showForm(MEMBER_0014); 
            return;
    }
    
    $sql = "replace into gateway_info (id, pp_email, instId, callbackPW, wptestmode, pptestmode) values 
                            (1, '$pp_email', '$instId', '$callbackPW', '$wptestmode', '$pptestmode')";
    $rs = $conn->Execute ($sql);
    
    if (!$rs || $conn->Affected_Rows() <= 0){
         $this->showForm(ALL_0004.": ".$sql);
         return -1;
    }
    return 0;
 }

}

?>
