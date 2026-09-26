=== SMNTCS Theme Toggle ===

Contributors:       nielslange
Tags:               theme switcher, themes, admin bar, theme toggle, development
Requires at least:  5.5
Tested up to:       7.1
Requires PHP:       7.4
Stable tag:         1.2
License:            GPL v2 or later
License URI:        https://www.gnu.org/licenses/gpl-2.0.html

Adds a theme switcher to the admin bar, so administrators can change the active theme from any page.

== Description ==

SMNTCS Theme Toggle is a lightweight and efficient WordPress plugin designed to streamline theme management. It adds a convenient theme switcher to the WordPress admin bar, enabling administrators and developers to quickly switch between installed themes without navigating away from their current page.

This plugin is particularly useful for:
* Theme developers who need to test different themes
* Site administrators who frequently switch between themes
* Anyone who wants a more convenient way to manage themes

= Features =

* Quick theme switching from the admin bar
* Maintains current page context after theme switching
* Responsive design with multi-column layout
* Visual indicators for active theme
* Secure theme switching with nonce verification
* Clean and modern user interface
* Supports all WordPress themes

= Security =

The plugin implements several security measures:
* Nonce verification for theme switching
* Capability checks (only users with `manage_options` can access)
* Proper sanitization of URLs and data

== Installation ==

1. Upload the `smntcs-theme-toggle` folder to the `/wp-content/plugins/` directory
2. Activate the plugin through the 'Plugins' menu in WordPress
3. The theme switcher will appear in the admin bar for users with appropriate permissions

== Frequently Asked Questions ==

= Who can use the theme switcher? =

Only users with administrator privileges can access and use the theme switcher.

= Will switching themes affect my site's content? =

No, switching themes only changes the appearance of your site. All content, settings, and configurations remain unchanged.

= Can I use this plugin with any WordPress theme? =

Yes, the plugin works with all WordPress themes that follow the standard WordPress theme structure.

== Changelog ==

= 1.2 (2026.09.26) =

- Test up to WordPress 7.1
- Update development dependencies and GitHub Actions
- Fix the number of arguments passed to hook callbacks

= 1.1 (2026.08.14) =

- Test up to WordPress 7.0.

= 1.0 (2025.04.18) =

- Initial release.
