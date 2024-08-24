<?php
/**
 * Header setting for Customizer
 *
 * @package byron
 * @version 3.6.8
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Header General
$this->sections['byron_header_general'] = array(
	'title' => esc_html__( 'General', 'byron' ),
	'panel' => 'byron_header',
	'settings' => array(
		array(
			'id' => 'header_background',
			'transport' => 'postMessage',
			'control' => array(
				'label' => esc_html__( 'Background', 'byron' ),
				'type' => 'color',
			),
			'inline_css' => array(
				'target' => array(
					'.header-style-1 #site-header:after'
				),
				'alter' => 'background-color',
			),
		),
		array(
			'id' => 'header_padding',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'text',
				'label' => esc_html__( 'Padding', 'byron' ),
				'description' => esc_html__( 'Top Right Bottom Left.', 'byron' ),
			),
			'inline_css' => array(
				'media_query' => '(min-width: 1199px)',
				'target' => '.header-style-1 .site-header-inner',
				'alter' => 'padding',
			),
			'sanitize_callback' => 'esc_url',
		),
	)
);

// Header Logo
$this->sections['byron_header_logo'] = array(
	'title' => esc_html__( 'Logo', 'byron' ),
	'panel' => 'byron_header',
	'settings' => array(
		array(
			'id' => 'custom_logo',
			'default' => '',
			'control' => array(
				'label' => esc_html__( 'Logo Image', 'byron' ),
				'type' => 'image',
			),
		),
		array(
			'id' => 'logo_width',
			'control' => array(
				'label' => esc_html__( 'Logo Width', 'byron' ),
				'type' => 'text',
			),
		),
	)
);

// Header Menu
$this->sections['byron_header_menu'] = array(
	'title' => esc_html__( 'Menu', 'byron' ),
	'panel' => 'byron_header',
	'settings' => array(
		// General
		array(
			'id' => 'menu_show_current',
			'default' => false,
			'control' => array(
				'label' => esc_html__( 'Show current page indicator?', 'byron' ),
				'type' => 'checkbox',
			),
		),
		array(
			'id' => 'menu_link_spacing',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'text',
				'label' => esc_html__( 'Link Spacing', 'byron' ),
				'description' => esc_html__( 'Example: 20px', 'byron' ),
			),
			'inline_css' => array(
				'target' => array(
					'#main-nav > ul > li',
				),
				'alter' => array(
					'padding-left',
					'padding-right',
				),
			),
		),
		array(
			'id' => 'menu_height',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'text',
				'label' => esc_html__( 'Menu Height', 'byron' ),
				'description' => esc_html__( 'Example: 100px', 'byron' ),
			),
			'inline_css' => array(
				'target' => array(
					'#site-header #main-nav > ul > li > a',
				),
				'alter' => array(
					'height',
					'line-height',
				),
			),
		),
		array(
			'id' => 'menu_link_color',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'color',
				'label' => esc_html__( 'Link Color', 'byron' ),
			),
			'inline_css' => array(
				'target' => array(
					'#main-nav > ul > li > a > span',
				),
				'alter' => 'color',
			),
		),
		array(
			'id' => 'menu_link_color_hover',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'color',
				'label' => esc_html__( 'Link Color: Hover', 'byron' ),
			),
			'inline_css' => array(
				'target' => array(
					'#main-nav > ul > li > a:hover > span',
				),
				'alter' => 'color',
			),
		),
	)
);

// Search & Cart
$this->sections['byron_header_search_cart'] = array(
	'title' => esc_html__( 'Search & Cart', 'byron' ),
	'panel' => 'byron_header',
	'settings' => array(
		// Search Icon
		array(
			'id' => 'header_search_icon',
			'default' => false,
			'control' => array(
				'label' => esc_html__( 'Search Icon', 'byron' ),
				'type' => 'checkbox',
			),
		),
		// Cart Icon
		array(
			'id' => 'header_cart_icon',
			'default' => false,
			'control' => array(
				'label' => esc_html__( 'Cart Icon', 'byron' ),
				'type' => 'checkbox',
				'active_callback' => 'byron_cac_has_woo',
			),
		),
	)
);

// Button
$this->sections['byron_header_button'] = array(
	'title' => esc_html__( 'Button', 'byron' ),
	'panel' => 'byron_header',
	'settings' => array(
		array(
			'id' => 'header_button',
			'default' => false,
			'control' => array(
				'label' => esc_html__( 'Enable', 'byron' ),
				'type' => 'checkbox',
			),
		),
		array(
			'id' => 'header_button_text',
			'default' => esc_html__( 'Get a Quote', 'byron' ),
			'control' => array(
				'label' => esc_html__( 'Text', 'byron' ),
				'type' => 'text',
				'active_callback' => 'byron_cac_has_header_button',
			),
		),
		array(
			'id' => 'header_button_url',
			'default' => esc_html__( 'https://your-link.com', 'byron' ),
			'control' => array(
				'label' => esc_html__( 'Url', 'byron' ),
				'type' => 'text',
				'active_callback' => 'byron_cac_has_header_button',
			),
		)
	),
);

// Header Info
$this->sections['byron_header_info'] = array(
	'title' => esc_html__( 'Header Information', 'byron' ),
	'panel' => 'byron_header',
	'settings' => array(
		array(
			'id' => 'header_info',
			'default' => false,
			'control' => array(
				'label' => esc_html__( 'Enable', 'byron' ),
				'type' => 'checkbox',
			),
		),
		// Content
		array(
			'id' => 'header_info_phone_prefix',
			'default' => esc_html__( 'Phone Numbers', 'byron' ),
			'control' => array(
				'label' => esc_html__( 'Phone:', 'byron' ),
				'type' => 'text',
				'rows' => 3,
				'active_callback' => 'byron_cac_has_header_info',
			),
		),
		array(
			'id' => 'header_info_phone',
			'default' => esc_html__( '(+1) 212-946-2707', 'byron' ),
			'control' => array(
				'type' => 'text',
				'rows' => 3,
				'active_callback' => 'byron_cac_has_header_info',
			),
		),
		array(
			'id' => 'header_info_email_prefix',
			'default' => esc_html__( 'Email Address', 'byron' ),
			'control' => array(
				'label' => esc_html__( 'Email:', 'byron' ),
				'type' => 'text',
				'rows' => 3,
				'active_callback' => 'byron_cac_has_header_info',
			),
		),
		array(
			'id' => 'header_info_email',
			'default' => esc_html__( 'info@ByronCo.com', 'byron' ),
			'control' => array(
				'type' => 'text',
				'rows' => 3,
				'active_callback' => 'byron_cac_has_header_info',
			),
		),
		array(
			'id' => 'header_info_address_prefix',
			'default' => esc_html__( 'Our Location', 'byron' ),
			'control' => array(
				'label' => esc_html__( 'Address:', 'byron' ),
				'type' => 'text',
				'rows' => 3,
				'active_callback' => 'byron_cac_has_header_info',
			),
		),	
		array(
			'id' => 'header_info_address',
			'default' => esc_html__( '112 W 34th St, NYC', 'byron' ),
			'control' => array(
				'type' => 'text',
				'rows' => 3,
				'active_callback' => 'byron_cac_has_header_info',
			),
		),
		// Style
		array(
			'id' => 'header_info_color',
			'default' => '',
			'control' => array(
				'label' => esc_html__( 'Header Infor Color', 'byron' ),
				'type' => 'color',
				'active_callback' => 'byron_cac_has_header_info',
			),
			'inline_css' => array(
				'target' => '.header-info .content',
				'alter' => 'color',
			),
		),
	),
);

// Top Bar Socials
$this->sections['byron_header_socials'] = array(
	'title' => esc_html__( 'Social', 'byron' ),
	'panel' => 'byron_header',
	'settings' => array(
		array(
			'id' => 'header_socials',
			'default' => false,
			'control' => array(
				'label' => esc_html__( 'Enable', 'byron' ),
				'type' => 'checkbox',
			),
		),
		array(
			'id' => 'header_socials_spacing',
			'default' => '',
			'control' => array(
				'label' => esc_html__( 'Socials Spacing', 'byron' ),
				'description' => esc_html__( 'Gap Between Each Social. Example: 10px.', 'byron' ),
				'type' => 'text',
				'active_callback' => 'byron_cac_has_header_socials',
			),
		),
	),
);

// Social settings
$social_options = byron_header_social_options();
foreach ( $social_options as $key => $val ) {
	$this->sections['byron_header_socials']['settings'][] = array(
		'id' => 'header_social_profiles[' . $key .']',
		'control' => array(
			'label' => $val['label'],
			'type' => 'text',
			'active_callback' => 'byron_cac_has_header_socials',
		),
	);
}

// Remove var from memory
unset( $social_options );
