<?php

class FundManager
{
 
 function showForm($message=""){
    global $conn, $member_info;
    
    include(ROOT_DIR . "templates/" . CURRENT_SKIN . "/title.inc.php");
	include(ROOT_DIR . "templates/" . CURRENT_SKIN . "/member.showfunds.php");
	include(ROOT_DIR . "templates/" . CURRENT_SKIN . "/tail.inc.php");
	$smarty->display(CURRENT_THEME.'/page.structure.tpl');
	die();
    
 
 }

 function selectGateway($msg=""){
    global $conn, $member_info, $domain;
    
    $fund_amount = $_REQUEST['fund_amount'];
    
    if (!is_numeric ($fund_amount) || $fund_amount <= 0 ){

        $this->showForm (ADMIN_0003);
        return;
    }
    
    $_SESSION['fund_amount'] = $fund_amount;
    $domain->showPaymentInfo("");
 
 }
 
 function updatePaymentInfo ($msg=""){
     global $conn, $member_info, $domain;
     
     $item_name = "Fund transfer by user";
     $total = $_SESSION['fund_amount'];
     
     $id = getMemberid ($_SESSION['selected_user']);
     
     $sql = "replace into domains_list  values ($id, '$item_name', $total, '')";   ////add member id
     $rs_list = $conn->Execute($sql);
     //echo "fundmanager. SQL  $sql";

     $res = $domain->updatePaymentInfo ();
     if ($res == -1){

        return -1;
     }
          
     $_SESSION['updateuserfund'] = 'true';
     //echo "From fundmanager: ". $_SESSION['updateuserfund'];   
     $domain->confirmPayment ();
    
 }
 
 function paymentResult ($msg=""){
    global $conn, $member_info, $domain;
    //print_r ($_SESSION); print_r ($_POST);
    $domain->paymentResult();
 }
 
 function addFunds ($msg=""){
    global $conn, $member_info, $domain, $currentuser;
    
    //echo "addFunds.."; ob_flush (); flush ();
    $member_id      = getmemberid ($_SESSION['selected_user']);
    $order_type     = 1;
    $mode_id        = 1;
    $note           = "Fund added by user";
    $order_amount = $_SESSION['fund_amount'];

    //echo "<br>Values $member_id $order_type $mode_id $order_amount<br>";
    
    insertMoneyMode ($member_id, $order_type, $mode_id, $order_amount, $note);
    updateFunds ($member_id, $order_type, $order_amount);
    
    //echo "  addFunds: updated";
    
    $member_info    =   $currentuser->checkLogin();
    $this->showForm ("");
    //echo "  addFunds: form displayed    ";
 }
 
}

?>
