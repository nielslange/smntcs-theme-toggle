<?php
/**
 * Plugin Name:     SMNTCS Theme Toggle
 * Plugin URI:      https://github.com/nielslange/smntcs-theme-toggle
 * Description:     Toggle theme activation from the admin bar.
 * Author:          Niels Lange
 * Author URI:      https://nielslange.de
 * Text Domain:     smntcs-theme-toggle
 * Version:         1.0
 * Requires PHP:          5.6
 * Requires at least:     5.5
 * License:               GPL v2 or later
 * License URI:           https://www.gnu.org/licenses/gpl-2.0.html
 *
 * @package SMNTCS_Theme_Toggle
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

// Define constants.
define( 'SMNTCS_THEME_TOGGLE_PLUGIN_FILE', __FILE__ );

// Load plugin classes.
require_once plugin_dir_path( SMNTCS_THEME_TOGGLE_PLUGIN_FILE ) . '/includes/class-smntcs-theme-toggle.php';
