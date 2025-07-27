<?php
function showWelcome()
{
	include("welcome.php");
	
	die();
}

function processStep1($message)
{
	$sub_version = explode("\.", PHP_VERSION);
	//var_dump(PHP_VERSION); var_dump($sub_version); exit; //debug code
	if(intval($sub_version[0]) < 4)
	{
		include("welcome.php");
		showAlertMsg("You PHP Version is too lower.");
		
		die();
	}else if(intval($sub_version[0]) == 4) {
		if(intval($sub_version[1]) < 1)
		{
			include("welcome.php");
			showAlertMsg("You PHP Version is too lower.");
			
			die();
		}
	}
	$database_type		= '';
	$database_host		= '';
	$database_username	= '';
	$database_password	= '';
	$database_name		= '';
	if (isset($_REQUEST["database_type"])) {
		$database_type		= handleData($_REQUEST["database_type"]);
	}
	if (isset($_REQUEST["database_host"])) {
		$database_host		= handleData($_REQUEST["database_host"]);
	}
	if (isset($_REQUEST["database_username"])) {
		$database_username	= handleData($_REQUEST["database_username"]);
	}
	if (isset($_REQUEST["database_password"])) {
		$database_password	= handleData($_REQUEST["database_password"]);
	}
	if (isset($_REQUEST["database_name"])) {
		$database_name		= handleData($_REQUEST["database_name"]);
	}
	include("step1.php");
	showAlertMsg($message);
	
	die();
}

function processStep2($message)
{
	$database_type		= handleData($_REQUEST["database_type"]);
	$database_host		= handleData($_REQUEST["database_host"]);
	$database_username	= handleData($_REQUEST["database_username"]);
	$database_password	= handleData($_REQUEST["database_password"]);
	$database_name		= handleData($_REQUEST["database_name"]);
	
	if($database_type == ""
		|| $database_host == ""
		|| $database_username == ""
		|| $database_password == ""
		|| $database_name == "")
	{
		processStep1("Please provide valid Database Connection Parameters");
	}

	if(intval($database_type) == 1)
	{
		$db_type = "mysql";
	}else {
		$db_type = "mssql";
	}
	$conn = &ADONewConnection($db_type);
	@$conn->PConnect($database_host, $database_username, $database_password, $database_name);
	if($db_type == "mysql")
	{
		if($conn->ErrorMsg() != "")
		{
			processStep1("Connect database server fail");
		}
	}else {
		if($conn->ErrorNo()!= 0)
		{
			processStep1("Connect database server fail");
		}
	}
	if(!is_writable("../server.inc.php")) 
//	if(!$fp = fopen("../server.inc.php", "w"))
	{
		processStep1("Create file fail. Check Permission of file server.inc.php");
	}
	if(!is_writable("../common/Smarty/smarty/templates_c")) {
		processStep1("Create file fail. Check Permission of directory template_c");
	}
	$fp = @fopen("../server.inc.php", "w");	
	$content = "<?php
	require_once(dirname(__FILE__) . '/session.inc.php');
	
	define(\"DB_TYPE\", \"" . $db_type . "\");
	define(\"DB_HOST\", \"" . $database_host . "\");
	define(\"DB_USER\", \"" . $database_username . "\");
	define(\"DB_PASSWORD\", \"" . $database_password . "\");
	define(\"DB_DATABASE\", \"" . $database_name . "\");
	define(\"ROOT_DIR\", dirname(__FILE__) . \"/\");
?>";
	fputs($fp, $content);
	fclose($fp);

	$content = "";
	if($db_type == "mysql")
	{
		$fp = fopen("../doc/database/mysql.sql", "r");
		while(!feof($fp))
		{
			$content .= fgets($fp, 256);
		}
		$contents = explode(";", $content);
		$c_count = count($contents);
		for($i = 0; $i < $c_count; $i ++)
		{
			$contents[$i] .= ";";
			$rs = $conn->Execute($contents[$i]);
			if(!$rs)
			{
				//echo $contents[$i-1];
				processStep1("Create database fail");
			}
		}
	}else {
		$fp = fopen("../doc/database/mssql.sql", "r");
		while(!feof($fp))
		{
			$content .= fgets($fp, 256);
		}
		$rs = $conn->Execute($content);
		if(!$rs)
		{
			processStep1("Create database fail");
		}
	}

	fclose($fp);
	$rs->Close();
	
	include("step2.php");
	
	die();
}

function processStep3($message)
{
	$admin_password1	= handleData($_REQUEST["admin_password1"]);
	$admin_password2	= handleData($_REQUEST["admin_password2"]);
	$admin_name		= handleData($_REQUEST["admin_name"]);
	$admin_dept		= handleData($_REQUEST["admin_dept"]);
//	$current_skin		= handleData($_REQUEST["current_skin"]);
	$website_language	= handleData($_REQUEST["website_language"]);
	$website_title		= handleData($_REQUEST["website_title"]);
	$website_copyright	= handleData($_REQUEST["website_copyright"]);
	$website_pagesize	= intval(handleData($_REQUEST["website_pagesize"]));
	$customer_id		= intval(handleData($_REQUEST["customer_id"]));
	$customer_password	= handleData($_REQUEST["customer_password"]);
	$support_email		= handleData($_REQUEST["support_email"]);
	
	if($admin_password1 == ""
		|| strlen($admin_password1) > 20 || checkAscii($admin_password1) )
	{
		include("step2.php");
		showAlertMsg("Please provide a valid value of Administrator Password");
		
		die();
	}
	if($admin_password1 != $admin_password2)
	{
		include("step2.php");
		showAlertMsg("The two Administrator Password should be the same");
		
		die();
	}
	if($admin_name == ""
		|| strlen($admin_name) > 50)
	{
		include("step2.php");
		showAlertMsg("Please provide a valid value of Administrator Name");
		
		die();
	}
	if($admin_dept == ""
		|| strlen($admin_dept) > 50)
	{
		include("step2.php");
		showAlertMsg("Please provide a valid value of Administrator Dept.");
		
		die();
	}
	if(checkMail($support_email))
	{
		include("step2.php");
		showAlertMsg("Please provide a valid value of Administrator E-mail.");
		
		die();
	}
	
/*	$d = dir("../templates");
	while($entry = $d->read())
	{
		if($entry == $current_skin)
		{
			$flag = 1;
			break;
		}
	}
	if($flag != 1)
	{
		include("step2.php");
		showAlertMsg("Please select a correct Website Skin");
		
		die();
	}*/
	if($website_language != 1 && $website_language != 2)
	{
		$website_language = 1;
	}
	if($website_title == ""
		|| strlen($website_title) > 100)
	{
		include("step2.php");
		showAlertMsg("Please provide a valid Website Title");
		
		die();
	}
	if($website_copyright == ""
		|| strlen($website_copyright) > 100)
	{
		include("step2.php");
		showAlertMsg("Please provide a valid Website Copyright");
		
		die();
	}	
	if($website_pagesize < 1 || $website_pagesize > 50)
	{
		include("step2.php");
		showAlertMsg("Please provide a valid Website Pagesize");
		
		die();
	}
	if($customer_id < 10000 || $customer_id > 10000000)
	{
		include("step2.php");
		showAlertMsg("Please provide a valid Customer ID (between 10000 and 10000000)");
		
		die();
	}
	if($customer_password == ""
		|| strlen($customer_password) > 20|| checkAscii($customer_password) )
	{
		include("step2.php");
		showAlertMsg("Please provide a valid Customer Password");
		
		die();
	}

	$rela_dir = $_SERVER["PHP_SELF"];
	$end_pos = strpos($rela_dir, "install/");
	$rela_dir = substr($rela_dir, 0, $end_pos);

	include("../server.inc.php");
	include("../common/db.inc.php");
	$conn = connectDB();
	$admin_password1	= handleSQLData($admin_password1);
	$admin_name		= handleSQLData($admin_name);
	$admin_dept		= handleSQLData($admin_dept);
	$support_email		= handleSQLData($support_email);
	$sql = "select * from admins";
	$rs = $conn->Execute($sql);
	if($rs)
	{
		if($rs->RecordCount() > 0)
		{
			include("step3.php");
			showAlertMsg("The Template 3 installation has been complete");
			
			die();
		}
	}
	if(DB_TYPE == "mysql")
	{
		$sql = "insert into admins(
				admin_id,		name,			dept,
				password,		add_time,		flag
			)values(" .
				"100, '" .		$admin_name . "', '" .	$admin_dept . "', '" .
				$admin_password1 . "', '" . getDatetime() . "', 0" .
			")";
	}else {
		$sql = "insert into admins(
				name,			dept,			password,
				add_time,		flag
			)values('" .
				$admin_name . "', '" .	$admin_dept . "', '" .	$admin_password1 . "', '" .
				getDatetime() . "', " .	"0" .
			")";
	}

	$rs = $conn->Execute($sql);
	if(!$rs)
	{
		include("step2.php");
		showAlertMsg("Insert data error in admin table");
		
		die();
	}

	//$current_skin		= handleSQLData($current_skin);
	$website_title		= handleSQLData($website_title);
	$website_copyright	= handleSQLData($website_copyright);
	$rela_dir		= handleSQLData($rela_dir);
	$sql = "insert into web_config(
			website_language,		title,
			copyright,			pagesize,			system_status,
			order_id,			customer_id,			password,
			reg_host,			reg_port,			rela_dir,
			dom_upg_host,			dom_upg_port,			dom_upg_url,
			support_email
		)values('" .
			$website_language . "', '" .	$website_title . "', '" .
			$website_copyright . "', " .	$website_pagesize . ", " .	"1" . ", " .
			"1" . ", " .			$customer_id . ", '" .		md5($customer_password) . "', '" .
			"218.5.81.149" . "', " .		"20001" . ", '" .		$rela_dir . "', '" .
			"www.onlinenic.com" . "', " .	"80" . ", '" .			"/english/template4/" . "', '" .
			$support_email .
		"')";
	$rs = $conn->Execute($sql);
	if(!$rs)
	{
		include("step2.php");
		showAlertMsg("Insert data error");
		
		die();
	}
	
	include("step3.php");
	
	die();
}
?>
