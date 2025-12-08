<?php
/**
 * This file represents an example of the code that themes would use to register
 * the required plugins.
 *
 * It is expected that theme authors would copy and paste this code into their
 * functions.php file, and amend to suit.
 *
 * @see http://tgmpluginactivation.com/configuration/ for detailed documentation.
 *
 * @package    TGM-Plugin-Activation
 * @subpackage Example
 * @version    2.5.2
 * @author     Thomas Griffin, Gary Jones, Juliette Reinders Folmer
 * @copyright  Copyright (c) 2011, Thomas Griffin
 * @license    http://opensource.org/licenses/gpl-2.0.php GPL v2 or later
 * @link       https://github.com/TGMPA/TGM-Plugin-Activation
 */

/**
 * Include the TGM_Plugin_Activation class.
 */
get_template_part('admin/tgm/class-tgm-plugin-activation');

add_action( 'tgmpa_register', 'corpix_register_required_plugins' );
          
function corpix_register_required_plugins() {

	$plugins = array(
	    
	    array(
            'name'      => esc_html__('Envato Market', 'corpix'),
            'slug'      => 'envato-market',
            'source'    => 'https://envato.github.io/wp-envato-market/dist/envato-market.zip',
            'required'  => false,
		),
		array(
			'name'      => esc_html__('Elementor','corpix'),
			'slug'      => 'elementor',
			'required'  => true,
		),
		array(
            'name'      => esc_html__('Corpix Core', 'corpix'),
            'slug'      => 'corpix-core',
			'source'    => get_template_directory() . '/admin/tgm/plugins/corpix-core.zip',
            'required'  => true,
            'version'   => '1.1.7',
		),	
        array(
            'name'     => esc_html__('WooCommerce', 'corpix'),
            'slug'     => 'woocommerce',
            'required' => false
        ),       
        array(
            'name'      => esc_html__('Contact Form 7','corpix'),
            'slug'      => 'contact-form-7',
            'required'  => false,
        ),
        array(
            'name'      => esc_html__('Mailchimp for WordPress', 'corpix'),
            'slug'      => 'mailchimp-for-wp',
            'required'  => false,
        ),
        array(
            'name'      => esc_html__('One Click Demo Import', 'corpix'),
            'slug'      => 'one-click-demo-import',
            'required'  => false,
        )

);
	/*
	 * Array of configuration settings. Amend each line as needed.
	 *
	 * TGMPA will start providing localized text strings soon. If you already have translations of our standard
	 * strings available, please help us make TGMPA even better by giving us access to these translations or by
	 * sending in a pull-request with .po file(s) with the translations.
	 *
	 * Only uncomment the strings in the config array if you want to customize the strings.
	 */
	$config = array(
		'id'           => 'tgmpa',                 // Unique ID for hashing notices for multiple instances of TGMPA.
		'default_path' => '',                      // Default absolute path to bundled plugins.
		'menu'         => 'corpix-required-plugins', 			// Menu slug.
		'parent_slug'  => 'admin.php',            // Parent menu slug.
		'capability'   => 'edit_theme_options',    // Capability needed to view plugin install page, should be a capability associated with the parent menu used.
		'has_notices'  => true,                    // Show admin notices or not.
		'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
		'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
		'is_automatic' => true,                   // Automatically activate plugins after installation or not.
		'message'      => '',                      // Message to output right before the plugins table.
	);

	tgmpa( $plugins, $config );
}

function corpix_plugins_menu_args($args) {
    $args['parent_slug'] = 'corpix-admin-menu';
    return $args;
}

add_filter( 'tgmpa_admin_menu_args', 'corpix_plugins_menu_args' );