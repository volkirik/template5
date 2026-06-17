<?php
define("CRM_FUNCTIONS_LOADED", true);
$resourceDir = __DIR__ . "/../resource";
$themesDir   = __DIR__ . "/../themes";

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

function decide_selectedTheme($dbtheme){
global $resourceDir, $themesDir;
$dbCurrentTheme = trim((string) $dbtheme);
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
return $selectedTheme;
}
/*
|--------------------------------------------------------------------------
| Website language seçimi
|--------------------------------------------------------------------------
| Öncelik:
| 1) Geçerli cookie: website_language
| 2) Veritabanından gelen: $dblang ( $rs->fields["website_language"] )
| 3) Cookie yok/geçersizse DB değerini cookie'ye yaz
|--------------------------------------------------------------------------
*/

function decide_selectedLanguage($dblang){
global $resourceDir, $themesDir;
/*
 * Eğer init.inc.php ana dizindeyse yukarıdaki yerine şunu kullan:
 *
 * $resourceDir = __DIR__ . "/resource";
 * $themesDir   = __DIR__ . "/themes";
 */

$dbWebsiteLanguage = (int) $dblang;
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
return $selectedLanguage;
}

function detect_base_url(): string
{
    $docRoot = realpath($_SERVER['DOCUMENT_ROOT'] ?? '');
    $baseDir = realpath(__DIR__ . DIRECTORY_SEPARATOR .'..');

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

    $return_val = $relative === '' ? '/' : '/' . $relative . '/';
//    var_dump( $return_val);exit; // test
    return $return_val;
}
?>
