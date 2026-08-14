<?php
/**
 * Plugin Name:         SMNTCS Theme Toggle
 * Plugin URI:          https://github.com/nielslange/smntcs-theme-toggle
 * Description:         A powerful WordPress plugin that adds a theme switcher to the admin bar, allowing administrators to quickly switch between installed themes without leaving their current page. Perfect for theme developers and site administrators who need to test different themes efficiently.
 * Version:             1.1
 * Requires at least:   5.5
 * Requires PHP:        7.4
 * Author:              Niels Lange
 * Author URI:          https://nielslange.de
 * License:             GPL v2 or later
 * License URI:         https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:         smntcs-theme-toggle
 * Domain Path:         /languages
 * GitHub Plugin URI:   https://github.com/nielslange/smntcs-theme-toggle
 * Primary Branch:      main
 *
 * @package SMNTCS_Theme_Toggle
 */

// Declare strict types.
declare(strict_types=1);

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

// Define constants.
define( 'SMNTCS_THEME_TOGGLE_PLUGIN_FILE', __FILE__ );

// Load plugin classes.
require_once plugin_dir_path( SMNTCS_THEME_TOGGLE_PLUGIN_FILE ) . '/includes/class-smntcs-theme-toggle.php';
