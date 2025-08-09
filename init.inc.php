<?php
require_once(dirname(__FILE__) . "/session.inc.php");
@error_reporting(E_ALL & ~E_NOTICE & ~E_STRICT & ~E_DEPRECATED);
@ini_set("display_errors", false);
@ini_set("log_errors", true);
@ini_set("error_log", realpath(dirname(__FILE__) . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . "logs" . DIRECTORY_SEPARATOR ."error_log"));
$conn = connectDB();

$sql = "select * from web_config";
$rs = $conn->Execute($sql);
if(!$rs)
{
	echo $conn->ErrorMsg();
	die();
}

/**
 * Skin Define
 */
// var_dump($rs);exit; // debug code
define("CURRENT_SKIN", $rs->fields[0]);

/**
 * Website Base Define
 */
define("WEBSITE_LANGUAGE", $rs->fields[1]);
define("TITLE", $rs->fields[2]);
define("COPYRIGHT", $rs->fields[3]);
define("PAGE_SIZE", $rs->fields[4]);

/**
 * Website Control
 */
define("SYSTEM_STATUS", $rs->fields[5]);

/**
 * OnlineNIC API Setting
 */
define("CUSTOMER_ID", $rs->fields[7]);
define("PASSWORD", $rs->fields[8]);
define("REG_HOST", $rs->fields[9]);
define("REG_PORT", $rs->fields[10]);

/**
 * Other setting
 */
define("RELA_DIR", $rs->fields[11]);
define("DOM_UPG_HOST", $rs->fields[12]);
define("DOM_UPG_PORT", $rs->fields[13]);
define("DOM_UPG_URL", $rs->fields[14]);
define("SUPPORT_EMAIL", $rs->fields[15]);
//define("CURRENT_THEME", "default");
define("CURRENT_THEME", $rs->fields[16]);

$rs->close();

include(ROOT_DIR . "resource/language_" . WEBSITE_LANGUAGE . ".inc.php");

// smarty specific options
require_once( ROOT_DIR.'/common/Smarty/libs/Smarty.class.php');
$smarty = new Smarty\Smarty;
$smarty->addTemplateDir(ROOT_DIR.'/themes');
$smarty->setCompileDir(ROOT_DIR.'/common/Smarty/smarty/templates_c');
$smarty->setCacheDir(ROOT_DIR.'/common/Smarty/smarty/cache');
$smarty->addConfigDir(ROOT_DIR.'/common/Smarty/smarty/configs');

if (RELA_DIR === "/") {
	$smarty->assign ('RELA_DIR', '/./');
} else {
	$smarty->assign ('RELA_DIR', RELA_DIR);
}
$smarty->assign ('ROOT_DIR', ROOT_DIR);
$smarty->assign ('CURRENT_SKIN', CURRENT_SKIN);
$smarty->assign ('CURRENT_THEME', CURRENT_THEME);
$smarty->assign ('WEBSITE_TITLE', TITLE);
?>
