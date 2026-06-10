# Template5 Changelog

## PHP 8 Support

Template5 is based on Template4 and introduces PHP 8 compatibility, along with several engine updates, theme fixes, and general improvements.

### Engine Updates

- Updated the Smarty engine.
- Updated the AdoDB engine.
- Updated the Whois engine.
- Added an up-to-date PHPMailer engine.
- Added an up-to-date Captcha engine.

### Captcha Improvements

- Added Captcha support to public forms:
  - Login
  - Registration
  - Forgot password
  - Whois
  - Domain search
- Made Captcha optional via system settings.

### PHP Compatibility

- Added polyfills for `ereg` and `ereg_replace`.

### Theme Fixes

Fixed the following themes:

- Default English theme
- Default Turkish theme
- simpleGreen English theme
- simpleGreen Turkish theme

### Character Encoding

- Changed the character encoding from ISO to UTF-8.

### Year Range Fixes

- Replaced the `2002–2005` year range in search forms with `1970` through `date("Y")`.
- Replaced the `2005–2040` year range in payment forms with `date("Y") + 15`.

### Whois Improvements

- Domain availability and unavailability messages are now always displayed in Whois results.
- Fixed the PHP Whois function.
- Whois queries now directly query the relevant TLD registries.

### Theme Path Fixes

- Fixed the `RELA_DIR` variable usage in themes.

### Template Structure

- Switched to a single generic template structure, as language files are now used for localization.

## Roadmap / Planned Features

The following features are planned for future releases of the Domain Name Management System.

### Logging and Monitoring

- Error log management
- Access log management
- Success log management

### Language and Localization

- Member-based language preferences
- Instant language switching
- Additional German (DE) language support, alongside:
  - Turkish (TR)
  - English (EN)
  - Chinese (CN)

### Currency and Payments

- Foreign exchange rate support
- TRY and EUR transaction support
- Payment declaration support
- Cryptocurrency payment support

### Domain Management

- WHOIS privacy / privacy extension support
- Managed DNS records support
- Anonymous domain name operations for end users
  - Email-based login support
  - Domain password-based login support
- Initial support for domain name transfers, including transfer information display
- Advanced domain name transfer support, including accept and reject operations
- Domain restore support
- Internal domain transfer support

### Registrar and Pricing Integration

- Automatic price list import support from registrars
- Manual price list import support from registrars

### Reseller Features

- Sub-reseller support and integration

### Support and Abuse Management

- Help desk integration with HESK
- Abuse notice record management and support

### Security

- Two-factor authentication support

### Developer Features

- Application Programming Interface (API) support
