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
### use single template (generic) as we have language files.

# TO-DO
## Roadmap / Planned Features
The following features are planned for future releases of the Domain Name Management System:
### Error log, access log, and success log management
### Member-based language preferences with instant language switching
### Additional German (DE) language support, alongside Turkish (TR), English (EN), and Chinese (CN)
### Foreign exchange rate support
### TRY and EUR transaction support
### WHOIS privacy / privacy extension support
### Managed DNS records support
### Help desk integration with HESK
### Sub-reseller support and integration
### Anonymous domain name operations for end users
(email and domain password-based login support)
### Abuse notice record management and support
### Payment declaration support
### Application Programming Interface (API) support
### Automatic and manual price list import support from registrars
### Initial support for domain name transfers, including transfer information display
### Advanced domain name transfer support, including accept and reject operations
### Domain restore support
### Internal domain transfer support
### Two-factor authentication support
### Cryptocurrency payment support
