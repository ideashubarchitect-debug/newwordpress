<?php
/**
 * Welcome Page Initiation
*/

include get_template_directory() . '/welcome/welcome.php';

/** Plugins **/

$th_plugins = array(
	// *** Companion Plugins
	'companion_plugins' => array(
		'8degreethemes-demo-importer' => array(
			'slug' 				=> '8degreethemes-demo-importer',
			'name' 				=> esc_html__('Instant Demo Importer', 'wp-store'),
			'filename' 			=>'8degreethemes-demo-importer.php',
 			// Use either bundled, remote, wordpress
			'host_type' 		=> 'remote',
			'location' 		=> egtdi_get_plugin_remote_url('https://demo.8degreethemes.com/wp-content/theme-demos/','8degreethemes-demo-importer.zip'),
			'class' 			=> 'EGTDI_Demo_Importer',
			'info' => __('8Degree Demo Importer Plugin adds the feature to Import the Demo Conent with a single click.', 'wp-store'),
		)
	),
	// *** Required Plugins
	'required_plugins' 			=> array(),

	// *** Recommended Plugins
	'recommended_plugins' => array(
			// Free Plugins
		'free_plugins' => array(
			'ultimate-form-builder-lite' => array(
				'slug'      => 'ultimate-form-builder-lite',
				'filename' 	=> 'ultimate-form-builder-lite.php',
				'class' 	=> 'UFBL_Class',
			),
			'woocommerce' => array(
				'slug'      => 'woocommerce',
				'filename' 	=> 'woocommerce.php',
				'class' 	=> 'WooCommerce',
			),
		),
		// Pro Plugins
		'pro_plugins' => array()
	),
);

$strings = array(
		// Welcome Page General Texts
	'welcome_menu_text' => esc_html__( 'WP Store Setup', 'wp-store' ),
	'theme_short_description' => esc_html__( 'WP store is a feature rich woocommerce theme beautifully crafted by our designers to give best e-commerce experience in a simple design comfortable for every type of user.', 'wp-store' ),

	// Plugin Action Texts
	'install_n_activate' => esc_html__('Install and Activate', 'wp-store'),
	'deactivate' => esc_html__('Deactivate', 'wp-store'),
	'activate' => esc_html__('Activate', 'wp-store'),

	// Recommended Plugins Section
	'pro_plugin_title' => esc_html__( 'Pro Plugins', 'wp-store' ),
	'pro_plugin_description' => esc_html__( 'Take Advantage of some of our Premium Plugins.', 'wp-store' ),
	'free_plugin_title' => esc_html__( 'Free Plugins', 'wp-store' ),
	'free_plugin_description' => esc_html__( 'These Free Plugins might be handy for you.', 'wp-store' ),

	// Demo Actions
	'installed_btn' => esc_html__('Activated', 'wp-store'),
	'deactivated_btn' => esc_html__('Activated', 'wp-store'),
	'demo_installing' => esc_html__('Installing Demo', 'wp-store'),
	'demo_installed' => esc_html__('Demo Installed', 'wp-store'),
	'demo_confirm' => esc_html__('Are you sure to import demo content ?', 'wp-store'),

	// Actions Required
	'req_plugins_installed' => esc_html__( 'All Recommended action has been successfully completed.', 'wp-store' ),
	'customize_theme_btn' => esc_html__( 'Customize Theme', 'wp-store' ),
);

function egtdi_get_plugin_remote_url( $base,$filename ) {

	return trailingslashit($base) . $filename;
}

/**
 * Initiating Welcome Page
*/
$my_theme_wc_page = new WP_Store_Welcome( $th_plugins, $strings );