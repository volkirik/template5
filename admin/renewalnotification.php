<?php
include("../server.inc.php");
include(ROOT_DIR . "common/db.inc.php");
include(ROOT_DIR . "init.inc.php");
include(ROOT_DIR . "common/func.inc.php");
include(ROOT_DIR . "common/domain.inc.php");
//include(ROOT_DIR . "model/admin.registerdomain.php");
include(ROOT_DIR . "model/class.smtp.inc");

$sql = "select day1, day2, day3 from mail_data where type='renew'";
$rs = $conn->Execute ($sql);

$day1 = $rs->fields[0];
$day2 = $rs->fields[1];
$day3 = $rs->fields[2];

$sql = "select  domain_name, add_date, domain_year, admin from domains";
$rs =  $conn->Execute ($sql);
if (!$rs) 
   die();
	
while ($arr = $rs->FetchRow()) 
{
	$sql = "select to_days(date_add('".$arr[1]."', interval ".$arr[2]." year)) - to_days(curdate())";
	$res = $conn->Execute ($sql);
//			echo "<pre>";  print_r ($res->fields);  echo "</pre>";
	if ($res->fields[0] == $day1 || $res->fields[0] == $day2 || $res->fields[0] == $day3)
	{
	    ereg ("([0-9]{4})-([0-9]{2})-([0-9]{2})(.*)", $arr[1], $temp);
	    $year = $temp[1]+1;
		$expdate = $year.'-'.$temp[2].'-'.$temp[3].' '.$temp[4];
		
        fetch_mailtemplate ('renew', $macros, $subject, $body);

		$sql = "select  reg_name, email from contacts where contact_id =".$arr[3];
		$res = $conn->Execute($sql);

		$subject = ereg_replace ("%user%", $res->fields[0], $subject);
		$body = ereg_replace ("%user%", $res->fields[0], $body);
		$subject = ereg_replace ("%expdate%", $expdate, $subject);
		$body = ereg_replace ("%expdate%", $expdate, $body);
		$subject = ereg_replace ("%domains%", $arr[0], $subject);
		$body = ereg_replace ("%domains%", $arr[0], $body);

		mail_user ($res->fields[1], $subject, $body);
	}
}

?>
