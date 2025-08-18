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

$php_self=$_SERVER["PHP_SELF"];

/**
 * Skin Define
 */
// var_dump($rs);exit; // debug code
define("CURRENT_SKIN", $rs->fields["current_skin"]);

/**
 * Website Base Define
 */
define("WEBSITE_LANGUAGE", $rs->fields["website_language"]);
define("TITLE", $rs->fields["title"]);
define("COPYRIGHT", $rs->fields["copyright"]);
define("PAGE_SIZE", $rs->fields["pagesize"]);

/**
 * Website Control
 */
define("SYSTEM_STATUS", $rs->fields["system_status"]);

/**
 * OnlineNIC API Setting
 */
define("CUSTOMER_ID", $rs->fields["customer_id"]);
define("PASSWORD", $rs->fields["password"]);
define("REG_HOST", $rs->fields["reg_host"]);
define("REG_PORT", $rs->fields["reg_port"]);

/**
 * Other setting
 */
define("RELA_DIR", $rs->fields["rela_dir"]);
define("DOM_UPG_HOST", $rs->fields["dom_upg_host"]);
define("DOM_UPG_PORT", $rs->fields["dom_upg_port"]);
define("DOM_UPG_URL", $rs->fields["dom_upg_url"]);
define("SUPPORT_EMAIL", $rs->fields["support_email"]);
//define("CURRENT_THEME", "default");
define("CURRENT_THEME", $rs->fields["current_theme"]);
define("CAPTCHA_ENABLE", intval($rs->fields["captcha_enable"]));

$rs->close();

include(ROOT_DIR . "resource/language_" . WEBSITE_LANGUAGE . ".inc.php");

// smarty specific options
require_once( ROOT_DIR.'/common/Smarty/libs/Smarty.class.php');
$smarty = new Smarty\Smarty;
$smarty->addTemplateDir(ROOT_DIR.'/themes');
$smarty->setCompileDir(ROOT_DIR.'/common/Smarty/smarty/templates_c');
$smarty->setCacheDir(ROOT_DIR.'/common/Smarty/smarty/cache');
$smarty->addConfigDir(ROOT_DIR.'/common/Smarty/smarty/configs');

$smarty->assign ('RELA_DIR', RELA_DIR);
$smarty->assign ('ROOT_DIR', ROOT_DIR);
$smarty->assign ('CURRENT_SKIN', CURRENT_SKIN);
$smarty->assign ('CURRENT_THEME', CURRENT_THEME);
$smarty->assign ('WEBSITE_TITLE', TITLE);
?>
