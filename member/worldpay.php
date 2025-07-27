<?php
    
    include ("../server.inc.php");
    include (ROOT_DIR . "common/db.inc.php");
    include (ROOT_DIR . "init.inc.php");
    include (ROOT_DIR . "common/func.inc.php");
    
//    echo "POST values from callback script: <pre>"; print_r($_POST); echo "</pre>";
    

    
    $currency   = $_POST['currency'];
    $address    = $_POST['address'];
    $callbackPW = $_POST['callbackPW'];
    $fax        = $_POST['fax'];
    $transId    = $_POST['transId'];
    $zip        = $_POST['postcode'];
    $name       = $_POST['name'];
    $tel        = $_POST['tel'];
    $transStatus = $_POST['transStatus'];
    $item_name  = $_POST['desc'];
    $transTime  = $_POST['transTime'];
    $instId     = $_POST['instId'];
    $amount     = $_POST['amount'];
    $country    = $_POST['country'];
    $email      = $_POST['email'];
    $cartId     = $_POST['cartId'];
    $selected_user = $_POST['MC_selected_user'];
    $updateuserfund = $_POST['MC_updateuserfund'];
    
    $id = getMemberid ($selected_user);
    
    $sql = "select total, id from domains_list where id=$id";

    $rs = $conn->Execute($sql);
    $real_total = $rs->fields[0];

    $sql1 = "select instId, callbackPW from gateway_info;";
    $rs = $conn->Execute($sql1);
    
    $real_instId    = $rs->fields[0];
    $real_callbackPW = $rs->fields[1];
  
    if ($cartId == 'ecompf'){   //change this as Template_wOrLdPaY
        
        if ($transStatus == 'Y'){       // successful transaction
            if ($currency == 'USD' && $amount == $real_total && $instId == $real_instId){ // right amt and acc
                if ($callbackPW == $real_callbackPW){                       // check for fake POSTs
                    $payment_status = 'paid';
                }else{
                    $payment_status = 'failed: password mismatch';
                }
            }else{
                $payment_status = 'failed: amount/currency/instId mismatch';
            }
        }else{
            $payment_status = 'failed: transaction failed';
        }
        $payment_status = addslashes ($payment_status);
        $sql = "update domains_list set status='$payment_status' where id=$id";      // update status as paid/failed
        $rs = $conn->Execute($sql);
     //   echo "SQL: $sql";
    }
    if ($updateuserfund == 'yes')
        header ("Location: http://".$_SERVER['SERVER_NAME'].RELA_DIR.'member/managefunds.php?action=paymentResult');
    else
        header ("Location: http://".$_SERVER['SERVER_NAME'].RELA_DIR.'domain/domainsearch.php?action=paymentResult');
    //echo "End";    

?>
