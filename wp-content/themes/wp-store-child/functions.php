<?php
/**
 * WP Store Child Theme functions and definitions.
 *
 * @package WP_Store_Child
 */

declare( strict_types=1 );

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Enqueue parent and child theme styles.
 * Parent style is loaded so all parent theme CSS is available.
 */
function wp_store_child_enqueue_styles(): void {
	$parent_style = 'wp-store-style';
	$child_version = wp_get_theme()->get( 'Version' ) ?: '1.0.0';

	wp_enqueue_style(
		$parent_style,
		get_template_directory_uri() . '/style.css',
		array(),
		$child_version
	);

	wp_enqueue_style(
		'wp-store-child-style',
		get_stylesheet_uri(),
		array( $parent_style ),
		$child_version
	);
}
add_action( 'wp_enqueue_scripts', 'wp_store_child_enqueue_styles', 15 );

/**
 * Theme setup: ensure child theme text domain and any extra support.
 */
function wp_store_child_setup(): void {
	load_theme_textdomain( 'wp-store-child', get_stylesheet_directory() . '/languages' );
}
add_action( 'after_setup_theme', 'wp_store_child_setup' );

/**
 * Set default front page and blog options on theme switch (one-time).
 * Users can change these later in Settings > Reading.
 */
function wp_store_child_set_default_home_page(): void {
	if ( get_theme_mod( 'wp_store_child_has_set_defaults', false ) ) {
		return;
	}

	$home = get_page_by_path( 'home' );
	if ( ! $home ) {
		$home = get_page_by_title( 'Home' );
	}

	if ( $home && 'publish' === $home->post_status ) {
		update_option( 'show_on_front', 'page' );
		update_option( 'page_on_front', $home->ID );
	}

	set_theme_mod( 'wp_store_child_has_set_defaults', true );
}
add_action( 'after_switch_theme', 'wp_store_child_set_default_home_page' );
