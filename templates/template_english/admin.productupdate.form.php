<?php

	$smarty->assign ('content_title', 'Add domain type');
	$smarty->assign ('content_tip', 'Please enter the queries for adding the new domain type
	                    (Sample queries are shown below)');

	$smarty->assign ('content_warning', $message);
	
    $smarty->assign ('php_self', $_SERVER["PHP_SELF"]);
	
    $smarty->assign ('sql_products',
	                 "insert into products(product_id, domain_type, product_name, product_type, flag)
			            values (7000, 808, '.in', 1, 1) " );
	$smarty->assign ('sql_ordermode1',
	                 "   insert into ordermode(mode_id, mode_lan, mode_name, product_id, mode_type)
					  values (7001, 1, '.in registration fee', 7000, 1)");
	$smarty->assign ('sql_ordermode2',	
		             "insert into ordermode(mode_id, mode_lan, mode_name, product_id, mode_type) values
				     (7002, 1, '.in deletion fee', 7000, 2)");
	$smarty->assign ('sql_ordermode3',
	                  "insert into ordermode(mode_id, mode_lan, mode_name, product_id, mode_type) values
					 (7003, 1, '.in renewal fee', 7000, 3)");
	$smarty->assign ('sql_ordermode4',
	                  "insert into ordermode(mode_id, mode_lan, mode_name, product_id, mode_type) values
					 (7004, 1, '.in refund fee', 7000, 4)");

	$smarty->assign ('sql_ordermode5',
	                  "insert into ordermode(mode_id, mode_lan, mode_name, product_id, mode_type) values
					  (7005, 1, '.in domain sync fee', 7000, 5)");
					 
	$smarty->assign ('content_header', CURRENT_THEME.'/content.header.tpl');
	$smarty->assign ('content_body', CURRENT_THEME.'/admin.productupdate.form.tpl');
	
?>