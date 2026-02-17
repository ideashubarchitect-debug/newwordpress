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
 * Add body class for this website (child theme active).
 */
function wp_store_child_body_classes( array $classes ): array {
	$classes[] = 'wp-store-child-site';
	return $classes;
}
add_filter( 'body_class', 'wp_store_child_body_classes' );

/**
 * Add Customizer option for accent color (output in head).
 */
function wp_store_child_customize_register( WP_Customize_Manager $wp_customize ): void {
	$wp_customize->add_section( 'wp_store_child_options', array(
		'title'    => __( 'This Website (Child Theme)', 'wp-store-child' ),
		'priority' => 30,
	) );

	$wp_customize->add_setting( 'wp_store_child_accent_color', array(
		'default'           => '#e85d04',
		'sanitize_callback' => 'sanitize_hex_color',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'wp_store_child_accent_color', array(
		'label'   => __( 'Accent color', 'wp-store-child' ),
		'section' => 'wp_store_child_options',
	) ) );
}
add_action( 'customize_register', 'wp_store_child_customize_register' );

/**
 * Output custom accent color as CSS variables when set in Customizer.
 */
function wp_store_child_accent_css(): void {
	$accent = get_theme_mod( 'wp_store_child_accent_color', '' );
	if ( empty( $accent ) ) {
		return;
	}
	?>
	<style id="wp-store-child-accent">
		:root {
			--wpstore-child-color-primary: <?php echo esc_attr( $accent ); ?>;
			--wpstore-child-color-primary-dark: <?php echo esc_attr( wp_store_child_darken( $accent, 10 ) ); ?>;
		}
	</style>
	<?php
}
add_action( 'wp_head', 'wp_store_child_accent_css', 100 );

/**
 * Darken a hex color by a percentage (simple version).
 */
function wp_store_child_darken( string $hex, int $percent ): string {
	$hex = ltrim( $hex, '#' );
	if ( strlen( $hex ) !== 6 ) {
		return $hex;
	}
	$r = max( 0, min( 255, hexdec( substr( $hex, 0, 2 ) ) * ( 1 - $percent / 100 ) ) );
	$g = max( 0, min( 255, hexdec( substr( $hex, 2, 2 ) ) * ( 1 - $percent / 100 ) ) );
	$b = max( 0, min( 255, hexdec( substr( $hex, 4, 2 ) ) * ( 1 - $percent / 100 ) ) );
	return sprintf( '#%02x%02x%02x', (int) $r, (int) $g, (int) $b );
}

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
