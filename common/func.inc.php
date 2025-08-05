<?php
if (!function_exists('split')) {
    function split($pattern, $subject, $limit=-1, $flags=0){
        $is_regex=preg_split($pattern, $subject, $limit, $flags);
        if ($is_regex===FALSE){
        	return explode($pattern, $subject, $limit, $flags);
        }
        return $is_regex;
    }
}
if (!function_exists('ereg')) {
    function ereg($pattern, $string, &$regs = null) {
        // Önce boş bir pattern ise, başarısız olsun
        if (!is_string($pattern) || trim($pattern) === '') {
            return false;
        }

        // Eğer pattern zaten '/' ile başlamıyorsa, sar
        if ($pattern[0] !== '/') { //if (@preg_match($pattern, '') === false) {
            // Modifier hatalarını önlemek için: delimiter olarak # kullanalım
            $escaped = preg_replace('/(?<!\\\\)#/', '\\\\#', $pattern);
            $pattern = '#' . $escaped . '#';
        }

        $result = preg_match($pattern, $string, $matches);
        if ($result && $regs !== null) {
            $regs = $matches;
        }

        return $result;
        //var_dump($result);
    }
}

require_once ('Whois/WhoisHandler.php');
require_once ('Whois/Whois.php');
require_once ('Whois/Checker.php');
	
use MonoVM\WhoisPhp\WhoisHandler;
use MonoVM\WhoisPhp\Whois;
use MonoVM\WhoisPhp\Checker;
	
/**************************************************************************************************/
/*  Database operation										  */
/**************************************************************************************************/
function insertMoneyMode($member_id, $order_type, $mode_id, $order_amount, $note)
{
	global $conn;
	
	$sql = "select account from members where member_id = " . $member_id;
	$rs = $conn->Execute($sql);
	if(!$rs)
	{
		return -1;
	}
	if($rs->RecordCount() != 1)
	{
		return -2;
	}
	
	$sql = "insert into orders(
			member_id,		order_date,		order_type,
			mode_id,		order_amount,		amount,
			admin_id,		note
		)values(
			" . $member_id . ", '" . getDatetime() . "', " . $order_type .
			", " . $mode_id . ", " . $order_amount . ", " . $rs->fields[0] .
			", 100, '" . 		$note .
		"')";
    //echo "<br> InsertMoneyMode ". $sql;
	$rs = $conn->Execute($sql);
	
    if(!$rs)
	{
		//echo $conn->ErrorMsg();
		return -3;
	}
	
	return 0;
}

function updateFunds($member_id, $type, $amount)
{
	global $conn;
	
	if($type == 1)
	{
		$sql = "update members set account = account + " . $amount . " where member_id = " . $member_id;
	}else {
		$sql = "update members set account = account - " . $amount . " where member_id = " . $member_id;
	}
	    //echo "<br> Updatefunds ".$sql;
	$rs = $conn->Execute($sql);
	if(!$rs)
	{
		return -1;
	}
	
	return 0;
}

function checkBalance ($member_id, $amount){
    global $conn;
    
    $sql = "select account from members where member_id = " . $member_id;
    $rs = $conn->Execute ($sql);
    
	if (!$rs)
		showErrors (" Could not query the balance amount.");

    if ($rs->fields[0] < $amount)
        return -1;
    else
        return 0;
}

function getDefaultDns($product_id)
{
	global $conn;
	
	$sql = "select * from default_dns where product_id = " . $product_id;
	$rs = $conn->Execute($sql);
	if(!$rs)
	{
		showErrorMsg($conn->ErrorMsg());
	}
	if($rs->RecordCount() != 2)
	{
		$default_dns[0] = "ns1.onlinenic.com";
		$default_dns[1] = "ns2.onlinenic.com";
	}else {
		$default_dns[0] = $rs->fields[2];
		$rs->MoveNext();
		$default_dns[1] = $rs->fields[2];
		$rs->Close();
	}
	
	return $default_dns;
}

function getProductPrice($product_id, $member_level, $type)
{
	global $conn;
	
	for($i = 1; $i < 11; $i ++)
	{
		$reg_prices[$i] = 0.0;
	}
	$sql = "select *
		from	member_price
		where	product_id = " . $product_id . "
			and member_level = " . $member_level . "
			and type = " . $type . "
		order by i_year";
	//echo "pdt price sql ..".$sql."<br>";
	$rs = $conn->Execute($sql);

	if(!$rs)
	{
		showErrorMsg($conn->ErrorMsg());
	}
	while(!$rs->EOF)
	{
		$i_year		= $rs->fields[4];
		$d_price	= $rs->fields[5];
		
		$reg_prices[$i_year] = $d_price;
		$rs->MoveNext();
	}
	$rs->Close();
	
	return $reg_prices;
}

function getProductInfo($product_id)
{
	global $conn;
	
	$sql = "select *
		from	products
		where	flag = 0
			and product_id = " . $product_id;
	$rs = $conn->Execute($sql);
	if(!$rs)
	{
		showErrorMsg($conn->ErrorMsg());
	}
	if($rs->RecordCount() != 1)
	{
		showErrorMsg($conn->ErrorMsg());
	}
	$product_info = $rs->FetchRow();
	$rs->Close();
	
	return $product_info;
}

function getMemberid ($username){
    global $conn;
    
    $sql = "select member_id from members where flag=0 and member_name='". $username ."'";
    $rs = $conn->Execute($sql);
	if(!$rs)
        showErrors ("Cannot get the member id for the user $username");

    return $rs->fields [0];
}

function getCountryInfo()
{
	global $conn;
	
	$sql = "select * from country";
	$rs = $conn->Execute($sql);
	if(!$rs)
	{
		showErrorMsg($conn->ErrorMsg());
	}
	while(!$rs->EOF)
	{
		$countries[$rs->fields[1]]	= $rs->fields[0];
		$rs->MoveNext();
	}
	
	return $countries;
}



function getBalance($member_id)
{
	global $conn;
	
	$sql = "select	account
		from	members
		where	member_id = " . $member_id;
	$rs = $conn->Execute($sql);
	if(!$rs)
	{
		showErrorMsg($conn->ErrorMsg());
	}
	if($rs->RecordCount() != 1)
	{
		showErrorMsg(ADMIN_0005);
	}
	
	return $rs->fields[0];
}

function getModeID($product_id, $type)
{
	global $conn;
	
	$sql = "select mode_id from ordermode where product_id = " . $product_id . " and mode_type = " . $type;
	//echo "<br> testing ordermode query ".$sql."<br>";
	$rs = $conn->Execute($sql);
	if(!$rs)
	{
		showErrorMsg($conn->ErrorMsg());
	}
	$mode_id = $rs->fields[0];
	$rs->Close();
	
	return $mode_id;
}

function getClTrid()
{
	global $conn;
	
	$sql = "update web_config set order_id = order_id + 1";
	$rs = $conn->Execute($sql);
	if(!$rs)
	{
		showErrorMsg($conn->ErrorMsg());
	}
	
	$sql = "select  order_id, now()from web_config";
	$rs = $conn->Execute($sql);
	if(!$rs)
	{
		showErrorMsg($conn->ErrorMsg());
	}
	if($rs->RecordCount() != 1)
	{
		showErrorMsg(ADMIN_0005);
	}
	return "Helloeveryone-" . $rs->fields[0].time();
	//return "Helloeveryone-" . $rs->fields[0].$rs->fields[1];
}

function getProductId($domain_name){
        global $conn;
        ereg ("(.*)(\.[a-z]{2,4})$", $domain_name, $res1);
        $query = "select product_id from products where product_name='".$res1[2]."'";
        $res2 = $conn->Execute ($query);
	    return $res2->fields[0];
}

/**************************************************************************************************/
/*  Network operation										  */
/**************************************************************************************************/
function getServerDomainList()
{
	return getHTML(DOM_UPG_HOST, DOM_UPG_PORT, DOM_UPG_URL . "/domainList.dat");
}

function getServerDomainDetail($product_id)
{
	return getHTML(DOM_UPG_HOST, DOM_UPG_PORT, DOM_UPG_URL . "/" . $product_id . ".dat");
}



function onlinenicWhois($domain)
{
	$whoisHandler = WhoisHandler::whois($domain);

	$message = $whoisHandler->getWhoisMessage();
	$message = preg_replace('/<[^>]*>/', '', $message);

	//var_dump($message); exit; //debug
	return '<pre>'.$message.'</pre>';

	//$host		= "192.0.34.129"; 
	$host		= "reports.internic.net";
	$port		= 80;
	$url = "/cgi/whois?whois_nic={$domain}&type=domain";
	//echo $url;
	if(!($result = getHTML($host, $port, $url)) == -1)	{
		return -1;
	}else {
		if(!($start_position = strpos($result, "<pre>"))) {
			return -2;
		}else {
			if(!($end_position = strpos($result, "</pre>"))) {
				return -3;
			}else {
				$start_position += 5;
				$result = substr($result, $start_position, $end_position - $start_position);
				
				return $result;
			}
		}
	}
}


function getHTML($host, $port, $url)
{
	if(!($fp = fsockopen($host, $port, $errno, $errstr, 150)))
	{
		return -1;
	}
	fputs($fp, "GET " . $url . " HTTP/1.0\r\n\r\n");
	while(!feof($fp))
	{
		$result .= fread($fp, 128);
	}
	
	return $result;
}

function connectRegServer(&$fp)
{
	if(!($fp = fsockopen(REG_HOST, REG_PORT, $errno, $errstr, 200)))
	{
		return -1;
	}
//	echo REG_PORT;
	//socket_set_blocking($fp, TRUE);
	$i = 0;
	$result="";
	while(!feof($fp))
	{	
		$i ++;
		$line = fgets($fp, 2);
		$result .= $line;
		if(ereg("</epp>$", $result))
		{
			break;
		}
		if ($i > 5000) break;
	}
	
	if(ereg("</greeting></epp>$", $result))
	{
		return 0;
	}else {
		return -1;
	}
}

function sendCommand($fp, $command)
{
	@fputs($fp, $command);
	$i = 0;
	while(!@feof($fp))
	{
		$i ++;
		$line = fgets($fp, 2);
		$result .= $line;
		if(ereg("</epp>$", $result))
		{
			break;
		}
		if ($i > 5000) break;
	}
	
	//$myfile = fopen("abc.txt", "a");
	//fwrite($myfile, $command . "\n" . $result);
	//fclose($myfile);
	return $result;
}

/**************************************************************************************************/
/*  Common operation										  */
/**************************************************************************************************/
function handleData($data)
{
	if (!is_string($data)) {
        	return '';
    	}
	return trim(StripSlashes($data));
}

function handleSQLData($data)
{
	$myData = str_replace("'", "''", $data);
	if(DB_TYPE == "mysql")
	{
		$myData = str_replace("\\", "\\\\", $myData);
	}
	
	return $myData;
}

function checkSystemStatus()
{   global $smarty, $member_info;
	
#if (isset ($smarty) ) echo "test1";	
#else echo "test2";
	if(SYSTEM_STATUS == 1)
	{
		include(ROOT_DIR . "templates/" . CURRENT_SKIN . "/title.inc.php");
		include(ROOT_DIR . "templates/" . CURRENT_SKIN . "/system.stop.php");
		include(ROOT_DIR . "templates/" . CURRENT_SKIN . "/tail.inc.php");
		$smarty->display(CURRENT_THEME.'/page.structure.tpl');
		die();
	}
}

function checkMail($email)
{
	if(ereg("^[a-zA-Z0-9_\.]+@[a-zA-Z0-9\-]+[\.a-zA-Z0-9]+$", $email))
	{
		return 0;
	}else {
		return 1;
	}
}

function checkAscii($ascii)
{
	if(ereg("^[a-zA-Z0-9 \.\,\+\!\@\#\$\%\^\&\*\(\)\~\/]+$", $ascii))
	{
		return 0;
	}else {
		return 1;
	}
}

function checkAlpha($alpha)
{
	if(ereg("^[a-zA-Z ]+$", $alpha))
	{
		return 0;
	}else {
		return 1;
	}
}

function checkAlphaNum ($alphanum)
{
	if(ereg("^[0-9a-zA-Z ]+$", $alphanum))
	{   if (ereg("[^0-9]+", $alphanum))
		    return 0;
		else
		    return 1;
	}else {
		return 1;
	}
}

function checkLength($str, $length)
{
	if(strlen($str) > $length)
	{
		return -1;
	}
	
	return 0;
}

function checkNumeric($num)
{
	if(ereg("^[0-9]+$", $num))
	{
		return 0;
	}else {
		return 1;
	}
}

function checkDigit($digit)
{
	if(ereg("^[0-9]+$", $digit))
	{
		return 0;
	}else {
		return 1;
	}
}

function checkDns($dns)
{
	if(eregi("^[a-z0-9\+\.\-]+[a-z]+$", $dns))
	{
		return 0;
	}else {
		return 1;
	}
}

function getDatetime()
{
	return date("Y-m-d H:i:s");
}

function getDateo()
{
	return date("Y-m-d");
}

function onlinenicValidateDomain($domain)
{
	if(strlen($domain) > 63)
	{
		return 1;
	}
	if(ereg("^[a-z0-9][a-z0-9\-]+[a-z0-9]$", $domain))
	{
		return 0;
	}else {
		return 1;
	}
}

function onlinenicGetValue($msg, $str1, $str2)
{
	$start_pos = strpos($msg, $str1);
	$stop_post = strpos($msg, $str2);
	$start_pos += strlen($str1);
	return substr($msg, $start_pos, $stop_post - $start_pos);
}

function getResultCode($result)
{
	$start_pos = strpos($result, "<result code=\"");
	return substr($result, $start_pos + 14, 4);
}

function generate_password()
{
	$fillers = "1234567890!@#$%&*-_=+^";
	$fillers .= date('h-i-s, j-m-y, it is w Day z ');
	$fillers .= "123!@#$%&*-_4567!@#$%&*-_890=+^";
	$temp = md5($fillers);
	$temp = substr($temp, 5, 10);
	
	return $temp;
}

/**************************************************************************************************/
/*  Interface operation										  */
/**************************************************************************************************/
function showTitle($title)
{
?>
	<table width="95%" border="0" cellspacing="0" cellpadding="0" align="center">
	  <tr>
	    <td><br><font class="title"><b><i><?php echo $title ?></i></b></font></td>
	  </tr>
	  <tr>
	    <td><img src="<?php echo RELA_DIR ?>templates/<?php echo CURRENT_SKIN ?>/images/line_4.gif"></td>
	  </tr>
	</table>
<?php
}

function initPage($rs, $pageSize, &$currentPage, &$pageCount, &$totalRecord)
{
	$totalRecord = $rs->RecordCount();
	$pageCount = $totalRecord / $pageSize;
	if(!is_int($pageCount))
	{
		$pageCount = intval($pageCount);
		$pageCount += 1;
	}
	
	$currentPage = intval($currentPage);
	if($currentPage < 1)
	{
		$currentPage = 1;
	}
	if($currentPage > $pageCount)
		$currentPage = $pageCount;
}

function showPageButton($currentPage, $pageCount, $totalRecord, $webaddress)
{  $output = ""; 
	if($currentPage > 1)
	{
		if($currentPage < $pageCount)
		{

	    $output .= '<input type=button value= "|<"  onClick=document.location.href="'.
		        $webaddress.'&currentPage=1" style=font-size:9pt;height:14pt;width=20pt>
				  <input type=button value= "<"  onClick=document.location.href="'.
				  $webaddress.'&currentPage='.($currentPage-1).' " style=font-size:9pt;height:14pt;width=20pt>
				  <input type=button value= ">"  onClick=document.location.href="'.
				  $webaddress.'&currentPage='.($currentPage+1).'" style=font-size:9pt;height:14pt;width=20pt>
				  <input type=button value= ">|"  onClick=document.location.href="'.
				  $webaddress.'&currentPage='.$pageCount.'" style=font-size:9pt;height:14pt;width=20pt>';

		}else {

    	$output .= '<input type=button value= "|<"  onClick=document.location.href="'.
		        $webaddress.'&currentPage=1" style=font-size:9pt;height:14pt;width=20pt>
				<input type=button value= "<"  onClick=document.location.href="'. 
				$webaddress.'&currentPage='. ($currentPage-1).'" style=font-size:9pt;height:14pt;width=20pt>
				<input type=button value= ">"  disabled style=font-size:9pt;height:14pt;width=20pt>
				<input type=button value= ">|"  disabled style=font-size:9pt;height:14pt;width=20pt>';
		}
	}else {
		if($currentPage < $pageCount)
		{
        $output .= '<input type=button value="|<" disabled style=font-size:9pt;height:14pt;width=20pt>
		<input type=button value= "<"  disabled style=font-size:9pt;height:14pt;width=20pt>
		<input type=button value= ">"  onClick=document.location.href="'.$webaddress.
		'&currentPage='.($currentPage+1).'" style=font-size:9pt;height:14pt;width=20pt>
		<input type=button value= ">|"  onClick=document.location.href="'. $webaddress.
		'&currentPage='.$pageCount.'" style=font-size:9pt;height:14pt;width=20pt>';

		}else {

    	$output .='<input type=button value= "|<"  disabled style="font-size:9pt;height:14pt;width=20pt">
		<input type=button value= "<"  disabled style="font-size:9pt;height:14pt;width=20pt">
		<input type=button value= ">" disabled style="font-size:9pt;height:14pt;width=20pt">
		<input type=button value= ">|"  disabled style="font-size:9pt;height:14pt;width=20pt">';

		}
	}
	if(WEBSITE_LANGUAGE == 2)
	{
		$output .= $currentPage . "/" . $pageCount . " sayfalar toplam: " . $totalRecord . " kayıtlar";
	}else {
		$output .= $currentPage . "/" . $pageCount . " pages totals: " . $totalRecord . " records";
	}
	
	return $output;
}

function showErrorMsg($msg)
{ global $smarty;
	include(ROOT_DIR . "templates/" . CURRENT_SKIN . "/title.inc.php");
	include(ROOT_DIR . "templates/" . CURRENT_SKIN . "/system.error.php");
	include(ROOT_DIR . "templates/" . CURRENT_SKIN . "/tail.inc.php");
	
	$smarty->display(CURRENT_THEME.'/page.structure.tpl');
	
	die();
}

function showAdminErrorMsg($msg)
{global $smarty;
	include(ROOT_DIR . "templates/" . CURRENT_SKIN . "/admin.title.inc.php");
	include(ROOT_DIR . "templates/" . CURRENT_SKIN . "/system.error.php");
	include(ROOT_DIR . "templates/" . CURRENT_SKIN . "/admin.tail.inc.php");
	$smarty->display(CURRENT_THEME.'/page.structure.tpl');
	die();
}

function showErrors($msg){
    global $smarty,  $currentuser;
    
    $user_info = $currentuser->checkAdminLogin();
    if ($user_info == -1)
        include(ROOT_DIR . "templates/" . CURRENT_SKIN . "/title.inc.php");
    else
        include(ROOT_DIR . "templates/" . CURRENT_SKIN . "/admin.title.inc.php");
    
    include(ROOT_DIR . "templates/" . CURRENT_SKIN . "/system.error.php");
        
    include(ROOT_DIR . "templates/" . CURRENT_SKIN . "/admin.tail.inc.php");
    $smarty->display(CURRENT_THEME.'/page.structure.tpl');
	die();
}

function flagErrorMsg($msg)
{
    global $smarty, $currentuser;
    
    $info = $currentuser->checkAdminLogin();
    if($admin_info == -1)
        include(ROOT_DIR . "templates/" . CURRENT_SKIN . "/title.inc.php");
    else
        include(ROOT_DIR . "templates/" . CURRENT_SKIN . "/admin.title.inc.php");
	
    include(ROOT_DIR . "templates/" . CURRENT_SKIN . "/system.error.php");
	include(ROOT_DIR . "templates/" . CURRENT_SKIN . "/admin.tail.inc.php");
	$smarty->display(CURRENT_THEME.'/page.structure.tpl');
	die();
}

function showAlertMsg($msg)
{
	if($msg != "")
	{
?>
	<script language="javascript">
		alert("<?php echo $msg ?>");
	</script>
<?php
	}
}

function showWarningMsg($msg)
{
	if($msg)
	{
?>
	<table width="95%" border="0" cellspacing="0" cellpadding="0" align="center">
            <tr>
              <td width="25%" height="25" colspan="2" bgcolor="#F2F7F9">
                <div style="border:solid 1px #878DC7;padding:5px">
                  <font class="p8" color="#FF0000"><b><?php echo $msg ?></b></font>
                </div>
              </td>
            </tr>
	</table>
	<br>
<?php
	}
}

function showTip($msg)
{
?>
	<table width="535" border="0" cellspacing="0" cellpadding="0" align="center">
	  <tr> 
	    <td width="10" height="4"><img src="<?php echo RELA_DIR ?>templates/<?php echo CURRENT_SKIN ?>/images/1_01.jpg" width="11" height="9"></td>
	    <td width="65" height="4"><img src="<?php echo RELA_DIR ?>templates/<?php echo CURRENT_SKIN ?>/images/2_01.jpg" width="59" height="9"></td>
	    <td width="10" height="4" background="<?php echo RELA_DIR ?>templates/<?php echo CURRENT_SKIN ?>/images/3_01.jpg"><img src="<?php echo RELA_DIR ?>templates/<?php echo CURRENT_SKIN ?>/images/3_01.jpg" width="5" height="9"></td>
	    <td width="435" height="4"><img src="<?php echo RELA_DIR ?>templates/<?php echo CURRENT_SKIN ?>/images/4_01.jpg" width="452" height="9"></td>
	    <td width="10" height="4"><img src="<?php echo RELA_DIR ?>templates/<?php echo CURRENT_SKIN ?>/images/5_01.jpg" width="9" height="9"></td>
	  </tr>
	  <tr> 
	    <td width="10" background="<?php echo RELA_DIR ?>templates/<?php echo CURRENT_SKIN ?>/images/1_02.jpg"><img src="<?php echo RELA_DIR ?>templates/<?php echo CURRENT_SKIN ?>/images/1_02.jpg" width="11" height="4"></td>
	    <td width="65" bgcolor="#FDF5E3" align="center" valign="top"><img src="<?php echo RELA_DIR ?>templates/<?php echo CURRENT_SKIN ?>/images/light.jpg"></td>
	    <td width="10" background="<?php echo RELA_DIR ?>templates/<?php echo CURRENT_SKIN ?>/images/3_02.jpg"><img src="<?php echo RELA_DIR ?>templates/<?php echo CURRENT_SKIN ?>/images/3_02.jpg" width="5" height="5"></td>
	    <td width="435" valign="top">
	      <table width="100%" cellspacing="0" cellpadding="5">
	        <tr>
	          <td>
	          <?php echo $msg ?>
	          </td>
	        </tr>
	      </table>
	    </td>
	    <td width="10" background="<?php echo RELA_DIR ?>templates/<?php echo CURRENT_SKIN ?>/images/5_02.jpg"><img src="<?php echo RELA_DIR ?>templates/<?php echo CURRENT_SKIN ?>/images/5_02.jpg" width="9" height="8"></td>
	  </tr>
	  <tr> 
	    <td width="10"><img src="<?php echo RELA_DIR ?>templates/<?php echo CURRENT_SKIN ?>/images/1_03.jpg" width="11" height="9"></td>
	    <td width="65"><img src="<?php echo RELA_DIR ?>templates/<?php echo CURRENT_SKIN ?>/images/2_02.jpg" width="59" height="9"></td>
	    <td width="10"><img src="<?php echo RELA_DIR ?>templates/<?php echo CURRENT_SKIN ?>/images/3_03.jpg" width="5" height="9"></td>
	    <td width="435"><img src="<?php echo RELA_DIR ?>templates/<?php echo CURRENT_SKIN ?>/images/4_02.jpg" width="452" height="9"></td>
	    <td width="10"><img src="<?php echo RELA_DIR ?>templates/<?php echo CURRENT_SKIN ?>/images/5_03.jpg" width="9" height="9"></td>
	  </tr>
	</table>
	<br>
<?php
}

 function fetch_mailtemplate($type, &$macros, &$subject, &$body){
    global $conn;

	$sql = "select * from mail_data where type='".$type."'";
	$rs = $conn->Execute ($sql);
	if(!$rs)
		showErrorMsg($conn->ErrorMsg());
		
	$macros = explode (",", handleSQLData($rs->fields[4]));
	$subject = handleSQLData ($rs->fields[2]);
	$body   =  handleSQLData ($rs->fields[3]);
 }

  
 function mail_user ($email, $subject, $body){
    global $conn;
	
	$sql = "select * from mail_settings";
	
	$rs = $conn->Execute ($sql);
	if(!$rs)
		showErrorMsg($conn->ErrorMsg());
	
	if ($rs->fields[5] != 1)
	    showErrorMsg ("Password reset option is currently disabled.");
	
	if ($rs->fields[6] == 'sendmail')
	{
	    $headers = "Content-Type: text/html;CHARSET=iso-8859-8-i\r\n";
        $headers .= "Reply-To: ".$rs->fields[2]."\r\nReturn-path: ".$rs->fields[2]."\r\nFrom: ".$rs->fields[2]."\r\n";
	    mail ($email, $subject, $body, $headers);
		return 0;
	}else{
		$params['host'] = $rs->fields[8];
		$params['port'] = $rs->fields[11];
		$params['helo'] = exec ('hostname');
		$params['user'] = $rs->fields[9];
		$params['pass'] = $rs->fields[10];

		if ($rs->fields[7] == 1)
			$params['auth'] = TRUE;
		else
			$params['auth'] = FALSE;

		$send_params['recipients']	= array($email);
		$send_params['headers']		= array('Date: '.date("r"),
											'From: "'.$rs->fields[1].'" <'.$rs->fields[2].'>',
											'To: '.$email,
											'Subject: '.$subject
										);
		$send_params['from']		= $rs->fields[2];

		$send_params['body']		= $body;
	    if (is_object ($smtp = smtp::connect($params)) AND $smtp->send($send_params))
		    return 0;
		else 
		    return -1;
	}
    
 } 

 function getGtld ($domain){
    ereg ("(.*)(\.[a-z]{2,4})$", $domain, $res);
    return $res[2];
 }
 


?>
