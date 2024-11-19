<?php
/**
 * NS Custom Theme back compat functionality
 *
 * Prevents NS Custom Theme from running on WordPress versions prior to 4.4,
 * since this theme is not meant to be backward compatible beyond that and
 * relies on many newer functions and markup changes introduced in 4.4.
 *
 * @package WordPress
 * @subpackage NS_Custom_Theme
 * @since NS Custom Theme 1.0
 */

/**
 * Prevent switching to NS Custom Theme on old versions of WordPress.
 *
 * Switches to the default theme.
 *
 * @since NS Custom Theme 1.0
 */
function ns_custom_switch_theme() {
	switch_theme( WP_DEFAULT_THEME, WP_DEFAULT_THEME );

	unset( $_GET['activated'] );

	add_action( 'admin_notices', 'ns_custom_upgrade_notice' );
}
add_action( 'after_switch_theme', 'ns_custom_switch_theme' );

/**
 * Adds a message for unsuccessful theme switch.
 *
 * Prints an update nag after an unsuccessful attempt to switch to
 * NS Custom Theme on WordPress versions prior to 4.4.
 *
 * @since NS Custom Theme 1.0
 *
 * @global string $wp_version WordPress version.
 */
function ns_custom_upgrade_notice() {
	$message = sprintf( __( 'NS Custom Theme requires at least WordPress version 4.4. You are running version %s. Please upgrade and try again.', 'ns_custom' ), $GLOBALS['wp_version'] );
	printf( '<div class="error"><p>%s</p></div>', $message );
}

/**
 * Prevents the Customizer from being loaded on WordPress versions prior to 4.4.
 *
 * @since NS Custom Theme 1.0
 *
 * @global string $wp_version WordPress version.
 */
function ns_custom_customize() {
	wp_die( sprintf( __( 'NS Custom Theme requires at least WordPress version 4.4. You are running version %s. Please upgrade and try again.', 'ns_custom' ), $GLOBALS['wp_version'] ), '', array(
		'back_link' => true,
	) );
}
add_action( 'load-customize.php', 'ns_custom_customize' );

/**
 * Prevents the Theme Preview from being loaded on WordPress versions prior to 4.4.
 *
 * @since NS Custom Theme 1.0
 *
 * @global string $wp_version WordPress version.
 */
function ns_custom_preview() {
	if ( isset( $_GET['preview'] ) ) {
		wp_die( sprintf( __( 'NS Custom Theme requires at least WordPress version 4.4. You are running version %s. Please upgrade and try again.', 'ns_custom' ), $GLOBALS['wp_version'] ) );
	}
}
add_action( 'template_redirect', 'ns_custom_preview' );
