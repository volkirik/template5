# template5
## added PHP8 support to template4
### updated Smarty engine
### updated AdoDB engine
### updated Whois engine
### added up-to-date PHPMailer engine
### added up-to-date Captcha engine
show Captcha in public forms (login,register,forgot,whois,domain)
made Captcha optional in system settings
### ereg and ereg_replace polyfills
### fixed themes
fixed default (english) theme
fixed default_turkish theme
fixed simpleGreen (english) theme
fixed simpleGreen_turkish theme
### change charset from iso to utf-8
### fixed year range
replace 2002-2005 (year range in search forms) with 1970-date("Y")
replace 2005-2040 (year range in payment forms) with date("Y")+15
### always show domain (un)availability messages in Whois
### fix PHP whois function and directly query TLD registries
### fixed RELA_DIR variable in themes
