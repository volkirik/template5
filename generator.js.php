<?php

declare(strict_types=1);

$baseDir      = __DIR__;
$resourceDir  = $baseDir . "/resource";
$themesDir    = $baseDir . "/themes";

/*
|--------------------------------------------------------------------------
| JS prompt dili için cookie'den language ID oku ve validate et
|--------------------------------------------------------------------------
| Öncelik:
| 1) website_language cookie varsa ve resource/language_ID.inc.php varsa onu include et
| 2) Cookie yoksa veya geçersizse language_1.inc.php include et
|--------------------------------------------------------------------------
*/

$defaultLanguageId = 1;
$selectedLanguageId = $defaultLanguageId;

if (isset($_COOKIE["website_language"]) && preg_match('/^\d+$/', (string) $_COOKIE["website_language"])) {
    $cookieLanguageId = (int) $_COOKIE["website_language"];
    $cookieLanguageFile = $resourceDir . "/language_" . $cookieLanguageId . ".inc.php";

    if ($cookieLanguageId > 0 && is_file($cookieLanguageFile) && is_readable($cookieLanguageFile)) {
        $selectedLanguageId = $cookieLanguageId;
    }
}

$selectedLanguageFile = $resourceDir . "/language_" . $selectedLanguageId . ".inc.php";

if (!is_file($selectedLanguageFile) || !is_readable($selectedLanguageFile)) {
    $selectedLanguageId = $defaultLanguageId;
    $selectedLanguageFile = $resourceDir . "/language_" . $defaultLanguageId . ".inc.php";
}

/*
 * Dil dosyası sadece define içeriyor olmalı.
 * Yine de yanlışlıkla çıktı/BOM varsa JS bozulmasın diye buffer ile temizliyoruz.
 */
if (is_file($selectedLanguageFile) && is_readable($selectedLanguageFile)) {
    ob_start();
    include_once $selectedLanguageFile;
    ob_end_clean();
}

/*
 * language_1.inc.php bile yoksa son güvenli fallback.
 */
if (!defined("TEMPLATE_LANG_JS")) {
    define(
        "TEMPLATE_LANG_JS",
        "Please save any unsaved work or transaction first.\n\nWould you like to reload the page now?\n\nYes = I have no unsaved work, reload!\nNo = I will save first and reload later!"
    );
}

/*
 * Cookie yoksa/geçersizse browser'a geçerli dili yazalım.
 */
if (
    !isset($_COOKIE["website_language"]) ||
    (string) $_COOKIE["website_language"] !== (string) $selectedLanguageId
) {
    setcookie(
        "website_language",
        (string) $selectedLanguageId,
        time() + 365 * 24 * 60 * 60,
        "/",
        "",
        false,
        false
    );
}

header("Content-Type: application/javascript; charset=UTF-8");

$languages = [];
$themes    = [];

/*
|--------------------------------------------------------------------------
| 1) Dil dosyalarını oku
|--------------------------------------------------------------------------
*/

if (is_dir($resourceDir)) {
    $files = scandir($resourceDir);

    if ($files !== false) {
        foreach ($files as $file) {
            if (!preg_match('/^language_(\d+)\.inc\.php$/', $file, $m)) {
                continue;
            }

            $langId   = (int) $m[1];
            $langName = "";
            $fullPath = $resourceDir . "/" . $file;

            if (is_file($fullPath) && is_readable($fullPath)) {
                $content = file_get_contents($fullPath);

                if ($content !== false) {
                    /*
                     * Şunları yakalar:
                     * define("TEMPLATE_LANG", 'English');
                     * define('TEMPLATE_LANG', "Türkçe");
                     */
                    if (preg_match('/define\s*\(\s*[\'"]TEMPLATE_LANG[\'"]\s*,\s*[\'"]([^\'"]+)[\'"]\s*\)\s*;/i', $content, $mm)) {
                        $langName = trim($mm[1]);
                    }
                }
            }

            if ($langName === "") {
                $langName = "Language " . $langId;
            }

            $languages[] = [
                "lang_id"   => $langId,
                "lang_name" => $langName,
                "lang_file" => $file,
            ];
        }
    }
}

/*
|--------------------------------------------------------------------------
| Dil listesini ID'ye göre sırala
|--------------------------------------------------------------------------
*/

usort($languages, static function ($a, $b) {
    return $a["lang_id"] <=> $b["lang_id"];
});

/*
|--------------------------------------------------------------------------
| 2) Tema klasörlerini oku
|--------------------------------------------------------------------------
*/

if (is_dir($themesDir)) {
    $items = scandir($themesDir);

    if ($items !== false) {
        foreach ($items as $item) {
            if ($item === "." || $item === "..") {
                continue;
            }

            $fullPath = $themesDir . "/" . $item;

            if (!is_dir($fullPath)) {
                continue;
            }

            $themes[] = $item;
        }
    }
}

sort($themes, SORT_NATURAL | SORT_FLAG_CASE);

/*
|--------------------------------------------------------------------------
| PHP arraylarını JS tarafına güvenli aktar
|--------------------------------------------------------------------------
*/

$languagesJson = json_encode($languages, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
$themesJson    = json_encode($themes, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);

if ($languagesJson === false) {
    $languagesJson = "[]";
}

if ($themesJson === false) {
    $themesJson = "[]";
}
?>

(function () {
    "use strict";

    var languages = <?php echo $languagesJson; ?>;
    var themes    = <?php echo $themesJson; ?>;
    var reloadConfirmMessage = <?php echo json_encode(TEMPLATE_LANG_JS, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES); ?>;

    function setCookie(name, value, days) {
        var expires = "";

        if (days) {
            var date = new Date();
            date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
            expires = "; expires=" + date.toUTCString();
        }

        document.cookie =
            encodeURIComponent(name) + "=" + encodeURIComponent(value) +
            expires +
            "; path=/; SameSite=Lax";
    }

    function getCookie(name) {
        var encodedName = encodeURIComponent(name) + "=";
        var parts = document.cookie.split(";");

        for (var i = 0; i < parts.length; i++) {
            var c = parts[i].trim();

            if (c.indexOf(encodedName) === 0) {
                return decodeURIComponent(c.substring(encodedName.length));
            }
        }

        return "";
    }

    function askReload() {
        return window.confirm(reloadConfirmMessage);
    }

    function createSelect(name, labelText, options, selectedValue) {
        var wrapper = document.createElement("span");
        wrapper.style.marginRight = "12px";

        var label = document.createElement("label");
        label.style.marginRight = "5px";
        label.appendChild(document.createTextNode(labelText + ": "));

        var select = document.createElement("select");
        select.name = name;

        for (var i = 0; i < options.length; i++) {
            var option = document.createElement("option");

            option.value = String(options[i].value);
            option.title = String(options[i].title);
            option.textContent = String(options[i].title);

            if (String(options[i].value) === String(selectedValue)) {
                option.selected = true;
            }

            select.appendChild(option);
        }

        wrapper.appendChild(label);
        wrapper.appendChild(select);

        return {
            wrapper: wrapper,
            select: select
        };
    }

    function initGeneratorFooter() {
        var footer = document.getElementById("footer_el");

        if (!footer) {
            return;
        }

        var currentLanguage = getCookie("website_language");
        var currentTheme    = getCookie("website_theme");

        var languageOptions = [];
        var themeOptions    = [];

        for (var i = 0; i < languages.length; i++) {
            languageOptions.push({
                value: languages[i].lang_id,
                title: languages[i].lang_name
            });
        }

        for (var j = 0; j < themes.length; j++) {
            themeOptions.push({
                value: themes[j],
                title: themes[j]
            });
        }

        if (languageOptions.length > 0) {
            var languageSelect = createSelect(
                "website_language",
                " - Websitesi dili",
                languageOptions,
                currentLanguage
            );

            languageSelect.select.onchange = function () {
                setCookie("website_language", this.value, 365);

                if (askReload()) {
                    window.location.reload();
                }
            };

            footer.appendChild(languageSelect.wrapper);
        }

        if (themeOptions.length > 0) {
            var themeSelect = createSelect(
                "website_theme",
                " - Websitesi teması",
                themeOptions,
                currentTheme
            );

            themeSelect.select.onchange = function () {
                setCookie("website_theme", this.value, 365);

                if (askReload()) {
                    window.location.reload();
                }
            };

            footer.appendChild(themeSelect.wrapper);
        }
    }

    if (document.readyState === "loading") {
        document.addEventListener("DOMContentLoaded", initGeneratorFooter);
    } else {
        initGeneratorFooter();
    }

})();
