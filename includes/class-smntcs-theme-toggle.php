<?php
/**
 * SMNTCS Theme Toggle
 *
 * @package SMNTCS_Theme_Toggle
 */

// Declare strict types.
declare(strict_types=1);

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

// Include main plugin file to ensure constants are defined.
require_once dirname( __DIR__ ) . '/smntcs-theme-toggle.php';

/**
 * SMNTCS_Theme_Toggle class
 *
 * @since 1.0
 */
class SMNTCS_Theme_Toggle {
	/**
	 * Initialize the class and set its properties.
	 *
	 * @since 1.0
	 * @return void
	 */
	public function __construct() {
		add_action( 'admin_bar_menu', [ $this, 'admin_bar_item' ], 500 );
		add_action( 'admin_enqueue_scripts', [ $this, 'enqueue_scripts' ] );
		add_action( 'wp_enqueue_scripts', [ $this, 'enqueue_scripts' ] );
		add_filter( 'wp_redirect', [ $this, 'handle_theme_switch_redirect' ] );
	}

	/**
	 * Add a menu item to the admin bar.
	 *
	 * @since 1.0
	 * @param WP_Admin_Bar $admin_bar The admin bar object.
	 * @return void
	 */
	public function admin_bar_item( WP_Admin_Bar $admin_bar ) {
		if ( ! current_user_can( 'manage_options' ) ) {
			return;
		}

		$admin_bar->add_menu(
			[
				'id'     => 'theme-toggle',
				'parent' => 'top-secondary',
				'group'  => null,
				'title'  => '<span class="ab-icon dashicons dashicons-admin-appearance"></span><span class="ab-label">Themes</span>',
				'href'   => '#',
				'meta'   => [ 'title' => __( 'Installed Themes', 'smntcs-theme-toggle' ) ],
			]
		);

		$themes = wp_get_themes();

		foreach ( $themes as $stylesheet => $theme ) {
			$current_theme = wp_get_theme();
			$class         = 'theme-toggle';
			$class        .= $current_theme->get( 'TextDomain' ) === $theme->get( 'TextDomain' ) ? ' is-active' : '';
			$wpnonce       = wp_create_nonce( 'switch-theme_' . $stylesheet );
			$current_url   = ( isset( $_SERVER['HTTPS'] ) && 'on' === $_SERVER['HTTPS'] ? 'https' : 'http' ) . '://' .
				sanitize_text_field( wp_unslash( $_SERVER['HTTP_HOST'] ?? '' ) ) .
				sanitize_text_field( wp_unslash( $_SERVER['REQUEST_URI'] ?? '' ) );

			$admin_bar->add_menu(
				[
					'id'     => 'theme-' . $stylesheet,
					'parent' => 'theme-toggle',
					'title'  => $theme->get( 'Name' ),
					'href'   => add_query_arg(
						[
							'action'     => 'activate',
							'stylesheet' => $stylesheet,
							'_wpnonce'   => $wpnonce,
							'return_url' => rawurlencode( $current_url ),
						],
						admin_url( 'themes.php' )
					),
					'meta'   => [
						'title' => $theme->get( 'Name' ),
						'class' => $class,
					],
				]
			);
		}
	}

	/**
	 * Enqueue admin styles for the theme toggle functionality.
	 *
	 * @since 1.0
	 * @return void
	 */
	public function enqueue_scripts() {
		$plugin_url = plugin_dir_url( SMNTCS_THEME_TOGGLE_PLUGIN_FILE );

		wp_enqueue_style(
			'smntcs-theme-toggle-style',
			$plugin_url . 'assets/css/style.css',
			[],
			'1.1'
		);

		wp_style_add_data( 'smntcs-theme-toggle-style', 'rtl', 'replace' );
	}

	/**
	 * Handle theme switch redirect to return to the original page.
	 *
	 * @since 1.0
	 * @param string $location The redirect location URL.
	 * @return string Modified redirect location URL if return_url is set, original location otherwise.
	 */
	public function handle_theme_switch_redirect( $location ) {
		if (
			isset( $_GET['return_url'], $_GET['_wpnonce'], $_GET['stylesheet'] ) &&
			wp_verify_nonce( sanitize_text_field( wp_unslash( $_GET['_wpnonce'] ) ), 'switch-theme_' . sanitize_text_field( wp_unslash( $_GET['stylesheet'] ) ) ) &&
			strpos( $location, 'themes.php' ) !== false
		) {
			return esc_url_raw( urldecode( sanitize_text_field( wp_unslash( $_GET['return_url'] ) ) ) );
		}
		return $location;
	}
}

// Initialise the plugin.
new SMNTCS_Theme_Toggle();
