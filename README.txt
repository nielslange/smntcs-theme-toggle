=== SMNTCS Theme Toggle ===

Contributors: 		nielslange
Tags: 				theme, themes, theme switcher, admin bar, theme toggle
Stable tag: 		1.0
Tested up to: 		6.8
Requires PHP: 		7.4
Requires at least: 	5.5
License: 			GPL v2 or later
License URI: 		https://www.gnu.org/licenses/gpl-2.0.html

A powerful WordPress plugin that adds a theme switcher to the admin bar, allowing administrators to quickly switch between installed themes without leaving their current page.

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

= 1.0 (2025.04.18) =

- Initial release.