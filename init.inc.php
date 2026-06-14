<?php
require_once(dirname(__FILE__) . "/session.inc.php");
@error_reporting(E_ALL & ~E_NOTICE & ~E_STRICT & ~E_DEPRECATED);
//@error_reporting(E_ALL);
@ini_set("display_errors", false);
@ini_set("log_errors", true);
@ini_set("error_log", realpath(dirname(__FILE__) . DIRECTORY_SEPARATOR . "logs") . DIRECTORY_SEPARATOR ."error_log");
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
//define("WEBSITE_LANGUAGE", $rs->fields["website_language"]);
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
//define("RELA_DIR", $rs->fields["rela_dir"]);
function detect_base_url(): string
{
    $docRoot = realpath($_SERVER['DOCUMENT_ROOT'] ?? '');
    $baseDir = realpath(__DIR__);

    if (!$docRoot || !$baseDir) {
        return '/';
    }

    $docRoot = str_replace('\\', '/', $docRoot);
    $baseDir = str_replace('\\', '/', $baseDir);

    // Proje dizini document root altında değilse güvenli fallback
    if (strpos($baseDir, $docRoot) !== 0) {
        return '/';
    }

    $relative = substr($baseDir, strlen($docRoot));
    $relative = trim($relative, '/');

    return $relative === '' ? '/' : '/' . $relative . '/';
}
define("RELA_DIR", detect_base_url());
define("DOM_UPG_HOST", $rs->fields["dom_upg_host"]);
define("DOM_UPG_PORT", $rs->fields["dom_upg_port"]);
define("DOM_UPG_URL", $rs->fields["dom_upg_url"]);
define("SUPPORT_EMAIL", $rs->fields["support_email"]);
//define("CURRENT_THEME", "default");
//define("CURRENT_THEME", $rs->fields["current_theme"]);
define("CAPTCHA_ENABLE", intval($rs->fields["captcha_enable"]));

/*
|--------------------------------------------------------------------------
| Website language seçimi
|--------------------------------------------------------------------------
| Öncelik:
| 1) Geçerli cookie: website_language
| 2) Veritabanından gelen: $rs->fields["website_language"]
| 3) Cookie yok/geçersizse DB değerini cookie'ye yaz
|--------------------------------------------------------------------------
*/

$resourceDir = __DIR__ . "/resource";
$themesDir   = __DIR__ . "/themes";

/*
 * Eğer init.inc.php ana dizindeyse yukarıdaki yerine şunu kullan:
 *
 * $resourceDir = __DIR__ . "/resource";
 * $themesDir   = __DIR__ . "/themes";
 */

$dbWebsiteLanguage = (int) $rs->fields["website_language"];
$cookieLanguage    = isset($_COOKIE["website_language"]) ? (int) $_COOKIE["website_language"] : 0;

$selectedLanguage = $dbWebsiteLanguage;

if ($cookieLanguage > 0) {
    $cookieLangFile = $resourceDir . "/language_" . $cookieLanguage . ".inc.php";

    if (is_file($cookieLangFile)) {
        $selectedLanguage = $cookieLanguage;
    }
}

$dbLangFile = $resourceDir . "/language_" . $dbWebsiteLanguage . ".inc.php";

if (!is_file($resourceDir . "/language_" . $selectedLanguage . ".inc.php")) {
    if (is_file($dbLangFile)) {
        $selectedLanguage = $dbWebsiteLanguage;
    } else {
        $selectedLanguage = 1;
    }
}

define("WEBSITE_LANGUAGE", $selectedLanguage);

if (
    !isset($_COOKIE["website_language"]) ||
    (string) $_COOKIE["website_language"] !== (string) $selectedLanguage
) {
    setcookie(
        "website_language",
        (string) $selectedLanguage,
        time() + 365 * 24 * 60 * 60,
        "/",
        "",
        false,
        false
    );
}


/*
|--------------------------------------------------------------------------
| Website theme seçimi
|--------------------------------------------------------------------------
| Öncelik:
| 1) Geçerli cookie: website_theme
| 2) Veritabanından gelen: $rs->fields["current_theme"]
| 3) Cookie yok/geçersizse DB değerini cookie'ye yaz
|--------------------------------------------------------------------------
*/

$dbCurrentTheme = trim((string) $rs->fields["current_theme"]);
$cookieTheme    = isset($_COOKIE["website_theme"]) ? trim((string) $_COOKIE["website_theme"]) : "";

$selectedTheme = $dbCurrentTheme;

if ($cookieTheme !== "") {
    /*
     * Basit güvenlik filtresi:
     * Tema klasör adı sadece harf, rakam, tire, alt çizgi ve nokta içersin.
     * Böylece ../ gibi path traversal engellenir.
     */
    if (preg_match('/^[a-zA-Z0-9._-]+$/', $cookieTheme)) {
        $cookieThemeDir = $themesDir . "/" . $cookieTheme;

        if (is_dir($cookieThemeDir)) {
            $selectedTheme = $cookieTheme;
        }
    }
}

if (
    $selectedTheme === "" ||
    !preg_match('/^[a-zA-Z0-9._-]+$/', $selectedTheme) ||
    !is_dir($themesDir . "/" . $selectedTheme)
) {
    if (
        $dbCurrentTheme !== "" &&
        preg_match('/^[a-zA-Z0-9._-]+$/', $dbCurrentTheme) &&
        is_dir($themesDir . "/" . $dbCurrentTheme)
    ) {
        $selectedTheme = $dbCurrentTheme;
    } else {
        $selectedTheme = "default";
    }
}

define("CURRENT_THEME", $selectedTheme);

if (
    !isset($_COOKIE["website_theme"]) ||
    (string) $_COOKIE["website_theme"] !== (string) $selectedTheme
) {
    setcookie(
        "website_theme",
        $selectedTheme,
        time() + 365 * 24 * 60 * 60,
        "/",
        "",
        false,
        false
    );
}
// END OF THEME AND LANG SELECTION CODE

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
