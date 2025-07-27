<?php

    
    include ("../server.inc.php");
    include (ROOT_DIR . "common/db.inc.php");
    include (ROOT_DIR . "init.inc.php");
 
     $sql1 = "insert into pp_test values ('testing')";

     $rs = $conn->Execute ($sql1);
     
    $payer_email = $_POST['payer_email'];

     $sql = "select a.total, a.id from domains_list a, payment_info b where
                 b.pp_email='$payer_email' and b.member_id=a.id";
     $rs = $conn->Execute($sql);
     $real_total    = $rs->fields[0];
     $real_memberid = $rs->fields[1];
     
     $sql1 = "select pp_email from gateway_info ";

     $rs = $conn->Execute($sql1);
     $real_email = $rs->fields[0];//$m[0];
     
    //unset ($_POST);
    if (isset($_POST)){

        $req = 'cmd=_notify-validate';

        foreach ($_POST as $key => $value) {
            $value = urlencode(stripslashes($value));
            $req .= "&$key=$value";
        }

        // post back to PayPal system to validate
        $header .= "POST /cgi-bin/webscr HTTP/1.0\r\n";
        $header .= "Content-Type: application/x-www-form-urlencoded\r\n";
        $header .= "Content-Length: " . strlen($req) . "\r\n\r\n";
        $fp = fsockopen ('www.sandbox.paypal.com', 80, $errno, $errstr, 30);

        // assign posted variables to local variables
        $payment_date = $_POST['payment_date'];
        $first_name = $_POST['first_name'];
        $last_name = $_POST['last_name'];
        
        $item_name = $_POST['item_name'];
        $mc_gross = $_POST['mc_gross'];
        $mc_currency = $_POST['mc_currency'];
        
        $address_street = $_POST['address_street'];
        $address_city = $_POST['address_city'];
        $address_state = $_POST['address_state'];
        $address_country = $_POST['address_country'];
        $address_zip = $_POST['address_zip'];
        $address_status  = $_POST['address_status'];
        
        $payment_type = $_POST['payment_type'];
        $payment_status = $_POST['payment_status'];
        $payment_amount = $_POST['mc_gross'];
        $payment_currency = $_POST['mc_currency'];
        $txn_id = $_POST['txn_id'];
        $txn_type = $_POST['txn_type'];
        $receiver_email = $_POST['receiver_email'];
        $payer_email = $_POST['payer_email'];       //
        $pending_reason = $_POST['pending_reason'];
        $reason_code = $_POST['reason_code'];
        
        if (!$fp) {
        // HTTP ERROR
                $sql1 = "insert into pp_test values ('http error')";
                $rs = $conn->Execute ($sql1);
        } else {
        fputs ($fp, $header . $req);
            while (!feof($fp)) {
                $res = fgets ($fp, 1024);
                
                if (strcmp ($res, "VERIFIED") == 0) {
                // check the payment_status is Completed
                // check that txn_id has not been previously processed
                // check that receiver_email is your Primary PayPal email
                // check that payment_amount/payment_currency are correct
                // process payment
                    switch( $payment_status )
                    {
                        case 'Pending':
                            if ($pending_reason!="intl") {
                                //$paypal_ipn->error_out("Pending Payment - $pending_reason", $em_headers);
                                $pp_status = "Pending Payment - $pending_reason";
                                break;
                            }

                        case 'Completed':

                            if ($txn_type == "reversal") {
                                $pp_status = "PayPal reversed an earlier transaction. $reason_code";
                                // you should mark the payment as disputed now
                            } else {

              
                                if ((strtolower (trim ($receiver_email)) == $real_email) &&
                                     (trim ($payment_currency)=='USD') && 
                                     (trim ($payment_amount) == $real_total) )
                                {
                    $sql1 = "insert into pp_test values ('testing4 $payment_status $txn_type')"; ////
                    $rs = $conn->Execute ($sql1);               ///
                                    $qry = "INSERT INTO paypal_ipns (payment_date, txn_id, first_name, last_name, payer_email,
                                            payer_status, payment_type, item_name, quantity,  mc_gross, mc_currency, address_name, address_street,
                                            address_city, address_state, address_zip, address_country, address_status, payment_status,
                                            pending_reason,  reason_code, txn_type)
                                    VALUES ('$payment_date', '$txn_id', '$first_name', 
                                        '$last_name', '$payer_email', '$payer_status', '$payment_type',  
                                        '$item_name',  $quantity, $mc_gross, '$mc_currency', '$address_name',
                                         '".nl2br($address_street)."', '$address_city', '$address_state', '$address_zip', 
                                         '$address_country', '$address_status', '$payment_status',
                                          '$pending_reason', '$reason_code', '$txn_type')";
                                    $rs = $conn->Execute ($qry);

                                    if ($rs){   
                                            $pp_status = "paid";
                                    } else {
                                  
                                        $pp_status = 'This was a duplicate transaction';
                                    }                                                                                                                                                                                                                                                           
                                } else {
                                     $val = addslashes($payment_amount.$receiver_email.$payment_currency.$real_total.$real_email.' fakeURL');
                                   
                                    $pp_status = "Someone attempted a sale using a manipulated URL.$val";
                                }
                            }
                            break;

                        case 'Failed':
                            // this will only happen in case of echeck.
                            $pp_status = "Failed Payment";
                        break;

                        case 'Denied':
                            // denied payment by us

                            $pp_status = "Denied Payment";
                        break;

                        case 'Refunded':
                            // payment refunded by us
                            $pp_status = "Refunded Payment";
                        break;

                        case 'Canceled':
                            // reversal cancelled
                            // mark the payment as dispute cancelled		

                            $pp_status = "Cancelled reversal";
                        break;

                        default:
                            // order is not good
                            $pp_status = "Unknown Payment Status";
                        break;

                    } 
                }else if (strcmp ($res, "INVALID") == 0) {
                // log for manual investigation
                  
                    $sql1 = "insert into pp_test values ('failed')";
                    $pp_status = "INVALID transaction";
                }
            }
        fclose ($fp);
        }
         $sql1 = "insert into pp_test values ('FromPP: $real_memberid, $pp_status..')";
            $rs = $conn->Execute ($sql1);

    }//else  echo "test2";
        
    
        $pp_status = addslashes ($pp_status);
        $sql = "update domains_list set status='$pp_status' where id=$real_memberid";
        $rs = $conn->Execute($sql);
?>

<!--
<form name="paypalForm"  action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post">
    <input type="image" src="https://www.sandbox.paypal.com/en_US/i/btn/x-click-but22.gif" name="submit">
    <input type="hidden" name="add" value="1">
    <input type="hidden" name="cmd" value="_cart">
    <input type="hidden" name="business" value="vmx007@gmail.com">
    <input type="hidden" name="item_name" value="Domain(s): test123.com">
    <input type="hidden" name="amount" value="6.00">
    <input type="hidden" name="no_note" value="1">
    <input type="hidden" name="currency_code" value="USD">
    <input type="hidden" name="notify_url" value="http://140.99.35.174/~develop/template3/member/paypal_handler.php">
    <input type="hidden" name="return" value="http://140.99.35.174/~develop/template3/member/paypal_hander.php">
    <input type="hidden" name="rm" value="2">
    <input type="hidden" name="cancel_return" value="http://140.99.35.174/~develop/template3/ipntest.php">
    <input type="hidden" name="bn" value="PP-ShopCartBF">
</form>
 -->


