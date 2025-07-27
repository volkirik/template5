<?php
class ProductUpdate
{
	function showNewDomain($message)
	{
		global $conn;
		global $smarty;
		
		include(ROOT_DIR . "templates/" . CURRENT_SKIN . "/admin.title.inc.php");
		include(ROOT_DIR . "templates/" . CURRENT_SKIN . "/admin.productupdate.form.php");
		include(ROOT_DIR . "templates/" . CURRENT_SKIN . "/admin.tail.inc.php");
		
		$smarty->display(CURRENT_THEME.'/page.structure.tpl');
		die();
	}
	
	function upgradeDomain()
	{
		global $conn, $smarty;
		
		$sql1 = handleData ($_REQUEST['sql_products']);
		$sql2 = handleData ($_REQUEST['sql_ordermode1']);
		$sql3 = handleData ($_REQUEST['sql_ordermode2']);
		$sql4 = handleData ($_REQUEST['sql_ordermode3']);
		$sql5 = handleData ($_REQUEST['sql_ordermode4']);
		$sql6 = handleData ($_REQUEST['sql_ordermode5']);
		
		if ($sql1 == '' || $sql2 == '' || $sql3 == '' || $sql4 == '' || $sql5 == '' || $sql6 == '')
		    $this->showNewDomain (ADMIN_0041);
		   if (ereg ("(.*)(')(\.[a-z]{2,4})(')",$sql1,$reg2)){
/*		           echo "<pre>";
		           print_r($reg2);
		           echo "</pre>";*/
			   $sql    = "select id from products where product_name='$reg2[3]'";
		           $rs     = $conn->Execute ($sql);
            		   if ($rs->RecordCount() > 0)
	                   $this->showNewDomain ("Domain Extension Already Exist");

        	} else
		           $this->showNewDomain ("Invalid Query Submiited");


		 if (ereg ("(.*)(')(\.[a-z]{2,4})(')",$sql1,$reg3)){
			   $val= explode("(",$sql1);
			/*   echo "<pre>";
			   print_r($val);
		           echo "<pre>";*/
			   $value= explode(",",$val[2]);
/*		           echo "<pre>";
		           print_r($value);
	        	   echo "<pre>";*/
   
			   $sql    = "select id from products where product_id='$value[0]' or domain_type='$value[1]'";
		           $rs     = $conn->Execute ($sql);

		           if ($rs->RecordCount() > 0)
		               $this->showNewDomain ("Already Existing product_id or domain_type. Change ordermode queries accordingly.");
		}else
	           $this->showNewDomain ("Invalid Ordermode Query Submiited");

		if (ereg ("(.*)(')(\.[a-z]{2,4})(')",$sql2,$reg3)){
			   $val= explode("(",$sql2);
/*        		   echo "<pre>";
		           print_r($val);
		           echo "<pre>";*/
		           $value= explode(",",$val[2]);
/*		           echo "<pre>";
		           print_r($value);
		           echo "<pre>";*/

		           $sql    = "select ordermode_id from ordermode where mode_id='$value[0]'";
		           $rs     = $conn->Execute ($sql);

	      		   if ($rs->RecordCount() > 0)
		               $this->showNewDomain ("Change ordermode_id according to product_id");
		}else
        	   $this->showNewDomain ("Invalid Ordermode Query Submiited");
	
	
		 if (ereg ("(.*)(')(\.[a-z]{2,4})(')",$sql3,$reg3)){
			   $val= explode("(",$sql3);
/*		           echo "<pre>";
		           print_r($val);
             		   echo "<pre>";*/
			   $value= explode(",",$val[2]);
/*		           echo "<pre>";
		           print_r($value);
		           echo "<pre>";*/

		           $sql    = "select ordermode_id from ordermode where mode_id='$value[0]'";
		           $rs     = $conn->Execute ($sql);

		           if ($rs->RecordCount() > 0)
		           $this->showNewDomain ("Change ordermode_id according to product_id");
		}else
	           $this->showNewDomain ("Invalid Ordermode Query Submiited");

		if (ereg ("(.*)(')(\.[a-z]{2,4})(')",$sql4,$reg3)){
			   $val= explode("(",$sql4);
/*		           echo "<pre>";
		           print_r($val);
		           echo "<pre>";*/
		           $value= explode(",",$val[2]);
/*		            echo "<pre>";
		           print_r($value);
		             echo "<pre>";*/

		           $sql    = "select ordermode_id from ordermode where mode_id='$value[0]'";
		           $rs     = $conn->Execute ($sql);

		           if ($rs->RecordCount() > 0)
               			$this->showNewDomain ("Change ordermode_id according to product_id");
		}else
	           $this->showNewDomain ("Invalid Ordermode Query Submiited");

		if (ereg ("(.*)(')(\.[a-z]{2,4})(')",$sql5,$reg3)){
			   $val= explode("(",$sql5);
		
/*		           echo "<pre>";
		           print_r($val);
             		   echo "<pre>";*/
			   $value= explode(",",$val[2]);
/*		           echo "<pre>";
		           print_r($value);
        		   echo "<pre>";*/

		           $sql    = "select ordermode_id from ordermode where mode_id='$value[0]'";
		           $rs     = $conn->Execute ($sql);

		           if ($rs->RecordCount() > 0)
		               $this->showNewDomain ("Change ordermode_id according to product_id");
		}else
	           $this->showNewDomain ("Invalid Ordermode Query Submiited");

		if (ereg ("(.*)(')(\.[a-z]{2,4})(')",$sql6,$reg3)){
			$val= explode("(",$sql6);
/*		            echo "<pre>";
		           print_r($val);
        		   echo "<pre>";*/
			   $value= explode(",",$val[2]);
/*        		   echo "<pre>";
	        	   print_r($value);
	        	   echo "<pre>";*/
	
		           $sql    = "select ordermode_id from ordermode where mode_id='$value[0]'";
        		   $rs     = $conn->Execute ($sql);

		           if ($rs->RecordCount() > 0)
        	     		  $this->showNewDomain ("Change ordermode_id according to product_id");
	      }else
           $this->showNewDomain ("Invalid Ordermode Query Submiited");

    if (ereg ("(.*)(')(\.[a-z]{2,4})(')",$sql1,$reg2)){
/*           echo "<pre>";
           print_r($reg2);
           echo "</pre>";     */
       $sql    = "select id from products where product_name='$reg2[3]'";
           
	     $rs     = $conn->Execute ($sql);
            
            if ($rs->RecordCount() > 0)
                $this->showNewDomain ("Domain Extension Already Exist");   
	    
	} else 
           $this->showNewDomain ("Invalid Query Submiited");
    
		$rs = $conn->Execute($sql1);
		if(!$rs)
		{
			$this->showNewDomain(ADMIN_0040);
		}

		$rs = $conn->Execute($sql2);
		if(!$rs)
		{
			$this->showNewDomain(ADMIN_0040);
		}
		
		$rs = $conn->Execute($sql3);
		if(!$rs)
		{
			$this->showNewDomain(ADMIN_0040);
		}
		
		$rs = $conn->Execute($sql4);
		if(!$rs)
		{
			$this->showNewDomain(ADMIN_0040);
		}
		
		$rs = $conn->Execute($sql5);
		if(!$rs)
		{
			$this->showNewDomain(ADMIN_0040);
		}
		
		$rs = $conn->Execute($sql6);
		if(!$rs)
		{
			$this->showNewDomain(ADMIN_0040);
		}
	/*	if($rs->RecordCount() > 0)
		{
		}
	*/
        $this->showNewDomain("Successfully added new domain type.");
	}
}
?>
